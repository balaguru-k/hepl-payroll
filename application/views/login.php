<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <title>Outlet tracker Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Outlet tracker Login" name="Outlet" />
    <meta content="Outlet tracker Login" name="author" />
    <!-- App favicon -->
    <link rel="icon" href="<?php echo asset_url(); ?>images/favicon.jpg" type="image/gif" sizes="16x16">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
  	.table{ color:#000;}
    .table-striped>tbody>tr:nth-of-type(odd) {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: #000;
    }
    body{color:#000;}
    .form-control {color:#000;}
    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {color:#000;}
    .page-link{color:#000;}


    ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:#000!important;
    }
    :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:#000!important;
    opacity:  1!important;
    }
    ::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:#000!important;
    opacity:  1!important;
    }
    :-ms-input-placeholder { /* Internet Explorer 10-11 */
    color:#000!important;
    }
    ::-ms-input-placeholder { /* Microsoft Edge */
    color:#000!important;
    }

    ::placeholder { /* Most modern browsers support this now. */
    color:#000!important;
    }

    
  </style>

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50 mb-0">Sign in to continue to Outlet Tracker.</p>
                                <a href="/" class="logo logo-admin mt-4">
                                    <img src="assets/images/logo-sm-dark.png" alt="logo-sm-dark" height="30">
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-5">
                            <div class="p-2">
                            <form name="login" id="login" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/LoginController/doLogin'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" name="user_id" id="user_id"  placeholder="Enter username" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter password" required>
                                    </div>

                                   <!--  <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customControlInline">
                                        <label class="form-check-label" for="customControlInline">Remember
                                            me</label>
                                    </div> -->

                                    <div class="mb-3">
                                        
                                        <!-- start: alert Message -->
                                        <?php $message = $this->session->flashdata('message'); ?>
                                       
                                        <?php if (!empty($message)): ?>
                                            <div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                                            <i class="mdi mdi-alert-outline label-icon"></i> <?php echo $message; ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            
                                        <?php endif; ?>
                                        <!-- start: alert Message --> 
                                        
                                                
                                    </div>


                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>

                                   <!--  <div class="mt-4 text-center">
                                        <a href="pages-recoverpw" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                    </div> -->
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <!-- <p>Don't have an account ? <a href="pages-register" class="fw-medium text-primary"> Signup now </a> </p> -->
                       <!--  <p>&copy; <script>
                                document.write(new Date().getFullYear())
                            </script> HR Payroll. Crafted with <i class="mdi mdi-heart text-danger"></i> by Hema's
                        </p> -->
                    </div>

                </div>
            </div>
        </div>
    </div>


        <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>


</html>