                <!-- MENU -->

                <div class="col-lg-9 py-lg-5 p-lg-0 p-3">
                  <div class="row g-3">

                                  <?php 
                                  $prod_que = allItems();
                                      if ($prod_que->num_rows > 0) {
                                          
                                          while ($products = $prod_que->fetch_array()) {
                                            ?>

                                          <!-- PRODUCT -->
                                            <div class="col col-lg-3 col-sm-6">

                                              <div class="card p-3" style="height: 380px;">

                                              <form action="" method="post">

                                              <div class ="bg-image hover-zoom" style="height: 15rem;  background: url(./assets/img/<?php echo $products['prod_img'] ?>); background-repeat: no-repeat; background-position: center;"></div>
                                                <div class="align-items-center mt-1" style="height:2rem;">
                                                  <h5 class="fs-6"><?php echo $products['prod_name'] ?></h5>  
                                                </div>
                                                  
												  <div class="d-flex align-items-center">
                                                      <span class="me-3">Price: ₱ <span class="h6"><?php echo number_format($products['prod_sprice'],2) ?></span></span>
                                                  		<!-- <div class="d-flex">
														                            <span class="h6"><?php echo number_format($products['prod_sprice'],2) ?> </span> 
                                                  		</div> -->
                                                  		<input type="hidden" name="quantity" id="quantity" value="1">
                                                  </div>
												  
												<?php 
                                                    if (isset($_SESSION['user_id'])) {
                                                        ?>
                                                        <!--
                                                              <div class="d-flex align-items-center">
                                                                  <span class="me-3">Quantity:</span>
                                                                  <div class="d-flex">
                                                                      <button type="button" class="btn sub" id="subtract"> <i class="fa fa-minus" ></i></button>
                                                                      <input type="text" name="quantity" id="quantity" value="1" class="form-control text-center" style="width: 5rem;">
                                                                      <button type="button" class="btn add" id="add"> <i class="fa fa-plus" ></i></button>
                                                                  </div>
                                                              </div>
                                                        -->
                                                        <?php
                                                    }
                                                ?>
                                                  

                                                  <style>
                                                    @media (max-width: 305px) {
                                                      #subtract i{
                                                        width: 10px !important;
                                                        
                                                      }
                                                      #subtract, #add{
                                                        width: 10px !important;
                                                      }
                                                      #add i{
                                                        width: 10px !important;
                                                      }
                                                      #quantity{
                                                        width: 50px !important;
                                                      }
                                                    }

                                                    @media (max-width: 263px){
                                                      #subtract i{
                                                        width: 10px !important;
                                                        
                                                      }
                                                      #subtract, #add{
                                                        width: 5px !important;
                                                        font-size: 10px;
                                                        padding: 10px 15px; 
                                                      }
                                                      #add i{
                                                        width: 10px !important;
                                                        font-size: 10px;
                                                      
                                                      }
                                                      #quantity{
                                                        font-size: 10px;
                                                        width: 30px !important;
                                                        
                                                      }
                                                    }
                                                  </style>
                                                
                                                  <input type="hidden" name="user_id" value="<?php echo @$_SESSION['user_id'] ?>">
                                                  <input type="hidden" name="prod_id" value="<?php echo $products['prod_id'] ?>">
                                                  <input type="hidden" name="prod_price" value="<?php echo $products['prod_sprice'] ?>">
                                                  <div class="d-flex mt-3">
                                                      <!-- <a href="?order" class="btn form-control me-3 text-light" id="order">Order Now</a> -->
                                                    <?php 
                                                      if (isset($_SESSION['user_id'])) {
                                                        $checkCart = checkProductFromCart($products, $_SESSION);
                                                        if ($checkCart->num_rows > 0) {
                                                          ?>
                                                            <span class="mx-auto">ADDED TO <i class="fa fa-cart-plus"></i></span>
                                                          <?php
                                                        }else{
                                                          ?>
                                                            <button type="submit" class="btn form-control text-light" name="add_to_cart" id="cart">ADD TO <i class="fa fa-cart-plus"></i> </button>
                                                          <?php
                                                        }
                                                      }
                                                    ?>
                                                  </div>


                                              </form>
                                              </div>

                                              </div>

                                          <!-- PRODUCT -->

                                            <?php
                                          }

                                      }
                                  ?>

                      


                  </div>

                </div>




<!-- MENU -->