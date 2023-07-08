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
                                             <li class="breadcrumb-item" ><?php echo $error=$this->session->flashdata('error'); ?>
                                            
                                             <?php echo $error=$this->session->flashdata('success'); ?>
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
                                           <h4 class="card-title title_head">Manage Category</h4>
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
                                                <th>Category Name</th>
                                                <th>Category Name(Hindi)</th>
                                                <!-- <th>Parent/Category</th> -->
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
                                                <td><?= ucwords($catt['name']);?></td>
                                                <td><?= $catt['name_hindi'];?></td>
                                             <!--    <td>
                                                    <?php
                                                    if($catt['parent_id'] !='')
                                                    {
                                                    foreach($par_cat as $cat)
                                                    {
                                                         if($cat['id'] == $eid)
                                                        {
                                                       echo $cat['name'].'('.$cat['name_hindi'].')';   
                                                        }
                                                    }
                                                    }
                                                    else
                                                    {
                                                        echo '--';
                                                    }
                                                    
                                                    ?>
                                                    
                                                    </td> -->
                                                <td><img src="<?php echo base_url('/'.$catt['image'])?>" class="imge_categoy"></td>
                                                <td>
                                                    <?php
                                                    if($catt['status'] =='1')
                                                    {
                                                        echo "<b style='color:green;'>Active</b>";
                                                    }
                                                    else
                                                    {
                                                      echo "<b style='color:red;'>Inactive</b>";
                                                    }
                                                     ?>
                                                    
                                                    </td>
                                                <td>
                                     <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#editcat<?= $catt['id'];?>"><i class="fa fa-edit"></i></button>
                                                
                                              
                                            <!--------------------------------------------Update Modal  ---------------------------->
  
                
  <div id="editcat<?= $catt['id'];?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Category</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <!---  <form id="pristine-valid-example"  novalidate method="post"> --->
                                           
                                    <form action ="<?= base_url()?>Category/Edit_category_db/<?=$catt['id']?>" method="post" data-on_submit id=
                                    "pristine-valid-example"  enctype="multipart/form-data">
                                    
                                    <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Category Name</label>
                                                            <input type="text" name="name" data-check_input_field  required placeholder="Enter Category Name" value="<?= ucwords($catt['name']);?>" class="form-control form_control"  oninput="FullnameValidation(this.value,'category_name_span_edit<?=$catt['id']?>','submit_edit<?=$catt['id']?>')" />
                                                       <span id="category_name_span_edit<?=$catt['id']?>"  data-message></span>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <img src="<?= base_url('/'.$catt['image']);?>" width="50px">
                                                          <input class="form-control form-control-lg fom_select" name="image" id="image<?= $catt['id']?>" 
                                                          type="file" accept="image/*" data-check_input_field  oninput="check_file(this.value,'sp_image3_edit<?=$catt['id']?>','submit_edit<?=$catt['id']?>')"   >
                                                        
                                                          <span id="sp_image3_edit<?=$catt['id']?>" data-message style=" margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                    </div>
                                                     <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Category Name(Hindi)</label>
                                                            <input type="text" name="name_hindi" value="<?= ucwords($catt['name_hindi']);?>" required placeholder="Enter Category Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       
                                                    <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <?php
                                                            if($catt['status'] =='1')
                                                            {
                                                            ?>
                                                            <option value="1">Active</option>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                               ?>
                                                            <option value="2">Inactive</option>
                                                            <?php   
                                                            }
                                                            ?>
                                                            
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                           
                                            <button type="submit" id="submit_edit<?=$catt['id']?>"class="btn btn-primary waves-effect waves-light common_btn">Update Category</button>

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
                                                            <h5 class="modal-title" id="myModalLabel">Add Category</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <!---  <form id="pristine-valid-example"  novalidate method="post"> --->

                                    <form action ="<?= base_url()?>Category/Add_category_db" method="post" enctype="multipart/form-data" id="pristine-valid-example"  data-on_submit>

                                  
                                                 <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Category Name</label>
                                                            <input type="text" name="name" data-check_input_field id="category" required placeholder="Enter Category Name" class="form-control form_control"   oninput="FullnameValidation(this.value,'category_name_span','submit')" />
                                                            <span id="category_name_span" data-message  class="font-weight-bold" style=" margin-left:4%; margin-bottom:3%  ;color:red";></span>
                                                        </div>

                                                      
                                                    </div>
                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" name="image" id="image" 
                                                          type="file" accept="image/*" data-check_input_field oninput="check_file(this.value,'sp_image3','submit')"  required>
                                                          <span id="sp_image3" data-message style=" margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                        
                                                    </div>

                                                
                                                     <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Category Name(Hindi)</label>
                                                            <input type="text" name="name_hindi" required placeholder="Enter Category Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                         <!--    <div class="form-group mb-3">
                                                                <label class="form-label">Select Parent Category</label>
                                                                <select name="parent_id" class="form-control form-select fom_select"  >
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
                                                                </div> -->
                                                  
                                                    <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <button type="submit" id="submit"   onclick=" return preview()"class="btn btn-primary waves-effect waves-light common_btn">Add</button>
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

                    // alert(';hsjhsdfj');s
                let  check_name = $(this).find("[data-check_input_field]input[name='name']").val();
                let  check_image = $(this).find("[data-check_input_field]input[name='image']").val();
                let  reg_name = /^[a-zA-Z\s]*$/;
                var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                if (!reg_name.test(check_name)) {
                    $(this).find("[data-check_input_field]input[name ='name']").siblings("[data-message]").html("<span style='color:red'>Please enter valid Title</span>");
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
 function preview()
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
    	}
  	</script>


<script>

function check_file(image,msg,btn){

    var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
        if(!allowedExtensions.exec(image)){
    // document.getElementById('sp_image3').innerHTML= '\n Please upload file having extensions  .png, .jpeg only.';
       
    $("#"+msg).html("<span style='color:red'>Please upload file having extensions .jpg ,.png ,.jpeg only.</span>");
    /*  document.getElementById("sp_image3").style.color="red"; */
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
  	