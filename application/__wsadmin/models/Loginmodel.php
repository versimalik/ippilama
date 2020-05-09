<?php

class Loginmodel extends  CI_Model {
	
	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->config('ws_login');
		$this->field_detail = $this->config->item('field_detail');
		
	}

	public $table = 'ws_user_foo';
	public $username = 'ws_user_username';
	public $password = 'ws_user_password';
	public $email = 'ws_user_email';
	// public $accces = 'ws_user_access';
	public $login = 'ws_user_last_login';
	public $logout = 'ws_user_last_logout';
	public $key = 'ws_user_key';
	
	
	function getUserdetail($param){
		
		$field = implode(',', $this->field_detail);
			

		$table = isset($param['table']) ? $param['table'] : $this->table;
		$username = isset($param['username']) ? $param['username'] : '';
		
		$this->db->select($field);
		$query = $this->db->get_where($table, array($this->username => $username), 1, 0);
		$result = $query->result_array();
		
		if(!empty($result)){
			
			$this->__lastLogin($username);
			return $result[0];
						
		}
		
	}
	
	function check_user($param)
	{
		$table = isset($param['table']) ? $param['table'] : $this->table;
		$username = isset($param['username']) ? $param['username'] : '';
		$password = isset($param['password']) ? $param['password'] : '';
		
		$query = $this->db->get_where($table, array($this->username => $username), 1, 0);
		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			
			if($data[0]['ws_user_status'] != 1) return 2 ;
			
			$data[0]['password'] = isset($param['password']) ? $param['password'] : '';
			$pass = $this->__encrypt_password($data);
			$check_pass = $this->__check_password($this->table, $pass);
			
			if($check_pass > 0){
			
				$result = TRUE;
			
			}else{
				
				$result = FALSE;
			
			}
			
		}
		else
		{
		
			$result = FALSE;
			
		}
	
		return $result;
	
	}
	
	
	function check_email_forgot($email){
		
		$this->db->where($email);
		$query = $this->db->get($this->table);
		$result = $query->result_array();
		
		if(empty($result)){
			
			$__result['status'] = false;
			$__result['err'] = 'Maaf Email Anda Belum Terdaftar';
			return $__result;
			
		}else{
			
			$__result['status'] = true;
			$__result['user_key'] = $result[0]['user_key'];
			$__result['user_name'] = $result[0]['user_name'];
			$__result['user_username'] = $result[0]['user_username'];
			
			return $__result;
		}
				
	}
	
	
	function check_key_forgot($key, $password){
		
		$this->db->where($key);
		$query = $this->db->get($this->table);
		$result = $query->result_array();
		
		if(!empty($result)){
			
			$data[0][$this->email] = $result[0][$this->email];
			$data[0][$this->username] = $result[0][$this->username];
			$data[0]['password'] = $password;
			$encryp = $this->__encrypt_password($data);
			if(!empty($encryp)){
				
				$field_id = $this->key;
				$id_where = $key[$this->key];
				$param[$this->password] = $encryp;
							
				$update = $this->__update_user($field_id, $id_where, $param);
				if(!empty($update)){
					$__result['success'] = 'Reset Password Success'; 
				}
				
			}
			
		}else{
			
			$__result['err'] = 'Maaf Reset Password Gagal, Silahkan Coba Lagi';
			
		}
		
		return $__result;
		
	}
	
	
	function __update_user($field_id, $id_where, $param){
		
		$this->db->where($field_id, $id_where);
		$result = $this->db->update($this->table, $param);
		
		return $result;
		
	}
	
	function __check_password($table, $password){
		
		$table = isset($table) ? $table : $this->table;
		$query = $this->db->get_where($table, array($this->password => $password, 'ws_user_status' => '1'), 1, 0);
		
		if ($query->num_rows() > 0)
		{
			
			$result = TRUE;
		
		}else{
		
			$result = FALSE;

		}
		
		return $result;
	}
	
	function __encrypt_password($data){
		
		$email = isset($data[0][$this->email]) ? $data[0][$this->email] : '';
		$username = isset($data[0][$this->username]) ? $data[0][$this->username] : '';
		$password = isset($data[0]['password']) ? $data[0]['password'] : '';
		
		$_encrypt = md5($username.'----'.$email);
		$_encrypt_email = md5($email.$_encrypt.'--wawan_setiawan--'.$password);
		$_encrypt_username = md5($username.$_encrypt.'--wawan_setiawan--'.$password);
		$_encrypt__ = md5($_encrypt.$_encrypt_email.$_encrypt_username.'--wawan_setiawan--'.$password);
		
		return $_encrypt__;
	
	
	}
	
	function __lastLogin($username){
		
		$data = array($this->login => date("Y-m-d H:i:s"));
		$this->db->where($this->username, $username);
		$this->db->update($this->table, $data); 
		
	}
	
	function __lastLogout($username){
		
		$data = array($this->logout => date("Y-m-d H:i:s"));
		$this->db->where($this->username, $username);
		$this->db->update($this->table, $data); 
		
	}
	
}

