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
   <?= $this->session->flashdata('error'); ?>
   <?= $this->session->flashdata('success');?>
                             <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                           <h4 class="card-title title_head">Product Enquiry</h4>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <form  method="post">
                                        <div class="row">
                                          <div class="col-xl-2 col-md-2">
                                                 <div class="form-group mb-2">
                                                    <label for="from_date" class="form-label">From </label>
                                                   <input class="form-control" type="date"  name="from_date" value="<?=isset($_POST['from_date']) && $_POST['from_date']?date("Y-m-d",strtotime($_POST['from_date'])):''?>" >
                                                </div>
                                            </div>
                                             <div class="col-xl-2 col-md-2">
                                                 <div class="form-group mb-2">
                                                    <label for="to_date" class="form-label">To</label>
                                                   <input class="form-control" type="date"  name="to_date" value="<?=isset($_POST['to_date']) && $_POST['to_date']?date("Y-m-d",strtotime($_POST['to_date'])):''?>">
                                                </div>
                                            </div>
                                             <div class="col-xl-3 col-md-3">
                                                 <div class="form-group mb-3">
                                                    <label for="vendor_id" class="form-label">Vendor</label>
                                                    <select class="form-control" name="vendor_id">
                                                      <option value="">---Select Vendor---</option>
                                                      <?php
                                                      foreach($vendor_data as $v)
                                                      { ?>
                                                       <option value="<?=$v->id?>" <?php if($v->id==$this->input->post('vendor_id')){echo "selected";} ?>><?=$v->name?></option>
                                                       <?php }?>
                                                      </select>
                                                </div>
                                            </div>
                                             <div class="col-xl-3 col-md-3">
                                                 <div class="form-group mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                  <select class="form-control" name="status">
                                                      <option value="">---Select Status---</option>
                                                       <?php
                                                      foreach($status_data as $s)
                                                      {
                                                      
                                                      ?>
                                                       <option value="<?=$s->value?>" <?php if($s->value==$this->input->post('status')){echo "selected";} ?>><?=$s->status_type?></option>
                                                       <?php }?>

                                                      </select>
                                                </div>
                                            </div>
                                             <div class="col-xl-2 col-md-2">
                                                 <div class="form-group mt-4">
                                                     
                                                    <label for="example-datetime-local-input" class="form-label"> </label>
                                                   <button type="submit" class="btn btn-success" name="search_filter" class="form-control">Search</button>
                                                </div>
                                            </div>
                                            </div>
                                            </form>
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Order ID</th>
                                                <th>Vendor ID</th>
                                                <th>Vendor Name</th>
                                                <th>User Name</th>
                                                <th>Product Details</th>
                                                <th>User Message</th>
                                                <th>Vendor Reply</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                                <?php
                                                $i=1;
                                                foreach($product_enquiry as $row)
                                                {
                                                    $star_list = str_repeat('<i class="fa fa-star color-gold" aria-hidden="true"></i>', $row->rating_value);
                                                     if(!empty($star_list))
                                                     {
                                                          $rating_value=$star_list;
                                                     }
                                                     else
                                                     {
                                                         $rating_value='No rating here';
                                                     }
                                                ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$row->order_id?></td>
                                                 <td><?=$row->vendor_id?></td>
                                                <td><?=$row->vendor_name?></td>
                                                <td><?=$row->user_name?></td>
                                              
                                                 <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ProductModal<?=$row->order_id?>">Product Details</button></td>
                                                 <td><?=$row->user_msg?> </td>
                                                 <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#replyModal<?=$row->order_id?>">Vendor reply</button></td>
                                            
                                              
                                             <td><?= date("d/m/Y",strtotime($row->created_at))?></td>
                                                   <?php if( $row->status=='0'):?>
                                                <td><span class="badge badge-warning">Pending</span></td>
                                                <?php elseif($row->status=='1'):?>
                                                    <td><span class="badge badge-success">Accept</span></td>  
                                                    <?php elseif($row->status=='3'):?>
                                                    <td><span class="badge badge-danger">Cancelled</span></td>  
                                                    <?php elseif($row->status=='4'):?>
                                                    <td><span class="badge badge-success">Delivered</span></td>  
                                                <?php endif;?>
                                             <td> <a    href ="<?= base_url()?>vendor/delete_product_enquiry/<?= $row->order_id?>"    onclick="return confirm('Are you sure you want to delete enquiry?')"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                                               
                                            </tr>
                                            <!--reply model start---->
      <div id="replyModal<?=$row->order_id?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Vendor Reply</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                              <div class="card-body">
                                   <?= ($row->vendor_msg)?$row->vendor_msg:'No reply'?>
                 
                        </form>
                <div>
                    
                </div>

            </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--reply model end---->


 <!--product model start---->
      <div id="ProductModal<?=$row->order_id?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Product Details</h5>
                                    <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="modal-body">
                              <div class="card-body">
                               
                     <?php
                     $total_amount=0;
                      $total_sum=0;
                                $this->load->Model('Mvendor', 'MV');
                                $product_data = $this->MV->get_product_data_from_enquiry($row->order_id);
                                //   echo $this->db->last_query();
                                // echo "<pre>"; print_r($product_data);
                                
                                $variant_data = $this->MV->get_variant_data_from_enquiry($row->order_id);
                            //   echo $this->db->last_query();
  
                            //     echo "<pre>"; print_r($variant_data);
                                if(!empty($product_data)){

                                foreach($product_data as $p){
                                  $rating_feedback= $this->db->where(['product_id'=>$p->product_id,'enquiry_id'=>$row->order_id,'type'=>'product'])->get('rating_feedback')->row(); 
                               //  echo $this->db->last_query();
                                //  print_r($rating_feedack);
                                $total_sum+=$p->price;
                                if($total_sum==null)
                                { $total_count= 0.00;
                                }
                                else
                                {
                                $total_count= $total_sum;
                                }
                                ?> 
                                 <div class="row">
                            <div class="col-md-4 col-4"><h6>Product Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $p->product_id?></span></div>
                            <div class="col-md-4 col-4"><h6>Product Name: </h6></div>
                             <div class="col-md-8 col-8"><span><?= $p->product_name?></span></div>
                            <div class="col-md-4 col-4"><h6>Product Feedback: </h6></div>
                            <div class="col-md-8 col-8"><span> <?=isset($rating_feedback->feedback)?$rating_feedback->feedback:"No feedback here"?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Product Rating: </h6></div>
                            
                
                                                     <div class="col-md-8 col-8"><span> <?=isset($rating_feedback->rating_value)?$rating_feedback->rating_value.'<i class="fa fa-star color-gold" aria-hidden="true"></i>':"No rating here"?></span></div>
                            
                           
                           
                            <div class="col-md-4 col-4"><h6>Product price: </h6></div>
                            <div class="col-md-8 col-8"><span><?= isset($p->price)?$p->price:0.00?></span></div>
                             
                           
                            <?php }?>
                                 <div class="col-md-4 col-4"><h5>Total Amount </h5></div>
                                <div class="col-md-8 col-8"><span><b><?= (!empty($total_count)?number_format($total_count,2):"0.00")?></b></span></div>
                                </div> 
                                
                              <?php       
                                }?>
                                
                                
                                
                                
                                
                               <?php    
                                $total_varient_amount=0;
                                $total_varient_sum=0;
                                if(!empty($variant_data)){
                             
                               foreach($variant_data as $v){
                                   
                                   
                           $vrating_feedback= $this->db->where(['varient_id'=>$v->varient_id,'enquiry_id'=>$row->order_id,'type'=>'varient'])->get('rating_feedback')->row(); 

                                $total_varient_sum+=$v->price;
                                if($total_sum==null)
                                { $total_count= 0.00;
                                }
                                else
                                {
                                $total_count= $total_varient_sum;
                                }
                                ?> 
                                
                                 <div class="row">
                            <div class="col-md-4 col-4"><h6>Variant Id: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $v->varient_id ?></span></div>
                            <div class="col-md-4 col-4"><h6>Variant Name: </h6></div>
                            <div class="col-md-8 col-8"><span><?= $v->product_name?></span></div>
                            
                              <div class="col-md-4 col-4"><h6>Variant Feedback: </h6></div>
                            <div class="col-md-8 col-8"><span> <?=isset($vrating_feedback->feedback)?$vrating_feedback->feedback:"No feedback here"?></span></div>
                            
                            <div class="col-md-4 col-4"><h6>Variant Rating: </h6></div>
                            
                      
                                                     
                                                       <div class="col-md-8 col-8"><span> <?=isset($vrating_feedback->rating_value)?$vrating_feedback->rating_value.'<i class="fa fa-star color-gold" aria-hidden="true"></i>':"No rating here"?></span></div>
                            <div class="col-md-4 col-4"><h6>Variant price: </h6></div>
                            <div class="col-md-8 col-8"><span><?= isset($v->price)?$v->price:0.00?></span></div>
                            <?php       
                                }?>
                                 <div class="col-md-4 col-4"><h5>Total Amount </h5></div>
                                <div class="col-md-8 col-8"><span><b><?= (!empty($total_varient_sum)?number_format($total_varient_sum,2):"0.00")?></b></span></div>
                                </div> 
                                 <?php       
                                }?>
                <div>
                </div>
            </div>
            </div>
         
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--product model end---->

                            
                                       <?php }?>
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
                                                            <h5 class="modal-title" id="myModalLabel">Add Enquiry</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                            <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Name</label>
                                                            <input type="text" required placeholder="Enter Your Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Email Id</label>
                                                            <input type="email" required placeholder="Enter Your Email Id" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Mobile Number</label>
                                                            <input type="password" id="num"  required placeholder="Enter Your Mobile No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                       <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Order Id</label>
                                                            <input type="num" id="num"  required placeholder="Enter Your Order Id" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" id="formFileLg" type="file" accept="image/*">
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
  
                
 <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Update Enquiry</h5>
                                                            <button type="button" class="btn_close" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                      <div class="card-body">
                                        <div>
                                            <form id="pristine-valid-example" novalidate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Name</label>
                                                            <input type="text" required placeholder="Enter Your Name" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Email Id</label>
                                                            <input type="email" required placeholder="Enter Your Email Id" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Mobile Number</label>
                                                            <input type="num" id="num"  required placeholder="Enter Your Mobile No" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Order Id</label>
                                                            <input type="num" id="num"  required placeholder="Enter Your Order Id" data-pristine-pattern= "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/" data-pristine-pattern-message="Minimum 8 characters, at least one uppercase letter, one lowercase letter and one number" class="form-control form_control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>Status</label>
                                                            <select class="form-select form_control">
                                                                <option>Active</option>
                                                                <option>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                      <div class="col-xl-12 col-md-12">
                                                         <div>
                                                          <label for="formFileLg" class="form-label">Upload Image</label>
                                                          <input class="form-control form-control-lg fom_select" id="formFileLg" type="file" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </form>
                                        </div>

                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary waves-effect waves-light common_btn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>                
                
   <!--------------------------------------------End Edit Modal  ---------------------------->
  
         <?php include('includes/footer.php')?>         

    </body>
</html>