<?php 
session_start();
/*
連線資料庫用的副程式
*/
$host = 'localhost'; //執行DB Server 的主機
$user = 'root'; //登入DB用的DB 帳號
$pass = ''; //登入DB用的DB 密碼
$dbName = 'test'; //使用的資料庫名稱
/* $db 即為未來執行SQL指令所使用的物件 */
$db = mysqli_connect($host, $user, $pass, $dbName) or die('Error with MySQL connection'); //跟MyMSQL連線並登入

mysqli_query($db,"SET NAMES utf8"); //設定編碼為 unicode utf8

// 可以在需要檢查登入權限的程式碼加這個 function
function checkAccessRole($reqRole) {
    if (isset($_SESSION['role']) and $_SESSION['role']==$reqRole) {
        return True;
    } else {
        return False;
    }
}

// 可以在需要檢查登入權限的程式碼加這個 function
// 利用數字的大小決定權限
function checkAccess($reqLevel) {
    if (isset($_SESSION['role']) and $_SESSION['role'] >= $reqLevel) {
        return True;
    } else {
        return False;
    }
}
?>