<div class="modal fade" id="register">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Account</h3>
                <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
            </div>

            <div class="modal-body p-5">

                <?php require_once("./pages/form.php") ?>

            </div>

        </div>
    </div>

</div>


<!-- REGISTER -->

<!-- Change password-->
<div class="modal fade" id="change_pass">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Change Password</h3>
                <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>
            </div>

            <div class="modal-body p-5">
                
                <!--<?php //require_once("./pages/form.php") ?>-->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                          
                    <style>
                        .pass_show{position: relative;} 

                        .pass_show .ptxt { 
                        
                            position: absolute; 
                            
                            top: 50%; 
                            
                            right: 10px; 
                            
                            z-index: 1; 
                            
                            color: #f36c01; 
                            
                            /*margin-top: -5px; */
                            
                            cursor: pointer; 
                            
                            transition: .3s ease all; 
                        
                        } 
                        
                        .pass_show .ptxt:hover{color: #333333;} 
                    </style>      
                    <div class="container">
                    	<div class="row">
                    		<div class="col">
                    		    <input type="hidden" name="user_id" value="<?php echo @$_SESSION['user_id'] ?>">
                    		    <div class="form-group pass_show mb-2"> 
                    		        <label>Current Password</label>
                                    <input type="password" name="current_pwd" class="form-control" placeholder="********"> 
                                </div> 
                                <div class="form-group pass_show mb-2"> 
                    		       <label>New Password</label>
                                    <input type="password" name="new_pwd"  class="form-control" placeholder="********"> 
                                </div> 
                                <div class="form-group pass_show mb-2"> 
                    		       <label>Confirm Password</label>
                                    <input type="password" name="confirm_new_pwd" class="form-control" placeholder="********"> 
                                </div> 
                                
                        	    <div class="form-group mt-3"> 
                        		       <button type="submit" class="button btn btn-primary btn-block mb-3" name="change_pass">Change</button>
                                </div> 
                    		</div>  
                    	</div>
                    </div>
                    
                </form>

            </div>

        </div>
    </div>

</div>

<!--  password -->


<!-- ORDER NOW -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
<div class="modal fade px-3" id="orderNow">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4>Order Summary</h4>
                <button type="button" class="btn-close" data-mdb-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                    <div class="table-responsive">

                    <table class="table table-bordered table-sm align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                      $prod_que = getAllCartByUser($_SESSION['user_id']);
                                      if ($prod_que->num_rows > 0) {
                                          
                                          while ($products = $prod_que->fetch_array()) {
                                            ?>
                                <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <img
                                        src="./assets/img/<?php echo $products['prod_img'] ?>"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                        />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo $products['prod_name'] ?></p>
                                       
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">₱ <?php echo number_format($products['prod_sprice'],2) ?></p>
                                  
                                </td>
                                <td>
                                <p class="fw-normal mb-1"><?php echo $products['quantity'] ?></p>
                                </td>
                                <td>₱ <?php echo number_format($products['total'],2) ?></td>
                                </tr>

                                <?php 
                                          }}
                                ?>
                                
                            </tbody>
                            </table>

                    </div>
                    
                    <br>
                    <label class="form-label" for="notes">Notes:</label>
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <textarea id="notes" name="notes" rows="4" cols="50" class="form-control"></textarea>
                    </div>
                    <br>
            </div>

            <div class="modal-footer">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <!-- <form method='POST' action='' enctype="multipart/form-data"> -->
                        <!-- <input type='hidden' id='ornumber' name='ornumber' value="<?php //echo $orders['ornumber'] ?>">  -->
                        <p>Please upload receipt(accepted format: jpg, .jpeg, .png)</p>
                        <input type='file' id="receipt_image" name='receipt_image' accept='.jpg, .jpeg, .png' multiple required>
                        <!-- <input type='submit' value='Submit' id='submit_receipt' name='submit_receipt' class='btn btn-primary'/> -->
                    <!-- </form> -->
                </div>
                
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <input type="hidden" name="check_out_user_id" id="check_out_user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <button type="submit"  id="confirm_order" name="confirm_order" class="btn text-light" style=" background: var(--default) !important;" disabled>Confirm Order</button>
                    <h5>Subtotal: ₱ <?php echo number_format(totalAllCart($_SESSION),2) ?></h5>
                </div>
            </div>

        </div>

    </div>

</div>
</form>

<?php 
 	// if (isset($_POST['c_order'])) {
    //     clickLink();
    //  }
    // require_once("./includes/footer")
?>