<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('loginmodel');
		
	}

	public $module = 'login';
	public $table = 'ws_user_foo';
	public $name = 'ws_user_name';
	public $username = 'ws_user_username';
	public $password = 'ws_user_password';
	public $email_user = 'ws_user_email';
	public $key = 'ws_user_key';


	function index(){
		$this->login();
	}

	function login($err=null){
		
		$ws_data['error'] = isset($err) ? $err : '';
		$param['body'] = $this->load->view('login/body', $ws_data, true);
		echo $this->load->view('login/template', $param, true);
	
	}

	function login_proses(){
		
		$this->form_validation->set_rules('username', 'USERNAME', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('password', 'PASSWORD', 'trim|required|alpha_numeric');
		
		if ($this->form_validation->run() == TRUE){
			
			$param['username'] = $this->security->xss_clean($this->input->post('username', TRUE));
			$param['password'] = $this->security->xss_clean($this->input->post('password', TRUE));
			$param['table'] = $this->table;
			
			$result = $this->loginmodel->check_user($param);
			
			if(isset($result) && $result == 1){
				
				$getdetil = $this->loginmodel->getUserdetail(array('username' => $param['username'], 'table' => $this->table));
				
				$this->session->set_userdata('username', $getdetil);
								
				//Insert Log
				$get_user = $this->session->userdata('username');
				$param_log = array();
				$param_log['username'] = $get_user['ws_user_username'];
				$param_log['status'] = 'Login';
				$param_log['description'] = 'Name : '.$get_user['ws_user_username'];
				$this->logmodel->insertLog($param_log);
				//end insert log
				
				redirect('../'.url_admin().'dashboard','refresh');
				
			}else if($result == 2){
				
				$err[] = '<span class="error">Member Belum Active</span>';
			
			}else{
				
				$err[] = '<span class="error">Login Tidak Valid</span>';
			}
			
			
		}else{
			
			$err[] = form_error('username', '<span class="error">', '</span>');
			$err[] = form_error('password', '<span class="error">', '</span>');
			
		}
		
		if(isset($err) && $err != '') $this->login($err);
	
	}
	
	function process_logout(){
		
		$ses_name = $this->session->userdata('username');
		$this->loginmodel->__lastLogout($ses_name[$this->username]);
		
		//Insert Log
		$get_user = $this->session->userdata('username');
		$param_log = array();
		$param_log['username'] = $get_user['ws_user_username'];
		$param_log['status'] = 'Logout';
		$param_log['description'] = 'Name : '.$get_user['ws_user_username'];
		$result = $this->logmodel->insertLog($param_log);
		//end insert log
		
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('../'.url_admin().'login', 'refresh');
	
	}
	
	function forgotpassword(){
		
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
				
		if ($this->form_validation->run() == TRUE){
			
			$param[$this->email_user] = $this->security->xss_clean($this->input->post('email', TRUE));
			$result = $this->loginmodel->check_email_forgot($param);
			
			if($result['status'] == true){
				
				$param['type'] = 'forgot'; 
				$param[$this->key] = $result[$this->key];
				$param[$this->name] = $result[$this->name];
				$param[$this->username] = $result[$this->username];
				$_result_ = $this->__viewEmail($param);
			
				$err = $_result_;
				
			}else{
				
				$err[] = $result['err'];
				
			}
			
		}else{
			
			$err[] = form_error('email', '<span class="error">', '</span>');
		
		}
		
		if(isset($err) && $err != '') $this->login($err);
	
	}
	
	
	function resetpassword($key = null, $err = null){
		
		if(!isset($key)) redirect('../admin.php/'.$this->module.'/forgotpassword', 'refresh');
		
		$reset_box['post'] = $this->module.'/proses_resetpassword/';
		$reset_box['keyuser'] = isset($key) ? $key : '';
		
		$param['keyuser'] = isset($key) ? $key : '';
		$param['reset_box'] = $this->load->view('blocks/reset_box',  $reset_box, true);
		$param['error'] = isset($err) ? $err : '';
		
		echo $this->template($param);
		
	}
	
}
