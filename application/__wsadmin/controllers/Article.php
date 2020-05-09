<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('searchmodel');
		$this->load->config('ws_article', true);
		$this->__config = $this->config->item('ws_article');
		
		$this->load->config("ws_thumbnail", true);
		$this->path_thumbnail = $this->config->item('ws_thumbnail');
		

		//echo'<pre/>'; print_r($this->path_thumbnail); die(); 
	}
	
	/** field insert mysql */
	public $path_pict = '/article/'; //name path picture
	public $path_images = 'article';
	public $module = 'article'; //name module
	public $table = 'ws_article_foo'; //name table
	public $date_create = 'ws_article_date_create';
	
	public $id = 'ws_article_id';
	public $title_input = 'ws_article_title';
	public $summary_input = 'ws_article_summary';
	public $desc_input = 'ws_article_desc';
	public $userfile = 'userfile';
	public $image_upload = 'ws_article_image';
	public $keyword_input = 'ws_article_keyword';
	public $tags_input = 'ws_article_tags';
	public $user_create = 'ws_user_create';
	public $user_update = 'ws_user_update';
	public $status = 'ws_article_status_publish';
	public $page = 20;
	public $count_image = 1;
	
	
	/** end field insert mysql */
	
	function index($null = null, $page = null){
		
		$offset = !empty($page) ? $this->page * ($page - 1) : 0;
		$this->article($offset, $page);
		//$this->insert();
	
	}
	
	function article($offset, $page){
				
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
								,'Title'
								,'<center>Status</center>'
								,'<center>Edit</center>'
								,'<center>'.checkall_box().'</center>'
							);

		$forms['block_form'] = $this->load->view('module/article/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
	}
	
	function add($data = null, $err = null){
		
		// if($this->session->userdata('username') == FALSE ) login_page();  //cek session
		
		isset($data[$this->title_input]) ?  $title_input = $data[$this->title_input]  : '' ;
		isset($data[$this->summary_input]) ?  $summary_input = $data[$this->summary_input]  : '' ;
		isset($data[$this->desc_input]) ? $desc_input = $data[$this->desc_input] : '' ;
		isset($data[$this->tags_input]) ? $tags_input = $data[$this->tags_input] : '' ;
		

		// isset($data['category']) ? $category = $data['category'] : '' ;
		// isset($data[$this->keyword_input]) ? $keyword_input = $data[$this->keyword_input] : '' ;
		
		// ,'name' => input_box(array('id' => $this->name
		// 								,'class' => 'validate[required] form-control col-lg-6'
		// 								,'name'	=> $this->name
		// 								,'value'	=> set_value($this->name, isset($name) ? $name : '')), $label = 'Name *')
			

		$form['post'] = '/insert/post';
		$form['title'] = 'Post New Article';
		$form['form'] = array(
					'module' => $this->module
					,'title_box' => input_box(array('id' => $this->title_input
													,'class' => 'validate[required] form-control col-lg-6'
													,'name'	=> $this->title_input
													,'value' => isset($title_input) ? $title_input : ''), $label = 'TITLE *')
					
					
					,'summary_box' => textarea_box(array('id' => $this->summary_input
														,'class' => 'validate[required, maxSize[160]] form-control col-lg-6'
														,'maxlength' => '160'
														,'rows' => '3'
														,'name'	=> $this->summary_input
														,'value' => isset($summary_input) ? $summary_input : '')
												,array('name' => 'SUMMARY *', 'attr' => array('for'=>'limiter', 'class' => 'control-label col-lg-2')))
					 
					,'desc_box' => $this->load->view('module/global/tinymce/tinymce', array('label' => 'DESCRIPTION *'
																							,'name' => $this->desc_input
																							,'set_value' => isset($desc_input) ? $desc_input : ''
																							,'config_name' =>'ws_article'),
																						true)
					
					,'upload' => upload($this->userfile.'[]')
					

					,'tags_box' => input_box(array('id' => 'tags'
													,'class' => 'form-control col-lg-6'
													,'name'	=> $this->tags_input
													,'value' => isset($tags_input) ? $tags_input : '')
											,array('name' => 'TAGS', 'attr' => array('for'=>'tags', 'class' => 'control-label col-lg-2')))
					 
					,'option_box' => option_box($name = $this->status
												,array('No Active', 'Active')
												,isset($_POST[$this->status]) ? $_POST[$this->status] : ''
												,'STATUS')

					,'button' => button('Submit')
				);
		
		$form['err'] = isset($err) ? $err : '';
		$view = 'right/form';
		$forms['block_form'] = $this->load->view('module/article/block_form', $form, true);
		
		echo $this->template($forms, $view);
		
	}

	

	function insert($post = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		if(!empty($post) && $post == 'post'){
			
			$this->form_validation->set_rules($this->title_input, 'TITLE', 'trim|required');
			$this->form_validation->set_rules($this->summary_input, 'SUMMARY', 'trim|required');
			$this->form_validation->set_rules($this->desc_input, 'DESCRIPTION', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$date_create = time();
				$title_input = $this->security->xss_clean($this->input->post($this->title_input, TRUE));
				$summary_input = $this->security->xss_clean($this->input->post($this->summary_input, TRUE));
				$desc_input = $this->security->xss_clean($this->input->post($this->desc_input, TRUE));
				$tags_input = $this->security->xss_clean($this->input->post($this->tags_input, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
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

				if(!empty($date_create)) $data[$this->date_create] = time();
				if(!empty($title_input)) $data[$this->title_input] = $title_input;
				if(!empty($summary_input)) $data[$this->summary_input] = $summary_input;
				if(!empty($desc_input)) $data[$this->desc_input] = $desc_input;
				if(!empty($tags_input)) $data[$this->tags_input] = $tags_input;
				if(!empty($status)) $data[$this->status] = $status;
				$data[$this->user_create] = $this->session->userdata('username')['ws_user_username'];
				
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
				$err[] = form_error($this->summary_input, '<span class="error">', '</span>');
				$err[] = form_error($this->desc_input, '<span class="error">', '</span>');
			
			}
			
		}
		
		$setval = isset($data) ? $data : '';
		$err = isset($err) ? $err : '';
		$this->add($setval, $err);
	}
	
		
	function edit($field_id=null, $data = null, $err = null){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$ses_name = $this->session->userdata('username');
		if(($ses_name['user_username'] != $field_id) && ($ses_name['user_access'] == TRUE)) redirect(base_url('error'), 'refresh'); //cek session
		
		$result = $this->querymodel->editRecord(array($this->id => $field_id), $this->table);
		
		$title_input = isset($result[0][$this->title_input]) ? $result[0][$this->title_input] : '';
		$summary_input = isset($result[0][$this->summary_input]) ? $result[0][$this->summary_input] : '';
		$desc_input = isset($result[0][$this->desc_input]) ? $result[0][$this->desc_input] : '';
		$tags_input = isset($result[0][$this->tags_input]) ? $result[0][$this->tags_input] : '';
		$status = isset($result[0][$this->status]) ? $result[0][$this->status] : '';

		$form['update'] = '/update';
		$form['field_id']['id'] = array('name' => $this->id, 
								  'value' => $result[0][$this->id]);
		$form['title'] = 'Edit Article';
		$form['form'] = array(
					'module' => $this->module
					,'title_box' => input_box(array('id' => $this->title_input
													,'class' => 'validate[required] form-control col-lg-6'
													,'name'	=> $this->title_input
													,'value' => isset($title_input) ? $title_input : ''), $label = 'TITLE *')
					
					,'summary_box' => textarea_box(array('id' => $this->summary_input
														,'class' => 'validate[required, maxSize[160]] form-control col-lg-6'
														,'maxlength' => '160'
														,'rows' => '3'
														,'name'	=> $this->summary_input
														,'value' => isset($summary_input) ? $summary_input : '')
												,array('name' => 'SUMMARY *', 'attr' => array('for'=>'limiter', 'class' => 'control-label col-lg-2')))
					 
					,'desc_box' => $this->load->view('module/global/tinymce/tinymce', array('label' => 'DESCRIPTION *'
																							,'name' => $this->desc_input
																							,'set_value' => isset($desc_input) ? $desc_input : ''
																							,'config_name' =>'ws_article'),
																						true)
					
					,'upload' => upload($this->userfile.'[]')
					
					,'tags_box' => input_box(array('id' => 'tags'
													,'class' => 'form-control col-lg-6'
													,'name'	=> $this->tags_input
													,'value' => isset($tags_input) ? $tags_input : '')
											,array('name' => 'TAGS', 'attr' => array('for'=>'tags', 'class' => 'control-label col-lg-2')))

					,'option_box' => option_box($name = $this->status
												,array('No Active', 'Active')
												,isset($status) ? $status : ''
												,'STATUS')

					,'button' => button('Edit')
				);
		

		$form['err'] = isset($err) ? $err : '';
		$view = 'right/form';
		$forms['block_form'] = $this->load->view('module/article/block_form', $form, true);

		echo $this->template($forms, $view);
		
	}
	
	function update(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));
		
		$data_ext = '';
		if(isset($field_id) && !empty($field_id)){
			
			$this->form_validation->set_rules($this->title_input, 'TITLE', 'trim|required');
			$this->form_validation->set_rules($this->summary_input, 'SUMMARY', 'trim|required');
			$this->form_validation->set_rules($this->desc_input, 'DESCRIPTION', 'trim|required');
			
			if ($this->form_validation->run() == TRUE){
			
				$title_input = $this->security->xss_clean($this->input->post($this->title_input, TRUE));
				$summary_input = $this->security->xss_clean($this->input->post($this->summary_input, TRUE));
				$desc_input = $this->security->xss_clean($this->input->post($this->desc_input, TRUE));
				$tags_input = $this->security->xss_clean($this->input->post($this->tags_input, TRUE));
				$status = $this->security->xss_clean($this->input->post($this->status, TRUE));
				$field_id = $this->security->xss_clean($this->input->post($this->id, TRUE));

				$field['field'] = array();
				
				if(!empty($title_input)) $data[$this->title_input] = $title_input;
				if(!empty($summary_input)) $data[$this->summary_input] = $summary_input;
				if(!empty($desc_input)) $data[$this->desc_input] = $desc_input;
				if(!empty($tags_input)) $data[$this->tags_input] = $tags_input;
				if(!empty($field_id)) $data[$this->id] = $field_id;
				$data[$this->status] = $status;
				$data[$this->user_update] = $this->session->userdata('username')['ws_user_username'];
				
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
				$err[] = form_error($this->summary_input, '<span class="error">', '</span>');
				$err[] = form_error($this->desc_input, '<span class="error">', '</span>');
				
			}
			
		}
		
		$setval = isset($data) ? $data : '';
		$err = isset($err) ? $err : '';
		$this->edit($field_id, $setval, $err);
		
	}
	
	
	function delete(){
	
		// if($this->session->userdata('username') == FALSE ) login_page(); //cek session
	
		$del = $this->security->xss_clean($this->input->post('del', TRUE));
		
		if(isset($del)){
		
			foreach($del as $key => $val){
				
				$ex = explode(',',$val);
				$result = $this->querymodel->deleteRecord($val, null);
				
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

		$form['search'] = $this->load->view('module/global/search', array(), true);
		
		$wsdata['css_load'] = $this->load->view('module/global/load_css', $data_ex, true);
		$wsdata['js_load'] = $this->load->view('module/global/load_js', $data_ex, true);
		
		$wsdata['block_left'] =	$this->load->view('module/global/block_left', array(), true);
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
								,'Title'
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
		
		$forms['block_form'] = $this->load->view('module/article/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';
		echo $this->template($forms, $view);
		
	}
	
}
