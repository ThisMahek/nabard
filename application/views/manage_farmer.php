<!doctype html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<?php include('includes/common-head.php')?>
 <style>
     h6 span{
         font-weight:500;
     }


     
 </style>

</head>



<body>
    <div id="layout-wrapper">
        <?php include('includes/header.php')?>

 <!-- ALERT MESSAGE CDN -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <!-- ALERT MESSAGE CDN --> 
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
                                           <h4 class="card-title title_head">Manage Farmer Vendor</h4>
                                           </div>
                                            <div class="col-md-6 col-6">
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Mobile No</th>
                                                <th>Password</th>
                                                <th>Added By</th>
                                                <th>View Details</th>
                                                <th>Status</th>
                                                <th>Block/Unblock</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i=0;    
                                            foreach($vendors_farmer as $row):
                                            $i++;
                                            ?>
                                            <tr>
                                               <td><?= $i?></td>
                                                <td><?= $row['name']?></td>
                                                <?php if(!empty($row['profile_image'])):?>
                                                <td><img src="<?php echo base_url()?><?= $row['profile_image']?>" class="imge_categoy"></td>
                                                <?php else:?>
                                                    <td><img src="<?= base_url()?>assets/images/noimages.png"  class="imge_categoy" ></td>

                                                    <?php endif;?>
                                                <td><?= $row['mobile']?></td>
                                                <td><?= $row['decry_password']?$row['decry_password']:'--'?></td>
                                                <td><?= ($row['added_by'])?$row['added_by']:'--'?></td>
                                                <td><button type="button" class="btn btn-success" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#viewModal<?= $row['id']?>"><i class="fa fa-eye"></i></button></td>
                                                 <?php if($row['status']==1):?>
                                                <td><b style='color:green;'>Approved</b></td>
                                                <?php elseif($row['status']==0):?>
                                                <td><a  onclick="return confirm('Are you sure you want to approved ?')" href="<?= base_url()?>Vendor/change_vendor_farmer_status/<?=$row['id']?>"><button type="button" class="btn btn-danger">Pending</button></a></td>
                                                <?php endif;?>
                                                <?php if($row['status']==1):?>
                                                    <?php if($row['is_block']==1):?>
                                                    <td><a  onclick="return confirm('Are you sure you want to Unblock ?')" href="<?= base_url()?>Vendor/change_fvendor_blockstatus/<?=$row['id']?>"><button type="button" class="btn btn-danger">Block</button></a> 
                                                </td>
                                                <?php elseif($row['is_block']==0):?>
                                                    <td><a  onclick="return confirm('Are you sure you want to Block ?')" href="<?= base_url()?>Vendor/change_fvendor_blockstatus/<?=$row['id']?>"><button type="button" class="btn btn-success">Unblock</button></a> </td>
                                                    <?php endif;?>
                                                    <?php elseif($row['status']==0):?>
                                                    <td>--</td>
                                                    <?php endif;?>

                                                <td> <a href="<?php echo base_url()?>Admin/edit_farmer/<?= $row['id']?>"> <button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></button></a>
                                               <a  onclick="return confirm('Are you sure you want to delete ?')" href="<?= base_url()?>Vendor/DeleteVendor/<?= $row['id']?>"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td></a>
                                            </tr>
                                            <?php endforeach;?>
                                             <!-- <tr>
                                               <td>2</td>
                                                <td>Edinburgh</td>
                                                <td><img src="<?php echo base_url()?>assets/images/users/avatar-2.jpg" class="imge_categoy"></td>
                                                <td>user@gmail.com</td>
                                                <td>9999999999</td>
                                                <td><button type="button" class="btn btn-success" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fa fa-eye"></i></button></td>
                                                <td>Himself</td>
                                                <td> <a href="<?php echo base_url()?>Admin/edit_farmer"> <button type="button" class="btn btn-success waves-effect waves-light"><i class="fa fa-edit"></i></button></a>
                                                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                            </tr> -->
                                       
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

  <!-------------------------------------------FPO Details modal    -----------------------   -->
                                          <?php
                                            $i=1;    
                                            foreach($vendors_farmer as $row):
                                            $i++;
                                            ?>
               <div id="viewModal<?= $row['id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Details</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                              <div class="card-body">
                <div>
                    <form>
                   
                         <div class="row">
                            <div class="col-md-4 col-4"><h6>Your Field: </h6></div>
                            <div class="col-md-8 col-8"><span><?= ucfirst($row['field_type'])?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['name']?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>Father's Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['father_name']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Gender: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['gender']?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>Mobile Number: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['mobile']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>WhatsApp Number: </h6></div>
                            <div class="col-md-8 col-8"><span><?= ($row['whatsapp_no'])?$row['whatsapp_no']:'--'?></span></div>
                            
                             <div class="col-md-4 col-4"><h6>District: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['district']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Block: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['block']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Tehsil: </h6></div>
                            <div class="col-md-8 col-8"><span> <?= $row['tehsil']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Village: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['village']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Pincode: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['pincode']?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Aadhar Card No: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['aadhar_no']?$row['aadhar_no']:'--'?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>User Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $row['user_id']?></span></div>
                        </div>
                    
                       
                        </form>
                </div>

            </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php endforeach;?>
   <!--------------------------------------------End Modal  ----------------------------> 
   

   
   
     
    <!--------------------------------------------OTP  Modal  ----------------------------> 
   <!--  <div class="modal fade" id="OTPmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm forgot_password_modal">
        <div class="modal-content">
            <div class="modal-header bottom-border-0 p-3">
              <a href="<?= base_url()?>admin/manage_vendor">  <button type="button" class="btn-close custum-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" style="font-size:21px;"></i></button></a>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url()?>vendor/farmer_vendor_signup_otp_verification">
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
                    <form  id="add_vendor"  method="post"   action ="<?=base_url()?>vendor/get_phone_otp_verification_farmer"  >
                            <input type="hidden"/>
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Vendor Name</label>
                                        <input type="text" required placeholder="Enter Your Name" class="form-control form_control" name="name" required   oninput=" return FullnameValidation(this.value,'alert_message_name','first_form_submit_btn')"  />
                                        <div id="alert_message_name"   data-message></div>
                                    </div>

                                   
                                </div>
                                  <div class="col-xl-12 col-md-12">
                                       <div class="form-group mb-3">
                                        <label class="form-label">Select Type</label>
                                        <select required="" class="form-control form-select fom_select" name="field_type"  id="field_type"  required>
                                            <option value="farmer">Farmer</option>   
                                        </select>
                                        <div id="alert_message_field"></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Mobile Number</label>
                                        <input type="text" id="num" maxlength="10"  required placeholder="Enter Your Mobile No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"     oninput=" return phonenumberValidation(this.value,'alert_message_phone','first_form_submit_btn')"  onkeypress="return isNumber(event)"  data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"  name="phone" class="form-control form_control" required />
                                        <div id="alert_message_phone"   data-message></div>
                                    </div>

                                  
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="modal-footer">
                            <button type="submit"   name="submit" id="first_form_submit_btn" class="btn btn-primary waves-effect waves-light common_btn" >Submit</button>
                         
                  <!--<button type="submit" class="btn btn-primary waves-effect waves-light common_btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#OTPmodal">Submit</button> -->
                           </div>
                     
                     </form>
                    </div>

                </div>
                </div>
               <!--  <div class="modal-footer">
                     <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#OTPmodal">Submit</button>
                </div> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>                
                
   <!--------------------------------------------End Add Modal  ---------------------------->  
   


         <?php include('includes/footer.php')?>    
         
   
         <script>
        $(document).on("submit", `[data-on_submit]`, function(e) {
            e.preventDefault();
            let form = this;
            let modal = $(this).closest(`.modal`);
            let user_id = ($(form).data('id'));
            let id = '';
            if(user_id != ''){
               id = user_id;
            }
       
            let denote_div = $(this);
            var return_msg = true;
            let check_name = $(this).find("[data-check_input_field]input[name='name']").val();
            let check_father_name = $(this).find("[data-check_input_field]input[name='father_name']").val();
            let check_tehsil = $(this).find("[data-check_input_field]input[name='tehsil']").val();
            let check_village = $(this).find("[data-check_input_field]input[name='village']").val();
            let reg_name = /^[a-zA-Z\s]*$/;
     
            if (!reg_name.test(check_name)) {
                $(this).find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html(
                    "<span style='color:red'>This field accept only characters</span>");
                return false;
            }
    
            if (!reg_name.test(check_father_name)) {
                $(this).find("[data-check_input_field]input[name='father_name']").siblings("[data-message]")
                    .html("<span style='color:red'>This field accept only characters</span>");
                return false;
            }
            if (!reg_name.test(check_tehsil)) {
                $(this).find("[data-check_input_field]input[name='tehsil']").siblings("[data-message]").html(
                    "<span style='color:red'>This field accept only characters</span>");
                return false;
            }

            if (!reg_name.test(check_village)) {
                $(this).find("[data-check_input_field]input[name='village']").siblings("[data-message]").html(
                    "<span style='color:red'>This field accept only characters</span>");
                return false;
            }
          
          form.submit();
            
        });
        </script>








         <script>
