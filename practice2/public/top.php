<?php
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin2.php');
}
$userName=$_SESSION['shopUserName'];
$userRole=$_SESSION['userRole'];
$userId=$_SESSION['shopUserID'];
?>
<ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item layadmin-flexible" lay-unselect>
        <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
            <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
        </a>
    </li>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <a href="javascript:;" target="_blank" title="前台">
            <i class="layui-icon layui-icon-website"></i>
        </a>
    </li>
    <li class="layui-nav-item" lay-unselect>
        <a href="javascript:;" layadmin-event="refresh" title="刷新">
            <i class="layui-icon layui-icon-refresh-3"></i>
        </a>
    </li>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search"
               layadmin-event="serach" lay-action="template/search.html?keywords=">
    </li>
</ul>
<ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
    <li class="layui-nav-item" lay-unselect>
        <a href="javascript:;" layadmin-event="message" lay-text="消息中心">
            <i class="layui-icon layui-icon-notice"></i>

            <!-- 如果有新消息，则显示小圆点 -->
            <span class="layui-badge-dot"></span>
        </a>
    </li>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <a href="javascript:;" layadmin-event="theme">
            <i class="layui-icon layui-icon-theme"></i>
        </a>
    </li>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <a href="javascript:;" layadmin-event="note">
            <i class="layui-icon layui-icon-note"></i>
        </a>
    </li>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <a href="javascript:;" layadmin-event="fullscreen">
            <i class="layui-icon layui-icon-screen-full"></i>
        </a>
    </li>
    <li class="layui-nav-item" lay-unselect>
        <a href="javascript:;">
            <cite>admin</cite>
        </a>
        <dl class="layui-nav-child">
            <dd><a lay-href="set/user/info.html">基本资料</a></dd>
            <dd><a lay-href="set/user/password.html">修改密码</a></dd>
            <hr>
            <?php if($userRole == 'shopUser'){?>
                <dd onclick="logout()" style="text-align: center;"><a>退出</a></dd>
            <?php }else if($userRole == 'shopUser2'){?>
                <dd onclick="logout2()" style="text-align: center;"><a>退出</a></dd>
            <?php }?>
        </dl>
    </li>
    <script>
        function logout(){
            window.location.href="userLogin.php";
        }
        function logout2(){
            window.location.href="userLogin2.php";
        }
    </script>
    <li class="layui-nav-item layui-hide-xs" lay-unselect>
        <a href="javascript:;" layadmin-event="about"><i
                class="layui-icon layui-icon-more-vertical"></i></a>
    </li>
    <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
        <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
    </li>
</ul>