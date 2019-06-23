<?php
$dealerId=0;
if(!empty($_GET['dealerId']) || !empty($_SESSION['dealerId'])){
    $dealerId=!empty($_SESSION['dealerId'])?$_SESSION['dealerId']:$dealerId;
    $dealerId=!empty($_GET['dealerId'])?$_GET['dealerId']:$dealerId;
}else{
    header('Location:dealerUser.php');
}
if(!empty($_POST['deal_name'])){
    $post=$_POST;
    require_once('./public/conf.php');
    $sql1 = "SELECT * FROM dealer where dealerID='".$post['deal_ID']."'";
    $result2 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result2) > 0) {
        die(json_encode(['msg'=>'該供應商ID已存在','status'=>'error',]));
    }
    $sql = "INSERT INTO dealer (dealerID,password,name,phoneNumber,address)
VALUES ('".$post['deal_ID']."','".$post['password']."','".$post['deal_name']."','".$post['cellphone']."','".$post['deal_adress']."')";
    if (mysqli_query($conn, $sql)){
        die(json_encode(['msg'=>'success','status'=>'ok',]));
    } else {
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'添加供應商失敗.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;padding: 50px 0;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>新增經銷商</h2>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                <input type="text" name="deal_ID" lay-verify="required" placeholder="經銷商ID"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                <input type="text" name="deal_name" lay-verify="required" placeholder="經銷商名稱"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone"
                       for="LAY-user-login-cellphone"></label>
                <input type="text" name="cellphone" id="LAY-user-login-cellphone" lay-verify="phone"
                       placeholder="手機"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-location"></label>
                <input type="text" name="deal_adress" lay-verify="required" placeholder="經銷商地質"
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
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-reg-submit">注 册</button>
            </div>
            <div class="layui-trans layui-form-item layadmin-user-login-other">
                <label>已有賬號,請登錄</label>
                <a href="dealerUserLogin.php"
                   class="layadmin-user-jump-change layadmin-link layui-hide-xs">用已有帐号登入</a>
            </div>
        </div>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="javascript:;" target="_blank">經銷商應用程序</a></p>
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
        url:'/dealerUserAdd.php',
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
                    location.hash = '/dealerUserLogin.php'; //跳转到登入页
                });
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