<!doctype html>
<html lang="en">

<head>
    <title>
        <?php echo $title; ?>
    </title>
    <?php include('includes/common-head.php') ?>
    <style>
    .add .btn {
        margin-top: 4%;
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
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <!--<h4 class="mb-sm-0 font-size-18"><?php echo $page_name; ?></h4>-->
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a
                                                href="<?php echo base_url() ?>Admin/index">Dashboard</a></li>
                                        <li class="breadcrumb-item active">
                                            <?php echo $page_name; ?>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

<?= $this->session->flashdata('success')?>
<?= $this->session->flashdata('error')?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4 class="card-title title_head">Add Vendor</h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <a href="<?php echo base_url() ?>Admin/manage_vendor"><button type="button"
                                                    class="btn btn-primary waves-effect waves-light view_btn">View
                                                    Vendor</button></a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <form id="pristine-valid-example" data-on_submit method="post"
                                            action="<?= base_url() ?>vendor/add_vendor_fpo_shg"
                                            enctype="multipart/form-data">
                                            <input type="hidden" />
                                            <div class="row">
                                                <input type="hidden" name="field_type"
                                                    value="<?= $this->session->userdata('field_type') ? $this->session->userdata('field_type') : '' ?>">
                                                <input type="hidden" name="name"
                                                    value="<?= $this->session->userdata('vendor_name_fpo_shg') ? $this->session->userdata('vendor_name_fpo_shg') : '' ?>">
                                                <input type="hidden" name="mobile"
                                                    value="<?= $this->session->userdata('vendor_phone_fpo_shg') ? $this->session->userdata('vendor_phone_fpo_shg') : '' ?>">

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Name</label>
                                                        <input type="text"  placeholder="Enter Your Name"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('vendor_name_fpo_shg') ? $this->session->userdata('vendor_name_fpo_shg') : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div>
                                                        <label for="formFileLg" class="form-label">Upload
                                                            Image(Optional)</label>
                                                        <input class="form-control form-control-lg fom_select"
                                                            id="formFileLg" type="file" name="profile_image"
                                                            data-check_input_field accept=".jpg, .jpeg, .png">
                                                    </div>
                                                    <span id="sp_image3" data-message
                                                        style=" margin-left:4%; margin-bottom:3%  ;color:red" ;></span>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Field Type</label>
                                                        <input type="text"  placeholder="Enter Field Name"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('field_type') ? strtoupper($this->session->userdata('field_type')) : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Representative</label>
                                                        <input type="text" placeholder="Enter Representative" required
                                                            class="form-control form_control" name="representative"
                                                            data-check_input_field
                                                            oninput="return RepresentativeValidation(this.value,'alert_message_name','submit_btn')" />

                                                        <span data-check_input_span_representative style="color:red">
                                                        </span>
                                                        <span id="alert_message_name" data-message style="color:red">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Mobile No</label>
                                                        <input type="text" required placeholder="Enter Mobile No"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('vendor_phone_fpo_shg') ? $this->session->userdata('vendor_phone_fpo_shg') : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Email Id(Optional)</label>
                                                        <input type="email" placeholder="Enter Email Id"
                                                            class="form-control form_control" data-check_input_field
                                                            name="email_id"
                                                            />
                                                        <!-- <span  style="color:red"> </span> -->
                                                        <span id="email_span" data-check_input_span_email data-message
                                                            style="color:red"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Registration No</label>
                                                        <input type="text" placeholder="Enter Registration No"
                                                            class="form-control form_control" name="reg_no"  oninput=" return RegistrationValidation(this.value,'check_input_span_reg_no','submit_btn')"
                                                            data-check_input_field required />
                                                        <!-- <span data-check_input_span style="color:red"> </span> -->
                                                        <span data-check_input_span_reg_no id="check_input_span_reg_no"
                                                            style="color:red" data-message> </span>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Promoting Agency(Optional)</label>
                                                        <input type="text" placeholder="Enter Promoting Agency"
                                                            class="form-control form_control" name="promoting_agency"
                                                            oninput=" return RepresentativeValidation(this.value,'alert_message_promoting_agency','submit_btn')"
                                                            data-check_input_field />
                                                        <span id="alert_message_promoting_agency"
                                                            data-message style="color:red"  pattern="[A-Z a-z]*"> </span>
                                                        <!--    <span data-check_input_span_promoting_agency style="color:red" > </span> -->
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Office Address</label>
                                                        <input type="text" placeholder="Enter Office Address"
                                                            class="form-control form_control" name="office_address"
                                                            data-check_input_field required />
                                                        <span data-check_input_span style="color:red"> </span>
                                                        <span data-check_input_office_address style="color:red"
                                                            data-message> </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">*District </label>
                                                        <select required class="form-control form-select fom_select"
                                                            name="district" data-filter id="district">
                                                            <option value="">Select District</option>
                                                            <?php foreach ($district as $row): ?>
                                                            <option value="<?= $row['id'] ?>">
                                                                <?= $row['name'] ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <span data-check_input_span style="color:red"> </span>
                                                        <span data-check_input_span_district style="color:red"> </span>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Block</label>
                                                        <select required="" class="form-control form-select fom_select"
                                                            name="block" data-filter id="block" data-check_input_field>
                                                            <option>Select Block</option>
                                                        </select>
                                                        <span data-check_input_span style="color:red"> </span>
                                                        <span data-check_input_span_block style="color:red"
                                                            data-message> </span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Product</label>
                                                        <input type="text" placeholder="Enter Product Name"
                                                            class="form-control form_control" name="product"
                                                            data-check_input_field   pattern="[A-Z a-z]*"
                                                            oninput=" return RepresentativeValidation(this.value,'alert_message_product','submit_btn')"
                                                            required />
                                                        <!--  <span id="alert_message_product" style="color:red"> </span> -->
                                                        <span id="alert_message_product" data-check_input_span_product
                                                            style="color:red" data-message> </span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Password</label>
                                                        <input type="password" placeholder="Enter your password"
                                                            class="form-control form_control" name="password"
                                                            id="password"  data-check_input_field
                                                            required />
                                                            <span data-check_input_span style="color:red" data-message> </span>
                                                    </div>
                                                    <!-- <span data-check_input_span_password style="color:red"> </span> -->
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Confirm Password</label>
                                                        <input type="password" placeholder="Enter your confirm password"
                                                            class="form-control form_control" name="password1"
                                                            id="password1"  data-check_input_field
                                                            required />
                                                        <span data-check_input_span style="color:red"> </span>
                                                        <span data-check_input_span_password1 
                                                            style="color:red"> </span>
                                                    </div>
                                                </div>
                                                <div id="passMes_con"></div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Basic Information</label>
                                                        <textarea type="text" placeholder="Enter Basic Information"
                                                            class="form-control form_control" name="basic_info"
                                                            required /></textarea>

                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*User Id</label>

                                                        <input type="text" required placeholder="Enter User Id"
                                                            class="form-control form_control" name="user_id"
                                                            data-check_input_field required data-userid />
                                                        <span data-check_input_span id="check_input_span_userid"
                                                            style="color:red"></span>
                                                        <span data-check_input_span_userid style="color:red"
                                                            data-message> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="optionBox">
                                                <div class="block">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>Board of Director Image(Optional)</label>
                                                                <input type="file" placeholder=""
                                                                    class="form-control form_control" name="bodimage[]"
                                                                    oninput="check_file(this.value,'bod_image_span')"
                                                                    accept=".jpg, .jpeg, .png" data-check_input_field />
                                                                <!-- <span data-check_input_span_bodimage style="color:red" > </span> -->
                                                                <span id="bod_image_span"
                                                                    style=" margin-left:4%; margin-bottom:3%  ;color:red"
                                                                    ; data-message></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>*Board of Director Name</label>
                                                                <input type="text" required
                                                                    placeholder="Enter Board of Director Name"
                                                                    class="form-control form_control" name="bodname[]"   pattern="[A-Z a-z]*"
                                                                    data-check_input_field
                                                                    oninput=" return BODnameValidation(this.value,'alert_message_bodname','submit_btn')" />
                                                                <!-- <span data-check_input_span_bodname style="color:red"> </span> -->
                                                                <span id="alert_message_bodname" data-message
                                                                    style="color:red"> </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-3 col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>*Mobile No</label>
                                                                <input type="text" maxlength="10" required
                                                                    placeholder="Enter Mobile No"
                                                                    class="form-control form_control" name="bodmobile[]"   data-check_input_field_bod
                                                                    id="bodmobile" data-  
                                                                    oninput=" return check_bod_phone(this.value,'alert_message_phone','','submit_btn')"
                                                                    onkeypress="return isNumber(event)" />
                                                                <span id="alert_message_phone" style="color:red"
                                                                    data-message> </span>
                                                                <!-- <div "></div> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3 col-md-3 mt-4">
                                                            <span class="add">
                                                                <button type="button"
                                                                    class="btn btn-primary waves-effect waves-light">+</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type='hidden' name="add_vendor">
                                            <button type="submit" name="submit_btn" id="submit_btn"
                                                class="btn btn-primary waves-effect waves-light common_btn">Submit</button>
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
            var count = 2;
            $('.add').click(function() {
         
                if ((count ===20) || (count <= 20)) {
                    count++; 
                    $('.block:last').after(
                        `<div class="block"> <div class="row"><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>Board of Director(Optional)</label><input type="file"  accept=".jpg, .jpeg, .png" name="bodimage[]"   data-check_input_field data-check_bodfile class="form-control form_control" /><span data-check_input_span_bodfile   data-message></span></div></div><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>*Board of Director Name</label><input type="text" required name="bodname[]"  pattern="[A-Z a-z]*" data-check_bodname  data-check_input_field id="bod_name" placeholder="*Enter Board of Director Name" class="form-control form_control"/><span data-check_input_span_bodname style=color:red  data-message></span></div></div><div class="col-xl-3 col-md-3"><div class="form-group mb-3"><label>*Mobile No</label><input type="text"   name="bodmobile[]" data-check_input_field_bod  
              required placeholder="Enter Mobile No"  maxlength="10" onkeypress="return isNumber(event)" class="form-control form_control" /><span id="bodphone_span"data-check_input_span_bodmobile data-message style="color:red" ></span></div></div></div><span class="remove"><button type="button" class="btn btn-danger waves-effect waves-light">-</button></span></span></div>`
                    );
                } else if(count === 20){  
               return false;
                 }
            });
            $('.optionBox').on('click', '.remove', function() {
                --count; 
                $(this).parent().remove();
            });
            </script>

            <script>
            function check_bod_phone(phone, msg, id = '', btn) {
                let reg = /^[6789]{1}[0-9]{9}$/;
                if (phone === '') {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', false);
                } else if (!reg.test(phone)) {
                    $("#" + msg).html("<p style='color:red'>Please enter valid mobile number.</p>");
                    $("#" + btn).attr('disabled', true);
                    // return false;
                } else {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', false);
                }
            }
            </script>



            <script>
            function check_email(email, msg, btn) {
                let reg = /\S+@\S+\.\S+/;
                let id = '';
                if (email == '') {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', false);
                } else if (!reg.test(email)) {
                    $("#" + msg).html("<p style='color:red'>Please enter valid email ID </p>");
                    $("#" + btn).attr('disabled', true);
                    return false;
                } else {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', false);
                    return true;
                }
           
            }
            </script>

            <script>
          $(document).on('input','[data-check_bodname]', function() {
            let vals = $(this).val();
            let sib_span = $(this);
        let reg = /^[a-zA-Z\s]*$/;
        if (vals === '') {
            sib_span.siblings("[data-check_input_span_bodname]").empty();
            // $("#submit").attr('disabled', false);
            return false;
        } else if (!reg.test(vals)) {
            sib_span.siblings("[data-check_input_span_bodname]").html("<span style='color:red'>This field accept only characters</span>");
            // $("#submit").attr('disabled', true);
            return   false;
        } else {
            sib_span.siblings("[data-check_input_span_bodname]").empty();
            // $("#submit").attr('disabled', false);
            return true;
        } 
    });
 


            $(document).on('input', '[data-check_bodmobile]', function() {
                let id = '';
                let vals = $(this).val();
                let sib_span = $(this);
                let reg = /^[6789]{1}[0-9]{9}$/;
                if (vals === '') {
                    sib_span.siblings("[data-check_input_span_bodmobile]").empty();
                    return false;
                } else if (!reg.test(vals)) {
                    sib_span.siblings("[data-check_input_span_bodmobile]").html(
                        "<span style='color:red'>Please enter valid mobile number</span>");
                    return false;
                } else {
                    sib_span.siblings("[data-check_input_span_bodmobile]").empty();
                    return true;
                }
            });

            </script>

            <script>
            function RepresentativeValidation(vals, msg, btn) {
                let reg = /^[a-zA-Z\s]*$/;
                if (vals === '') {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', true);
                    return false;
                } else if (!reg.test(vals)) {
                    $("#" + msg).html("<span style='color:red'>This field accept only characters</span>");
                    $("#" + btn).attr('disabled', true);
                    return false;
                } else {
                    $("#" + msg).html("");
                    $("#" + btn).attr('disabled', false);
                    return true;
                }
            }




            function RegistrationValidation(vals,msg,btn) {
                        let reg = /^[a-zA-Z0-9_.-]*$/;

                if (vals === '') {
                    $("#" + msg).empty();
                    $("#" + btn).attr('disabled', true);
                 
                } else if (!reg.test(vals)) {
                    $("#" + msg).html("<span style='color:red'>Special characters not allowed</span>");
                    $("#" + btn).attr('disabled', true);
      
                } else {
                    $("#" + msg).html("");
                    $("#" + btn).attr('disabled', false);
                   
                }
            }


            function BODnameValidation(vals, msg, btn) {
                let reg = /^[a-zA-Z\s]*$/;
                if (vals === '') {
               
                    $("#" + btn).attr('disabled', true);
                } else if (!reg.test(vals)) {
                    $("#" + msg).html("<span style='color:red'>This field accept only characters</span>");
                  
                    $("#" + btn).attr('disabled', true);
                } else {
                    $("#" + msg).html("");
                 
                }
            }
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
                let check_input_email = $("[data-check_input_field]input[name='email_id']").val();
                let check_input_profile_image = $("[data-check_input_field]input[name='profile_image']").val();
                let check_input_product = $("[data-check_input_field]input[name='product']").val();
                let check_input_password = $("[data-check_input_field]input[name='password']").val();
                let check_input_representative = $("[data-check_input_field]input[name='representative']").val();
                let check_input_registration = $("[data-check_input_field]input[name='reg_no']").val();
                let check_input_password_1 = $("[data-check_input_field]input[name='password1']").val();
                let check_input_userid = $("[data-check_input_field]input[name='user_id']").val();
                let check_input_promoting_agency = $("[data-check_input_field]input[name='promoting_agency']").val();
                let check_input_bodmobile = $("[data-check_input_field_bod]input[name='bodmobile[]']");
                let check_input_bodimage = $("[data-check_input_field]input[name='bodimage[]']").val();
                let check_input_bodname = $("[data-check_input_field]input[name='bodname[]']");
                let denote_div = $(this);
                var return_msg = true;
                let reg_name = /^[a-zA-Z\s]*$/;
                let reg_email = /\S+@\S+\.\S+/;
                let reg_mobile = /^[6789]{1}[0-9]{9}$/;
                let allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                let reg_aadhar = /^[123456789]{1}[0-9]{11}$/;
                let reg_userid = /^[A-Za-z][A-Za-z0-9_@#]{7,29}$/;
                let reg_pincode = /^[123456789]{1}[0-9]{5}$/;
                let reg_registration = /^[a-zA-Z0-9_.-]*$/;
               if (!reg_name.test(check_input_representative)) {
                denote_div.find("[data-check_input_field]input[name ='representative']").siblings("[data-message]").html(
                         "<span style='color:red'>This field accept only characters</span>");
                        //  return false;
                        is_submit = false;
                     }
                      if (check_input_email != '') {
                        
                        if (!reg_email.test(check_input_email)) {
                            denote_div.find("[data-check_input_field]input[name ='email_id']").siblings("[data-message]").html("<span style='color:red'>Please enter valid email id</span>");
                        //  return false;
                        is_submit = false;
                     }
                       
                    if ((reg_email.test(check_input_email)) ) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>vendor/check_email_already_exits",
                        data: {
                            email: check_input_email,
                            id: id,
                            submit: 'submit',
                        },
                        dataType: "dataType",
                        complete: function(response) {
                            let success = JSON.parse(response.responseText).success;
                            return_msg = success;
                            if (success == false) {
                                denote_div.find(
                                        "[data-check_input_field]input[name ='email_id']")
                                    .siblings("[data-message]").html("<span style='color:red'>" +
                                        JSON
                                        .parse(response.responseText).message + "</span>");
                                        is_submit = false;
                            }
                            if (success == true) {
                                denote_div.find(
                                        "[data-check_input_field]input[name ='email_id']")
                                    .siblings("[data-message]").empty();
                                is_submit = true;  
                            }
                        }

                        });
                    }
                    }
                     if (!reg_registration.test(check_input_registration)) {
                    denote_div.find("[data-check_input_field]input[name='reg_no']").siblings("[data-message]")
                        .html("<span style='color:red'>Special characters not allowed</span>");
                    //  return false;
                    is_submit = false;  
              
                }
                if (reg_registration.test(check_input_registration)) {
                                $.ajax({
                                    type: "post",
                                    url: "<?= base_url() ?>vendor/check_regno_already_exits",
                                    data: {
                                        regno: check_input_registration,
                                        submit: 'submit',
                                        id: id,
                                    },
                                    dataType: "JSON",
                                    complete: function(response) {
                                        let success = JSON.parse(response
                                            .responseText).success;
                                        if (success == false) {
                                            denote_div.find(
                                                    "[data-check_input_field]input[name='reg_no']"
                                                )
                                                .siblings("[data-message]").html(
                                                    "<span style='color:red'>" +
                                                    JSON
                                                    .parse(response.responseText)
                                                    .message +
                                                    "</span>");
                                            //  return false;
                        is_submit = false;
                                        }
                                        if (success == true) {
                //    denote_div.find("[data-check_input_field]input[name='reg_no']").siblings("[data-message]").empty();

                if(check_input_promoting_agency!=''){
                         if (!reg_name.test(check_input_promoting_agency)) {
                        denote_div.find("[data-check_input_field]input[name='promoting_agency']").siblings("[data-message]")
                             .html("<span style='color:red'>This field accept only characters</span>");
                          //  return false;
                          is_submit = false;
                     } 

                    }
                     if (!reg_name.test(check_input_product)) {
                        denote_div.find("[data-check_input_field]input[name='product']").siblings("[data-message]")
                             .html("<span style='color:red'>This field accept only characters</span>");
                         //  return false;
                         is_submit = false;
                     }

               
                     if ((check_input_password) != (check_input_password_1)) {
                   denote_div.find("[data-check_input_field]input[name='password']").siblings("[data-message]")
                     .html("<span style='color:red'>Password does not matched</span>");    
                     is_submit = false;
                }
                if ((check_input_password) == (check_input_password_1)) {
                    denote_div.find("[data-check_input_field]input[name='password']").siblings("[data-message]")
                        .html("<span style='color:green'>Password matched successfully</span>");
                }

                if (!reg_userid.test(check_input_userid)) {
                        denote_div.find("[data-check_input_field]input[name='user_id']").siblings("[data-message]").html("<span style='color:red'>Please enter valid userid</span>");
                         //  return false;
                         is_submit = false;
                     }
                     if (reg_userid.test(check_input_userid)) {
                        denote_div.find("[data-check_input_field]input[name='user_id']").siblings("[data-message]").empty();
                     
                                            $.ajax({
                                                type: "post",
                                                url: "<?= base_url() ?>vendor/check_userid_already_exits",
                                                data: {
                                                    userid: check_input_userid,
                                                    submit: 'submit',
                                                    id: id,
                                                },
                                                dataType: "JSON",
                                                complete: function(response) {
                                                    let success = JSON
                                                        .parse(response
                                                            .responseText)
                                                        .success;
                                                    if (success == false) {
                                                        denote_div.find(
                                                                "[data-check_input_field]input[name='user_id']"
                                                            )
                                                            .siblings(
                                                                "[data-message]"
                                                            ).html(
                                                                "<span style='color:red'>" +
                                                                JSON
                                                                .parse(response.responseText).message + "</span>");
                                                         //  return false;
                                                     is_submit = false;
                                                    }
                                                    if (success == true) {

   denote_div.find("[data-check_input_field]input[name='user_id']").siblings("[data-message]").empty();

                 $.map(check_input_bodname, function(v, i) {
                 let   bod_name_in_loop = $(v).val();
                    if (!reg_name.test($(v).val())) {
                        $(v).siblings("[data-message]")
                            .html("<span style='color:red'>This field accept only characters</span>" );
                        //  return false;
                        is_submit = false;
                    }      
                     });


                     let is_unique =1;
              //  let lengthcheck_input_bodmobile = check_input_bodmobile.length;
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
    
                let return_valu = [];
                let lengthcheck_input_bodmobile = check_input_bodmobile.length;
               $.map(check_input_bodmobile, function(v, i) {

                $(v).siblings("[data-message]").empty();
                 let   bod_phone_in_loop = $(v).val();
                    if (!reg_mobile.test($(v).val())) {
                        $(v).siblings("[data-message]")
                            .html("<span style='color:red'>Please enter valid mobile number</span>");
                        //  is_submit = false;
                    }

                    if (reg_mobile.test($(v).val())) {
                                 if (($(v).val().length == 10)) {      
                                                          $.ajax({
                                                            type: "post",
                                                            url: "<?= base_url()?>vendor/check_bod_phone_number_exits",
                                                            data: {
                                                                phone: bod_phone_in_loop,
                                                                bod_id:  '',
                                                                submit: 'submit',
                                                                id: id,
                                                            },
                                                            dataType: "dataType",
                                                            complete: function(response) {
                                                     let success = JSON.parse(response.responseText).success;
                                                                return_valu.push(success);   
                                                  //console.log(return_valu);

                                                 // console.log(return_valu.includes(success));
                                                              
                                                            if (return_valu.includes(false)) {
                                                                is_submit = false;
                                                                // console.log('has false');
                                                                if(success == false){
                                                                console.log(return_valu.includes(success));
                                                                $(v).siblings("[data-message]" ).html("<span style='color:red'>"
                                                        +JSON.parse(response.responseText).message+"</span>");  
                                                    } 
                                                }
                                                console.log('hhjhjkhkj',is_submit,(lengthcheck_input_bodmobile-1),i);
                                                    if((lengthcheck_input_bodmobile-1)==i){
                                                        if(is_submit){
                                                            // console.log('submitted');
                                                            form.submit();
                                                        }
                                                    }
                                                            }
                                                        });
                                                        
                                                    }
                                                 
                                                }       
                                                   
                                                }); 

                                             
                                                    }
   
                                                }
                                                });

                                            }   
                                        }
                                    }
                                    });
                                }
                      
                    }); 
                }); 
            </script>





            <script>
            function check_file(image, msg) {
                var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                if (!allowedExtensions.exec(image)) {
                    document.getElementById(msg).innerHTML =
                        '\n Please upload file having extensions .jpeg, .png, .jpeg only.';
                    document.getElementById("sp_image3").style.color = "red";
                    document.getElementById("submit").disabled = true;
                    return false;
                } else if (image != '') {
                    $('#' + msg).empty();
                    document.getElementById("submit").disabled = false;
                } else {
                    if (image.files && image.files[0]) {
                        let name = image.files[0].name;
                        document.getElementById(msg).innerHTML = name;
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.image')
                                .attr('src', e.target.result)
                                .width(110)
                                .height(70);
                            document.getElementById('sp_msg').innerHTML = " ";
                            document.getElementById(msg).innerHTML = "";
                            document.getElementById("submit").disabled = false;
                            return true;
                        };
                        reader.readAsDataURL(image.files[0]);
                    }
                }
            }
            </script>
</body>

</html>