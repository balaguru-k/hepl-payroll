<!-- Bootstrap Css -->
<link href="<?php echo asset_url(); ?>css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo asset_url(); ?>css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo asset_url(); ?>css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

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

    #toast-container{z-index:99999;}
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

    .position-relative input::placeholder { /* Most modern browsers support this now. */
    color:#eff2f7!important;
    opacity: 0.5;
    }

    #sidebar-menu {
    padding-bottom: 0px!important;
  }
  .vertical-menu{min-width:100%; max-width:100%;}
 
.metismenu li {
    display: block;
    width: auto;
    float: left;
    margin-right: 3px;
    margin-bottom: 5px;
}
#sidebar-menu ul li a {
    display: block;
    /* padding: 0.625rem 1.5rem; */
    color: #fff;
    position: relative;
    font-size: 14.4px;
    -webkit-transition: all .4s;
    transition: all .4s;
}
.mm-active .active {
    color: #ccc!important;
}
.page-title-box .page-title {
    color: #304495!important;
}
.btn-primary.active{
  background-color: #eeb902;
    border-color: #eeb902;
    
}
.btn-primary.active span{color:#fff;}

@media only screen and (max-width: 991px) {
    .metismenu li {
      display: block;
      width: 100%;
      float: left;
      margin-right: 8px;
      margin-bottom: 5px;
    }
    .page-title-box .page-title {
      color: #fff!important;
      line-height: 30px !important;
    }
 
  

}

@media only screen and (min-width: 992px) {
  .page-title-box {
      padding-bottom: 0px !important;
  }
   
}



  </style>