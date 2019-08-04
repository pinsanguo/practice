<?php
session_start();
if(empty($_SESSION['shopUserName'])){
    header('location:userLogin.php');
}
$name=$_SESSION['shopUserName'];
$userId=$_SESSION['shopUserID'];
include_once('./public/header.php');
?>
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
<div class="layui-fluid layadmin-homepage-fluid">
    <div class="layui-row layui-col-space8">
        <div class="layui-col-md2">
            <div class="layadmin-homepage-panel layadmin-homepage-shadow">
                <div class="layui-card text-center">
                    <div class="layui-card-body">
                        <div class="layadmin-homepage-pad-ver">
                            <img class="layadmin-homepage-pad-img" src="/public/image/portrait.png" width="96" height="96">
                        </div>
                        <h4 class="layadmin-homepage-font"><?php echo $name;?></h4>
                        <p class="layadmin-homepage-min-font">欢迎加入启灵生物科技</p>
                        <div class="layadmin-homepage-pad-ver">
                            <a href="javascript:;" class="layui-icon layui-icon-cellphone"></a>
                            <a href="javascript:;" class="layui-icon layui-icon-vercode"></a>
                            <a href="javascript:;" class="layui-icon layui-icon-login-wechat"></a>
                            <a href="javascript:;" class="layui-icon layui-icon-login-qq"></a>
                        </div>
                        <textarea id="copy" style="opacity: 0;display:block;" readonly>http://140.143.245.188/userAdd.php?send=<?php echo $userId;?></textarea>
                        <button class="layui-btn" onclick="copyLink()">复制推广链接</button>
                    </div>
                </div>
                <script>
                    function copyLink(){
                        var e = document.getElementById("copy");
                        e.select();
                        document.execCommand("Copy");
                        layer.msg('复制推广链接成功');
                    }
                </script>
<!--                <p class="layadmin-homepage-about">-->
<!--                    关于我-->
<!--                </p>-->
<!--                <ul class="layadmin-homepage-list-group">-->
<!--                    <li class="list-group-item"><i class="layui-icon layui-icon-location"></i>中国上海</li>-->
<!--                    <li class="list-group-item"><a href="javascript:;" class="color"><i class="layui-icon layui-icon-snowflake"></i><span style="word-wrap:break-word;">https://weibo.com/hu_ge</span></a></li>-->
<!--                </ul>-->
<!--                <div class="layadmin-homepage-pad-hor">-->
<!--                    <mdall>胡歌喜欢摄影，也喜欢写字，他视角独特，充满着奇思妙想。他有着极丰富的情感，和对生活的热情，他能点燃观众心中爱的火焰；胡歌积极、乐观、坚强，他脚踏实地地做好每一件事，真诚地对待身边每一个人</mdall>-->
<!--                </div>-->
<!--                <p class="layadmin-homepage-about">-->
<!--                    技能-->
<!--                </p>-->
<!--                <ul class="layadmin-homepage-list-inline">-->
<!--                    <a href="javascript:;" class="layui-btn layui-btn-primary">演员</a>-->
<!--                    <a href="javascript:;" class="layui-btn layui-btn-primary">主持人</a>-->
<!--                    <a href="javascript:;" class="layui-btn layui-btn-primary">摄影师</a>-->
<!--                    <a href="javascript:;" class="layui-btn layui-btn-primary">导演</a>-->
<!--                    <a href="javascript:;" class="layui-btn layui-btn-primary">公共人物</a>-->
<!--                </ul>-->
            </div>
        </div>
    </div>
</div>
<?php include_once('./public/footer.php');?>