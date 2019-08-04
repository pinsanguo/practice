<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
if(!empty($_POST['sale_name'])){
    $post=$_POST;
    $userId=$_SESSION['shopUserID'];
    $rebate=0;
    $is_first=0;
    //查询是否首次购买
    $res1=$mysql->field('id,sale_name,number')
        ->where('userId="'.$userId.'"')
        ->select('sale');
    if(empty($res1)){
        $is_first=1;
    }
    $result=$mysql->insert('sale',
        [
            'sale_name'=>$post['sale_name'],
            'sale_price'=>$post['sale_price'],
            'number'=>$post['number'],
            'amount'=>$post['number']*$post['sale_price'],
            'userId'=>$userId,
            'rebate'=>$rebate,
            'status'=>1,
            'is_first'=>$is_first,
            'addtime'=>date('Y-m-d H:i:s'),
        ]);
    //拿货200支，自动成为总裁。拿货30支，自动成为联合创始人。拿货5支自动成为合伙人。
    if($post['number'] >= 200){
        $mysql->where(array('id'=>$userId))->update('user',
            [
                'title'=>'总裁',
            ]);
        print_r($mysql->getLastSql());die();
    }else if($post['number'] < 200 && $post['number'] >= 30){
        $mysql->where(array('id'=>$userId))->update('user',
            [
                'title'=>'联合创始人',
            ]);
    }else if($post['number'] < 30 && $post['number'] >= 5){
        $mysql->where(array('id'=>$userId))->update('user',
            [
                'title'=>'合伙人',
            ]);
    }
    if($result){
        die(json_encode(['msg'=>'添加进货单成功','status'=>'ok',]));
    }else{
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'添加进货单失败.','status'=>'error',]));
    }
}
?>
<?php include_once('./public/header.php');?>
<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>商品名称：</label>
        <div class="layui-input-block">
            <input type="text" name="sale_name" value="启灵科技" lay-verify="required" placeholder="请输入商品名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>商品价格：</label>
        <div class="layui-input-block">
            <input type="text" name="sale_price" value="200" lay-verify="required" placeholder="请输入商品价格" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><span style="color:red">*</span>商品数量：</label>
        <div class="layui-input-block">
            <input type="text" name="number" lay-verify="required" placeholder="请输入店铺商品数量" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="saleAdd" id="saleAdd" value="确认添加">
        <input type="button" lay-submit lay-filter="layuiadmin-app-form-edit" id="layuiadmin-app-form-edit" value="确认编辑">
    </div>
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use('form', function(){
        var $ = layui.$
        ,form = layui.form;
        //监听提交
        form.on('submit(saleAdd)', function(data){
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引

            //提交 Ajax 成功后，关闭当前弹层并重载表格
            //$.ajax({});
            sendAjax(field,'saleAdd.php','');
            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
    });
</script>