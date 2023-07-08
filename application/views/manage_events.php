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
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                           <h4 class="card-title title_head">Manage Events</h4>
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
                                                <!-- <th>Url</th> -->
                                                 <th>Description</th>
                                                <th>Image</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                                <?php
                                                $i=1;
                                                foreach($subs as $sub)
                                                {
                                                ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $sub['title'];?></td>
                                                <!-- <td><?= $sub['url'];?>r</td> -->
                                                <td><?= $sub['description'];?></td>
                                                <td><img src="<?= base_url('/'.$sub['image'])?>" class="imge_categoy"></td>
                                                <td><?= $sub['create_at'];?></td>
                                                    <td>
                                                  <?php
                                                    if($sub['status'] =='1')
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
                                                        
                                                    <button type="button" class="btn btn-success waves-effect waves-light btn-sm"  data-bs-toggle="modal"
                                                    data-bs-target="#edit-notification<?= $sub['id']?>"><i class="fa fa-edit"></i></button>
                                        
    
                                                   <a href="<?= base_url('Master/Delete_news/'.$sub['id']); ?>">
                                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </a>                                                
                                                </td>
             <!--------------------------------------------Update Modal  ---------------------------->
  
                
  <div class="modal fade" id="edit-notification<?= $sub['id']?>" tabindex="-1" aria-labelledby="#edit-notification<?= $sub['id'];?>" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Event</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <?= form_open_multipart("Master/Edit_news_db/{$sub['id']}",'id="pristine-valid-example"');?>
                                               
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <input type="text" name="title" value="<?= $sub['title'];?>" required placeholder="Enter Title"    oninput=" return FullnameValidation(this.value,'title_span_edit','submit_edit')" class="form-control form_control" />
                                                       <!--<span   id="title_span_edit"></span>-->
                                                       
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                         <div class="form-group mb-3">
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <img src="<?= base_url('/'.$sub['image']); ?>" width="30px">
                                                          <input class="form-control form-control-lg fom_select" name="image" id="formFileLg" type="file" oninput="check_file_edit(this.value)"  accept="image/*">
                                                       <span id="sp_image3_edit"></span>
                                                        </div>
                                                    </div>
                                                   <!--  <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>URL</label>
                                                            <input type="text" value="<?= $sub['url'];?>" name="url" required placeholder="Enter URL"   oninput="URLvalidation(this.value,'url_span_edit','submit')" class="form-control form_control" />
                                                        <span  id="url_span_edit"></span>
                                                        </div>
                                                    </div> -->
                                                       <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Description</label>
                                                            <textarea type="text" id="" name="description" required placeholder="Enter Your Description"
                                                            class="form-control form_control" /><?= $sub['description'];?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Status</label>
                                                            <select class="form-select form_control" name="status">
                                                                 <?php
                                                            if($sub['status'] =='1')
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
                                                 <option value='1'>Active</option>
                                                <option value='2'>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                               <button type="submit" id="submit_edit" class="btn btn-primary waves-effect waves-light common_btn">Update</button>

                                               
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
                                                            <h5 class="modal-title" id="myModalLabel">Add Event</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                          <?= form_open_multipart('Master/Add_news_db','id="pristine-valid-example"');?>
                                                 <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <input type="text" name="title" required required placeholder="Enter Title"  oninput=" return FullnameValidation(this.value,'title_span','submit')" class="form-control form_control"  />
                                                        <!--<span id="title_span"></span>-->
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="2" name="type">
                                                    <div class="col-xl-12 col-md-12">
                                                         <div class="form-group mb-3">
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" name="image" required id="formFileLg" type="file"  oninput="check_file(this.value)"  accept="image/*">
                                                          <span id="sp_image3" style=" margin-left:4%; margin-bottom:3%  ;color:red"; ></span>
                                                        </div>
                                                    </div>
                                                  <!--   <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>URL</label>
                                                            <input type="text" name="url"  required placeholder="Enter URL" class="form-control form_control"  oninput="URLvalidation(this.value,'url_span','submit')" />
                                                        <span  id="url_span"></span>
                                                        </div>
                                                    </div> -->
                                                       <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Description</label>
                                                            <textarea type="text" id="" name="description" required placeholder="Enter Your Description" class="form-control form_control" /></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Status</label>
                                                            <select class="form-select form_control" name="status">
                                                                 <option value='1'>Active</option>
                                                <option value='2'>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                        <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light common_btn">Add</button>
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
    

         <?php include('includes/footer.php')?>  
         
         

         <script>

function URLvalidation(vals,msg,btn)
{

const reg = /(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
if(vals === '')
{
    $("#"+msg).empty(); 
    $("#"+btn).attr('disabled',false);  
}
else if(!reg.test(vals))
{
    $("#"+msg).html("<p style='color:red'>Please Enter valid URL</p>");
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

function check_file(image){

    var allowedExtensions = /(\.jpg|\.png|\.jpeg )$/i;
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

    var allowedExtensions = /(\.jpg|\.png|\.jpeg )$/i;
        if(!allowedExtensions.exec(image)){
    document.getElementById('sp_image3_edit').innerHTML= '\n Please upload file having extensions .jpeg, .png, .jpeg only.';
        document.getElementById("sp_image3_edit").style.color="red";
            document.getElementById("submit_edit").disabled=true;
            return false;
        }else if(image != '')
        {
            $('#sp_image3_edit').empty();
            document.getElementById("submit_edit").disabled=false;
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

    </body>
</html>