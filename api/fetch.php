<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');    

include('../includes/customers.php');

$reqMethod = $_SERVER['REQUEST_METHOD'];

if($reqMethod =='GET'){
    $orders = UnapprovedOrders();
    json_encode($orders);
}
else{

    $data =[
        'status' => 405,
        'message' => $reqMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>