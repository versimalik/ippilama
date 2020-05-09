<?php

class Usermodel extends  CI_Model {
	
	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
		
    }

	function __check($data){
	
		$username[$this->username] = isset($data[$this->username]) ? $data[$this->username] : '';
		$email[$this->email_user] = isset($data[$this->email_user]) ? $data[$this->email_user] : '';
			
		$check__[$this->username] = $this->__check_username($username);
		$check__[$this->email_user] = $this->__check_email($email);
		
		if(!empty($check__)) return $check__;
		
	}
	
	function __check_username($username){
		
		$this->db->where($username);
		$result = $this->db->get($this->table);
		
		if ($result->num_rows() > 0)
		{
		
			$err = 'Maaf Username Sudah Digunakan';
			return $err;
		
		}
	}
	
	
	function __check_email($email){
		
		$this->db->where($email);
		$result = $this->db->get($this->table);
		
		if ($result->num_rows() > 0)
		{
		
			$err = 'Maaf Email Sudah Digunakan';
			return $err;
		
		}		
	}


	function get_permission(){

		$query = $this->db->get('ws_permission');
		$result = $query->result_array();
		
		$_tmp = array();
		foreach ($result as $key => $val) {
			$_tmp[$val['ws_permission_id']] = $val['ws_permission_name'];		

		}

		if (!empty($result)){		
			return $_tmp;
		}
	}

	function get_permissionbyid($permission_id){
			
		$data = array( 'ws_permission_id' => $permission_id);
		
		$this->db->select('ws_permission_name');
		$this->db->where($data);
		$query = $this->db->get('ws_permission');	
		
		$result = $query->result_array();
		
		return $result;

	}

}

