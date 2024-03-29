<?php
require_once('./public/conf.php');
if(!empty($_POST['username'])){
    $post=$_POST;
    $res = $mysql->field('id,username,password,level')
        ->where('username="'.$post['username'].'"')
        ->select('user');
    if(!empty($res) && !empty($res['0'])){
        $_res=$res['0'];
        if($_res['password'] == $post['password']){
            //登陸成功
            session_start();
            $_SESSION['shopUserID']=$_res['id'];
            $_SESSION['shopUserName']=$_res['username'];
            $_SESSION['userRole']='shopUser';
            $_SESSION['userLevel']=$_res['level'];
            die(json_encode(['msg'=>'登录成功','status'=>'ok',]));
        }else{
            die(json_encode(['msg'=>'账户输入错误','status'=>'error',]));
        }
    }else{
        die(json_encode(['msg'=>'账户输入错误','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>登陆信箱系统</h2>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="username" lay-verify="required"
                       placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                       placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"
                               for="LAY-user-login-vercode"></label>
                        <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required"
                               placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg"
                                 id="LAY-user-get-vercode">
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item" style="margin-bottom: 20px;">
                <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                <a href="javascript:;" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;"></a>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="adminLogin">登 入</button>
            </div>
            <div class="layui-trans layui-form-item layadmin-user-login-other">
                <label><a href="userAdd.php" class="layadmin-user-jump-change layadmin-link">免费注册</a></label>
                <a href="javascript:;" class="layadmin-user-jump-change layadmin-link">忘记密码</a>
            </div>
        </div>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="javascript:;" target="_blank">管理員登陸系統</a></p>
    </div>
</div>
<script src="/public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'user'], function(){
        var $ = layui.$
            ,setter = layui.setter
            ,admin = layui.admin
            ,form = layui.form
            ,router = layui.router()
            ,search = router.search;
        form.render();
        //提交
        form.on('submit(adminLogin)', function(obj){
            var field = obj.field;
            sendAjax(field,'userLogin.php','/index.php');
        });
    });
</script>
<script>
    function sendAjax(field,url,goUrl){
        layui.use('jquery', function(){
            var $ = layui.$ //重点处
            $.ajax({
                url:url,
                type:'POST',
                data:field,
                dataType:'json',
                success:function(data){
                    if(data.status == 'ok'){
                        layer.msg(data.msg,{
                            offset: '15px'
                            ,icon: 1
                            ,time: 1000
                        }, function(){
                            window.location.href=goUrl;
                        });
                    }else{
                        layer.alert(data.msg, {
                            title:'添加結果'
                        });
                    }
                }
            });
        });
    }
</script>
</body>
</html>