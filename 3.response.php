<?php
// 連 DB
require('dbconfig.php');
// 取得 mid，轉成 int，以免遭惡意入侵
$mid=(int)$_POST['mid'];
$msg=$_POST['msg'];

if ($mid > 0) {
    $sql = "insert into response (mid, msg) values (?, ?)";
    $stmt = mysqli_prepare($db, $sql); //prepare sql statement

    // "is": 第一個 $mid 是 int；第二個 $msg 是 string
    // 把對應到的變數綁進去
    mysqli_stmt_bind_param($stmt, "is", $mid, $msg); //bind parameters with variables
    mysqli_stmt_execute($stmt);  //執行SQL
    
    // 轉回 3.viewPost.php
    // 新增完跳回原本那頁去
    // 記得要傳文章號碼($id)
    header("Location: 3.viewPost.php?id=$mid");
} else {
    echo "empty title, cannot insert.";
}
?>