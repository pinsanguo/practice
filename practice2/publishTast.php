<?php
require_once('./public/conf.php');
session_start();
if(empty($_SESSION['shopUserID'])){
    header('location:userLogin.php');
}
$userId=$_SESSION['shopUserID'];
if(!empty($_POST['step1_saleName'])){
    $post=$_POST;
    $userId=$_SESSION['shopUserID'];
    $tastId=$post['tastId'];
    if(!empty($post['step3_type'])){
        if($post['step3_type'] == 1){
            if(empty($post['step3_keywords']['0'])){
//                die(json_encode(['status'=>'error','msg'=>'请输入第三步的普通好评任务关键词']));
            }
            if(empty($post['step3_num']['0'])){
//                die(json_encode(['status'=>'error','msg'=>'请输入第三步的普通好评任务订单数']));
            }
            $step3_keywords=json_encode($post['step3_keywords']);
            $step3_num=json_encode($post['step3_num']);
        }else if($post['step3_type'] == 2){
            if(empty($post['step3_words_num'])){
                die(json_encode(['status'=>'error','msg'=>'请输入第三步的指定文本好评单数']));
            }
            $step3_words_con=json_encode($post['step3_words_con']);
        }else if($post['step3_type'] == 3){
            if(empty($post['step3_image_num'])){
//                die(json_encode(['status'=>'error','msg'=>'请输入第三步的指定图文好评单数']));
            }
        }else if($post['step3_type'] == 4){
            if(empty($post['step3_video_num'])){
//                die(json_encode(['status'=>'error','msg'=>'请输入第三步的指定视频好评单数']));
            }
        }
    }
//    step4_limit  第四部千人千面设置
    $step4_limit2='';
    if(!empty($post['step4_limit'])){
        $step4_limit=$post['step4_limit'];
        $step4_limit2=implode(',',$step4_limit);
    }
    if(!empty($tastId)){
        $_res = $mysql->field(array('*'))
            ->order(array('id'=>'desc'))
            ->where(array('userId'=>$userId,'status'=>1,))
            ->select('tast');
        $_info=$_res['0'];
        $result=$mysql->where(array('id'=>$tastId))->update('tast',
            [
                'addTime'=>date('Y-m-d H:i:s'),
                'step1_saleName'=>$post['step1_saleName'],
                'step1_saleLink'=>$post['step1_saleLink'],
                'step1_upload_img'=>$post['step1_upload_img'],
                'step1_option'=>$post['step1_option'],
                'step1_amount_money'=>$post['step1_amount_money'],
                'step1_single_num'=>$post['step1_single_num'],
                'step1_single_money'=>$post['step1_single_money'],
                'step1_phone_money'=>$post['step1_phone_money'],
                'step2_sort'=>!empty($post['step2_sort'])?$post['step2_sort']:'',
                'step2_people_num'=>!empty($post['step2_people_num'])?$post['step2_people_num']:'',
                'step2_price_min'=>!empty($post['step2_price_min'])?$post['step2_price_min']:'',
                'step2_price_max'=>!empty($post['step2_price_max'])?$post['step2_price_max']:'',
                'step2_note'=>!empty($post['step2_note'])?$post['step2_note']:'',
                'step3_type'=>!empty($post['step3_type'])?$post['step3_type']:'',
                'step5_name1'=>!empty($post['step5_name1'])?$post['step5_name1']:'',
                'step5_pass1'=>!empty($post['step5_pass1'])?$post['step5_pass1']:'',
                'step5_link1'=>!empty($post['step5_link1'])?$post['step5_link1']:'',
                'step5_name2'=>!empty($post['step5_name2'])?$post['step5_name2']:'',
                'step5_pass2'=>!empty($post['step5_pass2'])?$post['step5_pass2']:'',
                'step5_link2'=>!empty($post['step5_link2'])?$post['step5_link2']:'',
                'step5_name3'=>!empty($post['step5_name3'])?$post['step5_name3']:'',
                'step5_pass3'=>!empty($post['step5_pass3'])?$post['step5_pass3']:'',
                'step5_link3'=>!empty($post['step5_link3'])?$post['step5_link3']:'',
                'step6_note'=>!empty($post['step6_note'])?$post['step6_note']:'',
                'step3_keywords'=>!empty($step3_keywords)?$step3_keywords:'',
                'step3_num'=>!empty($step3_num)?$step3_num:'',
                'step3_words_num'=>!empty($post['step3_words_num'])?$post['step3_words_num']:$_info['step3_words_num'],
                'step3_words_con'=>!empty($step3_words_con)?$step3_words_con:$_info['step3_words_con'],
                'step3_image_num'=>!empty($post['step3_image_num'])?$post['step3_image_num']:$_info['step3_image_num'],
                'step3_pay_time'=>!empty($post['step3_pay_time'])?$post['step3_pay_time']:$_info['step3_pay_time'],
                'step3_pay_time2'=>!empty($post['step3_pay_time2'])?$post['step3_pay_time2']:$_info['step3_pay_time2'],
                'step3_pub_time'=>!empty($post['step3_pub_time'])?$post['step3_pub_time']:$_info['step3_pub_time'],
                'step3_pub_start'=>!empty($post['step3_pub_start'])?$post['step3_pub_start']:$_info['step3_pub_start'],
                'step3_pub_min'=>!empty($post['step3_pub_min'])?$post['step3_pub_min']:$_info['step3_pub_min'],
                'step3_pub_num'=>!empty($post['step3_pub_num'])?$post['step3_pub_num']:$_info['step3_pub_num'],
                'step4_limit'=>!empty($step4_limit2)?$step4_limit2:$_info['step4_limit'],
            ]);
    }else{
        $result=$mysql->insert('tast',
            [
                'userId'=>$userId,
                'addTime'=>date('Y-m-d H:i:s'),
                'step1_saleName'=>$post['step1_saleName'],
                'step1_saleLink'=>$post['step1_saleLink'],
                'step1_upload_img'=>$post['step1_upload_img'],
                'step1_option'=>$post['step1_option'],
                'step1_amount_money'=>$post['step1_amount_money'],
                'step1_single_num'=>$post['step1_single_num'],
                'step1_single_money'=>$post['step1_single_money'],
                'step1_phone_money'=>$post['step1_phone_money'],
                'step2_sort'=>!empty($post['step2_sort'])?$post['step2_sort']:'',
                'step2_people_num'=>!empty($post['step2_people_num'])?$post['step2_people_num']:'',
                'step2_price_min'=>!empty($post['step2_price_min'])?$post['step2_price_min']:'',
                'step2_price_max'=>!empty($post['step2_price_max'])?$post['step2_price_max']:'',
                'step2_note'=>!empty($post['step2_note'])?$post['step2_note']:'',
                'step3_type'=>!empty($post['step3_type'])?$post['step3_type']:'',
                'step5_name1'=>!empty($post['step5_name1'])?$post['step5_name1']:'',
                'step5_pass1'=>!empty($post['step5_pass1'])?$post['step5_pass1']:'',
                'step5_link1'=>!empty($post['step5_link1'])?$post['step5_link1']:'',
                'step5_name2'=>!empty($post['step5_name2'])?$post['step5_name2']:'',
                'step5_pass2'=>!empty($post['step5_pass2'])?$post['step5_pass2']:'',
                'step5_link2'=>!empty($post['step5_link2'])?$post['step5_link2']:'',
                'step5_name3'=>!empty($post['step5_name3'])?$post['step5_name3']:'',
                'step5_pass3'=>!empty($post['step5_pass3'])?$post['step5_pass3']:'',
                'step5_link3'=>!empty($post['step5_link3'])?$post['step5_link3']:'',
                'step6_note'=>!empty($post['step6_note'])?$post['step6_note']:'',
                'status'=>1,
                'step3_keywords'=>!empty($step3_keywords)?$step3_keywords:'',
                'step3_num'=>!empty($step3_num)?$step3_num:'',
                'step3_words_num'=>!empty($post['step3_words_num'])?$post['step3_words_num']:'',
                'step3_words_con'=>!empty($step3_words_con)?$step3_words_con:'',
                'step3_image_num'=>!empty($post['step3_image_num'])?$post['step3_image_num']:$_info['step3_image_num'],
                'step3_pay_time'=>!empty($post['step3_pay_time'])?$post['step3_pay_time']:$_info['step3_pay_time'],
                'step3_pay_time2'=>!empty($post['step3_pay_time2'])?$post['step3_pay_time2']:$_info['step3_pay_time2'],
                'step3_pub_time'=>!empty($post['step3_pub_time'])?$post['step3_pub_time']:$_info['step3_pub_time'],
                'step3_pub_start'=>!empty($post['step3_pub_start'])?$post['step3_pub_start']:$_info['step3_pub_start'],
                'step3_pub_min'=>!empty($post['step3_pub_min'])?$post['step3_pub_min']:$_info['step3_pub_min'],
                'step3_pub_num'=>!empty($post['step3_pub_num'])?$post['step3_pub_num']:$_info['step3_pub_num'],
                'step4_limit'=>!empty($step4_limit2)?$step4_limit2:$_info['step4_limit'],
            ]);
    }
    die(json_encode(['status'=>'ok','msg'=>'添加数据成功']));
}
$info=[];
$res = $mysql->field(array('*'))
    ->order(array('id'=>'desc'))
    ->where(array('userId'=>$userId,'status'=>1,))
    ->select('tast');
