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

                    <?= $this->session->userdata('success')?>
                    <?= $this->session->userdata('error')?>
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
                                            <!--<div class="col-md-6 col-6">-->
                                            <!--     <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#addModal">+ Add</button>-->
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>User Name</th>
                                                    <th>Vendor Name</th>
                                                    <th>Suggestion/Issue</th>
                                                    <th>User Message</th>
                                                    <th>Admin Reply</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php if (!empty($users_enquiry)):
                                                $i = 0;
                                                ?>
                                                <?php foreach ($users_enquiry as $row):
                                                    $i++;
                                                    ?>
                                                <tr>
                                                    <td><?= $i?></td>
                                                    <td><?= $row['user_name']?></td>
                                                    <td><?= $row['vendor_name']?></td>
                                                    <td><?= $row['issue_type']?$row['issue_type']:'---'?></td>
                                                    <td><?= $row['user_msg']?$row['user_msg']:'---'?></td>
                                                    <td><button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#addModal<?= $row['enq_id']?>">Reply</button></td>
                                                    <td><a href="<?= base_url()?>vendor/delete_admin_enquiry/<?= $row['enq_id']?>"   onclick="return confirm('Are you sure you want to delete enquiry?')"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                                </tr>
                                                <?php endforeach;?>
                                                <?php endif;?>
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
<?php if (!empty($users_enquiry)):
                $i = 0;
                ?>
                <?php foreach ($users_enquiry as $row):
                    $i++;
                    ?>
        <div id="addModal<?= $row['enq_id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Admin Reply</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form id="pristine-valid-example" action="<?= base_url()?>vendor/admin_reply_to_user/<?= $row['enq_id']?>"  method="post">
                                <div class="row">
                                        <div class="form-group mb-3">
                                            <label>Reply</label>
                                            <textarea type="text" id="" required="" name="admin_msg" placeholder=""  value="" class="form-control form_control" ><?=($row['admin_msg'])?$row['admin_msg']:''?></textarea>
                                        </div>
                    
                                    </div>
                                </div>
                           
                        </div>
                    <div class="modal-footer">
                        
                        <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light common_btn" <?= !empty($row['admin_msg'])?'disabled':''?> >Submit</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>  
        <?php endforeach;?>
        <?php endif;?>
   <!--------------------------------------------End Edit Modal  ---------------------------->

        <!--------------------------------------------Update Modal  ---------------------------->
        <!--<div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">-->
        <!--    <div class="modal-dialog">-->
        <!--        <div class="modal-content">-->
        <!--            <div class="modal-header">-->
        <!--                <h5 class="modal-title" id="myModalLabel">Update Contact Enquiry</h5>-->
        <!--                <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>-->
        <!--            </div>-->
        <!--            <div class="modal-body">-->
        <!--                <div class="card-body">-->
        <!--                    <form id="pristine-valid-example" novalidate method="post">-->
        <!--                        <div class="row">-->
        <!--                            <div class="col-xl-12 col-md-12">-->
        <!--                                <div class="form-group mb-3">-->
        <!--                                    <label>Contact No.*</label>-->
        <!--                                    <input type="number" class="form-control form_control" value="9876543210" required>-->
        <!--                                </div>-->
        <!--                                <div class="form-group mb-3">-->
        <!--                                    <label>Email*</label>-->
        <!--                                    <input type="email" class="form-control form_control" value="admin@gmail.com" required>-->
        <!--                                </div>-->
        <!--                                <div class="form-group mb-3">-->
        <!--                                    <label>Address*</label>-->
        <!--                                    <input type="text" class="form-control form_control" value="Delhi" required>-->
        <!--                                </div>-->
        <!--                                <div class="form-group mb-3">-->
        <!--                                    <label>Status</label>-->
        <!--                                    <select class="form-select form_control">-->
        <!--                                        <option>Active</option>-->
        <!--                                        <option>Inactive</option>-->
        <!--                                    </select>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </form>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="modal-footer">-->
        <!--                <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Update</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>                -->
   <!--------------------------------------------End Edit Modal  ---------------------------->
         <?php include('includes/footer.php')?>         
    </body>
</html>