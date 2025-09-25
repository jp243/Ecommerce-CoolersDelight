<?php 
	require_once("../includes/config.php");
    require_once("./includes/admin.php");
    // require_once("../includes/customers.php");
    $prod1 = prod1();
    $prod_data1 = $prod1->fetch_array();
    $prod2 = prod2();
    $prod_data2 = $prod2->fetch_array();
    $prod3 = prod3();
    $prod_data3 = $prod3->fetch_array();
    $prod4 = prod4();
    $prod_data4 = $prod4->fetch_array();
    $prod5 = prod5();
    $prod_data5 = $prod5->fetch_array();
    
        $dataPoints = array( 
            array("y" => 3373.64, "label" => $prod_data1['prod_name'] ),
            array("y" => 3373.64, "label" => $prod_data2['prod_name'] ),
            array("y" => 3373.64, "label" => $prod_data3['prod_name'] ),
            array("y" => 3373.64, "label" => $prod_data4['prod_name'] ),
            array("y" => 3373.64, "label" => $prod_data5['prod_name'] ),
        );

    
    require_once("./includes/header.php");
    
    if (!isset($_SESSION['admin_id'])) {
        header("location: ../login.php");
    }

    
   
?>



<div class="container-fluid">

    <div class="row" id="admin-dashboard">

    <button type="button" class=" position-fixed btn btn-warning w-25 end-0 d-lg-none d-block" style="top: 0; " id="nav-toggler"><i class="bx bx-menu bx-sm"></i></button>
    
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
            <a href="index.php" class=" px-3 py-2 active">
                <div class="col-12">
                    <i class="bx bx-grid-alt"></i> DASHBOARD    
                </div>
            </a>
            <a href="products.php" class=" px-3 py-2 text-light">
                <div class="col-12">
                    <i class="bx bx-archive"></i> PRODUCTS    
                </div>
            </a>            
            <a href="approves.php" class=" px-3 py-2 text-light">
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
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        
        <script src="../assets/js/graph.js"></script>

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


</script>
<?php 
 	if (isset($_GET['logout'])) {
        logout();
     }
    require_once("./includes/footer")
?>