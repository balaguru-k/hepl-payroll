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
            <?php $message_other = $this->session->flashdata('message_other'); ?>
                
                <?php if (!empty($message_other)): ?>
                    <div id="toast-container" style="position:fixed; left:45%; top:30px;" class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $message_other; ?>
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
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Consortium report</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        
                                                            <div class="modal-body">
                                                                <d class="table-responsive" style="overflow:unset">  
                                                                    <table class="" style="margin-left: 200px;">  
                                                                     
                                                                    
                                                                    <tr  > 
                                                                        
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-2" style="text-align: center; width: 100px;">
                                                                                <div class="mb-3 ">
                                                                                    <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">Month</div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-4" style="width: 200px;">
                                                                            <div class="position-relative" id="datepicker40">
                                                                                <?php $month = date('F Y'); ?>
                                                                                    <input type="text" name="month" id="month_payroll_model" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" data-date-container="#datepicker40" data-date-min-view-mode="1" value="<?php echo $month; ?>" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </td>  <td>
                                                                        <div class="row p-6 ">
                                                                            <div class="col-lg-2" style="text-align: center; width: 100px;">
                                                                                <div class="mb-3 ">
                                                                                    <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">HRBP</div>
                                                                                </div></div>
                                                                                <div class="col-lg-4 "   style="width: 300px;" >
                                                                            <div class="position-relative" id="distributor" style="width: 300px;">
                                                                               <select class="form-control" id="hrbp_user_select" style="width: 300px;">
                                                                                    <option value="ALL"  selected>ALL</option>
                                                                                    <?php
                                                                                    $users = $this->masters_model->get_table_row_condition('users','role','HRBP');
                                                                                    
                                                                                    foreach ($users as $val) {
                                                                                        echo '<option value="' . $val['id'] . '" >' . $val['username'] . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                </div>
                                                                            </div>

                                                                            

                                                                        </div>
                                                                        
                                                                    </tr> 
                                                                   

                                                                   
                                                                    </table>  
                                                                    <div class="card-body" id="new_upload_tabledata"> 
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                            
                                                         
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                        </div>
                                        <!--ADD Employee modal-->

                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18" style="color:#fff !important;">Files List</h4>


                        <!-- <div class="col-sm-4" style="text-align:right">  
                            
                        
                            <button type="button" class="btn btn-success waves-effect waves-light" id="consolidated_modal" data-bs-toggle="modal" data-bs-target="#add_bulk_employee_modal">Consortium report</button>

                
                        </div> -->

                        
                       


                    </div>
                </div>

                    

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="row" style="margin-right:20px;">
                                    <div class="col-lg-2" style="text-align: right;">
                                        <div class="mb-3 mb-4">
                                            <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important;margin:20px 0; color:#304495!important">Month</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 d-flex">
                                        <div class="position-relative " id="datepicker4" style="margin:20px 0; width:80%">
                                            <?php $month = date('F Y'); ?>
                                                <input type="text" name="month" id="month_out" class="form-control" data-provide="datepicker" data-date-format="MM yyyy" data-date-container="#datepicker4" data-date-min-view-mode="1" value="<?php echo $month; ?>" required>
                                            </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="mb-3 mb-4  d-flex"  style="margin: 20px 0px 20px 86px;width:40%">
                                            <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">HRBP</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 " >
                                        <div class="position-relative" id="distributor"  style="margin:20px 0; width:80%">
                                            <select class="form-control select2" id="hrbp_select">
                                                <option value="ALL">ALL</option>
                                                <?php
                                                $users = $this->masters_model->get_table_row_condition('users','role','HRBP');
                                                
                                                foreach ($users as $val) {
                                                    echo '<option value="' . $val['id'] . '" >' . $val['username'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </div>


                              
                                <div class="col-sm-4 " style="text-align:right; margin-top:10px; " >  
                            
                        
                            <button type="button" class="btn btn-success waves-effect waves-light" id="consolidated_modal" data-bs-toggle="modal" data-bs-target="#add_bulk_employee_modal">Consortium report</button>

                
                        </div>
                                </div>



                                <div class="card-body">
                               
                                                                                
                                  
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

    <script src="<?php echo asset_url(); ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Required datatable js -->
    <script src="<?php echo asset_url(); ?>libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="<?php echo asset_url(); ?>libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/jszip/jszip.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="<?php echo asset_url(); ?>libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo asset_url(); ?>libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="<?php echo asset_url(); ?>js/pages/datatables.init.js"></script>

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

<!-- Sweet Alerts js -->
<script src="<?php echo asset_url(); ?>libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?php echo asset_url(); ?>js/pages/sweet-alerts.init.js"></script>
    <!-- App js -->
    <script src="<?php echo asset_url(); ?>js/app.js"></script>

    <script>
         $(document).ready(function () {
            var page = "upload";

            if (page == "upload") {
                $(".upload").addClass("active");
            }

            $("#table_data").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": true, "scrollX": true, "paging": true, "bInfo": true, "searching": true, "ordering": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

            $('#add_bulk_employee_modal').on('shown.bs.modal', function () {
                $('#sde').select2({
                    dropdownParent: $('#add_bulk_employee_modal') // Ensures dropdown appears inside modal
                //}).select2('open'); // Automatically opens the dropdown and focuses search
                });
            });

        });

        $('#toast-container').delay(5000).fadeOut('slow');


        $('#emp_month').datepicker({
         autoclose: true,
        })


             
             $(document).on("change", "#outlet_date_sel", function (e) {
                var date = $('#outlet_date_sel').val();
                 alert(month);

            get_other_upload_month_list();

            });  

            $( window ).on("load", function() {
                get_other_upload_month_list();
                new_upload_month_list();

            });

            function get_other_upload_month_list(){
            //   alert(1);
            var date = $('#outlet_date_sel').val();
            // alert(month);
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/payroll/get_other_upload_month_list',
            data: {date: date},
            type: 'post',
            success: function (response) {
            // alert(response);
            $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#other_upload_month').html(response);
                    $("#other_upload_table").DataTable({
                            "responsive": true, "lengthChange": true, "scrollX": true, "autoWidth": false,
                        // "buttons": ["copy", "csv", "excel", "pdf", "print"]
                            }).buttons().container().appendTo('#other_upload_table_wrapper .col-md-6:eq(0)');    
                } else {
                //$('#commodity_count_list').hide();
                }
            }
            });
            }
            function get_all_other_upload_month_list(){
            //   alert(1);
            var date = $('#outlet_date_sel').val();
            // alert(month);
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/payroll/get_all_other_upload_month_list',
            data: {date: date},
            type: 'post',
            success: function (response) {
            // alert(response);
            $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#other_upload_month').html(response);
                    $("#other_upload_table").DataTable({
                            "responsive": true, "lengthChange": true, "scrollX": true, "autoWidth": false,
                        // "buttons": ["copy", "csv", "excel", "pdf", "print"]
                            }).buttons().container().appendTo('#other_upload_table_wrapper .col-md-6:eq(0)');    
                } else {
                //$('#commodity_count_list').hide();
                }
            }
            });
            }




        
    </script>
