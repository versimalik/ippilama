<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('searchmodel');
		$this->load->config('ws_permission', true);
		$this->__config = $this->config->item('ws_permission');
		//echo'<pre/>'; print_r($this->__config); die(); 
	}
	
	/** field insert mysql */
	public $path_pict = '/permission/'; //name path picture
	public $module = 'permission'; //name module
	public $table = 'ws_permission'; //name table
	public $date_create = 'ws_permission_datecreate';
	public $id = 'ws_permission_id';
	public $name = 'ws_permission_name';
	public $parent_id = 'ws_permission_parent_id';
	public $page = 3;
	public $id_menu = 2;
	public $breadcumb = array('User', 'Permission'); //name module
	
	/** end field insert mysql */
	
	function index($null = null, $page = null){
		
		$offset = !empty($page) ? $this->page * ($page - 1) : 0;
		$this->permission($offset, $page);
		
	}
	
	function permission($offset, $page){
				
		if($this->session->userdata('username') == FALSE) login_page(); //cek session
		
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
								,'<center>Edit</center>'
								,'<center>'.checkall_box().'</center>'
							);

		$forms['block_form'] = $this->load->view('module/permission/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
	}
	
	function add($data = null, $err = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		isset($data[$this->id]) ?  $id = $data[$this->id]  : '' ;
		isset($data[$this->name]) ? $name = $data[$this->name] : '' ;
		isset($data[$this->parent_id]) ? $email = $data[$this->parent_id] : '' ;
		
		$form['post'] = '/insert/post';
		$form['title'] = 'Post New <a class="title_module" href="'.base_url(url_admin().$this->module).'">Permission</a>';
		$form['form'] = array(
					'module' => $this->module
					
					,'name' => input_box(array('id' => $this->name
												,'placeholder'=>"name"
												,'class' => 'validate[required] col-xs-10 col-sm-10'
												,'name'	=> $this->name
												,'value'	=> set_value($this->name, isset($name) ? $name : '')), $label = 'Name *')
					
					,'button' => button(array('value' => 'true'
												,'type' => 'submit'
												,'class' => 'btn btn-xs btn-primary submit'
												,'content' => '<i class="ace-icon fa fa-check bigger-110"></i>&nbsp;Submit'
											))
					
				);
		
		$form['err'] = isset($err) ? $err : '';
		$view = 'right/form';
		$forms['block_form'] = $this->load->view('module/permission/block_form', $form, true);
		
		echo $this->template($forms, $view);
		
	}
	
	function insert($post = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		if(!empty($post) && $post == 'post'){
			
			$this->form_validation->set_rules($this->name, 'Name', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$date_create = time();
				$name = $this->security->xss_clean($this->input->post($this->name, TRUE));
				$data_id = $this->id;

				$field['field'] = array();
				
				if(!empty($date_create)) $data[$this->date_create] = $date_create;
				if(!empty($name)) $data[$this->name] = $name;
				if(!empty($data)) $success = $this->querymodel->insertRecord($data, $data_id, $this->table); 
					
				if(isset($success)) {
					
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
				
			}else{
			
				$err[] = form_error($this->name, '<span class="error">', '</span>');
			
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
		
		$result = $this->querymodel->editRecord(array($this->id => $field_id), $this->table);
		
		$name = isset($result[0][$this->name]) ? $result[0][$this->name] : '';

		$form['permission'] = $this->querymodel->get_menus(array('ws_permission_id' => $field_id), 'ws_menus');
		
		$form['update'] = '/update';
		$form['field_id']['id'] = array('name' => $this->id, 
								  'value' => $result[0][$this->id]);
		$form['title'] = 'Edit <a class="title_module" href="'.base_url(url_admin().$this->module).'">Permission</a>';
		$form['form'] = array(
					'module' => $this->module

					,'name' => input_box(array('id' => $this->name
												,'placeholder'=>"name"
												,'class' => 'validate[required] col-xs-10 col-sm-10'	
												,'name'	=> $this->name
												,'value' => isset($name) ? $name : ''), $label = 'Name *')
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
		$forms['block_form'] = $this->load->view('module/permission/block_form', $form, true);

		echo $this->template($forms, $view);
		
	}
	
	function update(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
		
		$data_ext = '';
		if(isset($field_id) && !empty($field_id)){
			
			$this->form_validation->set_rules($this->name, 'Name', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$name = $this->security->xss_clean($this->input->post($this->name, TRUE));
				$ws_menus_temp = $this->security->xss_clean($this->input->post('ws_menus_temp', TRUE));
				$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
				
				$field['field'] = array();
				
				if(!empty($name)) $data[$this->name] = $name;
				if(!empty($field_id)) $data[$this->id] = $field_id;
				if(!empty($field_id)) $data_ext[$this->id] = $field_id;
				if(!empty($ws_menus_temp)) $data_ext['ws_menus_temp'] = $ws_menus_temp;
				
				$data_id = $this->id;
				
				// check username & email
				
				if(!empty($data)) $success = $this->querymodel->updateRecord(
																			$data
																			,$data_id
																			,$this->table
																			,''
																			,array('funct' => 'menus', 'data' => $data_ext, 'id' => ''));	
									
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
					redirect('../'.url_admin().$this->module.'/edit/'.$field_id);
				}
			
				
			}else{
				
				$err[] = form_error($this->name, '<span class="error">', '</span>');
				$err[] = form_error('ws_menus_temp', '<span class="error">', '</span>');
			}
			
		}
		
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
				$result = $this->querymodel->delete_menus($ex[0], $this->table);
				
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
		
		$limit  = array('page' => $this->page, 'offset' => $offset);
		$keyword  = array('q' => $q, 'status' => isset($s) ? $s : '');
		$url = base_url(url_admin().$this->module.'/search?q='.$q.'&s='.$s);
		
		if(isset($offset) && !empty($offset)) $result['row'] = no_record(array($this->page, $p));
		
		$ws_result['data'] = $this->searchmodel->search_limit_data($param, $keyword, $limit, $this->table);
		//printr($result); 
		
		$ws_result['head_title'] = array('No'
								,'Date Create'
								,'Name'
								,'<center>Edit</center>'
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
		
		// $forms['search'] = $this->load->sharedview('global/search', array(), true);
		$forms['block_form'] = $this->load->view('module/permission/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';
		echo $this->template($forms, $view);
		
	}
	
}
