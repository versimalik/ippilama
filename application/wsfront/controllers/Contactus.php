<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['content'] = 'contact-us';
		$this->load->view('layout/default', $data);	
	}

}

/* End of file Contact.php */
/* Location: ./application/wsfront/controllers/Contact.php */