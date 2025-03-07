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
            url: ajax_url + 'index.php/quality/get_other_upload_month_list',
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
            url: ajax_url + 'index.php/quality/get_all_other_upload_month_list',
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
            url: ajax_url + 'index.php/quality/get_other_upload_month_list',
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
            url: ajax_url + 'index.php/quality/get_all_other_upload_month_list',
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



    $(document).on('click', '.verify-btn', function() {
                var id = $(this).data('id');
                // var status = $(this).data('status');
                $('#recordid').val(id);
                // $('#qc_status').val(status);
                $('#qcRemarksModal').modal('show');
            });
//             $(document).ready(function () {
//     // Open Modal and Set Record ID
//     $('.verify-btn').on('click', function () {
//         var recordId = $(this).data('id');
//         $('#recordid').val(recordId); // Set hidden input value
//         $('#qcRemarksModal').modal('show'); // Show the modal
//     });
// });
          
            $(document).ready(function () {
    // Close button action - Reset fields and close modal
    $("#closeQcModal").click(function () {
        $("#qc_remarks").val(""); // Clear remarks field
        // $("#qc_record_id").val(""); // Reset hidden ID field
        $("#qc_status").val(""); // Reset status field if needed
        $("#qcRemarksModal").modal("hide"); // Close the modal
    });
            });

    //         $('#verifyQcStatus').on('click', function () {
    //     updateQcStatus(1); // Set QC status to 1
    // });
  
// $('#verifyQcStatus').on('click', function() {
//             var id = $('#recordid').val();
//             var status = 'Verified';
//             var remarks = $('#qc_remarks').val();
//             updateQcStatus(id, status, remarks);
//             // updateQcStatus( status, remarks);
//         });

//         $('#notVerifyQcStatus').on('click', function() {
//             var id = $('#recordid').val();
//             var status = 'Not Verified';
//             var remarks = $('#qc_remarks').val();
//             updateQcStatus(id, status, remarks);
//             // updateQcStatus( status, remarks);
//         });
//     // Handle Not Verified Button Click
//     // $('#notVerifyQcStatus').on('click', function () {
//     //     updateQcStatus(0); // Set QC status to 0
//     // });

// function updateQcStatus(id, status, remarks) {
//         $.ajax({
//             url: '<?php echo base_url('quality/update_qc_status_check'); ?>',
//             type: "POST",
//             data: { 
//             id: id, 
//             status: status,
//              remarks: remarks 
//             },
//             // print_r(recordid); die;
//             dataType: "json",
//             success: function (response) {
//                 if (response.success) {
//                     alert(response.message); // Show success message
//                     $("#qcRemarksModal").modal("hide"); // Close modal

//                     // Dynamically update the button text in the table
//                     let button = $(".verify-btn[data-id='" + id + "']");
//                     button.text(status)
//                         .removeClass("btn-success btn-danger")
//                         .addClass(status === "Verified" ? "btn-success" : "btn-danger");


//                                  // Update the QC status and remarks in the table
//                                  $("#qc_status_" + id).text(status);
//                         $("#qc_remarks_" + id).text(remarks);

//                     // If using DataTables, reload to reflect changes
//                     if ($.fn.DataTable.isDataTable("#new_upload_table")) {
//                         $("#new_upload_table").DataTable().ajax.reload(null, false);
//                     }
//                 } else {
//                     alert("Error: " + response.message);
//                 }
//             },
//             error: function () {
//                 alert("Error updating QC status.");
//             }
//         });
//     }



//  // Handle Verified Button Click
 $('#verifyQcStatus').on('click', function () {
    var id = $('#recordid').val();
            var status = 'Verified';
            var remarks = $('#qc_remarks').val();
        updateQcStatus(1); // Set QC status to 1
    });

    // Handle Not Verified Button Click
    $('#notVerifyQcStatus').on('click', function () {
        updateQcStatus(0); // Set QC status to 0
    });

    // Function to Update QC Status via AJAX
    function updateQcStatus(status) {
        var id = $('#recordid').val();
        var remarks = $('#qc_remarks').val();

        $.ajax({
            url: "<?= base_url('quality/update_qc_status_check') ?>",
       
            type: "POST",                                                                                       
            data: { 
                id: id,
                status: status,
                remarks: remarks },
            success: function (response) {
                response = JSON.parse(response);
                if (response.success) {
                    var successToast = new bootstrap.Toast(document.getElementById('successToast'));
                    successToast.show();
                    // alert("QC Verified Successfully");
                    new_upload_month_list();
                
                // Close the modal
                $('#qcRemarksModal').modal('hide');

                }
                else {
                alert("Failed to update QC status.");
            }
               
            },
            error: function () {
                alert("AJAX request failed.");
            }
        });
    }





// function updateQcStatus1(status) {
//     var id = $('#recordid').val();
//     var remarks = $('#qc_remarks').val();

//     $.ajax({
//         url: "<?= base_url('quality/update_qc_status_check') ?>",
//         type: "POST",                                                                                       
//         data: { 
//             id: id,
//             status: status,
//             remarks: remarks 
//         },
//         success: function (response) {
//             response = JSON.parse(response);
//             if (response.success) {
//                 // Show SweetAlert2 toast notification
//                 Swal.fire({
//                     toast: true,
//                     position: 'top-end',
//                     icon: 'success',
//                     title: 'QC Verified Successfully',
//                     showConfirmButton: false,
//                     timer: 2000
//                 });

//                 // Refresh the data
//                 new_upload_month_list();
                
//                 // Close the modal
//                 $('#qcRemarksModal').modal('hide');
//             } else {
//                 Swal.fire({
//                     toast: true,
//                     position: 'top-end',
//                     icon: 'error',
//                     title: 'Failed to update QC status',
//                     showConfirmButton: false,
//                     timer: 2000
//                 });
//             }
//         },
//         error: function () {
//             Swal.fire({
//                 toast: true,
//                 position: 'top-end',
//                 icon: 'error',
//                 title: 'AJAX request failed',
//                 showConfirmButton: false,
//                 timer: 2000
//             });
//         }
//     });
// }


</script>