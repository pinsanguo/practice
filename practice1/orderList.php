<?php
session_start();
$status=!empty($_GET['status'])?$_GET['status']:0;
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <!--                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>-->
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加零件</button>
            </div>
            <table id="orderList" lay-filter="orderList"></table>
            <script type="text/html" id="buttonTpl">
                {{#  if(d.status == 1){ }}
                <button class="layui-btn layui-btn-xs">待處理</button>
                {{#  } else if(d.status == 2){ }}
                <button class="layui-btn layui-btn-xs">待交貨</button>
                {{#  } else if(d.status == 3){ }}
                <button class="layui-btn layui-btn-xs">已完成</button>
                {{#  } else if(d.status == 4){ }}
                <button class="layui-btn layui-btn-xs">已取消</button>
                {{#  } }}
            </script>
            <script type="text/html" id="priceTpl">
                {{d.quantity*d.price}}
            </script>
            <script type="text/html" id="table-content-list">
                {{#  if(d.status == 1){ }}
                <a class="layui-btn layui-btn-normal layui-btn-xs" onclick="confirmOrder({{d.orderID}})"><i
                        class="layui-icon layui-icon-edit"></i>確認訂單</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" onclick="cancleOrder({{d.orderID}})"><i
                        class="layui-icon layui-icon-delete"></i>取消訂單</a>
                {{#  } else if(d.status == 2){ }}
<!--                <a class="layui-btn layui-btn-normal layui-btn-xs" onclick="deliveryOrder({{d.orderID}})"><i-->
<!--                        class="layui-icon layui-icon-edit"></i>交貨</a>-->
                {{#  } else if(d.status == 3){ }}

                {{#  } else if(d.status == 4){ }}
<!--                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i-->
<!--                        class="layui-icon layui-icon-edit"></i>編輯</a>-->
<!--                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i-->
<!--                        class="layui-icon layui-icon-delete"></i>删除</a>-->
                {{#  } }}
            </script>
        </div>
    </div>
</div>
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
                var checkStatus = table.checkStatus('orderList')
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
                    table.reload('orderList');
                    layer.msg('已删除');
                });
            },
            add: function(){
                layer.open({
                    type: 2
                    ,title: '添加零件'
                    ,content: 'partsAdd.php'
                    ,maxmin: true
                    ,area: ['550px', '550px']
                    ,btn: ['確定', '取消']
                    ,yes: function(index, layero){
                        //点击确认触发 iframe 内容中的按钮提交
                        var submit = layero.find('iframe').contents().find("#partsAdd");
                        submit.click();
                    }
                });
            }
        };

        $('.layui-btn.layuiadmin-btn-list').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
    function cancleOrder(orderID){
        var field={orderID:orderID,updateStatus:0};
        sendAjax(field,'orderUpdate.php','');
    }
    function confirmOrder(orderID){
        var field={orderID:orderID,updateStatus:2};
        sendAjax(field,'orderUpdate.php','');
    }
    function deliveryOrder(orderID){
        var field={orderID:orderID,updateStatus:3};
        sendAjax(field,'orderUpdate.php','');
    }
</script>
<script>
    layui.define(["table", "form"],
        function(t) {
            var e = layui.$,
                i = layui.table,
                n = layui.form;
            i.render({
                elem: "#orderList",
                url: "orderContent2.php?status=<?php echo $status;?>",
                cols: [[{
                    type: "checkbox",
                    fixed: "left"
                },
                    {
                        field: "orderID",
                        width: 100,
                        title: "訂單ID",
                        sort: !0
                    },
                    {
                        field: "dealerID",
                        title: "經銷商ID",
                        minWidth: 100
                    },
                    {
                        field: "name",
                        title: "經銷商名稱"
                    },
                    {
                        field: "quantity",
                        title: "數量"
                    },
                    {
                        field: "status",
                        title: "狀態",
                        templet: "#buttonTpl",
                        sort: !0
                    },
                    {
                        field: "price",
                        title: "總價",
                        templet: "#priceTpl",
                        sort: !0
                    },
                    {
                        title: "操作",
                        minWidth: 150,
                        align: "center",
                        fixed: "right",
                        toolbar: "#table-content-list"
                    }]],
                page: !0,
                limit: 10,
                limits: [10, 15, 20, 25, 30],
                text: "对不起，加载出现异常！"
            }),
                i.on("tool(orderList)",
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