<?php
require_once('./public/conf.php');
$dealerId=0;
if(!empty($_POST['deal_name'])){
    $post=$_POST;
    if(!empty($post['password'])){
        if(empty($post['repass'])){
            die(json_encode(['msg'=>'請輸入確認密碼','status'=>'error',]));
        }
        if($post['password'] != $post['repass']){
            die(json_encode(['msg'=>'兩次輸入密碼不一致','status'=>'error',]));
        }
        $sq5 = 'UPDATE dealer SET `name`="'.$post["deal_name"].'",phoneNumber="'.$post["cellphone"].'" 
        ,address="'.$post["deal_adress"].'",password="'.$post["password"].'" WHERE dealerID="'.$post['deal_ID'].'"';
        $retval = mysqli_query( $conn, $sq5 );
        if(! $retval )
        {
            die(json_encode(['msg'=>'更新數據失敗','status'=>'error',]));
        }
        die(json_encode(['msg'=>'更新數據成功','status'=>'ok',]));
    }
    $sql6 = 'UPDATE dealer SET `name`="'.$post["deal_name"].'",phoneNumber="'.$post["cellphone"].'" 
        ,address="'.$post["deal_adress"].'" WHERE dealerID="'.$post['deal_ID'].'"';
    $retval6 = mysqli_query( $conn, $sql6 );
    die(json_encode(['msg'=>'更新數據成功','status'=>'ok',]));
}
if(!empty($_GET['dealerId']) || !empty($_SESSION['dealerId'])){
    $dealerId=!empty($_SESSION['dealerId'])?$_SESSION['dealerId']:$dealerId;
    $dealerId=!empty($_GET['dealerId'])?$_GET['dealerId']:$dealerId;
    $sql3 = "SELECT * FROM dealer where dealerID='".$dealerId."'";
    $result3 = mysqli_query($conn, $sql3);
}else{
    header('Location:dealerUser.php');
}
?>
<?php include_once('./public/header.php'); ?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/login.css" media="all">
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;padding: 50px 0;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>編輯經銷商</h2>
        </div>
        <?php
        if (mysqli_num_rows($result3) > 0) {
        while($row = mysqli_fetch_assoc($result3)) {
        ?>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                <input type="text" name="deal_ID" lay-verify="required" placeholder="經銷商ID"
                       class="layui-input" value="<?php echo $row['dealerID'];?>" readonly>
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                <input type="text" name="deal_name" lay-verify="required" placeholder="經銷商名稱"
                       class="layui-input" value="<?php echo $row['name'];?>">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-cellphone"
                       for="LAY-user-login-cellphone"></label>
                <input type="text" name="cellphone" id="LAY-user-login-cellphone" lay-verify="phone"
                       placeholder="手機" class="layui-input" value="<?php echo $row['phoneNumber'];?>">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-location"></label>
                <input type="text" name="deal_adress" lay-verify="required" placeholder="經銷商地質"
                       class="layui-input" value="<?php echo $row['address'];?>">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-repass"></label>
                <input type="password" name="repass" placeholder="确认密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="dealerUserEdit">提 交</button>
            </div>
        </div>
        <?php  } } ?>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="javascript:;" target="_blank">經銷商應用程序</a></p>
    </div>
</div>
<?php include_once('./public/footer.php');?>