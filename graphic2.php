<?php
include_once "base.php";

if($_FILES['pic']['error']==0){
    switch($_FILES['pic']['type']){
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

    move_uploaded_file($_FILES['pic']['tmp_name'],"img/".$name);
    
    $data=[
        'filename'=>$name,
        'type'=>$_FILES['pic']['type'],
        'note'=>$_POST['note'],
        'album'=>$_POST['album'],
        'path'=>'img/'.$name,
    ];
    save('file_info',$data);

    // 給予原始檔名
    $thumb_path="thumb/".$name;
    // 原始檔位置
    $source_path="img/".$name;

    $img_info=getimagesize($source_path);
    // print_r($img_info) ;
    
    // 將照片給予縮放0.2倍
    $rate=0.2;

    // 判定照片會有三個狀況 (高>寬)  (寬>高)  (寬=高)
    // 可以使用abs 絕對值
    if($img_info[0]>$img_info[1]){
// 寬>高
        $src_x=($img_info[0]-$img_info[1])/2;
        $src_y=0;
        $img_w=$img_info[1]*$rate;
        $img_h=$img_info[1]*$rate;
        $src_w=$img_info[1];
        $src_h=$img_info[1];
    }else if($img_info[0]>$img_info[1]){
        $src_x=0;
        $src_y=($img_info[1]-$img_info[0])/2;
        $img_w=$img_info[0]*$rate;
        $img_h=$img_info[0]*$rate;
        $src_w=$img_info[0];
        $src_h=$img_info[0];

// 寬<高
    }else{
        $src_x=$img_info[0];
        $src_y=$img_info[0];
        $img_w=$img_info[1]*$rate;
        $img_h=$img_info[1]*$rate;
        $src_w=$img_info[1];
        $src_h=$img_info[1];
    }
// 寬=高    



    // 將新圖片的寬跟高都乘上上面給予的0.2倍
    $img_w=$img_info[0]*$rate;
    $img_h=$img_info[0]*$rate;
    // php沒辦法直接做存取
    // 所以必須建立一張新的圖片資源(畫布)
    // 將記憶體內的圖片寫到新增的圖片資源，再做輸出
    // 此為目的圖片

    $thumb_img=imagecreatetruecolor($img_w,$img_h);

    // mime代表的是檔案格式，在函示內要給予來源
    switch($img_info['mime']){
        case "image/jpeg";
            $source_img=imagecreatefromjpeg($source_path);
        break;
        case "image/png";
            $source_img=imagecreatefrompng($source_path);
        break;
        case "image/gif";
            $source_img=imagecreatefromgif($source_path);
        break;
    }

    // imagecopyresampled()此函式需要兩張照片的資訊
    // (一張是來源圖)(一張是後來的圖)
    // 可以參照imagecopysample的函式說明
    imagecopyresampled($thumb_img,$source_img,0,0,$src_x,$src_y,$img_w,$img_h,$src_w,$src_h);

    // 縮放完的$thumb_img只是一項資源，要再另外儲存
    switch($img_info['mime']){
        case "image/jpeg";
        imagejpeg($thumb_img,$thumb_path);
    break;
        case "image/png";
        imagepng($thumb_img,$thumb_path);
    break;
        case "image/gif";
        imagegif($thumb_img,$thumb_path);
    break;
    }
header("location:image.php");
}



?>