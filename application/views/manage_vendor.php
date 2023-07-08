<!doctype html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<?php include('includes/common-head.php')?>
 <style>
     h6 span{
         font-weight:400;
     }
 </style>
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
                                                <?= $this->session->userdata('success');?>
                                                <?= $this->session->userdata('error');?>
                                           <h4 class="card-title title_head">Manage Vendor  FPO/SHG</h4>
                                           </div>
                                            <div class="col-md-6 col-6">
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <!--<div class="col-xl-3 col-md-3">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label"></label>
                                                            <select required="" class="form-control form-select fom_select">
                                                                <option value="">Select All</option>
                                                                <option value="All">All</option>
                                                                <option value="Block">Pending</option>
                                                                <option value="Unblock">Approved</option>
                                                            </select>
                                                        </div>
                                                    </div> -->
                                        <table id="datatable-buttons" class="table table-bordered responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Mobile No</th>
                                                <th>Email Id</th>
                                                <th>Password</th>
                                                <th>Type</th>
                                                <th>View Details</th>
                                                <th>Added By</th>
                                                <th>Rating</th>
                                                <th>Status</th>
                                                <th>Block/Unblock</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php   $i=0;  foreach($vendors as $row): $i++; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $row['name']?></td>
                                                <?php if(!empty($row['profile_image'])):?>
                                                <td><img src="<?php echo base_url()?><?= $row['profile_image']?>" class="imge_categoy"></td>
                                                <?php else:?>
                                                    <td><img src="<?= base_url()?>assets/images/noimages.png"  class="imge_categoy" ></td>
                                                 <?php endif;?>
                                                <td><?= $row['mobile']?></td>
                                                <td><?= $row['email']?$row['email']:'--'?></td>
                                                <td><?= $row['decry_password']?$row['decry_password']:'--'?></td>
                                                <td><?= strtoupper($row['field_type'])?></td>
                                                <td><button type="button" class="btn btn-success" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#viewModal<?= $row['id']?>"><i class="fa fa-eye"></i></button></td>  
                                                <td><?= $row['added_by']?></td>
                                             
                                        
                                      
<?php if(!empty($row['vendor_rating']['rating'])):?>                              
<td><?= $row['vendor_rating']['rating']?><span class="bx bxs-star text-warning"></span></td>
<?php else:?>
    <td>--</td>
