<?php
include_once "base.php";
?>


<?php
$id=$_GET['id'];
// 先用find來找到資料的路徑
$file=find("file_info",$id);
unlink($file['path']);
// 在來做刪除的動作
del("file_info",$id);
// 導回頁面到manage.php
to("manage.php");

?>