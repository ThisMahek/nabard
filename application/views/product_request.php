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

                                    <?= $this->session->flashdata('success');?>
                                    <?= $this->session->flashdata('error');?>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h4 class="card-title title_head">Product Request</h4>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Select Vendor</label>
                                                <select required="" class="form-control form-select fom_select"
                                                    data-filter_vendor name="vendor_id" id="vendor_id"   data-next="category" 
                                                    data-default_option="<option value='_empty_'>Select vendor</option>"
                                                    data-filter="vendor"
                                                    >
                                                    <option value="">Select Vendor</option>
                                                    <?php  if(!empty($vendors)):?>
                                                    <?php foreach($vendors as $row): ?>
                                                    <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Select Categoy</label>
                                                <select required="" class="form-control form-select fom_select"
                                                    data-filter_vendor  data-filter_vendor2 name="category" id="category" 
                                                    data-default_option="<option value='_empty_'>Select category</option>"
                                                    data-filter="category"
                                                    data-next="sub_category" >
                                                    <option value="">Select Category</option>
                                                    <?php  if(!empty($category)):?>
                                                    <?php foreach($category as $row): ?>
                                                    <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Select Sub Categoy</label>
                                                <select required="" class="form-control form-select fom_select"
                                                    data-filter_vendor  data-filter_vendor2 name="sub_category" id="sub_category"  
                                                    data-default_option="<option value=''>--Select Sub Category--</option>"
                                                    data-filter="sub_category"
                                                    data-next="" >
                                                    <!-- <option value="">All</option> -->
                                                    <option value="">Select category first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <table data-result_list_table
                                        class="table table-bordered dt-responsive  nowrap w-100 table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Vendor Name</th>
                                                <th>Product Name(Hindi)</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>MRP</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>View Details</th>
                                            </tr>
                                        </thead>
                                        <tbody id="vendors_product">
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
                            <div>
                                <form id="pristine-valid-example" novalidate method="post">
                                    <input type="hidden" />
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name</label>
                                                <input type="text" required="" placeholder="Enter Product Name"
                                                    class="form-control form_control">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name(Hindi)</label>
                                                <input type="text" required="" placeholder="Enter Product Name"
                                                    class="form-control form_control">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Category</label>
                                                <select required="" class="form-control form-select fom_select">
                                                    <option value="">Select Category</option>
                                                    <option value="wr">Seeds </option>
                                                    <option value="ph">Seeds</option>
                                                    <option value="cy">Seeds</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Sub Category</label>
                                                <select required="" class="form-control form-select fom_select">
                                                    <option value="">Select Sub Category</option>
                                                    <option value="wr">Avocado Seeds</option>
                                                    <option value="ph">Apricot Kernels</option>
                                                    <option value="cy">Sesame Seeds</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Add</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!--------------------------------------------End Add Modal  ---------------------------->


        <!--------------------------------------------Update Modal  ---------------------------->


        <div id="editcat" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <form id="pristine-valid-example" novalidate method="post">
                                    <input type="hidden" />
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name</label>
                                                <input type="text" required="" placeholder="Enter Product Name"
                                                    class="form-control form_control">
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Product Name(Hindi)</label>
                                                <input type="text" required="" placeholder="Enter Product Name"
                                                    class="form-control form_control">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Category</label>
                                                <select required="" class="form-control form-select fom_select">
                                                    <option value="">Select Category</option>
                                                    <option value="wr">Seeds </option>
                                                    <option value="ph">Seeds</option>
                                                    <option value="cy">Seeds</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Sub Category</label>
                                                <select required="" class="form-control form-select fom_select">
                                                    <option value="">Select Sub Category</option>
                                                    <option value="wr">Avocado Seeds</option>
                                                    <option value="ph">Apricot Kernels</option>
                                                    <option value="cy">Sesame Seeds</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                    </div>
                </div>
            </div>
        </div <!--------------------------------------------End Edit Modal ---------------------------->

        <?php include('includes/footer.php')?>









        <script>
            /* 
            $(`[data-filter][data-nested_select]`).change(function(e) {
             e.preventDefault();
             let obj = this;
             let obj_for_clear_next_selects = $(obj).attr('data-next');
             while (obj_for_clear_next_selects != '') {
                 next = `[data-filter="${obj_for_clear_next_selects}"]`
                 $(next).html($(next).attr(`data-default_option`))
                 obj_for_clear_next_selects = $(next).attr(`data-next`)
             }
             filter(obj)
             collect_filter_data()

         }); 
         
                            <div class="col-md-3 col-6">
                                 <div class="mb-3">
                                     <label class="mb-2">Sports</label>
                                     <select data-filter="sports" data-nested_select
                                         data-default_option="<option value='_empty_'>Select Sports</option>"
                                         data-next="tournament" name="sports" class="form-control">
                                         <option value="_empty_">Select Sports</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-3 col-6">
                                 <div class="mb-3">
                                     <label class="mb-2">Tournaments</label>
                                     <select data-filter="tournament" data-nested_select
                                         data-default_option="<option value=''>Select Tournament</option>"
                                         data-next="" name="tournament" class="form-control">
                                         <option value=''>Select Tournament</option>
                                     </select>
                                 </div>
                             </div>*/
        $(document).ready(function() {
            var result_list_table = '';
            $(`[data-filter_vendor2]`).change(function(e) {
             e.preventDefault();
             let obj = this;
             let obj_for_clear_next_selects = $(obj).attr('data-next');
             while (obj_for_clear_next_selects != '') {
                 next = `[data-filter="${obj_for_clear_next_selects}"]`
                 $(next).html($(next).attr(`data-default_option`))
                 obj_for_clear_next_selects = $(next).attr(`data-next`)
             }
 
         }); 
            $("[data-filter_vendor]").on('change', (function() {
                let filter_attr = this.getAttribute("name");
                let getInput = [];
                $.map($(`select[data-filter_vendor]`), (v, i) => {
                    getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
                })
                getInput = getInput.join('&');
                getlist(getInput, filter_attr)
            }))

            var stateID = $(this).val();
            function getlist(getInput = "", filter_attr = "") {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url()?>product/fetch_subCategory_filter?" + getInput,
                    data: "",
                    success: function(html) {
                      
                        let res = JSON.parse(html);
                        if (filter_attr == 'category') {
                        $(`#sub_category`).empty();
                            $.map(res.subcategory_list, function(v, i) {
                                $(`#sub_category`).append(`${v}`);
                            });
                        }

                        $(`#vendors_product`).empty();
                        if (result_list_table != '') {
                            result_list_table.clear()
                            result_list_table.destroy();
                        }
                        var i = 1;
                        $.map(res.vendor_data_filter, function(v, i) {
                            let btn_text = '';
                            let img_vendor = '';
                            i++;
                            let disabled_value = ['1', '3'];
                            let is_disable = '';
                            if (disabled_value.includes(v.product_status)) {
                                is_disable = 'disabled';
                            }
                            if (v.product_status == '1') {
                                btn_text = `<select ${is_disable} data-status_input data-id="${v.product_id}" name ="withdraw_status" class="form-control"  data-req_user_id="${v.v_id}'">
                                <option  value = "0"   ${v.product_status == 0?'selected':''}>Pending</option>
                                <option  value = "1"  ${v.product_status== 1?'selected':''}>Approved</option>
                                <option  value = "3"  ${v.product_status== 3?'selected':''}>Rejected</option>
                               </select>`;
                            } else if (v.product_status == '0') {
                                /*   btn_text = `<a onclick="return confirm('Are you sure you want to active?')" href='<?= base_url()?>product/update_productRequest_status?id=${v.product_id}'><button
                             class="btn btn-danger">Pending</button></a>`;  */
                                btn_text = `<select ${is_disable} data-status_input data-id="${v.product_id}" name ="withdraw_status" class="form-control"  data-req_user_id="${v.v_id}'">
                                <option value="0"   ${v.product_status == 0?'selected':''}>Pending</option>
                                <option  value="1"   ${v.product_status== 1?'selected':''}>Approved</option>
                                <option  value="3"    ${v.product_status== 3?'selected':''}>Rejected</option>
                               </select>`;

                            } else if (v.product_status == '3') {
                                btn_text = `<select ${is_disable} data-status_input data-id="${v.product_id}" name ="withdraw_status" class="form-control"  data-req_user_id="${v.v_id}'">
                                <option value="0"   ${v.product_status == 0?'selected':''}>Pending</option>
                                <option  value="1"   ${v.product_status== 1?'selected':''}>Approved</option>
                                <option  value="3"    ${v.product_status== 3?'selected':''}>Rejected</option>
                            </select>`;
                            }
                            if ((v.profile_image != '')) {
                                img_vendor =
                                    `<img src="<?= base_url()?>${v.profile_image}" height="50px"   class="imge_categoy">${v.v_name}`;
                            } else if ((v.profile_image == '')) {
                                img_vendor =
                                    `<img src="<?= base_url()?>assets/images/noimages.png"   height="50px"  class="imge_categoy">${v.v_name}`;
                            }
                            $(`#vendors_product`).append(`   
                     <tr>
                    <td>${i}</td>
                    <td>${img_vendor}</td>
                    <td>${v.product_name_english}(${v.product_name_hindi})</td>
                    <td>${v.category_name}</td>
                    <td>${v.sub_cat_name}</td>
                    <td>Rs.${v.mrp?v.mrp:'0'}/-</td>
                    <td>Rs.${v.selling_price?v.selling_price:'0'}/-</td>
                    <td>${btn_text}</td>
                    <td><a href="<?php echo base_url()?>admin/product_details/${v.product_id}/${v.v_id}" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                    </tr>`);
                        });
                        result_list_table = $(`[data-result_list_table]`).DataTable();
                    }
                });
            }
            getlist("", "");

        });
        </script>



        <script>
            
        $(document).on("change", '[data-status_input]', function() {
            if (!confirm("Are You Sure?|This action can not be undone. Do you ")) {
                return;
            }
            let obj = this;
            console.log(obj);
            $.ajax({
                type: "post",
                url: "<?= base_url()?>Product/change_productRequest_status",
                data: {
                    req_id: ($(obj).data('id')),
                    vendor_id: ($(obj).data('req_user_id')),
                    status: ($(obj).val())
                },
                dataType: "dataType",
                complete: function(response) {
                    if (JSON.parse(response.responseText).success) {
                        alert(JSON.parse(response.responseText).message);
                        location.reload();
                        if (["1", "0"].includes($(obj).val())) {
                            $(obj).prop("disabled", true)
                        }
                    } else {
                        alert(JSON.parse(response.responseText).message);
                    }
                }
            });

        });
        </script>



</body>

</html>