$info=$res['0'];
include_once('./public/header.php');
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>发布手机淘宝无截图任务</title>
<link href="./public/css/bootstrap.min.css" rel="stylesheet">
<link href="./public/css/gloab.css" rel="stylesheet">
<link href="./public/css/index.css" rel="stylesheet">
<link href="./public/css/publishTast.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./public/css/style.css">
<script src="./public/js/jquery-1.11.1.min.js"></script>
<script src="./public/js/register.js"></script>
<body class="bgf4" style="overflow:scroll;">
<div class="login-box f-mt10 f-pb50">
    <div class="main bgf">
        <div class="reg-box-pan display-inline">
            <div class="step">
                <ul>
                    <li class="col-xs-4 on">
                        <span class="num"><em class="f-r5"></em><i>1</i></span>
                        <span class="line_bg lbg-r"></span>
                        <p class="lbg-txt">填写任务信息</p>
                    </li>
                    <li class="col-xs-4">
                        <span class="num"><em class="f-r5"></em><i>2</i></span>
                        <span class="line_bg lbg-l"></span>
                        <span class="line_bg lbg-r"></span>
                        <p class="lbg-txt">支付</p>
                    </li>
                    <li class="col-xs-4">
                        <span class="num"><em class="f-r5"></em><i>3</i></span>
                        <span class="line_bg lbg-l"></span>
                        <p class="lbg-txt">发布成功</p>
                    </li>
                </ul>
            </div>
            <div class="reg-box" id="verifyCheck" style="margin-top:20px;">
                <div class="part1">
                    <div class="alert alert-info" style="width:800px">
                        <p>所有商家都要注意在做标签推广务必严格控制好以下3点：</p>
                        <p>1. <span style="color:red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升
                            级，有些以前没出事不代表现在或以后没事</span>）；目前可以选用平台提供的空包（不要信当地快递网点手动输入的重量，当地网点无法控制包裹
                            在中转站和到达点的重量统计）</p>
                        <p>2. 推广比例一定不要过高，最高最高不能超过40%</p>
                        <p>3. 移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                        <p>4. 推广期间请务必关掉商品淘客佣金，推广过程有诸多不确定因素可能导致产生佣金可能造成您的损失。</p>
                    </div>
                    <from class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list">
                    <section class="htmleaf-container" style="width:800px">
                        <div class="container" style="max-width:800px;margin:50px 0px;">
                            <ul class="payment-wizard">
                                <li class="active">
                                    <div class="wizard-heading">
                                        第一步：填写商品信息
                                        <span class="icon-user"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <!--第一步-->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品名称:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="step1_saleName" value="<?php echo $info['step1_saleName'];?>" lay-verify="required" placeholder="商品名称" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品链接:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="step1_saleLink" value="<?php echo $info['step1_saleLink'];?>" lay-verify="required" placeholder="商品链接" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="step1_msg">注意:选择的店铺核对准确,不要填错链</div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品主图:</label>
                                            <button type="button" class="layui-btn" id="step1_up">商品主图</button>
                                            <br/>
                                            <div class="step1_upload_msg">上传"商品主图",确保与搜索页面展示的图片一致.</div>
                                            <div class="layui-upload-list" id="step1_upload">
                                                <?php if(!empty($info['step1_upload_img'])){?>
                                                    <img src='<?php echo $info['step1_upload_img'];?>'/>
                                                <?php }else{?>
                                                    <img src="/public/image/image.png"/>
                                                <?php }?>
                                                <input type="hidden" name="step1_upload_img" value="<?php echo $info['step1_upload_img'];?>"/>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>拍下规格:</label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step1_option" value="<?php echo $info['step1_option'];?>" lay-verify="required" class="layui-input" style="width:100px;display:inline;">
                                                单品实际成交金额(含快递费):
                                                <input type="text" name="step1_amount_money" value="<?php echo $info['step1_amount_money'];?>" lay-verify="required" class="layui-input" style="width:100px;display:inline;">元
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>每单拍:</label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step1_single_num" value="<?php echo $info['step1_single_num'];?>" lay-verify="required" class="layui-input" style="width:100px;display:inline;">
                                                件  &nbsp; 每单总金额
                                                <input type="text" name="step1_single_money" value="<?php echo $info['step1_single_money'];?>" lay-verify="required" class="layui-input" style="width:100px;display:inline;">元 【不含运费】
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:190px;"><span style="color:red">*</span>手机搜索页面展示价格:</label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step1_phone_money" value="<?php echo $info['step1_phone_money'];?>" lay-verify="required" class="layui-input" style="width:50px;display:inline;">
                                                元,用户拍下时的付款价格,如不同等级买号看到商品价格不同,取最大值
                                            </div>
                                        </div>
                                        <input type="hidden" name="tastId" value="<?php echo $info['id'];?>"/>
                                        <button class="btn-green done">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第二步：设置如何找到商品
                                        <span class="icon-location"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:150px;"><span style="color:red">
                                                    *</span>定位目标商品排序方式:
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="radio" name="step2_sort" value="销量" title="销量"
                                                    <?php if($info['step2_sort'] == '销量'){ echo "checked='checked'";}?>
                                                >
                                                <input type="radio" name="step2_sort" value="综合" title="综合"
                                                    <?php if($info['step2_sort'] == '综合'){ echo "checked='checked'";}?>
                                                >
                                                <input type="radio" name="step2_sort" value="综合直通车" title="综合直通车(强烈建议销量排序,商品位置更稳定更好找)"
                                                    <?php if($info['step2_sort'] == '综合直通车'){ echo "checked='checked'";}?>
                                                >
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:150px;">
                                                <span style="color:red">*</span>商品现有收货人数或付款人数:
                                            </label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step2_people_num" value='<?php echo $info["step2_people_num"]?>' lay-verify="required" class="layui-input" style="width:60px;display:inline;">
                                                人    (此处为手机淘宝销量优先搜索列表页显示的收货人数)
                                            </div>
                                        </div>
                                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                                            <!--<legend>基础效果</legend>-->
                                        </fieldset>
                                        <div class="layui-form-item">
                                            <div class="layui-inline">
                                                <label class="layui-form-label" style="width:115px;">价格区间:</label>
                                                <div class="layui-input-inline" style="width:80px;">
                                                    <input type="text" name="step2_price_min" value='<?php echo $info["step2_price_min"]?>' placeholder="￥" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid">-</div>
                                                <div class="layui-input-inline" style="width:80px;">
                                                    <input type="text" name="step2_price_max" value='<?php echo $info["step2_price_max"]?>' placeholder="￥" class="layui-input">
                                                </div>
                                                元(如果商品不好找，强烈建议添加价格区间、商品所在地方便用户找到你的商品。)
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;">商品所在地:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="step2_place" readonly value="全国" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;">订单留言:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="step2_note" value='<?php echo $info["step2_note"]?>' class="layui-input">
                                            </div>
                                            用户拍下商品所需要填写的买家留言；出于安全考虑不建议大批量使用
                                            <div class="layui-form-mid layui-word-aux">如非必须建议不指定订单备注留言！因淘宝现在人工审核申诉订单时，会排查买家的订单留言内容及发货方式 是否匹配，出于安全性考虑，大家尽量通过订单号和买号来区分推广订单.</div>
                                        </div>
                                        <button class="btn-green done" type="submit">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第三步：选择任务类型和单数
                                        <span class="icon-summary"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <fieldset class="layui-elem-field layui-field-title">
                                            <legend style="margin-bottom:0px;font-weight:600;">
                                                <span style="color:red;">*</span>
                                                选择添加推广类型:
                                            </legend>
                                        </fieldset>
                                        <?php if($info['step3_type'] == 1){?>
                                            <?php include_once('./publish/type3_1.php');?>
                                        <?php }else{?>
                                        <script>
                                            function step3_add(btn) {
                                                var tr = $(btn).parents('tr');
                                                if($(btn).attr('data-val') == "add")
                                                {
                                                    var newTr = tr.clone();
                                                    newTr.find(":button").html("del");
                                                    newTr.find(":button").attr('data-val','del');
                                                    newTr.find(":button").removeClass("layui-btn-normal");
                                                    newTr.find(":button").addClass("layui-btn-danger");
                                                    newTr.find("input[name='step3_keywords[]']").val('');
                                                    newTr.find("input[name='step3_num[]']").val('');
                                                    $("#addTr").after(newTr);
                                                }
                                                else{
                                                    tr.remove();
                                                }
                                            }
                                        </script>
                                        <table class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step3_type" value="1" lay-verify="required"
                                                        <?php if($info['step3_type'] == 1){ echo "checked='checked'";}?>
                                                    >
                                                    普通好评任务(默认为5星无评价内容,如需评价请备注,但不可规定评价内容)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr id="addTr">
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">搜索关键词:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_keywords[]" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step3_num[]" class="layui-input" style="width:100px;display:inline;">单
                                                            <button type="button" class="layui-btn layui-btn-normal layui-btn-radius" onclick="step3_add(this);" data-val="add">add</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php }?>
                                        <?php if($info['step3_type'] == 2){?>
                                            <?php include_once('./publish/type3_2.php');?>
                                        <?php }else{?>
                                        <table class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step3_type" value="2" lay-verify="required"
                                                        <?php if($info['step3_type'] == 2){ echo "checked='checked'";}?>
                                                    >
                                                    指定文字好评任务(文字好评任务佣金+3金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <script>
                                                jQuery(function(){
                                                    jQuery("input[name='step3_words_num']").change(function(){
                                                        var num=$('input[name="step3_words_num"]').val();
                                                        var tr=$('#step3_2_add');
                                                        for(var i=num;i>=2;i--){
                                                            var newTr = tr.clone();
                                                            newTr.find('input[name="step3_words_con[]"]').html('');
                                                            newTr.find('.num').html(i);
                                                            newTr.find('.num2').html(i);
                                                            $("#step3_2_add").after(newTr);
                                                        }
                                                    });
                                                });
                                            </script>
                                            <tr>
                                                <td>
                                                    设置指定文本好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定图片好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_words_num" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="step3_2_add">
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;" class="num">①</span>设置第<span class="num2">1</span>单的文字
                                                    <div class="layui-form-item layui-form-text">
                                                        <div class="layui-input-block">
                                                            <textarea placeholder="可填写完整的评价内容，最多99个字" name="step3_words_con[]" class="layui-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <?php }?>
                                        <table class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step3_type" value="3" lay-verify="required"
                                                        <?php if($info['step3_type'] == 3){ echo "checked='checked'";}?>
                                                    >
                                                    指定图片好评任务(指定好评关键字任务佣金 + 5金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <script>
                                                jQuery(function(){
                                                    jQuery("input[name='step3_image_num']").change(function(){
                                                        var num=$('input[name="step3_image_num"]').val();
                                                        var tr=$('#step3_3_add');
                                                        for(var i=num;i>=2;i--){
                                                            var newTr = tr.clone();
                                                            newTr.find('.num').html(i);
                                                            $("#step3_3_add").after(newTr);
                                                        }
                                                    });
                                                });
                                            </script>
                                            <tr>
                                                <td>
                                                    设置图文好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定图片好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_image_num" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="step3_3_add">
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;" class="num">①</span>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品主图:</label>
                                                        <button type="button" class="step3_img">选择图片</button>
                                                        <br/>
                                                        <div style="margin:0 auto;width:60%;">最多可添加3张图片，每组照片拍摄的角度,背景不能一样</div>
                                                        <div class="layui-upload-list step3_img_result">

                                                        </div>
                                                    </div>
                                                    <div class="layui-form-item layui-form-text">
                                                        <label class="layui-form-label" style="width:100px;padding:9px 0px;">评价内容:</label>
                                                        <div class="layui-input-block">
                                                            <textarea placeholder="可自定义评价内容，可填写完整的评价内容，最多99个字" class="layui-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step3_type" value="4" lay-verify="required"
                                                        <?php if($info['step3_type'] == 4){ echo "checked='checked'";}?>
                                                    >
                                                    指定视频好评任务(指定好评关键字任务佣金 + 5金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <script>
                                                jQuery(function(){
                                                    jQuery("input[name='step3_video_num']").change(function(){
                                                        var num=$('input[name="step3_video_num"]').val();
                                                        var tr=$('#step3_4_add');
                                                        for(var i=num;i>=2;i--){
                                                            var newTr = tr.clone();
                                                            newTr.find('.num').html(i);
                                                            $("#step3_4_add").after(newTr);
                                                        }
                                                    });
                                                });
                                            </script>
                                            <tr>
                                                <td>
                                                    设置视频好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定视频好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_video_num" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="step3_4_add">
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;" class="num">①</span>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>选择视频:</label>
                                                        <button type="button" class="layui-btn" id="test2">选择视频:</button>
                                                        <br/>
                                                        <div style="margin:0 auto;width:60%;">最多可添加3张图片，每组照片拍摄的角度,背景不能一样</div>
                                                        <div class="layui-upload-list" id="demo2">
                                                            <img src=""/>
                                                        </div>
                                                    </div>
                                                    <div class="layui-form-item layui-form-text">
                                                        <label class="layui-form-label" style="width:100px;padding:9px 0px;">评价内容:</label>
                                                        <div class="layui-input-block">
                                                            <textarea placeholder="可自定义评价内容，可填写完整的评价内容，最多99个字" class="layui-textarea"></textarea>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="layui-table" lay-skin="line">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <span style="font-size:20px;font-weight:800;">
                                                        <input type="radio" name="step3_pay_time" value="1"
                                                            <?php if($info['step3_pay_time'] == 1){ echo "checked='checked'";}?>
                                                        >
                                                        指定付款时间(<span style="color:red;">+2金/单</span>)
                                                    </span>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">购买付款时间:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_pay_time2" class="layui-input" style="width:170px;display:inline;" value="<?php echo $info['step3_pay_time2'];?>">(买家会指定日期后24小时的任意时间付款)
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <script>
                                                        function step3_pub(btn){
                                                            var div = $(btn).parent('div');
                                                            console.log(div);
                                                            if($(btn).attr('data-val') == "add")
                                                            {
                                                                var newTr = div.clone();
                                                                newTr.find(":button").html("del");
                                                                newTr.find(":button").attr('data-val','del');
                                                                newTr.find(":button").removeClass("layui-btn-normal");
                                                                newTr.find(":button").addClass("layui-btn-danger");
                                                                newTr.find("input[name='step3_keywords[]']").val('');
                                                                newTr.find
                                                                ("input[name='step3_num[]']").val('');
                                                                $("#addDiv").after(newTr);
                                                            }
                                                            else{
                                                                div.remove();
                                                            }
                                                        }
                                                    </script>
                                                    <span style="font-size:14px;font-weight:800;">
                                                        <input type="radio" name="step3_pub_time" value="1"
                                                            <?php if($info['step3_pub_time'] == 1){ echo "checked='checked'";}?>
                                                        >
                                                        发布任务时间(+1金/单)
                                                    </span>
                                                    <br/>
                                                    <span style="color:red;">
                                                        计划放单总单数必须等于发布任务总量，间隔分钟等于0默认开始时间一到一起发布
                                                    </span>
                                                    <div class="layui-form-item" style="margin-bottom:5px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">开始时间:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step3_pub_start" class="layui-input" style="width:135px;display:inline;" value="<?php echo $info['step3_pub_start'];?>">间隔
                                                            <input type="text" name="step3_pub_min" class="layui-input" style="width:50px;display:inline;" value="<?php echo $info['step3_pub_min'];?>">
                                                            分钟/单，共放
                                                            <input type="text" name="step3_pub_num" class="layui-input" style="width:50px;display:inline;" value="<?php echo $info['step3_pub_num'];?>">
                                                            单
                                                        </div>
                                                        <button type="button" class="layui-btn layui-btn-normal layui-btn-radius" onclick="step3_pub(this);" data-val="add">add</button>
                                                        <br>
                                                    </div>
                                                    <span id="addDiv"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn-green done" type="submit">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第四步：千人前面设置
                                        <span class="icon-summary"></span>
                                    </div>
                                    <div class="wizard-content" style="font-size:15px;">
                                        千人前面设置(用户属性)---------------------------------
                                        <div class="layui-input-block" style="margin-left:40px;">
                                            <?php $step4_limit=$info['step4_limit'];
                                                $step4_limit_arr=explode(',',$step4_limit);
                                            ?>
                                            <input type="checkbox" name="step4_limit[]" lay-skin="primary" value="1"
                                                <?php if(in_array('1',$step4_limit_arr)){ echo "checked='checked'";}?>
                                            >
                                            地域限制(+2金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="step4_limit[]" lay-skin="primary" value="2"
                                                <?php if(in_array('2',$step4_limit_arr)){ echo "checked='checked'";}?>
                                            >
                                            年龄限制(仅限选择年龄段用户可接该任务,+1金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="step4_limit[]" lay-skin="primary" value="3"
                                                <?php if(in_array('3',$step4_limit_arr)){ echo "checked='checked'";}?>
                                            >
                                            性别限制(仅限选择性别用户可接该任务,+1金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="step4_limit[]" lay-skin="primary" value="4"
                                                <?php if(in_array('4',$step4_limit_arr)){ echo "checked='checked'";}?>
                                            >
                                            1钻以上(+2金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                        </div>
                                        <button class="btn-green done" type="submit">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第五步：填写竞争对手
                                        <span class="icon-mode"></span>
                                    </div>
                                    <div class="wizard-content">
                                        全部指定货比三家(+2金/单)
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>店铺名称
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_name1" value="<?php echo $info['step5_name1'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>淘 口 令
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_pass1" value="<?php echo $info['step5_pass1'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>宝贝链接
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_link1" value="<?php echo $info['step5_link1'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        -----------------------------------------------------------------------------------
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>店铺名称
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_name2" value="<?php echo $info['step5_name2'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>淘 口 令
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_pass2" value="<?php echo $info['step5_pass2'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0 ">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>宝贝链接
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_link2" value="<?php echo $info['step5_link2'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        -----------------------------------------------------------------------------------
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>店铺名称
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_name3" value="<?php echo $info['step5_name3'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>淘 口 令
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_pass3" value="<?php echo $info['step5_pass3'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item mrbo0">
                                            <label class="layui-form-label wit100">
                                                <span class="red">*</span>宝贝链接
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="step5_link3" value="<?php echo $info['step5_link3'];?>" class="layui-input">
                                            </div>
                                        </div>
                                        -----------------------------------------------------------------------------------
                                        <button class="btn-green done" type="submit">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第六步：商家附加要求
                                        <span class="icon-mode"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <div class="layui-form-item layui-form-text">
                                            <label class="layui-form-label wit100">备注说明:</label>
                                            <div class="layui-input-block">
                                                <textarea class="layui-textarea" name="step6_note" placeholder="重要！如果对用户有特别的要求，请在备注里注明，用户在做任务的时候会看到，最多不能超过300字（任务备注只是商家要求，我们只能做到传达给用户但不会强制用户按要求操作"><?php echo $info['step6_note'];?></textarea>
                                            </div>
                                        </div>
                                        <button class="btn-green" type="submit">下一步</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl">&nbsp;</span>
                        <div class="f-fl item-ifo">
                            <a href="javascript:;" class="btn btn-blue f-r3" type="submit" lay-submit lay-filter="tast1Add">下一步</a>
                        </div>
                    </div>
                    </from>
                </div>
                <div class="part2" style="display:none">
                    本次任务费用详情
                    <?php
                    $tast=[];
                    $res = $mysql->field(array('*'))
                        ->order(array('id'=>'desc'))
                        ->where(array('userId'=>$userId,'status'=>1,))
                        ->select('tast');
                    $tast=$res['0'];
                    if($tast['step3_type'] == 1){
                        $_num=json_decode($tast['step3_num'],true);
                        $_num2=0;
                        foreach($_num as $k=>$v){
                            $_num2+=$v;
                        }
                        $baseNum=$_num2;
                    }else if($tast['step3_type'] == 2){
                        $baseNum=$tast['step3_words_num'];
                    }else if($tast['step3_type'] == 3){
                        $baseNum=$tast['step3_image_num'];
                    }else if($tast['step3_type'] == 4){
                        $baseNum=$tast['step3_video_num'];
                    }
                    ?>
                    <table class="layui-table step2_tab">
                        <colgroup>
                            <col width="10%">
                            <col width="20%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>分类</th>
                            <th>费用明细</th>
                            <th>数量</th>
                            <th>小记</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="5">佣金</td>
                            <td>基础佣金：15金/单</td>
                            <td><?php echo $baseNum;?>单</td>
                            <td><?php echo $baseNum*15;?>金</td>
                        </tr>
                        <tr>
                            <td>千人千面（性别）:2金/单</td>
                            <td>2单</td>
                            <td>4.00金</td>
                        </tr>
                        <tr>
                            <td>千人前面（年龄）：1金/单</td>
                            <td>2单</td>
                            <td>2.00金</td>
                        </tr>
                        <tr>
                            <td>指定好评：3金/单</td>
                            <td>5单</td>
                            <td>15.00金</td>
                        </tr>
                        <tr>
                            <td>指定视频好评：5金/单</td>
                            <td>5单</td>
                            <td>25.00金</td>
                        </tr>
                        <tr>
                            <td rowspan="2">本金</td>
                            <td>平台返款服务费：1金/单</td>
                            <td>5单</td>
                            <td>5.00金</td>
                        </tr>
                        <tr>
                            <td>返款本金：119.00金/单</td>
                            <td>5单</td>
                            <td>595.00金</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                合计单数：5单<br/>
                                合计支付：本金604.00金+佣金121.00金=725.00金
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                使用账户余额支付(可用 500.00 金， 充值成功后请 刷新本页面)
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl">&nbsp;</span>
                        <div class="f-fl item-ifo" style="width: 563px;">
                            <a href="javascript:;" class="btn btn-blue f-r3" id="btn_part2_1">上一步</a>
                            <a href="javascript:;" class="btn btn-blue f-r3" id="btn_part2_2">付款并发布任务</a>
                        </div>
                    </div>
                </div>
                <div class="part3" style="display:none">
                    <span style="font-size:25px;font-weight:500;margin-left:30%;color:red;">恭喜  发布任务成功</span>
                </div>
                <div class="part4 text-center" style="display:none">
                    <h3>恭喜cz82465，您已注册成功，现在开始您的投资之旅吧！</h3>
                    <p class="c-666 f-mt30 f-mb50">页面将在 <strong id="times" class="f-size18">10</strong> 秒钟后，跳转到 <a href="http://www.17sucai.com/" class="c-blue">用户中心</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="m-sPopBg" style="z-index:998;"></div>
<div class="m-sPopCon regcon">
    <div class="m-sPopTitle"><strong>服务协议条款</strong><b id="sPopClose" class="m-sPopClose" onClick="closeClause()">×</b></div>
    <div class="apply_up_content">
    	<pre class="f-r0">
		<strong>同意以下服务条款，提交注册信息</strong>
        </pre>
    </div>
    <center><a class="btn btn-blue btn-lg f-size12 b-b0 b-l0 b-t0 b-r0 f-pl50 f-pr50 f-r3" href="javascript:closeClause();">已阅读并同意此条款</a></center>
</div>
<script>
    $(function(){
        //第一页的确定按钮
        $("#btn_part1").click(function(){
            // if(!verifyCheck._click()) return;
            // $(".part1").hide();
            // $(".part2").show();
            // $(".step li").eq(1).addClass("on");
        });
        //第二页的确定按钮
        $("#btn_part2_2").click(function(){
            if(!verifyCheck._click()) return;
            $(".part2").hide();
            $(".part3").show();
        });
        //第三页的确定按钮
        $("#btn_part3").click(function(){
            if(!verifyCheck._click()) return;
            $(".part3").hide();
            $(".part4").show();
            $(".step li").eq(2).addClass("on");
            countdown({
                maxTime:10,
                ing:function(c){
                    $("#times").text(c);
                },
                after:function(){
                    window.location.href="my.html";
                }
            });
        });
    });
    function showoutc(){$(".m-sPopBg,.m-sPopCon").show();}
    function closeClause(){
        $(".m-sPopBg,.m-sPopCon").hide();
    }
</script>
<!--第一步的四个小分部-->
<script src="./public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(window).load(function(){
        $(".done").click(function(){
            var this_li_ind = $(this).parent().parent("li").index();
            if($('.payment-wizard li').hasClass("jump-here")){
                $(this).parent().parent("li").removeClass("active").addClass("completed");
                $(this).parent(".wizard-content").slideUp();
                $('.payment-wizard li.jump-here').removeClass("jump-here");
            }else{
                $(this).parent().parent("li").removeClass("active").addClass("completed");
                $(this).parent(".wizard-content").slideUp();
                $(this).parent().parent("li").next("li:not('.completed')").addClass('active').children('.wizard-content').slideDown();
            }
        });

        $('.payment-wizard li .wizard-heading').click(function(){
            if($(this).parent().hasClass('completed')){
                var this_li_ind = $(this).parent("li").index();
                var li_ind = $('.payment-wizard li.active').index();
                if(this_li_ind < li_ind){
                    $('.payment-wizard li.active').addClass("jump-here");
                }
                $(this).parent().addClass('active').removeClass('completed');
                $(this).siblings('.wizard-content').slideDown();
            }
        });
    })
</script>
<div style="text-align:center;">
</div>
<?php include_once('./public/footer.php');?>
<script>
    layui.use(['form','upload'],function(){
        var $ = layui.$
            ,form = layui.form
            ,upload = layui.upload;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#step1_up'
            ,url: 'image.php'
            ,field:'step1_up_image'
            ,done: function(res){
                if(res.status == 'ok'){
                    var imgUrl=res.file;
                    imgUrl='/public/uploads/image/'+imgUrl;
                    $('input[name="step1_upload_img"]').val(imgUrl);
                    $('#step1_upload').find('img').attr('src',imgUrl);
                    layer.msg('上传图片成功',{icon:1,time:800});
                }else{
                    layer.msg('上传图片失败',{icon:1,time:800});
                }
            }
        });
        // step3_img
        var uploadInst3 = upload.render({
            elem: '.step3_img'
            ,url: 'image.php'
            ,field:'step1_up_image[]'
            ,done: function(res,input){
                if(res.status == 'ok'){
                    var imgUrl=res.file;
                    imgUrl='/public/uploads/image/'+imgUrl;
                    var _elem=$(this.elem).parent().find('.step3_img_result');
                    var _html='<img src="'+imgUrl+'" style="width:80px;"/><input type="hidden" name="step3_img_src" value="'+imgUrl+'"/>';
                    _elem.after(_html);

                    // $('input[name="step3_upload_img"]').val(imgUrl);
                    // $('#step1_upload').find('img').attr('src',imgUrl);
                    layer.msg('上传图片成功',{icon:1,time:800});
                }else{
                    layer.msg('上传图片失败',{icon:1,time:800});
                }
            }
        });
        //监听提交
        form.on('submit(tast1Add)', function(data){
            // alert("aaa");
            var field = data.field; //获取提交的字段
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            // console.log(field);
            sendAjax2(field,'publishTast.php','');
            //第一步结束之后
            if(!verifyCheck._click()) return;
            $(".part1").hide();
            $(".part2").show();
            $(".step li").eq(1).addClass("on");

            // parent.layui.table.reload('partsList'); //重载表格
            // parent.layer.close(index); //再执行关闭
        });
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
                        layer.msg(data.msg);
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