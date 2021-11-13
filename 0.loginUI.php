<?php
    session_start(); //啟用session 功能, 必須在php程式還沒輸出任何訊息之前啟用

    // 進來前，都切成未登入狀態
    $_SESSION["userID"] = ""; // 宣告session 變數並指定值
    // userID 可以自己取
?>
<hr>
<!-- 生成一個表單，送到 0.login.php 裡 -->
<form method="post" action="0.login.php">
ID <input type="text" name="id"> <br>

<!-- Password 的 type 可以設成 password，讓別人看不到 -->
Password <input type="text" name="pwd"> <br>
<input type="submit">
</form>