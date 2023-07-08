<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <?php include('includes/common-head.php')?>

    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
.select2-container {
    display: block;
    margin-bottom: 15px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    box-shadow: 0 0 5px 0 #c9c4c4;
    padding: 14px 15px;
}

.select2-container--default .select2-selection--single {
    border: 0px !important;
}

/*.select2-container--default .select2-search--dropdown .select2-search__field {*/
/*    border: 0px solid #aaa;*/
/*}*/
.select2-dropdown {
    border: 1px solid lightgray;
}

.select2-container--default .select2-selection--single .select2-selection__arrow b {
    margin-left: -13px;
    margin-top: -2px;
    top: 103%;
}

.select2-container .select2-selection--single {
    line-height: 1.5;
    height: 50px;
}

.select2-results {
    box-shadow: 0 .25rem .75rem rgba(18, 38, 63, .08) !important;
}

.select2-container--default .select2-results>.select2-results__options {
    padding: 0px 8px;
}

.wrapper {
    /*width:200px;*/
    padding: 20px;
    height: auto;
}
</style>

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
                                        <li class="breadcrumb-item" style="color:#e53333;font-weight:600;">
                                            <?php echo $error=$this->session->flashdata('error'); ?></li>
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
                                    <?= $this->session->userdata('success');?>
                                    <?= $this->session->userdata('error');?>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4 class="card-title title_head">Manage Product</h4>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <button type="button"
                                                class="btn btn-primary waves-effect waves-light common_btn"
                                                data-bs-toggle="modal" data-bs-target="#myModal">+Add</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">


                                    <table id="datatable-buttons"
                                        class="table table-bordered dt-responsive  nowrap w-100table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Product Name(Hindi)</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <!--<th>MRP</th>-->
                                                <!--<th>Price</th>-->
                                                <!--<th>Quantity</th>-->
                                                <!--<th>View Details</th>-->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($products)):
                                                    $i=0;
                                                    ?>
                                            <?php foreach($products as $row):
                                                        $i++;
                                                        ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $row['product_name_english']?>(<?= $row['product_name_hindi']?>)
                                                </td>
                                                <td><?=$row['category_name']?></td>
                                                <td><?= $row['subcategory_name']?></td>
                                                <?php if($row['status']== 1):?>
                                                <td><a onclick="return confirm('Are you sure you want to inactive?')"
                                                        href="<?= base_url()?>product/change_product_status/<?= $row['id']?>"><button
                                                            type="button" class="btn btn-success">Active</button></a>
                                                </td>
                                                <?php else:?>
                                                <td><a onclick="return confirm('Are you sure you want to active?')"
                                                        href="<?= base_url()?>product/change_product_status/<?=$row['id']?>"><button
                                                            type="button" class="btn btn-danger">Inactive</button></a>
                                                </td>
                                                <?php endif;?>
                                                <td><button type="button"
                                                        class="btn btn-success waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editcat<?= $row['id']?>"><i
                                                            class="fa fa-edit"></i></button></a>
                                                    <a onclick="return confirm('Are you sure you want to delete product?')"
                                                        href="<?= base_url()?>product/delete_vendor_product/<?= $row['id']?>">
                                                        <button type="button" class="btn btn-danger"><i
                                                                class="fa fa-trash"></i></button></a>
                                                </td>
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


        <!--------------------------------------------Add Modal  ---------------------------->


        <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add Product</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <!--<div class="col-md-12">-->
                            <!--      <select class="js-example-basic-single form-control" name="states[]">-->
                            <!--             <option value="AL">Alabama</option>-->
                            <!--             <option value="WY">Wyoming</option>-->
                            <!--             <option value="WY">Wyoming</option>-->
                            <!--             <option value="WY">Wyoming</option>-->
                            <!--             <option value="WY">Wyoming</option>-->
                            <!--             <option value="WY">Wyoming</option>-->
                            <!--         </select>-->
                            <!--</div>-->
                            <div>
                                <form id="pristine-valid-example" data-on_submit method="post"
                                    action="<?= base_url()?>product/add_vendor_product">
                                    <input type="hidden" />
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name</label>
                                                <input type="text" pattern="[A-Z a-z]*" 
                                                    oninput="FullnameValidation(this.value,'product_name_span','submit')"
                                                    data-check_input_field placeholder="Enter Product Name" value=""
                                                    class="form-control form_control" name="product_name_english"
                                                    required>
                                                <span style="color:red" id="product_name_span" data-message></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name(Hindi)</label>
                                                <input type="text" placeholder="Enter Product Name" value=""
                                                    class="form-control form_control" name="product_name_hindi"
                                                    required>
                                                <span style="color:red" id="product_namehindi_span"></span>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Category</label>
                                                <select data-check_input
                                                    class="form-control form-select fom_select select2"
                                                    data-filter_product name="category" id="category" required
                                                    onfocus='this.size=3;' onblur='this.size=1;'
                                                    onchange='this.size=1; this.blur();'>
                                                    <option value="">Select Category</option>
                                                    <?php foreach($category as $row): ?>
                                                    <option value="<?= $row['id']?>"><?= $row['name']?> </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Sub Category</label>
                                                <select data-check_input required=""
                                                    class="form-control form-select fom_select select2"
                                                    name="subcategory" data-filter_product data-subcategory
                                                    id="subcategory" required onfocus='this.size=3;'
                                                    onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                    <option value="">Select Category first</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- end row -->

                                    <div class="modal-footer">
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary waves-effect waves-light common_btn">Add</button>
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
        <?php foreach($products as $row ):?>

        <div id="editcat<?= $row['id']?>" class="modal select2_modal fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update Product</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div>
                                <form id="pristine-valid-example" method="post"
                                    action="<?=base_url()?>product/update_vendor_product/<?= $row['id']?>"
                                    data-on_submit>
                                    <input type="hidden" />
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name</label>
                                                <input data-check_input_field type="text" pattern="[A-Z a-z]*"    required
                                                    value="<?= $row['product_name_english']?>"
                                                    placeholder="Enter Product Name" class="form-control form_control"
                                                    oninput="FullnameValidation(this.value,'product_name_span_edit<?= $row['id']?>','update<?= $row['id']?>')"
                                                    name="product_name_english">
                                                <span id="product_name_span_edit<?= $row['id']?>" data-message></span>

                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name(Hindi)</label>
                                                <input type="text" required="" value="<?= $row['product_name_hindi']?>"
                                                    placeholder="Enter Product Name" class="form-control form_control"
                                                    name="product_name_hindi" required>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Category</label>
                                                <select required=""
                                                    class="form-control form-select fom_select edit_select"
                                                    data-filters_edit name="category" required onfocus='this.size=3;'
                                                    onblur='this.size=1;' onchange='this.size=1; this.blur();'>


                                                    <option value="">Select Category</option>
                                                    <?php foreach($category as $c_row): ?>
                                                    <option value="<?=$c_row['id']?>"
                                                        <?= ($row['category_id'] == $c_row['id'])?'selected':''?>>
                                                        <?= $c_row['name']?></option>
                                                    <?php endforeach;?>

                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                                    $c_id  =  $row['category_id'];
                                                    $subcat = $this->db->get_where('subcategory', ['parent_id' => $c_id,'status'=>1])->result_array();
                                                    ?>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Sub Category</label>
                                                <select required=""
                                                    class="form-control form-select fom_select edit_select"
                                                    name="subcategory" id="edit_subcategory" data-subcategory_edit
                                                    required onfocus='this.size=3;' onblur='this.size=1;'
                                                    onchange='this.size=1; this.blur();'>
                                                    <option value="">Select Sub Category</option>
                                                    <?php if(isset($subcat)): ?>
                                                    <?php foreach($subcat as $s_row):?>
                                                    <option value="<?= $s_row['id']?>"
                                                        <?= ($row['subcategory_id'] == $s_row['id'])?'selected':''?>>
                                                        <?= $s_row['name']?></option>
                                                    <?php
                                                                endforeach;
                                                                endif;
                                                                ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->

                                    <div class="modal-footer">
                                        <button type="submit" id="update<?= $row['id']?>" name="update"
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

        <!--------------------------------------------End Edit Modal  ---------------------------->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <?php include('includes/footer.php')?>

        <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
        //     $(document).ready(function() {
        //     $('select').select2();
        // });
        </script>
        <script>
        // $('.select2').select2({
        //     dropdownParent: $('#myModal')
        // });
        // $('select').select2({
        //     dropdownParent: $('#editexampleModal')
        // });
        </script>
        <script>
        /*$("[data-check_input_field]").submit(function(e)
 {
   let product_name_english= $("[data-check_input]input['name'='product_name_english']").val();
   if(product_name_english == ''){
    $("[data-check_input]input['name'='product_name_english']").prop('required',true);
    return false;
   } */

        /*  $("[data-check_input]input['name'='product_name_hindi']").prop('required',true);
         $("[data-check_input]input['name'='category']").prop('required',true);
         $("[data-check_input]input['name'='subcategory']").prop('required',true); */
        // this.submit(); 
        // }); 
        </script>








        <script>
        $(`[data-on_submit]`).submit(function() {
            let check_name = $(this).find("[data-check_input_field]input[name='product_name_english']").val();
            let reg_name = /^[a-zA-Z\s]*$/;


            if (!reg_name.test(check_name)) {
                $(this).find("[data-check_input_field]input[name ='product_name_english']").siblings(
                    "[data-message]").html("<span style='color:red'>Please enter valid name</span>");
                return false;
            }

            this.submit();
        });
        </script>

        <script>
        $(document).ready(function() {
            var result_list_table = '';
            $("[data-filter_product]").on('change', (function() {
                let filter_attr = this.getAttribute("name");
                let getInput = [];
                $.map($(`select[data-filter_product]`), (v, i) => {
                    getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
                })
                getInput = getInput.join('&');
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url()?>Product/fetch_subCategory?" + getInput,
                        data: "state_id=" + categoryID,
                        success: function(html) {
                            let res = JSON.parse(html);

                            if (filter_attr != 'subcategory') {
                                $(`[data-subcategory]`).empty();
                                $.map(res.subcategory_list, function(v, i) {
                                    $(`[data-subcategory]`).append(`
                                  ${v}
                            `);
                                });
                            }
                        }
                    });

                } else {
                    $(`[data-subcategory]`).html('<option value="">select category first</option>');
                }

            }))
        });
        </script>


       <!--  <div></div>
        <div>
            <span onclick="funct(this)"></span>
            <span></span>
            <span>
                <h1></h1>
            </span>
            <span></span>
        </div> -->




        <script>
        $("[data-filters_edit]").on('change', (function() {
            let filter_attr = this.getAttribute("name");
            let modal = $(this).closest(`.modal`);
            let getInput = [];
            // $.map($(`select[data-filters_edit]`), (v, i) => {
            getInput.push(`${$(this).attr('name')}=${$(this).find(':selected').val()}`);
            // })
            // console.log($(modal).find(`[data-subcategory_edit]`));
            getInput = getInput.join('&');
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url()?>Product/fetch_subCategory_edit?" + getInput,
                    data: {
                        category: categoryID
                    },
                    success: function(html) {
                        let res = JSON.parse(html);
                        if (filter_attr != 'subcategory') {
                            $(modal).find(`[data-subcategory_edit]`).empty();
                            $.map(res.subcategory_list, function(v, i) {
                                $(modal).find(`[data-subcategory_edit]`).append(`
                                  ${v}
                            `);
                            });
                        }
                    }
                });

            } else {
                $(modal).find('[data-subcategory_edit]').html(
                    '<option value="">select category first</option>');
            }

        }))
        // });
        </script>

</body>

</html>