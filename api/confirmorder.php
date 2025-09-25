<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header("Access-Control-Allow-Credentials:true"); 
    header('Access-Control-Allow-Methods:POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once('../includes/config.php');

    //get raw data
    // $data = json_decode(file_get_contents("php://input"));
    // $id = isset($_GET['id'])?$_GET['id']: die();
    // $id = htmlentities($_POST['user']);
    // // $id = $data['id'];
    // //create post
    // if(placeOrder($id)){
    //     // echo json_encode(
    //     //     array('message' => "Data created!")
    //     // );
    //     echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item deleted.</div>';
	// 	exit();

    // }else{
    //     // echo json_encode(
    //     //     array('message' => "Data not created!")
    //     // );
    //     echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, can\'t delete.</div>';
	// 	exit();
    // }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = date('Y-m-d H:i:s');
        $ornum = preg_replace('/[^0-9]/', '', $date);
        $user = $_POST['id'];

        if (empty($user)) {
            http_response_code(400);
            echo json_encode(array('message' => 'Id is required.'));
        } else {
            $stmt = $pdo->prepare('INSERT INTO sales SET ornumber =?, dt_recorded=?, user_id=?,status=0');

            if ($stmt->execute([$ornum, $date, $user])) {
                echo json_encode(array('message' => 'Item inserted successfully.'));
            } else {
                http_response_code(500);
                echo json_encode(array('message' => 'Failed to add item.'));
            }        
        }
    }

    function placeOrder($id){
        //create a query
        // $userID = $data->id;
        // $date = date('Y-m-d H:i:s');
        // $ornum = preg_replace('/[^0-9]/', '', $date);
               
        $query = "INSERT INTO sales SET ornumber = 333, dt_recorded=now(), user_id=:id,status=0";
        //prepare the statement
        $stmt = conn()->prepare($query);
        //execute the query
        // $stmt->execute(['id' => $id]);
        if($stmt->execute(['id' => $id])){
            return true;
        }
        //print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
        return false;
    }
?>