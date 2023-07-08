<!doctype html>
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

                    <?= $this->session->flashdata('success'); ?>
                    <?= $this->session->flashdata('error'); ?>
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
                                            <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <!--  <form action ="<?= base_url() ?>vendor/enabled_district" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="inputState">Select State</label>
                                                    <select class="form-select form_control" id="inputState_enb"  name="state" data-filter_disabled   required  >
                                                        <option value="SelectState">-- Select State --</option>
                                                        <?php foreach ($states as $row): ?>
                                                            <option value="<?= $row['s_id'] ?>"><?= $row['sname'] ?></option>
                                                        <?php endforeach; ?>
                                                      </select>
                                                </div>
                                                            
                                                <div class="form-group col-md-5">
                                                    <label for="inputDistrict">Select District</label>
                                                    <select class="form-select form_control" name="district" required id="inputDistrict_dis" >
                                                        <option value="">--Select District-- </option>
                                                    </select>
                                                 </div>
                                                        
                                        
                                            <div class="form-group col-md-2">
                                            <button type ="submit" style="margin-top: 30px;" class="btn btn-primary">Enabled</button>
                                             </div>
                                         </div>                  
                                            </form>   -->





                                    <form action="<?= base_url() ?>vendor/add_block" method="post" data-on_submit>
                                        <div class="row"   >
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Select State</label>
                                                <select class="form-select form_control" id="inputState_block"
                                                    name="state" data-filter_block="" required>
                                                    <option value="SelectState">-- Select State --</option>
                                                    <?php foreach ($states as $row): ?>

                                                    <option value="<?= $row['s_id'] ?>"><?= $row['sname'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputDistrict">Select District</label>
                                                <select class="form-select form_control" name="district" required
                                                    id="inputDistrict_block">
                                                    <option value="">--Select District-- </option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-2">
                                                <label for=""> Block</label>
                                                <input type="text"  data-check_input_field name="block" class="form-control"
                                                    placeholder="Enter block"  oninput="return BlocknameValidation(this.value,'blck_span','submit')" required>
                                                <span  id="blck_span"  data-message></span>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <button type="submit"  id="submit" style="margin-top: 30px;"
                                                    class="btn btn-primary">Add Block</button>
                                            </div>
                                        </div>
                                    </form>



                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-6 col-6">
                                                            <h4 class="card-title title_head">Manage Block</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body overy">
                                                    <table id="datatable-buttons"
                                                        class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>State</th>
                                                                <th>District</th>
                                                                <th>Block</th>
                                                                <th>Edit Block</th>
                                                                <th>Action</th>
                                                                <!-- <th>Price</th>
<th>Availability Stock</th>
<th>Stock</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
    $i = 0;
     foreach ($block_table as $row):
        $i++; ?>
                                                            <tr>
                                                                <td><?= $i ?></td>
                                                                <td><?= $row['sname'] ?></td>
                                                                <td><?= $row['dname'] ?></td>
                                                                <td><?= ucfirst($row['bname']) ?></td>
                                                                <td>
                                                                    <!-- <form method="post" action="<?= base_url() ?>state/update_block"> -->
                                                                    <!-- <input type="text" value="<?= $row['bname'] ?>" name="block"  class=" w-3 form-control"> -->
                                                                    <!-- <input type="hidden" name="b_id" value="<?= $row['b_id'] ?>"> -->
                                                                    <input type="button" value="Edit"
                                                                        class="btn btn-primary" data-bs-toggle="modal"
                                                                        data-bs-target="#editblock<?= $row['b_id'] ?>">
                                                                    <!-- </form> -->
                                                                </td>
                                                                <?php if ($row['b_status'] == 1): ?>
                                                                <td><a onclick="return confirm('Are you sure you want to disabled Block?')"
                                                                        href="<?= base_url() ?>State/change_block_status/<?= $row['b_id'] ?>"><button
                                                                            type="button"
                                                                            class="btn btn-success">Disabled</button></a>
                                                                </td>
                                                                <?php elseif ($row['b_status'] == 2): ?>
                                                                <td><a onclick="return confirm('Are you sure you want to enabled Block ?')"
                                                                        href="<?= base_url() ?>State/change_block_status/<?= $row['b_id'] ?>"><button
                                                                            type="button"
                                                                            class="btn btn-danger">Enabled</button></a>
                                                                </td>
                                                                <?php endif; ?>
                                                            </tr>
                                                            <?php endforeach; ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END layout-wrapper -->
        <?php foreach ($block_table as $row):?>

        <div id="editblock<?= $row['b_id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update Block</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div>
                                <form id="pristine-valid-example"  data-on_submit action="<?= base_url()?>state/update_block"
                                    method="post">
                                    <input type="hidden" />
                                    <div class="row">
                                        <input type="hidden" name="b_id" value="<?= $row['b_id']?>">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group">
                                                <label for=""> State</label>
                                                <select class="form-control" name="state" data-filter_block_edit
                                                    required>
                                                    <option>--Select state--</option>
                                                    <?php foreach($states as $state_row): ?>
                                                    <option value="<?= $state_row['s_id']?>"
                                                        <?= ($state_row['s_id'] == $row['s_id'])?'selected':''?>>
                                                        <?= $state_row['sname']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group">
                                                <label for=""> District</label>
                                                <select class="form-control" data-get_district name="district" required>
                                                    <option>--Select District--</option>
                                                    <?php $district_data=$this->db->get_where('district',['state_id'=>$row['s_id'],'status'=>1])->result_array();?>
                                                    <?php foreach($district_data as $dis_row): ?>
                                                    <option value="<?= $dis_row['id']?>"
                                                        <?= ($dis_row['id'] == $row['d_id'])?'selected':''?>>
                                                        <?= $dis_row['name']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group">
                                                <label for="">Block</label>
                                                <input type="text"   data-check_input_field value="<?= $row['bname'] ?>" name="block"
                                                    class="form-control" placeholder="Enter block name"  oninput="return BlocknameValidation(this.value,'block_span<?= $row['b_id']?>','submit<?= $row['b_id']?>')" required>
                                            <span id="block_span<?= $row['b_id']?>"></span>      
                                        <span  data-message></span>
                                        </div>
                                        </div>

                                    </div>
                                    <!-- end row -->



                                    <div class="modal-footer">
                                        <button type="submit" id="submit<?= $row['b_id']?>" name="update"
                                            class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach;?>

        <?php include('includes/footer.php') ?>



        <script>
        $(document).ready(function() {
            var result_list_table = '';
            $("[data-filter_block]").on('change', (function() {
                let filter_attr = this.getAttribute("name");
                let getInput = [];
                $.map($(`select[data-filter_block]`), (v, i) => {
                    getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
                })
                getInput = getInput.join('&');
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>state/getch_state_district_block?" +
                            getInput,
                        data: "state_id=" + categoryID,
                        success: function(html) {
                            let res = JSON.parse(html);
                            if (filter_attr != 'inputDistrict_block') {
                                $(`#inputDistrict_block`).empty();
                                $.map(res.subcategory_list, function(v, i) {
                                    $(`#inputDistrict_block`).append(`
                                  ${v}
                            `);
                                });
                            }
                        }
                    });

                } else {
                    $('#inputDistrict_block').html(
                        '<option value="">--Select District First--</option>');
                }

            }))
        });
        </script>



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
                                $(modal).find(`[data-get_district]`).empty();
                                $.map(res.subcategory_list, function(v, i) {
                                    $(modal).find(`[data-get_district]`).append(`
                                  ${v}
                            `);
                                });
                            }
                        }
                    });
                } else {
                    $(modal).find(`[data-get_district]`).html(
                        '<option value="">--Select District First--</option>');
                }
            }))
        });
        </script>





        <script>
        $(document).ready(function() {
            var result_list_table = '';
            $("[data-filter_disabled]").on('change', (function() {
                let filter_attr = this.getAttribute("name");
                let getInput = [];
                $.map($(`select[data-filter_disabled]`), (v, i) => {
                    getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
                })
                getInput = getInput.join('&');
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>state/getch_state_district_disabled?" +
                            getInput,
                        data: "state_id=" + categoryID,
                        success: function(html) {
                            let res = JSON.parse(html);
                            if (filter_attr != 'inputDistrict_dis') {
                                $(`#inputDistrict_dis`).empty();
                                $.map(res.subcategory_list, function(v, i) {
                                    $(`#inputDistrict_dis`).append(`
                                  ${v}
                            `);
                                });
                            }
                        }
                    });

                } else {
                    $('#inputDistrict_dis').html(
                    '<option value="">--select state first--</option>');
                }

            }))
        });
        </script>






        <script>
        $(document).ready(function() {
            var result_list_table = '';
            $("[data-filter_enabaled]").on('change', (function() {
                let filter_attr = this.getAttribute("name");
                let getInput = [];
                $.map($(`select[data-filter_enabaled]`), (v, i) => {
                    getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
                })
                getInput = getInput.join('&');
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>state/getch_state_district_enabled?" +
                            getInput,
                        data: "state_id=" + categoryID,
                        success: function(html) {
                            let res = JSON.parse(html);
                            if (filter_attr != 'inputDistrict_dis') {
                                $(`#inputDistrict_enb`).empty();
                                $.map(res.subcategory_list, function(v, i) {
                                    $(`#inputDistrict_enb`).append(`
                                  ${v}
                            `);
                                });
                            }
                        }
                    });

                } else {
                    $('#inputDistrict_enb').html(
                    '<option value="">--select state first--</option>');
                }

            }))
        });
        </script>




<script>

function BlocknameValidation(vals,msg,btn) {
let reg = /^[a-zA-Z\s]*$/;
if (vals === '') {
    $("#" + msg).empty();
    // console.log('false');
    return false;
    $("#" + btn).attr('disabled', true);
    // console.log('true');
} else if (!reg.test(vals)) {
    $("#" + msg).html("<span style='color:red'>Please enter valid block name</span>");
    $("#" + btn).attr('disabled', true);
    // console.log('false');
    return false;
} else {
    $("#" + msg).html("");
    $("#" + btn).attr('disabled', false);
    // console.log('true');
    return true;
    // console.log('false');
}

}
</script>

<script>
                $(`[data-on_submit]`).submit(function()
                {
                    // alert('hhhhhhhhhhh');
                let  check_name = $(this).find("[data-check_input_field]input[name='block']").val();
                let   reg_name = /^[a-zA-Z\s]*$/;
                if (!reg_name.test(check_name)) {
                    $(this).find("[data-check_input_field]input[name ='block']").siblings("[data-message]").html("<span style='color:red'>Please enter valid block name</span>");
                return false; 
                } 
                this.submit();
                });

                </script>


</body>

</html>