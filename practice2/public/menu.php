<?php
session_start();
if(empty($_SESSION['shopUserName'])){
    header('location:userLogin2.php');
}
$userName=$_SESSION['shopUserName'];
$userRole=$_SESSION['userRole'];
$userId=$_SESSION['shopUserID'];
?>
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" href="javascript:;">
            <span>嘟嘟网系统</span>
        </div>
        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
            lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;" lay-tips="主页" lay-direction="2" data-val="<?php echo $userRole;?>">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>主页</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console" class="layui-this">
                        <a lay-href="console.php">控制台</a>
                    </dd>
                </dl>
            </li>
            <?php if($userRole == 'shopUser'){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="发布任务" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>发布任务</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="publishTast.php">发布任务</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="shopManage.php">店铺管理</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="taskManage.php">任务管理</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="recharge.php">账户充值</a>
                    </dd>
                </dl>
            </li>
            <?php }else if($userRole == 'shopUser2'){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="管理中心" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>管理中心</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">完善信息</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="applyTask.php">任务大厅</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="cashOut.php">账号提现</a>
                    </dd>
                </dl>
            </li>
            <?php }else if($userRole == 'shopUser3'){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="账号管理" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>账号管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="/admin/shopUser.php">商家账号</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">用户账号</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">用户审核</a>
                    </dd>
                </dl>
            </li>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="任务管理" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>任务管理</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">商家任务</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">用户任务</a>
                    </dd>
                </dl>
            </li>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="资金审核" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>资金审核</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">商家审核</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">用户审核</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">商家账号设置</a>
                    </dd>
                </dl>
            </li>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="佣金设置" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>佣金设置</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">商家佣金</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">用户佣金</a>
                    </dd>
                </dl>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userInfo2.php">指定任务佣金</a>
                    </dd>
                </dl>
            </li>
            <?php }?>
        </ul>
    </div>
</div>