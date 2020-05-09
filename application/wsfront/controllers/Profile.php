<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }
  public function index()
  {
  
  }

  public function strukturorganisasi(){
    $data['content'] = 'portlet/strukturorganisasi';
    $this->load->view('layout/default', $data);
  }

}
/* End of file Profil.php */
/* Location: ./application/wsfront/controllers/Profil.php */
