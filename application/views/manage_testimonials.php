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
                                         <li class="breadcrumb-item" style="color:green;font-weight:600;">
                                             <?php echo $error=$this->session->flashdata('error'); ?>
                                            
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
                                           <h4 class="card-title title_head">Manage Testimonials</h4>
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
                                                    <th>sr.No</th>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                $i=1;
                                                foreach($testimonial as $test)
                                                {
                                                ?>
                                                <tr>
                                                    <td><?= $i++;?></td>
                                                    <td><?= $test['name'];?></td>
                                                   <?php   if (($test['image']!='')) :  ?> 
                                                    <td><img src="<?= base_url('/'.$test['image'])?>" 
                                                class="imge_categoy"></td>
                                                    <?php else :?>
                                                    <td><img src="<?= base_url()?>assets/images/noimages.png?>" class="imge_categoy"></td>
                                                    <?php endif;?>

                                                    <td><?= $test['description'];?></td>
                                                    <td>
                                                  <?php
                                                    if($test['status'] =='1')
                                                    {
                                                        echo "<b style='color:green;'>Active</b>";
                                                    }
                                                    else
                                                    {
                                                      echo "<b style='color:red;'>Inactive</b>";
                                                    }
                                                     ?>
                                                    </td>
                                                    <td><button type="button" class="btn btn-success btn-sm waves-effect waves-light"  
                                                    data-bs-toggle="modal" data-bs-target="#editModal<?= $test['id']?>"><i class="fa fa-edit"></i></button>
                                                 
                                                 
     <!--------------------------------------------Update Modal  ---------------------------->
  
                
<div id="editModal<?= $test['id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update Testimonials</h5>
                <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
              
                   <div class="card-body">
                    <div>
                                          <?= form_open_multipart("Master/Edit_testimonial_db/{$test['id']}",'id="pristine-valid-example"');?>
                             <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?= $test['name'];?>"    required placeholder="Enter Your Name" class="form-control form_control"  oninput="FullnameValidation(this.value,'span_name_edit','submit_edit')"/>
                                    <span  id="span_name_edit"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                     <div class="form-group mb-3">
                                      <label for="formFileLg" class="form-label">Upload Image</label>
                                      <?php if(!empty($test['image'])):?>
                                      <img src="<?= base_url('/'.$test['image']); ?>" width="40px">
                                         <?php else:?>
                                      <img src="<?= base_url()?>assets/images/noimages.png?>" class="imge_categoy">
                                        <?php endif;?>
                                      <input class="form-control form-control-lg fom_select" name="image" id="formFileLg"  accept=".jpg, .jpeg, .png"  oninput= "return  check_file_edit(this.value)" type="file" accept="image/*">
                                      <span id="sp_image3_edit"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Description</label>   
                                        <textarea type="text" name="description" required placeholder="Enter Description" 
                                        class="form-control form_control"><?= $test['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                      <label>Status</label>
                                            <select class="form-select form_control" required name="status">
                                                  <?php
                                                            if($test['status'] =='1')
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
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                                    <button type="submit"  id="submit_edit" class="btn btn-primary btn-sm waves-effect waves-light common_btn">Update</button>

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
                                                   <a href="<?= base_url('Master/Delete_testimonial/'.$test['id']); ?>">
                                                <button type="button" onclick="isconfirm()" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></button>
                                                    </a>
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
                <h5 class="modal-title" id="myModalLabel">Add Testimonials</h5>
                <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div>
                                          <?= form_open_multipart('Master/Add_testimonial_db','id="pristine-valid-example"');?>
                             <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text"   name="name" required placeholder="Enter Your Name" class="form-control form_control"  oninput="FullnameValidation(this.value,'name_span','submit')"  required/>
                                    <span id="name_span"  style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                     <div class="form-group mb-3">
                                      <label for="formFileLg" class="form-label">Upload Image</label>
                                      <input class="form-control form-control-lg fom_select"  oninput=" return check_file(this.value)" name="image" id="formFileLg" type="file"  required accept=".jpg, .jpeg, .png">
                                    <span id="sp_image3"  ></span>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Description</label>   
                                        <textarea type="text" name="description" required placeholder="Enter Description" required class="form-control form_control"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <div class="form-group mb-3">
                                      <label>Status</label>
                                            <select class="form-select form_control" required name="status">
                                                <option value='1'>Active</option>
                                                <option value='0'>Inactive</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"  id="submit" class="btn btn-primary btn-sm waves-effect waves-light common_btn">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>                
                
   <!--------------------------------------------End Add Modal  ---------------------------->  
   
     <script>
   
         
function isconfirm(){

if(!confirm('Are you sure Delete it?')){
event.preventDefault();
return;
}
return true;
}

   </script>





<script>
function check_file(image){

var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
    if(!allowedExtensions.exec(image)){
document.getElementById('sp_image3').innerHTML= '\n Please upload file having extensions .jpeg, .png, .jpeg only.';
    document.getElementById("sp_image3").style.color="red";
        document.getElementById("submit").disabled=true;
        return false;
    }else if(image != '')
    {
        $('#sp_image3').empty();
        document.getElementById("submit").disabled=false;
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
            document.getElementById('sp_msg').innerHTML=" ";
                    document.getElementById("sp_image3").innerHTML="";
                document.getElementById("submit").disabled=false;
    };
    reader.readAsDataURL(image.files[0]);
}

}
}
</script>





<script>
function check_file_edit(image){

var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
    if(!allowedExtensions.exec(image)){
document.getElementById('sp_image3_edit').innerHTML= '\n Please upload file having extensions .jpeg, .png, .jpeg only.';
    document.getElementById("sp_image3_edit").style.color="red";
        document.getElementById("submit_edit").disabled=true;
        return false;
    }else if(image != '')
    {
        $('#sp_image3_edit').empty();
        document.getElementById("submit_dit").disabled=false;
    }else{
    
    if (image.files && image.files[0]) {
        let name=image.files[0].name;
        document.getElementById("sp_image3_edit").innerHTML=name;
    var reader = new FileReader();
    reader.onload = function (e){
        $('.image')
            .attr('src', e.target.result)
            .width(110)
            .height(70);
            document.getElementById('sp_msg').innerHTML=" ";
                    document.getElementById("sp_image3_edit").innerHTML="";
                document.getElementById("submit_edit").disabled=false;
    };
    reader.readAsDataURL(image.files[0]);
}

}
}
</script>
         <?php include('includes/footer.php')?>         

    </body>
</html>