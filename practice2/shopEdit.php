<?php
session_start();
if(!empty($_POST['shopName'])){
    $post=$_POST;
    require_once('./public/conf.php');
    if(empty($_SESSION['userID'])){
        header('location:userAdd.php');
    }
    $result=$mysql->insert('shopManage',
        [
            'shopType'=>$post['shopType'],
            'shopName'=>$post['shopName'],
            'shopLink'=>$post['shopLink'],
            'shopWang'=>$post['shopWang'],
            'shopPhone'=>$post['shopPhone'],
            'shopQQ'=>$post['shopQQ'],
        ]);
    if ($result){
        die(json_encode(['msg'=>'添加店铺成功','status'=>'ok',]));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'添加店铺失败.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>请选择平台</label>
        <div class="layui-input-block">
            <input type="radio" name="shopType" title="淘宝" value="淘宝">
            <input type="radio" name="shopType" title="天猫" value="天猫">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺名称：</label>
        <div class="layui-input-block">
            <input type="text" name="shopName" lay-verify="required" placeholder="请输入店铺名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺首页网址：</label>
        <div class="layui-input-block">
            <input type="text" name="shopLink" lay-verify="required" placeholder="请输入店铺首页网址" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺掌柜旺旺号：</label>
        <div class="layui-input-block">
            <input type="text" name="shopWang" lay-verify="required" placeholder="请输入店铺掌柜旺旺号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">联系方式：</label>
        <div class="layui-input-block">
            <br/>
            手机号：
            <input type="text" name="shopPhone" lay-verify="required" placeholder="请输入手机号" class="layui-input">
            QQ号：
            <input type="text" name="shopQQ" lay-verify="required" placeholder="请输入QQ号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="shopAdd" id="shopAdd" value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(shopAdd)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'shopAdd.php','/shopManage.php');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>