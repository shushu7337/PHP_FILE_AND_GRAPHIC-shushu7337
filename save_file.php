<?php 
include_once "base.php";
// 這個檔案單純做處理資料用

if($_FILES['img']['error']==0){
    
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
    
    $name='shu'.date("Ymdhis").$sub;

    move_uploaded_file($_FILES['img']['tmp_name'],"img/".$name);
    
    $data=[
        'filename'=>$name,
        'type'=>$_FILES['img']['type'],
        'note'=>$_POST['note'],
        'album'=>$_POST['album'],
        'path'=>'img/'.$name,
    ];
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    save('file_info',$data);
    header("location:manage.php");
}

?>