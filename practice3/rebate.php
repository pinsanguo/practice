<?php
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
require_once('./public/conf.php');
$userId=$_SESSION['shopUserID'];
$userName=$_SESSION['shopUserName'];
$user1=$mysql->field('*')
    ->select('user');
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">返利用户</label>
                    <div class="layui-input-inline">
                        <select name="shopUserID" lay-search="">
                            <option value="">请选择查看返利用户</option>
                            <?php foreach($user1 as $k=>$v){?>
                                <option value="<?php echo $v['id'];?>"><?php echo $v['username'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">用户信息</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" placeholder="请输入" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">职称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" placeholder="请输入" class="layui-input">
                    </div>
                </div>
                <br/>
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">开始时间</label>
                    <div class="layui-input-inline">
                        <input type="text" name="startTime" value="<?php echo date('Y-m-d H:i:s')?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">结束时间</label>
                    <div class="layui-input-inline">
                        <input type="text" name="endTime" value="<?php echo date('Y-m-d H:i:s')?>" placeholder="请输入" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline" style="margin-right:0px;">
                    <label class="layui-form-label" style="width:auto;">时间类型</label>
                    <div class="layui-input-inline">
                        <select name="tiemType">
                            <option value="">请选择时间类型</option>
                            <option value="1">进货日期</option>
                            <option value="2">结算时间</option>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="shopSearch">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="importShop">导出返利明细</button>
                </div>
            </div>
        </div>


        <div class="layui-card-body">
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
                {{#  if(d.meTitle == '董事' && d.userTitle == '董事' && d.is_first == 1){ }}
                {{#  if(d.number >= 200 ){ }}
                {{ d.number * 30}}
                {{#  } else { }}
                {{ d.number * 15}}
                {{#  } }}
                {{#  } else if(d.meTitle == '董事' && d.userTitle == '董事' && d.is_first != 1){ }}
                {{ d.number * 5}}
                {{#  } else if(d.meTitle == '董事' && d.userTitle == '总裁' && d.is_first == 1){ }}
                {{#  if(d.number >= 200 ){ }}
                {{ d.number * 30}}
                {{#  } else { }}
                {{ d.number * 15}}
                {{#  } }}
                {{#  } else if(d.meTitle == '董事' && d.userTitle == '总裁' && d.is_first != 1){ }}
                {{ d.number * 15}}
                {{#  } else if(d.meTitle == '总裁' && d.userTitle == '总裁' && d.is_first == 1){ }}
                {{#  if(d.number >= 200 ){ }}
                {{ d.number * 15 }}
                {{#  } else { }}
                {{ d.number * 5 }}
                {{#  } }}
                {{#  } else if(d.meTitle == '总裁' && d.userTitle == '总裁' && d.is_first != 1){ }}
                {{ d.number * 5}}
                {{#  } else { }}
                {{ d.number * 5}}
                {{#  } }}
                {{#  } else if(d.zong1 == d.benren && d.userTitle!= '总裁'){ }}
                {{ d.number * 15}}
                {{#  } else if(d.dong1 == d.benren && d.userTitle!= '董事'){ }}
                {{ d.number * 15}}
                {{#  } else if(d.dong2 == d.benren && d.userTitle!= '董事'){ }}
                {{ d.number * 5}}
                {{#  } else if(d.dong3 == d.benren && d.userTitle!= '董事'){ }}
                {{ d.number * 3}}
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
        //监听搜索
        form.on('submit(shopSearch)', function(data){
            var field = data.field;
            console.log(field);
            //执行重载
            table.reload('shopList', {
                where: field
            });
        });
        form.on('submit(importShop)', function(data){
            var field = data.field;
            var field2=JSON.stringify(field);
            console.log(field2);
            //执行重载
            window.open("rebateExcel.php?file="+field2);
        });
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
                url: "rebateCont.php",
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
                        width:200
                    },
                    {
                        field: "status",
                        title: "状态",
                        toolbar: "#status",
                        width:100
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