var timeout = 3000; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
</script>

<script>
/*     $("#add_vendor").submit(function (e) {  
        e.preventDefault();
        phone=$("#add_vendor input[name='phone']").val();
        name= $("#add_vendor input[name='name']").val();
        field_type=$("#add_vendor select[name='field_type']").val();
      if(field_type ===''){
            $("#alert_message_field").html("<span style='color:red'>Please select field</span>");
        }  if(phone === ''){
            $("#alert_message_phone").html("<span style='color:red'>Please enter valid phone number</span>");
            return false;
        }if(name === ''){
            $("#alert_message_name").html("<span style='color:red'>Please enter name</span>"); 
         return false;
        } 
        else{
            $("#alert_message_name").empty();
        }
        $.ajax({
            type: "post",
            url: "<?= base_url()?>vendor/get_phone_otp_verification_farmer",
            data: {
                name:($("#add_vendor input[name='name']").val()),
                phone:($("#add_vendor input[name='phone']").val()),
                field_type:($("#add_vendor select[name='field_type']").val()),
                submit : 'submit',
            },
            dataType: "dataType",
            complete: function (response) {
                console.log(response);
                console.log(JSON.parse(response.responseText))
                let success=JSON.parse(response.responseText).success;
                if(success){
                    let phone=JSON.parse(response.responseText).phone;
                    let otp=JSON.parse(response.responseText).otp;
                    $("#alert_message_phone").empty();
                        // $("#myModal").modal("hide");
                        window.location.href='<?= base_url()?>admin/add_farmer';
                }else{
                    $("#alert_message_phone").html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                }
            }
        });
    }); */
