<?php

include_once "base.php";

if(!empty($_FILES['doc']['tmp_name'])){
    // echo "上傳的暫存檔名:".$_FILES['doc']['tmp_name']."<br>";
    // echo "檔案類型:".$_FILES['doc']['type']."<br>";
    // echo "檔案原始名稱:".$_FILES['doc']['name']."<br>";

    // // 把檔案搬到doc裡面，並命名為原始的檔名
    // move_uploaded_file($_FILES['doc']['tmp_name'],"doc/".$_FILES['doc']['name']);
    // echo "檔案搬移位置在"."doc/".$_FILES['doc']['name'];

    if($_FILES['doc']['type']=='text/plain'){
        // 如果是純文字檔案文件的話就把它搬到doc的目錄下，並使用其原始檔名
        move_uploaded_file($_FILES['doc']['tmp_name'],'doc/'.$_FILES['doc']['name']);
        // $_FILES['doc']['name']可以自定義變數，如下
        $path='doc/'.$_FILES['doc']['name'];

        $file=fopen($path,"r+");
        
        // 略過第一行
        $txt=fgets($file);
        // 宣告num從一開始
        $num=1;
        // 如果沒有到檔案結尾的話
        while(!feof($file)){
            $txt=fgets($file);
            $tmp=explode(",",$txt);
            if(count($tmp)==4){

                print_r($tmp);
                $content['subject']=$tmp[0];
                $content['description']=$tmp[1];
                $content['create_date']=$tmp[2];
                $content['due_date']=$tmp[3];
                save("todo_list",$content);
                // 自訂變數讓它顯示出來，要不然他是不會有反應的
                echo "已儲存".$num."筆資料";
                $num++;
            }
        }
        to ("text-import.php"); 
        


    }else{
        echo "檔案類型錯誤!";
    }
}else{
    // 印出錯誤訊息
    echo "上傳錯誤:".$_FILES['doc']['error'];


}










?>