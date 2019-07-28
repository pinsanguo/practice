<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-list" data-type="recharge">转账流程</button>
                <button class="layui-btn layuiadmin-btn-list" data-type="add">提交转账信息</button>
            </div>
            <table id="shopList" lay-filter="shopList"></table>
            <script type="text/html" id="table-content-list">
<!--                <a class="layui-btn layui-btn-normal layui-btn-xs" onclick="recharge2({{d.id}})"><i-->
<!--                            class="layui-icon layui-icon-edit"></i>账户明细</a>-->
            </script>
        </div>
    </div>
</div>
<style>
    .layui-table-cell {
        height:auto;
    }
</style>
<script src="/public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'contlist', 'table'], function(){
        var table = layui.table
            ,form = layui.form;

        var $ = layui.$, active = {
            batchdel: function(){
                var checkStatus = table.checkStatus('shopList')
                    ,checkData = checkStatus.data; //得到选中的数据
                if(checkData.length === 0){
                    return layer.msg('请选择数据');
                }
                layer.confirm('确定删除吗？', function(index) {
                    table.reload('shopList');
                    layer.msg('已删除');
                });
            },
            add: function(){
                layer.open({
                    type: 2
                    ,title: '提交转账信息（请勿通过支付宝，微信转账）'
                    ,content: 'rechAdd.php'
                    ,maxmin: true
                    ,area: ['65%','80%']
                    ,btn: ['確定', '取消']
                    ,yes: function(index, layero){
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#rechAdd");
                        submit.click();
                    }
                });
            },
            recharge: function(){
                layer.open({
                    type: 2
                    ,title: '转账流程'
                    ,content: 'rechDetail.php'
                    ,maxmin: true
                    ,area: ['70%','96%']
                    ,btn: ['確定', '取消']
                    ,yes: function(index, layero){
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#shopEdit");
                        submit.click();
                    }
                });
            },
        };

        $('.layui-btn.layuiadmin-btn-list').on('click',function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
    function recharge2(rechId){
        layer.open({
            type: 2
            ,title: '账户明细'
            ,content: 'rechDetail.php?rechId='+rechId
            ,maxmin: true
            ,area: ['70%','96%']
            ,btn: ['確定', '取消']
            ,yes: function(index, layero){
                //点击确认触发 iframe 内容中的按钮提交
                var submit = layero.find('iframe').contents().find("#shopEdit");
                submit.click();
            }
        });
    }
</script>
<script>
    layui.define(["table", "form"],
        function(t){
            var e = layui.$,
                i = layui.table,
                n = layui.form;
            i.render({
                elem: "#shopList",
                url: "rechAccount.php",
                cols: [[{
                    type: "checkbox",
                    fixed: "left"
                    },
                    {
                        field: "rechTime",
                        title: "时间",
                        width:200,
                        sort: !0
                    },
                    {
                        field: "rechNote",
                        title: "备注",
                        templet: "#rechNote",
                    },
                    {
                        field: "rechAccount",
                        title: "账户",
                        width:150,
                    },
                    {
                        field: "rechBenJin",
                        title: "交易本金",
                        width:150,
                    },
                    {
                        field: "rechBlance",
                        title: "余额",
                        width:150,
                    },
                    {
                        title: "操作",
                        width:150,
                        align: "center",
                        fixed: "right",
                        toolbar: "#table-content-list"
                    }]],
                page: !0,
                limit: 10,
                limits: [10, 15, 20, 25, 30],
                text: "对不起，加载出现异常！"
            }),
                i.on("tool(shopList)",
                    function(t) {
                        var e = t.data;
                        "del" === t.event ? layer.confirm("确定删除此零件？",
                            function(e) {
                                t.del(),
                                    layer.close(e)
                            }) : "edit" === t.event && layer.open({
                            type: 2,
                            title: "編輯零件",
                            content: "partsEdit.php?partNumber="+e.partNumber,
                            maxmin: !0,
                            area: ["550px", "550px"],
                            btn: ["确定", "取消"],
                            yes: function(index, layero) {
                                //点击确认触发 iframe 内容中的按钮提交
                                var submit = layero.find('iframe').contents().find("#partsEdit");
                                submit.click();
                            }
                        })
                    }),
                t("contlist", {})
        });
</script>
<script>
    function sendAjax(field,url,goUrl){
        layui.use('jquery', function(){
            var $ = layui.$ //重点处
            $.ajax({
                url:url,
                type:'POST',
                data:field,
                dataType:'json',
                success:function(data){
                    if(data.status == 'ok'){
                        layer.msg(data.msg,{
                            offset: '15px'
                            ,icon: 1
                            ,time: 1000
                        }, function(){
                            window.location.href=goUrl;
                        });
                    }else{
                        layer.alert(data.msg,{
                            title:'添加結果'
                        });
                    }
                }
            });
        });
    }
</script>
</body>
</html>