<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('querymodel');
		$this->load->model('searchmodel');
		
		$this->load->config('ws_generic', true);
		$this->__config_beneric = $this->config->item('ws_generic');
		
		$this->load->config('ws_user', true);
		$this->__config = $this->config->item('ws_user');
		
		
	}
	
	/** field insert mysql */
	public $path_pict = '/user/'; //name path picture
	public $module = 'user'; //name module
	public $table = 'ws_user_foo'; //name table
	public $date_create = 'ws_date_create';
	public $date_update = 'ws_date_update';
	public $id = 'ws_user_id';
	public $username = 'ws_user_username';
	public $password = 'ws_user_password';
	public $email_user = 'ws_user_email';
	public $status = 'ws_user_status';
	public $name = 'ws_user_name';
	public $login = 'ws_user_last_login';
	public $key = 'ws_user_key';
	public $access = 'ws_user_acces';
	
	public $permission_id = 'ws_permission_id';
	public $permission_name = 'ws_permission_name';
	
	public $page = 10;
	public $breadcumb = array('User', 'List User'); //name module
	public $id_menu = 2; 

	/** end field insert mysql */
	
	function index($null = null, $page = null){
		
		$offset = !empty($page) ? $this->page * ($page - 1) : 0;
		$this->user($offset, $page);
		//$this->insert();
	
	}
	
	function user($offset, $page){
				
		// if($this->session->userdata('username') == FALSE) login_page(); //cek session
		
		$ses_name = $this->session->userdata('username');
		if($ses_name['ws_user_acces'] == TRUE) error_page();
		
		if(isset($page) && !empty($page)) $ws_result['row'] = no_record($param = array($this->page, $page));
	
		//pagging
		$config['base_url'] = base_url(url_admin().$this->module.'/page');
		$config['total_rows'] = $this->querymodel->count_all_num_rows($this->table);
		$config['per_page'] = $this->page;
		$config['first_url'] = '1';
				
		$config['use_page_numbers'] = TRUE;
		
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '<li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '<li>';
		
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="javascrip::void();">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';


		$this->pagination->initialize($config);
		
		$ws_result['pagination'] = $this->pagination->create_links();
		
		
		$ws_result['data'] = $this->querymodel->queryRecord($this->page, $offset, $this->table);
		
		$ws_result['head_title'] = array('No'
								,'Date Create'
								,'Name'
								,'Email'
								,'<center>User Access</center>'
								,'<center>Status</center>'
								,'<center>Last Login</center>'
								,'Edit'
								,'<center>'.checkall_box().'</center>'
							);



		$forms['block_form'] = $this->load->view('module/user/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
	}
	
	function add($data = null, $err = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		isset($data[$this->username]) ?  $username = $data[$this->username]  : '' ;
		isset($data[$this->password]) ? $password = $data[$this->password] : '' ;
		isset($data[$this->email_user]) ? $email = $data[$this->email_user] : '' ;
		isset($data[$this->permission_id]) ? $permission_id = $data[$this->permission_id] : '' ;
		isset($data[$this->status]) ? $status = $data[$this->status] : '' ;
		
		$form['post'] = '/insert/post';
		$form['title'] = 'Post New User';
		$form['form'] = array(
					'module' => $this->module
					
					,'name' => input_box(array('id' => $this->name
												,'placeholder'=>"name"
												,'class' => 'validate[required] col-xs-10 col-sm-10'
												,'name'	=> $this->name
												,'value'	=> set_value($this->name, isset($name_user) ? $name_user : '')), $label = 'Name *')
					
					,'email' => input_box(array('id' => $this->email_user
												,'placeholder'=>"email"
												,'class' => 'validate[required,custom[email]] col-xs-10 col-sm-10'
												,'name'	=> $this->email_user
												,'value'	=> set_value($this->email_user, isset($email_user) ? $email_user : '')), $label = 'Email *')
					
					,'username' => input_box(array('id' => $this->username
													,'placeholder'=>"username"
													,'class' => 'validate[required,minSize[4]] col-xs-10 col-sm-10'
													,'name'	=> $this->username
					 								,'value'	=> set_value($this->username, isset($username) ? $username : '')), $label = 'Username *')

					,'password' => input_box(array('id' => $this->password
													,'placeholder'=>"password"
													,'type'=>"password"
													,'class' => 'validate[required,minSize[6]] col-xs-10 col-sm-10'
													,'name' => $this->password
					 								,'value'	=> isset($password) ? $password : ''), $label = 'Password *')
													
					,'passconfirm' => input_box(array('id' => 'passwordconf'
														,'placeholder'=>"password confirm"
														,'type'=>"password"
														,'class' => 'validate[required,equals['.$this->password.']] col-xs-10 col-sm-10'
														,'name' => 'passwordconf'
					 									,'value'	=> isset($passconfirm) ? $passconfirm : ''), $label = 'Password Confirm *')
					
					,'permission' => option_box($name = $this->permission_id
												,$this->usermodel->get_permission()
												,isset($_POST[$this->permission_id]) ? $_POST[$this->permission_id] : ''
												,'Permission')

					,'option_box' => option_box($name = $this->status
												,array('No Active', 'Active')
												,isset($_POST[$this->status]) ? $_POST[$this->status] : ''
												,'Status')

					,'button' => button(array('value' => 'true'
												,'type' => 'submit'
												,'class' => 'btn btn-xs btn-primary submit'
												,'content' => '<i class="ace-icon fa fa-check bigger-110"></i>&nbsp;Submit'
											)
					)
					
				);
		
		$form['err'] = isset($err) ? $err : '';
		$view = 'right/form';
		$forms['block_form'] = $this->load->view('module/user/block_form', $form, true);
		
		echo $this->template($forms, $view);
		
	}
	
	function insert($post = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		if(!empty($post) && $post == 'post'){
			
			$this->form_validation->set_rules($this->name, 'Name', 'trim|required');
			$this->form_validation->set_rules($this->email_user, 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules($this->username, 'Username', 'trim|required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules($this->password, 'Password', 'trim|required|matches[passwordconf]|min_length[6]');
			$this->form_validation->set_rules('passwordconf', 'Password Confirm', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$date_create = time();
				$name = $this->security->xss_clean($this->input->post($this->name, TRUE));
				$username = $this->security->xss_clean($this->input->post($this->username, TRUE));
				$password = $this->security->xss_clean($this->input->post($this->password, TRUE));
				$email = $this->security->xss_clean($this->input->post($this->email_user, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
				$permission_id = $this->security->xss_clean($this->input->post($this->permission_id, TRUE));
				
				$field['field'] = array();
				
				if(!empty($date_create)) $data[$this->date_create] = $date_create;
				if(!empty($name)) $data[$this->name] = $name;
				if(!empty($username)) $data[$this->username] = $username;
				if(!empty($password)) $data[$this->password] = $password;
				if(!empty($email)) $data[$this->email_user] = $email;
				if(!empty($permission_id)) $data[$this->permission_id] = $permission_id;
				if(!empty($status)) $data[$this->status] = ($status == 'status') ? '0' : $status;
				$data[$this->permission_id] = $permission_id;
				$data_id = $this->id;
				
				// echo'<pre/>'; print_r($data); die(); 

				// check username & email
				$__check = $this->__check($data);
				if (!empty($__check[$this->username])) $err = $__check;
				if (!empty($__check[$this->email_user])) $err = $__check;
				
				if (empty($__check[$this->username]) && empty($__check[$this->email_user])){	
					
					$data[$this->password] = $this->__encrypt_password($data); //create password
					$data[$this->key] = $this->__user_key($data); //user key
										
					if(!empty($data)) $success = $this->querymodel->insertRecord($data, $data_id, $this->table); 
					
					if(isset($success)) {
						
						//send email
						$data[$this->password] = $password; 
						$this->__viewEmail($data);
						
						//Insert Log
						// $get_user = $this->session->userdata('username');
						// $param_log = array();
						// $param_log['username'] = $get_user['user_username'];
						// $param_log['status'] = 'ADD '.$this->module;
						// $param_log['description'] = 'Name: '.$get_user['user_name'];
						// $this->logmodel->insertLog($param_log);
						//end insert log
												
						$this->session->set_flashdata('message', 'Add '.$this->module.' Success');
						redirect('../'.url_admin().$this->module.'/add');
					}
				
				}
			
			}else{
			
				$err[] = form_error($this->name, '<span class="error">', '</span>');
				$err[] = form_error($this->username, '<span class="error">', '</span>');
				$err[] = form_error($this->password, '<span class="error">', '</span>');
				$err[] = form_error($this->email_user, '<span class="error">', '</span>');
			
			}
			
		}
		
		$setval = isset($data) ? $data : '';
		$err = isset($err) ? $err : '';
		$this->add($setval, $err);
	}
	
		
	function edit($field_id=null, $data = null, $err = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$ses_name = $this->session->userdata('username');
		if(($ses_name['ws_user_username'] != $field_id) && ($ses_name['ws_user_acces'] == TRUE)) redirect(base_url('error'), 'refresh'); //cek session
		
		$result = $this->querymodel->editRecord(array($this->username => $field_id), $this->table);
							
		$username = isset($result[0][$this->username]) ? $result[0][$this->username] : '';
		$name_user = isset($result[0][$this->name]) ? $result[0][$this->name] : '';
		$email_user = isset($result[0][$this->email_user]) ? $result[0][$this->email_user] : '';
		$permission_id = isset($result[0][$this->permission_id]) ? $result[0][$this->permission_id] : '';
		$status = isset($result[0][$this->status]) ? $result[0][$this->status] : '';
		

		$form['update'] = '/update';
		$form['field_id']['id'] = array('name' => $this->id, 
								  'value' => $result[0][$this->id]);
		$form['field_id']['username'] = array('name' => $this->username, 
								  'value' => $result[0][$this->username]);
		$form['title'] = 'Edit User';
		$form['form'] = array(
					'module' => $this->module

					,'name' => input_box(array('id' => $this->name
												,'placeholder'=>"name"
												,'class' => 'validate[required] col-xs-10 col-sm-10'
											 	,'name'	=> $this->name
												,'value' => isset($name_user) ? $name_user : ''), $label = 'Name *')
					
					,'email' => input_box(array('id' => $this->email_user
												,'placeholder'=>"email"
												,'class' => 'validate[required,custom[email]] col-xs-10 col-sm-10'
												,'name'	=> $this->email_user
												,'value' => isset($email_user) ? $email_user : ''), $label = 'Email *')
					
					
					,'username' => input_box_hidden(array('id' => ''
															,'class' => 'col-xs-10 col-sm-10'
															,'disabled' => 'disabled'
															,'placeholder' => $username
															,'value' => isset($username) ? $username : ''), $label = 'Username *')
					
					
					,'password' => input_box(array('id' => $this->password
													,'placeholder'=>"password"
													,'type'=>"password"
													,'class' => 'col-xs-10 col-sm-10'
													,'name'	=> $this->password
													,'value' => isset($password) ? $password : ''), $label = 'Password')
													
					
					,'passconfirm' => input_box(array('id' => 'passwordconf'
													,'placeholder'=>"password confirm"
													,'type'=>"password"
													,'class' => 'col-xs-10 col-sm-10'
													,'name'	=> 'passwordconf'
													,'value' => isset($passconfirm) ? $passconfirm : ''), $label = 'Password Confirm')
					
					,'permission' => option_box($name = $this->permission_id
												,$this->usermodel->get_permission()
												,isset($permission_id) ? $permission_id : ''
												,'Permission')

					,'option_box' => option_box($name = $this->status
												,array('No Active', 'Active')
												,isset($status) ? $status : ''
												,'Status')
					,'button' => button(array('value' => 'true'
												,'type' => 'submit'
												,'class' => 'btn btn-xs btn-primary submit'
												,'content' => '<i class="ace-icon fa fa-check bigger-110"></i>&nbsp;Edit'
											))
					,'cancel' => button(array('value' => 'true'
												,'type' => 'button'
												,'class' => 'btn btn-xs btn-success submit'
												,'content' => '<i class="ace-icon fa fa-reply bigger-110"></i>&nbsp;Cancel'
											))
				);
		

		$form['err'] = isset($err) ? $err : '';
		$view = 'right/form';
		$forms['block_form'] = $this->load->view('module/user/block_form', $form, true);

		echo $this->template($forms, $view);
		
	}
	
	function update(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
		
		if(isset($field_id) && !empty($field_id)){
			
			$this->form_validation->set_rules($this->name, 'NAME', 'trim|required');
			$this->form_validation->set_rules($this->username, 'USERNAME', 'trim|required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules($this->password, 'PASSWORD', 'trim|matches[passwordconf]|min_length[6]');
			$this->form_validation->set_rules('passwordconf', 'PASSWORD CONFIRM', 'trim');
			$this->form_validation->set_rules($this->email_user, 'EMAIL', 'trim|required|valid_email');
			
			if ($this->form_validation->run() == TRUE){
			
				$name = $this->security->xss_clean($this->input->post($this->name, TRUE));
				$username = $this->security->xss_clean($this->input->post($this->username, TRUE));
				$password = $this->security->xss_clean($this->input->post($this->password, TRUE));
				$email = $this->security->xss_clean($this->input->post($this->email_user, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
				$permission_id = $this->security->xss_clean($this->input->post($this->permission_id, TRUE));
				$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
				
				if($status != 'status') {
					$data[$this->status] = $status;
				}
				
				$field['field'] = array();
				
				if(!empty($date_update)) $data[$this->date_update] = time();
				if(!empty($name)) $data[$this->name] = $name;
				if(!empty($username)) $data[$this->username] = $username;
				if(!empty($password)) $data[$this->password] = $password;
				if(!empty($email)) $data[$this->email_user] = $email;
				if(!empty($status)) $data[$this->status] = $status;
				if(!empty($field_id)) $data[$this->id] = $field_id;
				$data[$this->permission_id] = $permission_id;
				$data_id = $this->id;
				
				// check username & email
				$__check = ''; //$this->__check($data);
				if (!empty($__check[$this->username])) $err = $__check;
				if (!empty($__check[$this->email_user])) $err = $__check;
				
				if (empty($__check[$this->username]) && empty($__check[$this->email_user])){	
					
					if(!empty($password)){
						$data[$this->password] = $this->__encrypt_password($data);//create password
						$data[$this->key] = $this->__user_key($data); //user key
					}

					if(!empty($data)) $success = $this->querymodel->updateRecord($data, $data_id, $this->table); 	
										
					if(isset($success)) {
					
						//Insert Log
						// $get_user = $this->session->userdata('username');
						// $param_log = array();
						// $param_log['username'] = $get_user['user_username'];
						// $param_log['status'] = 'EDIT '.$this->module;
						// $param_log['description'] = 'Name: '.$get_user['user_name'];
						// $this->logmodel->insertLog($param_log);
						//end insert log
					
						$this->session->set_flashdata('message', 'Edit '.$this->module.' Success');
						redirect('../'.url_admin().$this->module.'/edit/'.$username);
					}
				
				}
			}else{
				
				$username = $this->security->xss_clean($this->input->post('hidden_username', TRUE));
				$err[] = form_error($this->name, '<span class="error">', '</span>');
				$err[] = form_error($this->password, '<span class="error">', '</span>');
				$err[] = form_error($this->email_user, '<span class="error">', '</span>');
			}
			
		}
		
		// echo'<pre/>'; print_r($err); die(); 

		$setval = isset($data) ? $data : '';
		$err = isset($err) ? $err : '';
		$this->edit($username, $setval, $err);
		
	}
	
	
	function delete(){
	
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		$del = $this->security->xss_clean($this->input->post('del', TRUE));
		
		if(isset($del)){
		
			foreach($del as $key => $val){
				
				$ex = explode(',',$val);
				$id_d[] = $ex[0];

				if(isset($result)){
					//Insert Log
					// $get_user = $this->session->userdata('username');
					// $param_log = array();
					// $param_log['username'] = $get_user['user_username'];
					// $param_log['status'] = 'DELETE '.$this->module;
					// $param_log['description'] = 'Name: '.$ex[1];
					// $this->logmodel->insertLog($param_log);
					//end insert log
				}
			}
			
			$result = $this->querymodel->deleteRecordNoImage($id_d, $this->table);
				
			if(isset($result)){
				$this->session->set_flashdata('message', 'Delete Success');
				redirect('../'.url_admin().$this->module);
			}
		}
		return $this->index();
	}
	
	function template($form, $view){
		
		$data_ex['module'] = $this->module; 
		// $form['search'] = $this->load->view('module/global/search', array(), true);
		
		$wsdata['css_load'] = $this->load->view('module/global/load_css', $data_ex, true);
		$wsdata['js_load'] = $this->load->view('module/global/load_js', $data_ex, true);
		
		$param_l = array('id_menu' => $this->id_menu);
		$wsdata['block_left'] =	$this->load->view('module/global/block_left', $param_l, true);
		$wsdata['block_head'] = $this->load->view('module/global/block_head', array(), true);
		$wsdata['block_content'] = $this->load->view('module/global/block_content', $form, true);
		
		return $this->load->view('module/home/template', $wsdata, true);
	
	}
	
	function search(){
		
		$q = $this->security->xss_clean($this->input->get_post('q', TRUE)); //keyword
		$p = $this->security->xss_clean($this->input->get_post('p', TRUE)); //page
		$s = $this->security->xss_clean($this->input->get_post('s', TRUE)); //status
		$s = ($s=='all') ? '' : $s;
		
		$offset = !empty($p) ? $this->page * ($p - 1) : 0;
		$param = $this->__config['field_search'];
		echo'<pre/>'; print_r($param); die(); 

		$limit  = array('page' => $this->page, 'offset' => $offset);
		$keyword  = array('q' => $q, 'status' => isset($s) ? $s : '');
		$url = base_url(url_admin().$this->module.'/search?q='.$q.'&s='.$s);
		
		if(isset($offset) && !empty($offset)) $result['row'] = no_record(array($this->page, $p));
		
		$ws_result['data'] = $this->searchmodel->search_limit_data($param, $keyword, $limit, $this->table);
		
		$ws_result['head_title'] = array('No'
								,'Date Create'
								,'Name'
								,'Email'
								,'<center>User Access</center>'
								,'<center>Status</center>'
								,'<center>Last Login</center>'
								,'Edit'
								,'<center>'.checkall_box().'</center>'
							);

		//pagging
		$config['base_url'] = $url;
		$config['total_rows'] = $this->searchmodel->search_limit_count($param, $keyword, $this->table);
		$config['per_page'] = $this->page;
		
		/* tambahan */
		$config['enable_query_strings'] = FALSE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		$config['first_url'] = $url.'&p=1';
		
		$config['use_page_numbers'] = TRUE;

		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '<li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '<li>';
		
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="javascrip::void();">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$ws_result['pagination'] = $this->pagination->create_links();		
		
		// echo'<pre/>'; print_r($ws_result); die(); 

		$form['search'] = $this->load->view('module/global/search', array(), true);
		$forms['block_form'] = $this->load->view('module/user/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';
		echo $this->template($forms, $view);
		
	}
			
	function __check($data){
		return $result_check = $this->usermodel->__check($data);
	}
	
	function __encrypt_password($data){
		
		$email = isset($data[$this->email_user]) ? $data[$this->email_user] : '';
		$username = isset($data[$this->username]) ? $data[$this->username] : '';
		$password = isset($data[$this->password]) ? $data[$this->password] : '';
		
		
		$_encrypt = md5($username.'----'.$email);
		$_encrypt_email = md5($email.$_encrypt.'--wawan_setiawan--'.$password);
		$_encrypt_username = md5($username.$_encrypt.'--wawan_setiawan--'.$password);
		$_encrypt__ = md5($_encrypt.$_encrypt_email.$_encrypt_username.'--wawan_setiawan--'.$password);
		
		return $_encrypt__;
		
	}
		
	function __user_key($data){
		
		$email = isset($data[$this->email_user]) ? $data[$this->email_user] : '';
		$username = isset($data[$this->username]) ? $data[$this->username] : '';
		
		
		$result = sha1($email.'--wawan_setiawan--'.$username);
		return $result;
	}
		
	function __viewEmail($param){
		
		$akses = isset($param[$this->access]) ? $param[$this->access] : '';
		$name = isset($param[$this->name]) ? $param[$this->name] : '';
		$username = isset($param[$this->username]) ? $param[$this->username] : '';
		$password = isset($param[$this->password]) ? $param[$this->password] : '';
		$email = isset($param[$this->email_user]) ? $param[$this->email_user] : '';
		
		
		$template = ''; 
		$template .= '<strong>Berikut Akses Anda untuk Login</strong><br/><br/>';
		$template .= 'Akses : '.$this->__config['access'][$akses].' <br/>';	
		$template .= 'Nama : '.$name.' <br/>';	
		$template .= '<strong>';	
		$template .= 'Username : '.$username.' <br/>';	
		$template .= 'Password : '.$password.' <br/>';	
		$template .= '</strong>';	
		$template .= 'Email : '.$email.'<br/><br/>';	
		$template .= 'Silahkan <a href="'.base_url('admin.php/login').'" target="_blank">KLIK DI SINI</a> untuk Login';	
		
		$data['content'] = $template;
		
		$TEdata['subject'] = $this->__config['subject_email_new_user'];
		$TEdata['email'] = $email;
		$TEdata['name'] = $name;
		$TEdata['username'] = $username;
		
		$result = $this->genericlibrary->__templateEmail($TEdata, $data);
		
		return $result;
		
	}
	
	
	
}
