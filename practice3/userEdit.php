<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['username'])){
    $post=$_POST;
    $result=$mysql->where(array('id'=>$post['userId']))->update('user',
        [
            'username'=>$post['username'],
            'title'=>$post['title'],
        ]);
    if ($result){
        die(json_encode(['msg'=>'修改用户信息成功','status'=>'ok',]));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'修改用户信息失败.','status'=>'error',]));
    }
}
$info=[];
if(!empty($_GET['userId'])){
    $userId=$_GET['userId'];
    $res = $mysql->field(array('id','username','parent','title'))
        ->order(array('id'=>'desc'))
        ->where(array('id'=>$userId,))
        ->select('user');
    $info=$res['0'];
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>用户名称：</label>
        <div class="layui-input-block">
            <input type="text" name="username" value="<?php echo $info['username'];?>" lay-verify="required" placeholder="请输入用户名称" class="layui-input">
        </div>
    </div>
<!--    <div class="layui-form-item">-->
<!--        <label class="layui-form-label"><span style="color:red">*</span>用户上级：</label>-->
<!--        <div class="layui-input-block">-->
<!--            <input type="text" name="parent" value="--><?php //echo $info['parent'];?><!--" lay-verify="required" placeholder="用户上级" class="layui-input">-->
<!--        </div>-->
<!--    </div>-->
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>用户职称：</label>
        <div class="layui-input-block">
            <input type="text" name="title" value="<?php echo $info['title'];?>" lay-verify="required" placeholder="请输入用户职称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="hidden" name="userId" value="<?php echo $info['id'];?>"/>
        <input type="button" lay-submit lay-filter="userEdit" id="userEdit" value="确认修改">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(userEdit)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'userEdit.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>