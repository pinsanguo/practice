<?php
    $userLevel=$_SESSION['userLevel'];
    if(empty($_SESSION['shopUserID'])){
        header('location:userLogin.php');
    }
?>
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" href="javascript:;">
            <span>信箱系统</span>
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
                <a href="javascript:;" lay-tips="留言板" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>留言板</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="leave.php">写留言</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="message.php">收件箱</a>
                    </dd>
<!--                    <dd data-name="console">-->
<!--                        <a lay-href="dealerUser.php">星标留言</a>-->
<!--                    </dd>-->
                    <dd data-name="console">
                        <a lay-href="send.php">已发送</a>
                    </dd>
                </dl>
            </li>
            <?php if($userLevel == 1 || $userLevel == 2){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="管理留言" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>管理留言</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="allMessage.php">全部留言</a>
                    </dd>
                </dl>
            </li>
            <?php }?>
            <?php if($userLevel == 1){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="账号管理" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>账号管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userList.php">账号</a>
                    </dd>
                </dl>
            </li>
            <?php }?>
        </ul>
    </div>
</div>