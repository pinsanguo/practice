<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['name'])){
    $post=$_POST;
    $result=$mysql->where(array('id'=>$post['userId']))->update('user',
        [
            'wangwang'=>$post['wangwang'],
            'adress'=>$post['adress'],
            'sex'=>$post['sex'],
            'age'=>$post['age'],
            'grade'=>$post['grade'],
        ]);
    if ($result){
        die(json_encode(['msg'=>'修改用户信息成功','status'=>'ok',]));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'修改用户信息失败.','status'=>'error',]));
    }
}
$info=[];
$name=$_SESSION['shopUserName'];
$userId=$_SESSION['shopUserID'];
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where(array('id'=>$userId,))
    ->select('user');
$info=$res['0'];

?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>用户名称：</label>
        <div class="layui-input-block">
            <input type="text" readonly name="name" value="<?php echo $info['name'];?>" lay-verify="required" placeholder="请输入用户名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>旺旺号:</label>
        <div class="layui-input-block">
            <input type="text" name="wangwang" value="<?php echo $info['wangwang'];?>" lay-verify="required" placeholder="请输入旺旺号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>收货城市:</label>
        <div class="layui-input-block">
            <input type="text" name="adress" value="<?php echo $info['adress'];?>" lay-verify="required" placeholder="请输入收货城市" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>性别:</label>
        <div class="layui-input-block">
            <input type="text" name="sex" value="<?php echo $info['sex'];?>" lay-verify="required" placeholder="请输入性别" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>年龄:</label>
        <div class="layui-input-block">
            <input type="text" name="age" value="<?php echo $info['age'];?>" lay-verify="required" placeholder="请输入年龄" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>等级:</label>
        <div class="layui-input-block">
            <input type="text" name="grade" value="<?php echo $info['grade'];?>" lay-verify="required" placeholder="请输入等级" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-hide">
        <input type="hidden" name="userId" value="<?php echo $info['id'];?>"/>
        <input type="button" lay-submit lay-filter="editUser" id="editUser" value="确认修改">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(editUser)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'editUser2.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>