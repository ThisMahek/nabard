<!doctype html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<?php include('includes/common-head.php')?>
 <style>.color-black{color:black!important;font-weight: 700;font-size: 18px;vertical-align: middle;margin-left: 5px;}</style>
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
                                                <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="mb-4">
                                                        <img src="<?php echo base_url()?>assets/images/pfopic.png" alt="" height="24"><span class="color-black">Yash</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="mb-4">
                                                        <h4 class="float-end font-size-16">Invoice # 12345</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mb-1">1874 County Line Road City, FL 33566</p>
                                            <p class="mb-1"><i class="mdi mdi-email align-middle me-1"></i> abc@123.com</p>
                                            <p><i class="mdi mdi-phone align-middle me-1"></i> 012-345-6789</p>
                                        </div>
                                        <hr class="my-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <h5 class="font-size-15 mb-3">Billed To:</h5>
                                                    <h5 class="font-size-14 mb-2">Yash</h5>
                                                    <p class="mb-1">Delhi</p>
                                                    <p class="mb-1">yash@gmail.com</p>
                                                    <p>+91-9876543210</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <div>
                                                        <h5 class="font-size-15">Order Date:</h5>
                                                        <p>February 16, 2022</p>
                                                    </div>
                                                    
                                                    <div class="mt-4">
                                                        <h5 class="font-size-15">Payment Method:</h5>
                                                        <p class="mb-1">Visa ending **** 4242</p>
                                                        <p>yash@gmail.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-2 mt-3">
                                            <h5 class="font-size-15">Order summary</h5>
                                        </div>
                                        <div class="p-4 border rounded">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">No.</th>
                                                            <th>Item</th>
                                                            <th class="text-end" style="width: 120px;">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">01</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Lorem Ipsum</h5>
                                                                <p class="font-size-13 text-muted mb-0">Lorem Ipsum is simply dummy text </p>
                                                            </td>
                                                            <td class="text-end">₹ 499.00</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">02</th>
                                                            <td>
                                                                <h5 class="font-size-15 mb-1">Lorem Ipsum</h5>
                                                                <p class="font-size-13 text-muted mb-0">Lorem Ipsum is simply dummy text </p>
                                                            </td>
                                                            <td class="text-end">₹ 499.00</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end">₹ 998.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">
                                                                Tax</th>
                                                            <td class="border-0 text-end">₹ 12.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">Total</th>
                                                            <td class="border-0 text-end"><h4 class="m-0">₹ 1010.00</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="d-print-none mt-3">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        <!-- END layout-wrapper -->

         <?php include('includes/footer.php')?>         

    </body>
</html>