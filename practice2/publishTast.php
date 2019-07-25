<?php include_once('./public/header.php');?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>发布手机淘宝无截图任务</title>
<link href="./public/css/bootstrap.min.css" rel="stylesheet">
<link href="./public/css/gloab.css" rel="stylesheet">
<link href="./public/css/index.css" rel="stylesheet">
<link href="./public/css/publish.css" rel="stylesheet">
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
                                        第一步：填写商品信息
                                        <span class="icon-user"></span>
                                    </div>
                                    <div class="wizard-content">
                                        全部指定货比三家(+2金/单)
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">
                                                <span style="color:red;">*</span>店铺名称
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="title" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">
                                                <span style="color:red;">*</span>淘 口 令
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="title" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">
                                                <span style="color:red;">*</span>宝贝链接
                                            </label>
                                            <div class="layui-input-block">
                                                <input type="text" name="title" class="layui-input">
                                            </div>
                                        </div>
                                        <!--第一步-->
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品名称:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="saleName" lay-verify="required" placeholder="商品名称" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品链接:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="saleLink" lay-verify="required" placeholder="商品链接" class="layui-input">
                                            </div>
                                        </div>
                                        <div style="color:red;margin:0 auto;width:60%;">注意:选择的店铺核对准确,不要填错链</div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品主图:</label>
                                            <button type="button" class="layui-btn" id="test2">商品主图</button>
                                            <br/>
                                            <div style="margin:0 auto;width:60%;">上传"商品主图",确保与搜索页面展示的图片一致.</div>
                                            <div class="layui-upload-list" id="demo2">
                                                <img src=""/>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>拍下规格:</label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:100px;display:inline;">
                                                单品实际成交金额(含快递费):
                                                <input type="text" name="step1_amount_money" lay-verify="email" autocomplete="off" class="layui-input" style="width:100px;display:inline;">元
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>每单拍:</label>
                                            <div class="layui-input-inline" style="width:70%;">
                                                <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:100px;display:inline;">
                                                件  &nbsp; 每单总金额
                                                <input type="text" name="step1_amount_money" lay-verify="email" autocomplete="off" class="layui-input" style="width:100px;display:inline;">元 【不含运费】
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:190px;"><span style="color:red">*</span>手机搜索页面展示价格:</label>
                                            <div class="layui-input-inline" style="width:50px;">
                                                <input type="password" name="password" class="layui-input">
                                            </div>
                                            元,用户拍下时的付款价格,如不同等级买号看到商品价格不同,取最大值
                                        </div>
                                        <button class="btn-green done" type="submit">下一步</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第二步：设置如何找到商品
                                        <span class="icon-location"></span>
                                    </div>
                                    <div class="wizard-content">
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:180px;"><span style="color:red">*</span>定位目标商品排序方式:</label>
                                            <div class="layui-input-block">
                                                <input type="radio" name="sex" value="销量" title="销量" checked="">销量
                                                <input type="radio" name="sex" value="综合" title="综合">综合
                                                <input type="radio" name="sex" value="综合直通车" title="综合直通车">综合直通车(强烈建议销量排序,商品位置更稳定更好找)
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:225px;"><span style="color:red">*</span>商品现有收货人数或付款人数:</label>
                                            <div class="layui-input-inline" style="width:60px;">
                                                <input type="text" name="saleName" lay-verify="required" class="layui-input">
                                            </div>
                                            人    (此处为手机淘宝销量优先搜索列表页显示的收货人数)
                                        </div>
                                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                                            <!--<legend>基础效果</legend>-->
                                        </fieldset>
                                        <div class="layui-form-item">
                                            <div class="layui-inline">
                                                <label class="layui-form-label" style="width:115px;">价格区间:</label>
                                                <div class="layui-input-inline" style="width:80px;">
                                                    <input type="text" name="price_min" placeholder="￥" autocomplete="off" class="layui-input">
                                                </div>
                                                <div class="layui-form-mid">-</div>
                                                <div class="layui-input-inline" style="width:80px;">
                                                    <input type="text" name="price_max" placeholder="￥" autocomplete="off" class="layui-input">
                                                </div>
                                                元(如果商品不好找，强烈建议添加价格区间、商品所在地方便用户找到你的商品。)
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;">商品所在地:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="" readonly value="全国" class="layui-input">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label" style="width:115px;">订单留言:</label>
                                            <div class="layui-input-inline">
                                                <input type="text" name="step1_2note" lay-verify="required" class="layui-input">
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
                                            <legend style="margin-bottom:0px;">
                                                <span style="color:red;">*</span>
                                                选择添加推广类型:
                                            </legend>
                                        </fieldset>
                                        <table class="layui-table" lay-skin="line">
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step1_3_type" value="1">
                                                    普通好评任务(默认为5星无评价内容,如需评价请备注,但不可规定评价内容)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;"><span style="color:red">*</span>搜索关键词1:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step1_amount_money" class="layui-input" style="width:100px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;"><span style="color:red">*</span>搜索关键词2:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step1_amount_money" class="layui-input" style="width:100px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;"><span style="color:red">*</span>搜索关键词3:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step1_amount_money" class="layui-input" style="width:100px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;"><span style="color:red">*</span>搜索关键词4:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step1_amount_money" class="layui-input" style="width:100px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;"><span style="color:red">*</span>搜索关键词5:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" class="layui-input" style="width:230px;display:inline;">
                                                            添加垫付
                                                            <input type="text" name="step1_amount_money" class="layui-input" style="width:100px;display:inline;">单
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
                                                    <input type="radio" name="step1_3_type" value="2">
                                                    指定文字好评任务(文字好评任务佣金+3金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    设置指定文本好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定图片好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;">①</span>设置第1单的文字
                                                    <div class="layui-form-item layui-form-text">
                                                        <div class="layui-input-block">
                                                            <textarea placeholder="可填写完整的评价内容，最多99个字" class="layui-textarea"></textarea>
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
                                                    <input type="radio" name="step1_3_type" value="3">
                                                    指定图片好评任务(指定好评关键字任务佣金 + 5金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    设置图文好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定图片好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;">①</span>
                                                    <div class="layui-form-item">
                                                        <label class="layui-form-label" style="width:115px;"><span style="color:red">*</span>商品主图:</label>
                                                        <button type="button" class="layui-btn" id="test2">选择图片</button>
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
                                            <thead>
                                            <tr style="background-color:#66CCFF;color:black;">
                                                <th>
                                                    <input type="radio" name="step1_3_type" value="4">
                                                    指定视频好评任务(指定好评关键字任务佣金 + 5金/单)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    设置视频好评内容
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">指定视频好评:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:230px;display:inline;">单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="color:#009DDA;font-size:35px;">①</span>
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
                                                        <input type="radio" name="step1_4_type" value="1">
                                                        指定付款时间(<span style="color:red;">+2金/单</span>)
                                                    </span>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">购买付款时间:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:135px;display:inline;" value="2019.6.30 16:00">(买家会指定日期后24小时的任意时间付款)
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size:14px;font-weight:800;">
                                                        <input type="radio" name="step1_4_type" value="2">
                                                        发布任务时间(+1金/单)
                                                    </span>
                                                    <br/>
                                                    <span style="color:red;">
                                                        计划放单总单数必须等于发布任务总量，间隔分钟等于0默认开始时间一到一起发布
                                                    </span>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">开始时间:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:135px;display:inline;" value="">间隔
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:50px;display:inline;" value="">
                                                            分钟/单，共放
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:50px;display:inline;" value="">
                                                            单
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="layui-form-item" style="margin-bottom:0px;">
                                                        <label class="layui-form-label" style="width:115px;padding:9px 0px;">开始时间:</label>
                                                        <div class="layui-input-inline" style="width:70%;">
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:135px;display:inline;" value="">间隔
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:50px;display:inline;" value="">
                                                            分钟/单，共放
                                                            <input type="text" name="step1_option" lay-verify="required" class="layui-input" style="width:50px;display:inline;" value="">
                                                            单
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn-green done" type="submit">Continue</button>
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
                                            <input type="checkbox" name="like1[write]" lay-skin="primary" checked="">
                                            地域限制(+2金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="like1[read]" lay-skin="primary">
                                            年龄限制(仅限选择年龄段用户可接该任务,+1金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="like1[game]" lay-skin="primary" disabled="">
                                            性别限制(仅限选择性别用户可接该任务,+1金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                            <input type="checkbox" name="like1[game]" lay-skin="primary" disabled="">
                                            1钻以上(+2金/单)<br/>
                                            ------------------------------------------------------------------------<br/>
                                        </div>
                                        <button class="btn-green done" type="submit">Continue</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="wizard-heading">
                                        第五步：填写竞争对手
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