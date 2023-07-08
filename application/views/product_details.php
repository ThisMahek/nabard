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
                    <?= $this->session->flashdata('success');?>
                    <?= $this->session->flashdata('error');?>
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
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="product-detai-imgs">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-3 col-4">
                                                        <div class="nav flex-column nav-pills " id="v-pills-tab"
                                                            role="tablist" aria-orientation="vertical">
                                                            <?php foreach($images as $key => $row):?>
                                                            <a class="nav-link" id="product-1-tab" data-bs-toggle="pill"
                                                                href="#product-1" role="tab" aria-controls="product-1"
                                                                aria-selected="true">
                                                                <img data-thumb_image
                                                                    src="<?php echo base_url()?><?= $row?>" alt=""
                                                                    width="60px"
                                                                    class="img-fluid mx-auto d-block rounded"
                                                                    data-amount_btn="">
                                                            </a>
                                                            <?php endforeach;?>
                                                            <!--   <a class="nav-link" id="product-2-tab" data-bs-toggle="pill" href="#product-2" role="tab" aria-controls="product-2" aria-selected="false">
                                                            <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                        <a class="nav-link" id="product-3-tab" data-bs-toggle="pill" href="#product-3" role="tab" aria-controls="product-3" aria-selected="false">
                                                            <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a>
                                                        <a class="nav-link" id="product-4-tab" data-bs-toggle="pill" href="#product-4" role="tab" aria-controls="product-4" aria-selected="false">
                                                            <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block rounded">
                                                        </a> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                            <div class="tab-pane fade show active" id="product-1"
                                                                role="tabpanel" aria-labelledby="product-1-tab">


                                                                <div>
                                                                    <img data-big_image
                                                                        src="<?php echo base_url()?><?php echo $images[0]; ?> "
                                                                        data-image_value alt="" height="50px"
                                                                        width="300px" class="img-fluid mx-auto d-block">

                                                                </div>
                                                            </div>
                                                            <!-- <div class="tab-pane fade" id="product-2" role="tabpanel" aria-labelledby="product-2-tab">
                                                            <div>
                                                                <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block">
                                                            </div>
                                                        </div> -->
                                                            <!-- <div class="tab-pane fade" id="product-3" role="tabpanel" aria-labelledby="product-3-tab">
                                                            <div>
                                                                <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block">
                                                            </div>
                                                        </div> -->
                                                            <!--    <div class="tab-pane fade" id="product-4" role="tabpanel" aria-labelledby="product-4-tab">
                                                            <div>
                                                                <img src="<?php echo base_url()?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid mx-auto d-block">
                                                            </div> 
                                                            
                                                        </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php 
                            /*      echo "<pre>";
                                    print_r($vendor_product);
                                    exit;
                                     */
                                    
                                    ?>
                                        <div class="col-xl-6">
                                            <div class="mt-4 mt-xl-3">
                                                <a href="#"
                                                    class="text-primary">#<?= $vendor_product['product_id']?></a>
                                                <h4 class="mt-1 mb-3"><?=$vendor_product['product_name_english']?>
                                                    (<?=$vendor_product['product_name_hindi']?> )</h4>
                                                <!--         <p class="text-muted float-start me-3">
                                                <span class="bx bxs-star text-warning"></span>
                                                <span class="bx bxs-star text-warning"></span>
                                                <span class="bx bxs-star text-warning"></span>
                                                <span class="bx bxs-star text-warning"></span>
                                                <span class="bx bxs-star"></span>
                                            </p> -->
                                                <!-- <p class="text-muted mb-4">( 152 Customers Review )</p> -->
                                                <?php if($vendor_product['stock_status']==1):?>
                                                <h6 class="text-success text-uppercase">IN STOCK</h6>
                                                <?php else :?>
                                                <h6 class="text-danger text-uppercase">OUT OF STOCK</h6>
                                                <?php endif;?>


                                                <h5 class="mb-4">Price : <span class="text-muted me-2"><del>₹
                                                            <?= $vendor_product['mrp']?number_format($vendor_product['mrp'],2):0?></del></span>
                                                    <b>₹<?= $vendor_product['selling_price']?number_format($vendor_product['selling_price'],2):0?>
                                                    </b></h5>
                                                <p class="text-muted mb-4">Description :
                                                    &nbsp;<?= $vendor_product['description']?$vendor_product['description']:''?>
                                                </p>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <p class="text-muted"><b>Category :</b>
                                                                <?= $vendor_product['category_name']?></p>
                                                            <p class="text-muted"><b>Sub Category :</b>
                                                                <?= $vendor_product['sub_cat_name']?></p>
                                                            <p class="text-muted"><b>Available Stock
                                                                    :</b><?= $vendor_product['availabe_stock']?$vendor_product['availabe_stock']:'0'?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div>
                                                            <p class="text-muted"><b>Qty :</b>
                                                                <?= $vendor_product['quantity']?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php if(!empty($vendor_product['product_ver_doc'])):?>
                                                        <a class="btn btn-primary mb-2"
                                                            href="<?= base_url()?><?= $vendor_product['product_ver_doc']?>"
                                                            target="_blank">Verification Document</a>
                                                            <?php endif;?>
                                                        <a class="btn btn-danger mb-2"
                                                            href="<?= base_url()?>Admin/product_request"
                                                            target="_blank">Back</a>
                                                    </div>
                                                </div>

                                               <!--   <div class="col-md-6">
                                                    <div>
                                                        <p class="text-muted"><b>Qty :</b> <?= $vendor_product['quantity']?></p>
                                                    </div>
                                                </div> -->
                                             
                                            </div>
                                               <div class="row mb-2" >
                                                    <h5 class="mb-2">Vendor Details</h5>
                                                    <div class="col-md-4 col-6 mb-2">
                                                        <div>
                    
                                                        <?php if(!empty($vendor_product['profile_image'])):?>
                                                            <img src="<?= base_url()?><?= $vendor_product['profile_image']?>" class="w-50">      
                                                        <?php else:?>
                                                         <img src="<?= base_url()?>assets/images/noimages.png" class="w-50">
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-8 col-6">
                                                        <div>
                                                             <p class="text-muted">Vendor Name:&nbsp;<b><?= $vendor_product['v_name']?$vendor_product['v_name']:'--'?></b></p>
                                                            <p class="text-muted">Vendor Email: &nbsp;<b><?= $vendor_product['v_email']?$vendor_product['v_email']:'--'?></b></p>
                                                            <p class="text-muted">Vendor Office address: &nbsp;<b><?= $vendor_product['office_address']?$vendor_product['office_address']:'--'?></b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--shop details section-->
                                                <div class="vendor-shop-details mb-2">
                                                    <div class="row">
                                                        <div class="col-md-8 col-9"><h5 class="mb-2">Vendor Shop Details</h5></div>
                                                        <div class="col-md-4 col-3">
                                                            <a class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#edit_shop_modal" style="float:right"><i class="fa fa-edit"></i></a>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <span class="shop-option">Shop Name</span> :
                                                            <span class="shop-value"><?= $vendor_shop['name']?$vendor_shop['name']:'--'?></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Mobile No</span> :
                                                            <span class="shop-value"><a href="tel:+ 9999999999"><?= $vendor_shop['mobile']?$vendor_shop['mobile']:'--'?> </a></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Email</span> :
                                                            <span class="shop-value"><a href="mailto:vendor@gmail.com"><?= $vendor_shop['email']?$vendor_shop['email']:'--'?></a></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">District </span> :
                                                            <span class="shop-value"><?= $vendor_shop['district']?$vendor_shop['district']:'--'?></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Tehsil </span> :
                                                            <span class="shop-value"><?= $vendor_shop['tehsil']? $vendor_shop['tehsil']:'--'?></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Village</span> :
                                                            <span class="shop-value"><?= $vendor_shop['village']?$vendor_shop['village']:'--'?></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Block</span> :
                                                            <span class="shop-value"><?= $vendor_shop['block']?$vendor_shop['block']:'--'?></span> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span class="shop-option">Pincode</span> :
