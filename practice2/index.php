<?php
require_once('./public/mysql.php');
$configArr=[
    'user'=>'root',
    'passwd'=>'root',
    'dbname'=>'test2',
];
$mysql = new MMysql($configArr);
$data=[
    'name'=>'cache1',
    'value'=>'keys',
];
$result=$mysql->insert('practice',$data);
print_r($result);die();
?>