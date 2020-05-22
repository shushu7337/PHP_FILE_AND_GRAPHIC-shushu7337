<?php 
date_default_timezone_set("Asia/Taipei");
echo "<pre>";
// $_大多是系統變數
print_r($_FILES);
echo "</pre>";

echo $_FILES['img']['name'];

// 判斷陣列是否存在  
// 下列兩行都可以判斷陣列是否成功存在

// if(!empty($_FILE['img']['tmp_name']) 

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
    // Ymdshis不用dash，dash is for user reading
    // 如果上傳的檔案一定有副檔名的話可以這樣用(沒有副檔名就不行)
    // $sub=explode('.',$_FILES['upload']['name']);
    // $sub[1];->副檔名
    
    $name=date("Ymdhis").$sub;

    // move_uploaded_file([要搬的字串檔名][舊有字串路徑],[要搬的字串檔名][要搬的位置])
    // move_uploaded_file($_FILES['img']['tmp_name'],"img/".$_FILES['img']['name']);
    move_uploaded_file($_FILES['img']['tmp_name'],"img/".$name);

    header("location:upload.php?filename=$name");
}

?>
<!-- 此陣列為二維陣列，他會先去[img]再去[tmp_name]，所以單輸入['tmp_name']不會印出 -->

<!-- 如果是其他類型的檔案，必須更改相對應的標籤形式(type處可以更改) -->