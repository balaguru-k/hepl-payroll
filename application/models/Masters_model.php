<?php

class Masters_model extends CI_Model {

    public function importData($table, $data) {

        $res = $this->db->insert_batch($table, $data);
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function verifyUser($array, $table) {
        $this->db->where($array);
        $records = $this->db->get($table)->row_array();
        return $records;
    }

    function verify_data($array, $table) {
        $this->db->where($array);
        $records = $this->db->get($table);
        return $records->result();
    }

    function role_exists1($array, $var, $table) {
        $this->db->where($array);
        $this->db->select('*');
        $this->db->group_by($var);
        $query = $this->db->get($table);
//        $query1 =  $query->num_rows();
        return $query->result();
    }

    function get_table($table) {
        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }


    function DISTINCT_table($col, $table) {
        $this->db->select($col);
        $this->db->distinct();
        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

   

    function get_table_row_condition($table, $col, $id) {
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        $query->row_array();
        // echo $this->db->last_query(); exit;
        //return $query->row_array();

        return $query->result_array();
    }

    function get_table_row($table, $col, $id) {
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        $query->row_array();
        //echo $this->db->last_query(); exit;
        return $query->row_array();
    }

    function insert_data($table, $data) {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        // echo $this->db->last_query();exit;
        return $last_id;
    }

    function get_table_row_with_two_condition($table, $col, $id, $col2, $id2) {
        $this->db->where($col, $id);
        $this->db->where($col2, $id2);
        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
        //return $query->row_array();
        return $query->result_array();
    }
    

    function updates($table, $data, $col, $id = '') {
        $this->db->where($col, $id);
        $this->db->update($table, $data);
        //echo $this->db->last_query(); exit;
        return true;
    }

    function updates_one_condition($table, $data, $col, $id) {
        $this->db->where($col, $id);
        $this->db->update($table, $data);
        //echo $this->db->last_query(); exit;
        return true;
    }
    
    function updates_two_condition($table, $data, $col, $id, $col2, $id2) {
        $this->db->where($col, $id);
        $this->db->where($col2, $id2);
        $this->db->update($table, $data);
        //echo $this->db->last_query(); exit;
        return true;
    }

    function format_mdy($date, $sub = '.') {//20.05.2021
        if (empty($date)) {
            return '';
        } else if ($date == 'Cancelled') {
            return '';
        } else {
            $d = explode($sub, $date);
            return $d[2] . '-' . $d[1] . '-' . $d[0];
        }
    }

    function get_table_last_row($table) {
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;

        return $query->row_array();

        // return $query->result_array();
    }

    function get_last_id($table) {
        
        $this->db->select('id as id');
		$query = $this->db->get($table);
		// echo $this->db->last_query(); exit;
		$result = $query->row_array();
		//$result = $result['id'];
		if ($result) {
            return $result;
        } else {
            return 0;
        }

    }

    
    function get_username($table,$id) {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
       // echo $this->db->last_query(); exit;
        return $query->row_array();
    }

    function get_result_count($table,$col,$id) {
        $this->db->select('count(id) as count_result');
        $this->db->where($col, $id);
        $query = $this->db->get($table);
       // echo $this->db->last_query(); exit;
        return $query->row_array();
    }
    
    function get_result_group($table,$file_id){
        $this->db->select('result');
        $this->db->distinct('result');
       $this->db->where('file_id', $file_id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_table_hrbp_other_file_month($table,$user_id,$doc_for) {
        $this->db->where('created_by', $user_id);
        $this->db->where('doc_for', $doc_for);
       // $this->db->like('createddate', $month, 'after');
        $query = $this->db->get($table);
        return $query->result_array();
    }
    
  /*   function get_outlet_summery($table,$date){
        $this->db->select('result,count(result) as count,count(id) as total');
        $this->db->distinct('result');
        $this->db->where('date', $date);
        $query = $this->db->get($table);
        echo $this->db->last_query(); exit;
        return $query->result_array();
    } */

   /*  function get_outlet_summary($table, $date) {
        $this->db->select('result, COUNT(result) as count, COUNT(*) as total');
        $this->db->where('date', $date);
        $this->db->group_by('result'); // Add GROUP BY
        $query = $this->db->get($table);
        echo $this->db->last_query(); // For debugging the SQL query
        return $query->result_array();
    } */

    public function get_documents_by_month($table, $col, $id, $month,$hrbp_id) {
       
        if($hrbp_id != "ALL"){
            $this->db->where('created_by', $hrbp_id);
        } 
        $this->db->where($col, $id);
        $this->db->like('month', $month);
        $query = $this->db->get($table);
       // echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    public function get_all_documents_by_month($table, $month,$hrbp_user_id) {
       if($hrbp_user_id!= "ALL"){
           $this->db->where('created_by', $hrbp_user_id);
       } 
        $this->db->like('payroll_date', $month, 'after');
        $query = $this->db->get($table);
      // echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    function get_documents_by_month_hrbp($table, $col, $id, $col2, $id2,$month) {
        $this->db->where($col, $id);
        $this->db->where($col2, $id2);
        $this->db->like('month', $month, 'after');
        $query = $this->db->get($table);
       // echo $this->db->last_query(); exit;
        //return $query->row_array();
        return $query->result_array();
    }
    
    function get_outlet_summary($table,$sde) {
        // Get grouped result and count
        $this->db->select('result, COUNT(result) as count');
        $this->db->group_by('result');
        $grouped_query = $this->db->get($table);
        $grouped_result = $grouped_query->result_array();
    
        // Get total count of rows for the date
        $this->db->select('COUNT(*) as total');
        $total_query = $this->db->get($table);
        $total_result = $total_query->row_array();
        $this->db->select('file.*, file_id, result, COUNT(result) as count,
            SUM(CASE WHEN confirmation IS NOT NULL THEN 1 ELSE 0 END) as completed_count');
        $this->db->join('tbl_documents as file', 'file.ticket_id = file_id', 'left');
        $this->db->where('tbl_outlet.distributor', $sde);

        $this->db->group_by(['file_id', 'result']);
       // $this->db->where('sde', $sde);
        $grouped_query_by_file = $this->db->get($table);
        $grouped_result_by_file = $grouped_query_by_file->result_array();

        $final_grouped_by_file = [];
         //echo $this->db->last_query(); // For debugging the SQL query

        foreach ($grouped_result_by_file as $row) {
        $file_id = $row['file_id'];

        // Initialize file_id structure
        if (!isset($final_grouped_by_file[$file_id])) {
        $final_grouped_by_file[$file_id] = [
        'file' => $row['document'],
        'results' => [],
        ];
        }

        $final_grouped_by_file[$file_id]['results'][] = [
        'result' => $row['result'],
        'count' => $row['count'],
        'completed' => $row['completed_count'],
        ];

        }
                // Add total count to the response
                return [
                    'grouped' => $grouped_result,
                    'grouped_by_file' => $final_grouped_by_file,
                    'total' => $total_result['total']
                ];
    }

    function get_outlet_summary_list($table, $result,$file_id){
       // $this->db->where('confirmation', NULL);
        if($result != "ALL"){
            $this->db->where('result', $result);
        }
        if($file_id != null){
            $this->db->where('file_id', $file_id);
        }
        $query = $this->db->get($table);
       // echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function get_file_count($table,$dis_id){
        $this->db->select('count(id) as file_count');
        $this->db->where('distributor', $dis_id);
         $query = $this->db->get($table);
        // echo $this->db->last_query(); exit;
         return $query->row_array();
     }
    
    function get_error_list($table,$dis_id){
        $this->db->select('count(result) as result_count,result');
        $this->db->where('distributor', $dis_id);
        $this->db->group_by('result');
         $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
         return $query->result_array();
     }

     function get_error_result_count($table,$error,$dis_id){
        $this->db->select('count(id) as error_result_count');
        $this->db->where('distributor', $dis_id);
        $this->db->where('result', $error);
       // $this->db->group_by('result');
         $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
         return $query->row_array();
     }

     function get_error_completed_count($table,$error,$dis_id){
        $this->db->select('count(id) as error_completed_count');
        $this->db->where('distributor', $dis_id);
        $this->db->where('result', $error);
        $this->db->where('confirmation !=', null);
       // $this->db->group_by('result');
         $query = $this->db->get($table);
        //echo $this->db->last_query(); exit;
         return $query->row_array();
     }
     
     function get_distributors_array($table,$sde){
        $this->db->where('sde_id', $sde);
         $query = $this->db->get($table);
        // echo $this->db->last_query(); exit;
         return $query->result_array();
     }
    function get_distributor_summary($table,$start_date,$end_date,$sde){
        $this->db->select('distributor as distributors');
         if($end_date != ""){
            $this->db->group_start();
            $this->db->where('date(created_date) >=', $start_date);
            $this->db->where('date(created_date) <=', $end_date);
            $this->db->group_end();
        }
        if($sde != "ALL"){
            $this->db->where('sde', $sde);
        } 
        $this->db->group_by('distributor');
         $query = $this->db->get($table);
        // echo $this->db->last_query(); exit;
         return $query->result_array();
     }
    

     function get_sde_summary($table){
        $this->db->select('sde as sde');
       /*  if($end_date){
            $this->db->group_start();
            $this->db->where('date(created_date) >=', $start_date);
            $this->db->where('date(created_date) <=', $end_date);
            $this->db->group_end();
        }
        if($sde != "ALL"){
            $this->db->where_in('sde', $sde);
        } */
        $this->db->group_by('sde');
         $query = $this->db->get($table);
        // echo $this->db->last_query(); exit;
         return $query->result_array();
     }

    function get_uploaded_distributor($table){
        $this->db->select('COUNT(distributor) as distributor_count');
        $this->db->group_by('distributor');
         $query = $this->db->get($table);
        // echo $this->db->last_query(); exit;
         return $query->result_array();
     }
    
    

    function get_last_row($condition, $order, $table){
        $this->db->where($condition);
        $this->db->order_by($order);
        $query = $this->db->get($table);
        // print_r($query);
        return $query->row(); // Return single row object
    }

    public function update_qc_status($id, $data) {
        
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('payroll');
        return $this->db->affected_rows() > 0;
        // if ($this->db->affected_rows() > 0) {
        //     return array("success" => true, "message" => "QC Status updated successfully.");
        // } else {
        //     return array("success" => false, "message" => "Failed to update QC Status.");
        // }
        // echo $this->db->last_query();
        // return $this->db->affected_rows() > 0;
    }

    
    




}
