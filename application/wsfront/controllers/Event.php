<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public $table = 'ws_event_foo';
  public $perpage = 10;

  public function index()
  {
    
    $page = $this->uri->segment(3);
    $offset = !empty($page) ? $this->perpage * ($page - 1) : 0;

    $config['base_url'] = base_url('event/page');
    $config['total_rows'] = $this->Querymodel->getCountAllrows($this->table);
    $config['per_page'] = $this->perpage;
    $config['first_url'] = '1';

    $config['use_page_numbers'] = TRUE;
    
    $config['full_tag_open'] = '<div><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';
    
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '<li>';
    
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '<li>';
    
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '<li>';
    
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '<li>';
    
    $config['cur_tag_open'] = '<li class="active"><a href="javascrip::void();">';
    $config['cur_tag_close'] = '</a></li>';
    
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();

    $data['event'] = $this->Querymodel->getListEvent($limit=$this->perpage, $start=$offset);
    
    $data['latest_news'] = $this->Querymodel->getListArticle(5, 0);
    // var_dump($data['latest_news']);die;
    $data['content'] = 'event';
    $this->load->view('layout/default', $data); 
  }

}

/* End of file Event.php */
/* Location: ./application/wsfront/controllers/Event.php */