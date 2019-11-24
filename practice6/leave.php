<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['message'])){
    require_once('./public/conf.php');
    $mes=$_POST['message'];
    $rec=$_POST['receive'];
    $send=$_SESSION['shopUserID'];
    $result=$mysql->insert('message',[
        'receive_id'=>$rec,
        'message'=>$mes,
        'send_id'=>$send,
        'addtime'=>date('Y-m-d H:i:s'),
        'status'=>1,
    ]);
    die(json_encode(['msg'=>'留言成功','status'=>'ok',]));
}
require_once('./public/conf.php');
$allUserRes=$mysql->field('id,username,level')
    ->select('user');
$name=$_SESSION['shopUserName'];
?>
<?php include_once('./public/header.php'); ?>
<link href="/public/layuiadmin/style/css/style.css" type="text/css" rel="stylesheet" />
<div id="wrap">
    <h1>Send a message</h1>
    <div id='form_wrap'>
        <form method="post" onsubmit="return false;" lay-filter="layuiadmin-app-form-list">
            <p>Hello,</p>
            <select name="receive">
                <?php foreach($allUserRes as $k=>$v){?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['username'];?></option>
                <?php }?>
            </select>
            <br/>
            <label for="email">Your Message : </label>
            <textarea  name="message" value="Your Message" id="message" ></textarea>
            <p>Best,</p>
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $name?>" id="name" readonly/>
<!--            <label for="email">Email: </label>-->
<!--            <input type="text" name="email" value="" id="email" />-->
            <input type="submit" name ="submit" value="Now, I send, thanks!" lay-submit lay-filter="adminLogin"/>
        </form>
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
            var txt=$('textarea[name="message"]').val();
            var rec=$('select[name="receive"]').val();
            field={message:txt,receive:rec};
            sendAjax(field,'leave.php','#');
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