</script>






<script>
    $("#add_vendor").submit(function (e) {  
        
        e.preventDefault();
        let  reg_name = /^[a-zA-Z\s]*$/;
        let  reg_mobile = /^[6789]{1}[0-9]{9}$/;
        phone = $("#add_vendor input[name ='phone']").val();
        name = $("#add_vendor input[name ='name']").val();

       /*  $(this).find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html(
                    "<span style='color:red'>This field accept only characters</span>"); */
 
                if (!reg_name.test(name)) {
                $(this).find("#add_vendor input[name ='name']").siblings("[data-message]").html("<span style='color:red'>Please enter valid  Name</span>");
                return false; 
                } 
                if (!reg_mobile.test(phone)) {
                    $(this).find("#add_vendor input[name='phone']").siblings("[data-message]").html("<span style='color:red'>Please enter valid  Mobile</span>");
                return false; 
                } 
        
        else{
        $.ajax({
            type: "post",
            url: "<?= base_url()?>vendor/get_phone_otp_verification_farmer",
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
                    // window.location.href='<?= base_url()?>admin/add_vendor'; 
                    window.location.href='<?= base_url()?>admin/add_farmer';    
                }else{
                    $("#alert_message_phone").html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                }
            } 
        });

    }
    });
</script>



    </body>
</html>