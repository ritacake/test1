Page 2, Page 2, this is page 2
<hr>
<!-- 利用參數改變頁面內容 -->
<?php 
// 檢查有沒有參數
if(isset($_REQUEST["f"])) {
	$f1 = $_REQUEST["f"];
	// 決定裡面的內容要放甚麼
	echo "<img src='./img/$f1'>";
}
?>
