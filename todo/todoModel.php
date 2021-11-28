<?php
require_once("dbconfig.php"); // 連DB

// 要新增一個工作，需要 title(名稱), note(工作說明)
// start  開始 是工作加進DB時，自動填入的，所以不用傳其參數
// finish 完成日是事後設的
function addJob($title,$note) {
	global $db;
	$sql = "insert into todo (title, note) values (?, ?)";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "ss", $title, $note); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL

	return true;
}

function getJobList($type=0) {
    // 如果沒加這行，他會不知道你說的$db是誰，因為在此function你沒有宣告$db是甚麼
    global $db;  // 全域變數
    
	/*
    // 這是測試用的code，要改成是從 DB 抓出來的資料
    
    // $a 是宣告一筆測試的假資料
    // 但 getJobList() 是會回傳一個array，很多筆資料的function
    // 所以我建立一個空的陣列 $aa，然後把所有 每筆工作資料$a 放進去
    // $a: ['id', 'title', 'note', 'start', 'finish']
    // $aa: ['a0','a1','a2',...]
	$a=array();
	$a['id']=10;
	$a['title']='test';
	$a['note']='note';
	$a['start']='123';
	$a['finish']=null;
    // 陣列中的陣列
	$aa[]=$a;
	return  $aa;
    // $a 類似於 "1.listUI.php" 中的 "$job"
    // $aa 類似於 "1.listUI.php" 中的 "$result"
    */
	if ($type==1) {
		$sql = "select * from todo where not isnull(finish) order by id desc;";
	} else if ($type==2) {
		$sql = "select * from todo where isnull(finish) order by id desc;";
	} else {
		$sql = "select * from todo order by id desc;";		
	}
	$stmt = mysqli_prepare($db, $sql );
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt); 

	$retArr=array(); // 所有工作的資料 (要回傳)
    // 用while loop 把所有資料讀出來
	while (	$rs = mysqli_fetch_assoc($result)) {
		$tArr=array(); // 每筆資料
		$tArr['id']=$rs['id'];
		$tArr['title']=$rs['title'];
		$tArr['note']=$rs['note'];
		$tArr['start']=$rs['start'];
		$tArr['finish']=$rs['finish'];
		$retArr[] = $tArr; // 把 $tArr 放至 $retArr[]
	}
	return $retArr;
}

// 設工作結束
function setFinished($id){
	global $db;
    // 結束時間設為 現在時間 now() 
	$sql = "update todo set finish=now() where id=?;";
	$stmt = mysqli_prepare($db, $sql); //prepare sql statement
	mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables
	mysqli_stmt_execute($stmt);  //執行SQL

	return true;
}
?>