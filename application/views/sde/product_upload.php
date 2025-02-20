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
            if($this->session->userdata('emp_id') == '900452')
            {
                //
            }else{
                include('application/views/partials/sidebar.php');
            }
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
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Upload File</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form name="masters_form" id="masters_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/hrbp/add_products'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                                            <div class="modal-body">
                                                                <div class="table-responsive">  
                                                                    <table class="">  
                                                                    <tr>  
                                                                      <td class="col-8"><input type="text"  name="file_name" placeholder="Enter File Name" class="form-control" required /><br></td>  
                                                                    </tr> 

                                                                    <tr>  
                                                                        <td class="row" style="width:100%">
                                                                            <div class="col-6">
                                                                                <div class="custom-file">
                                                                                    <input type="file" name="document" required class="custom-file-input" id="customFile">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6" style="text-align:right">
                                                                                <a href="<?php echo base_url(); ?>uploads/sample/sample_product.xlsx" class="btn btn-success waves-effect waves-light">Download Sample Excel</a>                           
                                                                            </div>
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
                        <h4 class="page-title mb-0 font-size-18">Files List</h4>


                        <div class="col-sm-4" style="text-align:right">  
                            
                        
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add_bulk_employee_modal">Add File</button>

                
                        </div>

                        
                       


                    </div>
                </div>

                    

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                            <div class="col-12">
                                                <div class="row" style="margin-top:20px;">
                                                    <div class="col-lg-5" style="text-align: right;">
                                                        <div class="mb-3 mb-4">
                                                            <div style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#304495!important">Select Month</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="mb-3 mb-4">
                                                            <div class="position-relative" id="datepicker5">
                                                        
                                                                <input type="text" class="form-control" name="emp_month" id="emp_month" data-provide="datepicker"
                                                                data-date-format="MM yyyy" data-date-container='#datepicker5'
                                                                data-date-min-view-mode="1" value="<?php echo date('F Y') ?>" required readonly>
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
            var page = "product_upload";

            if (page == "product_upload") {
                $(".product_upload").addClass("active");
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


             
            $(document).on("change", "#emp_month", function (e) {

            get_other_upload_month_list();

            }); 

            $( window ).on("load", function() {
                get_other_upload_month_list();
            });

            function get_other_upload_month_list(){
            //   alert(1);
            var month = $('#emp_month').val();
            // alert(month);
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/Hrbp/get_product_upload_month_list',
            data: {month: month},
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




            function delete_doc(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ms-2 mt-2',
                buttonsStyling: false
            }).then(function (result) {

                if (result.value) {

                    $.ajax({
                    type : "POST", 
                    url : "<?php echo base_url('index.php/hrbp/delete_documents'); ?>",
                    data : {'id':id},
                    dataType:"JSON",
                    success:function(response){
                        //location.reload();
                        console.log(response);
                        var status = response.status;
                        $("#hide_doc" + id + "").hide();
                        Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        type: 'success'
                        })
                        
                        }
                    });

                   
                  } else if (
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    Swal.fire({
                      title: 'Cancelled',
                      text: 'Your imaginary file is safe :)',
                      type: 'error'
                    })
                  }
            });
        }
        
    </script>

</body>

</html>