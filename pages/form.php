                                                            <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-4" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true" >Admin Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false" >Register</a>
                </li>
                <!--<li class="nav-item" role="presentation">-->
                <!--    <a class="nav-link" id="tab-change" data-mdb-toggle="pill" href="#pills-change" role="tab" aria-controls="pills-change" aria-selected="false" >Change Password</a>-->
                <!--</li>-->
        </ul>
                                            <!-- Pills navs -->

                                            <!-- Pills content -->
                <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

                                                <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="loginName" class="form-control" name="email" />
                        <label class="form-label" for="loginName">Username</label>
                    </div>

                                                <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="loginPassword" class="form-control" name="password" />
                        <label class="form-label" for="loginPassword">Password</label> 
                    </div>

                                                <!-- 2 column grid layout -->
                    <!--<div class="row mb-4">-->
                    <!--    <div class="col-md-6 d-flex justify-content-center">-->
                                                    <!-- Checkbox -->
                    <!--        <div class="form-check mb-3 mb-md-0">-->
                    <!--            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />-->
                    <!--            <label class="form-check-label" for="loginCheck"> Remember me </label>-->
                    <!--        </div>-->
                    <!--    </div>-->

                    <!--<div class="col-md-6 d-flex justify-content-center">-->
                                                    <!-- Simple link -->
                    <!--    <a href="#!">Forgot password?</a>-->
                    <!--    </div>-->
                    <!--</div>-->

                                                <!-- Submit button -->
                    <button type="submit" class="button btn btn-primary btn-block mb-4" name="login">Sign in</button>

                                                <!-- Register buttons -->
                 
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                              
                                                <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="registerName" name="fname" class="form-control" />
                        <label class="form-label" for="registerName">Firstname</label>
                    </div>

                                                 <!-- Name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="registerName" name="lname" class="form-control" />
                        <label class="form-label" for="registerName">Lastname</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" id="registerName" name="contact" class="form-control"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" minlength="11" />
                        <label class="form-label" for="registerName">Contact Number</label>
                    </div>

                                             

                                                <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="registerEmail" class="form-control" name="email" />
                        <label class="form-label" for="registerEmail">Email</label>
                    </div>

                    <!-- Checkbox -->
      <div class="form-check d-flex justify-content-center mb-4">
        <input
          class="form-check-input me-2"
          type="checkbox"
          value=""
          id="registerCheck"
          checked
          aria-describedby="registerCheckHelpText"
        />
        <label class="form-check-label" for="registerCheck">
          I have read and agree to the terms
        </label>
      </div>

                                           

                                                <!-- Submit button -->
                    <button type="submit" class="button btn btn-primary btn-block mb-3" name="signup">Sign Up</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-change" role="tabpanel" aria-labelledby="tab-change">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                                
                    <div class="container">
                    	<div class="row">
                    		<div class="col">
                    		    
                    		    <label>Current Password</label>
                    		    <div class="form-group pass_show"> 
                                    <input type="password" value="faisalkhan@123" class="form-control" placeholder="Current Password"> 
                                </div> 
                    		       <label>New Password</label>
                                <div class="form-group pass_show"> 
                                    <input type="password" value="faisal.khan@123" class="form-control" placeholder="New Password"> 
                                </div> 
                    		       <label>Confirm Password</label>
                                <div class="form-group pass_show"> 
                                    <input type="password" value="faisal.khan@123" class="form-control" placeholder="Confirm Password"> 
                                </div> 
                                
                    		</div>  
                    	</div>
                    </div>

                    <!-- Checkbox -->
      <!--<div class="form-check d-flex justify-content-center mb-4">-->
      <!--  <input-->
      <!--    class="form-check-input me-2"-->
      <!--    type="checkbox"-->
      <!--    value=""-->
      <!--    id="registerCheck"-->
      <!--    checked-->
      <!--    aria-describedby="registerCheckHelpText"-->
      <!--  />-->
      <!--  <label class="form-check-label" for="registerCheck">-->
      <!--    I have read and agree to the terms-->
      <!--  </label>-->
      <!--</div>-->

                                                <!-- Submit button -->
                    <button type="submit" class="button btn btn-primary btn-block mb-3" name="change_pass">Change</button>
                    </form>
                </div>
                </div>
    <!-- Pills content -->

                                            