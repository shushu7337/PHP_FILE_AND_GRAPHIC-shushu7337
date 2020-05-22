<?php

include_once "base.php";

if(!empty($_GET['id'])){
    $row=find("file_info",$_GET['id']);
}

if(!empty($_POST['submit'])){
    $id=$_POST['id'];
    $source=find("file_info",$id);
    // 判斷這次表單是否有上傳檔案(處理有檔案上傳的動作)
    if(!empty($_FILES['img']['tmp_name'])){
            switch($_FILES['img']['type']){
                case "image/jpeg";
                    $sub='.jpg';
                break;
                case "image/png";
                    $sub='.png';
                break;
                case "image/gif";
                    $sub='.gif';
                break;
            }
            unlink($source['path']);
            
            // 給予新檔名
            $name='shu'.date("YmdHis").$sub;
            // 如果檔案有上傳的話就會有$sub & $name這兩個變數
            // 所以如果有$name的話就是有檔案做更新($sub最後會被併入到$name)
            // 並執行下列三行程是
            $source['filename']=$name;
            $source['type']=$_FILES['img']['type'];
            $source['path']="img/".$name;

            // 這裡也是給新檔名
            move_uploaded_file($_FILES['img']['tmp_name'],"img/$name");


    }
    $note=$_POST['note'];
    // 將原本的['note']資料先拿做來
    $source['note']=$note;


    save("file_info",$source);

    to("manage.php");
}

?>

<img src="<?=$row['path'];?>" style="width:300px;">
<!-- 要先判斷有沒有上傳新的檔案 -->
<!-- 如果有的新的檔案的話，檔案內容應該要相對應的更改 -->
<!--  -->
<form action="update_file.php" method="post" enctype="multipart/form-data">
    <input type="file" name="img"><br>
    <input type="text" name="note" value="<?=$row['note'];?>"><br>
    <input type="hidden" name="id" value="<?=$row['id'];?>">
    <input type="submit" name="submit" value="更新">
</form>