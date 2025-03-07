<?php include('application/views/partials/main.php'); ?>

<head>

    <?php include('application/views/partials/title-meta.php'); ?>
</head>
<link href="<?php echo asset_url(); ?>libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo asset_url(); ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo asset_url(); ?>libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<style>
    .dtr-title {
        width: 200px;
    }

    .dtr-data {
        float: right;
    }

    #pageloader {
        background: rgba(255, 255, 255, 0.8);
        display: none;
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

    .navbar-header {
        background-color: #6524b8;
    }

    body[data-layout=detached] #layout-wrapper::before {
        background: -webkit-gradient(linear, left top, right top, from(#6a2cbb), to(#6524b8)) !important;

    }

    .consolidated-button {
        background-color: #6524b8 !important;
        color: white !important;
        border-color: #6524b8 !important;
    }

    .page-item.active .page-link {
        color: #fff;
        background-color: #6524b8 !important;
        border-color: #6a2cbb;
    }
</style>
<!-- DataTables -->
<link href="<?php echo asset_url(); ?>libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo asset_url(); ?>libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />

<link href="<?php echo asset_url(); ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">


<!-- Responsive datatable examples -->
<link href="<?php echo asset_url(); ?>libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />

<!-- Sweet Alert-->
<link href="<?php echo asset_url(); ?>libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<?php include('application/views/partials/head-css.php'); ?>



</head>
<?php include('application/views/partials/body.php'); ?>

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
        <div id="toast-container" style="position:fixed; left:45%; top:30px;"
            class="alert alert-success alert-dismissible fade show" role="alert">
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
            <div class="modal fade" id="add_bulk_employee_modal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Consortium report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="polite" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                QC Verified Successfully
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>


                        <div class="modal-body">
                             <div id="qcMessage"></div>
                            <div class="table-responsive" style="overflow:unset">
                                <table class="" style="margin-left: 200px;">


                                    <tr>

                                        <td>
                                            <div class="row">
                                                <div class="col-lg-2" style="text-align: center; width: 100px;">
                                                    <div class="mb-3 ">
                                                        <div
                                                            style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#4c2fbf!important">
                                                            Month</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4" style="width: 200px;">
                                                    <div class="position-relative" id="datepicker40">
                                                        <?php $month = date('F Y'); ?>
                                                        <input type="text" name="month" id="month_payroll_model"
                                                            class="form-control" data-provide="datepicker"
                                                            data-date-format="MM yyyy"
                                                            data-date-container="#datepicker40"
                                                            data-date-min-view-mode="1" value="<?php echo $month; ?>"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <div class="row p-6 ">
                                                <div class="col-lg-2" style="text-align: center; width: 100px;">
                                                    <div class="mb-3 ">
                                                        <div
                                                            style="text-transform: uppercase; padding-top:7px; font-weight: 600; font-size: 16px!important; color:#4c2fbf!important">
                                                            HRBP</div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 " style="width: 300px;">
                                                    <div class="position-relative" id="distributor"
                                                        style="width: 300px;">
                                                        <select class="form-control" id="hrbp_user_select"
                                                            style="width: 300px;">
                                                            <option value="ALL" selected>ALL</option>
                                                            <?php
                                                            $users = $this->masters_model->get_table_row_condition('users', 'role', 'HRBP');

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
                                <div class="card-body" id="new_upload_tabledata"> </div>
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
                        <div class="row g-3 align-items-center p-3">
                            <div class="col-12 col-sm-6 col-md-1 col-lg-1 col-xl-1 text-md-end text-center">
                                <label class="fw-bold text-primary text-uppercase">Month</label>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 ">
                                <div class="position-relative" id="datepicker4">
                                    <?php $month = date('F Y'); ?>
                                    <input type="text" name="month" id="month_out" class="form-control"
                                        data-provide="datepicker" data-date-format="MM yyyy"
                                        data-date-container="#datepicker4" data-date-min-view-mode="1"
                                        value="<?php echo $month; ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-1 col-lg-1 col-xl-1  text-md-end text-center">
                                <label class="fw-bold text-primary text-uppercase">HRBP</label>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
                                <select class="form-control select2" id="hrbp_select">
                                    <option value="ALL">ALL</option>
                                    <?php
                                    $users = $this->masters_model->get_table_row_condition('users', 'role', 'HRBP');
                                    foreach ($users as $val) {
                                        echo '<option value="' . $val['id'] . '">' . $val['username'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 text-center ">
                                <button type="button" class="btn btn-success" id="consolidated_modal"
                                    data-bs-toggle="modal" data-bs-target="#add_bulk_employee_modal">consolidated table
                                    view</button>
                            </div>
     <!-- Modal for QC Remarks -->
     <div class="modal fade" id="qcRemarksModal" tabindex="-1" role="dialog" aria-labelledby="qcRemarksModalLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qcRemarksModalLabel">Enter QC Remarks</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">
                    <textarea id="qc_remarks" class="form-control" rows="4"></textarea>
                    <input type="hidden" id="recordid">
                      <!-- <input type="hidden" id="employee_id"> -->
                    <!-- <input type="hidden" id="qc_status"> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeQcModal">Close</button>
                    <!-- <button type="button" class="btn btn-primary" id="saveQcRemarks">Save</button> -->
                    <button type="button" class="btn btn-success" id="verifyQcStatus">Verified</button>
                    <!-- <button type="button" class="btn btn-danger" id="notVerifyQcStatus">Not Verified</button> -->
                </div>
            </div>
        </div>
    </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body" id="other_upload_month"></div>
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
<?php
include('application/views/partials/vendor-scripts.php');
?>
<?php
include('application/views/partials/script/qualityscript.php');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>