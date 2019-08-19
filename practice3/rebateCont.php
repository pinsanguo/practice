<?php
session_start();
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$userId=0;
if(!empty($_GET['shopUserID'])){
    $userId=$_GET['shopUserID'];
}
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
    $userTitle=!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['title']:'无';
    $arr[]=[
        'id'=>$v['id'],//id
        'sale_name'=>$v['sale_name'],//商品名称
        'userId'=>$v['userId'],//本条记录的用户ID
        'number'=>$v['number'],//数量
        'amount'=>$v['amount'],//总金额
        'status'=>$v['status'],//状态
        'is_first'=>$v['is_first'],//是否首次购买
        'benren'=>$benren,//当前登录账户的ID
        'parent'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['parent']:'无',
        //当前账户的父级ID
        'userName'=>!empty($userAll2[$v['userId']])?$userAll2[$v['userId']]['username']:'无',
        //购买该条记录账户的用户名
        'userTitle'=>$userTitle,
        //购买该条记录用户职称
        'meTitle'=>!empty($userAll2[$benren])?$userAll2[$benren]['title']:'无',
        //当前用户职称
        'userParent'=>!empty($userAll2[$parId])?$userAll2[$parId]['username']:'无',
        'userParTitle'=>!empty($userAll2[$parId])?$userAll2[$parId]['title']:'无',
        //购买该条记录用户父级账户名
        'sale_price'=>$v['sale_price'],//价格
        'userChild'=>$userChil,
        'zong1'=>get_zong1($parId,$userTitle),
        'dong1'=>get_dong1($parId,$userTitle),
        'dong2'=>get_dong2($parId,$userTitle),
        'dong3'=>get_dong3($parId,$userTitle),
    ];
}
// 需要区分的情况
//①我是这条订单的父级
//②我是这条订单的第一个总裁
//③我是这条第一个董事
//④我是这条第二个董事
//⑤我是这条第三个董事
die(json_encode(['data' => $arr, 'code' => 0]));
?>