<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <?php include('includes/common-head.php')?>
    <style>.card{box-shadow: 0 0 5px 0 #c9c4c4;}.bg-overlay {opacity: .9;}.form_control {box-shadow: 0 0 5px 0 #c9c4c4;padding: 14px 5px;}
    /*.b-radius{border-top-right-radius: 25px;border-bottom-left-radius: 25px;}*/
    .b-radius{border-radius:25px;padding:15px;}
    
    </style>
</head>
    <body>
    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="bg-overlay bg-primary"></div>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <div class="container-fluid p-0">
                <div class="row g-0 justify-content-center">
                    <div class="col-xxl-4 col-lg-4 col-md-4">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-content my-auto">
                                        <div class="card b-radius">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <h4 class="mb-0"><?php echo $page_name; ?></h4>
                                                    <b style="color:#e53333;"><?php echo $error=$this->session->flashdata('error');?></b>
                                                </div>
                                                     <?= form_open('login/checklogin','class="mt-4 pt-2"');?>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email Id/Mobile No.</label>
                                                        <input type="text" class="form-control form_control" name="email" id="username" 
                                                        placeholder="Enter Email Id/Mobile No" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1">
                                                                <label class="form-label">Password</label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="">
                                                            <input type="password" class="form-control form_control" 
                                                            name="password" id="psw1" placeholder="Enter password" aria-label="Password" 
                                                            aria-describedby="password-addon" required>
                                                             <div style="width: 100%;">
                                                                  <div  type="button" id="password-addon" style="text-align: right;padding-right: 17px;margin-top: -35px;width: 29px;float: right;">
                                                                        <i class="fa fa-eye-slash show icon-hide" id="p1" onclick="showpwd()"> </i>
                                                                        <i class="fa fa-eye show icon-hide" id="p2" style="display:none;" onclick="showpwd()"> </i>
                                                                    </div>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                            <div class="form-check"><br>
                                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                                <label class="form-check-label" for="remember-check">Remember me</label>
                                                            </div>  
                                                        </div>                                                
                                                    </div>
                                                    <div class="mb-3">
                                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="<?php echo base_url()?>assets/libs/jquery/jquery.min.js"></script>
        <!-- Required datatable js -->
        <script src="<?php echo base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
       <!-- Responsive examples -->
        <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo base_url()?>assets/js/pages/datatables.init.js"></script>  
        <!-- JAVASCRIPT -->
        
        <script src="<?php echo base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="<?php echo base_url()?>assets/libs/pace-js/pace.min.js"></script>

        <!-- apexcharts -->
        <script src="<?php echo base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="<?php echo base_url()?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="<?php echo base_url()?>assets/js/pages/dashboard.init.js"></script>

        <script src="<?php echo base_url()?>assets/js/app.js"></script>
 <script>
function showpwd() {
  var x = document.getElementById("psw1");
 
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("p1").style.display = "none";
    document.getElementById("p2").style.display = "contents";
  } else {
    x.type = "password";
    document.getElementById("p2").style.display = "none";
    document.getElementById("p1").style.display = "contents";
  }
}
</script>
    </body>
</html>