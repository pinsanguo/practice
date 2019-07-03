<?php
session_start();
if(empty($_SESSION['userRole']) || $_SESSION['userRole']!='admin' || empty($_SESSION['email'])){
    header('location:adminLogin.php');
}
?>
<?php include_once('./public/header.php'); ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
<!--                <button class="layui-btn layuiadmin-btn-list" data-type="batchdel">删除</button>-->
                <button class="layui-btn layuiadmin-btn-list" data-type="add">添加零件</button>
            </div>
            <table id="partsList" lay-filter="partsList"></table>
            <script type="text/html" id="buttonTpl">
                {{#  if(d.status){ }}
                <button class="layui-btn layui-btn-xs">已发布</button>
                {{#  } else { }}
                <button class="layui-btn layui-btn-primary layui-btn-xs">待修改</button>
                {{#  } }}
            </script>
            <script type="text/html" id="table-content-list">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                        class="layui-icon layui-icon-edit"></i>編輯</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                        class="layui-icon layui-icon-delete"></i>删除</a>
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
        var checkStatus = table.checkStatus('partsList')
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
          table.reload('partsList');
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
</script>
<script>
layui.define(["table", "form"],
function(t) {
    var e = layui.$,
    i = layui.table,
    n = layui.form;
    i.render({
        elem: "#partsList",
        url: "partsContent.php",
        cols: [[{
            type: "checkbox",
            fixed: "left"
        },
        {
            field: "partNumber",
            width: 100,
            title: "部件號",
            sort: !0
        },
        {
            field: "partName",
            title: "部件名稱",
            minWidth: 100
        },
        {
            field: "stockQuantity",
            title: "庫存量"
        },
        {
            field: "stockPrice",
            title: "商品價格"
        },
        {
            field: "email",
            title: "電子郵件",
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
    i.on("tool(partsList)",
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
</body>
</html>