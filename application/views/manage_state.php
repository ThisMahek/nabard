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

                    <?= $this->session->flashdata('success');?>
                    <?= $this->session->flashdata('error');?>
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
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                           <h4 class="card-title title_head"><?php echo $page_name; ?></h4>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                      <form action ="<?=  base_url() ?>vendor/disabled_district" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="inputState">Select State</label>
                                                    <select class="form-select form_control" id="inputState" name="state" required data-filter_enabaled  required>
                                                        <option value="SelectState">-- Select State --</option>
                                                        <?php foreach($states as $row):?>
                                                        <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                        <?php endforeach;?>
                                                      </select>
                                                </div>         
                                                <div class="form-group col-md-5">
                                                    <label for="inputDistrict">Select District</label>
                                                    <select class="form-select form_control" name="district" required id="inputDistrict_enb" >
                                                        <option value="">--Select District-- </option>
                                                    </select>
                                                 </div>
                                            <div class="form-group col-md-2">
                                            <button type ="submit" style="margin-top: 30px;" class="btn btn-primary">Add State/District</button>
                                             </div>
                                         </div>             
                                            </form>  


                                            <div class="row">
<div class="col-12">
<div class="card">
<div class="card-header">
<div class="row">
<div class="col-md-6 col-6">
<h4 class="card-title title_head">Manage District</h4>
</div>
</div>
</div>
<div class="card-body overy">
<table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
<thead>
<tr>
<th>Sr.No.</th>
<th>State</th>
<th>District</th>
<th>Action</th>
<!-- <th>Price</th>
<th>Availability Stock</th>
<th>Stock</th> -->
</tr>
</thead>
<tbody>
    <?php
    $i = 0; foreach ($state_table as $row):
        $i++; ?>
<tr>
<td><?= $i?></td>
<td><?= $row['sname']?></td>
<td><?= $row['dname']?></td>
<?php if($row['d_status']==1):?>
    <td><a  onclick="return confirm('Are you sure you want to disabled District?')" href="<?= base_url()?>State/change_district_status/<?=$row['d_id']?>"><button type="button" class="btn btn-success">Disabled</button></a></td>
<?php elseif($row['d_status']==2):?>
<td><a  onclick="return confirm('Are you sure you want to enabled District ?')" href="<?= base_url()?>State/change_district_status/<?=$row['d_id']?>"><button type="button" class="btn btn-danger">Enabled</button></a></td>
<?php endif;?>
</tr>
<?php endforeach;?>


</tbody>
</table>
</div>
</div>
</div>
</div>










                         <!--                    <form action ="<?=  base_url() ?>vendor/enabled_district" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label for="inputState">Select State</label>
                                                    <select class="form-select form_control" id="inputState_enb"  name="state" data-filter_disabled   required  >
                                                        <option value="SelectState">-- Select State --</option>
                                                        <?php foreach($states as $row):?>
                                                        <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                        <?php endforeach;?>
                                                      </select>
                                                </div>
                                                            
                                                <div class="form-group col-md-5">
                                                    <label for="inputDistrict">Select District</label>
                                                    <select class="form-select form_control" name="district" required id="inputDistrict_dis" >
                                                        <option value="">--Select District-- </option>
                                                    </select>
                                                 </div>
                                                        
                                          
                                            <div class="form-group col-md-2">
                                            <button type ="submit" style="margin-top: 30px;" class="btn btn-primary">Enabled</button>
                                             </div>
                                         </div>                  
                                            </form>   -->
                                            
                                            



                                            <!-- <form action ="<?=  base_url() ?>vendor/add_block" method="post">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Select State</label>
                                                    <select class="form-select form_control" id="inputState_block" name="state" data-filter_block=""   required>
                                                        <option value="SelectState">-- Select State --</option>
                                                        <?php foreach($states as $row):?>
                                                        <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                        <?php endforeach;?>
                                                      </select>
                                                </div>
                                                            
                                                <div class="form-group col-md-4">
                                                    <label for="inputDistrict">Select District</label>
                                                    <select class="form-select form_control" name="district"  required id="inputDistrict_block" >
                                                        <option value="">--Select District-- </option>
                                                    </select>
                                                 </div>
                                                        
                                         
                                                   <div class="form-group col-md-2">
                                                    <label for=""> Block</label>
                                                    <input type="text" name="block" class="form-control"  placeholder="Enter block" required>
                                                </div>
                                          
                                            <div class="form-group col-md-2">
                                            <button type ="submit" style="margin-top: 30px;" class="btn btn-primary">Add Block</button>
                                             </div>
                                         </div>                  
                                            </form>  -->



                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>




        <!-- END layout-wrapper -->
         <?php include('includes/footer.php')?> 



         <script>
      $(document).ready(function() {
       var result_list_table = '';
    $("[data-filter_block]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter_block]`), (v, i) => {
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                type: "POST",
                url: "<?= base_url()?>state/getch_state_district_block?" + getInput,
                data: "state_id=" + categoryID,
                success: function(html) {
                    let res = JSON.parse(html);
                    if(filter_attr != 'inputDistrict_block')
                    {
                        $(`#inputDistrict_block`).empty();
                        $.map(res.subcategory_list, function(v, i) {
                            $(`#inputDistrict_block`).append(`
                                  ${v}
                            `);
                        });
                    }
                }
            });

        } else {
            $('#inputDistrict_block').html('<option value="">--Select District First--</option>');
        }

    }))
});
</script>





<script>
      $(document).ready(function() {
       var result_list_table = '';
    $("[data-filter_disabled]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter_disabled]`), (v, i) => {
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                type: "POST",
                url: "<?= base_url()?>state/getch_state_district_disabled?" + getInput,
                data: "state_id=" + categoryID,
                success: function(html) {
                    let res = JSON.parse(html);
                    if(filter_attr != 'inputDistrict_dis')
                    {
                        $(`#inputDistrict_dis`).empty();
                        $.map(res.subcategory_list, function(v, i) {
                            $(`#inputDistrict_dis`).append(`
                                  ${v}
                            `);
                        });
                    }
                }
            });

        } else {
            $('#inputDistrict_dis').html('<option value="">--select state first--</option>');
        }

    }))
});
</script>






<script>
      $(document).ready(function() {
       var result_list_table = '';
    $("[data-filter_enabaled]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter_enabaled]`), (v, i) => {
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                type: "POST",
                url: "<?= base_url()?>state/getch_state_district_enabled?" + getInput,
                data: "state_id=" + categoryID,
                success: function(html) {
                    let res = JSON.parse(html);
                    if(filter_attr != 'inputDistrict_dis')
                    {
                        $(`#inputDistrict_enb`).empty();
                        $.map(res.subcategory_list, function(v, i) {
                            $(`#inputDistrict_enb`).append(`
                                  ${v}
                            `);
                        });
                    }
                }
            });

        } else {
            $('#inputDistrict_enb').html('<option value="">--select state first--</option>');
        }

    }))
});
</script>
        
    </body>
</html>