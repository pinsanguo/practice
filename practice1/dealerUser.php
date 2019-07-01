<?php
require_once('./public/conf.php');
$sql1 = "SELECT * FROM dealer";
$result2 = mysqli_query($conn, $sql1);
?>
<?php include_once('./public/header.php');?>
<link rel="stylesheet" href="/public/layuiadmin/style/admin.css" media="all">
<link rel="stylesheet" href="/public/layuiadmin/style/template.css" media="all">
<div class="layui-fluid layadmin-maillist-fluid">
    <div class="layui-row layui-col-space15">
        <?php
        if (mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_assoc($result2)) {
        ?>
        <div class="layui-col-md4 layui-col-sm6">
            <div class="layadmin-contact-box" >
                <div class="layui-col-md4 layui-col-sm6">
                    <a href="dealerUserEdit.php?dealerId=<?php echo $row['dealerID'];?>">
                        <div class="layadmin-text-center">
<!--                            <img src="/public/layuiadmin/style/res/template/character.jpg">-->
                            <img src="/public/image/1.jpg">
                            <div class="layadmin-maillist-img layadmin-font-blod"><?php echo $row['dealerID'];?></div>
                        </div>
                    </a>
                </div>

                <div class="layui-col-md8 layadmin-padding-left20 layui-col-sm6">
                    <a href="dealerUserEdit.php?dealerId=<?php echo $row['dealerID'];?>">
                        <h3 class="layadmin-title">
                            <strong><?php echo $row['name'];?></strong>
                        </h3>
                        <p class="layadmin-textimg">
                            <i class="layui-icon layui-icon-location"></i>
                            <?php echo $row['address'];?>
                        </p>
                    </a>
                    <div class="layadmin-address">
                        <a href="dealerUserEdit.php?dealerId=<?php echo $row['dealerID'];?>">
                            <strong>經銷商ID:<?php echo $row['dealerID'];?></strong>
                            <br>
                            經銷商名稱:<?php echo $row['name'];?>
                            <br>
                            <addr title="phone">Tel:</addr>
                            <?php echo $row['phoneNumber'];?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>
<?php include_once('./public/footer.php');?>