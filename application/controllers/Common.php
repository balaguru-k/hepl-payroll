<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('masters_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('javascript');
        $this->load->library('email');
//		session_start();
        $session_data = sessionData();
        $data['session_data'] = $session_data;
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');
        } 
    }

   public function change_password() {
		$this->load->view('common/change_password');
	}
    public function change_password_fnf() {
		$this->load->view('common/change_password_fnf');
	}
	
	public function change_pass() {
		$this->form_validation->set_rules('new_pass', 'New Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('common/change_password');
        } else {
			
			 $id=$this->session->userdata('id');
			 $new_pass = $this->input->post('new_pass', TRUE);
			 $confirm_pass = $this->input->post('confirm_pass', TRUE);
			 if(!strcmp($new_pass, $confirm_pass))
			 {
				 $data['password'] = md5($new_pass);
				 $this->masters_model->updates('users', $data, 'id' , $id);
				 $this->session->set_flashdata('message', ('Password has been Changed!'));
				 
			 }
			 else { 
			 $this->session->set_flashdata('error', ('Password Mismatch!'));
			 }
			
            
            redirect(base_url('index.php/common/change_password'));

            $this->load->view('common/change_password');
        }
    }

    ///////////////////
}