<?php endif;?>
  <!-- <td>  <p class="text-muted float-start me-3"> <span class="bx bxs-star text-warning"></span></p> -->

                                                <?php if($row['status']==1):?>
                                                <td><b style='color:green;'>Approved</b></td>
                                                <?php elseif($row['status']==0):?>
                                                <td><a  onclick="return confirm('Are you sure you want to approved ?')" href="<?= base_url()?>Vendor/change_vendor_status/<?=$row['id']?>"><button type="button" class="btn btn-danger">Pending</button></a></td>
                                                <?php endif;?>
                                                <?php if($row['status']==1):?>
                                                    <?php if($row['is_block']==1):?>
                                                    <td><a  onclick="return confirm('Are you sure you want to Unblock ?')" href="<?= base_url()?>Vendor/change_vendor_blockstatus/<?=$row['id']?>"><button type="button" class="btn btn-danger">Block</button></a> 
                                                </td>
                                                <?php elseif($row['is_block']==0):?>
                                                    <td><a  onclick="return confirm('Are you sure you want to Block ?')" href="<?= base_url()?>Vendor/change_vendor_blockstatus/<?=$row['id']?>"><button type="button" class="btn btn-success">Unblock</button></a> </td>
                                                    <?php endif;?>
                                                    <?php elseif($row['status']==0):?>
                                                    <td>--</td>
                                                    <?php endif;?>

                                               
                                                <td><a href="<?php echo base_url()?>Admin/edit_vendor/<?= $row['id']?>"><button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></button></a>
                                                <a  onclick="return confirm('Are you sure you want to delete ?')" href="<?= base_url()?>Vendor/delete_vendors/<?= $row['id']?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                             
                                            </tr>
                                            <?php endforeach;?>
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
<?php foreach($vendors as $row):?>
  <!-------------------------------------------FPO Details modal    -----------------------   -->
          
               <div id="viewModal<?=$row['id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Details</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">          
                    <form>   
                      <div class="row">
                            <div class="col-md-4 col-4"><h6>Your Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= strtoupper($row['field_type']) ?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>FPO Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['name']?> </span></div>
                            
                             <div class="col-md-4 col-4"><h6>Representative: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['representative']?></span></div>
                            
                       <div class="col-md-4 col-4"><h6>Board of Director: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['bod']?></span></div>
                            
                            
                            <div class="col-md-4 col-4"><h6>Mobile No: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['mobile'] ?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>Email Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['email']?$row['email']:'--' ?></span></div>

                          <!--   <div class="col-md-4 col-4"><h6>Password: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['decry_password']?$row['decry_password']:'--' ?></span></div> -->
                            
                            <div class="col-md-4 col-4"><h6>Registration No: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['reg_no']?></span></div>
                            
                              <div class="col-md-4 col-4"><h6>Promoting Agency: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['promoting_agency']?$row['promoting_agency']:'--'?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Office Address: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['office_address']?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>District: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['district']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Block: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['block']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Product: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['product']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Basic Information: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['basic_info']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>User Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['user_id']?></span></div>
                        </div>
                        <hr>
                        <h5 style="">Board Of Director Details</h5>
                         <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Sr.No</th>
                              <th scope="col">Board of Director Name</th>
                              <th scope="col">Mobile Number</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php       
                            $i=0;
                            if(isset($row['vendors_bod'])):
                             foreach($row['vendors_bod'] as $row1):
                             $i++;
                             ?>
                            <tr>
                              <th scope="row"><?= $i ?></th>
                              <td><?= isset($row1['bod_name'])?$row1['bod_name']:''?></td>
                              <td><?= isset($row1['bod_mobile'])?$row1['bod_mobile']:''?></td>
                            </tr>
                            <?php endforeach;
                            endif; ?>
                           <!--    <tr>
                              <th scope="row">2</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr>
                              <tr>
                              <th scope="row">3</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr>
                              <tr>
                              <th scope="row">4</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr>
                              <tr>
                              <th scope="row">5</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr>
                              <tr>
                              <th scope="row">6</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr>
                              <tr>
                              <th scope="row">7</th>
                              <td>Mark</td>
                              <td>9999999999</td>
                            </tr> -->
                          </tbody>
                        </table>
</form>
                </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
<?php endforeach;?>
   <!--------------------------------------------End Modal  ----------------------------> 
  
   
   
   
    <!--------------------------------------------OTP  Modal  ----------------------------> 
<!--   <div class="modal fade" id="OTPmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm forgot_password_modal">
        <div class="modal-content">
            <div class="modal-header bottom-border-0 p-3">
              <a href="<?= base_url()?>admin/manage_vendor">  <button type="button" class="btn-close custum-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" style="font-size:21px;"></i></button></a>
            </div>
            <div class="modal-body">
               
                <form method="post" action="<?= base_url()?>vendor/vendor_signup_otp_verification">
                    <h4 class="modal-login-heading text-center color_white">OTP Verification</h4>
                    <p class="font-12 text-center color_white">Please enter the 6 digit verification code <br>
                        we just sent you on your device</p>
                        <input type="hidden" name="phone_p" value=""/>
                    <input type="text" class="form-control mb-3"  value="" maxlength="6" name="otphtml" placeholder="Enter Otp" 
                        required>
                    <button id="submit_btn" type="submit" class="btn btn-primary w-100">Submit</button>
                   
                </form>
                <br>
                <div style="text-align: center;"> <span class="blue-text blue-border-line font-11"  style="text-align:center" id="countdown"></span></div>
            </div>
        </div>
    </div>
