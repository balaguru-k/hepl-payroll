<?php
function asset_url(){
   return base_url().'assets/';
}
function asset_url1(){
    return base_url().'assets1/';
}
function asset_url2(){
    return base_url().'assets2/';
}
function is_loggedin() {
    $CI = & get_instance();  //get instance, access the CI superobject
    $isLoggedIn = $CI->session->userdata('logged_in');
    if( empty($isLoggedIn) ) {
        redirect('users', 'refresh');
    }
}
function sessionData()
{
    $CI = &get_instance();  //get instance, access the CI superobject
    $isLoggedIn = $CI->session->userdata('logged_in');
    if ($isLoggedIn) {
        return $isLoggedIn;
    }
}
