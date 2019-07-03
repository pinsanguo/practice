<?php
session_start();
require_once('./public/conf.php');
if(!empty($_POST['partName'])){
    $post=$_POST;
    $email=$_SESSION['email'];
    if(!empty($post['stockStatus']) && $post['stockStatus']=='on'){
        $stockStatus=1;
    }else{
        $stockStatus=0;
    }
    $sql = 'UPDATE part SET `email`="'.$email.'",partName="'.$post["partName"].'" ,stockQuantity="'.$post["stockQuantity"].'",stockPrice="'.$post["stockPrice"].'",stockStatus="'.$stockStatus.'" WHERE partNumber="'.$post['partNumber'].'"';
    if (mysqli_query($conn, $sql)){
        die(json_encode(['msg'=>'編輯零件成功','status'=>'ok',]));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'編輯零件失敗.','status'=>'error',]));
    }
}
if(!empty($_GET['partNumber']) || empty($_SESSION['email'])){
    $id=$_GET['partNumber'];
    $sql3 = "SELECT * FROM part where partNumber='".$id."'";
    $result3 = mysqli_query($conn, $sql3);
}else{
    header('location:adminLogin.php');
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <?php
    if (mysqli_num_rows($result3) > 0){
    while($row = mysqli_fetch_assoc($result3)){
    ?>
    <div class="layui-form-item">
        <label class="layui-form-label">部件名稱</label>
        <div class="layui-input-inline">
            <input type="text" name="partName" lay-verify="required" placeholder="請輸入部件名稱" autocomplete="off" class="layui-input" value="<?php echo $row['partName'];?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">庫存量</label>
        <div class="layui-input-inline">
            <input type="text" name="stockQuantity" lay-verify="required" placeholder="請輸入庫存量" autocomplete="off" class="layui-input" value="<?php echo $row['stockQuantity'];?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商品價格</label>
        <div class="layui-input-inline">
            <input type="text" name="stockPrice" lay-verify="required" placeholder="請輸入商品價格" autocomplete="off" class="layui-input" value="<?php echo $row['stockPrice'];?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">庫存狀態</label>
        <div class="layui-input-inline">
            <input type="checkbox" lay-verify="required" lay-filter="stockStatus" name="stockStatus" lay-skin="switch" lay-text="可用|不可用"
            <?php  if($row['stockStatus'] == 1){ echo "checked";}?>
            >
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="hidden" value="<?php echo $row['partNumber'];?>" name="partNumber"/>
<!--        <input type="button" lay-submit lay-filter="partsEdit" id="partsEdit" value="确认添加">-->
        <input type="button" lay-submit lay-filter="partsEdit" id="partsEdit" value="确认编辑">
    </div>
    <?php  } } ?>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(partsEdit)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'partsEdit.php','/partsEdit.php?partNumber=<?php echo $_GET['partNumber'];?>');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>