<?php
require_once('./public/conf.php');
//$userId=session('id');
$userId=1;
$res = $mysql->field(array('id','username','parent','title'))
    ->order(array('id'=>'desc'))
    ->select('user');
$arr=[];
$allUser=$res;
$allUser2=deal_with_arr($allUser,'id');
foreach($res as $k=>$v){
    $arr[]=[
        'id'=>$v['id'],
        'username'=>$v['username'],
        'parent'=>!empty($allUser2[$v['parent']])?$allUser2[$v['parent']]['username']:'无',
        'title'=>$v['title'],
    ];
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>