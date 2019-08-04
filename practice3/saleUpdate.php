<?php
require_once('./public/conf.php');
if($_POST['saleId']){
    $post=$_POST;
    $result=$mysql->where(array('id'=>$post['saleId']))->update('sale',
        [
            'status'=>$post['updateStatus'],
            'settletime'=>date('Y-m-d H:i:s'),
        ]);
    if ($result){
        die(json_encode(['msg'=>'进货单审核成功','status'=>'ok',]));
    } else {
        die(json_encode(['msg'=>'进货单审核失敗.','status'=>'error',]));
    }
}
?>