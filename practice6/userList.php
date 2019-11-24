<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
$status=!empty($_GET['status'])?$_GET['status']:0;
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <!--                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>-->
<!--                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加留言</button>-->
            </div>
            <table id="orderList" lay-filter="orderList"></table>
            <script type="text/html" id="buttonTpl">
                {{#  if(d.status == 1){ }}
                    <button class="layui-btn layui-btn-xs" onclick="editUser({{d.id}})">编辑</button>
                {{#  } else { }}
                    <button class="layui-btn layui-btn-xs" onclick="editUser({{d.id}})">编辑</button>
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
                    ,title: '添加账号'
                    ,content: 'userAdd.php'
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
    function editUser(mId){
        layer.open({
            type: 2
            ,title: '编辑账号'
            ,content: 'userEdit.php?userId='+mId
            ,maxmin: true
            ,area: ['100%','60%']
            ,btn: ['確定', '取消']
            ,yes: function(index, layero){
                //点击确认触发 iframe 内容中的按钮提交
                var submit = layero.find('iframe').contents().find("#userEdit");
                submit.click();
            }
        });
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
                url: "userCon.php",
                cols: [[{
                    type: "checkbox",
                    fixed: "left"
                },
                    {
                        field: "id",
                        width: 100,
                        title: "ID",
                        sort: !0
                    },
                    {
                        field: "username",
                        title: "名称",
                        minWidth: 100
                    },
                    {
                        field: "level",
                        title: "等级"
                    },
                    {
                        field: "addtime",
                        title: "时间"
                    },
                    {
                        field: "status",
                        title: "狀態",
                        templet: "#buttonTpl",
                        sort: !0
                    }
                    ]],
                page: !0,
                limit: 10,
                limits: [10, 15, 20, 25, 30],
                text: {none: '一条数据也没有^_^'},
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