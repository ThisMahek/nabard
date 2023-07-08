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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url()?>Admin/index">Dashboard</a></li>
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
                                           <h4 class="card-title title_head">Update Farmer Vendor</h4>
                                       </div>
                                       <div class="col-md-6 col-6">
                                                <a href="<?php echo base_url()?>Admin/manage_farmer"><button type="button" class="btn btn-primary waves-effect waves-light view_btn">View Vendor</button></a>
                                           </div>
                                    </div>
                                    <div class="card-body">
        
                                        <form id="pristine-valid-example" method="post"  data-on_submit action ="<?= base_url('Vendor/update_vendor')?>" enctype="multipart/form-data" >
                                                <input type ="hidden" value="<?= $data['id']?>" name="id">
                                                <input type ="hidden" name="update">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Name</label>
                                                            <input type="text"    data-check_input_field required placeholder="Enter Your Name"   oninput=" return FullnameValidation(this.value,'alert_message_name','update')" value="<?= $data['name']?>"  class="form-control form_control"  name="name"/>
                                                        <span  id="alert_message_name"  data-message></span>
                                                        
                                                        
                                                        </div>
                                                    </div>
                                              
 
                                                        <div class="col-xl-1 col-md-1 mb-3"  style= "margin-top:3%"  >
                                                           <div>
                                                           <?php if(!empty($data['profile_image'])):?>
                                                           <img src="<?= base_url()?><?= $data['profile_image']?>" class="imge_categoy" style="height:70px;width:70px" >
                                                           <?php else:?>
                                                            <img src="<?= base_url()?>assets/images/noimages.png"  class="imge_categoy" style="height:70px;width:70px;" >
                                                            <?php endif;?>
                                                            </div>   
                                                        </div>

                                                       
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Your Field</label>
                                                            <input type="text" required placeholder="Enter Your Field" value="<?= ucwords($data['field_type'])?>" disabled class="form-control form_control"  name="field_type" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Father's Name</label>
                                                            <input type="text"  data-check_input_field required placeholder="Enter Your Father's Name"   value="<?= $data['father_name']?>"class="form-control form_control" name="father_name"   oninput=" return FullnameValidation(this.value,'father_span','update')"/>
                                                        
                                                        <span   id="father_span" data-message></span>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Gender</label>
                                                   
                                        <select required class="form-control form-select fom_select" name="gender"   >
                                        <option value="">Select gender</option>
                                        <option value="Male" <?=($data['gender']=='Male')?'selected':''?>>Male</option>
                                        <option value="Female" <?=($data['gender']=='Female')?'selected':''?>>Female</option>
                                        <option value="Other" <?=($data['gender']=='Other')?'selected':''?>>Other</option>
                                           </select>
                                                        </div>
                                                    </div>


                                                

                                                   <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Mobile Number</label>
                                                            <input type="text" id="num"  maxlength="10" required placeholder="Enter Your Mobile No" value="<?= $data['mobile']?>" name="mobile"data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"  oninput= " return check_phone(this.value,'alert_message_phone','update')"  onkeypress="return isNumber(event)"  disabled  data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />

                                                            <div id="alert_message_phone"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Whatsapp Number(Optional)</label>
                                                            <input type="num" id="num"   placeholder="Enter Your Whatsapp No" value="<?= $data['whatsapp_no']?>" name="whatsapp_no" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"  oninput=" return  WhatsappValidation(this.value,'alert_message_whatsapp','update')"  disabled data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"  maxlength="10"  onkeypress="return isNumber(event)"class="form-control form_control" />
                                                      <span  id="alert_message_whatsapp"></span>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">

                                                        <label class="form-label">*District </label>
                                                            <select required="" class="form-control form-select fom_select" data-filter_district  name ="district_id" >
                                                                <option value="">Select District</option>
                                                                <?php foreach($district as $row1):?>
                                                                <option value="<?= $row1['id']?>" <?= ($data['district_id'] == $row1['id'])?'selected':''?>><?= $row1['name']?></option>
                                                                <?php endforeach;?>
                                                            </select>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Block</label>
                                                    <select required="" class="form-control form-select fom_select"  name ="block_id" data-block>
                                                               <option value="">Select Block</option>
                                                               <?php foreach($block as $row2):?>
                                                               <option value="<?= $row2['id']?>" <?= ($data['block_id'] == $row2['id'])?'selected':''?>><?= $row2['name']?></option>
                                                               <?php endforeach;?>
                                                               </select> 
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Tehsil</label>
                                                            <input type="text"  data-check_input_field id="num"  required placeholder="Enter Your Tehsil" value="<?= $data['tehsil']?>" name="tehsil"data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" oninput=" return FullnameValidation(this.value,'tehsil_span','update')"  data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        <span  id="tehsil_span" data-message></span>
                                                        
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Village</label>
                                                            <input type="text"  data-check_input_field id="num"  required placeholder="Enter Your Village" value=" <?= $data['village']?>" name="village" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"  oninput=" return FullnameValidation(this.value,'village_span','update')"data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                       
                                                       <span  id="village_span" data-message></span>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Pincode</label>
                                                            <input type="text"  data-check_input_field id="num" maxlength="6" required placeholder="Enter Your Pincode"  onkeypress="return isNumber(event)" value="<?= $data['pincode']?>" name="pincode" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"  oninput="PincodeValidation(this.value,'alert_message_pincode','submit')" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                       <span  id="alert_message_pincode"  data-message></span>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Aadhar Card No(Optional)</label>
                                                            <input type="text" id="num"   placeholder="Enter Your Aadhar Card No"  value="<?= $data['aadhar_no']?>" name="aadhar_no" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" oninput="return  AadharValidation(this.value,'alert_message_aadhar','submit')"data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control"  maxlength="12" disabled onkeypress="return isNumber(event)"/>
                                                            <span id="alert_message_aadhar"></span>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*User Id</label>
                                                            <input type="text" id="num"  required placeholder="Enter Your User Id" value="<?= $data['user_id']?>" name="user_id"  disabled oninput ="return check_userid(this.value,'userid_span','update')" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        
                                                        <span  id="userid_span"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                       <!--  <input type="submit"  id="update"   value="Update" name="update" class="btn btn-primary waves-effect waves-light common_btn">  -->

                                        <button type="submit" class="btn btn-primary waves-effect waves-light common_btn"  id="update"> Update</button>


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
              let check_input_pincode = $("[data-check_input_field]input[name='pincode']").val();
            let reg_name = /^[a-zA-Z\s]*$/;
            let reg_pincode = /^[123456789]{1}[0-9]{5}$/;
     
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
              if (!reg_pincode.test(check_input_pincode)) {
                        denote_div.find("[data-check_input_field]input[name='pincode']").siblings("[data-message]")
                            .html("<span style='color:red'>Please enter valid pincode number</span>");
                        is_submit = false;
                        return_valu.push(false);

                    }
          
          form.submit();
            
        });
        </script>



           
         <script>
      $(document).ready(function() {
       var result_list_table = '';
    $("[data-filter_district]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter_district]`), (v, i) => {
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                type: "POST",
                url: "<?= base_url()?>vendor/get_block_edit_vendor?" + getInput,
                data: "state_id=" + categoryID,
                success: function(html) {
                    let res = JSON.parse(html);
                    if(filter_attr != 'block_id')
                    {
                        $(`[data-block]`).empty();
                        $.map(res.block_list, function(v, i) {
                            $(`[data-block]`).append(`
                                  ${v}
                            `);
                        });
                    }
                }
            });
        } else {
            $(`[data-block]`).html('<option value="">select district first</option>');
        }
    }))
});
</script>



               <script>
                function WhatsappValidation(whatsapp,msg,btn) {  
                    let reg = /^[6789]{1}[0-9]{9}$/;
                    let id = '';
    if (whatsapp === '') {
        $("#" + msg).html("<p style='color:red'></p>");
        $("#" + btn).attr('disabled', false);
        return false;
    }else if(whatsapp.length < 10){

    $("#" + msg).html("<p style='color:red'>invalid whatsapp number</p>");
        $("#" + btn).attr('disabled', false);
        return false;
    }
   else if (!reg.test(whatsapp)) {
        $("#" + msg).html("<p style='color:red'>Please Enter valid Whatsapp number</p>");
        $("#" + btn).attr('disabled', true);
        return false;
    }else{
        if(whatsapp != ''){
                        $.ajax({
                            type: "post",
                            url: "<?= base_url()?>vendor/check_whatsaap_already_exits",
                            data: {
                                whatsapp:whatsapp,
                                id : id,
                                submit : 'submit', 
                            },
                            dataType: "dataType",
                            complete: function (response) {
                                // console.log(response);
                                console.log(JSON.parse(response.responseText))
                                let success=JSON.parse(response.responseText).success;
                                if(success){
                                    $("#"+msg).empty();
                                    $("#"+btn).attr('disabled', false);
                                }else{
                                    $("#"+msg).html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                                    $("#"+btn).attr('disabled', true);
                                    return false;
                                }
                            }
                        });
                    }else{
                        $("#"+msg).empty();
                        $("#"+btn).attr('disabled', false);
                    }

    }

                }
            </script> 
         
