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
                                            <div class="col-md-6 col-6">
                                                 <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#addModal">+ Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Images</th>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" class="imge_categoy"></td>
                                                    <td>Image 1</td>
                                                    <td><button type="button" class="btn btn-success">Active</button></td>
                                                    <td><button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit"></i></button>
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
        
<!--------------------------------------------Add Modal  ---------------------------->
        <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add Gallery</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form id="pristine-valid-example" novalidate method="post">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Upload Image</label>
                                            <input type="file" class="form-control form_control" required accept="image/*">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Image Title</label>
                                            <input type="text" class="form-control form_control" placeholder="Enter Image Title" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select form_control" required>
                                                <option>Active</option>
                                                <option>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Add</button>
                    </div>
                </div>
            </div>
        </div>                
   <!--------------------------------------------End Edit Modal  ---------------------------->

        <!--------------------------------------------Update Modal  ---------------------------->
        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update Gallery</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form id="pristine-valid-example" novalidate method="post">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <label for="fileToUpload">
                                            <center><img class="profile-pic" id="imgPreview" src="<?php echo base_url()?>assets/images/pfopic.png" style="border:none;height:180px;width:180px;"/></center>
                                            <span class="glyphicon glyphicon-camera"></span>
                                        </label>
                                        <input type="File" name="profile" id="fileToUpload" onchange="previewPhotoInput(this)" accept="image/png, image/jpeg, image/jpg" style="display:none;"> 
                                    </div>
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Image Title</label>
                                            <input type="text" class="form-control form_control" Value="Image Title" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select form_control" required>
                                                <option>Active</option>
                                                <option>Inactive</option>
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