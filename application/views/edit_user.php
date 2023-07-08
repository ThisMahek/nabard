<!doctype html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<?php include('includes/common-head.php')?>
 
</head>
<body>
    <div id="layout-wrapper">
        <?php include('includes/header.php')?>
        <?php include('includes/sidebar.php')?>           
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                    <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <!--<h4 class="mb-sm-0 font-size-18"><?php echo $page_name; ?></h4>-->
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active"><?php echo $page_name; ?></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
   
     
                             <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                           <h4 class="card-title title_head">Update User</h4>
                                       </div>
                                       <div class="col-md-6 col-6">
                                                <a href="<?php echo base_url()?>Admin/manage_user"><button type="button" class="btn btn-primary waves-effect waves-light view_btn">View User</button></a>
                                           </div>
                                    </div>
                                    <div class="card-body">
        
                                        <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Your Name*</label>
                                                            <input type="text" required placeholder="Enter Your Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                      <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" id="formFileLg" type="file" accept="image/*">
                                                        </div>
                                                    </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>FPO Name*</label>
                                                            <input type="text" required placeholder="Enter FPO Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Representative*</label>
                                                            <input type="text" required placeholder="Enter Representative" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Board of Director*</label>
                                                            <input type="text" required placeholder="Enter Board of Director" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Board of Director Name</label>
                                                            <input type="text" required placeholder="Enter Board of Director Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Mobile No</label>
                                                            <input type="text" required placeholder="Enter Mobile No" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Email Id</label>
                                                            <input type="text" required placeholder="Enter Email Id" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Registration No*</label>
                                                            <input type="text" required placeholder="Enter Registration No" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Promoting Agency</label>
                                                            <input type="text" required placeholder="Enter Promoting Agency" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Office Address*</label>
                                                            <input type="text" required placeholder="Enter Office Address" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                          <div class="col-xl-6 col-md-6">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label">District </label>
                                                            <select required="" class="form-control form-select fom_select">
                                                                <option value="">Select District</option>
                                                                <option value="wr">Jhansi</option>
                                                                <option value="ph">Agra</option>
                                                                <option value="cy">Aligarh</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Block*</label>
                                                            <input type="text" required placeholder="Enter Promoting Agency" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                        
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Product*</label>
                                                            <input type="text" required placeholder="Enter A to Z Urea Fertilisers" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Basic Information*</label>
                                                            <textarea type="text" required placeholder="Enter Basic Information" class="form-control form_control" /></textarea>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>User Id</label>
                                                            <input type="text" required placeholder="Enter User Id" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                 
                                                </div>
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                                                <!-- end row -->
                                            </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> 
                         <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


        </div>
        <!-- END layout-wrapper -->


         <?php include('includes/footer.php')?>         

    </body>
</html>