<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index()
  {
    $data['content'] = 'branch';
    $this->load->view('layout/default', $data); 
  }

}

/* End of file Branch.php */
/* Location: ./application/wsfront/controllers/Branch.php */