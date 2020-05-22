<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">檔案上傳練習</h1>
 <!----建立你的表單及設定編碼----->

<!-- 檔案基本上不是純文字的話要先編碼再上傳 -->
<form action="catch_file.php" method="post" enctype="multipart/form-data">
<!-- 設計上傳介面 -->
    <input type="file" name="img" id="img"><br>
    <input type="text" name="desc"><br>
    <input type="submit" value="send">
</form>


<!----建立一個連結來查看上傳後的圖檔---->  
<!-- 將上傳的檔案路徑回傳回來 -->
<?php
// 
    if(!empty($_GET['filename'])){
        $name=$_GET['filename'];
?>
        <img src="img/<?=$name;?>" alt="" style="width:200px">
<?php
    }else{
        $name="";
    }


?>
</body>
</html>