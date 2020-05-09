<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function index()
  {
    
    $getFullurl = $this->uri->uri_string();
    $exp = explode('/read/', $getFullurl);
    
    $table = $exp[0];
    $slug = $exp[1];

    switch ($table) {
      case 'news':
        $table = 'article';
        break;
      default:
        $table = 'event';
        break;
    }
    $data['table'] = $table;
    $data['detail'] = $this->Querymodel->getDetail($table, $slug);
    if ($table == 'article') {
      $data['article'] = $this->Querymodel->getListArticle($limit=3, 0, $data['detail'][0]['ws_article_id']);
    } else {
      $data['event'] = $this->Querymodel->getListEvent($limit=3, 0, $data['detail'][0]['ws_event_id']);
    }
    $data['content'] = 'news-details';
    $this->load->view('layout/default', $data); 
  }

}

/* End of file Branch.php */
/* Location: ./application/wsfront/controllers/Branch.php */