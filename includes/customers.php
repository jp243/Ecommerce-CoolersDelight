<?php 

function cleaner($data){
    $data = stripslashes($data);
    $data = trim($data);
    $data = htmlspecialchars($data);

    return $data;

}

function session($data){
    $session = cleaner($data['user_id']);
    return $session;
}

function rand_string( $length ) {

	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	return substr(str_shuffle($chars),0,$length);

}

function checkUser($email){
    $stmt =conn()->query("SELECT * FROM users WHERE email='$email'");
    return $stmt;
}

function checkAdmin($email,$password){
    $stmt = conn()->query("SELECT * FROM tbl_admin WHERE username='$email' AND password='$password' ");
    return $stmt;
}

function registerUser($data,$pass){
    $fname = $data['fname'];
    $lname = $data['lname'];
    $email = $data['email'];
    $contact = $data['contact'];
    $password = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = "INSERT INTO users SET firstname='$fname',lastname='$lname',contact='$contact',email='$email',password='$password' ";
    if ($stmt) {
        conn()->query($stmt);

       ?>
        <script>
            alert("Account created successfully please check your email account for your password")
            window.location.href = "index.php"
        </script>
       <?php

    }
                                      
}

function checkExistingEmail($email){
    $stmt = conn()->query("SELECT * FROM users WHERE email='$email'");
    return $stmt;
}

function updateUserOTP($data,$pass){
    $email = $data['email'];
    $otp = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = "UPDATE users SET user_otp='$otp' WHERE email = '$email'";
    if ($stmt) {
        conn()->query($stmt);

       ?>
        <script>
            alert("OTP updated successfully")
            window.location.href = "index.php"
        </script>
       <?php

    }
                                      
}

function getUserPassword($id){
    $stmt = conn()->query("SELECT password FROM users WHERE user_id='$id'");
    return $stmt;
}

function changePassword($data){
    $id = $data['user_id'];
    $cpwd = $data['current_pwd'];
    $npwd = $data['new_pwd'];
    $cnpwd = $data['confirm_new_pwd'];
    $pwd = password_hash($npwd, PASSWORD_DEFAULT);
    
    $match = ($npwd === $cnpwd)? true: false;
    if(!$match){
        ?>
            <script>
                alert("New password does not match.");
            </script>
        <?php
        // exit();
    }else {
        
        $user = getUserPassword($id);
        
        if ($user->num_rows > 0) {
                $result = $user->fetch_assoc();
                if (password_verify($cpwd, $result['password'])){
                    $stmt = "UPDATE users SET password='$pwd' WHERE user_id = '$id'";
                    if ($stmt) {
                        conn()->query($stmt);
                        
                       ?>
                        <script>
                            alert("Password updated successfully")
                            window.location.href = "index.php"
                        </script>
                       <?php
                        logout();
                    }
                }else {
                    
                    ?>  
                    <script>
                        alert("Current password does not match in our database.");
                    </script>
                    <?php
                }
        }
        
    }
    
}

function deleteUserOTP($email){

    $stmt = "UPDATE users SET user_otp='' WHERE email = '$email'";
    if ($stmt) {
        conn()->query($stmt);
    }
                                      
}

function logActivity($user, $activity){
    conn()->query("INSERT INTO franchisers_log SET user_id='$user', date_log=Now(), activity='$activity'");
}

function login($data){
    $email = cleaner($data['email']);
    $password = cleaner($data['password']);
    $otp = cleaner($data['loginOTP']);

    $check = checkUser($email);
    $admin = checkAdmin($email, $password);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
        //for franchisers
        if ($check->num_rows > 0) {
        
            $result = $check->fetch_assoc();
    
            if (password_verify($password, $result['password']) && password_verify($otp, $result['user_otp'])) {
                
                $_SESSION['user_id']=$result['user_id'];
                //log activity
                logActivity($result['user_id'], "User id ".$result['user_id']." login");
                deleteUserOTP($email);
                ?>  
                <script>
                    alert("Account successfully logged in")
                    window.location.href = "index.php"
                    
                </script>
                <?php
    
            }
    
        }else {
            ?>  
                <script>
                    alert("Invalid email, otp or password!")
                    window.location.href = "index.php"
                    
                </script>
                <?php
        }
    }
    else {
        //for admins
            if ($admin->num_rows > 0) {
                
                $admin_data = $admin->fetch_assoc();

                $_SESSION['admin_id']=$admin_data['admin_id'];
                
                ?>
                        <script>
                            alert("Account successfully logged in")
                            window.location.href = "./admin/index.php"
                        </script>
                <?php

            }
        }
}


