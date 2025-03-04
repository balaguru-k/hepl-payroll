<?php include('application/views/partials/main.php'); ?>
 
<head>
 
    <?php include('application/views/partials/title-meta.php');  ?>
</head>
<link href="<?php echo asset_url(); ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_url(); ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo asset_url(); ?>libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<style>
    .dtr-title{ width:200px;}
    .dtr-data{ float:right;}
    #pageloader
            {
              background: rgba( 255, 255, 255, 0.8 );
              display:none;
              height: 100%;
              position: fixed;
              width: 100%;
              z-index: 9999;
            }
            .loader {
               left: 50%;
              margin-left: -32px;
              margin-top: -32px;
              position: absolute;
              top: 50%;
            }
            .navbar-header{
                background-color:#6524b8;
            }
            body[data-layout=detached] #layout-wrapper::before {
                background: -webkit-gradient(linear, left top, right top, from(#6a2cbb), to(#6524b8)) !important;
 
            }
            .consolidated-button{
                background-color: #6524b8 !important;
                color:white !important;
                border-color: #6524b8 !important;
            }
            .page-item.active .page-link {
                color: #fff;
                background-color:#6524b8 !important;
                border-color:#6a2cbb;
              }
  </style>
    <!-- DataTables -->
    <link href="<?php echo asset_url(); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url(); ?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"  type="text/css" />
 
    <link href="<?php echo asset_url(); ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
 
 
    <!-- Responsive datatable examples -->
    <link href="<?php echo asset_url(); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"  type="text/css" />
 
    <!-- Sweet Alert-->
    <link href="<?php echo asset_url(); ?>libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
 
    <?php include('application/views/partials/head-css.php'); ?>
 
 
 
</head>
<?php include('application/views/partials/body.php');  ?>
 
<div id="pageloader">
    <div class="loader">
        <button class="btn btn-primary" type="button" disabled="">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
    </div>
</div>
<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">
 
        <?php include('application/views/partials/topbar.php'); ?>
       
        </div>
        <!-- end main content-->
 
    </div>
    <!-- END layout-wrapper -->
   
    <div class="container-fluid">
        <?php
           //include('application/views/partials/sidebar.php');
         ?>
 
   
 
            <!-- start: alert Message -->
            <?php $message_other = $this->session->flashdata('message_other'); 
                   $count_error = $this->session->flashdata('count_error');
            ?>
               
                <?php if (!empty($message_other)): ?>
                    <div id="toast-container" style="position:fixed; left:45%; top:30px;" class="sucess_container alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $message_other; ?>
                        <button type="button" style="cursor:pointer;" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
 
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($count_error)): ?>
                    <div id="toast-container" style="position:fixed; left:45%; top:30px;" class="error_container alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $count_error; ?>
                        <button type="button" style="cursor:pointer;" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
 
                        </button>
                    </div>
                <?php endif; ?>
 
               
                <!-- start: alert Message -->
                                   
 
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
           
 
            <div class="page-content">
 
               
 
 
                                      <!--ADD users modal-->
                                    <div class="modal fade" id="add_bulk_employee_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload File</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form name="masters_form" id="masters_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/hrbp/add_outlet'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                                            <div class="modal-body">
                                                                <div class="table-responsive" style="overflow:unset">  
                                                                    <table class="">  
                                                                     <tr style="display:none">  
                                                                      <td class="col-8">
                                                                        <div class="position-relative" id="datepicker9">
                                                       
                                                                            <input type="text" style="margin:20px 0" class="form-control" name="outlet_date" id="outlet_date" data-provide="datepicker" data-date-autoclose="true" data-date-container='#datepicker9' value="<?php echo date('d-m-Y') ?>" required readonly>
                                                                        </div>
                                                                    </td>  
                                                                      <td class="col-4">&nbsp;
 
                                                                      </td>
                                                                    </tr>
                                                                   
                                                                    <tr>  
                                                                    <td colspan="2">
                                                                        <div class="row">
                                                                            <div class="col-lg-4" style="text-align: right;">
                                                                                <div class="mb-3 mb-4">
                                                                                    <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#4c2fbf!important">Month</div>
                                                                                </div>
                                                                            </div>
 
                                                                            <div class="col-lg-8">
                                                                            <div class="position-relative" id="datepicker40">
                                                                                <?php $month = date('F Y'); ?>
                                                                                    <input type="text" name="month" id="month" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" data-date-container="#datepicker40" data-date-min-view-mode="1" value="<?php echo $month; ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                    </td>  
                                                                     
                                                                    </tr>
 
                                                                    <tr style="background:#f8f9fa">  
                                                                        <td class="col-8">
                                                                            <div class="custom-file">
                                                                                <input type="file" name="document" required class="form-control" id="customFile">
                                                                            </div>                                  
                                                                        </td>
                                                                        <td class="col-4" style="text-align:right; padding:20px 0;">
                                                                            <a href="<?php echo base_url(); ?>uploads/sample/sample_inputs_excel.xlsx" class="btn btn-success waves-effect waves-light">Sample Excel</a>
                                                                        </td>                                                                    
                                                                    </tr>
                                                                    </table>  
                                                                  </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal"></button>
                                                              <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                         </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                        </div>
                                        <!--ADD Employee modal-->
 
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18" style="color:#fff !important;">Files List</h4>
 
 
                        <div class="col-sm-4" style="text-align:right">  
                           
                       
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add_bulk_employee_modal">Upload Data</button>
 
               
                        </div>
 
                       
                       
 
 
                    </div>
                </div>
 
                   
 
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="row">
                                <div class="col-lg-4" style="text-align: right;">
                                    <div class="mb-3 mb-4">
                                        <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important;margin:20px; color:#4c2fbf!important">Month</div>
                                    </div>
                                </div>
 
                                <div class="col-lg-8">
                                <div class="position-relative " id="datepicker4" style="margin:20px 0; width:30%">
                                    <?php $month = date('F Y'); ?>
                                        <input type="text" name="month" id="month_filter_hrbp" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" data-date-container="#datepicker4" data-date-min-view-mode="1" value="<?php echo $month; ?>" required>
                                    </div>
                                </div>
                            </div>
                                <div class="card-body">
 
                                    <div class="row" style="display:none;">
                                            <div class="col-12">
                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-lg-5" style="text-align: right;">
                                                        <div class="mb-3 mb-4">
                                                            <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#4c2fbf!important">Select Date</div>
                                                        </div>
                                                    </div>
 
                                                    <div class="col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <div class="position-relative" id="datepicker5">
                                                       
                                                                <input type="text" class="form-control" name="outlet_date_selww" id="outlet_date_selwww" data-provide="datepicker" data-date-container='#datepicker5' value="<?php echo date('d-m-Y') ?>" required readonly>
                                                            </div>
                                                           
                                                           
                                                        </div>
                                                    </div>
 
                                                </div>
                                            </div>
                                        </div>
                                 
                                        <div class="card-body" id="other_upload_month">
                                           
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
 
 
 
 
                   
 
 
 
 
 
                            </div>
            <!-- End Page-content -->
           
        </div>
        <!-- end main content div -->
       
 
    </div>
    <!-- end container div -->
    <?php include('application/views/partials/footer.php'); ?>
 
</div>
<!-- end container-fluid -->
 
 
 
    <!-- JAVASCRIPT -->
    <?php
            include('application/views/partials/vendor-scripts.php');
    ?>
    <?php
            include('application/views/partials/script/hrbpscript.php');
      ?>
 
</body>
 
</html>