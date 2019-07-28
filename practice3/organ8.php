<?php
session_start();
if(empty($_SESSION['shopUserName'])){
    header('location:userLogin.php');
}
$userName=$_SESSION['shopUserName'];
$userId=$_SESSION['shopUserID'];
require_once('./public/conf.php');
$data=[
   [
       'title'=>'江西',
       'id'=>1,
       'children'=>[
          [
              'title'=>'南昌',
              'id'=>1000,
              'children'=>[
                  [
                      'title'=>'青山湖区',
                      'id'=>'10001',
                  ],
                  [
                      'title'=>'高新区',
                      'id'=>10002,
                  ],
                  [
                      'title'=>'金水区',
                      'id'=>10003,
                  ],
              ],
          ],
           [
               'title'=>'南昌2',
               'id'=>2000,
               'children'=>[
                   [
                       'title'=>'青山湖区2',
                       'id'=>20001,
                   ],
                   [
                       'title'=>'高新区2',
                       'id'=>20002,
                   ],
                   [
                       'title'=>'金水区2',
                       'id'=>20003,
                   ],
               ],
           ],
           [
               'title'=>'南昌2',
               'id'=>2000,
               'children'=>[
                   [
                       'title'=>'青山湖区2',
                       'id'=>20001,
                   ],
                   [
                       'title'=>'高新区2',
                       'id'=>20002,
                   ],
                   [
                       'title'=>'金水区2',
                       'id'=>20003,
                   ],
               ],
           ],
       ],
   ],
];
$res1=$mysql->field('id,username,parent')
    ->where('id="'.$userId.'"')
    ->select('user');
$organ=[];
foreach($res1 as $k=>$v){
    $organ[]=[
        'title'=>$v['username'],
        'id'=>$v['id'],
        'children'=>getChild($v['id']),
    ];
}
function getChild($id){
    require_once('./public/conf.php');
    $mysql=getMysql();
    $res1=$mysql->field('id,username,parent')
        ->where('parent="'.$id.'"')
        ->select('user');
    $ret=[];
    foreach($res1 as $k=>$v){
        $ret[]=[
            'title'=>$v['username'],
            'id'=>$v['id'],
            'children'=>getChild($v['id']),
        ];
    }
    return $ret;
}
$data1=json_encode($organ);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/public/layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div style="width:50%;margin:0 auto;">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>组织结构</legend>
    </fieldset>
    <div id="test13" class="demo-tree-more"></div>
</div>
<script src="/public/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use(['tree', 'util'], function(){
        var tree = layui.tree
            ,layer = layui.layer
            ,util = layui.util
            //模拟数据1
            ,data1 = <?php echo $data1;?>;

        //无连接线风格
        tree.render({
            elem: '#test13'
            ,data: data1
            ,showLine: false  //是否开启连接线
        });
    });
</script>
</body>
</html>