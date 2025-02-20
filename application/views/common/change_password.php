<?php include('application/views/partials/main.php'); ?>

<head>
<?php include('application/views/partials/title-meta.php');  ?>
<link href="<?php echo asset_url(); ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_url(); ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo asset_url(); ?>libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<?php include('application/views/partials/head-css.php');  ?>


</head>

<?php include('application/views/partials/body.php');  ?>
  

<div class="container-fluid">
    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include('application/views/partials/topbar.php'); ?>
        
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    
    <div class="container-fluid">
        <?php include('application/views/partials/sidebar.php'); ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            

            <div class="page-content">

                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18">Change Password</h4>
                        

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/admin/home">Home</a></li>
                                                        <li class="breadcrumb-item active">Change Password</li>
                                                </ol>
                        </div>

                  </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title mb-4">Example</h4> -->
            
                                
                                  <!-- form start -->
                                  <form name="recruitment_form" id="recruitment_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/common/change_pass'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                    <div class="card-body">
                                      <div class="row">

                                      <div class="col-lg-6">
                                          <div>
                                              <div class="mb-3 mb-4">
                                                  <label class="form-label" for="input-repeat">New Password</label>
                                                  <input type="password" id="new_pass" name="new_pass" class="form-control input-mask" placeholder="" required>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-lg-6">
                                          <div>
                                              <div class="mb-3 mb-4">
                                                  <label class="form-label" for="input-repeat">Confirm New Password</label>
                                                  <input type="password" id="confirm_pass" name="confirm_pass" class="form-control input-mask" placeholder="" required>
                                              </div>
                                          </div>
                                      </div>
                                            
                                           
                                        </div>
                                      
                                    </div>
                                    <!-- /.card-body -->
                    
                                    <div class="card-footer">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </form>
                                  </div>
                            </div>
                        </div>
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
    <?php include('application/views/partials/vendor-scripts.php');  ?>    

    <script src="<?php echo asset_url(); ?>libs/select2/js/select2.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

     <!-- form advanced init -->
     <script src="<?php echo asset_url(); ?>js/pages/form-advanced.init.js"></script>

    <!-- form mask -->
    <script src="<?php echo asset_url(); ?>libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>

    <!-- form mask init -->
    <script src="<?php echo asset_url(); ?>js/pages/form-mask.init.js"></script>

    <!-- App js -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>
    

    <script>
         $(document).ready(function () {
            var page = "change_password";

            if (page == "change_password") {
                $(".change_password").addClass("active");
            }

        });

    </script>


</body>

</html>