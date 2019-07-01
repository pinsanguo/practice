<?php
require_once('./public/conf.php');
if(!empty($_POST)){
    $post=$_POST;
    //入庫order表與orderPart表
//     orderID
    $dealerID=0;
    $orderDate=date('Y-m-d H:i:s');
    $sql2 = "INSERT INTO orders (dealerID,orderDate,deliveryAddress,status)
    VALUES ('".$dealerID."','".$orderDate."','".$post['deliveryAddress']."',0)";
    $status1=mysqli_query($conn, $sql2);
    print_r($status1);die();
    $sql3 = "INSERT INTO orderpart (orderID,partNumber,quantity,price)
    VALUES ('".$dealerID."','".$post['partNumber']."','".$post['number']."','".$post['stockPrice']."')";
    $status1=mysqli_query($conn, $sql3);
    if (mysqli_query($conn, $sql2)){
        die(json_encode(['msg' => 'success', 'status' => 'ok',]));
    }
}
if(!empty($_GET['partNumber'])){
    $partNumber=$_GET['partNumber'];
    $sql1 = "SELECT * FROM part where partNumber = ".$partNumber;
    $result1 = mysqli_query($conn, $sql1);
    $num_rows = mysqli_num_rows($result1);
    $adress='';
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

<script src="/public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function () {
        var $ = layui.$
            , form = layui.form;

        //监听提交
        form.on('submit(partsView)', function (data) {
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            // parent.layui.table.reload('LAY-app-content-list'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    })
</script>
</body>
</html>