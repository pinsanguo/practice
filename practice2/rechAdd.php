<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['rechOrderNo'])){
    $post=$_POST;
    $userId=$_SESSION['shopUserID'];
    $result=$mysql->insert('account',
        [
            'rechBank'=>$post['rechBank'],
            'rechOrderNo'=>$post['rechOrderNo'],
            'rechBankNo'=>$post['rechBankNo'],
            'rechBankName'=>$post['rechBankName'],
            'rechBankMoney'=>$post['rechBankMoney'],
            'rechBenJin'=>$post['rechBankMoney'],
            'status'=>1,
            'rechType'=>'add',
            'userId'=>$userId,
            'rechTime'=>date('Y-m-d H:i:s'),
        ]);
    if($result){
        die(json_encode(['msg'=>'添加转账信息成功','status'=>'ok',]));
    }else{
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'添加转账信息失败.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px;"><span style="color:red">*</span>选择转账银行:</label>
        <div class="layui-input-block" style="margin-left:140px;">
            <select name="rechBank" lay-filter="rechBank">
                <option value=""></option>
                <option value="0">请选择转账银行</option>
                <option value="招商银行">招商银行</option>
                <option value="交通银行">交通银行</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px;"><span style="color:red">*</span>转账订单号：</label>
        <div class="layui-input-block" style="margin-left:140px;">
            <input type="text" name="rechOrderNo" lay-verify="required" placeholder="请输入转账订单号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:110px;"><span style="color:red">*</span>转账银行卡号：</label>
        <div class="layui-input-block" style="margin-left:140px;">
            <input type="text" name="rechBankNo" lay-verify="required" placeholder="请输入转账银行卡号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px;"><span style="color:red">*</span>转账银行卡号 姓名:</label>
        <div class="layui-input-block" style="margin-left:140px;">
            <input type="text" name="rechBankName" lay-verify="required" placeholder="转账银行卡号 姓名:" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux" style="color:red!important;">
            （填写你转出银行卡开户账号的姓名，方便财务核对，不要填手机号）
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label" style="width:100px;"><span style="color:red">*</span>转账金额(元):</label>
        <div class="layui-input-block" style="margin-left:140px;">
            <input type="text" name="rechBankMoney" lay-verify="required" placeholder="请输入转账金额" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="rechAdd" id="rechAdd" value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
        ,form = layui.form;
        //监听提交
        form.on('submit(rechAdd)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'rechAdd.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>