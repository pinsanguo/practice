<?php
function curl_post($url,$post_data)
{
    $ch = curl_init();
    if(is_string($post_data))
    {
        $str = $post_data;
    }
    else
    {
        $str = http_build_query($post_data,null,'&');
    }

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if(!empty($headers))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $output = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    return $output;
}

$url = "http://gapi.giikin.com:388/logistics/service/createtrackorder?debug=1&area_id=2&logistics_id=57";
$json = '{"shipper_company_name":"\u90d1\u5dde\u5409\u5ba2\u5370\u7535\u5b50\u5546\u52a1\u6709\u9650\u516c\u53f8","shipper_contact_name":"\u5409\u5ba2\u5370","shipper_phone":"000000","shipper_address":"\u6cb3\u5357\u90d1\u5dde","shipper_subdistrict":"\u4e8c\u4e03\u533a","shipper_district":"\u4e2d\u539f\u533a","shipper_province":"\u6cb3\u5357\u7701","shipper_country":"CN","shipper_postalcode":"450000","shiper_city":"HeNanZhengZhou","shiper_email":"","receive_contact_name":"\u5c71\u672c \u6676\u5b50","receive_phone":"08024627197","receive_phone2":"971557282171","receive_address":"JP , \u6ecb\u8cc0\u770c , \u5b88\u5c71\u5e02\u5b88\u5c71 , 3-2-19 ,  \u897f\u7530\u30cf\u30a4\u30c4101\u53f7\u5ba4","receive_subdistrict":"\u5b88\u5c71\u5e02\u5b88\u5c71","receive_district":"\u5b88\u5c71\u5e02\u5b88\u5c71","receive_province":"\u6ecb\u8cc0\u770c","receive_country":"JP","receive_postalcode":"524-0022","receive_city":"\u6ecb\u8cc0\u770c","order_number":"XJ907031141382538","note":" ","weight":"0.2","goods_style":"A","attr":"P","currency_code":"\u65e5\u5e01","recipient_zipcode":"524-0022","receive_email":"mickey.sherrymae_love1118@docomo.ne.jp","quantity":1,"payment_method":"COD","total_price":"6960.00","product_type":null,"track_no":"XJ907031141382538","sale_platform_name":"giikin","warehouse":"","items":[{"sku":"XB0265-653917","category_id":150606,"category_name":"\u76f4\/\u5377\u53d1\u5668","name":"148510#\u30d8\u30a2\u30a2\u30a4\u30ed\u30f3","origin_name":"148510#\u4e8c\u5408\u4e00\u5439\u98ce\u68b3\u9020\u578b\u68b3","option":"\u30d4\u30f3\u30af","origin_option":"\u7c89\u8272","quantity":1,"unit_price":"5980.00","unit_price_currency":"\u65e5\u5e01","brand":"giikin","model":"\u7c89\u8272-1 | (139060#\u30a2\u30e1\u30ea\u30ab\u6a19-\u842c\u80fd\u8f49\u63db\u63d2\u982d-1)","note":" "},{"sku":"CD139060-549717","category_id":150501,"category_name":"\u751f\u6d3b\u7535\u5668","name":"139060#\u30a2\u30e1\u30ea\u30ab\u6a19\u6e96","origin_name":"139060#\u842c\u80fd\u8f49\u63db\u63d2\u982d","option":"\u30a2\u30e1\u30ea\u30ab\u6a19\u6e96","origin_option":"\u842c\u80fd\u8f49\u63db\u63d2\u982d","quantity":1,"unit_price":"0.05","unit_price_currency":"\u65e5\u5e01","brand":"giikin","model":"\u7c89\u8272-1 | (139060#\u30a2\u30e1\u30ea\u30ab\u6a19-\u842c\u80fd\u8f49\u63db\u63d2\u982d-1)","note":" "}]}';
$d = json_decode($json,true);
//var_dump($d);exit;
$res = curl_post($url,$d);
var_dump($res);
?>