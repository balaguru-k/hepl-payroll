
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
 
        //$('#toast-container').delay(5000).fadeOut('slow');
 
 
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
            });
 
            function get_other_upload_month_list(){
            //   alert(1);
            var date = $('#outlet_date_sel').val();
            // alert(month);
            var ajax_url = '<?php echo base_url(); ?>';
            $("#pageloader").fadeIn();
            $.ajax({
            url: ajax_url + 'index.php/hrbp/get_other_upload_month_list',
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
        $('#month_filter_hrbp').on('change', function () {
            get_other_upload_month_list();
        });

        // Initial load
        get_other_upload_month_list();
    });

    $('.sucess_container').delay(5000).fadeOut('slow');

    $('#emp_month').datepicker({
        autoclose: true,
    });

    function get_other_upload_month_list() {
        var month = $('#month_filter_hrbp').val();
        var ajax_url = '<?php echo base_url(); ?>';
        $("#pageloader").fadeIn();
        $.ajax({
            url: ajax_url + 'index.php/hrbp/get_other_upload_month_list',
            data: {month: month},
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


    $(document).ready(function () {
    $('#month_filter_hrbp').datepicker({
        format: "MM yyyy",
        minViewMode: 1,
        autoclose: true
    });
});

$(document).ready(function () {
    $('#month').datepicker({
        format: "MM yyyy",
        minViewMode: 1,
        autoclose: true
    });
});

function downloadBlob(filename) {
    fetch('<?php echo base_url("index.php/hrbp/get_sample_blob/"); ?>' + filename)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const blob = new Blob([Uint8Array.from(atob(data.data), c => c.charCodeAt(0))]);
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = data.filename;
            a.click();
            URL.revokeObjectURL(url);
        } else {
            alert('Sample file not found');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error downloading sample file');
    });
}
</script>