function allItems(){

    $conn = conn();
    $cat_id = isset($_GET['id'])?$_GET['id']:0;
    $search = isset($_GET['name'])?$_GET['name']:"";

    if($cat_id==0){
        $sql = "SELECT * FROM products WHERE prod_name LIKE '%$search%'";
    }else {
        $sql ="SELECT * FROM products p JOIN category c ON p.cat_id=c.cat_id WHERE p.cat_id=$cat_id";
    }
    $stmt = $conn->query($sql);
    return $stmt;
}

function UpdateStatus(){
    $sid = isset($_GET['oid'])?$_GET['oid']:exit();
    // $stat = $_GET[''];
    // $admin_id = $data['admin_id'];
    $conn = conn();
    $stmt = $conn->query("UPDATE sales SET status_id = status_id + 1 WHERE sales_id = '$sid'");
    
    if ($stmt) {
        $conn->query($stmt);

        ?>
        <script>
            alert("Order received successfully.");
            window.location.href = "index.php"
        </script>
        <?php

    }
    return $stmt;
}

function GetUserOrders($user_id){
    $conn = conn();

    $stmt = $conn->query(
                            "SELECT sales_id, ornumber,  lastname, s.status_id, total_sales, dt_recorded, status_description 
                            FROM sales s 
                            JOIN users u ON s.user_id = u.user_id 
                            JOIN order_status os ON s.status_id = os.status_id 
                            WHERE u.user_id=$user_id"
                        );
    return $stmt;
}

function ProductsByCategory($data){	
    $stmt = conn()->query("SELECT * FROM products p JOIN category c ON p.cat_id=c.cat_id WHERE p.cat_id=$data");
    return $stmt;
}

function ProductsByName($data){	
    ?>
            <script>
                console.log("btnsearch activating ")
            </script>
    <?php    
    $name = $data['searchTxt'];
    $stmt = conn()->query("SELECT * FROM products WHERE prod_name LIKE '%$name%'");
    return $stmt;
}

function addToCart($data){
    $prod_id = cleaner($data['prod_id']);
    $quantity = cleaner($data['quantity']);
    $user_id = cleaner($data['user_id']);
    $prod_price = cleaner($data['prod_price']);

    $total = $prod_price*$quantity;

    conn()->query("INSERT INTO cart SET prod_id='$prod_id',user_id='$user_id',quantity='$quantity',total='$total' ");

    ?>
    <script>
        window.location.href = "index.php"
    </script>
    <?php


}

function submit_Receipt($or){
    $con = conn();
    // $or = $data['ornumber'];
    $image = $_FILES['receipt_image'];
    $imageName = $image['name'];
    $imageTmpPath = $image['tmp_name'];

    // Validate form data (you can add more validation as per your requirements)
    if (empty($image)) {        
        exit();       
      } else {
  
          // Define the directory to store the uploaded images
          $uploadDirectory = 'assets/receipts/';
  
          // Generate a unique filename for the uploaded image
          $uploadedImagePath = $uploadDirectory . uniqid('recpt_') . '_' . $imageName;
  
          // Move the uploaded image to the destination directory
          move_uploaded_file($imageTmpPath, $uploadedImagePath);
        
          // Prepare and execute the SQL query
          $sql = "INSERT INTO payments SET ornumber=$or, receipt_path='$uploadedImagePath'";     
          conn()->query($sql);   
        
        mysqli_close($con);
      }
}

function updateSalesStatus($ornum){
    conn()->query("UPDATE sales SET status_id = status_id + 1 WHERE ornumber = '$ornum'");
}

function clickLink(){

    echo "button clicked!";

}

function getRandomTime(){
    // Get the current timestamp
    $currentTimestamp = time();
    // Seed the random number generator with the current timestamp
    srand($currentTimestamp);

    // Generate a random number
    $randomNumber = rand(1, 100); // Adjust the range as needed
    return $randomNumber;
}

function getRandomDate(){
    // Get the current date
    $currentDate = date('Ymd'); // You can adjust the date format as needed

    // Convert the date string to an integer (remove hyphens)
    $dateAsInteger = intval(str_replace('-', '', $currentDate));

    // Seed the random number generator with the date-based integer
    srand($dateAsInteger);

    // Generate a random number
    $randomNumber = rand(1, 100); // Adjust the range as needed
    return $randomNumber;
}

function getOrNum($id){
    date_default_timezone_set('Asia/Manila');  
    $stmt = conn()->query("SELECT COUNT(*) AS num FROM `sales` WHERE DATE(dt_recorded) = CURRENT_DATE");
    $result = $stmt->fetch_assoc();
    $res =($result['num']===0?1:$result['num']+1);  
    $currentDate = date('YmdHi');
    $or = $currentDate."". $res ."".$id;
    return $or;
}

