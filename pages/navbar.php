<main class="sticky-top" id="content">
       <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-0 px-lg-5 sticky-top" id="mynav">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <div class="d-flex align-items-center">
            <div style="height: 3.5rem; width: 3.5rem; background: url(./assets/img/277672662_352067610270815_2211142084973792741_n.jpg); background-size: cover; background-position: center;" class="rounded-circle shadow-5-soft mt-0 pt-0" >

            </div>
            <h3 class="mt-3 text-light ms-3">Coolers Delight</h3>
        </div>
        <!-- Left links -->
        <ul class="nav me-auto mb-2 mb-lg-0 d-lg-none nav-tabs" id="nav">
            <li class="nav-item w-100">
              <!-- <a class="nav-link text-light active" data-mdb-toggle="tab" href="#home" id="homeTab" onclick="clickTab(1)">Home</a> -->
            </li>
            <li class="nav-item w-100">
              <!-- <a class="nav-link text-light " data-mdb-toggle="tab" href="#menu" id="storeTab" onclick="clickTab(1)">Store</a> -->
            </li>
            <li class="nav-item w-100">
              <!-- <a class="nav-link text-light" data-mdb-toggle="tab" href="#about" id="aboutTab" onclick="clickTab(1)">About</a> -->
            </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
  
      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <ul class="nav d-lg-inline-flex  nav-tabs" id="nav">
            <li class="nav-item">
              <a class="nav-link text-light d-lg-block d-none" data-mdb-toggle="tab" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light active d-lg-block d-none" data-mdb-toggle="tab" href="#menu">Store</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-light d-lg-block d-none" data-mdb-toggle="tab" href="#about">Track Order</a>
            </li>
           <?php              
            if (isset($_SESSION['user_id'])) {
              ?>
                 <li class="nav-item me-3">
              <a class="nav-link" data-mdb-toggle="tab" href="#shop-cart" id="cartTab">
                <i class="fas fa-shopping-cart text-light"></i>
                <span class="badge rounded-pill badge-notification bg-danger" style="top: 10px;" onclick="clickTab(0)"><?php echo cntCartProducts($_SESSION) ?></span>
              </a>
            </li>
              <?php
            }
           ?>
          </ul>
        <!-- Icon -->

        <?php 
          if (!isset($_SESSION['user_id'])) {
              ?>
              <button type="button" class="btn border text-light border-light" data-mdb-toggle="modal" data-mdb-target="#register">Admin</button>
              <?php
          }else{
            ?>      
  
        <!-- Notifications -->
        <!-- <div class="dropdown me-3">
          <a
            class="text-reset me-3 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="fas fa-bell text-light"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php ?> 0</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#track_order" id="track">Track Orders</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Another news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Something else here</a>
            </li>
          </ul>
        </div> -->
        <!-- Avatar -->
        <div class="dropdown">
          <a
            class="dropdown-toggle d-flex align-items-center hidden-arrow"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <div class="rounded-circle border" style="height: 2.5rem; width: 2.5rem; background: url(./assets/img/365197915_686254716852101_330250311951433411_n.jpg); background-size: cover; ">

            </div>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
          >
            <!-- <li>
              <a class="dropdown-item" href="#">My profile</a>
            </li> -->
            <li>
              <a class="dropdown-item" href="#" data-mdb-toggle="modal" data-mdb-target="#change_pass">Change Password</a>
            </li>
            <li>
              <a class="dropdown-item" href="?logout">Logout</a>
            </li>
          </ul>
        </div>
            <?php
          }
        ?>


      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
 </main>
 
 