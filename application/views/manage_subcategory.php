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
                                             <li class="breadcrumb-item" style="color:green;font-weight:600;"><?php echo $error=$this->session->flashdata('success'); ?>
                                            
                                             <?php echo $error=$this->session->flashdata('error'); ?>
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
                                           <h4 class="card-title title_head">Manage Sub Category</h4>
                                           </div>
                                            <div class="col-md-6 col-6">
                                                <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#myModal">+Add</button>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
        
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Sub Category Name</th>
                                                <th>Sub Category Name(Hindi)</th>
                                                <th>Parent/Category</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php
                                                $i=1;
                                                foreach($category as $catt)
                                                {
                                                    $eid=$catt['parent_id'];
                                                ?>
                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?= ucwords($catt['sub_name']);?></td>
                                                <td><?= $catt['sub_hindi'];?></td>
                                                <td><?= $catt['c_name'];?>(<?= $catt['ch_name'];?>)</td>
                                                <td><img src="<?php echo base_url('/'.$catt['sub_image'])?>" class="imge_categoy"></td>
                                                <td>
                                                    <?php
                                                    if($catt['sub_status'] =='1')
                                                    {
                                                        echo "<b style='color:green;'>Active</b>";
                                                    }
                                                    if($catt['sub_status'] =='0')
                                                    {
                                                      echo "<b style='color:red;'>Inactive</b>";
                                                    }
                                                     ?>
                                                    
                                                    </td>
                                                <td>
                                     <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#editcat<?= $catt['sub_id'];?>"><i class="fa fa-edit"></i></button>
                                                
                                              
                                            <!--------------------------------------------Update Modal  ---------------------------->
  
                
  <div id="editcat<?= $catt['sub_id'];?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Sub Category</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <!---  <form id="pristine-valid-example"  novalidate method="post"> --->
                                    <?php 
                                    // form_open_multipart("Category/Edit_subcategory_db/{$catt['sub_id']}",'id="pristine-valid-example"',"onSubmit='disableFunction()'");
                                    ?>
                                              
                                    <form action="<?= base_url()?>category/Edit_subcategory_db/<?= $catt['sub_id']?>" id="pristine-valid-example" method="post" data-on_submit enctype="multipart/form-data">
                                    <div class="row">

                                                 <div class="form-group mb-3">
                                                                <label class="form-label">Select Parent Category</label>
                                                                <select name="parent_id"  required class="form-control form-select fom_select"  >
                                                                <option value="">Select Parent Category</option> 
                                                                <?php
                                                                foreach($par_cat as $cpt)
                                                                {
                                                                    ?>
                                                                   
                                                                  <option value="<?= $cpt['id']?>" <?= ($cpt['id'] == $catt['p_id'])?'selected':''?>><?= $cpt['name']?></option>

                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                                </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Subcategory Name</label>
                                                            <input type="text"  data-check_input_field name="name" required placeholder="Enter Category Name" value="<?= ucwords($catt['sub_name']);?>" class="form-control form_control" oninput="FullnameValidation(this.value,'category_name_span<?= $catt['sub_id']?>','submit<?= $catt['sub_id']?>')"  />
                                                       <span data-message  id="category_name_span<?= $catt['sub_id']?>"></span>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <img src="<?= base_url('/'.$catt['sub_image']);?>" width="50px">
                                                          <input  data-check_input_field class="form-control form-control-lg fom_select" name="image" id="image<?= $catt['id']?>"  oninput="check_file(this.value,'sp_image3<?= $catt['sub_id']?>','submit<?= $catt['sub_id']?>')"
                                                          type="file" accept=".jpg, .jpeg, .png">
                                                        <span  id="sp_image3<?= $catt['sub_id']?>" data-message></span>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Subcategory Name(Hindi)</label>
                                                            <input type="text" name="name_hindi" value="<?= ucwords($catt['sub_hindi']);?>" required placeholder="Enter Category Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       
                                                    <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <?php
                                                            if($catt['sub_status'] =='1')
                                                            {
                                                            ?>
                                                            <option value="1">Active</option>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                               ?>
                                                            <option value="0">Inactive</option>
                                                            <?php   
                                                            }
                                                            ?>
                                                            
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                           
                                            <button type="submit"  id="submit<?= $catt['sub_id']?>" class="btn btn-primary waves-effect waves-light common_btn">Update  Sub Category</button>

                                                <!-- end row -->
                                                        </form>
                                        </div>

                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                     </div>
                                </div>
                            </div>
                        </div>
               
                
   <!--------------------------------------------End Edit Modal  ---------------------------->
     
                                                </td>

                                            </tr>
                                                <?php
                                                }
                                                ?>
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
                                                            <h5 class="modal-title" id="myModalLabel">Add Sub Category</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <!---  <form id="pristine-valid-example"  novalidate method="post"> --->
<form action="<?= base_url()?>category/Add_subcategory_db"  method="post" enctype="multipart/form-data"    id="pristine-valid-example"   data-on_submit>
                               
                                                                <div class="row">
                                                                <div class="form-group mb-3">
                                                                <label class="form-label">Select Parent Category</label>
                                                                <select name="parent_id"  required class="form-control form-select fom_select"  >
                                                                <option value="">Select Parent Category</option> 
                                                                <?php
                                                                foreach($par_cat as $cpt)
                                                                {
                                                                    ?>
                                                                  <option value="<?= $cpt['id'];?>"><?php echo $cpt['name'];?></option>   
                                                                <?php
                                                                }
                                                                ?>
                                                                </select>
                                                                </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Sub Category Name</label>
                                                            <input type="text" data-check_input_field  name="name"  id="category" required placeholder="Enter Category Name" class="form-control form_control"   oninput="FullnameValidation(this.value,'category_name_span','submit')" />
                                                            <span id="category_name_span"   data-message class="font-weight-bold" style=" margin-left:4%; margin-bottom:3%  ;color:red";></span>
                                                        </div>   
                                                    </div>

                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" data-check_input_field name="image" id="image" required
                                                          type="file" accept=".jpg, .jpeg, .png"  oninput="check_file(this.value,'sp_image3','submit')"  >
                                                          <span id="sp_image3"  data-message style=" margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                        
                                                    </div>

                                                
                                                     <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Sub Category Name(Hindi)</label>
                                                            <input type="text" name="name_hindi" required placeholder="Enter Category Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                          
                                                  
                                                    <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <button type="submit" id="submit"   class="btn btn-primary waves-effect waves-light common_btn">Add</button>
                                                <!-- end row -->
                                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>                
                
   <!--------------------------------------------End Add Modal  ---------------------------->  
   
     <!---
<a href="<?= base_url('Category/Delete_cat/'.$eid); ?>">
<button type="button" class="btn btn-danger btn-sm" title="Delete" hidden><i class="fa fa-trash"></i></button></a>
--->
    
         <?php include('includes/footer.php')?>         

    </body>
</html>


<script>
                $(`[data-on_submit]`).submit(function()
                {

                let  check_name = $(this).find("[data-check_input_field]input[name='name']").val();
                let  check_image = $(this).find("[data-check_input_field]input[name='image']").val();
                let  reg_name = /^[a-zA-Z\s]*$/;
                var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                if (!reg_name.test(check_name)) {
                    $(this).find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html("<span style='color:red'>Please enter valid name</span>");
                return false; 
                } 
                if(check_image=='') {
                return true; 
                }
                else if (!allowedExtensions.test(check_image)) {
                $(this).find("[data-check_input_field]input[name='image']").siblings("[data-message]").html("<span style='color:red'>Please upload file having extensions .jpeg, .png, .jpeg only.</span>");
                return false; 
                } 
                this.submit();
                });
                </script>
<script>
 /*   function preview()
       {
     var image =$('#image').val();
     var category =$('#category').val();
     if(category == ''){
        
        document.getElementById('category_name_span').innerHTML= '\n Please enter valid category name';
        return false;
     }
    else if(image == ''){
        document.getElementById('sp_image3').innerHTML= '\n Please upload file';
        return false;
     }else{
        $('#sp_image3').empty(); 
     }         
    	} */
  	</script>

<script>
function check_file(image,msg,btn){

var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
    if(!allowedExtensions.exec(image)){
$("#"+msg).html("<span style='color:red'>Please upload file having extensions .jpg ,.png ,.jpeg only.</span>");
$("#"+btn).attr('disabled', true);
        return false;
    }else if(image != '')
    {
        $("#"+msg).empty();
        $("#"+btn).attr('disabled', false);
    }else{
    if (image.files && image.files[0]) {
        let name=image.files[0].name;
        document.getElementById("sp_image3").innerHTML=name;
    var reader = new FileReader();
    reader.onload = function (e){
        $('.image')
            .attr('src', e.target.result)
            .width(110)
            .height(70);
            
            $("#"+msg).empty();
                    $("#"+btn).attr('disabled', false);
    };
    reader.readAsDataURL(image.files[0]);
}

}
}
</script>
  	