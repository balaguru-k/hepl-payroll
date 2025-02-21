<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('masters_model');
		$this->load->helper(array('form', 'html', 'file', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('javascript');
		$this->load->library('email');
		//		session_start();
		$session_data         = sessionData();
		$data['session_data'] = $session_data;
	}

	public function index()
	{

		$this->load->view('login');


	}

	public function doLogin()
	{


		//$session_data = sessionData();
		//$data['session_data'] = $session_data;
		$this->form_validation->set_rules('user_id', 'user id', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', ('Enter user id and password'));
			redirect(base_url());
			//$this->load->view('login');
		} else {
			$array['emp_id']   = $this->input->post('user_id');
			$array['password'] = md5($this->input->post('pass'));
			$result            = $this->masters_model->verifyUser($array, 'users');
			//echo "<pre>"; print_r($array); exit;

			if ($result) {
				//echo "<pre>"; print_r($result); exit;

				$this->session->set_userdata('result', $result);
				$this->session->set_userdata('logged_in', TRUE);
				$this->session->set_userdata('role', $result['role']);
				$this->session->set_userdata('username', $result['username']);
				$this->session->set_userdata('emp_id', $result['emp_id']);
				$this->session->set_userdata('status', $result['status']);
				$this->session->set_userdata('id', $result['id']);
				if (($this->session->userdata('role') == 'PAYROLL') && ($this->session->userdata('status') == '4')) {
					redirect(base_url('index.php/payroll/payroll_view'));
				} else if (($this->session->userdata('role') == 'HRBP') && ($this->session->userdata('status') == '3')) {

					redirect(base_url('index.php/hrbp/upload'));
				}
				else if (($this->session->userdata('role') == 'ADMIN') && ($this->session->userdata('status') == '1')) {

					redirect(base_url('index.php/Admin/admin_view'));
				} else {
					$this->session->set_flashdata('message', ('You Are Not Allowed'));
					redirect(base_url());
				}


			} else {
				$this->session->set_flashdata('message', ('Username / Password Invalid'));
				redirect(base_url());
			}
		}
	}





	public function logout()
	{
		//unset the logged_in session and redirect to login page
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('emp_id');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('id');

		redirect(base_url());
	}
}