</div> -->
<!--otp verfication-->
        
        
  <!--------------------------------------------ADD vendor Modal  ---------------------------->
  
                
 <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Add Vendor</h5>
                                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                  <div class="card-body">
                    <div>
                        <form  id="add_vendor"   method="post"  action="<?= base_url()?>vendor/get_phone_otp_verification_vendor"  >
                            <input type="hidden"/>
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Vendor Name</label>
                                        <input type="text" required placeholder="Enter Your Name" class="form-control form_control" name="name" required   oninput="return FullnameValidation(this.value,'alert_message_name','first_form_submit_btn')"  />
                                        <div id="alert_message_name" data-message></div> 
                                    </div>

                                </div>
                                  <div class="col-xl-12 col-md-12">
                                       <div class="form-group mb-3">
                                        <label class="form-label">Select Type</label>
                                        <select required="" class="form-control form-select fom_select" name="field_type"  id="field_type"  required>
                                            <option value="fpo">FPO</option>
                                            <option value="shg">SHG</option>
                                        </select>
                                        <div id="alert_message_field" data-message></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Mobile Number</label>
                                        <input type="text" id="num" maxlength="10"  required placeholder="Enter Your Mobile No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"     oninput=" return phonenumberValidation(this.value,'alert_message_phone','first_form_submit_btn')"  onkeypress="return isNumber(event)"  data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"  name="phone" class="form-control form_control" required />
                                        <div id="alert_message_phone" data-message></div>

                                    </div>

                                </div>
                            </div>
                            <!-- end row -->
                            <div class="modal-footer">
                            <button type="submit"  name="submit"  id="first_form_submit_btn" class="btn btn-primary waves-effect waves-light common_btn" >Submit</button>
                  <!--<button type="submit" class="btn btn-primary waves-effect waves-light common_btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#OTPmodal">Submit</button> -->
                           </div>
                     </form>
                    </div>

                </div>
                </div>
           
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>                
                
   <!--------------------------------------------End Add Modal  ---------------------------->  
   
   
     <!--------------------------------------------Update Modal  ---------------------------->
  
                
 <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Update Vendor</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                              <div class="card-body">
                <div>
                      <form id="pristine-valid-example" novalidate method="post">
                        <input type="hidden"/>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Name</label>
                                    <input type="text" required placeholder="Enter Your Name" class="form-control form_control" />
                                </div>
                            </div>
                             <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Your Field</label>
                                    <input type="text" required placeholder="Enter Your Field" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Father's Name</label>
                                    <input type="text" required placeholder="Enter Your Father's Name" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Gender</label>
                                    <input type="text" required placeholder="Enter Your Gender" class="form-control form_control" />
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Mobile Number</label>
                                    <input type="num" id="num"  required placeholder="Enter Your Mobile No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Whatsapp Number</label>
                                    <input type="num" id="num"  required placeholder="Enter Your Whatsapp No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                             <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>District</label>
                                    <input type="text" id="num"  required placeholder="Enter Your District" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Block</label>
                                    <input type="text" id="num"  required placeholder="Enter Your Block" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                               <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Tehsil</label>
                                    <input type="text" id="num"  required placeholder="Enter Your Tehsil" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Village</label>
                                    <input type="text" id="num"  required placeholder="Enter Your Village" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Pincode</label>
                                    <input type="text" id="num"  required placeholder="Enter Your Pincode" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>Aadhar Card No</label>
                                    <input type="text" id="num"  required placeholder="Enter Your Aadhar Card No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                              <div class="col-xl-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label>User Id</label>
                                    <input type="text" id="num"  required placeholder="Enter Your User Id" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                </div>

            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Update</button>
            </div>
        </div>
    </div>
</div>                

   <!--------------------------------------------End Edit Modal  ---------------------------->



   <script>
    $("#add_vendor").submit(function (e) {  

        e.preventDefault();
        let  reg_name = /^[a-zA-Z\s]*$/;
        let  reg_mobile = /^[6789]{1}[0-9]{9}$/;
        phone = $("#add_vendor input[name ='phone']").val();
        name = $("#add_vendor input[name ='name']").val();
 
                if (!reg_name.test(name)) {
                $("#add_vendor input[name ='name']").siblings("[data-message]").html("<span style='color:red'>This field accept only characters</span>");
                return false; 
                } 
                if (!reg_mobile.test(phone)) {
                $("#add_vendor input[name='phone']").siblings("[data-message]").html("<span style='color:red'>Please enter valid mobile number</span>");
                return false; 
                } 
        
        else{
        $.ajax({
            type: "post",
            url: "<?= base_url()?>vendor/get_phone_otp_verification_vendor",
            data: {
                name:($("#add_vendor input[name='name']").val()),
                phone:($("#add_vendor input[name='phone']").val()),
                field_type:($("#add_vendor select[name='field_type']").val()),
                submit : 'submit',
            },
            dataType: "dataType",
            complete: function (response) {
                let success=JSON.parse(response.responseText).success;
                if(success==true){
                    // $("#alert_message_phone").empty();
                    window.location.href='<?= base_url()?>admin/add_vendor';     
                }else{
                    $("#alert_message_phone").html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                }
            } 
        });

    }
    });
</script>





         <?php include('includes/footer.php')?>         

    </body>
</html>