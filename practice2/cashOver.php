<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin2.php');
}
if(!empty($_POST['rechBankNo'])){
    $post=$_POST;
    $userId=$_SESSION['shopUserID'];
    $result=$mysql->insert('account',
        [
            'rechBank'=>$post['rechBank'],
            'rechBankNo'=>$post['rechBankNo'],
            'rechBankName'=>$post['rechBankName'],
            'rechBankMoney'=>$post['rechBankMoney'],
            'status'=>1,
            'type'=>2,
            'rechType'=>'reduce',
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
include_once('./public/header.php');
?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
    <legend>银行转账</legend>
</fieldset>
<div style="clear:both;"></div>
<div>
    <div class="width:75%;float:left;">
        <ul class="layui-timeline" style="padding-left: 30px;">
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"></i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">
                        <span style="font-size:30px;">①</span>
                        人工审核
                    </h3>
                    <p style="color:red;font-size:17px;">
                        早上9:00到晚上9:00审核（着急可以联系客服微信）
                    </p>
                    <br/>
                    <p style="font-size:17px;">
                        提交转账信息
                        <span style="color:red;">（请勿频繁提现，每天提现笔数比较多，财务工作量很大，谢谢）</span>
                    </p>
                </div>
            </li>
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"></i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">
                        <span style="font-size:30px;">②</span>
                        银行信息
                    </h3>
                    <p style="color:red;font-size:17px;">
                        <div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width:15%;"><span style="color:red">*</span>选择转账银行:</label>
                                <div class="layui-input-block" style="margin-left:20%;width:70%;">
                                    <select name="rechBank" lay-filter="rechBank">
                                        <option value=""></option>
                                        <option value="0">请选择转账银行</option>
                                        <option value="招商银行">招商银行</option>
                                        <option value="交通银行">交通银行</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width:15%;"><span style="color:red">*</span>转账银行卡号:</label>
                                <div class="layui-input-block">
                                    <input type="text" name="rechBankNo" lay-verify="required" placeholder="请输入银行卡号" class="layui-input" style="width:70%;">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width:15%;"><span style="color:red">*</span>转账银行卡号姓名:</label>
                                <div class="layui-input-block">
                                    <input type="text" name="rechBankName" lay-verify="required" placeholder="请输入银行卡号姓名" class="layui-input" style="width:70%;">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width:15%;"><span style="color:red">*</span>转出金额(元):</label>
                                <div class="layui-input-block">
                                    <input type="text" name="rechBankMoney" lay-verify="required" placeholder="请输入转出金额" class="layui-input" style="width:70%;">
                                </div>
                            </div>


                            <div class="layui-form-item layui-hide">
                                <input type="button" lay-submit lay-filter="cashOver" id="cashOver" value="确认修改">
                                <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
                            </div>
                        </div>
                    </p>
                </div>
            </li>
        </ul>
    </div>
    <div class="width:23%;float:left;"></div>
</div>
<div style="clear:both;"></div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(cashOver)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'cashOver.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>
