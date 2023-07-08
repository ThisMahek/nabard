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
                                                <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                            </div>
                                        <!-- <div class="col-md-6 col-6">-->
                                        <!--     <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>-->
                                        <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Images</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Price</th>
                                                    <th>Date & Time</th>
                                                    <th>View Invoice</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" class="imge_categoy"></td>
                                                    <td>Seeds</td>
                                                    <td>Seeds</td>
                                                    <td>Seeds</td>
                                                    <td>₹ 100/-</td>
                                                    <td>2220-09-20 04:00 PM</td>
                                                    <td><a href="<?php echo base_url()?>Admin/invoice" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                                                    <td><button type="button" class="btn btn-success">Active</button></td>
                                                    <td><button type="button" class="btn btn-success waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        <!-- END layout-wrapper -->

        <!--------------------------------------------Update Modal  ---------------------------->
        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update Status of Order</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form id="pristine-valid-example" novalidate method="post">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select form_control">
                                                <option>Dilevered</option>
                                                <option>Pending</option>
                                                <option>Cancle</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                    </div>
                </div>
            </div>
        </div>                
   <!--------------------------------------------End Edit Modal  ---------------------------->
         <?php include('includes/footer.php')?>         

    </body>
</html>