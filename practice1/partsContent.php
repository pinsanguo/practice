<?php
require_once('./public/conf.php');
$sql1 = "SELECT * FROM part ";
$result1 = mysqli_query($conn, $sql1);
$arr=[];
if (mysqli_num_rows($result1) > 0){
    while ($row = mysqli_fetch_assoc($result1)){
        $arr[]=[
            'partNumber' => $row['partNumber'],
            'partName' => $row['partName'],
            'stockQuantity' => $row['stockQuantity'],
            'stockPrice' => $row['stockPrice'],
            'email' => $row['email'],
            'stockStatus' => $row['stockStatus'],
        ];
    }
}
$arr2 = [
    [
        'partNumber' => 1,
        'partName' => 'partName',
        'stockQuantity' => 'stockQuantity',
        'stockPrice' => 'stockPrice',
        'email' => 'email',
        'stockStatus' => 'stockStatus',
    ],
];
die(json_encode(['data' => $arr, 'code' => 0]));
?>