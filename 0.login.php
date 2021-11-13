<?php
require_once("dbconfig.php");
     //�ҥ�session �\��, �����bphp�{���٨S��X����T�����e�ҥ�
    $loginID = $_POST["id"];
    $password = $_POST["pwd"];

$sql = "select loginID,role,level from user where password=PASSWORD(?);";
$stmt = mysqli_prepare($db, $sql );
mysqli_stmt_bind_param($stmt, "s", $password); //bind parameters with variables
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); 
if ($rs = mysqli_fetch_assoc($result)) {
    if ($rs['loginID'] == $loginID) {
        $_SESSION["userID"] = $loginID; //�ŧisession �ܼƨë��w��
        //$_SESSION["role"] = $rs['role']; //�ŧisession �ܼƨë��w��
        $_SESSION["role"] = $rs['level']; //�ŧisession �ܼƨë��w��
        header("Location: 1.listUI.php");
    } else {
        $_SESSION["userID"] = '';
        $_SESSION["role"] = '';
        header("Location: 0.loginUI.php");
    }
}
?>