<script>
    function check_phone(phone,msg,btn) {  
   
        let reg = /^[6789]{1}[0-9]{9}$/;
    if (phone === '') {
        $("#" + msg).empty();
        $("#" + btn).attr('disabled', false);
    }
   else if (!reg.test(phone)) {
        $("#" + msg).html("<p style='color:red'>Please Enter valid Phone Number.</p>");
        $("#" + btn).attr('disabled', true);
        // return false;
    } 
  else if(phone.length == 10){
           /*  alert('length ten'); */ 
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', false);

        $.ajax({
            type: "post",
            url: "<?= base_url()?>vendor/check_phone_already_exits",
            data: {
                phone:phone,
                submit : 'submit',
                id : <?= $data['id']?>,
            },
            dataType: "dataType",
            complete: function (response) {
                // console.log(response);
                console.log(JSON.parse(response.responseText))
                let success=JSON.parse(response.responseText).success;
                if(success){
                    $("#alert_message_phone").empty();
                }else{
                    $("#alert_message_phone").html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                    $("#submit").attr('disabled', true);
                    return false;
                }
            }
        });

    }
    }
</script>






<script>
                function check_userid(userid,msg,btn) {  
                    if(userid != ''){
                        $.ajax({
                            type: "post",
                            url: "<?= base_url()?>vendor/check_userid_already_exits",
                            data: {
                                userid:userid,
                                id : <?= $data['id']?>,
                                submit : 'submit',
                            },
                            dataType: "dataType",
                            complete: function (response) {
                                // console.log(response);
                                console.log(JSON.parse(response.responseText))
                                let success=JSON.parse(response.responseText).success;
                                if(success){
                                    $("#"+msg).empty();
                                    $("#"+btn).attr('disabled', false);
                                }else{
                                    $("#"+msg).html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                                    $("#"+btn).attr('disabled', true);
                                    return false;
                                }
                            }
                        });
                    }else{
                        $("#"+msg).empty();
                        $("#"+btn).attr('disabled', false);
                    }

                }
                // }
            </script>





