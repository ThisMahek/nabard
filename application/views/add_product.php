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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Add Product</h4>
                                </div>
                                <div class="card-body">
                                    <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav">
                                            <li class="nav-item">
                                                <a href="#seller-details" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Seller Details">
                                                        <i class="bx bx-list-ul"></i>
                                                    </div>
                                                    <h6 class="mt-2">Basic Details</h6> 
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#company-document" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Company Document">
                                                        
                                                         <i class="bx bx-money"></i>
                                                    </div>
                                                    <h6 class="mt-2"> Pricing</h6>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Bank Details">
                                                         <i class="bx bx-book-bookmark"></i>
                                                    </div>
                                                    <h6 class="mt-2"> Stock</h6>
                                                </a>
                                            </li>
                                              <li class="nav-item">
                                                <a href="#variants" class="nav-link" data-toggle="tab">
                                                    <div class="step-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Bank Details">
                                                        <i class="bx bx-bar-chart"></i>
                                                    </div>
                                                    <h6 class="mt-2"> Variants</h6>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- wizard-nav -->

                                        <div class="tab-content twitter-bs-wizard-tab-content">
                                            <div class="tab-pane" id="seller-details">
                                          
                                            <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
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
                                                            <label>Description</label>
                                                            <input type="text" required placeholder="Enter Description" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                   
                                                
                                                </div>
                                            </form>

                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="next"><a href="javascript: void(0);"
                                                            class="btn btn-primary" onclick="nextTab()">Next <i
                                                                class="bx bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                            <!-- tab pane -->
                                            <div class="tab-pane" id="company-document">
                                                <div>
                                                    
                                                    <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Product MRP</label>
                                                            <input type="text" required placeholder="Enter Product MRP" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Your Selling Price</label>
                                                            <input type="text" required placeholder="Enter Your Selling Price" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                              
                                                </div>
                                            </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="javascript: void(0);"
                                                                class="btn btn-primary" onclick="nextTab()"><i
                                                                    class="bx bx-chevron-left me-1"></i> Previous</a>
                                                        </li>
                                                        <li class="next"><a href="javascript: void(0);"
                                                                class="btn btn-primary" onclick="nextTab()">Next <i
                                                                    class="bx bx-chevron-right ms-1"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- tab pane -->
                                            <div class="tab-pane" id="bank-detail">
                                                <div>
                                                   
                                                   <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                          
                                                         <div class="col-xl-6 col-md-6">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label">Stock Management</label>
                                                            <select required="" class="form-control form-select fom_select">
                                                                <option value="">Stock Management</option>
                                                                <option value="wr">Stock</option>
                                                                <option value="ph">Out of Stock</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Available Stock</label>
                                                            <input type="text" required placeholder="Enter Your Available Stock" class="form-control form_control" />
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
                                                            <label>Total Product</label>
                                                            <select class="form-select form_control">
                                                                <option>Active</option>
                                                                <option>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="javascript: void(0);"
                                                                class="btn btn-primary" onclick="nextTab()"><i
                                                                    class="bx bx-chevron-left me-1"></i> Previous</a>
                                                        </li>
                                                        <li class="float-end"><a href="javascript: void(0);"
                                                                class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target=".confirmModal">Save
                                                               </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <!-- tab pane -->
                                            
                                                <div class="tab-pane" id="variants">
                                                <div>
                                                    
                                                    <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Product MRP</label>
                                                            <input type="text" required placeholder="Enter Product MRP" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Your Selling Price</label>
                                                            <input type="text" required placeholder="Enter Your Selling Price" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                              
                                                </div>
                                            </form>
                                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                        <li class="previous"><a href="javascript: void(0);"
                                                                class="btn btn-primary" onclick="nextTab()"><i
                                                                    class="bx bx-chevron-left me-1"></i> Previous</a>
                                                        </li>
                                                        <li class="next"><a href="javascript: void(0);"
                                                                class="btn btn-primary" onclick="nextTab()">Next <i
                                                                    class="bx bx-chevron-right ms-1"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                         <?php include('includes/footer.php')?>         
    </body>
</html>