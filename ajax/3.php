<?php
require_once("dbconfig.php");
if(isset($_REQUEST["f"])) {
	$f2 = $_REQUEST["f"] . "%";
} else {
	// 查詢所有
	$f2='%';
}
// sql 查詢結果轉 json
$sql="select * from todo where title like ?";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "s", $f2); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL
	$result = mysqli_stmt_get_result($stmt); // 從 $stmt 裡取出資料
	$rows = array(); // 存所有查詢的結果

	// 從裡面抓出一筆資料
	while($r = mysqli_fetch_assoc($result)) {
		// 把抓出的資料 append 進 $rows[]
		$rows[] = $r;
	}

	// 從裡面抓出一筆資料
	// while($r = mysqli_fetch_assoc($result)) {
	// 	/*
	// 	$temp=array();
	// 	$temp['a'] = $r['id'];
	// 	$temp['b'] = $r['title'];
	// 	$rows[]=$temp;*/
	// 	$rows[] = $r;
	// }


// 把它轉成符合 json 格式的字串
echo json_encode($rows);
?>
