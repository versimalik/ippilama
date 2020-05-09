<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errornotfound extends CI_Controller {

	function __construct()
    {    
    	parent::__construct();
	}
	
	public $module = 'Errornotfound'; //name module
	public $id_menu = 4; //name module
	
	function index($null = null, $page = null){
		
		if($this->session->userdata('username') == FALSE) login_page(); //cek session

		$forms['block_form'] = $this->load->view('module/error/block_list', array(), true);
		$forms['title'] = 'Page Not Found';
		$forms['iconadd'] = false;
		echo $this->template($forms, array());
		
	}
	
	function template($form, $view){
		
		if($this->session->userdata('username') == FALSE) login_page(); //cek session
		
		$data_ex['module'] = $this->module; 

		// $form['search'] = $this->load->view('module/global/search', array(), true);
		
		$wsdata['css_load'] = $this->load->view('module/global/load_css', $data_ex, true);
		$wsdata['js_load'] = $this->load->view('module/global/load_js', $data_ex, true);
		
		$param_l = array('id_menu' => $this->id_menu);
		$wsdata['block_left'] =	$this->load->view('module/global/block_left', $param_l, true);
		$wsdata['block_content'] = $this->load->view('module/global/block_content', $form, true);

		return $this->load->view('module/home/template', $wsdata, true);
	
	}
	
}
