<!-- 確認是否登入過，確認進來的人都登入過 -->
<?php
require("dbconfig.php");
//require("3.viewPost.php");

// 如果沒登入過，跳轉到 0.loginUI.php
// 0 代表每個人都可以進來
// 5 是 admin
if ( ! (checkAccess(1))) { 
    header("Location: 0.loginUI.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>

<p><?php echo "Hello ",$_SESSION['userID'];  ?>	
<a href='1.insertUI.php'>Add</a>
<!-- 登出按鈕 (0.loginUI.php 會清空session) -->
<a href='0.loginUI.php'>logout</a>
</p>
<hr />
<table width="200" border="1">
  <tr>
    <td>id</td>
    <td>title</td>
    <td>message</td>
    <td>name</td>
    <td>讚</td>
    <td>-</td>
  </tr>
<?php

// 把所有清單列出來
$sql = "select * from guestbook order by id desc;";
$stmt = mysqli_prepare($db, $sql);
// 因為只是單純全部列出來，所以不用 bind
mysqli_stmt_execute($stmt);
// $result 是與資料庫相符的全部結果
$result = mysqli_stmt_get_result($stmt); 

// 留言數量
    // $num = ResponseNum($db, $id);
    // echo $num;

  // 顯示選單
    // echo "<form method=get action=3.viewPost.php>",
    // "<tr>留言類別:<select name=resType id=resType>",
    // "<option value=chat>閒聊</option>",
    // "<option value=mood>心情</option>",
    // "<option value=gossip>八卦</option></select></tr>";
    
    // // echo " <tr>文章選擇:<select name=id id=id>";
    // // while ($rs = mysqli_fetch_assoc($result)){
    // //   $id=$rs['id'];
    // //   echo "<option value=",$id,">",$rs['title'],"</option>";
    // // }

    // // echo "</select></tr>";
    // echo "<tr><input type=button value=搜尋留言 name=search id=search></tr>";
    // echo "</form>";

    echo "<form method=post action='3.viewPost.php'>",
    "<tr>留言類別:<select name=resType id=resType>",
    "<option value=chat>閒聊</option>",
    "<option value=mood>心情</option>",
    "<option value=gossip>八卦</option></select></tr>";
    // echo "<tr>文章選擇:<select name=id id=id>";
    // while (	$rs = mysqli_fetch_assoc($result)) {
    //   $id=$rs['id'];
    //   echo "<option value=", $id ,">",$rs['title'],"</option>";
    // }
    echo "</select></tr>";
while (	$rs = mysqli_fetch_assoc($result)) {
    $id=$rs['id'];

    echo "<tr><td>" , $rs['id'] ,
    
    // 加上一個超連結，可以顯示留言區
    // 因為要知道是看哪一篇文章的留言，所以後面要接參數(?id=$id)
    "</td><td><a href='3.viewPost.php?id=$id'>" , $rs['title'],"</a>",
    // "</td><td>" , $rs['title'],
    
    "</td><td>" , $rs['msg'], 
    "</td><td>", $rs['name'], "</td>",
    "</td><td>", $rs['likes'], "</td>",
    "<td><a href='2.like.php?id=", $rs['id'], "&t=1'>Like</a> ",
    "<a href='2.like.php?id=", $rs['id'], "&t=-1'>Dislike</a> ";
    
    // 希望只有管理員才能 delete、edit
    // 如果不是管理員，就不會顯示這兩個按鈕
    if (checkAccess(5)) {
        echo "<a href='2.delete.php?id=", $rs['id'], "'>Delete</a> ",
        "<a href='1.editUI.php?id=", $rs['id'], "'>Edit</a>";
    }
}

?>
</table>
</body>
</html>
