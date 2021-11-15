<!-- 單純執行 sql 語法，所以不寫 html，直接寫 php -->
<?php
// 連線 DB
require("dbconfig.php");
// 取得 ID
if(isset($_GET['id'])) {
    $id=(int)$_GET['id'];
} else {
    $id=0;
}

function checkLiked($db, $id){
    $sql = "select hasLiked from `guestbook` where id=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    if($result == 1){
        return false;
    }
    return true;
}

$t=(int)$_GET['t'];

if ($id > 0 && checkLiked($db, $id)) {
    if ($t == 1) {
        $sql = "update guestbook set `hasLiked`=1 AND `likes`=likes+1 where id=?;";
    } elseif ($t == -1) {
        $sql = "update guestbook set `likes`=likes-1 where id=?;";
    } else {
        exit;
    }
    $stmt = mysqli_prepare($db, $sql );
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    //echo "liked.";
    header("Location: 1.listUI.php");
} if(!checkLiked($db, $id)){
    echo "按過贊了!";
}
else {
    echo "empty id, cannot like.";
}
?>
