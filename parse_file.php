<?php

include_once "base.php";

if(!empty($_FILES['doc']['tmp_name'])){
    echo "上傳的暫存檔名:".$_FILES['doc']['tmp_name']."<br>";
    echo "檔案類型:".$_FILES['doc']['type']."<br>";
    echo "檔案原始名稱:".$_FILES['doc']['name']."<br>";

    // 把檔案搬到doc裡面，並命名為原始的檔名
    move_uploaded_file($_FILES['doc']['tmp_name'],"doc/".$_FILES['doc']['name']);
    echo "檔案搬移位置在"."doc/".$_FILES['doc']['name'];


}else{
    // 印出錯誤訊息
    echo "上傳錯誤:".$_FILES['doc']['error'];


}










?>