<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('searchmodel');
		$this->load->config('ws_generic', true);
		$this->__config_generic = $this->config->item('ws_generic');
		
		$this->load->config('ws_category', true);
		$this->__config = $this->config->item('ws_category');

	}
	
	/** field insert mysql */
	public $path_pict = '/category/'; //name path picture
	public $path_images = 'category';
	public $module = 'category'; //name module
	public $table = 'ws_category'; //name table
	public $date_create = 'ws_category_date_create';
	
	public $id = 'ws_category_id';
	public $parent_id = 'ws_category_parent_id';
	public $title_input = 'ws_category_name';
	public $ws_category_parent_name = 'ws_category_parent_name';
	public $status = 'ws_category_status';
	public $count_image = 1;
	
	public $page = 20;
	public $breadcumb = array('General', 'Category'); //name module
	public $id_menu = 6; 
	
	/** end field insert mysql */
	
	function index($null = null, $page = null){
		
		$offset = !empty($page) ? $this->page * ($page - 1) : 0;
		$this->category($offset, $page);
		//$this->insert();
	
	}
	
	function category($offset, $page){
				
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
		
		$data = $this->querymodel->queryRecord($this->page, $offset, $this->table);
		

		// $bb = menus($this->querymodel->get_category());
		// $bb = menus($data);
		// echo'<pre/>'; print_r('------');
		// echo'<pre/>'; print_r($this->querymodel->get_category());
		// echo'<pre/>'; print_r($data);
		// echo'<pre/>'; print_r($bb); die(); 


		foreach($data as $key => $val){			
			$data[$key]['ws_category_parent_name'] = 'Parent';
			foreach ($data as $k => $v) {
			 	if($val['ws_category_parent_id'] == $v['ws_category_id']){
			 		$data[$key]['ws_category_parent_name'] = $v['ws_category_name'];
			 	}				
			 } 					
		}	

		// echo'<pre/>'; print_r($data); die(); 

		$ws_result['data'] = $data;							
		$ws_result['head_title'] = array('No'
								,'Date Create'
								,'Parent Category'
								,'Category Name'
								,'<center>Status</center>'
								,'<center>Edit</center>'
								,'<center>'.checkall_box().'</center>'
							);

		$forms['block_form'] = $this->load->view('module/category/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
	}
	
	function add($data = null, $err = null){
		
		if($this->session->userdata('username') == FALSE ) login_page();  //cek session
		
		isset($data[$this->title_input]) ?  $title_input = $data[$this->title_input]  : '' ;

		$form['post'] = '/insert/post';
		$form['title'] = 'Post Category';

		$form['form'] = array(
					'module' => $this->module
					
					,'select_box_search' => select_box_search($name = $this->parent_id
												,$this->querymodel->get_category()
												,isset($_POST[$this->parent_id]) ? $_POST[$this->parent_id] : ''
												,'Parent')

					,'name' => input_box(array('id' => $this->title_input
													,'placeholder'=>"Category"
													,'class' => 'validate[required] col-xs-10 col-sm-10'
													,'name'	=> $this->title_input
													,'value' => isset($title_input) ? $title_input : ''), $label = 'Category Name *')
																		
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
		$forms['block_form'] = $this->load->view('module/category/block_form', $form, true);
		
		echo $this->template($forms, $view);
		
	}

	

	function insert($post = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		if(!empty($post) && $post == 'post'){
			
			$this->form_validation->set_rules($this->title_input, 'Category Name', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$date_create = time();
				$title_input = $this->security->xss_clean($this->input->post($this->title_input, TRUE));
				$parent_id = $this->security->xss_clean($this->input->post($this->parent_id, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
				$data_id = $this->id;

				if(!empty($date_create)) $data[$this->date_create] = time();
				if(!empty($title_input)) $data[$this->title_input] = $title_input;
				if(!empty($parent_id)) $data[$this->parent_id] = $parent_id;
				if(!empty($status)) $data[$this->status] = $status;
										 	
				if(!empty($data)) $success = $this->querymodel->insertRecord($data, $data_id, $this->table, 'image'); 
					
				if(isset($success) && !is_array($success) && empty($success['error'])) {
					
					//Insert Log
					$get_user = $this->session->userdata('username');
					$param_log = array();
					$param_log['username'] = $get_user['ws_user_username'];
					$param_log['status'] = 'ADD '.$this->module;
					$param_log['description'] = 'Name: '.$get_user['ws_user_name'];
					$this->logmodel->insertLog($param_log);
					//end insert log
											
					$this->session->set_flashdata('message', 'Add '.$this->module.' Success');
					redirect('../'.url_admin().$this->module.'/add');
				}else{
				
					foreach($success['error'] as $key => $val){
						
						$err[$key] = $val;
							
					}
				}
				
			}else{
			
				$err[] = form_error($this->title_input, '<span class="error">', '</span>');
				
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
		
		$title_input = isset($result[0][$this->title_input]) ? $result[0][$this->title_input] : '';
		$parent_id = isset($result[0][$this->parent_id]) ? $result[0][$this->parent_id] : '';
		$status = isset($result[0][$this->status]) ? $result[0][$this->status] : '';

		$form['update'] = '/update';
		$form['field_id']['id'] = array('name' => $this->id, 
								  'value' => $result[0][$this->id]);
		$form['title'] = 'Edit Category';
		$form['form'] = array(
					'module' => $this->module
					
					,'select_box_search' => select_box_search($name = $this->parent_id
												,$this->querymodel->get_category()
												,isset($parent_id) ? $parent_id : ''
												,'Parent')

					,'name' => input_box(array('id' => $this->title_input
													,'placeholder'=>"Category"
													,'class' => 'validate[required] col-xs-10 col-sm-10'
													,'name'	=> $this->title_input
													,'value' => isset($title_input) ? $title_input : ''), $label = 'Category Name *')
																		
					,'option_box' => option_box($name = $this->status
												,array('No Active', 'Active')
												,isset($status) ? $status : ''
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
		$forms['block_form'] = $this->load->view('module/category/block_form', $form, true);

		echo $this->template($forms, $view);
		
	}
	
	function update(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
		
		$data_ext = '';
		if(isset($field_id) && !empty($field_id)){
			
			$this->form_validation->set_rules($this->title_input, 'Category Name', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$title_input = $this->security->xss_clean($this->input->post($this->title_input, TRUE));
				$parent_id = $this->security->xss_clean($this->input->post($this->parent_id, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
				$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));

				$field['field'] = array();
				
				if(!empty($title_input)) $data[$this->title_input] = $title_input;
				if(!empty($parent_id)) $data[$this->parent_id] = $parent_id;
				if(!empty($field_id)) $data[$this->id] = $field_id;
				$data[$this->status] = $status;
				// $data[$this->user_update] = $this->session->userdata('username')['ws_user_username'];
				
				$data_id = $this->id;
				
				foreach($_FILES['userfile'] as $key => $val){
			
					foreach($_FILES['userfile']['size'] as $k => $v){
						
							$i = 1;
							foreach($val as $v){
								$field_name = "userfile_".$i;
								$_FILES[$field_name][$key] = $v;
								$_FILES[$field_name]['number'] = $i;
								$i++;
							}
					}
			
				}
				
				unset($_FILES['userfile']);

				
				// check username & email
				if(!empty($data)) $success = $this->querymodel->updateRecord($data, $data_id, $this->table, 'image'); 	
				
				if(isset($success) && empty($success['error'])){
					
					//Insert Log
					$get_user = $this->session->userdata('username');
					$param_log = array();
					$param_log['username'] = $get_user['ws_user_username'];
					$param_log['status'] = 'EDIT '.$this->module;
					$param_log['description'] = 'Name: '.$get_user['user_name'];
					$this->logmodel->insertLog($param_log);
					//end insert log
					
					$this->session->set_flashdata('message', 'Edit '.$this->module.' Success');
					redirect('../'.url_admin().$this->module.'/edit/'.$field_id);
				}else{
					
					foreach($success['error'] as $key => $val){
						
						$k=1;
						foreach($success['error'] as $key => $val){
							if($key == 'image_'.$k){
								$err['image_'.$k] = $val;
							}else{
								$err[] = $val;
							}
							
							$k++;
						}
						
						
					}
					
				} 

			}else{
				
				$err[] = form_error($this->title_input, '<span class="error">', '</span>');
				
			}
			
		}
		
		$setval = isset($data) ? $data : '';
		$err = isset($err) ? $err : '';
		$this->edit($field_id, $setval, $err);
		
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
		
		$limit  = array('page' => $this->page, 'offset' => $offset);
		$keyword  = array('q' => $q, 'status' => isset($s) ? $s : '');
		$url = base_url(url_admin().$this->module.'/search?q='.$q.'&s='.$s);
		
		if(isset($offset) && !empty($offset)) $result['row'] = no_record(array($this->page, $p));
		
		$data = $this->searchmodel->search_limit_data($param, $keyword, $limit, $this->table);
		
		foreach($data as $key => $val){			
			$data[$key]['ws_category_parent_name'] = 'Parent';
			foreach ($data as $k => $v) {
			 	if($val['ws_category_parent_id'] == $v['ws_category_id']){
			 		$data[$key]['ws_category_parent_name'] = $v['ws_category_name'];
			 	}
			 } 
		}

		$ws_result['data'] = $data;
		$ws_result['head_title'] = array('No'
								,'Date Create'	
								,'Parent Category'
								,'Category Name'
								,'<center>Status</center>'
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
		
		$forms['block_form'] = $this->load->view('module/category/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';
		echo $this->template($forms, $view);
		
	}
	
}
