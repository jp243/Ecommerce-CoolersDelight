<?php 
	require_once("../includes/config.php");
    require_once("./includes/admin.php");

    
    require_once("./includes/header.php");
    
    if (!isset($_SESSION['admin_id'])) {
        header("location: ../index.php");
    }   
   
?>



<div class="container-fluid">

    <div class="row" id="admin-dashboard">

            <button type="button" class=" position-fixed btn btn-warning w-25 end-0 d-lg-none d-block" style="top: 0; " id="nav-toggler">
                <i class="bx bx-menu bx-sm"></i>
            </button>
    
        <div class="col-2 sticky-top top-0 d-lg-block d-none" style="height: 100vh; background: var(--default);" id="sidebar">
        <div class="">
                <?php 
                $user = GetLoggedAdmin();
                if ($user->num_rows > 0) {        
                    $result = $user->fetch_assoc();
                    $name = $result['username'];
                    ?>
                    <h3 class="text-light mb-5 mt-3"><?php echo strtoupper($name); ?> PAGE</h3>

                    <?php
                    }
                    ?>  

            <div class="row">
                <a href="index.php" class="px-3 py-2 text-light">
                <div class="col-12">
                    <i class="bx bx-grid-alt"></i> DASHBOARD    
                </div>
                </a>
                <a href="products.php" class=" px-3 py-2 text-light">
                <div class="col-12">
                    <i class="bx bx-archive"></i> PRODUCTS    
                </div>
                </a>                
                </a>
                <a href="approves.php" class=" px-3 py-2 text-light active">
                <div class="col-12">
                    <i class="bx bx-archive"></i> APPROVALS    
                </div>
                </a>
				<a href="?logout" class=" px-3 py-2 text-light">
            <div class="col-12">
            <i class="bx bx-log-out"></i> Logout    
            </div>
            </a>
            </div>

            </div>
        </div>

        <div class="col-lg-10 col-12 p-lg-3" id="main">

                <div class="p-3 bg-light">
                    <h3>Orders</h3>
                    <div class="table-responsive text-dark">
                        <table class="table table-hover table-bordered table-sm " id="table_orders">
                            <thead>
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">Order #</th>
                                <th scope="col">Franchisers</th>
                                <th scope="col">Submitted</th>
                                <th scope="col">Status</th>
                                <th scope="col">Set</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $all_ords = GetUOrders();
                                if ($all_ords->num_rows > 0) {                                    
                                    while ($ord_data = $all_ords->fetch_array()) {
                                        ?>
                                            <tr data-href="<?php echo $ord_data['sales_id'] ?>">
                                                <td class="col">
                                                    <?php echo $ord_data['sales_id']; ?>                                                    
                                                </td>
                                                <td class="col"><?php echo "<a href=?id=$ord_data[ornumber]> $ord_data[ornumber]</a>" ?></td>
                                                <td class="col"><?php echo $ord_data['lastname'] ?></td>
                                                <td class="col"><?php echo $ord_data['dt_recorded'] ?></td>
                                                <td class="col text-dark">       
                                                    <span class="badge badge-success">
                                                        <?php 
                                                            $stat = $ord_data['status_id'];
                                                            $remarks = $ord_data['status_description'];                                                            
                                                            switch($stat)
                                                            {                                                               
                                                                case "1": echo "Customer...".$remarks;
                                                                    break;
                                                                case "2": echo "Finance->".$remarks;
                                                                    break;
                                                                case "3": echo "Finance->".$remarks;
                                                                    break;
                                                                case "4": echo "Commissary->".$remarks;
                                                                    break;
                                                                case "5": echo "Commissary->".$remarks;
                                                                    break;
                                                                case "6": echo "Commissary->".$remarks;
                                                                    break;
                                                                case "7": echo "Logistics->".$remarks;
                                                                    break;
                                                                case "8": echo "Logistics->".$remarks;
                                                                    break;
                                                                case "9": echo "Customer->Received";
                                                                    break;
                                                                default:
                                                                    echo "Unreached";
                                                            }
                                                        ?>                                                        
                                                    </span>
                                                </td>  
                                                <td class="col text-dark">
                                                <select id="approvedList" name="approvedList" class="select">
                                                    <?php include('../pages/approvalList.php'); ?>
                                                </select>
                                                </td>  
                                                <td class="col text-dark">
                                                    <a class="btn btn-primary" onclick='javascript:confirmationUpdate($(this));return false;' 
                                                        href="
                                                                <?php                                                                 
                                                                    echo "?update&oid=$ord_data[sales_id]" 
                                                                ?>
                                                            " 
                                                        role="button">
                                                        Approve
                                                    </a>
                                                </td> 
                                            </tr>
                                        <?php
                                    } 
                                }
                            ?>

                            </tbody>

                        </table>
                    </div>

                </div>

                <div class="p-3 bg-light" id="order_details">
                    <div class="row">
                        <div class="col col-lg-4">
                            <h3>Order Details</h3>
                        </div>
                        <div class="col col-lg-4">
                            <h3 class="text-danger">Grand Total: ₱ <?php echo getTotalSales() ?></h3>
                        </div>
                    <div class="row">
                        <div class="col col-lg-8">
                            <div class="table-responsive text-dark">
                                <table class="table table-hover table-bordered table-sm ">
                                    <thead>
                                    <tr>
                                        <th scope="col">Item Id</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
        
                                    <?php 
                                        
                                        $all_ords = GetOrderDetails();
                                        getReceiptImg();
                                        if ($all_ords->num_rows > 0) {
                                            while ($ord_data = $all_ords->fetch_array()) {
                                                ?>
                                                    <tr>
                                                        <td class="col"><?php echo $ord_data['prod_id']; ?></td>
                                                        <td class="col"><?php echo $ord_data['prod_name'] ?></td>
                                                        <td class="col"><?php echo $ord_data['sales_qty'] ?></td>
                                                        <td class="col"><?php echo $ord_data['total'] ?></td>
                                                        
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
        
                                    </tbody>
        
                                </table>
                            </div>                        
                        </div>
                        <div class="col col-lg-4">
                            <div class="row">
                                <div class="col">
                                    <h3>Receipt Details</h3>
                                </div>
                                <!-- <h3>Grand Total</h3> -->
                            </div>
                            <?php 
                                $images = getReceiptImg();

                                $rootFolder = "../";      
                                $imagePath = $images['receipt_path'];
                                $imageId = $images['ornumber'];                          
                            ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card product-card">
                                        <img src="<?php echo $rootFolder.$imagePath ?>" class="card-img-top" alt="<?php echo $imageId ?>">
                                        <div class="card-body">   
                                            <div>
                                                <h5 class="card-title"><?php echo "OR# ".$imageId ?></h5>
                                                <p class="card-text"><?php echo $imagePath ?></p>
                                            </div>         
                                        </div>                    
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
        </div>

</div>

<script>
    const btn = document.querySelector("#nav-toggler")
    let sidebar = document.querySelector("#sidebar")

    btn.addEventListener("click", ()=> {

        if (sidebar.classList.contains("d-none")) {
            sidebar.classList.remove("d-none")
            sidebar.classList.add("w-50")
            document.querySelector("#nav-toggler i").classList.remove("bx-menu")
            document.querySelector("#nav-toggler i").classList.add("bx-x")
        }else{
            sidebar.classList.add("d-none")
            document.querySelector("#nav-toggler i").classList.add("bx-menu")
            document.querySelector("#nav-toggler i").classList.remove("bx-x")
        }

    })

    function confirmationUpdate(anchor)
    {
        var conf = confirm('Are you sure want to update this record?');
        if(conf){
            window.location=anchor.attr("href");
        }
    }

</script>


<?php 
	 if (isset($_GET['logout'])) {
        logout();
     }
     if (isset($_GET['update'])) {
        UpdateStatus();        
     }

    require_once("./includes/footer")
?>