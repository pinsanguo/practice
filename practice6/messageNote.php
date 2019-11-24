<?php
session_start();
require_once('./public/conf.php');
//if(empty($_SESSION['shopUserID'])){
//    header('location:userLogin.php');
//}
if(!empty($_POST['messageId'])){

}
$info=[];
if(!empty($_GET['mId'])){
    $mId=$_GET['mId'];
    $res = $mysql->field('id,send_id,receive_id,message,addtime,title')
        ->order(array('id'=>'desc'))
        ->where(array('id'=>$mId,))
        ->select('message');
    $info=$res['0'];
}
$allUserRes=$mysql->field('id,username,level')
    ->select('user');
$user=deal_with_arr($allUserRes,'id');
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>发送人：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo $info['send_id'];?>" readonly class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>信件主题：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo $info['title'];?>" readonly class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">留言内容</label>
        <div class="layui-input-inline">
            <textarea  style="width: 400px; height: 150px;" class="layui-textarea"><?php echo $info['message'];?></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>发送时间：</label>
        <div class="layui-input-block">
            <input type="text" value="<?php echo $info['addtime'];?>" readonly class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="hidden" name="messageId" value="<?php echo $info['id'];?>"/>
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