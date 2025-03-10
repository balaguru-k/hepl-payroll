<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

/**
* Excel dengan CI & Spout
*
*/
//load Spout Library

require_once APPPATH."third_party/excel_reader/box/spout/src/Spout/Autoloader/autoload.php";


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


class Hrbp extends CI_Controller {

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
        } else if (($this->session->userdata('role') != "HRBP")) {
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
	public function upload() {
		//documents
		$distributor = $this->masters_model->get_table_row_condition('users','role','DISTRIBUTOR');
		$data['distributor'] = $distributor;


		// $this->load->view('hrbp/dashboard', $data);
		$this->load->view('hrbp/upload', $data);

	}



	public function add_outlet() {
		ini_set('max_execution_time', '0');

		$month 		= $this->input->post('month', TRUE);
		$month  	= date('Y-m-01',strtotime($month));
		
		$data['document']	= '';


		$path = APPPATH. '../uploads/hrbp_doc/'.$this->session->userdata('id').'/';

		$hrbp_path = APPPATH. '../uploads/hrbp_doc/';

		if(!file_exists($hrbp_path)) {
			mkdir($hrbp_path);
		}

		if (!file_exists($path)) {
			mkdir($path);
		}

		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//$_FILES['uploadFile']['name'] = '';
	
		if (isset($_FILES['document']['name']) != '') {
			if (!$this->upload->do_upload('document')) {
				$error = array('error' => $this->upload->display_errors());
			}



	
			if (empty($error)) {
				$data = $this->upload->data();
                //echo "<pre>";print_r($data);exit;
                if (!empty($data['file_name'])) {
                    $import_xls_file = $data['file_name'];
                } else {
                    $import_xls_file = 0;
                }
   
                $spreadsheet = new Spreadsheet();
                $inputFileType = 'Xlsx';
                $inputFileName = $path . $import_xls_file;
   
 
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $worksheetData = $reader->listWorksheetInfo($inputFileName);

				$errorrecords = array();
				$errorcount = 0;
                
				$allErrors = [];
				$errorcount = 0;
				
				foreach ($worksheetData as $sheet) { 
					$tot_row = $sheet['totalRows'];
				
					for ($x = 1; $x <= $tot_row; $x++) {
						$spreadsheet = $reader->load($inputFileName);
						$sheet = $spreadsheet->getActiveSheet();
						$highestRow = $sheet->getHighestColumn();
				
						if ($x == 1) {
							if ($highestRow != 'U') {
								$this->session->set_flashdata('count_error', "Uploaded Excel is Not a Valid Format.");
								redirect(base_url('index.php/hrbp/upload'));
							}
				
							$emp_id = $sheet->getCell('A'.$x)->getFormattedValue();
							$canteen_recovery = $sheet->getCell('B'.$x)->getFormattedValue();
				
							if ($emp_id != 'Employee ID' || $canteen_recovery != 'CANTEEN RECOVERY') {
								$this->session->set_flashdata('count_error', "Uploaded Excel header not in valid format.");
								redirect(base_url('index.php/hrbp/upload'));
							}
				
							if ($tot_row == 1) {
								$this->session->set_flashdata('count_error', "There is no data in the excel.");
								redirect(base_url('index.php/hrbp/upload'));
							}
						} else {
							// Data Extraction
							$employee_id = str_replace('%', '', $sheet->getCell('A'.$x)->getFormattedValue());
							$lwd = $sheet->getCell('U'.$x)->getFormattedValue();
							// Set last_work_day to null if empty, else format the date
                            $last_work_day = !empty(trim($lwd)) ? date('Y-m-d', strtotime($lwd)) : null;
							// $last_work_day = date('Y-m-d',strtotime($lwd));
							//print_r($last_work_day);exit;
							
							$inserdata = [
								'payroll_date' => $month,
						        'created_by' => $this->session->userdata('id'),
								'employee_id' => $employee_id,
								'canteen_recovery' => str_replace('%', '', $sheet->getCell('B'.$x)->getFormattedValue()),
								'staff_sale_deductions' => str_replace('%', '', $sheet->getCell('C'.$x)->getFormattedValue()),
								'insurance_renewals' => str_replace('%', '', $sheet->getCell('D'.$x)->getFormattedValue()),
								'id_card_deduction' => str_replace('%', '', $sheet->getCell('E'.$x)->getFormattedValue()),
								'laptop_deduction' => str_replace('%', '', $sheet->getCell('F'.$x)->getFormattedValue()),
								'other_deduction' => str_replace('%', '', $sheet->getCell('G'.$x)->getFormattedValue()),
								'total_deduction' => str_replace('%', '', $sheet->getCell('H'.$x)->getFormattedValue()),
								'normal_overtime_hours' => str_replace('%', '', $sheet->getCell('I'.$x)->getFormattedValue()),
								'holiday_overtime_hours' => str_replace('%', '', $sheet->getCell('J'.$x)->getFormattedValue()),
								'lop_reversal' => str_replace('%', '', $sheet->getCell('K'.$x)->getFormattedValue()),
								'joining_bonus' => str_replace('%', '', $sheet->getCell('L'.$x)->getFormattedValue()),
								'incentive' => str_replace('%', '', $sheet->getCell('M'.$x)->getFormattedValue()),
								'incentive_remarks' => str_replace('%', '', $sheet->getCell('N'.$x)->getFormattedValue()),
								'ta_da' => str_replace('%', '', $sheet->getCell('O'.$x)->getFormattedValue()),
								'ta_da_remarks' => str_replace('%', '', $sheet->getCell('P'.$x)->getFormattedValue()),
								'retention_bonus' => str_replace('%', '', $sheet->getCell('Q'.$x)->getFormattedValue()),
								'other_earnings' => str_replace('%', '', $sheet->getCell('R'.$x)->getFormattedValue()),
								'other_earnings_remarks' => str_replace('%', '', $sheet->getCell('S'.$x)->getFormattedValue()),
								'total_earnings' => str_replace('%', '', $sheet->getCell('T'.$x)->getFormattedValue()),
								'last_work_day' => $last_work_day,
							

							];
				
							// Validation Rules
							$rowErrors = [];
				
							if (empty($employee_id)) {
								$rowErrors[] = "Employee ID should not be empty.";
							}
				
							$numericFields = [
								'canteen_recovery', 'staff_sale_deductions', 'insurance_renewals', 'id_card_deduction',
								'laptop_deduction', 'other_deduction', 'total_deduction', 'normal_overtime_hours',
								'holiday_overtime_hours', 'lop_reversal', 'joining_bonus', 'incentive', 'ta_da',
								'retention_bonus', 'other_earnings', 'total_earnings'
							];
				
							foreach ($numericFields as $field) {
								if (!empty($inserdata[$field]) && !ctype_digit($inserdata[$field])) {
									$rowErrors[] = ucfirst(str_replace('_', ' ', $field)) . " must be a number.";
								}
							}
				
							$textFields = ['incentive_remarks', 'ta_da_remarks', 'other_earnings_remarks'];
							foreach ($textFields as $field) {
								if (!empty($inserdata[$field]) && !preg_match('/^[a-zA-Z ]+$/', $inserdata[$field])) {
									$rowErrors[] = ucfirst(str_replace('_', ' ', $field)) . " must be text.";
								}
							}
				
							// If errors exist, add them to the array
							if (!empty($rowErrors)) {
								$errorcount++;
								$allErrors[] = ['employee_id' => $employee_id, 'errors' => implode('<br>', $rowErrors)];
							} else {
								$this->masters_model->insert_data('payroll', $inserdata);
							}
						}
					}
				}
				
				// If there are errors, display them in an HTML table
				if ($errorcount > 0) {
					$errorTable = "<h3>Validation Errors Found:</h3>";
					$errorTable .= "<table border='1' cellpadding='5' cellspacing='0'>";
					$errorTable .= "<tr><th>Employee ID</th><th>Errors</th></tr>";
				
					foreach ($allErrors as $error) {
						$errorTable .= "<tr><td>{$error['employee_id']}</td><td>{$error['errors']}</td></tr>";
					}
				
					$errorTable .= "</table>";
					$this->session->set_flashdata('count_error', $errorTable);
					redirect(base_url('index.php/hrbp/upload'));
				}
				
				// If no errors, save the file info
				if ($errorcount == 0) {
					$file_info = [
						'month' => $month,
						'doc_for' => 'salary_input',
						'created_by' => $this->session->userdata('id'),
						'document' => $data['file_name']
					];
					$this->masters_model->insert_data('tbl_files', $file_info);
				}
				


		
		
			}
		
	
		echo "<hr />";
		echo "Memory peak: " . memory_get_peak_usage() . "<br />";
		echo "Memory usage: " . memory_get_usage() . "<br />";
	
		$this->session->set_flashdata('message_other', ('Outlet File Upload Sucessfully!'));
		redirect(base_url('index.php/hrbp/upload'));
	}

		}	
	
	public function get_distributors_summary() {
		$start_date = $this->input->post('start_date', TRUE);
		$end_date = $this->input->post('end_date', TRUE);
		$sde_id = $this->input->post('sde', TRUE);
		//print_r($sde_id);exit;
		if($end_date){
			$start_date = date('Y-m-d',strtotime($start_date));
			$end_date = date('Y-m-d',strtotime($end_date));
		}else{
			$start_date = "";
			$end_date = "";
		}
		

		
        $data = array();
		
		$distributors_list = $this->masters_model->get_distributor_summary('tbl_outlet',$start_date,$end_date,$sde_id);

		//$distributors_list = $this->masters_model->get_distributor_summary('tbl_outlet');
		
		
		//print_r($distributors_list);exit;

        if ($distributors_list) {


			$html ='';
			
            $html .='
		<table id="summary_table_view" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th style="text-align:center; background:#dfc9c9;">#</th>
					<th style="text-align:center; background:#dfc9c9;">Distributors</th>
					<th style="text-align:center; background:#dfc9c9;">File Count</th>
					<th style="text-align:center; background:#cadfc9;">Type of Errors</th>
					<th style="text-align:center; background:#cadfc9;">Count</th>
					<th style="text-align:center; background:#cadfc9;">Completed</th>
					<th style="text-align:center; background:#cadfc9;">Pending</th>
				</tr>
			</thead>

			<tbody>';

            foreach ($distributors_list as $k => $val) {
				$k=$k+1;
				
				$username = $this->masters_model->get_username('users', $val['distributors']);
				
				$file_count = $this->masters_model->get_file_count('tbl_documents', $val['distributors']);
				$error_list = $this->masters_model->get_error_list('tbl_outlet', $val['distributors']);
				//print_r(count($error_list));exit;

				
				
				foreach ($error_list as $key => $err) {	

					$key=$key+1;

					$res_count = $this->masters_model->get_error_result_count('tbl_outlet', $err['result'],$val['distributors']);
					$completed_count = $this->masters_model->get_error_completed_count('tbl_outlet', $err['result'],$val['distributors']);
					$pending_count= $res_count['error_result_count']-$completed_count['error_completed_count'];
					if($key == 1){
						$html .= '<tr>
						<td style="padding:8px; vertical-align: middle;" rowspan="'.count($error_list).'">'.$k.'</td>
						<td style="padding:8px; vertical-align: middle;" rowspan="'.count($error_list).'">'.$username['username'].'</td>
						<td style="padding:8px; vertical-align: middle;" rowspan="'.count($error_list).'">'.$file_count['file_count'].'</td>
						<td style="padding:8px;">'.$err['result'].'</td> 
						<td style="padding:8px;">'.$res_count['error_result_count'].'</td>
						<td style="padding:8px;">'.$completed_count['error_completed_count'].'</td>';
						if($pending_count == 0){
							$html .= '<td style="padding:8px;"><span class="badge bg-success">Completed</span></td>';
						}else{

						$html .= '<td style="padding:8px;">'.$pending_count.'</td>';
						}

						$html .= '</tr>';
					}else{
						$html .= '<tr>
						<td style="padding:8px;">'.$err['result'].'</td> 
						<td style="padding:8px;">'.$res_count['error_result_count'].'</td>
						<td style="padding:8px;">'.$completed_count['error_completed_count'].'</td>';
						if($pending_count == 0){
							$html .= '<td style="padding:8px;"><span class="badge bg-success">Completed</span></td>';
						}else{

						$html .= '<td style="padding:8px;">'.$pending_count.'</td>';
						}
						$html .= '</tr>';
					}
					
					
					
					

				}
					
				
			
				
               
            }

			$html .= '</tbody>
			</table>';

            echo $html;
        } else {
			$html = '<tr><td colspan="4" align="center">No Records founds</td></tr>';
            echo $html;
        }
    }
	


	public function get_excel_export() {
		$start_date = $this->input->post('start_date', TRUE);
		$end_date = $this->input->post('end_date', TRUE);
		$sde_id = $this->input->post('sde', TRUE);
		//print_r($sde_id);exit;
		if($end_date){
			$start_date = date('Y-m-d',strtotime($start_date));
			$end_date = date('Y-m-d',strtotime($end_date));
		}else{
			$start_date = "";
			$end_date = "";
		}
		

		
        $data = array();
		
		$distributors_list = $this->masters_model->get_distributor_summary('tbl_outlet',$start_date,$end_date,$sde_id);

		//$distributors_list = $this->masters_model->get_distributor_summary('tbl_outlet');
		
		
		//print_r($distributors_list);exit;

		$fileName = 'distributor_outlet.xlsx';
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();


		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2f4395');
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);



		
       	$sheet->setCellValue('A1', 'Distributors');
        $sheet->setCellValue('B1', 'File Counts');
        $sheet->setCellValue('C1', 'Type of Errors');
        $sheet->setCellValue('D1', 'Count');
		$sheet->setCellValue('E1', 'Completed');
        $sheet->setCellValue('F1', 'Pending');  
		// $sheet->setCellValue('G1', 'Last Work Day');
		
		$rows = 2;
        foreach ($distributors_list as $k=>$val){

				$k=$k+1;
				
				$username = $this->masters_model->get_username('users', $val['distributors']);
				
				$file_count = $this->masters_model->get_file_count('tbl_documents', $val['distributors']);
				$error_list = $this->masters_model->get_error_list('tbl_outlet', $val['distributors']);
			
			foreach ($error_list as $key => $err) {	

				$key=$key+1;

				$res_count = $this->masters_model->get_error_result_count('tbl_outlet', $err['result'],$val['distributors']);
				$completed_count = $this->masters_model->get_error_completed_count('tbl_outlet', $err['result'],$val['distributors']);
				$pending_count= $res_count['error_result_count']-$completed_count['error_completed_count'];


				if($key == 1){

					$merge_row = $rows + count($error_list) - 1;
					//$merge_row = count($error_list);					
					$sheet->mergeCells('A'.$rows.':A'.$merge_row.''); 
					$sheet->getStyle('A'.$rows.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
					$sheet->mergeCells('B'.$rows.':B'.$merge_row.''); 
					$sheet->getStyle('B'.$rows.'')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
					// Set a title or label inside the merged cell
					$sheet->setCellValue('A' . $rows, $username['username']);
					$sheet->setCellValue('B' . $rows, $file_count['file_count']);
					$sheet->setCellValue('C' . $rows, $err['result']);
					$sheet->setCellValue('D' . $rows, $res_count['error_result_count']);
					$sheet->setCellValue('E' . $rows, $completed_count['error_completed_count']);
					$sheet->setCellValue('F' . $rows, $pending_count);
					// $sheet->setCellValue('G' .$rows, $val['last_work_day']);
				}else{
					$sheet->setCellValue('C' . $rows, $err['result']);
					$sheet->setCellValue('D' . $rows, $res_count['error_result_count']);
					$sheet->setCellValue('E' . $rows, $completed_count['error_completed_count']);
					$sheet->setCellValue('F' . $rows, $pending_count);
				}
					
					/* 
					<td style="padding:8px; vertical-align: middle;" rowspan="'.count($error_list).'">'.$username['username'].'</td>
					<td style="padding:8px; vertical-align: middle;" rowspan="'.count($error_list).'">'.$file_count['file_count'].'</td>
					<td style="padding:8px;">'.$err['result'].'</td> 
					<td style="padding:8px;">'.$res_count['error_result_count'].'</td>
					<td style="padding:8px;">'.$completed_count['error_completed_count'].'</td>';
					<td style="padding:8px;">'.$pending_count.'</td>


				}else{


				
					<td style="padding:8px;">'.$err['result'].'</td> 
					<td style="padding:8px;">'.$res_count['error_result_count'].'</td>
					<td style="padding:8px;">'.$completed_count['error_completed_count'].'</td>';
					<td style="padding:8px;">'.$pending_count.'</td>
				} */
				
				
				
				$rows++;

			}
			

           
			


            
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("uploads/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/uploads/".$fileName);  


		///////////////

    }
	


	public function get_other_upload_month_list() {
    $month = $this->input->post('month', TRUE);
    $data = array();

    // Convert month to a format that can be used for filtering
    $month = date('Y-m', strtotime($month));

    // Filter documents based on the selected month
	//$documents = $this->masters_model->get_table_row_with_two_condition('tbl_files','created_by',$this->session->userdata('id'),'doc_for','salary_input');
    $documents = $this->masters_model->get_documents_by_month_hrbp('tbl_files','created_by',$this->session->userdata('id'),'doc_for','salary_input', $month);

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
            $k = $k + 1;
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
}





	

	///
}
