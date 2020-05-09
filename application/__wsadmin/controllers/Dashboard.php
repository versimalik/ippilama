<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
		parent::__construct();
    }
	
	public $module = 'home'; //name module
	public $breadcumb = 'Dashboard'; //name module
	public $id_menu = 1;
		
	function index(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session		
		$this->home();
		
	}
	
	function home(){
		
		if($this->session->userdata('username') == FALSE ) login_page(); //cek session
		
		$form['main'] = null; //$this->load->view('blocks/main', array(), true);
		$form['title'] = null; //$this->module;
		$view = 'right/views_wp';
		echo $this->template($form, $view);
		
	}
	
	function template($form, $view){
		
		$param_l = array('id_menu' => $this->id_menu);
		
		$wsdata['block_left'] =	$this->load->view('module/global/block_left', $param_l, true);
		// $wsdata['block_head'] = $this->load->view('module/global/block_head', array(), true);
		$wsdata['block_content'] = $this->load->view('module/home/block_content', array(), true);
		
		return $this->load->view('module/home/template', $wsdata, true);
	
	}
	
	
}
