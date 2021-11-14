<?php
require_once("dbconfig.php");
    //啟用session 功能, 必須在php程式還沒輸出任何訊息之前啟用
    $loginID = $_POST["id"];
    $password = $_POST["pwd"];

    // 密碼 = 加密過的密碼
    // (SQL 語法) 輸入的密碼與 DB密碼 相同的資料列出來
$sql = "select loginID,role,level from user where password=PASSWORD(?);";
$stmt = mysqli_prepare($db, $sql);
// 告訴資料庫 $password 是 string
mysqli_stmt_bind_param($stmt, "s", $password); // bind parameters with variables
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// $rs 如果資料庫裡找不到相同的密碼，就會是null
if ($rs = mysqli_fetch_assoc($result)) { // 有結果
    if ($rs['loginID'] == $loginID) { // 判斷 登入的id 也符合，代表登入成功
        $_SESSION["userID"] = $loginID; // 將使用者的userID記起來，宣告session 變數並指定值
        //$_SESSION["role"] = $rs['role']; //宣告session 變數並指定值
        $_SESSION["role"] = $rs['level']; // 宣告session 變數並指定值
        header("Location: 1.listUI.php"); // 登入成功，轉向至 1.listUI.php
    } else { // 登入失敗
        $_SESSION["userID"] = ''; // 清空session
        $_SESSION["role"] = ''; // 清空session
        header("Location: 0.loginUI.php"); // 登入失敗，轉向至 0.loginUI.php
    }
}
?>
