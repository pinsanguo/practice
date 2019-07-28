<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
$userId=$_SESSION['shopUserID'];
$userName=$_SESSION['shopUserName'];
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加进货单</button>
            </div>
            <table id="shopList" lay-filter="shopList"></table>
            <script type="text/html" id="rebate">
                {{#
                    var exist=false;
                    var childId= d.userChild;
                    var childArr=childId.split(',');
                    var _userId=d.parent;
                    for(var i = 0; i < childArr.length; i++) {
                        if (childArr[i] == _userId) {
                            exist=true;
                        }
                    }
                }}
                {{#  if(d.userId == d.benren){ }}
                    无返利
                {{#  } else if(d.parent == d.benren){ }}
                    返利 {{ d.amount * d.rebate1}} 元
                {{#  } else if(exist){ }}
                    返利 {{ d.amount * d.rebate2}} 元
                {{#  } else{ }}
                    无返利
                {{#  } }}
            </script>
            <script type="text/html" id="status">
                {{#  if(d.status == 1){ }}
                    待审核
                {{#  } else if(d.status == 2){ }}
                    已通过
                {{#  } }}
            </script>
            <script type="text/html" id="table-content-list">
                <?php if($userName == 'admin'){?>
                <a class="layui-btn layui-btn-normal layui-btn-xs" onclick="updateSale({{d.id}})"><i
                        class="layui-icon layui-icon-edit"></i>审核</a>
                <a class="layui-btn layui-btn-normal layui-btn-xs" onclick="editsale({{d.id}})"><i
                        class="layui-icon layui-icon-edit"></i>修改</a>
                <?php };?>
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

                    //执行 Ajax 后重载
                    /*
                    admin.req({
                      url: 'xxx'
                      //,……
                    });
                    */
                    table.reload('shopList');
                    layer.msg('已删除');
                });
            },
            add: function(){
                layer.open({
                    type: 2
                    ,title: '添加进货单'
                    ,content: 'saleAdd.php'
                    ,maxmin: true
                    ,area: ['100%','60%']
                    ,btn: ['確定', '取消']
                    ,yes: function(index, layero){
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#saleAdd");
                        submit.click();
                    }
                });
            }
        };

        $('.layui-btn.layuiadmin-btn-list').on('click',function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
    function editsale(saleId){
        layer.open({
            type: 2
            ,title: '修改进货单'
            ,content: 'saleEdit.php?saleId='+saleId
            ,maxmin: true
            ,area: ['100%','60%']
            ,btn: ['確定', '取消']
            ,yes: function(index, layero){
                //点击确认触发 iframe 内容中的按钮提交
                var submit = layero.find('iframe').contents().find("#shopEdit");
                submit.click();
            }
        });
    }
    function updateSale(saleId){
        var field={saleId:saleId,updateStatus:2};
        sendAjax2(field,'saleUpdate.php','');
    }
</script>
<script>
    layui.define(["table", "form"],
        function(t) {
            var e = layui.$,
                i = layui.table,
                n = layui.form;
            i.render({
                elem: "#shopList",
                url: "saleContent.php",
                cols: [[{
                    type: "checkbox",
                    fixed: "left"
                },
                    {
                        field: "sale_name",
                        title: "商品名称",
                        width:100,
                    },
                    {
                        field: "userName",
                        title: "用户信息",
                        width:100,
                    },
                    {
                        field: "userTitle",
                        title: "职称",
                        width:100,
                    },
                    {
                        field: "userParent",
                        title: "上级推荐人",
                        width:100,
                    },
                    {
                        field: "sale_price",
                        title: "进货单价",
                        width:100,
                        height: 80,
                        sort: !0
                    },
                    {
                        field: "number",
                        title: "进货数量",
                        width:100,
                        height: 80,
                        sort: !0
                    },
                    {
                        field: "amount",
                        title: "进货总价",
                        width:100,
                        height: 80,
                        sort: !0
                    },
                    {
                        field: "rebate",
                        title: "返利",
                        toolbar: "#rebate",
                        width:100
                    },
                    {
                        field: "status",
                        title: "状态",
                        toolbar: "#status",
                        width:100
                    },
                    {
                        title: "操作",
                        width:150,
                        align: "center",
                        toolbar: "#table-content-list"
                    }]],
                page: !0,
                limit: 10,
                limits: [10, 15, 20, 25, 30],
                // text: "66666666",
                text: {none: '一条数据也没有^_^'},

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
    function sendAjax2(field,url,goUrl){
        layui.use('jquery', function(){
            var $ = layui.$ //重点处
            $.ajax({
                url:url,
                type:'POST',
                data:field,
                dataType:'json',
                success:function(data){
                    if(data.status == 'ok'){
                        layer.msg(data.msg,);
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