function confirmOrder($data){
    $notes = empty($data['notes'])?"": $data['notes'];
    $user_id = cleaner($data['check_out_user_id']);
    $ornum = getOrNum($user_id);
    insertSales($user_id, $ornum, $notes);
    insertSalesItems($user_id);
    updateSalesItems($ornum,$user_id);
    updateTotalSales($ornum);
    deleteCartItems($user_id);
    submit_Receipt($ornum);
    logActivity($_SESSION['user_id'], "User id ".$_SESSION['user_id']." check-out.");
    ?>
    <script>
        alert("Order successfull!")
        window.location.href = "index.php"
    </script>
    <?php

}

function insertSales($user_id, $or,$note){
    date_default_timezone_set('Asia/Manila');
    conn()->query("INSERT INTO sales SET ornumber = $or, dt_recorded=Now(), user_id=$user_id, status_id=1, customer_notes='$note'");
}

function insertSalesItems($user_id){
    conn()->query("INSERT INTO sales_items(prod_id, sales_qty, ttlsales, user_id) SELECT prod_id, quantity, total, user_id FROM cart WHERE user_id =$user_id");        
}

function updateSalesItems($salesId, $user){
    conn()->query("UPDATE sales_items SET ornumber=$salesId WHERE ornumber IS NULL AND user_id='$user'");
}

function updateTotalSales($salesId){
    conn()->query("
                    UPDATE sales SET total_sales=
                    (SELECT Sum(sales_qty*ttlsales) as Total FROM `sales_items` WHERE ornumber ='$salesId' GROUP BY ornumber)
                    WHERE ornumber ='$salesId'");
}

function deleteCartItems($user){
    conn()->query("DELETE FROM cart WHERE user_id=$user");
}

function cntCartProducts($data){
    $user_id = $data['user_id'];
    
    $stmt = conn()->query("SELECT COUNT(*) AS CNT FROM cart WHERE user_id='$user_id' ");
    $result = $stmt->fetch_assoc();

    return $result['CNT'];

}

function getTotalSales($oid){
    
    $stmt = conn()->query("SELECT Sum(sales_qty*ttlsales) as Total FROM `sales_items` WHERE ornumber ='$oid' GROUP BY ornumber");
    $result = $stmt->fetch_assoc();

    return $result['Total'];

}

function logout(){
    
    logActivity($_SESSION['user_id'], "User id ".$_SESSION['user_id']." logout");
    session_unset();

    ?>
    <script>
        alert("Account logged out successfully")
        window.location.href = "./login.php"
    </script>
    <?php

}

function getAllAddedProductToCart($data){
    $user_id = cleaner($data['user_id']);

    $stmt = conn()->query("SELECT * FROM cart c INNER JOIN products p ON c.prod_id=p.prod_id WHERE user_id='$user_id'");
    return $stmt;

}

function removeProductFromCart($id,$user_id){
    $prod_id = $id['prod_id'];
    $user_id = $user_id['user_id'];

    conn()->query("DELETE FROM cart WHERE user_id='$user_id' AND prod_id='$prod_id' ");

    ?>
    <script>
        alert("Item successfully removed from cart");
        window.location.href = "index.php"
    </script>
    <?php

}

function FilterProductsByCategory($id){

    $cat_id = $id['id'];
    ProductsByCategory($cat_id);
        ?>
            <script>
                console.log("Filter activated ")
            </script>
        <?php
    // conn()->query("DELETE FROM cart WHERE user_id='$user_id' AND prod_id='$prod_id' ");

}

function getAllCartByUser($user_id){
    $conn = conn();
    $stmt = "SELECT * FROM cart INNER JOIN products ON cart.prod_id=products.prod_id WHERE cart.user_id=? ";
    $stmt = $conn->prepare($stmt);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    if ($stmt) {
        return $stmt->get_result();
    }

}

function checkProductFromCart($prod_id,$user_id){
    $conn = conn();
    $product = $prod_id['prod_id'];
    $user = $user_id['user_id'];

    $stmt = "SELECT * FROM cart WHERE prod_id='$product' AND user_id='$user' ";
    $result = $conn->query($stmt);
    return $result;

}

function updateProdFromCart($user_id,$post){
    $conn = conn();
    $user = $user_id['user_id'];
    $prod = $post['prod_id'];
    $quantity = $post['quantity'];

    $select = $conn->query("SELECT * FROM products WHERE prod_id='$prod'");
    $result = $select->fetch_array();
    $prod_price = $result['prod_sprice'];

    $total = $prod_price*$quantity;

    $stmt = "UPDATE cart SET quantity='$quantity',total='$total' WHERE prod_id='$prod' AND user_id='$user' ";
    if ($stmt) {
        $conn->query($stmt);

        ?>
        <script>
            alert("Item successfully updated");
            window.location.href = "index.php"
        </script>
        <?php

    }

}

function totalAllCart($user){
    $user_id = $user['user_id'];

    $stmt = conn()->query("SELECT SUM(total) AS TOTAL FROM cart WHERE user_id='$user_id'");
    $data = $stmt->fetch_array();
    return $data['TOTAL'];

}