<?php
session_start();
if(empty($_SESSION['userRole']) || $_SESSION['userRole']!='dealer' || empty($_SESSION['dealerID']) || empty($_SESSION['dealAddress'])){
    //未獲取到經銷商ID信息，重新登陸
    header('location:dealerUserLogin.php');
}
require_once('./public/conf.php');
if(!empty($_POST)){
    $post=$_POST;
    //入庫order表與orderPart表
    $dealerID=$_SESSION['dealerID'];
    if(empty($dealerID)){
        die(json_encode(['msg' => '未獲取到經銷商ID,請重新登陸.', 'status' => 'ok',]));
    }
    $orderDate=date('Y-m-d H:i:s');
    $sql2 = "INSERT INTO orders (dealerID,orderDate,deliveryAddress,status)
    VALUES ('".$dealerID."','".$orderDate."','".$post['deliveryAddress']."',0)";
    $status1=mysqli_query($conn, $sql2);
    $orderID=mysqli_insert_id($conn);
    $sql3 = "INSERT INTO orderpart (orderID,partNumber,quantity,price)
    VALUES ('".$orderID."','".$post['partNumber']."','".$post['number']."','".$post['stockPrice']."')";
    if (mysqli_query($conn, $sql3)){
        die(json_encode(['msg' => '訂單創建成功', 'status' => 'ok',]));
    }
}
if(!empty($_GET['partNumber'])){
    $partNumber=$_GET['partNumber'];
    $sql1 = "SELECT * FROM part where partNumber = ".$partNumber;
    $result1 = mysqli_query($conn, $sql1);
    $num_rows = mysqli_num_rows($result1);
    $adress=$_SESSION['dealAddress'];
}else{
    echo "加载失败";die();
}
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list"
     style="padding: 20px 30px 0 0;">
    <?php
    if ($num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
    ?>
    <div class="layui-form-item">
        <label class="layui-form-label">零件名稱</label>
        <div class="layui-input-inline">
            <input type="text" name="partName" placeholder="零件名稱"
                   class="layui-input" value="<?php echo $row['partName'];?>" readonly>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">零件價格</label>
        <div class="layui-input-inline">
            <input type="text" name="stockPrice" placeholder="零件價格" class="layui-input"
                   value="<?php echo $row['partName'];?>" readonly>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">購買數量</label>
        <div class="layui-input-inline">
            <input type="number" name="number" lay-verify="number" placeholder="購買數量" autocomplete="off" class="layui-input" min="0" max="<?php echo $row['stockQuantity'];?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">送貨地址</label>
        <div class="layui-input-inline">
            <input type="text" name="deliveryAddress" lay-verify="required" placeholder="请输入送貨地址" autocomplete="off" class="layui-input" value="<?php echo $adress;?>">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="hidden" name="partNumber" value="<?php echo $partNumber;?>">
        <input type="button" lay-submit lay-filter="partsView" id="partsView"
               value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit"
               value="确认编辑">
    </div>
    <?php
        }
    } else {
        echo "暂无产品提供";
    }
    ?>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
            ,form = layui.form;
        //监听提交
        form.on('submit(partsView)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'partBuy.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            setTimeout(function (){
                // parent.layer.close(index); //再执行关闭
            },2500);
        });
    });
</script>