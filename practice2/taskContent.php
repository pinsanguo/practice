<?php
require_once('./public/conf.php');
//$userId=session('id');
$userId=1;
$res = $mysql->field(array('id','shopType','shopName','shopLink','shopWang','shopPhone','shopQQ'))
    ->order(array('id'=>'desc'))
    ->where(array('userId'=>$userId,))
    ->select('shopManage');
$arr=[];
foreach($res as $k=>$v){
    $arr[]=[
        'id'=>$v['id'],
        'shopType'=>$v['shopType'],
        'shopName'=>'店铺:'.$v['shopName'].'<br/>旺旺名:'.$v['shopWang'],
        'shopLink'=>$v['shopLink'],
        'shopPhone'=>'电话:'.$v['shopPhone'].'<br/>QQ:'.$v['shopQQ'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>