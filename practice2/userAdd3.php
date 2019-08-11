<?php
if(!empty($_POST['cellphone'])){
    $post=$_POST;
    require_once('./public/conf.php');
    $res1=$mysql->field('id,name')
        ->where('name="'.$post['cellphone'].'"')
        ->select('user');
    if(!empty($res1)){
        die(json_encode(['msg'=>'该手机账户已存在','status'=>'error']));
    }
    if($post['password'] != $post['repass']){
        die(json_encode(['msg'=>'两次输入的密码不一致','status'=>'error']));
    }
    $result=$mysql->insert('user',
        [
            'name'=>$post['cellphone'],
            'password'=>$post['password'],
            'type'=>2,
        ]);
    if ($result){
        die(json_encode(['msg'=>'success','status'=>'ok',]));
    } else {
        die(json_encode(['msg'=>'添加账户失败.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php'); ?>
    <link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;padding: 50px 0;background-color:#FFFFFF;">
        <div class="layadmin-user-login-main">
            <div class="layadmin-user-login-box layadmin-user-login-header" style="padding-bottom:0px;">
                <h2><img src="public/image/logo2.png" /></h2>
            </div>
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone"
                           for="LAY-user-login-cellphone"></label>
                    <input type="text" name="cellphone" id="LAY-user-login-cellphone" lay-verify="phone"
                           placeholder="手机号" value="18838063951"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-location"></label>
                    <input type="text" name="ver_code" lay-verify="required" placeholder="验证码"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                           for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" lay-verify="pass"
                           placeholder="密码"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                           for="LAY-user-login-repass"></label>
                    <input type="password" name="repass" id="LAY-user-login-repass" lay-verify="required"
                           placeholder="确认密码"
                           class="layui-input">
                </div>
                <div class="layui-form-item">
                    <input type="checkbox" name="agreement" lay-skin="primary" title="同意用户协议" checked>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-reg-submit">立刻注册</button>
                </div>
                <div class="layui-trans layui-form-item layadmin-user-login-other">
                    <label>已有账户，请登录</label>
                    <a href="userLogin3.php"
                       class="layadmin-user-jump-change layadmin-link layui-hide-xs">登录</a>
                </div>
            </div>
        </div>
    </div>
<script src="/public/layuiadmin/layui/layui.js"></script>
</body>
</html>
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
    ,router = layui.router();

    form.render();

    //提交
    form.on('submit(LAY-user-reg-submit)', function(obj){
      var field = obj.field;

      //确认密码
      if(field.password !== field.repass){
        return layer.msg('两次密码输入不一致');
      }

      //是否同意用户协议
      if(!field.agreement){
        return layer.msg('你必须同意用户协议才能注册');
      }

      //请求接口
      $.ajax({
        url:'/userAdd3.php',
        type:'POST',
        data:field,
        dataType:'json',
        success:function(data){
          console.log(data.msg);
            if(data.status == 'ok'){
                layer.msg('注册成功',{
                    offset: '15px'
                    ,icon: 1
                    ,time: 1000
                }, function(){
                    location.hash = 'userLogin2.php'; //跳转到登入页
                });
                setTimeout(function () {
                    window.location.href="userLogin2.php";
                },2100);
            }else{
                layer.alert(data.msg, {
                      title:'添加結果'
                });
            }
        }
      });
      return false;
    });
  });
</script>
