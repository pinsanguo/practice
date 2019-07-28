<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['shopName'])){
    $post=$_POST;
    $result=$mysql->where(array('id'=>$post['shopId']))->update('shopManage',
        [
            'shopType'=>$post['shopType'],
            'shopName'=>$post['shopName'],
            'shopLink'=>$post['shopLink'],
            'shopWang'=>$post['shopWang'],
            'shopPhone'=>$post['shopPhone'],
            'shopQQ'=>$post['shopQQ'],
        ]);
    if ($result){
        die(json_encode(['msg'=>'修改店铺成功','status'=>'ok',]));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'修改店铺失败.','status'=>'error',]));
    }
}
$info=[];
if(!empty($_GET['shopId'])){
    $shopId=$_GET['shopId'];
    $res = $mysql->field(array('id','shopType','shopName','shopLink','shopWang','shopPhone','shopQQ'))
        ->order(array('id'=>'desc'))
        ->where(array('id'=>$shopId,))
        ->select('shopManage');
    $info=$res['0'];
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>请选择平台</label>
        <div class="layui-input-block">
            <input type="radio" name="shopType" title="淘宝" value="淘宝"
                <?php echo $info['shopType'] == '淘宝'?"checked":'';?>>
            <input type="radio" name="shopType" title="天猫" value="天猫"
                <?php echo $info['shopType'] == '天猫'?"checked":'';?>>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺名称：</label>
        <div class="layui-input-block">
            <input type="text" name="shopName" value="<?php echo $info['shopName'];?>" lay-verify="required" placeholder="请输入店铺名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺首页网址：</label>
        <div class="layui-input-block">
            <input type="text" name="shopLink" value="<?php echo $info['shopLink'];?>" lay-verify="required" placeholder="请输入店铺首页网址" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>店铺掌柜旺旺号：</label>
        <div class="layui-input-block">
            <input type="text" name="shopWang" value="<?php echo $info['shopWang'];?>" lay-verify="required" placeholder="请输入店铺掌柜旺旺号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">联系方式：</label>
        <div class="layui-input-block">
            <br/>
            手机号：
            <input type="text" name="shopPhone" value="<?php echo $info['shopPhone'];?>" lay-verify="required" placeholder="请输入手机号" class="layui-input">
            QQ号：
            <input type="text" name="shopQQ" value="<?php echo $info['shopQQ'];?>" lay-verify="required" placeholder="请输入QQ号" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="hidden" name="shopId" value="<?php echo $info['id'];?>"/>
        <input type="button" lay-submit lay-filter="shopEdit" id="shopEdit" value="确认修改">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(shopEdit)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'shopEdit.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>