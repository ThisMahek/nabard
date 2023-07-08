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
                                        <li class="breadcrumb-item"><a
                                                href="<?php echo base_url()?>Admin/index">Dashboard</a></li>
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
                                            <h4 class="card-title title_head">Update User's Profile</h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <a href="<?php echo base_url()?>Admin/manage_user"><button type="button"
                                                    class="btn btn-primary waves-effect waves-light view_btn">View
                                                    Users</button></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="pristine-valid-example"  data-on_submit
                                            action="<?= base_url('User/update_users')?>"
                                            enctype="multipart/form-data" method="post">
                                            <input type="hidden" />
                                            <input type="hidden" value="<?= $users['uid']?>" name="user_id">

                                            <div class="col-xl-6 col-md-6 mb-3" style="margin-top:3%">
                                                <div>
                                                    <?php if(!empty($users['image'] && isset($users['image']))):?>
                                                    <img src="<?= base_url()?><?= $users['image']?>"
                                                        class="imge_categoy" style="height:200px;width:200px">
                                                    <?php else:?>
                                                    <img src="<?= base_url()?>assets/images/Nabard.png"
                                                        class="imge_categoy" style="height:200px;width:200px;">
                                                    <?php endif;?>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Name</label>
                                                        <input type="text" required placeholder="Enter Your Name"
                                                            oninput=" return FullnameValidation(this.value,'alert_message_name','submit')"
                                                            value="<?= $users['name']?>"
                                                            class="form-control form_control"  data-check_input_field name = "name" />
                                                        <span id="alert_message_name"  data-messge  >  </span>
                                                    </div>
                                                </div>


                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Mobile Number</label>
                                                        <input type="text" id="num" maxlength="10" required
                                                            placeholder="Enter Your Mobile No"
                                                            value="<?= $users['mobile']?>" name="mobile"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" disabled
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control" />
                                                        <div id="alert_message_phone"></div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <label for="">*State</label>
                                                    <select class="form-control" name="state" data-filter_block_edit
                                                        required>
                                                        <option>--Select state--</option>
                                                        <?php foreach($states as $state_row): ?>
                                                        <option value="<?= $state_row['s_id']?>"
                                                            <?= ($state_row['s_id'] == $users['state_id'])?'selected':''?>>
                                                            <?= $state_row['sname']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <label class="form-label">*District </label>
                                                    <select required class="form-control" data-get_district
                                                        class="form-control form-select fom_select" name="district"
                                                        required>
                                                        <option>--Select District--</option>
                                                        <?php $district_data=$this->db->get_where('district',['state_id'=>$users['state_id'],'status'=>1])->result_array();?>
                                                        <?php foreach($district_data as $dis_row): ?>
                                                        <option value="<?= $dis_row['id']?>"
                                                            <?= ($dis_row['id'] == $users['district_id'])?'selected':''?>>
                                                            <?= $dis_row['name']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Tehsil</label>
                                                        <input type="text" id="num" required
                                                            placeholder="Enter Your Tehsil"
                                                            value="<?= $users['tahsil']?>" data-check_input_field  name="tehsil"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            oninput=" return FullnameValidation(this.value,'alert_message_tehsil','submit')"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control"  />
                                                            <span id="alert_message_tehsil"   data-messge></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>*Pincode</label>
                                                        <input type="text" id="num" maxlength="6" required
                                                            placeholder="Enter Your Pincode"
                                                            onkeypress="return isNumber(event)"
                                                            value="<?= $users['pincode']?>"  data-check_input_field name="pincode"
                                                            data-pristine-pattern="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
                                                            oninput="PincodeValidation(this.value,'alert_message_pincode','submit')"
                                                            data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number"
                                                            class="form-control form_control"   />
                                                        <span id="alert_message_pincode" data-message ></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <button type="submit" id="submit" name="update"
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


            <?php include('includes/footer.php')?>

            <script>
            $(document).ready(function() {
                var result_list_table = '';
                $("[data-filter_block_edit]").on('change', (function() {
                    let filter_attr = this.getAttribute("name");
                    let modal = $(this).closest(`.modal`);
                    let getInput = [];
                    getInput.push(`${$(this).attr('name')}=${$(this).find(':selected').val()}`);
                    getInput = getInput.join('&');
                    console.log(getInput);
                    var categoryID = $(this).val();
                    if (categoryID) {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url() ?>state/getch_state_district_block?" +
                                getInput,
                            data: "state_id=" + categoryID,
                            success: function(html) {
                                let res = JSON.parse(html);
                                if (filter_attr != '[data-get_district]') {
                                    $(`[data-get_district]`).empty();
                                    $.map(res.subcategory_list, function(v, i) {
                                        $(`[data-get_district]`).append(`
                                  ${v}
                            `);
                                    });
                                }
                            }
                        });
                    } else {
                        $(`[data-get_district]`).html(
                            '<option value="">--Select District First--</option>');
                    }
                }))
            });
            </script>





<script>
        $(`[data-on_submit]`).submit(function() {
            let check_name = $(this).find("[data-check_input_field]input[name='name']").val();
            let check_tahsil = $(this).find("[data-check_input_field]input[name='tehsil']").val();
            let check_pincode = $(this).find("[data-check_input_field]input[name='pincode']").val();
            let reg_name = /^[a-zA-Z\s]*$/;
            let reg_pincode = /^[123456789]{1}[0-9]{5}$/;


            if (!reg_name.test(check_name)) {
                $(this).find("[data-check_input_field]input[name ='name']").siblings(
                    "[data-message]").html("<span style='color:red'>Please enter text only</span>");
                return false;
            }  if (!reg_name.test(check_tahsil)) {
                $(this).find("[data-check_input_field]input[name ='tehsil']").siblings(
                    "[data-message]").html("<span style='color:red'>Please enter text only</span>");
                return false;
            }
             if (!reg_pincode.test(check_pincode)) {
                $(this).find("[data-check_input_field]input[name ='pincode']").siblings(
                    "[data-message]").html("<span style='color:red'>Please enter valid pincode</span>");
                return false;
            }
            this.submit();
        });
        </script>




















            <script>
            $(document).ready(function() {
                var result_list_table = '';
                $("[data-filter_district]").on('change', (function() {
                    let filter_attr = this.getAttribute("name");
                    let getInput = [];
                    $.map($(`select[data-filter_district]`), (v, i) => {
                        getInput.push(
                            `${$(v).attr('name')}=${$(v).find(':selected').val()}`);
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
                                if (filter_attr != 'block_id') {
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
            function PincodeValidation(vals, msg, btn) {
                let reg = /^[123456789]{1}[0-9]{5}$/;
                // console.log(vals);
                if (vals === '') {
                    $("#" + msg).html("<p style='color:red'></p>");
                    $("#" + btn).attr('disabled', false);
                    return false;
                } else if (vals.length < 6) {
                    $("#" + msg).html("<p style='color:red'>atleast 6 digit number allowed</p>");
                    return false;
                } else if (!reg.test(vals)) {
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