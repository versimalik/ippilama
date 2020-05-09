<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('querymodel');
		$this->load->model('searchmodel');
		$this->load->model('logmodel');


		$this->__config = $this->config->item('config');
    }
	
	/** field insert mysql */
	public $module = 'log'; //name module
	public $table = 'ws_log'; //name table
	public $id = 'ws_log_id';
	public $date_create = 'ws_log_date_create';
	public $username = 'ws_log_username';
	public $description = 'ws_log_description';
	public $timestamp = 'ws_log_timestamp';
	public $status = 'ws_log_status';
	
	public $page = 20;
	public $id_menu = 2; 

	public $breadcumb = array('User', 'Log'); //name module
	
	/** end field insert mysql */
	
	function index($null = null, $page = null){
		
		// if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$offset = isset($page) ? $this->page * ($page - 1) : 0;
		$this->log($offset, $page);
		//$this->insert();
	
	}
	
	function log($offset, $page){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		if(isset($page) && !empty($page)) $ws_result['row'] = no_record($param = array($this->page, $page));
		
		$result['field'] = array();
	
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

		$ws_result['head_title'] = array('No', 'Created on', 'Username', 'Activity', 'Description', '<center>'.checkall_box().'</center>');
		
		$form['title'] = 'USER&nbsp;<a class="title_module" href="'.base_url(url_admin().$this->module).'">'.$this->module.'</a>';
		
		$forms['block_form'] = $this->load->view('module/log/block_list', $ws_result, true);
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
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
	
	function search(){
		
		$s = $this->security->xss_clean($this->input->get_post('s', TRUE)); //startdate
		$e = $this->security->xss_clean($this->input->get_post('e', TRUE)); //enddate
		$p = $this->security->xss_clean($this->input->get_post('p', TRUE)); //page
			
		$offset = !empty($p) ? $this->page * ($p - 1) : 0;
		$limit  = array('page' => $this->page, 'offset' => $offset);
		$url = base_url(url_admin().$this->module.'/search?s='.$s.'&e='.$e);
				
		$start_date = mktime(0, 0, 0, date("d"), date("m"), date("Y"));
		$end_date = mktime(0, 0, 0, date("d"), date("m"), date("Y"));
				
		$startdate = $s ? strtotime($s.' 00:00:00') : $start_date;
		$enddate = $e ? strtotime($e.' 00:00:00') : $end_date;
				
		$param = array( 'table' => $this->table
						,'start' => $startdate
						,'end' => $enddate						
						,'field' => $this->timestamp
					);
		
		if(isset($offset) && !empty($offset)) $ws_result['row'] = no_record(array($this->page, $p));
		
		$ws_result['data'] = $this->searchmodel->search_log_data($param, $limit);
				
		$ws_result['head_title'] = array('No', 'Created on', 'Username', 'Activity', 'Description', '<center>'.checkall_box().'</center>');
		
		//pagging
		$config['base_url'] = $url;
		$config['total_rows'] = $this->searchmodel->search_log_count($param, $limit);
		$config['per_page'] = $this->page;
		$config['first_url'] = '1';
				
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		$config['first_url'] = $url.'&p=1';

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
		
		$urlsearch['search'] = base_url('/'.url_admin().$this->module.'/search');
		$forms['block_form'] = $this->load->view('module/log/block_list', $ws_result, true);
		
		$forms['title'] = $this->module;
		$view = 'right/views';

		echo $this->template($forms, $view);
		
	}
	
	function template($form, $view){
		
		$data_ex['module'] = $this->module; 

		$wsdata['css_load'] = $this->load->view('module/global/load_css', $data_ex, true);
		$wsdata['js_load'] = $this->load->view('module/global/load_js', $data_ex, true);
		
		$param_l = array('id_menu' => $this->id_menu);
		$wsdata['block_left'] =	$this->load->view('module/global/block_left', $param_l, true);

		$bl_head['iconadd'] = false;
		$wsdata['block_head'] = $this->load->view('module/global/block_head', $bl_head, true);
		
		$form['block_search'] = $this->load->view('module/log/block_search.php', array(), true);
		$wsdata['block_content'] = $this->load->view('module/global/block_content', $form, true);
		
		return $this->load->view('module/home/template', $wsdata, true);
	
	}
	
	
}
