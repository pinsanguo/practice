<?php
session_start();
if(empty($_SESSION['shopUserName'])){
    header('location:userLogin.php');
}
$userName=$_SESSION['shopUserName'];
?>
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" href="javascript:;">
            <span>訂購系統</span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
            lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;" lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>主页</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console" class="layui-this">
                        <a lay-href="console.php">控制台</a>
                    </dd>
                </dl>
            </li>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="經銷商" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>經銷商</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="proLink.php">个人中心</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="organ.php">组织结构</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="sale.php">进货管理</a>
                    </dd>
                </dl>
                <?php
                if($userName == 'admin'){
                ?>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="organ3.php">全公司架构</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="organ2.php">组织结构(例子)</a>
                    </dd>
                </dl>
                <?php }?>
            </li>
        </ul>
    </div>
</div>