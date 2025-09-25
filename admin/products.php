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
            <h3 class="text-light mb-5 mt-3">ADMIN PAGE</h3>

            <div class="row">
                <a href="index.php" class="px-3 py-2 text-light">
                <div class="col-12">
                    <i class="bx bx-grid-alt"></i> DASHBOARD    
                </div>
                </a>
                <a href="products.php" class=" px-3 py-2 active">
                <div class="col-12">
                    <i class="bx bx-archive"></i> PRODUCTS    
                </div>
                </a>                
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
                    <h3>Products</h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm ">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock </th>
                                <th scope="col">Date Updated</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $all_prods = allProducts();
                                if ($all_prods->num_rows > 0) {
                                    while ($prod_data = $all_prods->fetch_array()) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $prod_data['prod_name'] ?></th>
                                                <td><?php echo $prod_data['prod_price'] ?></td>
                                                <td><?php echo $prod_data['prod_stock'] ?></td>
                                                <td><?php echo $prod_data['date_updated'] ?></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>

                            </tbody>

                        </table>
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

</script>


<?php 
	 if (isset($_GET['logout'])) {
        logout();
     }
    require_once("./includes/footer")
?>