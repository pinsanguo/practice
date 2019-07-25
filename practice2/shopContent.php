<?php
require_once('./public/conf.php');
$arr=[
    [
        'shopType'=>'淘宝',
        'shopName'=>'店铺：波舒品质<br/>旺旺名：江文大少爷',
        'shopLink'=>'https://shukewen.taobao.com/index.htm?spm=2013.1.w5002-21471472963.2.7a3f315evfgEC2',
        'shopPhone'=>'电话：1300369550<br/>QQ:575775218',
    ],
    [
        'shopType'=>'天猫',
        'shopName'=>'店铺：浪莎宏悦专卖店<br/>旺旺名：浪莎宏悦专卖店',
        'shopLink'=>'https://langshahy.tmall.com/?spm=a1z10.1-b.1997427721.d4918089.60c76b26M8RTA5',
        'shopPhone'=>'电话：13888888888<br/>QQ:7777777',
    ],
];
die(json_encode(['data' => $arr, 'code' => 0]));
?>