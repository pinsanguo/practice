<?php
session_start();
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$benren=$userId;
$user1=$mysql->field('*')
    ->where('id="'.$userId.'"')
    ->select('user');
$organ=[];
$_userAll=getAllChild($userId);
$userAll=array_merge($_userAll,$user1);
$userIdArr=array_unique(array_column($userAll,'id'));
$userIdStr=implode(',',$userIdArr);
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
        ->where('userId in ('.$userIdStr.') ')
    ->select('sale');
$userAll2=deal_with_arr($userAll,'id');
$userChil=getChildId($userId);
//print_r($userChil);die();
$arr=[];
foreach($res as $k=>$v){
    $parId=$userAll2[$v['userId']]['parent'];
    $arr[]=[
        'id'=>$v['id'],
        'sale_name'=>$v['sale_name'],
        'userId'=>$v['userId'],
        'number'=>$v['number'],
        'amount'=>$v['amount'],
        'status'=>$v['status'],
        'benren'=>$benren,
        'parent'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['parent']:'无',
        'userName'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['username']:'无',
        'userTitle'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['title']:'无',
        'userParent'=>!empty($userAll2[$parId])?$userAll2[$parId]['username']:'无',
        'sale_price'=>$v['sale_price'],
        'userChild'=>$userChil,
        'rebate1'=>0.15,
        'rebate2'=>0.05,
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>