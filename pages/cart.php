<div class="tab-pane fade" id="shop-cart" role="tabpanel" aria-labelledby="ex1-tab-4"> 
    <div class="container-fluid px-5 py-3" >
        <div class="row">
          
            
            <div class="col">                
                <style>
                  @media (min-width: 1025px) {
                  .h-custom {
                  height: 100vh !important;
                  }
                  }
                </style>
                  <!-- Shopping Cart -->
                <section class="h-10 h-custom flex-fill" style="background-color: #eee;">
                  <div class="container py-5 h-100">
                    <div class="d-flex align-items-center justify-content-between">
                      <h3 class="text-dark me-3"><i class="fa fa-shopping-cart"></i> My Cart</h3>
                      <button type="button" class="btn border text-dark border-warning <?php echo cntCartProducts($_SESSION['user_id'])>0? :"disabled"; ?>" data-mdb-toggle="modal" data-mdb-target="#orderNow">Check Out</button>
                  </div>
                    <div class="row d-flex justify-content-center align-items-center h-100">
                      <div class="col">
                        <div class="card">
                          <div class="card-body p-4">

                            <div class="row">
                              <div class="col">
                                <h5 class="mb-3"><a href="index.php" class="text-body"><i
                                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                  <div>
                                    <p class="mb-1">Shopping cart</p>
                                    <p class="mb-0">You have <?php echo cntCartProducts($_SESSION) ?> item(s) in your cart</p>
                                  </div>
                                  <div>
                                    <p class="mb-0"><span class="text-muted">Total: <h3 class="text-danger">₱ <?php echo number_format(totalAllCart($_SESSION),2) ?></h3> </span>
                                    </p>
                                  </div>
                                </div>
                                <?php 
                                                  $prod_que = getAllCartByUser($_SESSION['user_id']);
                                                  if ($prod_que->num_rows > 0) {
                                                      
                                                      while ($products = $prod_que->fetch_array()) {
                                                        ?>
                                <!-- PRODUCT -->
                                <div class="card mb-3">
                                  <div class="card-body">
                                    <form action="" method="post">
                                      <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                          <div>
                                            <img
                                              src="./assets/img/<?php echo $products['prod_img'] ?>"
                                              class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                          </div>
                                          <div class="ms-3">
                                            <h5 class="text-capitalize"><?php echo $products['prod_name'] ?></h5>
                                            <p class="small mb-0">256GB, Navy Blue</p>
                                          </div>
                                        </div>
                                        <?php 
                                              if (isset($_SESSION['user_id'])) {
                                                  ?>
                                        <div class="d-flex flex-row align-items-center">
                                          <span class="me-3">Quantity:</span>
                                          <div class="d-flex" style="height:30px;">
                                              <button type="button" class="btn sub" id="subtract"> <i class="fa fa-minus" ></i></button>
                                              <input type="text" name="quantity" id="quantity" value="<?php echo $products['quantity'] ?>" class="form-control text-center" style="width: 3rem;">
                                              <button type="button" class="btn add" id="add"> <i class="fa fa-plus" style="font-size:14px;" ></i></button>
                                          </div>
                                          <?php
                                              }
                                          ?>
                                          <div class ="mx-1" style="width: 55px;">
                                            <h6 class="fw-normal mb-0">Update</h6>
                                          </div>
                                          <input type="hidden" name="user_id" value="<?php echo @$_SESSION['user_id'] ?>">
                                          <input type="hidden" name="prod_id" value="<?php echo $products['prod_id'] ?>">
                                          <input type="hidden" name="prod_price" value="<?php echo $products['prod_sprice'] ?>">
                                          <div style="width: 50px;">
                                            <button type="submit" name="update" ><i class="fa fa-pen-to-square" aria-hidden="true" style="font-size:16px;"></i></button>
                                          </div>
                                          <div style="width: 120px;">
                                            <h5 class="mb-0 text-danger">₱ <?php echo number_format($products['total'],2) ?></h5>
                                          </div>                                          
                                          <a href="?remove&prod_id=<?php echo $products['prod_id'] ?>" style="font-size:25px;"><i class="fa fa-trash-alt"></i></a>
                                        </div>
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

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                  <!-- Shopping Cart -->
            </div>
        </div>
       
    </div>

</div>