<?php

    // header('Access-Control-Allow-Origin:*');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Method:POST');
    // header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

    include('../includes/config.php');
    include('../includes/customers.php');
    
    // $rval = $_GET['action'];
    // $user = htmlentities($_POST['user']);

    // $reqMethod = $_SERVER['REQUEST_METHOD'];
    
    $user = htmlentities($_POST['user_id']);

    $user = filter_var($user, FILTER_SANITIZE_STRING);
    if(isset($_POST['user_id'])){
        // Check if mandatory fields are not empty
		if(!empty($user)){
			
			// Sanitize item number
			$user = filter_var($user, FILTER_SANITIZE_STRING);

			// Check if the item is in the database
			$userSql = 'SELECT user_id FROM cart WHERE user_id=:userId';
			$userStatement = $conn->prepare($userSql);
			$userStatement->execute(['userId' => $user]);
			
			if($userStatement->rowCount() > 0){
				
				// Item exists in DB. Hence start the DELETE process
				$deleteItemSql = 'DELETE FROM cart WHERE user_id=:userId';
				$deleteItemStatement = $conn->prepare($deleteItemSql);
				$deleteItemStatement->execute(['userId' => $user]);

				echo 'Item deleted.';
				exit();
				
			} else {
				// Item does not exist, therefore, tell the user that he can't delete that item 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			// Item number is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the item number</div>';
			exit();
		}
    }

    function confirmOrder(){

        // $user = $_SESSION['user'];
        // $date = date('Y-m-d H:i:s');
        // // $ornum = preg_replace('/[^0-9]/', '', $date);
        // $ornum = 123;
        // insertSales($ornum);
        // // insertSalesItems($ornum);
        // // deleteCartItems($user);
        ?>
        <script>
            alert("Order successfull!");
            // window.location.href = "index.php#menu"
        </script>
        <?php
    
    }
    
    function insertSales($ornum){
        $user = $_SESSION['user'];
        date_default_timezone_set('Asia/Manila');        
    
        // Then call the date functions
        $date = date('Y-m-d H:i:s');
        try {
            //code...
            conn()->query("INSERT INTO sales SET ornumber = $ornum, dt_recorded=$date, user_id='$user',status=0");
            echo 'insert sales successful' ;
        } catch (\Throwable $th) {
            //throw $th;
            echo $th + 'error';
        }
        // echo json_encode("insert sales successful" + $_SESSION['user_id']);
    }
    
    function insertSalesItems($salesId){
    
        $user = $_SESSION['user'];
        conn()->query("INSERT INTO sales_items(prod_id, sales_qty, total) SELECT prod_id, quantity, total FROM cart WHERE user_id =$user");
        echo 'insert items successful';
        updateSalesItems($salesId,$user);
        
    }

    function updateSalesItems($salesId,$user){
        $date = date('Y-m-d H:i:s');
        $insertItemSql = "UPDATE sales_items SET ornumber=$salesId, dt_recorded=$date, user_id=$user";

        $insertItemStatement = conn()->prepare($insertItemSql);
        $insertItemStatement->execute();
        echo 'update sales successful';
        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Order confirmed!</div>';
   
    }
?>