<?php
session_start();
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$benren=$userId;
$userId=1;
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
        ->where('applayuserId='.$userId.' or applayStatus=0')
    ->select('tast');
$arr=[];
foreach($res as $k=>$v){
    $arr[]=[
        'id'=>$v['id'],
        'money'=>'money',
        'yongJin'=>'yongJin',
        'yaoQiu'=>'yaoQiu',
        'applayStatus'=>$v['applayStatus'],
        'applayUserId'=>$v['applayUserId'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>