<style>
*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
img{
    width:100%; 
    border:3px solid blue;
    
}
.frame{
    display:inline-flex;
    width:150px;
    border:2px solid #5ee;
    margin:10px;
    box-shadow:1px 1px 5px #990;
    vertical-align:middle;
    align-items:center;
    padding:0 10px;
}

</style>

    <a href="?album=1">food</a>
    <a href="?album=2">animal</a>
    <a href="?album=3">life</a>

<?php
include_once "base.php";

// 增加一個像簿類別條件
if(!empty($_GET['album'])){
    $album=['album'=>$_GET['album']];
}else{
    $album=[];
}


$images=all("file_info",$album);

foreach($images as $img){
    echo "<div class='frame'><img src='"."thumb/".$img['filename']."'></div>";
}

?>
