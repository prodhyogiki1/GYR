<?php 
include('../session.php');
include('header.php');?>
<!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
              <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo $base_url;?>theme/assets/images/logos/logo.jpeg" width="180" alt="">
                </a>
                <p class="text-center">Get Your Ride</p>
                <span id="msgasignup"></span>
                <form id="asignup" action="<?php echo $base_url.'index.php?action=agent&query=signup';?>" method="post" name="agent_sinup">
                  <div class="mb-3 row">
                    <div class="col-sm-6">
                      <label for="exampleInputtext1" class="form-label">First Name</label>
                      <input type="text" class="form-control" name="fname">
                    </div>
                    <div class="col-sm-6">
                      <label for="exampleInputtext1" class="form-label">Last Name</label>
                      <input type="text" class="form-control" name="lname">
                    </div>
                    
                  </div>
                  <div class="mb-3 row">
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col-sm-6">
                      <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                      <input type="number" class="form-control" name="phone">
                    </div>
                  </div>
                  
                  <div class="mb-4 row">
                    <div class="col-sm-6">
                      <label for="exampleInputPassword1" class="form-label">GSTIN</label>
                      <input type="text" class="form-control" name="gstin">
                    </div>

                    <div class="col-sm-6">
                      <label for="exampleInputPassword1" class="form-label">PAN Number</label>
                      <input type="text" class="form-control" name="pan">
                    </div>
                  </div>
                  
                  <div class="mb-4 row">
                    
                    <div class="col-sm-6">
                      <input type="reset" name="reset" value="Reset" class="btn btn-secondary rounded-2 w-100 fs-4 mb-4 ">
                    </div>

                    <div class="col-sm-6">
                    <input type="submit" onclick="form_submit('asignup')" class="btn btn-primary w-100 fs-4 mb-4 rounded-2" value="Sign Up">
                    </div>
                  
                  </div>
                </form>


                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="<?php echo $base_url;?>">Sign In</a>
                  </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php');?>