<!doctype html>
<html lang="en">

<head>
    <title>
        <?php echo $title; ?>
    </title>
    <?php include('includes/common-head.php') ?>

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


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4 class="card-title title_head">Add Farmer Vendor</h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <a href="<?php echo base_url() ?>Admin/manage_farmer"><button type="button"
                                                    class="btn btn-primary waves-effect waves-light view_btn">View
                                                    Vendor</button></a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <form id="pristine-valid-example" data-on_submit method="post"
                                            action="<?= base_url() ?>vendor/add_farmer_vendor"
                                            enctype="multipart/form-data" data-id="">
                                            <input type="hidden" />
                                            <div class="row">
                                                <input type="hidden" name="field_type"
                                                    value="<?= $this->session->userdata('field_type') ? $this->session->userdata('field_type') : '' ?>">
                                                <input type="hidden" name="name"
                                                    value="<?= $this->session->userdata('vendor_name_farmer') ? $this->session->userdata('vendor_name_farmer') : '' ?>">
                                                <input type="hidden" name="mobile"
                                                    value="<?= $this->session->userdata('vendor_phone_farmer') ? $this->session->userdata('vendor_phone_farmer') : '' ?>">

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Name</label>
                                                        <input type="text" required placeholder="Enter Your Name"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('vendor_name_farmer') ? $this->session->userdata('vendor_name_farmer') : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div>
                                                        <label for="formFileLg" class="form-label">Upload
                                                            Image(Optional)</label>
                                                        <input class="form-control form-control-lg fom_select"
                                                            id="formFileLg" type="file" name="profile_image"
                                                            accept=".jpg, .jpeg, .png" data-check_input_field>
                                                        <span id="sp_image3"
                                                            style=" margin-left:4%; margin-bottom:3%  ;color:red" ;
                                                            data-message></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Field Type</label>
                                                        <input type="text" required placeholder="Enter Field Name"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('field_type') ? strtoupper($this->session->userdata('field_type')) : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Father's Name</label>
                                                        <input type="text" required
                                                            placeholder="Enter Your Father's Name" pattern="[A-Z a-z]*"
                                                            name="father_name" class="form-control form_control"
                                                            oninput=" return FullnameValidation(this.value,'alert_message_name','submit_btn')"
                                                            data-check_input_field />
                                                        <span data-check_input_span_father_name style="color:red">
                                                        </span>
                                                        <span id="alert_message_name" data-message style="color:red">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Gender</label>
                                                        <select required="" class="form-control form-select fom_select"
                                                            name="gender" data-check_input_field>
                                                            <option value="">Select gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <span data-check_input_span_gender style="color:red"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Mobile No</label>
                                                        <input type="text" required placeholder="Enter Mobile No"
                                                            class="form-control form_control"
                                                            value="<?= $this->session->userdata('vendor_phone_farmer') ? $this->session->userdata('vendor_phone_farmer') : '' ?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Whatsapp Number(Optional)</label>
                                                        <input type="num" maxlength="10" id="num"
                                                            placeholder="Enter Your Whatsapp No"
                                                            onkeypress="return isNumber(event)"
                                                            oninput=" return  WhatsappValidation(this.value,'alert_message_whatsapp','submit_btn')"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            data-check_input_field class="form-control form_control"
                                                            name="whatsapp_no" />
                                                        <span id="alert_message_whatsapp" data-message></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <label>*District</label>
                                                    <select required="" class="form-control form-select fom_select"
                                                        name="district" data-filter id="district"
                                                        data-check_input_field>
                                                        <option value="">Select District</option>
                                                        <?php foreach ($district as $row): ?>
                                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <span data-check_input_span_district style="color:red" data-message>
                                                    </span>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Block</label>
                                                        <select required="" class="form-control form-select fom_select"
                                                            name="block" data-filter id="block" data-check_input_field>
                                                            <option>Select Block</option>
                                                        </select>
                                                        <span data-check_input_span_block data-messagge
                                                            style="color:red"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Tehsil</label>
                                                        <input type="text" id="num" name="tehsil" data-check_input_field
                                                            required placeholder="Enter Your Tehsil"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control"
                                                            oninput=" return FullnameValidation(this.value,'alert_message_tehsil','submit_btn')" />

                                                        <span data-check_input_span_tehsil style="color:red"> </span>
                                                        <span id="alert_message_tehsil" data-message style="color:red">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Village</label>
                                                        <input type="text" id="num" data-check_input_field
                                                            name="village" pattern="[A-Z a-z]*"
                                                            oninput=" return FullnameValidation(this.value,'alert_message_village','submit_btn')"
                                                            required placeholder="Enter Your Village"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control" />
                                                        <!-- <span data-check_input_span_village style="color:red"> </span> -->
                                                        <span id="alert_message_village" data-message style="color:red">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Pincode</label>
                                                        <input type="text" maxlength="6" id="num" name="pincode"
                                                            data-check_input_field required
                                                            placeholder="Enter Your Pincode"
                                                            onkeypress="return isNumber(event)"
                                                            data-pristine-pattern="^[1-9]{1}[0-9]{2}\\s{0,1}[0-9]{3}$"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control"
                                                            oninput="PincodeValidation(this.value,'alert_message_pincode','submit_btn')" />
                                                        <!--   <span data-check_input_span_pincode style="color:red"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/"
                                                            >
                                                        </span> -->
                                                        <span id="alert_message_pincode" data-message></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>Aadhar Card No(Optional)</label>
                                                        <input type="text" maxlength="12" id="num"
                                                            data-check_input_field name="aadhar_no"
                                                            oninput="return  AadharValidation(this.value,'alert_message_aadhar','submit_btn')"
                                                            onkeypress="return isNumber(event)"
                                                            placeholder="Enter Your Aadhar Card No"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control" />
                                                        <span id="alert_message_aadhar" data-message></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*User Id</label>
                                                        <input type="text" id="num" data-check_input_field
                                                            name="user_id" required placeholder="Enter Your User Id"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control" />
                                                        <span data-check_input_span_userid data-message
                                                            id="check_input_span_userid" style="color:red"> </span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Password</label>
                                                        <input type="password" required
                                                            placeholder="Enter your password" data-check_input_field
                                                            class="form-control form_control" name="password"
                                                            id="id_password" />
                                                        <span data-check_input_span_password data-message
                                                            style="color:red"> </span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Confirm Password</label>
                                                        <input type="password" data-check_input_field required
                                                            placeholder="Enter your confirm password"
                                                            class="form-control form_control" name="password1"
                                                            id="id_password1" />
                                                        <!--   <span data-check_input_span_password1 style="color:red"> </span> -->
                                                        <!-- <span    data-check_input_span_password1 style="color:red" id="passMes_con" data-message></span> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="submit_btn">

                                            <button type="submit" id="submit_btn" name="submit_btn"
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
                $(document).on("submit", `[data-on_submit]`, function (e) {
                    e.preventDefault();
                    let form = this;
                    let modal = $(this).closest(`.modal`);
                    let user_id = ($(form).data('id'));
                    let id = '';
                    if (user_id != '') {
                        id = user_id;
                    }

                    let check_input_profile_image = $("[data-check_input_field]input[name='profile_image']").val();
                    let check_input_father_name = $("[data-check_input_field]input[name='father_name']").val();
                    let check_input_whatsapp_no = $("[data-check_input_field]input[name='whatsapp_no']").val();
                    let check_input_aadhar_no = $("[data-check_input_field]input[name='aadhar_no']").val();
                    let check_input_pincode = $("[data-check_input_field]input[name='pincode']").val();
                    let check_input_password = $("[data-check_input_field]input[name='password']").val();
                    let check_input_password_1 = $("[data-check_input_field]input[name='password1']").val();
                    let check_input_village = $("[data-check_input_field]input[name='village']").val();
                    let check_input_tehsil = $("[data-check_input_field]input[name='tehsil']").val();
                    let check_input_userid = $("[data-check_input_field]input[name='user_id']").val();
                    let check_input_district = $("[data-check_input_field]select[name='district']").val();
                    let check_input_block = $("[data-check_input_field]select[name='block']").val();
                    let denote_div = $(this);
                    let return_valu = [];
                    var return_msg = true;
                    let reg_userid = /^[A-Za-z][A-Za-z0-9_@#]{7,29}$/;
                    let is_submit = true;
                    let reg_name = /^[a-zA-Z\s]*$/;
                    let reg_email = /\S+@\S+\.\S+/;
                    let reg_mobile = /^[56789]{1}[0-9]{9}$/;
                    let allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                    let reg_aadhar = /^[123456789]{1}[0-9]{11}$/;
                    let reg_pincode = /^[123456789]{1}[0-9]{5}$/;
                    let increment = 0;


                    if (!reg_name.test(check_input_tehsil)) {
                        denote_div.find("[data-check_input_field]input[name='tehsil']").siblings("[data-message]")
                            .html("<span style='color:red'>This field accept only characters</span>");
                        is_submit = false;
                        return_valu.push(false);

                    }
                    if (!reg_name.test(check_input_village)) {
                        denote_div.find("[data-check_input_field]input[name='village']").siblings("[data-message]")
                            .html("<span style='color:red'>This field accept only characters</span>");
                        is_submit = false;
                        return_valu.push(false);

                    }
                    if (!reg_pincode.test(check_input_pincode)) {
                        denote_div.find("[data-check_input_field]input[name='pincode']").siblings("[data-message]")
                            .html("<span style='color:red'>Please enter valid pincode number</span>");
                        is_submit = false;
                        return_valu.push(false);

                    }

                    if ((check_input_password) != (check_input_password_1)) {
                        denote_div.find("[data-check_input_field]input[name='password']").siblings("[data-message]")
                            .html("<span style='color:red'>Password does not matched</span>");
                        is_submit = false;
                        return_valu.push(false);

                    }
                    if ((check_input_password) == (check_input_password_1)) {
                        denote_div.find("[data-check_input_field]input[name='password']").siblings("[data-message]")
                            .html("<span style='color:green'>Password matched successfully</span>");
                 
                    }
                    if (!reg_userid.test(check_input_userid)) {
                        denote_div.find("[data-check_input_field]input[name='user_id']").siblings("[data-message]").html("<span style='color:red'>Please enter valid userid</span>");
                        is_submit = false;
                        return_valu.push(false);
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
                            complete: function (response) {
                                let success = JSON.parse(response
                                    .responseText).success;
                                //   increment++;
                                if (success == false) {
                                    denote_div.find(
                                        "[data-check_input_field]input[name='user_id']"
                                    )
                                        .siblings("[data-message]").html(
                                            "<span style='color:red'>" +
                                            JSON
                                                .parse(response.responseText)
                                                .message +
                                            "</span>");
                                    is_submit = false;
                                    return_valu.push(false);
                                }
                                else {
                                    denote_div.find("[data-check_input_field]input[name='user_id']").siblings("[data-message]").empty();


                                    if (check_input_whatsapp_no != '') {
                                        if (!reg_mobile.test(check_input_whatsapp_no)) {
                                            denote_div.find("[data-check_input_field]input[name='whatsapp_no']").siblings("[data-message]")
                                                .html("<span style='color:red'>Please enter valid whatsapp number</span>");
                                            // return false;
                                            is_submit = false;
                                            return_valu.push(false);
                                            increment++;
                                        }

                                        if (reg_mobile.test(check_input_whatsapp_no)) {
                                            $.ajax({
                                                type: "post",
                                                url: "<?= base_url() ?>vendor/check_whatsaap_already_exits",
                                                data: {
                                                    whatsapp: check_input_whatsapp_no,
                                                    id: id,
                                                    submit: 'submit',
                                                },
                                                dataType: "dataType",
                                                complete: function (response) {
                                                    let success = JSON.parse(response.responseText).success;
                                                    // return_msg = success;
                                                    increment++;

                                                    if (success == false) {
                                                        denote_div.find(
                                                            "[data-check_input_field]input[name ='whatsapp_no']")
                                                            .siblings("[data-message]").html("<span style='color:red'>" +
                                                                JSON
                                                                    .parse(response.responseText).message + "</span>");
                                                        is_submit = false;
                                                        return_valu.push(false);

                                                    }
                                                    if (success == true) {
                                                        denote_div.find(
                                                            "[data-check_input_field]input[name ='whatsapp_no']")
                                                            .siblings("[data-message]").empty();

                                                    }

                                                    if (return_valu.includes(false) || increment != 2) {

                                                            console.log('false',532);

                                                            } else {
                                                            console.log('true',536);
                                                            form.submit(); 
                                                            }

                                                }

                                            });

                                        }

                                    } else {
                                        increment++;
                                    }
                                    if (check_input_aadhar_no != '') {

                                        if (!reg_aadhar.test(check_input_aadhar_no)) {
                                            denote_div.find("[data-check_input_field]input[name='aadhar_no']").siblings("[data-message]")
                                                .html("<span style='color:red'>Please enter valid aadhar number</span>");
                                            is_submit = false;
                                            return_valu.push(false);
                                            increment++;

                                        }
                                        if (reg_aadhar.test(check_input_aadhar_no)) {

                                            $.ajax({
                                                type: "post",
                                                url: "<?= base_url() ?>vendor/check_aadharnum_already_exits",
                                                data: {
                                                    aadharnum: check_input_aadhar_no,
                                                    submit: 'submit',
                                                    id: id,
                                                },
                                                dataType: "JSON",
                                                complete: function (response) {
                                                    let success = JSON.parse(response
                                                        .responseText).success;

                                                    increment++;
                                                    if (success == false) {
                                                        denote_div.find(
                                                            "[data-check_input_field]input[name='aadhar_no']"
                                                        )
                                                            .siblings("[data-message]").html(
                                                                "<span style='color:red'>" +
                                                                JSON
                                                                    .parse(response.responseText)
                                                                    .message +
                                                                "</span>");
                                                        is_submit = false;
                                                        return_valu.push(false);
                                                    } else {
                                                        denote_div.find("[data-check_input_field]input[name='aadhar_no']")
                                                            .siblings("[data-message]").empty();
                                                
                                                    }

                                                    console.log(return_valu);
                                                    if (return_valu.includes(false) || increment != 2) {

                                                    console.log('false',532);

                                                    } else {
                                                    console.log('true',536);
                                                    form.submit(); 
                                                    }

                                                }
                                            });
                                        }
                                    } else {
                                        increment++;
                                    }

                                    console.log(return_valu);
                                    if (return_valu.includes(false) || increment != 2) {

                                        console.log('false',532);

                                    } else {
                                        console.log('true',536);
                                         form.submit(); 
                                    }

                                }
                            }
                        });


                    }
                    setTimeout(function(){
                        console.log(increment);
                    },2000);
                });




            </script>






            <script>
                function WhatsappValidation(whatsapp, msg, btn) {
                    let reg = /^[6789]{1}[0-9]{9}$/;
                    if (whatsapp === '') {
                        $("#" + msg).html("<p style='color:red'></p>");
                        $("#" + btn).attr('disabled', false);
                        // return false;
                    } else if (whatsapp.length < 10) {

                        $("#" + msg).html("<p style='color:red'>invalid whatsapp number</p>");
                        $("#" + btn).attr('disabled', false);
                        // return false;
                    } else if (!reg.test(whatsapp)) {
                        $("#" + msg).html("<p style='color:red'>Please enter valid whatsapp number</p>");
                        $("#" + btn).attr('disabled', true);
                        // return false;
                    } else {
                        $("#" + msg).empty();
                        $("#" + btn).attr('disabled', false);
                        // return true;
                    }
                }
            </script>




            <script>
                function PincodeValidation(vals, msg, btn) {
                    let reg = /^[123456789]{1}[0-9]{5}$/;

                    console.log(vals);
                    if (vals === '') {
                        $("#" + msg).html("<p style='color:red'></p>");
                        $("#" + btn).attr('disabled', false);
                        // return false;
                    } else if (vals.length < 6) {
                        $("#" + msg).html("<p style='color:red'>atleast 6 digit number allowed</p>");
                        // return false;
                    } else if (!reg.test(vals)) {
                        $("#" + msg).html("<p style='color:red'>Please Enter valid Pincode</p>");
                        $("#" + btn).attr('disabled', true);
                        // return false;
                    } else {
                        $("#" + msg).html("");
                        $("#" + btn).attr('disabled', false);
                        // return true;

                    }
                }
            </script>



            <script>
                function AadharValidation(aadharnum, msg, btn) {
                    let reg = /^[123456789]{1}[0-9]{11}$/;
                    let id = '';
                    if (aadharnum === '') {
                        $("#" + msg).html("<p style='color:red'></p>");
                        $("#" + btn).attr('disabled', false);
                        // return true;
                    } else if (!reg.test(aadharnum)) {
                        $("#" + msg).html("<p style='color:red'>Please Enter valid Aadhar number</p>");
                        $("#" + btn).attr('disabled', true);
                        // return false;
                    } else {
                        $("#" + msg).empty();
                        $("#" + btn).attr('disabled', false);
                    }

                }
            </script>





</body>

</html>