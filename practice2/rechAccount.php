<?php
require_once('./public/conf.php');
$userId=0;
$userId=!empty($_SESSION['shopUserID'])?$_SESSION['shopUserID']:0;
$userId=1;
$res = $mysql->field(array('id','rechTime','rechNote','rechAccount','rechBenJin','rechBlance'))
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
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>