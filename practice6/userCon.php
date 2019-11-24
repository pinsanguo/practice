<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$message=$mysql->field('*')
    ->select('user');
$arr=[];
foreach($message as $k=>$v){
    $levelArr=['','超管','领导','普通'];
    $arr[]=[
        'id'=>$v['id'],
        'username'=>$v['username'],
        'addtime'=>$v['addtime'],
        'level'=>!empty($levelArr[$v['level']])?$levelArr[$v['level']]:'',
        'status'=>$v['id'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>