<?php

defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

/**
 * Excel dengan CI & Spout
 *
 */
//load Spout Library

require_once APPPATH . "third_party/excel_reader/box/spout/src/Spout/Autoloader/autoload.php";


use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

//lets Use the Spout Namespaces
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


//use PhpOffice\PhpSpreadsheet\IOFactory;

//require_once  APPPATH."third_party/PHPExcel.php";
//require_once  APPPATH."third_party/PHPExcel/IOFactory.php";


//load phpmailer Library
/*require_once APPPATH."third_party/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;*/
//load phpmailer Library


class Quality extends CI_Controller
{

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
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url(), 'refresh');
		} else if (($this->session->userdata('role') != "QUALITY_CHECK")) {
            log_message('debug', 'User role is not QUALITY_CHECK');
			redirect(base_url(), 'refresh');
		}
	}

	/* public function upload() {
		   //documents
		   $distributor = $this->masters_model->get_table_row_condition('users','role','DISTRIBUTOR');
		   $data['distributor'] = $distributor;
			   
		   $this->load->view('hrbp/upload', $data);
	   }
	*/
	public function quality_check()
	{
		//documents
		$distributor         = $this->masters_model->get_table_row_condition('users', 'role', 'DISTRIBUTOR');
		$data['distributor'] = $distributor;

		// $this->load->view('hrbp/dashboard', $data);
		$this->load->view('quality/quality_check', $data);

	}





	public function get_other_upload_month_list()
	{
		$hrbp_id = $this->input->post('hrbp_id', TRUE);
		$month   = $this->input->post('month', TRUE);
		$data    = array();

		// Convert month to a format that can be used for filtering
		$month = date('Y-m-01', strtotime($month));

		// Filter documents based on the selected month
		$documents = $this->masters_model->get_documents_by_month('tbl_files', 'doc_for', 'salary_input', $month, $hrbp_id);
		if ($hrbp_id == 'ALL') {
			if ($documents) {
				$html = '  <table id="other_upload_table" class="table table-striped table-bordered dt-responsive nowrap"
				style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th>Si.No</th>
						<th>File Name</th>
						<th>Download</th>
						
						<th>Created by</th>
						<th>Created Date</th>
					</tr>
				</thead>
				<tbody>';

				foreach ($documents as $k => $val) {
					$k        = $k + 1;
					$username = $this->masters_model->get_username('users', $val['created_by']);

					$html .= '<tr>
					<td>' . $k . '</td>
					<td title="' . $val['document'] . '">' . substr($val['document'], 0, 35) . '</td>
					<td><a href="' . base_url('uploads/hrbp_doc/' . $this->session->userdata('id') . '/' . $val['document']) . '"  class="btn btn-success waves-effect waves-light">Download</a></td>					
					<td>' . $username['username'] . '</td>
					<td>' . date("d-m-Y h:i:s a", strtotime($val['created_at'])) . '</td>
					</tr>';
				}
				$html .= '</tbody>
				</table>';

				echo $html;
			} else {
				$html = '<tr><td colspan="6" align="center">No Records found</td></tr>';
				echo $html;
			}
		} else {
			if ($documents) {
				$html = '  <table id="other_upload_table" class="table table-striped table-bordered dt-responsive nowrap"
			style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th>Si.No</th>
					<th>File Name</th>
					<th>Download</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

				foreach ($documents as $k => $val) {
					$k        = $k + 1;
					$username = $this->masters_model->get_username('users', $val['created_by']);

					$html .= '<tr>
				<td>' . $k . '</td>
				<td title="' . $val['document'] . '">' . substr($val['document'], 0, 35) . '</td>
				<td><a href="' . base_url('uploads/hrbp_doc/' . $this->session->userdata('id') . '/' . $val['document']) . '"  class="btn btn-success waves-effect waves-light">Download</a></td>
				
				<td>' . date("d-m-Y h:i:s a", strtotime($val['created_at'])) . '</td>
				</tr>';
				}
				$html .= '</tbody>
			</table>';

				echo $html;
			} else {
				$html = '<tr><td colspan="6" align="center">No Records found</td></tr>';
				echo $html;
			}
		}
	}


	public function get_all_other_upload_month_list()
	{
		$month        = $this->input->post('month', TRUE);
		$hrbp_user_id = $this->input->post('hrbp_user_id', TRUE);

		$data = array();

		// // Convert month to a format that can be used for filtering
		$month = date('Y-m-01', strtotime($month));


		// Filter documents based on the selected month
		$documents1 = $this->masters_model->get_all_documents_by_month('payroll', $month, $hrbp_user_id);

			if ($documents1) {
				$html = '<table id="new_upload_table" class="table table-striped table-bordered dt-responsive nowrap"
			style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr><th>Si.No</th>
				
						<th>Employee ID</th>
						<th>Canteen Recovery</th>
						<th>Staff Sale Deductions</th>
						<th>Insurance Renewals</th>
						<th>ID Card Deduction</th>
						<th>Laptop Deduction</th>
						<th>Other Deduction</th>
						<th>Total Deduction</th>
						<th>Normal Overtime Hours</th>
						<th>Holiday Overtime Hours, Double Wages</th>
						<th>LOP Reversal</th>
						<th>Joining Bonus</th>
						<th>Incentive</th>
						<th>Incentive Remarks</th>
						<th>TA/DA</th>
						<th>TA/DA Remarks</th>
						<th>Retention Bonus</th>
						<th>Other Earnings</th>
						<th>Other Earnings Remarks</th>
						<th>Total Earnings</th>
						<th>Last Work Day</th>
						<th>Created By</th>
						<th>Payroll Date</th>
						<th>Created At</th>
						<th>QC Status</th>
						<th>QC Remarks</th>
					
						
						
				</tr></thead><tbody>';


				

				foreach ($documents1 as $k => $val) {

					$a        = $a + 1;
					$username = $this->masters_model->get_username('users', $val['created_by']);
					$html .= '<tr>
					 
										<td>' . $a . '</td>
										
										<td>' . $val['employee_id'] . '</td>
										<td>' . $val['canteen_recovery'] . '</td>
										<td>' . $val['staff_sale_deductions'] . '</td>
										<td>' . $val['insurance_renewals'] . '</td>
										<td>' . $val['id_card_deduction'] . '</td>
										<td>' . $val['laptop_deduction'] . '</td>
										<td>' . $val['other_deduction'] . '</td>
										<td>' . $val['total_deduction'] . '</td>
										<td>' . $val['normal_overtime_hours'] . '</td>
										<td>' . $val['holiday_overtime_hours'] . '</td>
										<td>' . $val['lop_reversal'] . '</td>
										<td>' . $val['joining_bonus'] . '</td>
										<td>' . $val['incentive'] . '</td>
										<td>' . $val['incentive_remarks'] . '</td>
										<td>' . $val['ta_da'] . '</td>
										<td>' . $val['ta_da_remarks'] . '</td>
										<td>' . $val['retention_bonus'] . '</td>
										<td>' . $val['other_earnings'] . '</td>
										<td>' . $val['other_earnings_remarks'] . '</td>
										<td>' . $val['total_earnings'] . '</td>
										<td>'.$val['last_work_day'].'</td>
										<td>' . $username['username'] . '</td>
										<td>' . $val['payroll_date'] . '</td>
										<td>' . $val['created_at'] . '</td>	
									    <td>'; 
										if ($val['qc_status'] != 1) {
											$html .= '<button class="btn btn-success verify-btn" data-id="' . $val['id'] . '">Verify</button>';
										}else{
											$html .= '<span class="badge badge-soft-success font-size-12">Verified</span>';
										}
                                        $html .= '</td> 
										
									
								        <td id="qc_remarks_' . $val['id'] . '">' . $val['qc_remarks'] . '</td>

									
                                  

                			 </tr>';
				}

				$html .= '</tbody>
			</table>';

				echo $html;
			} else {
				$html = '<tr><td colspan="6" align="center">No Records found</td></tr>';
				echo $html;


			}
	


	}

	

public function update_qc_status_check()
{
    // Load model

    $id = $this->input->post('id');
    $status = $this->input->post('status');
    $remarks = $this->input->post('remarks');


   
    // Update the database
    $update_data = array(
        'qc_status' => $status,
        'qc_remarks' => $remarks
    );
	//  // Debugging: Print SQL Query and Data
	//  $this->db->where('id', $id);
	//  $this->db->set($update_data);
	//  $this->db->update('payroll');
	

    $result = $this->masters_model->update_qc_status($id, $update_data);
	// echo $this->db->last_query();
	// print_r($result);die;
    if ($result) {
        echo json_encode(['status' => true, 'message' => 'QC Status updated successfully!']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update QC Status.']);
    }
}




}
///

