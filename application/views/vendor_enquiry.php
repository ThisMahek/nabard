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
   
     <?= $this->session->userdata('success')?>
     <?= $this->session->userdata('error')?>
                             <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                           <h4 class="card-title title_head">Manage General Enquiry</h4>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>User Name</th>
                                                <th>User Mobile No</th>
                                                <th>Vendor Name</th>
                                                <th>Vendor ID</th>
                                                <th>Suggestion/Issue</th>
                                                <th>Message</th>
                                                <th>Vendor Reply</th>
                                                <!--<!--<th>Status</th>-->
                                                 <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($general_enquiry)):
                                                    $i = 0;
                                                    ?>
                                                <?php foreach ($general_enquiry as $row):
                                                        $i++;
                                                    ?>
                                                <tr>
                                                <td><?= $i ?></td>
                                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewModal<?= $row['enq_id']?>"><?= $row['user_name']?></a></td>
                                                <td><?= $row['user_mobile']?></td>
                                                 <td><?= $row['vendor_name']?></td>
                                                 <td><?= $row['vendor_id']?></td>
                                                 <td><?= ($row['issue_type'])?$row['issue_type']:'--'?></td>
                                                 <td><?= $row['user_msg']?$row['user_msg']:'--'?></td>
                                                 <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#replyModal<?=$row['user_id']?>">vendor reply</td>
                                                 <?php 
                                                //  if( $row['status']=='0'):
                                                 ?>
                                                <!--<td><span class="badge badge-warning">Pending</span></td>-->
                                                <?php 
                                                // elseif($row['status']=='1'):
                                                ?>
                                                    <!--<td><span  class="badge badge-success">Accept</span></td>  -->
                                                    <?php
                                                    // elseif($row['status']=='3'):
                                                    ?>
                                                    <!--<td><span class="badge badge-danger">Cancelled</span></td>  -->
                                                    <?php
                                                    // elseif($row['status']=='4'):
                                                    ?>
                                                    <!--<td><span class="badge badge-success">Delivered</span></td>  -->
                                                <?php 
                                                // endif;
                                                ?>
                                                <td> <a    href ="<?= base_url()?>vendor/delete_general_enquiry/<?= $row['enq_id']?>"    onclick="return confirm('Are you sure you want to delete enquiry?')"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                                 
                                            </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>

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

        
   <!--------------------------------------------profile Modal  ---------------------------->  
   
   
   <?php if (!empty($general_enquiry)):  ?>
     <?php foreach ($general_enquiry as $row):  ?>
    <div id="viewModal<?= $row['enq_id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">User Details</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                              <div class="card-body">
                <div>
                    <form>
  
                       <div class="row">
                            <div class="col-md-4 col-4"><h6>Your Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['user_name']?></span></div>
                            
                           <!--  <div class="col-md-4 col-4"><h6>FPO Name: </h6></div>
                            <div class="col-md-8 col-8"><span>Agrix PVT LTD</span></div>
                            
                             <div class="col-md-4 col-4"><h6>Representative: </h6></div>
                            <div class="col-md-8 col-8"><span>Indian Farm Forestry Cooperative Ltd</span></div>
                            
                            <div class="col-md-4 col-4"><h6>Board of Director: </h6></div>
                            <div class="col-md-8 col-8"><span>01</span></div>
                            
                             <div class="col-md-4 col-4"><h6>Board of Director Name: </h6></div>
                            <div class="col-md-8 col-8"><span>Dinesh Singh</span></div>
                             -->
                            <div class="col-md-4 col-4"><h6>Mobile No: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['user_mobile']?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>Email Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['user_email']?></span></div>
                            
                          <!--   <div class="col-md-4 col-4"><h6>Registration No: </h6></div>
                            <div class="col-md-8 col-8"><span>U01403UP2013PTC057445</span></div>
                            
                              <div class="col-md-4 col-4"><h6>Promoting Agency: </h6></div>
                            <div class="col-md-8 col-8"><span>Vidhya Prakash Marketing Pvt LTD</span></div>
                            
                            <div class="col-md-4 col-4"><h6>Office Address: </h6></div>
                            <div class="col-md-8 col-8"><span>Sadar Bazaar Jhansi</span></div> -->
                            
                             <div class="col-md-4 col-4"><h6>State: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['u_state']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>District: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['u_district']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Tehsil: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['u_tahsil']?> </span></div>
                            
                            <div class="col-md-4 col-4"><h6>Pincode: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['u_pincode']?></span></div>
                            
                         <!--  --> <!--   <div class="col-md-4 col-4"><h6>User Id: </h6></div>
                            <div class="col-md-8 col-8"><span>3456785678</span></div> -->
                        </div>
                        </form>
                </div>

            </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php endforeach;?>
<?php endif;?>
   <!--------------------------------------------End Modal  ---------------------------->
   
   
      <!--------------------------------------------profile Modal  ---------------------------->  
   
      <?php if (!empty($general_enquiry)):  ?>
   <?php foreach ($general_enquiry as $row):   ?>
    <div id="replyModal<?= $row['user_id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Vendor Reply</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                                   
                              <div class="card-body">
                <div>
                    <form>
                    <p><?= ($row['vendor_msg'])?$row['vendor_msg']:'No reply'?></p>
               
                        </form>
                </div>
            </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php endforeach;?>
<?php endif;?>
   <!--------------------------------------------End Modal  ---------------------------->

         <?php include('includes/footer.php')?>         

    </body>
</html>