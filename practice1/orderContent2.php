<?php
require_once('./public/conf.php');
if(!empty($_GET['status'])){
    $sql1 = "SELECT o.*,op.*,d.`name` FROM orders o LEFT JOIN orderpart op ON o.orderID = op.orderID LEFT JOIN dealer d on d.dealerID = o.dealerID WHERE o.`status` = ".$_GET['status'];
}else{
    $sql1 = "SELECT o.*,op.*,d.`name` FROM orders o LEFT JOIN orderpart op ON o.orderID = op.orderID LEFT JOIN dealer d on d.dealerID = o.dealerID";
}
$result1 = mysqli_query($conn, $sql1);
$arr=[];
if (mysqli_num_rows($result1) > 0){
    while ($row = mysqli_fetch_assoc($result1)){
        $arr[]=[
            'orderID' => $row['orderID'],
            'partNumber' => $row['partNumber'],
            'name' => $row['name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'dealerID' => $row['dealerID'],
            'orderDate' => $row['orderDate'],
            'deliveryAddress' => $row['deliveryAddress'],
            'status' => $row['status'],
        ];
    }
}
die(json_encode(['data' => $arr, 'code' => 0]));
?>