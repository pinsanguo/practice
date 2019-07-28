<?php
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
require_once('./public/fileupload.class.php');
$up = new fileupload();
//设置属性（上传的位置、大小、类型、设置文件名是否要随机生成）
$up->set("path","./public/uploads/image");
$up->set("maxsize",2000000); //kb
$up->set("allowtype",array("gif","png","jpg","jpeg"));//可以是"doc"、"docx"、"xls"、"xlsx"、"csv"和"txt"等文件，注意设置其文件大小
$up->set("israndname",true);//true:由系统命名；false：保留原文件名
//使用对象中的upload方法，上传文件，方法需要传一个上传表单的名字name：pic
//如果成功返回true，失败返回false
if($up->upload("step1_up_image")){
    $fielName=$up->getFileName();
    die(json_encode(['status'=>'ok','msg'=>'上传图片成功','file'=>$fielName]));

}else{
    $fielName='';
    $error=$up->getErrorMsg();
    die(json_encode(['status'=>'no','msg'=>$error,'file'=>$fielName]));
}
?>
