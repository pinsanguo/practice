<?php $userRole=$_SESSION['userRole'];?>
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
            <?php if($userRole == 'dealer'){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="經銷商" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>經銷商</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="dealerUser.php">经销商管理</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="dealerUserEdit.php">編輯經銷商</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="partsView.php">下订单</a>
                    </dd>
<!--                    <dd data-name="console">-->
<!--                        <a lay-href="dealerOrder.php?status=1">待處理訂單</a>-->
<!--                    </dd>-->
                    <dd data-name="console">
                        <a lay-href="dealerOrder.php?status=2">確認訂單</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="dealerOrder.php?status=3">已確認訂單</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="dealerUserAdd.php">新增经销商</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="dealerUserLogin.php">登陸經銷商後台</a>
                    </dd>
                </dl>
            </li>
            <?php }?>
            <?php if($userRole == 'admin'){?>
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="管理員" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>管理員</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="partsList.php">零件列表</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="orderList.php?status=1">確認訂單</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="orderList.php">總訂單查詢</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="adminLogin.php">管理員登錄系統</a>
                    </dd>
                </dl>
            </li>
            <?php }?>
        </ul>
    </div>
</div>