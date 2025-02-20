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
            // include('application/views/partials/sidebar.php');
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


                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18" style="color:#fff !important">Outlet List</h4>
                    </div>
                </div>

                    

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                            <div class="col-12">
                                                <div class="row" style="margin-top:20px;">
                                                    <!-- <div class="col-lg-5" style="text-align: right;">
                                                        <div class="mb-3 mb-4">
                                                            <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">Select Date</div>
                                                        </div>
                                                    </div> -->

                                                    <div class="col-lg-3" style="display:none;">
                                                        <div class="mb-3 mb-4">
                                                            <div class="position-relative" id="datepicker5">
                                                        
                                                                <input type="text" class="form-control" name="outlet_date_sel" id="outlet_date_sel" data-provide="datepicker" data-date-container='#datepicker5'
                                                                data-date-autoclose="true" value="<?php echo date('d-m-Y') ?>" required readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                  
                                        <div class="card-body" id="other_upload_month"> 
                                            
                                        </div>

                                        <div class="row" id="filter_div" style="display:none">
                                                        <div class="col-lg-5" style="text-align: right;">
                                                            <div class="mb-3 mb-4">
                                                                <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">Select Result</div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <select name="result" id="result" class="form-control select2" style="width:100%;" required>
                                                                <option value="ALL">ALL</option>
                                                            </select>
                                                        </div>
                                                       <!--  <div class="col-lg-4" style="text-align: right;">
                                                            <button class="btn btn-primary" onClick="get_other_upload_month_list()">Back to File Summary</button>
                                                        </div> -->
                                                    </div>

                                        <div class="card-body" id="other_upload_result"> 
                                            
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
        var file_id = null;
         $(document).ready(function () {
            var page = "other_upload";
            if (page == "other_upload") {
                $(".other_upload").addClass("active");
            }

            $("#table_data").DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": true, "scrollX": true, "paging": true, "bInfo": true, "searching": true, "ordering": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

        });

        $('#toast-container').delay(5000).fadeOut('slow');


        $('#emp_month').datepicker({
         autoclose: true,
        })


          /*    
            $(document).on("change", "#outlet_date_sel", function (e) {

                get_other_upload_month_list();
                get_result_list();

            });  */

            $(document).on("change", "#result", function (e) {

                //  get_other_upload_month_list();
                showDetails(file_id);
           
            }); 

            $( window ).on("load", function() {
                get_other_upload_month_list();
                //get_result_list();
            });

            function get_other_upload_month_list(){
            //   alert(1);
            var date = $('#outlet_date_sel').val();
            var result = $('#result').val();
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/Sde/get_other_upload_month_list',
            data: {date: date,result: result},
            type: 'post',
            success: function (response) {
            // alert(response);
            $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#filter_div').hide();
                    $('#other_upload_month').html(response);
                    $(".confirmation").select2();
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

            function showDetails(id){
              // alert(123);
            file_id =id;
            var date = $('#outlet_date_sel').val();
            var result = $('#result').val();
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/Sde/get_data_list',
            data: {date: date,result: result,file_id:file_id},
            type: 'post',
            success: function (response) {
            // alert(response);
            $("#pageloader").fadeOut();

                if (response != 0) {
                    $('#filter_div').show();
                    get_result_list(file_id);
                    $('#other_upload_result').html(response);
                    $(".confirmation").select2();
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

            function get_result_list(file_id){
            //  alert(file_id);
            var file_id = file_id;
            var date = $('#outlet_date_sel').val();
            // alert(month);
            var ajax_url = '<?php echo base_url(); ?>';
           // $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/Sde/get_result_list',
            data: {date: date,file_id: file_id},
            type: 'post',
            success: function (response) {
            // alert(response);
           // $("#pageloader").fadeOut();
                if (response != 0) {
                    $('#result').html(response);  
                } else {
                //$('#commodity_count_list').hide();
                }
            }
            });
            }




            $(document).on('click','#bulk_upload_btn_extra',function(){
        var type = $('#type_extra').val();
        var customFile = $('#customFile_extra').val();

        //alert(vertical);
        var ajax_url = '<?php echo base_url(); ?>';
        if(type == "" || customFile == ""){
            //alert("Please Enter Vertical Name");
        // $("#alert_empty").show();
        //  $('#alert_empty').delay(5000).fadeOut('slow');
        Swal.fire(
            {
                title: 'Please Add File',
                confirmButtonColor: '#3b5de7',
            }
        )
        // $("#vertical").addClass("parsley-error");
    }else{
        // $("#alert_empty").hide();
        $.confirm({
                title: '',
                content: 'Are you sure you entered values in Rupees not in lakhs?',
                // autoClose: 'logoutUser|300',
                buttons: {
                    yes: {
                    text: 'YES',
                    action: function() {
                            $("#pageloader").fadeIn();
                            document.getElementById('upload_form_extra').submit();
                           // alert(1);
                            /////
                        }
                    },

                    cancel: {
                    text: 'CANCEL',
                    action: function() {
                            // window.location.reload();
                            //alert(2);
                           
                        }
                    },
                }
            });
    }
    
}); //end add Budget
        

        function update_confirmation(id){
            var confirmation = $('#confirmation_'+id+'').val();
            var comments = $('#comments_'+id+'').val();

            if(confirmation == "0"){
            Swal.fire(
                {
                    title: 'Please Select Confirmation',
                    confirmButtonColor: '#3b5de7',
                }
            )
            // $("#vertical").addClass("parsley-error");
            }else{
            

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Confirm it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {
                    
                    $.ajax({
                    type : "POST", 
                    url : "<?php echo base_url('index.php/sde/confirmation_update'); ?>",
                    data : {'id':id,'confirmation':confirmation,'comments':comments},
                    dataType:"JSON",
                    beforeSend: function() {
                        $("#pageloader").fadeIn();
                    },
                    success:function(response){
                       // alert(response);
                       // location.reload();
                        console.log(response);
                        var status = response.status;
                        //$("#hide_" + status + "").hide();
                       // $("#hide_" + status + "").addClass("delete_style");
                    //    get_other_upload_month_list();
                    get_other_upload_month_list();
                    showDetails(file_id);
                        Swal.fire({
                        title: 'Updated!',
                        text: 'Your data has been updated.',
                        type: 'success'
                        })
                        
                        }
                    });

                   
                  } else if (
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    Swal.fire({
                      title: 'Cancelled',
                      text: 'Your imaginary data is safe :)',
                      type: 'error'
                    })
                  }
            });

        }
        }
    </script>

</body>

</html>