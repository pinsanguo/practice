<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$message=$mysql->field('*')
    ->where('status=1 and receive_id='.$userId)
    ->select('message');
$allUserRes=$mysql->field('id,username,level')
    ->select('user');
$user=deal_with_arr($allUserRes,'id');
$arr=[];
foreach($message as $k=>$v){
    $arr[]=[
        'send'=>!empty($user[$v['send_id']])?$user[$v['send_id']]['username']:'',
        'receive'=>!empty($user[$v['receive_id']])?$user[$v['receive_id']]['username']:'',
        'message'=>mb_substr($v["message"],'0','30'),
        'addtime'=>$v['addtime'],
        'status'=>$v['status'],
        'id'=>$v['id'],
        'title'=>$v['title'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>