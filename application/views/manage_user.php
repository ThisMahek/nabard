<!doctype html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<?php include('includes/common-head.php')?>
<style>
    h6 span{
        font-weight:400;
    }
</style>
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
                        <?= $this->session->flashdata('success');?>
                        <?= $this->session->flashdata('error');?>
                        <!-- end page title -->
                             <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8 col-8">
                                           <h4 class="card-title title_head">Manage User</h4>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                               <div class="col-xl-3 col-md-3">
                                                         <div class="form-group mb-3">
                                                            <label class="form-label">Select by Status</label>
                                                                <select required="" class="form-control form-select fom_select"  id="inputStatus" name="inputStatus"  data-filter_user>
                                                                    <option value="">Select All</option>
                                                                    <option value="">All</option>
                                                                    <option value="0">Inactive</option>
                                                                    <option value="1">Active</option>
                                                                </select>
                                                        </div>
                                                </div>
                                                <div class="col-md-3">
                                                     <div class="form-group">
                                                        <label for="inputState">Select State</label>
                                                        <select class="form-select form_control"
                                                        
                                                        data-filter_vendor2 
                                                    data-default_option="<option value=''>--Select State--</option>"
                                                    data-filter="inputState"
                                                    data-next="inputDistrict"
                                                        
                                                        
                                                        id="inputState" name="inputState"data-filter_user>
                                                        <option value="">-- Select State --</option>
                                                        <?php foreach($states as $row):?>
                                                        <option value="<?= $row['s_id']?>"><?= $row['sname']?></option>
                                                        <?php endforeach;?>
                                                          </select>
                                                    </div>
                                               </div>        
                                                   <div class="col-md-3">
                                                         <div class="form-group">
                                                            <label for="inputDistrict">Select District</label>
                                                     <select class="form-select form_control" data-filter_vendor2 
                                                    data-filter="inputDistrict"
                                                    data-next=""  data-default_option="<option value=''>--Select district--</option>"
                                                            id="inputDistrict" name="inputDistrict" data-filter_user>
                                                                <option value="">-- Select District-- </option>
                                                            </select>
                                                        </div>
                                                   </div>        
                                         </div>
                                         <table   data-result_list_table  class="table">

                                       <!--  <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100"> -->
                                            <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Email Id</th>
                                                <th>Mobile No</th>
                                                <th>State</th>
                                                <th>District</th>
                                                <th>Tehsil,</th>
                                                <th>Pincode</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody  id="user_data">
                                         
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

 
<script>
$(document).ready(function() {
    var result_list_table = '';
            $(`[data-filter_vendor2]`).change(function(e) {
             e.preventDefault();
             let obj = $(this);
             let obj_for_clear_next_selects = $(obj).attr('data-next');
             console.log(obj_for_clear_next_selects);
             
             while (obj_for_clear_next_selects != '') {
                 next = `[data-filter="${obj_for_clear_next_selects}"]`
                 $(next).html($(next).attr(`data-default_option`))
                 obj_for_clear_next_selects = $(next).attr(`data-next`);
                 
             }
         }); 
    $("[data-filter_user]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter_user]`), (v, i) => {             
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        getlist(getInput,filter_attr)
    }))
    var stateID = $(this).val();
    function getlist(getInput ="",filter_attr="") {
        
        
        console.log(getInput);
        console.log(filter_attr);
        
        $.ajax({
            type: "POST",
            url: "<?= base_url()?>User/user_data_filter?" + getInput,
            data: "",
            success: function(html) {
                let res = JSON.parse(html);
                if(filter_attr == 'inputState')
                {
                    $(`#inputDistrict`).empty();
                $.map(res.subcategory_list, function(v, i) {
                    $(`#inputDistrict`).append(`${v}`);
                });
            }  
         
             $(`#user_data`).empty();
             if (result_list_table != '') 
              {
                    result_list_table.clear()
                    result_list_table.destroy(); 
                         }  
                         var i=1;
                $.map(res.user_data_filter,function(v,i) {
                    var btn_text = '';
                    i++;
                    if (v.status == '1')
                     {
                        var btn_text = `<a onclick="return confirm('Are you sure you want to inactive?')" href='<?= base_url()?>product/change_user_status/${v.uid}'><button
                        class="btn btn-success">Active</button></a>`;
                    } else if (v.status== '0') 
                    {
                        btn_text = `<a onclick="return confirm('Are you sure you want to active?')" href='<?= base_url()?>product/change_user_status/${v.uid}'><button
                             class="btn btn-danger">Inactive</button></a>`;
                    }
                    if ((v.image!=null))
                     {
                       var img_user =  `<img src="<?= base_url()?>${v.image}" class="imge_categoy">`;
                    } else if(v.image === null)
                    {
                       var  img_user =  `<img src="<?= base_url()?>assets/images/noimages.png"   class="imge_categoy">`;
                    }
                     $(`#user_data`).append(`   
                     <tr>
                    <td>${i}</td>
                    <td>${v.name}</td>
                    <td>${img_user}</td>
                    <td>${v.email}</td>
                    <td>${v.mobile}</td>
                    <td>${v.state_name}</td>
                    <td>${v.district_name}</td>
                    <td>${v.tahsil}</td>
                    <td>${v.pincode}</td>
                      <td>${btn_text}</td>
                     <td><a  onclick="return confirm('Are you sure you want to delete user?')" href="<?= base_url()?>product/delete_user/${v.uid}"> <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>  
                     <a  href="<?= base_url()?>admin/edit_users/${v.uid}"> <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button></a>
                     </td>
                    </tr> `);
                });
                result_list_table = $(`[data-result_list_table]`).DataTable();
            }
        });
    }
    getlist("", "");
});
</script>
         <?php include('includes/footer.php')?>  
                 <!-- JAVASCRIPT -->



            
    </body>
</html>