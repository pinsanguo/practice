<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>发布手机淘宝无截图任务</title>
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/gloab.css" rel="stylesheet">
    <link href="./public/css/index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./public/css/style.css">
    <script src="./public/js/jquery-1.11.1.min.js"></script>
    <script src="./public/js/register.js"></script>
</head>
<body class="bgf4">
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
                    <div class="alert alert-info" style="width:700px">
                        <p>所有商家都要注意在做标签推广务必严格控制好以下3点：</p>
                        <p>1. <span style="color:red;">物流一定要有真实物流记录，一定要有全程重量并且重量跟真实商品一致！一定不要网上买那些小快递的，便宜的空包（稽查系统在不断升
                            级，有些以前没出事不代表现在或以后没事</span>）；目前可以选用平台提供的空包（不要信当地快递网点手动输入的重量，当地网点无法控制包裹
                            在中转站和到达点的重量统计）</p>
                        <p>2. 推广比例一定不要过高，最高最高不能超过40%</p>
                        <p>3. 移动端搜索转化率务必不要过高，保持在行业平均转化率的1.5倍左右最佳</p>
                        <p>4. 推广期间请务必关掉商品淘客佣金，推广过程有诸多不确定因素可能导致产生佣金可能造成您的损失。</p>
                    </div>
                    <section class="htmleaf-container" style="width:700px">
                        <div class="container">
                            <ul class="payment-wizard">
                                <li class="active">
                                    <div class="wizard-heading">
                                        1. Login Information
                                        <span class="icon-user"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <p>Create your Login Form here as per your requirement.</p>
                                        <button class="btn-green done" type="submit">Continue</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        2. Delivery Address
                                        <span class="icon-location"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <p>User address details section.</p>
                                        <button class="btn-green done" type="submit">Continue</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        3. Order Summary
                                        <span class="icon-summary"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <p>Order summary details section.</p>
                                        <button class="btn-green done" type="submit">Continue</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        4. Payment Method
                                        <span class="icon-mode"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <p>Your payment methods detail section.</p>
                                        <button class="btn-green" type="submit">Done</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl">&nbsp;</span>
                        <div class="f-fl item-ifo">
                            <a href="javascript:;" class="btn btn-blue f-r3" id="btn_part1">下一步</a>
                        </div>
                    </div>
                </div>
                <div class="part2" style="display:none">
                    <div class="alert alert-info" style="width:700px">短信已发送至您手机，请输入短信中的验证码，确保您的手机号真实有效。</div>
                    <div class="item col-xs-12 f-mb10" style="height:auto">
                        <span class="intelligent-label f-fl">手机号：</span>
                        <div class="f-fl item-ifo c-blue">
                            15824450934
                        </div>
                    </div>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl"><b class="ftx04">*</b>验证码：</span>
                        <div class="f-fl item-ifo">
                            <input type="text" maxlength="6" id="verifyNo" class="txt03 f-r3 f-fl required" tabindex="4" style="width:167px" data-valid="isNonEmpty||isInt" data-error="验证码不能为空||请输入6位数字验证码" />
                            <span class="btn btn-gray f-r3 f-ml5 f-size13" id="time_box" disabled style="width:97px;display:none;">发送验证码</span>
                            <span class="btn btn-gray f-r3 f-ml5 f-size13" id="verifyYz" style="width:97px;">发送验证码</span>
                            <span class="ie8 icon-close close hide" style="right:130px"></span>
                            <label class="icon-sucessfill blank hide"></label>
                            <label class="focus"><span>请查收手机短信，并填写短信中的验证码（此验证码3分钟内有效）</span></label>
                            <label class="focus valid"></label>
                        </div>
                    </div>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl">&nbsp;</span>
                        <div class="f-fl item-ifo">
                            <a href="javascript:;" class="btn btn-blue f-r3" id="btn_part2">注册</a>
                        </div>
                    </div>
                </div>
                <div class="part3" style="display:none">
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl"><b class="ftx04">*</b>真实姓名：</span>
                        <div class="f-fl item-ifo">
                            <input type="text" maxlength="10" class="txt03 f-r3 required" tabindex="1" data-valid="isNonEmpty||between:2-10||isZh" data-error="真实姓名不能为空||真实姓名长度2-10位||只能输入中文" id="adminNo" />
                            <span class="ie8 icon-close close hide"></span>
                            <label class="icon-sucessfill blank hide"></label>
                            <label class="focus">2-10位，中文真实姓名</label>
                            <label class="focus valid"></label>
                        </div>
                    </div>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl"><b class="ftx04">*</b>身份证号：</span>
                        <div class="f-fl item-ifo">
                            <input type="text" class="txt03 f-r3 required" tabindex="2" data-valid="isNonEmpty||isCard" data-error="身份证号不能为空||身份证号码格式不正确" maxlength="18" id="phone" />
                            <span class="ie8 icon-close close hide"></span>
                            <label class="icon-sucessfill blank hide"></label>
                            <label class="focus">请填写18位有效的手机号码</label>
                            <label class="focus valid"></label>
                        </div>
                    </div>
                    <div class="item col-xs-12">
                        <span class="intelligent-label f-fl">&nbsp;</span>
                        <div class="f-fl item-ifo">
                            <a href="javascript:;" class="btn btn-blue f-r3" id="btn_part3">下一步</a>
                        </div>
                    </div>
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
            if(!verifyCheck._click()) return;
            $(".part1").hide();
            $(".part2").show();
            $(".step li").eq(1).addClass("on");
        });
        //第二页的确定按钮
        $("#btn_part2").click(function(){
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
</body>
</html>