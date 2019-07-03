<?php
session_start();
if(!empty($_POST['partName'])){
    $post=$_POST;
    require_once('./public/conf.php');
    if(empty($_SESSION['email'])){
        header('location:adminLogin.php');
    }
    $email=$_SESSION['email'];
    if(!empty($post['stockStatus']) && $post['stockStatus']=='on'){
        $stockStatus=1;
    }else{
        $stockStatus=0;
    }
    $sql = "INSERT INTO part (email,partName,stockQuantity,stockPrice,stockStatus)
VALUES ('".$email."','".$post['partName']."','".$post['stockQuantity']."','".$post['stockPrice']."','".$stockStatus."')";
    if (mysqli_query($conn, $sql)){
        die(json_encode(['msg'=>'添加零件成功','status'=>'ok',]));
    } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'添加零件失敗.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label">部件名稱</label>
        <div class="layui-input-inline">
            <input type="text" name="partName" lay-verify="required" placeholder="請輸入部件名稱" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">庫存量</label>
        <div class="layui-input-inline">
            <input type="text" name="stockQuantity" lay-verify="required" placeholder="請輸入庫存量" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商品價格</label>
        <div class="layui-input-inline">
            <input type="text" name="stockPrice" lay-verify="required" placeholder="請輸入商品價格" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">庫存狀態</label>
        <div class="layui-input-inline">
            <input type="checkbox" lay-verify="required" checked lay-filter="stockStatus" name="stockStatus" lay-skin="switch" lay-text="可用|不可用">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="partsAdd" id="partsAdd" value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
        ,form = layui.form;
        //监听提交
        form.on('submit(partsAdd)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'partsAdd.php','/partsAdd.php');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>