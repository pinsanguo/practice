<?php
require_once('./public/conf.php');
$sql1 = "SELECT * FROM part where stockStatus = 1 and stockQuantity>0";
$result1 = mysqli_query($conn, $sql1);
$num_rows = mysqli_num_rows($result1);
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
<div class="layui-fluid layadmin-cmdlist-fluid">
    <div class="layui-row layui-col-space30">
        <?php
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                ?>
                <div class="layui-col-md2 layui-col-sm4">
                    <div class="cmdlist-container">
                        <a href="javascript:;" onclick="partBuy(<?php echo $row['partNumber'];?>)">
                            <img src="../../layuiadmin/style/res/template/portrait.png">
                        </a>
                        <a href="javascript:;" onclick="partBuy(<?php echo $row['partNumber'];?>)">
                            <div class="cmdlist-text">
                                <p class="info"><?php echo $row['partName']; ?></p>
                                <div class="price">
                                    <b>￥<?php echo $row['stockPrice']; ?></b>
                                    <p>
                                        ¥
                                        <del><?php echo $row['stockPrice'] + 36; ?></del>
                                    </p>
                                    <span class="flow">
                                        <i class="layui-icon layui-icon-component"></i>
                                        <?php echo $row['stockQuantity']; ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "暂无产品提供";
        }
        ?>
        <div class="layui-col-md12 layui-col-sm12">
            <div id="demo0"></div>
        </div>
    </div>
</div>
<script src="/public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index']);
    layui.use(['laypage', 'layer'], function () {
        var laypage = layui.laypage
            , layer = layui.layer;

        //总页数低于页码总数
        laypage.render({
            elem: 'demo0'
            , count: <?php echo $num_rows;?> //数据总数
        });
    });
    function partBuy(partNumber){
        layer.open({
            type: 2
            ,title: '购买该零件'
            ,content: 'partBuy.php?partNumber='+partNumber
            ,maxmin: true
            ,area: ['550px', '550px']
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //点击确认触发 iframe 内容中的按钮提交
                var submit = layero.find('iframe').contents().find("#partsView");
                submit.click();
            }
        });
    }
</script>
</body>
</html>