<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');    

include('../includes/customers.php');

$reqMethod = $_SERVER['REQUEST_METHOD'];

if($reqMethod =='POST'){
    $inputData = json_decode(file_get_contents("php://input"), true);
    
    if(empty($inputData)){
        echo $inputData['check_out_user_id'];
        echo "unsuccessful";
    }
    else{
        echo $inputData['check_out_user_id'];
        echo "successful";
    }

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