<!--<<<<<<< HEAD-->
<!--                                                            <span class="shop-value">284124</span>

                                                <!--<div class="row mb-3">-->
                                                <!--    <h4 class="mb-4">Vendor Details</h4>-->
                                                <!--    <div class="col-md-4 col-6 mb-2">-->
                                                <!--        <div>-->

                                                <!--            <?php if(!empty($vendor_product['profile_image'])):?>-->
                                                <!--            <img src="<?= base_url()?><?= $vendor_product['profile_image']?>"-->
                                                <!--                class="w-50">-->
                                                <!--            <?php else:?>-->
                                                <!--            <img src="<?= base_url()?>assets/images/noimages.png"-->
                                                <!--                class="w-50">-->
                                                <!--            <?php endif;?>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--    <div class="col-md-8 col-6">-->
                                                <!--        <div>-->
                                                <!--            <p class="text-muted">Vendor-->
                                                <!--                Name:&nbsp;<b><?= $vendor_product['v_name']?$vendor_product['v_name']:'--'?></b>-->
                                                <!--            </p>-->
                                                <!--            <p class="text-muted">Vendor Email:-->
                                                <!--                &nbsp;<b><?= $vendor_product['v_email']?$vendor_product['v_email']:'--'?></b>-->
                                                <!--            </p>-->
                                                <!--            <p class="text-muted">Vendor Office address:-->
                                                <!--                &nbsp;<b><?= $vendor_product['office_address']?$vendor_product['office_address']:'--'?></b>-->
                                                <!--            </p>-->

                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
