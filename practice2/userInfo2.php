<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin2.php');
}
require_once('./public/conf.php');
$name=$_SESSION['shopUserName'];
$userId=$_SESSION['shopUserID'];
$info=[];
$res = $mysql->field('*')
    ->where('id="'.$userId.'" and type = 2 ')
    ->select('user');
$info=!empty($res['0'])?$res['0']:[];
include_once('./public/header.php');
?>
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
<div class="layui-fluid layadmin-homepage-fluid">
    <div class="layui-row layui-col-space8">
        <div class="layui-col-md2" style="width:90%;">
            <div class="layadmin-homepage-panel layadmin-homepage-shadow">
                <p class="layadmin-homepage-about">
                    用户信息
                </p>
                <div class="layadmin-homepage-pad-hor">
                    <?php $link='http://'.$_SERVER['HTTP_HOST'].'/userLogin2.php';?>
                    <textarea id="copy" style="opacity: 0;display:block;" readonly><?php echo $link;?></textarea>
                    邀请链接：<?php echo $link;?>
                    <button onclick="copyLink()" class="layui-btn layui-btn-fluid" style="width:auto;">点击复制</button>
                    <script>
                        function copyLink(){
                            var e = document.getElementById("copy");
                            e.select();
                            document.execCommand("Copy");
                            layer.msg('复制推广链接成功');
                        }
                    </script>
                </div>
                <div class="layadmin-homepage-pad-hor">
                    <mdall style="color:red;">（邀请成功用户，每完成一单，奖励一元。）</mdall>
                </div>
                <div class="layadmin-homepage-pad-hor">
                    <mdall></mdall>
                </div>
                <p class="layadmin-homepage-about">
                    完善信息（完善信息才能申请任务哟）
                    <button onclick="editUser()" class="layui-btn layui-btn-fluid" style="width:auto;">编辑</button>
                </p>
                <ul class="layadmin-homepage-list-inline">
                    <a href="javascript:;" class="layui-btn layui-btn-primary">账 户:<?php echo $info['name'];?></a>
                    <a href="javascript:;" class="layui-btn layui-btn-primary">用户ID:<?php echo $info['id'];?></a>
                    <br/>
                    <a href="javascript:;" class="layui-btn layui-btn-primary"> 旺 旺 号：<?php echo $info['wangwang'];?></a>
                    <a href="javascript:;" class="layui-btn layui-btn-primary"> 淘气值：<?php echo $info['grade'];?></a>
                    <br/>
                    <a href="javascript:;" class="layui-btn layui-btn-primary">收货城市：<?php echo $info['adress'];?></a>
                    <a href="javascript:;" class="layui-btn layui-btn-primary"> 性    别：<?php echo $info['sex'];?></a>
                    <br/>
                    <a href="javascript:;" class="layui-btn layui-btn-primary">年龄：<?php echo $info['age'];?></a>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function editUser() {
        layer.open({
            type: 2
            ,title: '完善信息'
            ,content: 'editUser2.php'
            ,maxmin: true
            ,area: ['65%','80%']
            ,btn: ['確定', '取消']
            ,yes: function(index, layero){
                //点击确认触发 iframe 内容中的按钮提交
                var submit = layero.find('iframe').contents().find("#editUser");
                submit.click();
            }
        });
    }
</script>
<?php include_once('./public/footer.php');?>