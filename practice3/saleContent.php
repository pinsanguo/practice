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
//筛选搜索条件
$where='';
$where.=' userId in ('.$userIdStr.') ';
if(!empty($_GET['username'])){
    $userName=$_GET['username'];
    $user2=$mysql->field('id')
        ->where('username="'.$userName.'"')
        ->select('user');
    if(!empty($user2)){
        $where.=' and userId = ('.$user2['0']['id'].') ';
    }
}
//title
if(!empty($_GET['title'])){
    $userTitle=$_GET['title'];
    $user3=$mysql->field('id')
        ->where('title="'.$userTitle.'"')
        ->select('user');
    if(!empty($user3)){
        $userIdArr3=[];
        foreach($user3 as $k3=>$v3){
            $userIdArr3[]=$v3['id'];
        }
        $userIdStr3=implode(',',$userIdArr3);
        $where.=' and userId in ('.$userIdStr3.') ';
    }
}
//tiemType
if(!empty($_GET['tiemType'])){
    $tiemType=$_GET['tiemType'];
    $startTime=$_GET['startTime'];
    $endTime=$_GET['endTime'];
    if($tiemType == 1){
        $where.=' and addtime >= ("'.$startTime.'") ';
        $where.=' and addtime <= ("'.$endTime.'") ';
    }else if($tiemType == 2){
        $where.=' and settletime >= ("'.$startTime.'") ';
        $where.=' and settletime <= ("'.$endTime.'") ';
    }
}
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
        ->where($where)
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
        'is_first'=>$v['is_first'],
        'benren'=>$benren,
        'parent'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['parent']:'无',
        'userName'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['username']:'无',
        'userTitle'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['title']:'无',
        'meTitle'=>!empty($userAll2[$benren])?$userAll2[$benren]['title']:'无',
        'userParent'=>!empty($userAll2[$parId])?$userAll2[$parId]['username']:'无',
        'sale_price'=>$v['sale_price'],
        'userChild'=>$userChil,
        'rebate1'=>0.15,
        'rebate2'=>0.05,
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>