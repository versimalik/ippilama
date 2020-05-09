<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['content'] = 'gallery';
		$this->load->view('layout/default', $data);	
	}

}

/* End of file Gallery.php */
/* Location: ./application/wsfront/controllers/Gallery.php */