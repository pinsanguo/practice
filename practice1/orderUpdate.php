<?php
require_once('./public/conf.php');
if($_POST['orderID']){
    $post=$_POST;
    //訂單交貨時更新零件表的庫存 orderpart
    if($post['updateStatus'] == 2){
        $sql1 = "SELECT partNumber,quantity FROM orderpart where orderID='".$post['orderID']."'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0){
            while($row1 = $result1->fetch_assoc()){
                $partNumber=$row1['partNumber'];
                $quantity=$row1['quantity'];
                $sql2 = "SELECT stockQuantity FROM part where partNumber='".$partNumber."'";
                $result2 = $conn->query($sql2);
                if($result2->num_rows > 0){
                    while($row2 = $result2->fetch_assoc()){
                        $stockQuantity=$row2['stockQuantity'];
                        if($quantity > $stockQuantity){
                            die(json_encode(['msg'=>'该零件库存不足','status'=>'error',]));
                        }else{
                            $surplus=$stockQuantity-$quantity;
                            $sql3 = 'UPDATE part SET `stockQuantity`="'.$surplus.'" WHERE partNumber="'.$partNumber.'"';
                            mysqli_query($conn,$sql3);
                        }
                    }
                }
            }
        }
    }
    $sql = 'UPDATE orders SET `status`="'.$post['updateStatus'].'" WHERE orderID="'.$post['orderID'].'"';
    if (mysqli_query($conn, $sql)){
        die(json_encode(['msg'=>'訂單更新成功','status'=>'ok',]));
    } else {
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die(json_encode(['msg'=>'取消訂單失敗.','status'=>'error',]));
    }
}
?>