<!-- new script to month filter -->
<script>
    $(document).ready(function () {
        var page = "upload";

        if (page == "upload") {
            $(".upload").addClass("active");
        }

        $("#table_data").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true, "scrollX": true, "paging": true, "bInfo": true, "searching": true, "ordering": true,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

        $('#add_bulk_employee_modal').on('shown.bs.modal', function () {
            $('#sde').select2({
                dropdownParent: $('#add_bulk_employee_modal') // Ensures dropdown appears inside modal
            //}).select2('open'); // Automatically opens the dropdown and focuses search
            });
        });

        // Event listener for month change
        $('#month_out').on('change', function () {
            get_other_upload_month_list();
        });
        $('#hrbp_select').on('change', function () {
            get_other_upload_month_list();
           // conlose.log(distributor_select);
        });
    
        // Initial load
        get_other_upload_month_list();
        new_upload_month_list();

    });

    $('#toast-container').delay(5000).fadeOut('slow');

    $('#emp_month').datepicker({
        autoclose: true,
    });
   

    function get_other_upload_month_list() {
        var month = $('#month_out').val();
        var hrbp_id=$('#hrbp_select').val();
        //alert(hrbp_user);
        var ajax_url = '<?php echo base_url(); ?>';
        $("#pageloader").fadeIn();
        $.ajax({
            url: ajax_url + 'index.php/payroll/get_other_upload_month_list',
            data: {month: month,hrbp_id:hrbp_id},
            type: 'post',
            success: function (response) {
                $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#other_upload_month').html(response);
                    $("#other_upload_table").DataTable({
                        "responsive": true, "lengthChange": true, "scrollX": true, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print"]
                    }).buttons().container().appendTo('#other_upload_table_wrapper .col-md-6:eq(0)');
                } else {
                    $('#other_upload_month').html('<tr><td colspan="6" align="center">No Records found</td></tr>');
                }
            }
        });
    }

    $('#month_payroll_model').on('change', function () {
        new_upload_month_list();
    });
    $('#hrbp_user_select').on('change', function () {
        new_upload_month_list();
    });

   
    $('#consolidated_modal').on('click', function () {
         $('#hrbp_user_select').select2({
       // dropdownParent: $('#myModal') // Ensures dropdown is inside the modal
        });
    });
    function new_upload_month_list() {
        var month = $('#month_payroll_model').val();
        var hrbp_user_id = $('#hrbp_user_select').val();
        var ajax_url = '<?php echo base_url(); ?>';
        $("#pageloader").fadeIn();
        $.ajax({
            url: ajax_url + 'index.php/payroll/get_all_other_upload_month_list',
            data: {month: month ,hrbp_user_id:hrbp_user_id},
            type: 'post',
            success: function (response) {
                $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#new_upload_tabledata').html(response);
                    console.log(response);
                    $("#new_upload_table").DataTable({
                        "responsive": false, "lengthChange": true, "scrollX": true, "autoWidth": false,
                         "buttons": ["copy", "csv", "excel", "pdf", "print"]
                    }).buttons().container().appendTo('#new_upload_table_wrapper .col-md-6:eq(0)');
                } else {
                    $('#new_upload_tabledata').html('<tr><td colspan="6" align="center">No Records found</td></tr>');
                }
            }
        });
    }
</script>
<!--  -->

</body>

</html>