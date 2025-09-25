<?php 

function logout(){
    session_unset();

    ?>
    <script>
        alert("Account successfully logged out")
        window.location.href = "../index.php"
    </script>
    <?php

}

function prod1(){
    $stmt = conn()->query("SELECT * FROM products LIMIT 1");
    return $stmt;
}

function prod2(){
    $stmt = conn()->query("SELECT * FROM products LIMIT 1,5");
    return $stmt;
}

function prod3(){
    $stmt = conn()->query("SELECT * FROM products LIMIT 2,5");
    return $stmt;
}

function prod4(){
    $stmt = conn()->query("SELECT * FROM products LIMIT 3,5");
    return $stmt;
}

function prod5(){
    $stmt = conn()->query("SELECT * FROM products LIMIT 4,5");
    return $stmt;
}

function allProducts(){
    $conn = conn();
    $stmt = $conn->query("SELECT * FROM products");
    return $stmt;
}

function GetUOrders(){
    $adminId = $_SESSION['admin_id'];
    $conn = conn();
    if($adminId==1){
        $stmt = $conn->query("SELECT sales_id, ornumber,  lastname, total_sales, dt_recorded, s.status_id, status_description FROM sales s JOIN users u ON s.user_id = u.user_id JOIN order_status o ON s.status_id = o.status_id");
    }else {
        $stmt = $conn->query("SELECT sales_id, ornumber,  lastname, total_sales, dt_recorded, status_id FROM sales s JOIN users u ON s.user_id = u.user_id WHERE status_id = '$adminId'");
    }
    
    return $stmt;
}

function GetOrderDetails(){
    $oid = isset($_GET['id'])?$_GET['id']:1;
    //display receipt
    $conn = conn();
    $stmt = $conn->query("SELECT * FROM sales_items i JOIN products p ON i.prod_id = p.prod_id where ornumber = '$oid'");
    return $stmt;
}

function getReceiptImg(){
    $oid = isset($_GET['id'])?$_GET['id']:1;
    // Query to fetch image records from the database
    $query = "SELECT * FROM payments WHERE ornumber='$oid'";
    $stmt = conn()->query($query);
    $result = $stmt->fetch_assoc();
    return $result;

}

function GetLoggedAdmin(){
    $id = $_SESSION['admin_id'];
    $conn = conn();
    $stmt = $conn->query("SELECT * FROM tbl_admin where admin_id ='$id'");
    return $stmt;
}

function SetApprovals(){
    $conn = conn();
    $stmt = $conn->query("SELECT sales_id, ornumber,  lastname, total_sales, dt_recorded, status_id FROM sales s JOIN users u ON s.user_id = u.user_id where status_id < 5");
    return $stmt;
}

function UpdateStatus(){
    $sid = isset($_GET['oid'])?$_GET['oid']:exit();
    $conn = conn();
    $stmt = $conn->query("UPDATE sales SET status_id = status_id + 1 WHERE sales_id = '$sid'");
    
    if ($stmt) {
        $conn->query($stmt);

        ?>
        <script>
            alert("Order successfully updated");
            window.location.href = "approves.php"
        </script>
        <?php

    }
    return $stmt;
}

function getTotalSales(){
    $oid = isset($_GET['id'])?$_GET['id']:1;
    $stmt = conn()->query("SELECT Sum(sales_qty*total) as Total FROM `sales_items` WHERE ornumber ='$oid' GROUP BY ornumber");
    $result = $stmt->fetch_assoc();

    return $result['Total'];

}