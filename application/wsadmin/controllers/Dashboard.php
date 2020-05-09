<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
		parent::__construct();
		$this->load->model('querymodel');
    }
	
	public $module = 'home'; //name module
	public $breadcumb = 'Dashboard'; //name module
	public $id_menu = 1;
	public $id = 'ws_article_id';
		
	function index(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session		
		$this->home();
		
	}
	
	function home(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$ws_result['artData'] = $this->querymodel->get_dashboard('ws_article_foo', 5, 'ws_article_title');
		$ws_result['eveData'] = $this->querymodel->get_dashboard('ws_event_foo', 5, 'ws_event_title');
		
		$form['main'] = $this->load->view('module/home/widgethome', $ws_result, true);
		$form['title'] = null; //$this->module;
		$view = 'right/views_wp';
		echo $this->template($form, $view);
		
	}
	
	function template($form, $view){
		
		$data_ex['module'] = $this->module; 
		$param_l = array('id_menu' => $this->id_menu);
		
		$wsdata['css_load'] = $this->load->view('module/global/load_css', $data_ex, true);
		$wsdata['js_load'] = $this->load->view('module/global/load_js', $data_ex, true);

		$wsdata['block_left'] =	$this->load->view('module/global/block_left', $param_l, true);
		// $wsdata['block_head'] = $this->load->view('module/global/block_head', array(), true);
		$wsdata['block_content'] = $this->load->view('module/home/block_content', $form, true);
		
		return $this->load->view('module/home/template', $wsdata, true);
	
	}
	
	
}
