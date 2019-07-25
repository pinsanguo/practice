<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" href="javascript:;">
            <span>嘟嘟网系统</span>
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
            <li data-name="dealer" class="layui-nav-item">
                <a href="javascript:;" lay-tips="系统设置" lay-direction="2">
                    <i class="layui-icon layui-icon-template"></i>
                    <cite>系统设置</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console">
                        <a lay-href="userLogin.php">登录</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="userAdd.php">注册</a>
                    </dd>
                    <dd data-name="console">
                        <a lay-href="partsView.php">下订单</a>
                    </dd>
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
        </ul>
    </div>
</div>