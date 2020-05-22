<style>
img{
    display: inline-block;
    width: 300px;
}




</style>







<?php
include_once "base.php";

$images=all("file_info");

foreach($images as $img){
    echo "<img src='".$img['path']."'>";
}

?>
