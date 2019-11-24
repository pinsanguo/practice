<?php
require_once('mysql.php');
$configArr=[
    'host'=>'localhost',
    'port'=>'3306',
    'user'=>'root',
    'passwd'=>'root',
    'dbname'=>'practice6',
];
$mysql = new MMysql($configArr);
function deal_with_arr($userAll,$keys){
    $arr=[];
    foreach($userAll as $k=>$v){
        $arr[$v[$keys]]=$v;
    }
    return $arr;
}
//$data=[
//    'name'=>'cache1',
//    'value'=>'keys',
//];
//$result=$mysql->insert('practice',$data);
//print_r($result);die();

////查询
//$res = $mysql->field(array('sid','aa','bbc'))
//    ->order(array('sid'=>'desc','aa'=>'asc'))
//    ->where(array('sid'=>"101",'aa'=>array('123455','>','or')))
//    ->limit(1,2)
//    ->select('t_table');
//$res = $mysql->field('sid,aa,bbc')
//    ->order('sid desc,aa asc')
//    ->where('sid=101 or aa>123455')
//    ->limit(1,2)
//    ->select('t_table');
////获取最后执行的sql语句
//$sql = $mysql->getLastSql();
////直接执行sql语句
//$sql = "show tables";
//$res = $mysql->doSql($sql);
////事务
//$mysql->startTrans();
//$mysql->where(array('sid'=>102))->update('t_table',array('aa'=>666666));
//$mysql->where(array('sid'=>103))->update('t_table',array('bbc'=>'呵呵8888呵呵'));
//$mysql->where(array('sid'=>104))->delete('t_table');
//$mysql->commit();
?>