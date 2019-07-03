<?php
require_once('./public/conf.php');
if(!empty($_POST['email'])){
    $post=$_POST;
    $sql1 = "SELECT * FROM administrator where email='".$post['email']."'";
    $result2 = mysqli_query($conn, $sql1);
    if (!empty($result2) && mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $password=$row['password'];
            if($password == $post['password']){
                //登陸成功
                session_start();
                $_SESSION['userRole']='admin';
                $_SESSION['email']=$row['email'];
                $_SESSION['firstName']=$row['firstName'];
                $_SESSION['lastName']=$row['lastName'];
                die(json_encode(['msg'=>'登陸系統成功','status'=>'ok',]));
            }else{
                die(json_encode(['msg'=>'請輸入正確密碼','status'=>'error',]));
            }
        }
    }else{
        die(json_encode(['msg'=>'請輸入正確密碼','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>管理員登陸系統</h2>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="email" lay-verify="required"
                       placeholder="電子郵件" class="layui-input">
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
                <a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="adminLogin">登 入</button>
            </div>
        </div>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="javascript:;" target="_blank">經銷商應用程序</a></p>
    </div>
</div>
<?php include_once('./public/footer.php');?>