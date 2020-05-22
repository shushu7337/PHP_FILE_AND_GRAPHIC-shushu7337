<?php

include_once "base.php";

if(!empty($_GET['id'])){
    $row=find("file_info",$_GET['id']);
}

if(!empty($_POST['submit'])){
    $id=$_POST['id'];
    $source=find("file_info",$id);
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


            // 直接覆蓋的暴力作法
            // 請注意如果副檔名沒有更改的話，電腦會吃舊有檔案的暫存檔
            // 劉老推薦還是使用更改檔名的方式，相對保險很多，解乙級的話反而比較推暴力改法 較快速
            // unlink($source['path']);

            // $name='shu'.date("YmdHis").$sub;
            $source['filename']=explode(".",$source['filename'])[0].$sub;
            // $source['filename']=$name;
            $source['type']=$_FILES['img']['type'];
            $source['path']="img/".$$source['filename'];

            // 這裡也是給新檔名
            move_uploaded_file($_FILES['img']['tmp_name'],"img/".$source['filename']);


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