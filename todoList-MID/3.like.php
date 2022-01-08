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

$t=(int)$_GET['t'];

if ($id>0) {
    if ($t == 1) {
        $sql = "update response set `likes`=likes+1 where id=?;";
    } elseif ($t == -1) {
        $sql = "update response set `likes`=likes-1 where id=?;";
    } else {
        exit;
    }
    $stmt = mysqli_prepare($db, $sql );
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    //echo "liked.";
    header("Location: 3.viewPost.php");
} else {
    echo "empty id, cannot like.";
}
?>
