<?php
require('todoModel.php');

if (isset($_REQUEST['act'])) { // 如果存在
	$act=$_REQUEST['act']; // 就去讀他
} else $act=''; // 不再就設成空值
  
switch ($act) {
    // 新增一個新工作
	case "addJob":
		$title=$_POST['title'];
		$note=$_POST['note'];

		if ($title) {
			addJob($title,$note);
		}
		echo "OK";
		break;
    // 把某個工作設成已完成
	case "setFinish":
		$id=(int)$_REQUEST['id']; // int 轉成整數，確認 $id 真的是整數
		// 防呆
        if ($id>0) {
			setFinished($id);
		}
		echo "OK";		
		break;
    // 產生一個 List
	case "getList":
		$list = getJobList(2); // 未完成工作 List
		echo json_encode($list); // 將 $list encode 成一個 json 
		break;
	default:
}
?>