<!--=======-->
                                                            <span class="shop-value"><?= $vendor_shop['pincode']? $vendor_shop['pincode']:'--'?></span> 
                                                        <!-- </div> -->
                           

                                                 <!--edit shop details modal-->
                                                   <div class="modal fade" id="edit_shop_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Vendor Shop Details</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                          </div>
                                                          <form action ="<?= base_url()?>product/update_shopdetails"  data-on_submit method="post">
                                                          <div class="modal-body">

                                                            <input type ="hidden" name="vendor_id" value="<?= $vendor_product['vendor_id']?>"  >
                                                             <label class="mb-2">Shop Name</label>
                                                             <input type="text"  data-check_input_field class="form-control mb-2"    oninput=" return FullnameValidation(this.value,'title_span_name','submit')" name="name" value="<?= $vendor_shop['name']?>" required>
                                                               <div><span  id="title_span_name" data-message></span></div>
                                                             <label class="mb-2">Mobile No</label>
                                                             <input type="text" data-check_input_field class="form-control mb-2" name="mobile" value="<?= $vendor_shop['mobile']?>"  maxlength="10" oninput="check_phone(this.value,'title_span_mobile','submit') "
                                                             onkeypress="return isNumber(event)" required>
                                                             <div><span   id="title_span_mobile" data-message></span></div>
                                                             <label class="mb-2">Email id</label>
                                                             <input type="email" data-check_input_field class="form-control mb-2" name="email" value="<?= $vendor_shop['email']?>"    oninput=" return check_email(this.value,'title_span_email','submit')" required>
                                                             <div><span   id="title_span_email" data-message></span></div>
                                                             <label class="mb-2">Distric</label>
                                                             <input type="text"  data-check_input_field class="form-control mb-2" name="district" value="<?= $vendor_shop['district']?>"  oninput=" return FullnameValidation(this.value,'title_span_district','submit')" name="name" value="<?= $vendor_shop['name']?>" required>
                                                             <div><span     id="title_span_district" data-message></span></div>
                                                             <label class="mb-2">Tehsil</label>
                                                             <input type="text" data-check_input_field class="form-control mb-2" name="tehsil" value="<?= $vendor_shop['tehsil']?>"  oninput=" return FullnameValidation(this.value,'title_span_tehsil','submit')" required>
                                                            
                                                             <div><span   id="title_span_tehsil"data-message></span></div>
                                                              <label class="mb-2">Village</label>
                                                             <input type="text" data-check_input_field class="form-control mb-2" name="village" value="<?= $vendor_shop['village']?>"  oninput=" return FullnameValidation(this.value,'title_span_village','submit')" required>
                                                             <div><span   id="title_span_village"data-message></span></div>
                                                             <label class="mb-2">Block</label>
                                                             <input type="text" data-check_input_field class="form-control mb-2" name="block" value="<?= $vendor_shop['block']?>"  oninput=" return FullnameValidation(this.value,'title_span_block','submit')" required >
                                                             <div><span   id="title_span_block" data-message></span></div>
                                                             <label class="mb-2">Pincode</label>
                                                             <input  required type="text" data-check_input_field  maxlength="6" class="form-control mb-2" name="pincode" value="<?= $vendor_shop['pincode']?>"oninput="PincodeValidation(this.value,'title_span_pincode','submit')"  onkeypress="return isNumber(event)" >
                                                             <div><span    id="title_span_pincode"data-message></span></div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"    id="submit" class="btn btn-primary">Update</button>
                                                          
                                                          </div>
                                                        </form>
                                                        <!--   <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div> -->
                                                        </div>
                                                      </div>
                                                    </div>
                                                 <!--edit shop details modal-->
                                              <!--shop details section-->
                                              <!--  <div class="row">
                                                      <div class="col-md-12">
                                                            <a class="btn btn-primary mb-2" href="<?= base_url()?><?= $vendor_product['product_ver_doc']?>" target="_blank">Verification Document</a>
                                                            <a class="btn btn-danger mb-2" href="<?= base_url()?>Admin/product_request" target="_blank">Back</a>
                                                    </div>
                                               </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <h4 class="card-title title_head">Product Varient</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body overy">
                                <table id=""
                                    class="table table-bordered dt-responsive table-responsive nowrap w-100 mobile-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>MRP</th>
                                            <th>Price</th>
                                            <th>Verification Documents</th>
                                            <th>Stock Management</th>
                                            <th>Availability Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
  <!-- <tr>
