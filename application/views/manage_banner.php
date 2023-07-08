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
                                           <h4 class="card-title title_head">Manage Banner</h4>
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
                                                <th>Title</th>
                                                <th>Url</th>
                                                <th>Image</th>
                                                <th>Share To</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                foreach($banner as $slid)
                                                {
                                                ?>
                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?= $slid['title'];?></td>
                                                <td><?= $slid['url'];?></td>
                                                <td><img src="<?php echo base_url('/'.$slid['image'])?>" class="imge_categoy"></td>
                                                <td> <?php
                                                            if($slid['share_status'] =='1')
                                                            {
                                                            ?>
                                                            <span>All</span>
                                                            <?php
                                                            }
                                                            elseif($slid['share_status'] =='2')
                                                            {
                                                            ?>
                                                            <span>User</span>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                               ?>
                                                            <span>Vendor</span>
                                                            <?php   
                                                            }
                                                            ?></td>
                                                <td>
                                                  <?php
                                                    if($slid['status'] =='1')
                                                    {
                                                        echo "<b style='color:green;'>Active</b>";
                                                    }
                                                    else
                                                    {
                                                      echo "<b style='color:red;'>Inactive</b>";
                                                    }
                                                     ?>
                                                    </td>
                                                <td><button type="button" class="btn btn-success waves-effect waves-light btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#editcat<?= $slid['id'] ?>"><i class="fa fa-edit"></i>
                                                </button>
                                                
                                            
     <!--------------------------------------------Update Modal  ---------------------------->
  
                
  <div id="editcat<?= $slid['id'] ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Banner</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                              <div class="card-body">
                                        <div>
                                                 
                                                     <form action ="<?= base_url()?>Master/Edit_slider_db/<?=$slid['id']?>" id="pristine-valid-example" data-on_submit method="post" enctype="multipart/form-data">
                                                 <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <input type="text" pattern="[A-Z a-z]*" name="title" data-check_input_field  value="<?= $slid['title'];?>" required placeholder="Enter Title" class="form-control form_control"  oninput="TitleValidation(this.value,'title_span_edit<?= $slid['id']?>','btn_submit_update<?= $slid['id']?>')" />
                                                        
                                                            <span id="title_span_edit<?= $slid['id']?>"  data-message></span>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <img src="<?= base_url('/'.$slid['image']);?>" width="40px">
                                                          <input data-check_input_field class="form-control form-control-lg fom_select"    name="image" id="formFileLg_update" 
                                                          type="file" accept=".jpg, .jpeg, .png" oninput="check_file(this.value,'sp_image3<?= $slid['id']?>','submit<?= $slid['id']?>')"   >
                                                          <span id="sp_image3<?= $slid['id']?>" data-message style="  margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                    </div>
                                               <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>URL</label>
                                                            <input  data-check_input_field type="url" placeholder="https://example.com"  name="url" value="<?= $slid['url'];?>" required placeholder="https://example.com"  class="form-control form_control"  oninput="URLvalidation(this.value,'banner_span_update<?= $slid['id']?>','submit<?= $slid['id']?>')" />
                                                        <span data-message id="banner_span_update<?= $slid['id']?>"></span>
                                                        </div>
                                                    </div>
                                                     <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            
                                                            <option value="1"  <?=  $slid['status'] =='1'?'selected':'' ?>>Active</option>
                                                            <option value="2" <?=  $slid['status'] =='2'?'selected':'' ?>>Inactive</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="type" value="2">
                                                    <div class="form-group mb-3">
                                                        <label>Share To</label>
                                                        <select class="form-select form_control" name="share_status">
                                                          
                                                            <option value="1" <?=  $slid['share_status'] =='1'?'selected':'' ?>>All</option>
                                                            <option value="2" <?=  $slid['share_status'] =='2'?'selected':'' ?>>User</option>
                                                            <option value="3" <?=  $slid['share_status'] =='3'?'selected':'' ?>>Vendor</option>
                                                        </select>
                                                    </div>
                                                  
                                                </div>
                                                <!-- end row -->
                                                <button type="submit" id="submit<?= $slid['id']?>" class="btn btn-primary btn-sm waves-effect waves-light common_btn">Update</button>
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
    
                                 <a href="<?= base_url('Master/Delete_banner/'.$slid['id']); ?>">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="isconfirm()" title="Delete"><i class="fa fa-trash"></i></button>
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
                                                            <h5 class="modal-title" id="myModalLabel">Add Banner</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>

                                                     <form action="<?= base_url()?>Master/Add_banner_db" id="pristine-valid-example" enctype="multipart/form-data"  method="post" data-on_submit>
                                                 <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <input type="text"  pattern="[A-Z a-z]*" name="title"  data-check_input_field required placeholder="Enter Title"  oninput="TitleValidation(this.value,'title_span','submit_btn')" class="form-control form_control" />
                                                        <span  id="title_span" data-message></span>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="section_name" value="Banner">
                                                      <div class="col-xl-12 col-md-12 mb-3">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select"  data-check_input_field name="image"   required id="formFileLg"  oninput="check_file(this.value,'sp_image3','submit')"
                                                          type="file" accept=".jpg, .jpeg, .png">
                                                          <span id="sp_image3"  data-message style=" margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                        
                                                    </div>
                                               <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>URL</label>
                                                            <input type="url" name="url"  data-check_input_field required placeholder="https://example.com"     class="form-control form_control"   />
                                                       <span id="banner_span"   data-message ></span>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="type" value="2">
                                                    <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                            <option value="1">Active</option>
                                                            <option value="2">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Share To</label>
                                                        <select class="form-select form_control" name="share_status">
                                                            <option value="1">All</option>
                                                            <option value="2">User</option>
                                                            <option value="3">Vendor</option>
                                                        </select>
                                                    </div>
                                                  
                                                </div>
                                                <!-- end row -->
                                                <button type="submit" id="submit"  name="submit"  class="btn btn-primary waves-effect waves-light common_btn">Add</button>
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
                $(`[data-on_submit]`).submit(function()
                {

                    // alert(';hsjhsdfj');s
                let  check_name = $(this).find("[data-check_input_field]input[name='title']").val();
                let  check_url = $(this).find("[data-check_input_field]input[name='url']").val();
                let  check_image = $(this).find("[data-check_input_field]input[name='image']").val();
                let  reg_name = /^[a-zA-Z\s]*$/;
                let url_reg = /^(https:\/\/.|http:\/\/.)[a-zA-Z0-9\-_$]+\.[a-zA-Z]{2,3}$/;
                let  reg_mobile = /^[6789]{1}[0-9]{9}$/;
                var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
                if (!reg_name.test(check_name)) {
                    $(this).find("[data-check_input_field]input[name ='title']").siblings("[data-message]").html("<span style='color:red'>Please enter valid Title</span>");
                return false; 
                } 
                if (!url_reg.test(check_url)) {
                    $(this).find("[data-check_input_field]input[name='url']").siblings("[data-message]").html("<span style='color:red'>Please enter valid URL</span>");
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

function TitleValidation(vals,msg,btn)
{

    let reg = /^[a-zA-Z\s]*$/;
if(vals === '')
{
    $("#"+msg).empty(); 
    $("#"+btn).attr('disabled',false);  
}
else if(!reg.test(vals))
{
    $("#"+msg).html("<p style='color:red'>This field accept only characters</p>");
    $("#"+btn).attr('disabled',true);  
     }
     else
     {
         $("#"+msg).html("");
         $("#"+btn).attr('disabled',false);
     }
}
    </script>

<script>

function check_file(image,msg,btn){

    var allowedExtensions = /(\.jpg|\.png|\.jpeg)$/;
        if(!allowedExtensions.exec(image)){
        $("#"+msg).html("<p style='color:red'>Please upload file having extensions .jpeg, .png, .jpeg only./p>");
            $("#"+btn).attr('disabled',true);  
            return false;
        }else if(image != '')
        {
            $('#sp_image3').empty();
            $("#"+btn).attr('disabled',false);  
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
                $("#"+msg).html("");
                $("#"+btn).attr('disabled',false); 
        };
        reader.readAsDataURL(image.files[0]);
    }
   
    }
}
</script>



<script>
/*  function preview()
         {
     var image =$('#formFileLg').val();
    //  console.log(image);s
     if(image == ''){
        document.getElementById('sp_image3').innerHTML= '\n Please upload file';
        return false;
     }else{
        $('#sp_image3').empty(); 
        return true;
     }         
    	} */
  	</script>






      <script>

function URLvalidation(vals,msg,btn)
{

// let reg =   /^(http(s)?:\/\/)[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;

const reg = /^(https:\/\/.|http:\/\/.)[a-zA-Z0-9\-_$]+\.[a-zA-Z]{2,3}$/;
if(vals === '')
{
    $("#"+msg).empty(); 
    $("#"+btn).attr('disabled',false);  
}
else if(!reg.test(vals))
{
    $("#"+msg).html("<p style='color:red'>Please enter valid URL</p>");
    $("#"+btn).attr('disabled',true);  
     }
     else
     {
         $("#"+msg).html("");
         $("#"+btn).attr('disabled',false);
     }



}
    </script>







   
   <?php include('includes/footer.php')?>         

    </body>
</html>

