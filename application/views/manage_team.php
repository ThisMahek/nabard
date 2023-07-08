<!Doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?php echo $page_name; ?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $this->session->flashdata('error'); ?>
                    <?= $this->session->flashdata('success'); ?>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <button type="button"
                                                class="btn btn-primary waves-effect waves-light common_btn"
                                                data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                              <!--   <th>Designation</th>
                                                <th>Email Id</th> -->
                                                <th>Mobile No</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($teams)):
                                                $i = 0;
                                                ?>
                                            <?php foreach ($teams as $row):
                                                                $i++;
                                                                ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <?php if ($row['image'] != ''): ?>
                                                <td><img src="<?php echo base_url() ?><?= $row['image'] ?>"
                                                        class="imge_categoy"></td>
                                                <?php else: ?>
                                                <td><img src="<?php echo base_url() ?>assets/images/noimages.png"
                                                        class="imge_categoy"></td>
                                                <?php endif; ?>
                                                <td><?= $row['name'] ?></td>
                                             <!--    <td><?= $row['designation'] ? $row['designation'] : '--' ?></td>
                                                <td><?= $row['email'] ?></td> -->
                                                <td><?= $row['mobile'] ?></td>
                                                <?php if ($row['status'] == 1): ?>
                                                <td> <b style='color:green;'>Active</b></td>
                                                <?php elseif ($row['status'] == 0): ?>
                                                <td><b style='color:red;'>Inactive</b></td>
                                                <?php endif; ?>
                                                <td><button type="button"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal<?= $row['id'] ?>"><i
                                                            class="fa fa-edit"></i></button>
                                                    <a onclick="return confirm('Are you sure you want to Delete this ?')"
                                                        href="<?= base_url() ?>team/delete_team_member/<?= $row['id'] ?>">
                                                        <button type="button" class="btn btn-danger"><i
                                                                class="fa fa-trash"></i></button></a>

                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
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
                        <h5 class="modal-title" id="myModalLabel">Add Team</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div>
                                <form id="pristine-valid-example" data-on_submit data-id="" method="post" method="post"
                                    action="<?= base_url() ?>team/addTeam" enctype="multipart/form-data">
                                    <input type="hidden" />
                                    <div class="row">

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Name</label>
                                                <input type="text" required placeholder="Enter Your Name"
                                                    data-check_input_field
                                                    oninput=" return FullnameValidation(this.value,'title_span','submit_btn')"
                                                    class="form-control form_control" name="name" required />
                                                <span id="title_span" data-message></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12 mb-3">
                                            <div>
                                                <label for="formFileLg" class="form-label">Upload Image</label>
                                                <input class="form-control form-control-lg fom_select" required
                                                    id="formFileLg" data-check_input_field    accept=".jpg, .jpeg, .png"
                                                    oninput="  return check_file_edit(this.value,'sp_image3')" type="file"
                                                     name="image">
                                                <span id="sp_image3" data-message></span>
                                            </div>
                                        </div>
                                      <!--   <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Designation</label>
                                                <input type="text" id="" required placeholder="Enter Your Designation"
                                                    data-check_input_field class="form-control form_control"
                                                    name="designation"
                                                   oninput=" return FullnameValidation(this.value,'designation_span_valid','submit_btn')" /></input>
                                                <span id="designation_span_valid" data-message></span>
                                            </div>
                                        </div> -->
                                     <!--    <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Email Id</label>
                                                <input type="text" id="" required placeholder="Enter Your Email Id"
                                                    data-check_input_field class="form-control form_control"
                                                    name="email"
                                                    oninput=" return check_email(this.value,'email_span','submit_btn')" /></input>
                                                <span id="email_span" data-message></span>
                                            </div>
                                        </div> -->
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Mobile No</label>
                                                <input type="text" id="" maxlength="10" required
                                                    placeholder="Enter Your Mobile No" data-check_input_field name="mobile"
                                                    oninput="check_phone(this.value,'phone_span','submit_btn') "
                                                    onkeypress="return isNumber(event)"
                                                    class="form-control form_control"  /></input>
                                                <span id="phone_span" data-message></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select class="form-select form_control" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submit_btn" name="submit_btn "
                            class="btn btn-primary waves-effect waves-light common_btn">Add</button>
                    </div>

                </div>
                </form>
            </div>
        </div>

        <!--------------------------------------------End Add Modal  ---------------------------->


        <!--------------------------------------------Update Modal  ---------------------------->
        <?php if (!empty($teams)): ?>
        <?php foreach ($teams as $row): ?>

        <div id="editModal<?= $row['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update Team</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                    </div>
                <form id="pristine-valid-example" data-on_submit method="post"  data-id="<?= $row['id'] ?>"
                                    action="<?= base_url()?>team/update_team" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card-body">
                            <div>
                                <!-- <form id="pristine-valid-example" data-on_submit method="post"  data-id="<?= $row['id'] ?>"
                                    action="<?= base_url()?>team/update_team" enctype="multipart/form-data"> -->
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>"  />
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group ">
                                                <label>Name</label>
                                                <input type="text" oninput=" return FullnameValidation(this.value,'name_span_valid<?= $row['id'] ?>','submit_edit<?= $row['id'] ?>')"  required placeholder="Enter Your Name"
                                                    class="form-control form_control" data-check_input_field name="name"
                                                    value="<?= $row['name'] ?>" required />
                                                <span   id="name_span_valid<?= $row['id'] ?>"data-message></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12 mb-3">
                                            <div>
                                                <img src="<?= base_url('/' . $row['image']); ?>" width="40px">
                                                <label for="formFileLg" class="form-label">Upload Image</label>
                                                <input class="form-control form-control-lg fom_select" id="formFileLg"
                                                    data-check_input_field name="image" type="file"    accept=".jpg, .jpeg, .png">
                                                <span id="sp_image3_edit<?= $row['id'] ?>" data-message></span>
                                            </div>
                                        </div>
                                       <!--  <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Designation</label>
                                                <input type="text" id="" data-check_input_field
                                                    placeholder="Enter Your Designation" name="designation"
                                                    value="<?= $row['designation'] ?>"
                                                    class="form-control form_control"  oninput=" return FullnameValidation(this.value,'designation_span_edit<?= $row['id'] ?>','submit_edit<?= $row['id'] ?>')"  /></input>
                                                <span id="designation_span_edit<?= $row['id'] ?>" data-message></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Email Id</label>
                                                <input type="text" data-check_input_field 
                                                    placeholder="Enter Your Email Id"    required
                                                    class="form-control form_control"   oninput=" return check_email(this.value,'email_span_edit<?= $row['id'] ?>','submit_edit<?= $row['id'] ?>')" name="email"
                                                    value="<?= $row['email'] ?>" /></input>
                                                <span id="email_span_edit<?= $row['id'] ?>" data-message></span>
                                            </div>
                                        </div> -->
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Mobile No</label>
                                                <input type="text"  onkeypress="isNumber(event)"  id="" data-check_input_field maxlength="10" 
                                                    placeholder="Enter Your Mobile No" required
                                                    class="form-control form_control" name="mobile"
                                                    value="<?= $row['mobile'] ?>"
                                                    oninput="return check_phone_edit(this.value,'phone_span_edit<?= $row['id'] ?>','submit_edit<?= $row['id'] ?>')"
                                                    /></input>
                                                <span id="phone_span_edit<?= $row['id'] ?>" data-message></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select class="form-select form_control" name="status">
                                                    <option value="1" <?=($row['status'] == 1) ? 'selected' : '' ?>>
                                                        Active</option>
                                                    <option value="0" <?=($row['status'] == 0) ? 'selected' : '' ?>>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="update">
                    <div class="modal-footer">
                        <button type="submit" id="submit_edit<?= $row['id'] ?>"
                            class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- </form> -->
        <?php endforeach; ?>
        <?php endif; ?>

        <!--------------------------------------------End Edit Modal  ---------------------------->

        <?php include('includes/footer.php') ?>
        <script>
       /*  function check_email(email, msg, btn) {
            let reg = /\S+@\S+\.\S+/;
            let id = '';
            if (email == '') {
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
            } else if (!reg.test(email)) {
                $("#" + msg).html("<p style='color:red'>Please Enter valid email ID </p>");
                $("#" + btn).attr('disabled', true);
                return false;
            } else {
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
                return true;
            }
            
        } */
        </script>



        <script>
   /*      function DesignationValidation(vals, msg, btn) {
            let reg = /^[a-zA-Z\s]*$/;
            if (vals === '') {
                $("#" + msg).empty();
                return false;
                $("#" + btn).attr('disabled', true);
            } else if (!reg.test(vals)) {
                $("#" + msg).html("<span style='color:red'>Please Enter valid  Name</span>");
                $("#" + btn).attr('disabled', true);
                return false;
            } else {
                $("#" + msg).html("");
                $("#" + btn).attr('disabled', false);
                return true;
            }

        } */
        </script>
    


        <script>
        function check_file_edit(image, msg, btn) {
            let fileError = true;
            var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
            if (!allowedExtensions.exec(image)) {

                $("#" + msg).html(
                    "<p style='color:red'>Please upload file having extensions .jpeg, .png, .jpeg only.</p>");
                $("#" + btn).attr('disabled', true);
                fileErrror = false;
                return false;
            } else if (image != '') {
                $('#' + msg).empty();
                $("#" + btn).attr('disabled', false);
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
                        $("#" + btn).attr('disabled', false);
                    };
                    reader.readAsDataURL(image.files[0]);
                }
            }
        }
        </script>





        <script>
        function check_phone(phone, msg, id = '', btn) {
            let reg = /^[6789]{1}[0-9]{9}$/;
            if (phone === '') {
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
            } else if (!reg.test(phone)) {
                $("#" + msg).html("<p style='color:red'>Please enter valid mobile number.</p>");
                $("#" + btn).attr('disabled', true);
            } else {
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
            }
           
        }
        </script>





        <script>
        function check_phone_edit(phone, msg, id = '', btn) {
            let reg = /^[6789]{1}[0-9]{9}$/;
            if (phone === '') {
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
            }   
            else if (!reg.test(phone)) {
                $("#" + msg).html("<p style='color:red'>Please enter valid mobile number.</p>");
                $("#" + btn).attr('disabled', true);
            }else{
                $("#" + msg).empty();
                $("#" + btn).attr('disabled', false);
                return true;
            }
        }
        </script>
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
            let check_name = modal.find("[data-check_input_field]input[name='name']").val();
            let check_email = modal.find("[data-check_input_field]input[name='email']").val();
            let check_designation = modal.find("[data-check_input_field]input[name='designation']").val();
            let check_mobile = modal.find("[data-check_input_field]input[name='mobile']").val();
            let check_image = modal.find("[data-check_input_field]input[name='image']").val();
            let reg_name = /^[a-zA-Z\s]*$/;
            let reg_email = /\S+@\S+\.\S+/;
            let reg_mobile = /^[6789]{1}[0-9]{9}$/;
            var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;

            if (!reg_name.test(check_name)) {
                modal.find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html(
                    "<span style='color:red'>This field accept only characters</span>");
                return false;
            }
    
           /*  if (reg_email.test(check_email)) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>vendor/check_team_email_already_exits",
                    data: {
                        email: check_email,
                        id: id,
                        submit: 'submit',
                    },
                    dataType: "dataType",
                    complete: function(response) {
                        let success = JSON.parse(response.responseText).success;
                        if (success == false) {
                            modal.find("[data-check_input_field]input[name ='email']")
                                .siblings("[data-message]").html("<span style='color:red'>"+JSON
                                    .parse(response.responseText).message + "</span>");
                                   // return false;
                        } 
                        
                        if(success == true) {

                        }
                    }


                });
            } */
            if (!reg_mobile.test(check_mobile)) {
                modal.find("[data-check_input_field]input[name='mobile']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid mobild number</span>");
                return false;
            }
              if (reg_mobile.test(check_mobile)) {
                            $.ajax({
                                type: "post",
                                url: "<?= base_url() ?>vendor/check_team_phone_number_exits",
                                data: {
                                    phone: check_mobile,
                                    submit: 'submit',
                                    id: id,
                                },
                                dataType: "JSON",
                                complete: function(response) {
                                    let success_phone = JSON.parse(response.responseText).success;
                                    if (success_phone == false) {
                                        modal.find(
                                                "[data-check_input_field]input[name='mobile']"
                                                )
                                            .siblings("[data-message]").html(
                                                "<span style='color:red'>" + JSON
                                                .parse(response.responseText).message +
                                                "</span>");
                                        return false;
                                    }else{
                                        form.submit();
                                    }
                                }
                            });
                        }

        }); 
        </script>

</body>

</html>