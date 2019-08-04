<?php
session_start();
if(empty($_SESSION['shopUserName'])){
    header('location:userLogin.php');
}
$userName=$_SESSION['shopUserName'];
$userId=1;
require_once('./public/conf.php');
$res1=$mysql->field('id,username,parent,title')
    ->where('id="'.$userId.'"')
    ->select('user2');
$organ=[];
foreach($res1 as $k=>$v){
    $organ=[
        'name'=>$v['username'],
        'title'=>!empty($v['title'])?$v['title']:$v['username'],
        'id'=>$v['id'],
        'children'=>getChild($v['id'],0),
    ];
}
function getChild($id,$level){
    require_once('./public/conf.php');
    $mysql=getMysql();
    $res1=$mysql->field('id,username,parent,title')
        ->where('parent="'.$id.'"')
        ->select('user2');
    $ret=[];
    $level++;
    $className='';
    $classArr=['middle-level','product-dept','pipeline1','rd-dept','frontend1','frontend2','frontend3','frontend4','frontend5','frontend6','frontend7','frontend8'];
    $className=$classArr[array_rand($classArr,1)];
//    rd-dept   frontend1
    foreach($res1 as $k=>$v){
        $ret[]=[
            'name'=>$v['username'],
            'title'=>!empty($v['title'])?$v['title']:$v['username'],
            'className'=>$className,
            'id'=>$v['id'],
            'children'=>getChild($v['id'],$level),
        ];
    }
    return $ret;
}
$data1=json_encode($organ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Organization Chart Plugin</title>
    <link rel="stylesheet" href="/public/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/dist/css/jquery.orgchart.css">
    <link rel="stylesheet" href="/public/dist/css/style.css">
    <link rel="stylesheet" href="/public/dist/css/style2.css">
</head>
<body>
<div id="chart-container"></div>
<script type="text/javascript" src="/public/dist/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/dist/js/jquery.orgchart.js"></script>
</body>
</html>
<script>
    'use strict';
    (function($){
        $(function() {
            var datascource = <?php echo $data1;?>;
            var datascource2 = {
                'name': 'Lao Lao',
                'title': 'general manager',
                'children': [
                    { 'name': 'Bo Miao', 'title': 'department manager', 'className': 'middle-level',
                        'children': [
                            { 'name': 'Li Jing', 'title': 'senior engineer', 'className': 'product-dept' },
                            { 'name': 'Li Xin', 'title': 'senior engineer', 'className': 'product-dept',
                                'children': [
                                    { 'name': 'To To', 'title': 'engineer', 'className': 'pipeline1' },
                                    { 'name': 'Fei Fei', 'title': 'engineer', 'className': 'pipeline1' },
                                    { 'name': 'Xuan Xuan', 'title': 'engineer', 'className': 'pipeline1' }
                                ]
                            }
                        ]
                    },
                    { 'name': 'Su Miao', 'title': 'department manager', 'className': 'middle-level',
                        'children': [
                            { 'name': 'Pang Pang', 'title': 'senior engineer', 'className': 'rd-dept' },
                            { 'name': 'Hei Hei', 'title': 'senior engineer', 'className': 'rd-dept',
                                'children': [
                                    { 'name': 'Xiang Xiang', 'title': 'UE engineer', 'className': 'frontend1' },
                                    { 'name': 'Dan Dan', 'title': 'engineer', 'className': 'frontend1' },
                                    { 'name': 'Zai Zai', 'title': 'engineer', 'className': 'frontend1' }
                                ]
                            }
                        ]
                    }
                ]
            };
            $('#chart-container').orgchart({
                'data' : datascource,
                'nodeContent': 'title'
            });
        });
    })(jQuery);
</script>