<script>
function AadharValidation(aadharnum, msg, btn) {
    let reg = /^[123456789]{1}[0-9]{11}$/;
    let id = '';
    if (aadharnum === '') {
        $("#" + msg).html("<p style='color:red'></p>");
        $("#" + btn).attr('disabled', false);
        return true;
    }
   else if (!reg.test(aadharnum)) {
        $("#" + msg).html("<p style='color:red'>Please Enter valid Aadhar number</p>");
        $("#" + btn).attr('disabled', true);
        return false;
    } else {
      
        if(aadharnum != ''){
                        $.ajax({
                            type: "post",
                            url: "<?= base_url()?>vendor/check_aadharnum_already_exits",
                            data: {
                                aadharnum:aadharnum,
                                id : <?= $data['id']?>,
                                submit : 'submit', 
                            },
                            dataType: "dataType",
                            complete: function (response) {
                                console.log(JSON.parse(response.responseText))
                                let success=JSON.parse(response.responseText).success;
                                if(success){
                                    $("#"+msg).empty();
                                    $("#"+btn).attr('disabled', false);
                                }else{
                                    $("#"+msg).html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                                    $("#"+btn).attr('disabled', true);
                                    return false;
                                }
                            }
                        });
                    }else{
                        $("#"+msg).empty();
                        $("#"+btn).attr('disabled', false);
                    }
    }
}
</script>




<script>
function PincodeValidation(vals,msg,btn) {
    let reg = /^[123456789]{1}[0-9]{5}$/;
    // console.log(vals);
    if (vals === '') {
        $("#" + msg).html("<p style='color:red'></p>");
        $("#" + btn).attr('disabled', false);
        return false;
    }else if(vals.length < 6){
        $("#" + msg).html("<p style='color:red'>atleast 6 digit number allowed</p>");
        return false;
    }
   else if (!reg.test(vals)) {
        $("#" + msg).html("<p style='color:red'>Please Enter valid Pincode</p>");
        $("#" + btn).attr('disabled', true);
        return false;
    } else {
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', false);
        return true;
    
    }
}
</script>
    </body>
</html>