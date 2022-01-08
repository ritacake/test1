<?php
require('todoModel.php');

$act=$_REQUEST['act'];
switch ($act) {
    // 根據發來的request來做相對應的處理
    // 一個 model function 去處理多個 request
    case "addJob":
        // 取得"1.insertUI.php"中表單POST的值
        $title=strval($_POST['title']); 
        $note=strval($_POST['note']);

        // 如果有寫 $title, 就讓你新增工作
        if ($title) {
            addJob($title,$note);
        }
        header("Location: main.html"); // 完成後，畫面就跳轉至1.listUI.php
        break;
        
    case "setFinish":
        $id=(int)$_REQUEST['id']; // int 將傳進來的request 做型態的轉換，避免惡意攻擊
        if ($id>0) {
            setFinished($id);
        }
        header("Location: 1.listUI.php"); // 完成後，畫面就跳轉至1.listUI.php
        break;
    default:
}
?>

