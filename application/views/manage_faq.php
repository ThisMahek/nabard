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
                                                <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                 <button type="button" class="btn btn-primary waves-effect waves-light common_btn" data-bs-toggle="modal" data-bs-target="#addModal">+ Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                                 <tbody>
                                                <?php 
                                                $i=1;
                                                foreach($faq as $nottic)
                                                {
                                                ?>
                                            <tr>
                                                <td><?= $i++;?></td>
                                                <td><?= $nottic['question'];?></td>
                                                <td><?= $nottic['answer'];?></td>
                                                 <td>
                                                  <?php
                                                    if($nottic['status'] =='1')
                                                    {
                                                        echo "<b style='color:green;'>Active</b>";
                                                    }
                                                    else
                                                    {
                                                      echo "<b style='color:red;'>Inactive</b>";
                                                    }
                                                     ?>
                                                    </td>
                                                <td><button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#editModal<?= $nottic['id']?>"><i class="fa fa-edit"></i></button>
                                         
                               
        <!--------------------------------------------Update Modal  ---------------------------->
        <div id="editModal<?= $nottic['id']?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Update FAQ</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        
                       <div class="card-body">
                                          <?= form_open_multipart("Master/Edit_faq_db/{$nottic['id']}",'id="pristine-valid-example"');?>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Question</label>
                                            <input type="text" name="question"  value="<?= $nottic['question'];?>" class="form-control form_control" placeholder="Enter Question" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Answer</label>
                                            <textarea type="text" name="answer" required="" placeholder="Enter Answer" class="form-control form_control" ><?= $nottic['answer'];?></textarea>
                                        </div>
                                          <div class="form-group mb-3">
                                                        <label>Status</label>
                                                        <select class="form-select form_control" name="status">
                                                             <?php
                                                            if($nottic['status'] =='1')
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
                                                            <option value="2'">Inactive</option>
                                                        </select>
                                                    </div>
                                    </div>
                                </div>
                                  <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light common_btn">Update</button>

                            </form>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                     </div>
                </div>
            </div>
        </div>                
   <!--------------------------------------------End Edit Modal  ---------------------------->
   
          
                                                   <a href="<?= base_url('Master/Delete_faq/'.$nottic['id']); ?>">
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
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        <!-- END layout-wrapper -->
        
<!--------------------------------------------Add Modal  ---------------------------->
        <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add FAQ</h5>
                        <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                                          <?= form_open_multipart('Master/Add_faq_db','id="pristine-valid-example"');?>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Question</label>
                                            <input type="text" name="question" class="form-control form_control" placeholder="Enter Question" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Answer</label>
                                            <textarea type="text" name="answer" required="" placeholder="Enter Answer" class="form-control form_control" ></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-select form_control" required name="status">
                                                <option value='1'>Active</option>
                                                <option value='2'>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                  <button type="submit"  class="btn btn-primary btn-sm waves-effect waves-light common_btn">Add</button>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>                
   <!--------------------------------------------End Edit Modal  ---------------------------->
   <script>
   
         
function isconfirm(){

if(!confirm('Are you sure Delete it?')){
event.preventDefault();
return;
}
return true;
}

   </script>
         <?php include('includes/footer.php')?>         
    </body>
</html>