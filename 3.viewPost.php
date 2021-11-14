<?php
// 連線 DB
require("dbconfig.php");
// 取得 ID
if(isset($_GET['id'])) {
    $id=(int)$_GET['id'];
} else { // 沒有 ID
    echo "invalid id";
    // 離開
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
  <!-- 回上一頁的超連結 -->
<a href="1.listUI.php">Back</a><br>
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
// 因為只有一則文章，所以用 where，不是用 order by
$sql = "select * from guestbook where id=?;";
$stmt = mysqli_prepare($db, $sql );
// integer bind $id 進去
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); 

// 因為只有一筆，所以就直接把那筆 fetch 出來
$rs = mysqli_fetch_assoc($result); 

// show 文章基本內容
    echo "<tr><td>" , $rs['id'] ,
    
    // 就不加超連結了~
    "</td><td>", $rs['title'],
    "</td><td>" , $rs['msg'], 
    "</td><td>", $rs['name'], "</td>",
    "</td><td>", $rs['likes'], "</td>",
    "<td><a href='2.like.php?id=", $rs['id'], "&t=1'>Like</a> ",
    "<a href='2.like.php?id=", $rs['id'], "&t=-1'>Dislike</a> ",
    "<a href='2.delete.php?id=", $rs['id'], "'>Delete</a> ",
    "<a href='1.editUI.php?id=", $rs['id'], "'>Edit</a></td></tr>";
?>
</table>

<!-- 產生回覆的留言 -->
<?php
//fetch responses of this post
// 把回覆意見抓出來，顯示出來
// 把 mid 當成 FK 去查它的 response
$sql = "select * from `response` where mid=? order by id;";
$stmt = mysqli_prepare($db, $sql );
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); 

// 把所有相同 mid 的抓出來
// 用 while loop 抓
// 每一筆留言都成為一個段落(<p>)
while (	$rs = mysqli_fetch_assoc($result)) {
  // 將抓到的結果印出來
    echo "<p>",$rs['msg'],"</p>";
}
?>

<!-- 回覆表單 -->
<!-- 下面註解是用 get 的方式取得 -->
<!-- 如果用註解的方法，那 3.response.php 要改成用 GET 的方式取得資料 -->
<!-- <form method="post" action="3.response.php?id=<php echo $id; ?>"> -->

<!-- post 要用 post的方式取得 -->
<form method="post" action="3.response.php">
    <td><label>
      <!-- 屬於哪一篇文章的回覆，但不希望被使用者看到，所以用 type="hidden"
    那 mid 的值可以echo 進去 -->
      <input name="mid" type="hidden" value="<?php echo $id;?>" />
      <input name="msg" type="text" id="msg" />
    </label></td>
    <td><label>
      <input type="submit" name="Submit" value="送出" />
    </label></td>
    </form>
</body>
</html>
