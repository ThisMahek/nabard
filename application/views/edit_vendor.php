<!doctype html>
<html lang="en">
<head>

<title><?php echo $title ?></title>
<?php include('includes/common-head.php') ?>
  <style>
     .add .btn{
       margin-top:4%;  
     }

    .phone_class{
        color: white;
        background-color: red;
    }

     
 </style>
</head>
<body>
    <div id="layout-wrapper">
        <?php include('includes/header.php') ?>
        <?php include('includes/sidebar.php') ?>           
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <?= $this->session->userdata('success')?>
                        <?= $this->session->userdata('error')?>
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
                                           <h4 class="card-title title_head">Update Vendor</h4>
                                       </div>
                                       <div class="col-md-6 col-6">
                                                <a href="<?php echo base_url() ?>Admin/manage_vendor"><button type="button" class="btn btn-primary waves-effect waves-light view_btn">View Vendor</button></a>
                                           </div>
                                    </div>
                                    <div class="card-body" id="divId">
        
                                        <form id="edit_vendor"   data-id="<?= $data['vendor_details']['id'] ?>" data-on_submit   method="post"  enctype="multipart/form-data"  action="<?= base_url() ?>vendor/update_vendor_fpo_shg/<?= $data['vendor_details']['id'] ?>">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Your Field</label>
                                                          
                                            <select    required="" class="form-control form-select fom_select"   name ="field_type">                   
                                        <option  value = "fpo" <?=($data['vendor_details']['field_type'] == 'fpo') ? 'selected' : '' ?>>FPO</option>
                                       <option value= "shg" <?=($data['vendor_details']['field_type'] == 'shg') ? 'selected' : '' ?>>SHG</option>
                                               </select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="vendor_id",value="<?= $data['vendor_details']['id'] ?>">
                                                     <!--    <div class="col-xl-5 col-md-5">
                                                      <div>
                                                          <label for="formFileLg" class="form-label">Upload Image(Optional)</label>
                                                          <input class="form-control form-control-lg fom_select" id="formFileLg" type="file" accept="image/*" data-check_bodfile name ="profile_image" value="">
                                                          <span data-check_input_span_bodfile ></span>
                                                        </div>
                                                    </div> -->


                                                    <div class="col-xl-1 col-md-1 mb-3"  style= "margin-top:3%"  >
                                                           <div>

                                                           <?php if(!empty($data['vendor_details']['profile_image'])):?>
                                                           <img src="<?= base_url()?><?= $data['vendor_details']['profile_image']?$data['vendor_details']['profile_image']:'NO'?>" class="imge_categoy" style="height:70px;width:70px" >
                                                           <?php else:?>
                                                            <img src="<?= base_url()?>assets/images/noimages.png"  class="imge_categoy" style="height:70px;width:70px;" >
                                                            <?php endif;?>    
                                                        </div>
                                                          
                                                        </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Name</label> 
                                                            <input type="text" required  data-check_input_field placeholder="Enter FPO Name" class="form-control form_control"   pattern="[A-Z a-z]*" oninput="FullnameValidation(this.value,'category_name_span','submit_btn')"   name ="name" value="<?= $data['vendor_details']['name'] ?>"    id="name"  required />
                                                            <span id="category_name_span" class="font-weight-bold" data-message> </span>
                                                        </div>

                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Representative</label>
                                                            <input type="text" required placeholder="Enter Representative"   pattern="[A-Z a-z]*"  data-check_input_field  class="form-control form_control"  oninput="FullnameValidation(this.value,'representative_span','submit_btn')"  name ="representative" value="<?= $data['vendor_details']['representative'] ?>"  required/>
                                                            <span id="representative_span" style=color:red  data-message></span> 
                                                        </div>
                                                    </div>
                                               
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Mobile No</label>
                                                            <input type="text"  maxlength="10"   id="phone" placeholder="Enter Mobile No" class="form-control form_control" name ="mobile" value="<?= $data['vendor_details']['mobile'] ?>"    oninput= "return check_phone(this.value,'alert_message_phone','submit_btn')"  onkeypress="return isNumber(event)"   required   disabled/>
                                                            <div id="alert_message_phone"></div>
                                                        </div>

                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Email Id(Optional)</label>
                                                            <input type="text"  placeholder="Enter Email Id" class="form-control form_control" name="email" 
                                                            value="<?= $data['vendor_details']['email'] ?>"
                                                            oninput= "return check_email(this.value,'email_span','submit_btn')"  disabled
                                                            
                                                            />
                                                            <span id="email_span"><span>
                                                        </div>
                                                    
                                                    </div>
                                                        <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Registration No</label>
                                                            <input type="text" required placeholder="Enter Registration No" class="form-control form_control" name ="reg_no" value="<?= $data['vendor_details']['reg_no'] ?>"  oninput= "return check_registrationNum(this.value,'regno_span','submit_btn')" disabled />
                                                            <span  id="regno_span"></span>
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Promoting Agency(Optional)</label>
                                                            <input type="text"   pattern="[A-Z a-z]*" data-check_input_field  placeholder="Enter Promoting Agency" class="form-control form_control"oninput="FullnameValidation(this.value,'promoting_agency','submit_btn')"  name ="promoting_agency" value="<?= $data['vendor_details']['promoting_agency'] ?>" />
                                                            <span id="promoting_agency" style=color:red  data-message></span> 
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Office Address</label>
                                                            <input type="text" required placeholder="Enter Office Address" class="form-control form_control" name ="office_address" value="<?= $data['vendor_details']['office_address'] ?>" required />
                                                        </div>
                                                    </div>
                                                          <div class="col-xl-6 col-md-6">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label">*District </label>
                                                            <select required="" class="form-control form-select fom_select"   data-filter_district  name ="district_id" >
                                                                <option value="">Select District</option>
                                                                <?php foreach ($district as $row1): ?>
                                                                <option value="<?= $row1['id'] ?>" <?=($data['vendor_details']['district_id'] == $row1['id']) ? 'selected' : '' ?>><?= $row1['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            <!--     <option value="ph">Agra</option>
                                                                <option value="cy">Aligarh</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Block</label>
                                                     <select required="" class="form-control form-select fom_select"  data-block   name ="block_id" >
                                                                <option value="">Select Block</option>
                                                                <?php foreach ($block as $row2): ?>
                                                                <option value="<?= $row2['id'] ?>" <?=($data['vendor_details']['block_id'] == $row2['id']) ? 'selected' : '' ?>><?= $row2['name'] ?></option>
                                                                <?php endforeach; ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Product</label>
                                                            <input type="text" required  pattern="[A-Z a-z]*"  oninput="FullnameValidation(this.value,'check_input_span_product','submit_btn')"  data-check_input_field  placeholder="Enter Product" class="form-control form_control"  name ="product" value="<?= $data['vendor_details']['product'] ?>" required />
                                                            <!-- <span data-message></span> -->

                                                            <span id="check_input_span_product"style=color:red  data-message></span> 
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*Basic Information</label>
                                                            <textarea type="text" required placeholder="Enter Basic Information"  data-check_input_field  class="form-control form_control"  name ="basic_info"><?= $data['vendor_details']['basic_info'] ?></textarea>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-6 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>*User Id</label>
                                                            <input type="text" required placeholder="Enter User Id" class="form-control form_control"  name ="user_id" value="<?= $data['vendor_details']['user_id'] ?>" disabled/>
                                                       <span id="userid_span"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                  <div class="optionBox">
                                                          <div class="block">
                                                            <?php if (!empty($data['vendor_bod'])): ?>
                                             <?php foreach ($data['vendor_bod'] as $key => $row): ?>     
                                                            <div class="row">
                                                            <input type="hidden" name="bod_hidden_id[]" value="<?= $row['id'] ?>"   data-check_input_field>
                                                            <?php if(!empty($row['bod_image'])):?>
                                                            <div class="col-xl-3 col-md-3">     
                                                                        <img src="<?= base_url() ?><?= $row['bod_image'] ?> " height="80px">         
                                                                </div>
                                                                <?php else:?>
                                                                <div class="col-xl-3 col-md-3">  
                                                                <img src="<?= base_url()?>assets/images/noimages.png"  height="80px">
                                                                </div>
                                                                <?php endif;?>
                                                                <div class="col-xl-3 col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label>Board of Director  Image(Optional)</label><br>
                                                                        <input type ="file" name ="bodimage[]"  data-check_bodfile   accept=".jpg, .jpeg, .png" value="" class="form-control form_control"  multiple=""   >
                                                                        <span data-check_input_span_bodfile ></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 col-md-3">
                                                                      <div class="form-group mb-3">
                                                                        <label>*Board of Director Name</label>
                                                                        <input type="text" required  pattern="[A-Z a-z]*"  data-check_input_field placeholder="Enter Board of Director Name"  value ="<?= $row['bod_name'] ?>"   data-check_bodname name="bodname[]"class="form-control form_control"  required/>
                                                                        <span data-check_input_span_bodname style=color:red  data-message></span> 
                                                                    </div>
                                                                </div>
                                                                   <div class="col-xl-3 col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label>*Mobile No</label>
                                                                            <input type="text" required  maxlength="10"placeholder="Enter Mobile No"  data-check_input_field_bod    data-bod_id="<?= $row['id'] ?>"  value="<?= $row['bod_mobile'] ?>" name="bodmobile[]" class="form-control form_control" oninput= " return check_bod_phone(this.value,'alert_message_bod_phone<?= $row['id'] ?>',<?= $row['id'] ?>,'submit_btn')"  onkeypress="return isNumber(event)"  required/>
                                                                            <span id="alert_message_bod_phone<?= $row['id'] ?>"   data-message></span>
                                                                        </div>  
                                                                   </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-xl-3 col-md-3 mt-4">
                                                            <span class="add">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light">+</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light common_btn"  id="submit_btn">Update</button>
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


         <?php include('includes/footer.php') ?>     
         
         



         <script>
      

   let length_bod =  <?php echo json_encode($data['vendor_bod']); ?>;
   let length_bod_length = length_bod.length;
   var count = length_bod_length +1;    
    $('.add').click(function() {
        
        console.log(count);
        if((count === 20)||(count < 20)){

            ++count; 
    $('.block:last').after('<input type="hidden" name="bod_hidden_id[]" value=""> <div class="block">  <div class="row"><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>Board of Director Image(Optional)</label><input type="file"  class="form-control form_control"  name="bodimage[]"  accept=".jpg, .jpeg, .png" data-check_bodfile /> <span data-check_input_span_bodfile ></span></div></div><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>Board of Director Name</label><input type="text" required placeholder="Enter Board of Director Name" data-check_input_field  name="bodname[]" class="form-control form_control" data-check_bodname /> <span data-check_input_span_bodname  data-message style=color:red></span> </div></div><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>Mobile No</label><input type="text" required placeholder="Enter Mobile No"data-check_input_field name="bodmobile[]" class="form-control form_control"  data-check_input_field_bod required placeholder="Enter Mobile No" maxlength="10" onkeypress="return isNumber(event)"  /><span id="bodphone_span"data-check_input_span_bodmobile  data-message style="color:red"></span></div></div></div><span class="remove"><button type="button" class="btn btn-danger waves-effect waves-light">-</button></span></span></div>');
    }else if(count === 20){  
         return false;
         
      }
});
$('.optionBox').on('click','.remove',function() {
    count--; 
        // console.log(count);
    $(this).parent().remove();
});

</script>


         <script>
            $(document).ready(function() {
            $(document).on("submit", `[data-on_submit]`, function(e) {
                e.preventDefault();
                let form = this;
                let modal = $(this).closest(`.modal`);
                let user_id = ($(form).data('id'));
                let id = '';
                if (user_id != '') {
                    id = user_id;
                }
                let is_submit = true;
                 let length_bod_phone=   <?php echo json_encode($data['vendor_bod']); ?>;
                let bodIds = $("[data-check_input_field]input[name='bod_hidden_id[]']");
               
                let check_input_bod_id =$("[data-check_input_field]input[name='bod_hidden_id[]']").val();
                let check_input_product = $("[data-check_input_field]input[name='product']").val();
                let check_input_password = $("[data-check_input_field]input[name='password']").val();
                let check_input_representative = $("[data-check_input_field]input[name='representative']").val();
                let check_input_password_1 = $("[data-check_input_field]input[name='password1']").val();
                let check_input_promoting_agency = $("[data-check_input_field]input[name='promoting_agency']").val();
                let check_input_bodmobile = $("[data-check_input_field_bod]input[name='bodmobile[]']");
                let check_input_bodimage = $("[data-check_input_field]input[name='bodimage[]']").val();
                let check_input_bodname = $("[data-check_input_field]input[name='bodname[]']");
                let denote_div = $(this);
                var return_msg = true;
                let reg_name = /^[a-zA-Z\s]*$/;
                let reg_mobile = /^[6789]{1}[0-9]{9}$/;
        
     
               if (!reg_name.test(check_input_representative)) {
                denote_div.find("[data-check_input_field]input[name ='representative']").siblings("[data-message]").html(
                         "<span style='color:red'>This field accept only characters</span>");
                         is_submit = false;
                     }

                     if (check_input_promoting_agency  != '') {
                   if (!reg_name.test(check_input_promoting_agency)) {
                        denote_div.find("[data-check_input_field]input[name='promoting_agency']").siblings("[data-message]")
                             .html("<span style='color:red'>This field accept only characters</span>");
                             is_submit = false;
                     }
                    }
                     if (!reg_name.test(check_input_product)) {
                        denote_div.find("[data-check_input_field]input[name='product']").siblings("[data-message]")
                             .html("<span style='color:red'>This field accept only characters</span>");
                             is_submit = false;
                     }
                  
                 $.map(check_input_bodname, function(v, i) {
                 let   bod_name_in_loop = $(v).val();
                    if (!reg_name.test($(v).val())) {
                        $(v).siblings("[data-message]")
                            .html("<span style='color:red'>This field accept only characters</span>" );
                        //  return false;
                        is_submit = false;
                    }      
                     });

             
                  
                   let   bod_id_in_loop='';
                   let is_unique =1;
                let lengthcheck_input_bodmobile = check_input_bodmobile.length;
               $.map(check_input_bodmobile, function(v1, i1) {
        
                $.map(check_input_bodmobile, function(v, i) {
                    if(i!=i1 &&  ($(v).val()) ==  ($(v1).val())){
                        is_unique=0;
                        $(v).siblings("[data-message]")
                            .html("<span style='color:red'>Please enter unique phone number</span>");
                            $(v1).siblings("[data-message]")
                            .html("<span style='color:red'>Please enter unique phone number</span>");
                    }


                });

               });

               if(is_unique == 0){
                return false;
                is_submit =false;
               }
                $.map(check_input_bodmobile, function(v, i) {
                    $(v).siblings("[data-message]").empty();
                 let   bod_phone_in_loop = $(v).val();
                 let return_valu = [];
                 let   bod_id_in_loop = $(v).data('bod_id');
                 if (!reg_mobile.test($(v).val())) {
                        $(v).siblings("[data-message]")
                            .html("<span style='color:red'>Please enter valid mobile number</span>");
                    }
                    if (reg_mobile.test($(v).val())) {
                                         if (($(v).val().length == 10)) {      
                                                          $.ajax({
                                                            type: "post",
                                                            url: "<?= base_url()?>vendor/check_bod_phone_number_exits",
                                                            data: {
                                                                phone: bod_phone_in_loop,
                                                                 bod_id:  bod_id_in_loop,
                                                                submit: 'submit',
                                                                id: id,
                                                            },
                                                            dataType: "JSON",
                                                            complete: function(response) {
                                                     let success = JSON.parse(response.responseText).success;
                                                                return_valu.push(success); 
                                                            if (return_valu.includes(false)) {
                                                                is_submit = false;
                                                                if(success == false){
                                                            
                                                                $(v).siblings("[data-message]" ).html("<span style='color:red'>"
                                                        +JSON.parse(response.responseText).message+"</span>");  
                                                    } 
                                                }
                                                     console.log('hhjhjkhkj',return_valu,(lengthcheck_input_bodmobile-1),i);
                                                     if((lengthcheck_input_bodmobile-1)==i){

                                                      if ( (!return_valu.includes(false)) ) {
                                                        //  console.log(' submitted');
                                                        form.submit();
                                                        }
                                                    }
                                                            }
                                                        });
                                                        
                                                    } 
                                                 
                                                }       
                                                   
                                                }); 

                  
                                                }); 

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







    </body>
</html>


<script>


$(document).on('input','[data-check_bodmobile]', function() {
             let id='';
            let vals = $(this).val();
            console.log(vals);
            let sib_span = $(this);
            let reg = /^[6789]{1}[0-9]{9}$/;
        if (vals === '') {
            sib_span.siblings("[data-check_input_span_bodmobile]").empty();
            $("#submit_btn").attr('disabled', false);
        } else if (!reg.test(vals)) {
            sib_span.siblings("[data-check_input_span_bodmobile]").html("<span style='color:red'>Please enter valid mobile number</span>");
            $("#submit_btn").attr('disabled', true);
            // return   false;
        } else{
            sib_span.siblings("[data-check_input_span_bodmobile]").empty();
                    $("#submit_btn").attr('disabled', false);
        }
       
 
    });

</script>
<script>
     $(document).on('input','[data-check_bodname]', function() {
    // var aid = $(this).next('.aid_closest').find("input[name='aid']").val();
    // var a =  this.next('[data-check_bodname]').find("span").html();
            let vals = $(this).val();
            let sib_span = $(this);
        let reg = /^[a-zA-Z\s]*$/;
        if (vals === '') {
            sib_span.siblings("[data-check_input_span_bodname]").empty();
            $("#submit_btn").attr('disabled', false);
        } else if (!reg.test(vals)) {
            sib_span.siblings("[data-check_input_span_bodname]").html("<span style='color:red'>This field accept only characters</span>");
            $("#submit_btn").attr('disabled', true);
            return   false;
        } else {
            sib_span.siblings("[data-check_input_span_bodname]").empty();
            $("#submit_btn").attr('disabled', false);
        } 
    });
    </script>
    

<script>

function check_input(){
    const phone =$('#phone').val();
    const name =$('#name').val();
    if(phone == ''){
        $("#alert_message_phone").html("<p style='color:red'>Please enter valid mobile number.</p>");
        $(window).scrollTop(0);
        return false;
    }if(name ==''){
        $("#category_name_span").html("<p style='color:red'>Please Enter Name.</p>");
        $(window).scrollTop(0);
        return false;
    }
}

    
</script>
<script>


     
$(document).on('input','[data-check_bodfile]', function() {
        let image = $(this).val();
        let sib_span = $(this);
var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
    if(!allowedExtensions.exec(image)){
    // document.getElementById(msg).innerHTML= '\n Please upload file having extensions .jpeg, .png, .jpeg only.';

    sib_span.siblings("[data-check_input_span_bodfile]").html("<span style='color:red'>Please upload file having extensions .jpeg, .png, .jpeg only</span>");

    document.getElementById("submit_btn").disabled=true;
    return false;
        }else if(image != '')
        {
            sib_span.siblings("[data-check_input_span_bodfile]").empty();
            document.getElementById("submit_btn").disabled=false;
        }else{
            if (image.files && image.files[0]) {
            let name=image.files[0].name;
            // document.getElementById(msg).innerHTML=name;
        var reader = new FileReader();
        reader.onload = function (e){
            $('.image')
                .attr('src', e.target.result)
                .width(110)
                .height(70);
                sib_span.siblings("[data-check_input_span_bodfile]").empty();
                document.getElementById("submit_btn").disabled=false;
                return true;
        };
        reader.readAsDataURL(image.files[0]);
    }
    }
});

</script>



<script>
    function check_phone(phone,msg,btn) {  
        // e.preventDefault();
    //   const a=  $("#edit_vendor input[name='mobile']").val();
       /*  phone=$("#add_vendor input[name='phone']").val();
        name= $("#add_vendor input[name='name']").val();
        field_type=$("#add_vendor select[name='field_type']").val();
        if(phone === ''){
            $("#alert_message_phone").html("<span style='color:red'>plese enter valid phone number</span>");
            return false;
        }
        if(name === ''){
            $("#alert_message_name").html("<span style='color:red'>Please enter name</span>");
            // alert('fill name');
return false;
        }if(field_type ===''){
            $("#alert_message_field").html("<span style='color:red'>Please select field</span>");
        }else{
            $("#alert_message_name").empty();
        } */


        let reg = /^[6789]{1}[0-9]{9}$/;
    if (phone === '') {
        $("#" + msg).empty();
        $("#" + btn).attr('disabled', false);
    }
   else if (!reg.test(phone)) {
        $("#" + msg).html("<p style='color:red'>Please enter valid mobile number.</p>");
        $("#" + btn).attr('disabled', true);
        // return false;
    } 
  else if(phone.length == 10){
           /*  alert('length ten'); */ 
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', false);


        $.ajax({
            type: "post",
            url: "<?= base_url() ?>vendor/check_phone_already_exits",
            data: {
                phone:phone,
                submit : 'submit',
                id : <?= $data['vendor_details']['id'] ?>,
            },
            dataType: "dataType",
            complete: function (response) {
              
                let success=JSON.parse(response.responseText).success;
                if(success){
                    $("#alert_message_phone").empty();
                }else{
                    $("#alert_message_phone").html("<span style='color:red'>"+JSON.parse(response.responseText).message+"</span>");
                    $("#submit_btn").attr('disabled', true);
                    return false;
                }
            }
        });

    }
    }
</script>







<script>
    function check_bod_phone(phone,msg,id,btn) {     
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
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', true);
  
    }else{
        $("#"+msg).empty();
                    $("#submit_btn").attr('disabled', false);
    }

}
</script>



