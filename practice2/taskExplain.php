<?php
session_start();
require_once('./public/conf.php');
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin2.php');
}
include_once('./public/header.php');
?>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
    <legend>任务类型说明</legend>
</fieldset>
<div style="clear:both;"></div>
<div>
    <div class="width:75%;float:left;">
        <ul class="layui-timeline" style="padding-left: 30px;">
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"></i>
                <div class="layui-timeline-content layui-text">
                    <h3 class="layui-timeline-title">
                        <span style="font-size:30px;"></span>
                    </h3>
                    <p style="color:red;font-size:17px;">
                        1.淘宝无截图模式：1.找到商品 2.浏览收藏加购 3.提交付款截图及订单号--12小时内返
                        <br/>
                        <br/>
                        2.淘宝常规模式：1.找到商品 2.浏览收藏加购  3.提交付款截图及订单号 4.提交好评截图--货返
                        <br/>
                        <br/>
                        3.淘宝货比三家模式：1.找到商品 2.浏览收藏加购 3.提交货比三家截图 4.提交付款截图及订单号 5.提交好评截图--货返
                        <br/>
                        <br/>
                        4.淘宝打标模式：1.找到商品 2.浏览收藏加购 3.指定日期付款 4.提交付款截图及订单号 5.提交好评截图--货返
                        <br/>
                        <br/>
                        5.淘宝常规猜你喜欢模式：1.找到商品 2.浏览收藏加购 3.提交货比三家截图  3.关闭手淘重新打 开-猜你喜欢找到同类商品截图 （关闭再次打开即会出现）4.提交付款截图及订单号 5.提交好评截图--货返
                        <br/>
                        <br/>
                        6.淘宝常规猜你喜欢秘书：1.找到商品 2.浏览收藏加购 3.提交货比三家截图  3.关闭手淘重新打开-猜你喜欢找到同类商品截图 （关闭再次打开即会出现）4.指定日期付款 5.提交付款截图及订单号 5.提交好评截图--货返
                        <br/>
                        注：任务要求越多，对应佣金越多，请细心按要求完成<br/>
                        特殊佣金：商家经常会有特殊要求，会有额外的特殊佣金，特殊佣金不包含在佣金内。（例：指定好评内容，指定货比三家 任务时需注意是否有特殊内容哟，要仔细哟。  如实际佣金5元 特殊佣金2元 那任务做完拿到的是总佣金是7元）
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
