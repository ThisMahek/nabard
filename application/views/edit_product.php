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
                                           <h4 class="card-title title_head">Update Product</h4>
                                       </div>
                                        <div class="col-md-6 col-6">
                                                <a href="<?php echo base_url()?>Admin/manage_product"><button type="button" class="btn btn-primary waves-effect waves-light view_btn">View product</button></a>
                                           </div>
                                    </div>
                                    <div class="card-body">
        
                                        <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Product Name</label>
                                                            <input type="text" required placeholder="Enter Product Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Product Name(Hindi)</label>
                                                            <input type="text" required placeholder="Enter Product Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Category</label>
                                                            <input type="text" required placeholder="Enter Category" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label">Sub Category</label>
                                                            <select required="" class="form-control form-select fom_select">
                                                                <option value="">Select Category</option>
                                                                <option value="wr">Category 2</option>
                                                                <option value="ph">Category 3</option>
                                                                <option value="cy">Category 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Mrp</label>
                                                            <input type="text" required placeholder="Enter Mrp" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Price</label>
                                                            <input type="text" required placeholder="Enter Price" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Quantity</label>
                                                            <input type="text" required placeholder="Enter Quantity" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6">
                                                      <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" id="formFileLg" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control">
                                                            <option>Active</option>
                                                            <option>Inactive</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Submit</button>
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