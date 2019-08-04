<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}

if(!empty($_POST['username'])){
    $post=$_POST;
    $res1=$mysql->field('id,username')
        ->where('username="'.$post['username'].'"')
        ->select('user');
    if(empty($res1)){
        die(json_encode(['msg'=>'账户不存在','status'=>'error']));
    }
    if($post['password'] != $post['repass']){
        die(json_encode(['msg'=>'两次输入的密码不一致','status'=>'error']));
    }
    $result=$mysql->where(array('id'=>$post['userId']))->update('user',
        [
            'password'=>$post['password'],
        ]);
    if ($result){
        die(json_encode(['msg'=>'success','status'=>'ok',]));
    } else {
        die(json_encode(['msg'=>'修改密码失败.','status'=>'error',]));
    }
}
$info=[];
$userId=$_SESSION['shopUserID'];
$res = $mysql->field(array('id','username','parent','title'))
    ->order(array('id'=>'desc'))
    ->where(array('id'=>$userId,))
    ->select('user');
$info=$res['0'];
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;padding: 50px 0;background-color:#FFFFFF;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header" style="padding-bottom:0px;">
            <h2>修改密码</h2>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone"
                       for="LAY-user-login-cellphone"></label>
                <input type="text" name="username" placeholder="用户名" readonly value="<?php echo $info['username'];?>" class="layui-input">
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
                <input type="hidden" name="userId" value="<?php echo $info['id'];?>"/>
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-reg-submit">立刻提交</button>
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

            //请求接口
            $.ajax({
                url:'/password.php',
                type:'POST',
                data:field,
                dataType:'json',
                success:function(data){
                    console.log(data.msg);
                    if(data.status == 'ok'){
                        layer.msg('修改成功');
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
