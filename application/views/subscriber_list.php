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
                                        <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Email Id.</th>
                                                    <th>Date</th>
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
                                                    <td><?= $sub['email']; ?></td>
                                                    <td><?= $sub['create_at']; ?></td>
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
         <?php include('includes/footer.php')?>         
    </body>
</html>