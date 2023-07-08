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
                                         <li class="breadcrumb-item" style="color:green;font-weight:600;"><?php echo $error=$this->session->flashdata('error'); ?></li>
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
                                           <h4 class="card-title title_head">Manage Notifications</h4>
                                           </div>
                                            <div class="col-md-6 col-6">
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
        
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Share To</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $i=1;
                                                foreach ($notic as $nottic)
                                                {
                                                ?>
                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#view_message<?= $nottic['id']?>">
                                                          View Message
                                                    </button>
                                                    </td>
                                                <td><?= $nottic['created_at'];?></td>

                                                <?php if($nottic['share_status'] ==1):?>
                                                    <td>All</td>
                                                    <?php elseif($nottic['share_status'] ==2):?>
                                                        <td>User</td>
                                                        <?php else:?>
                                                            <td>Vendor</td>
                                                            <?php endif;?>
                                                
                                               <?php  if($nottic['share_status']==1):?> 
                                            <?php endif;?>
                                            
                                            
                                            
                                                <!-- <td> -->
                                             <!--        <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#editModal<?= $nottic['id']?>"><i class="fa fa-edit"></i></button> -->
                                                
                                                 <!--view message modal-->
                                                      <div class="modal fade" id="view_message<?= $nottic['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Notification Message</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                              </div>
                                                              <div class="modal-body" style="white-space: initial;">
                                                                  <?= $nottic['msg'];?>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      <!--view message modal-->
                                                <!--------------------------------------------Update Modal  ---------------------------->
  
                
 <div id="editModal<?= $nottic['id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Notification</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                              <div class="card-body">
                                        <div>
                                          <?= form_open_multipart("Master/Edit_notification_db/{$nottic['id']}",'id="pristine-valid-example"');?>
                                                 <div class="row">
                                                    <div>
                                                         <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                             <?php
                                                            if($nottic['status'] =='1')
                                                            {
                                                            ?>
                                                            <option value="1">Active</option>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                               ?>
                                                            <option value="2">Inactive</option>
                                                            <?php   
                                                            }
                                                            ?>
                                                            <option value="1">Active</option>
                                                            <option value="2'">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Share Torrrrrrr</label>
                                                        <select class="form-select form_control" name="share_status">
                                                             <?php
                                                            if($nottic['share_status'] =='1')
                                                            {
                                                            ?>
                                                            <option value="1">All</option>
                                                            <?php
                                                            }
                                                            elseif($slid['share_status'] =='2')
                                                            {
                                                            ?>
                                                            <option value="2">User</option>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                               ?>
                                                            <option value="3">Vendor</option>
                                                            <?php   
                                                            }
                                                            ?>
                                                            <option value="1">All</option>
                                                            <option value="2">User</option>
                                                            <option value="3">Vendor</option>
                                                        </select>
                                                    </div>
                                                 
                                                   </div>
                                                        <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Message</label>
                                                            <textarea type="text" name="msg" required placeholder="Enter Your Message" 
                                                            class="form-control form_control"/><?= $nottic['msg'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <button type="submit" id="btn_submit" class="btn btn-primary btn-sm waves-effect waves-light common_btn">Update</button>
                                                <!-- end row -->
                                            </form>
                                        </div>

                                    </div>
                                  
                              
                                      </div>
                                    <div class="modal-footer">
                                     </div>
                                </div>
                            </div>
                        </div>                
                
   <!--------------------------------------------End Edit Modal  ---------------------------->
                                                
                                                  <!-- <a href="<?= base_url('Master/Delete_notification/'.$nottic['id']); ?>">
                                                <button type="button" onclick="isconfirm()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </a>
                                                </td> -->
                                            </tr>
                                            <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
        
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

        
  <!--------------------------------------------Add Modal  ---------------------------->
             
 <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Add Notification</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <?= form_open_multipart('Master/Add_notification_db','id="pristine-valid-example"');?>
                                                 <div class="row">
                                                    <div>
                                                   <!--  <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="2'">Inactive</option>
                                                        </select>
                                                    </div> -->
                                                    <div class="form-group mb-3">
                                                        <label>Share To</label>
                                                        <select class="form-select form_control" name="share_status">
                                                            <option value="1">All</option>
                                                            <option value="2">User</option>
                                                            <option value="3">Vendor</option>
                                                        </select>
                                                    </div>
                                                   </div>
                                                        <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Message</label>
                                                            <textarea type="text" name="msg" required placeholder="Enter Your Message" 
                                                            class="form-control form_control"/></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <button type="submit" id="btn_submit" class="btn btn-primary btn-sm waves-effect waves-light common_btn">Add</button>
                                                <!-- end row -->
                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>                
                
   <!--------------------------------------------End Add Modal  ---------------------------->  
   
   
     
  <script>
   
         
function isconfirm(){

if(!confirm('Are you sure Delete it?')){
event.preventDefault();
return;
}
return true;
}

   </script>
         <?php include('includes/footer.php')?>         

    </body>
</html>