<?php
$mysql = getMysql();
function getMysql(){
    require_once('mysql.php');
    $configArr=[
        'host'=>'localhost',
        'port'=>'3306',
        'user'=>'root',
        'passwd'=>'root',
        'dbname'=>'practice3',
    ];
    $mysql = new MMysql($configArr);
    return $mysql;
}
function getAllChild($userId){
    $mysql=getMysql();
    $res1=$mysql->field('*')
        ->where('parent="'.$userId.'"')
        ->select('user');
    $ret=$res1;
    foreach($res1 as $k=>$v){
        $child=getAllChild($v['id']);
        $ret=array_merge($ret,$child);
    }
    return $ret;
}
function getChildId($userId){
    $mysql=getMysql();
    $res=$mysql->field('*')
        ->where('parent="'.$userId.'"')
        ->select('user');
    $chilArr=array_unique(array_column($res,'id'));
    $chilStr=implode(',',$chilArr);
    return $chilStr;
}
function deal_with_arr($userAll,$keys){
    $arr=[];
    foreach($userAll as $k=>$v){
        $arr[$v[$keys]]=$v;
    }
    return $arr;
}
function get_zong1($parId,$userTitle){
    if($userTitle == '总裁' || $userTitle == '董事'){
        return '无';
    }
    return get_title($parId,'总裁',1);
}
function get_dong1($parId,$userTitle){
    if($userTitle == '董事'){
        return '无';
    }
    return get_title($parId,'董事',1);
}
function get_dong2($parId,$userTitle){
    if($userTitle == '董事'){
        return '无';
    }
    return get_title($parId,'董事',2);
}
function get_dong3($parId,$userTitle){
    if($userTitle == '董事'){
        return '无';
    }
    return get_title($parId,'董事',3);
}
function get_title($parentId,$title,$level){
    $mysql=getMysql();
    $user1=$mysql->field('id,parent,title')
        ->where('id="'.$parentId.'"')
        ->select('user');
    if(!empty($user1['0']['title'])){
        if($user1['0']['title'] == $title){
            if($level == 1){
                return $user1['0']['id'];
            }else{
                $level=$level-1;
                return get_title($user1['0']['parent'],$title,$level);
            }
        }else{
            return get_title($user1['0']['parent'],$title,$level);
        }
    }else{
        return ;
    }
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