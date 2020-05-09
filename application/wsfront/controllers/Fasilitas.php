<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }
  
  public function index()
  {
    $data['content'] = 'fasilitas';
    $this->load->view('layout/default', $data) ; 
  }

}

/* End of file Fasilitas.php */
/* Location: ./application/wsfront/controllers/Fasilitas.php */