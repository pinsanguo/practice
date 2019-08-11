<?php
require_once('../public/conf.php');
//$userId=session('id');
$userId=1;
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where('type is null')
    ->select('user');
$arr=[];
foreach($res as $k=>$v){
    $arr[]=[
        'id'=>$v['id'],
        'name'=>$v['name'],
        'cellphone'=>$v['cellphone'],
        'addtime'=>$v['addtime'],
        'account'=>$v['account'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>