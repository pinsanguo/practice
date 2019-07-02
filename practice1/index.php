<?php
session_start();
if(empty($_SESSION['userRole']) || $_SESSION['userRole']!='admin'){
    header('location:adminLogin.php');
}
?>
<?php include_once('./public/header.php');?>
<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <?php include_once('./public/top.php');?>
        </div>

        <!-- 侧边菜单 -->
        <?php include_once('./public/menu.php');?>

        <!-- 页面标签 -->
        <?php include_once('./public/tab.php');?>

        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="console.php" frameborder="0" class="layadmin-iframe"></iframe>
<!--                <iframe src="/public/views/home/console.html" frameborder="0" class="layadmin-iframe"></iframe>-->
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>
<?php include_once('./public/footer.php');?>