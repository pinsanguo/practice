<script src="/public/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/public/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'console','user'],function(){
        var $ = layui.$
        ,setter = layui.setter
        ,admin = layui.admin
        ,form = layui.form
        ,router = layui.router();

        form.render();
        //編輯經銷商提交
        form.on('submit(dealerUserEdit)', function(obj){
            var field = obj.field;
            sendAjax(field,'dealerUserEdit.php','/dealerUser.php');
        });
        //管理員登陸系統
        form.on('submit(adminLogin)', function(obj){
            var field = obj.field;
            sendAjax(field,'adminLogin.php','/index.php');
        });
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
                        layer.alert(data.msg, {
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
<?php
mysqli_close($conn);
?>