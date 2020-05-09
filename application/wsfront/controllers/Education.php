<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index()
  {
     
  }

  public function program(){
    $data['content'] = 'program';
    $this->load->view('layout/default', $data);
  }

  public function kurikulum(){
    $data['content'] = 'kurikulum';
    $this->load->view('layout/default', $data);
  }

  public function prestasi(){
    $data['content'] = 'prestasi';
    $this->load->view('layout/default', $data);
  }

}

/* End of file Education.php */
/* Location: ./application/wsfront/controllers/Education.php */