<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background:none;">

    <div class="h-100">

        <!-- <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="<?php echo asset_url(); ?>images/users/avatar2.png" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">
                <a href="javascript: void(0);" class="text-dark fw-medium font-size-16"><?php echo $this->session->userdata('username'); ?></a>
                <p class="text-body mt-1 mb-0 font-size-13"><?php echo $this->session->userdata('role'); ?></p>

            </div>
        </div> -->

        <!--- Sidemenu -->
        <div id="sidebar-menu" class="mm-active">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled mm-show" id="side-menu" style="height:30px;">
              


                <?php if ($this->session->userdata('status') == "6"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/hrbp_files" class="btn btn-primary waves-effect hrbp_files">
                                <span>Uploaded Files</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/users" class="btn btn-primary waves-effect users">
                                <span>Distributors List</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/product_files" class="btn btn-primary waves-effect product_files">
                                <span>Products</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/product_mapping" class="btn btn-primary waves-effect updated_products">
                                <span>Product Mapping</span>
                            </a>
                        </li>
                    <?php } ?>


                   <!--  <?php if ($this->session->userdata('status') == "1"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/users" class="btn btn-primary waves-effect users">
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/paysheet_api" class="btn btn-primary waves-effect paysheet_api">
                                <span>Paysheet API Upload</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->session->userdata('status') == "2"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hrss/employee" class="btn btn-primary waves-effect employee">
                                <span>Home</span>
                            </a>
                        </li>
                    <?php } ?>-->

                    <?php if ($this->session->userdata('status') == "3"){  ?>
                        <!-- <li>
                            <a href="<?php echo base_url(); ?>index.php/cia/Dashboard" class="btn btn-primary waves-effect other_upload">
                                <span>Dashboard</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/cia/upload" class="btn btn-primary waves-effect upload">
                                <span>File Upload</span>
                            </a>
                        </li> 
                    <?php } ?>

                   <!-- <?php if ($this->session->userdata('status') == "4"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/business_finance/add_cost_center" class="btn btn-primary waves-effect add_cost_center">
                                <span>New Employee CC allocation</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/business_finance/existing_cost_center_home" class="btn btn-primary waves-effect existing_cost_center_home">
                                <span>Existing Employee CC allocation</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($this->session->userdata('status') == "5"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/it_hr/employee_master" class="btn btn-primary waves-effect employee_master">
                                <span>Employee Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/it_hr/cost_center_master" class="btn btn-primary waves-effect cost_center_master">
                                <span>Cost Center Master</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/it_hr/activity" class="btn btn-primary waves-effect activity">
                                <span>Activity</span>
                            </a>
                        </li>
                        
                    <?php } ?>

                    <?php if ($this->session->userdata('status') == "6"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/new_employee" class="btn btn-primary waves-effect new_employee">
                                <span>New Employee</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/salary_inputs_home" class="btn btn-primary waves-effect salary_inputs_home">
                                <span>Salary In puts (Allowance & Deductions)</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/hold_release_salary_home" class="btn btn-primary waves-effect hold_release_salary_home">
                                <span>Hold / Release Salary</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/lop_reversal_approval_home" class="btn btn-primary waves-effect lop_reversal_approval_home">
                                <span>LOP / Reversal approval</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/hrbp_files" class="btn btn-primary waves-effect hrbp_files">
                                <span>HRBP Other Inputs</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/tmo_files" class="btn btn-primary waves-effect tmo_files">
                                <span>TMO Inputs</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/hr_payroll/paysheet_reco" class="btn btn-primary waves-effect paysheet_reco">
                                <span>Paysheet Reco</span>
                            </a>
                        </li>
                        
                    <?php } ?>

                    <?php if ($this->session->userdata('status') == "8"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/new_employee" class="btn btn-primary waves-effect new_employee">
                                <span>New Employee</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/finance_payroll" class="btn btn-primary waves-effect finance_payroll">
                                <span>Finance Payroll</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/hrss" class="btn btn-primary waves-effect hrss">
                                <span>HRSS</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/hrbp" class="btn btn-primary waves-effect hrbp">
                                <span>HRBP</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/business_finance" class="btn btn-primary waves-effect business_finance">
                                <span>Business Finance</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/hr_payroll" class="btn btn-primary waves-effect hr_payroll">
                                <span>HR Payroll</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/tmo_files" class="btn btn-primary waves-effect tmo_files">
                                <span>TMO Inputs</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/quality_check/paysheet_reco" class="btn btn-primary waves-effect paysheet_reco">
                                <span>Paysheet Reco</span>
                            </a>
                        </li>
                        
                    <?php } ?>

                    <?php if ($this->session->userdata('status') == "7"){  ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/new_employee" class="btn btn-primary waves-effect new_employee">
                                <span>New Employee</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/new_employee_cc" class="btn btn-primary waves-effect new_employee_cc">
                                <span>New Employee CC Allocation</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/existing_employee_cc" class="btn btn-primary waves-effect existing_employee_cc">
                                <span>Existing Employee CC Allocation</span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/hrss" class="btn btn-primary waves-effect hrss">
                                <span>HRSS</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/hrbp" class="btn btn-primary waves-effect hrbp">
                                <span>HRBP</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/business_finance" class="btn btn-primary waves-effect business_finance">
                                <span>Business Finance</span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/paysheet_reco" class="btn btn-primary waves-effect paysheet_reco">
                                <span>Paysheet Reco</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/loan_mis" class="btn btn-primary waves-effect loan_mis">
                                <span>Loan MIS</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/finance_payroll/upload_file" class="btn btn-primary waves-effect upload_file">
                                <span>Upload File</span>
                            </a>
                        </li>

                        
                        
                    <?php } ?> -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->