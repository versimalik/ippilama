<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index()
  {
    $data['content'] = 'register';
    $this->load->view('layout/default', $data);
  }

}

/* End of file Registration.php */
/* Location: ./application/wsfront/controllers/Registration.php */