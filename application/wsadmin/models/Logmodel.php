<?php

class Logmodel extends CI_Model {
	
	public $table = 'ws_log';
	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
				
    }
	
	function insertLog($param_log){
						
		$table = $this->table ? $this->table : '';	
		$username = $param_log['username'] ? $param_log['username'] : '';					
		$status = $param_log['status'] ? $param_log['status'] : '';
		$description = $param_log['description'] ? $param_log['description'] : '';
		$newdate = date('Y-m-d H:i:s');
		$timestamp = time();
							
		$data = array('ws_log_date_create' => $newdate
						,'ws_log_timestamp' => $timestamp
						,'ws_log_username' => $username
						,'ws_log_status' 	=> $status
						,'ws_log_description' => $description
				);			
						
						
		return $this->db->insert($table, $data); 
		
	}
	

}