<td>1</td>
<td><img src="https://design.anshuwap.com/nabard/assets/images/users/avatar-1.jpg" class="imge_categoy"></td>
<td>Seeds</td>
<td>Rs 230</td>
<td>Available</td>
</tr> -->
                                        <?php if(!empty($product_varient)):?>
                                        <?php
$i = 0; foreach ($product_varient as $product_var):
$i++;?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <?php
$images = explode(",", $product_var['varient_images']);
?>
                                            <td>
                                                <?php foreach($images as $row):?>
                                                <img src="<?= base_url() ?><?=$row?> " class="imge_categoy">
                                                <?php endforeach ;?>
                                            </td>
                                            <td><?= $product_var['product_name_english'] ?>(<?=$product_var['product_name_hindi'] ?>)
                                            </td>
                                            <td>Rs <?= $product_var['mrp'] ?> </td>
                                            <td>Rs <?= $product_var['price'] ?> </td>

                                            <?php  if(!empty($product_var['varient_ver_doc'])):?>
                                            <td> <a class="btn btn-primary mb-2"
                                                    href="<?= base_url()?><?= $product_var['varient_ver_doc']?>"
                                                    target="_blank">View</a></td>
                                            <?php else:?>
                                            <td>--</td>
                                            <?php endif;?>
                                            <?php if($product_var['stock_status']==1):?>
                                            <td>In stock</td>
                                            <?php elseif($product_var['stock_status']==0):?>
                                            <td> Out of stock</td>
                                            <?php endif;?>
                                            <td><?= $product_var['availabe_stock']?></td>
                                        </tr>

                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END layout-wrapper -->
                <?php include('includes/footer.php')?>
                <script>
                $(document).ready(function() {
                    $("[data-amount_btn]").click(function(e) {
                        e.preventDefault();
                        let image = $(this).attr('src');
                        $("[data-image_value]").attr("src", image);

                    });
                    $(`[data-thumb_image]`).click(function(e) {
                        e.preventDefault();
                        $(`[data-big_image]`).attr('href', $(this).attr('href'))

                    });

                });
                </script>









