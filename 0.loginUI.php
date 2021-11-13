<?php
    session_start(); //�ҥ�session �\��, �����bphp�{���٨S��X����T�����e�ҥ�
    $_SESSION["userID"] = ""; //�ŧisession �ܼƨë��w��
?>
<hr>
<form method="post" action="0.login.php">
ID <input type="text" name="id"> <br>
Password <input type="text" name="pwd"> <br>
<input type="submit">
</form>