<?php
session_start();
require_once('./public/conf.php');
$userId=0;
$userId=!empty($_SESSION['shopUserID'])?$_SESSION['shopUserID']:0;
$userInfo = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where(array('id'=>$userId,))
    ->select('user');
$userInfo2=!empty($userInfo['0'])?$userInfo['0']:[];
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where(array('userId'=>$userId,))
    ->select('account');
$arr=[];
foreach($res as $k=>$v){
    $arr[]=[
        'id'=>$v['id'],
        'rechTime'=>$v['rechTime'],
        'rechNote'=>$v['rechNote'],
        'rechAccount'=>$v['rechAccount'],
        'rechBenJin'=>$v['rechBenJin'],
        'rechBlance'=>$v['rechBlance'],
        'rechBankMoney'=>$v['rechBankMoney'],
        'rechType'=>$v['rechType'],
        'account'=>$userInfo2['account'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>