<script>
        $(`[data-on_submit]`).submit(function() {
            // e.preventDefault();
            let id = '';
            let denote_div = $(this);
            let return_msg = true;
            let check_name = $(this).find("[data-check_input_field]input[name='name']").val();
            let check_email = $(this).find("[data-check_input_field]input[name='email']").val();
            let check_mobile = $(this).find("[data-check_input_field]input[name='mobile']").val();
            let check_district = $(this).find("[data-check_input_field]input[name='district']").val();
            let check_tehsil = $(this).find("[data-check_input_field]input[name='tehsil']").val();
            let check_block = $(this).find("[data-check_input_field]input[name='block']").val();
            let check_village = $(this).find("[data-check_input_field]input[name='village']").val();
            let check_pincode = $(this).find("[data-check_input_field]input[name='pincode']").val();
            // let check_image = $(this).find("[data-check_input_field]input[name='image']").val();
            let reg_name = /^[a-zA-Z\s]*$/;
            let reg_email = /\S+@\S+\.\S+/;
            let reg_mobile = /^[6789]{1}[0-9]{9}$/;
            let reg_pincode = /^[123456789]{1}[0-9]{5}$/;
            let modal = $(this).closest(`.modal`);

            // let modal = $(this).closest(`.modal`);
        
            if (!reg_name.test(check_name)) {
                    $(this).find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html(
                        "<span style='color:red'>Please enter valid shop name</span>");
                return false;
                }
                if (!reg_mobile.test(check_mobile)) {
                    modal.find("[data-check_input_field]input[name='mobile']").siblings("[data-message]").html(
                        "<span style='color:red'>Please valid mobile number.</span>"
                    );
                    return false;
                }
            if (!reg_email.test(check_email)) {
                modal.find("[data-check_input_field]input[name ='email']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid Name</span>");
                return false;
            }
            if (!reg_name.test(check_district)) {
                modal.find("[data-check_input_field]input[name='district']").siblings("[data-message]")
                    .html("<span style='color:red'>Please enter valid district name</span>");
                return false;
            }

            if (!reg_name.test(check_tehsil)) {
                modal.find("[data-check_input_field]input[name='tehsil']").siblings("[data-message]")
                    .html("<span style='color:red'>Please enter valid tehsil name</span>");
                return false;
            }
            if (!reg_name.test(check_village)) {
                modal.find("[data-check_input_field]input[name='village']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid village name</span>");
                return false;
            }
            if (!reg_name.test(check_block)) {
                modal.find("[data-check_input_field]input[name='block']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid block name</span>");
                return false;
            }
            if (!reg_pincode.test(check_pincode)) {
                modal.find("[data-check_input_field]input[name='pincode']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid block name</span>");
                return false;
            }
          /*   if (reg_email.test(check_email)) {

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
                        return_msg = success;
                        if (success== false) {     
                            denote_div.find("[data-check_input_field]input[name ='email']")
                                .siblings("[data-message]").html("<span style='color:red'>" + JSON
                                    .parse(response.responseText).message + "</span>");
                          return return_msg;
                        }

                    }
                });

            } */
          /*   if (!reg_mobile.test(check_mobile)) {
                $(this).find("[data-check_input_field]input[name='mobile']").siblings("[data-message]").html(
                    "<span style='color:red'>Please enter valid Mobile</span>");
                return false;
            } */
        /*     if (reg_mobile.test(check_mobile)) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>vendor/check_team_phone_number_exits",
                    data: {
                        phone: check_mobile,
                        submit: 'submit',
                        id: id,
                    },
                    dataType: "dataType",
                    complete: function(response) {
                        let success = JSON.parse(response.responseText).success;
                        x = success;
                        if (success) {
                            denote_div.find("[data-check_input_field]input[name='mobile']")
                                .siblings("[data-message]").html("<span style='color:red'>" + JSON
                                    .parse(response.responseText).message + "</span>");
                                 return false;
                        }
                    }
                });
            } */
        });
        $(this).submit();
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
        /*   else if(phone.length == 10){
                    $("#" + msg).html("");
                    $("#" + btn).attr('disabled', true);
              $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>vendor/check_team_phone_number_exits",
                        data: {
                        phone:phone,
                        submit : 'submit',
                        id : id,
                        },
                        dataType: "dataType",
                        complete: function (response) {
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
                }  */

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