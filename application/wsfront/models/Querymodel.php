<?php

class Querymodel extends  CI_Model {
	
	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function getCountAllrows($table)
	{
		$table = isset($table) ? $table : $this->table;
		return $this->db->count_all($table);
	}

    public function getListArticle($limit=10, $start=0, $related_id=''){
    	
    	$result = array();
    	$this->db->select('ws_article_foo.ws_article_id
    						,ws_article_foo.ws_article_date_create
    						,ws_article_foo.ws_article_title
    						,ws_article_foo.ws_article_summary	
    						,ws_article_foo.ws_article_slug	
    						,ws_article_image.ws_article_image_path');	
    	$this->db->where('ws_article_foo.ws_article_status_publish', '1');	
    	($related_id ? $this->db->where_not_in('ws_article_foo.ws_article_id', array($related_id)) : '');
    	$this->db->order_by('ws_article_foo.ws_article_id', "desc"); 
    	$this->db->join('ws_article_image', 'ws_article_image.ws_article_id = ws_article_foo.ws_article_id');
		$query = $this->db->get('ws_article_foo', $limit , $start);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
    	}

    	return $result;
    }

    public function getListEvent($limit=10, $start=0, $related_id=''){
    	
    	$result = array();
    	$this->db->select('ws_event_foo.ws_event_id
    						,ws_event_foo.ws_event_date_create
    						,ws_event_foo.ws_event_title
    						,ws_event_foo.ws_event_summary	
    						,ws_event_foo.ws_event_slug	
    						,ws_event_foo.ws_event_date	
    						,ws_event_image.ws_event_image_path');
    	$this->db->where('ws_event_foo.ws_event_status_publish', '1');	
    	($related_id ? $this->db->where_not_in('ws_event_foo.ws_event_id', array($related_id)) : '');
    	$this->db->order_by('ws_event_foo.ws_event_id', "desc"); 
    	$this->db->join('ws_event_image', 'ws_event_image.ws_event_id = ws_event_foo.ws_event_id');
		$query = $this->db->get('ws_event_foo', $limit , $start);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
    	}

    	return $result;
    }

    public function getDetail($table, $slug){
    	
    	$result = array();
    	$this->db->select('*');	
    	$this->db->where('ws_'.$table.'_status_publish', '1');	
    	$this->db->where('ws_'.$table.'_slug', $slug);	
    	$query = $this->db->get('ws_'.$table.'_foo');
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			$id = $result[0]['ws_'.$table.'_id'];
    		$result[0]['image'] = $this->__getImage($table, $id);
    	}

    	return $result;
    }
    
    function __getImage($table, $id){
    	$result = array();
    	$this->db->select('ws_'.$table.'_image_path');	
    	$this->db->where('ws_'.$table.'_id', $id);	
    	$query = $this->db->get('ws_'.$table.'_image');
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
    	}

    	return $result;
    }

	function count_all_num_rows($table){
	
		return $this->db->count_all($table);
						
	}
	









// Batas ============================





	function count_all_num_rows_bycategory($table, $id){
	
		$this->db->where('status_publish', '1');
		$this->db->where('category_id', $id);
		return $this->db->count_all_results($table);
						
	}
	
	
	function count_all_collection(){
		
		$this->db->select('category_id, category_name');		
		$query = $this->db->get('category_product');
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			$result = $query->result_array();
			
			foreach($result as $key => $val){
				
				
				$this->db->select('category_id, category_name, image_product_1');		
				$this->db->where('category_id', $val['category_id']);
				$this->db->where('status_publish', '1');
				$this->db->order_by('product_id', "desc"); 
				$sql_product = $this->db->get('product_foo', 1);
			
				if($sql_product->num_rows() > 0){
					$r_product = $sql_product->result_array();
					array_push($arr, $r_product[0]); 
				}
				
			}
			
			
			return $result = count($arr);
			
		}	
					
	}
	
	function get_simple($param){
	
		$table = isset($param['table']) ? $param['table'] : $this->table;
		$field = isset($param['field']) ? $param['field'] : '';
		
		if(isset($field)) $this->db->select($field);
		$query = $this->db->get($table);
				
		if ($query->num_rows() > 0)
		{
		    return $result = $query->result_array();
			
		}
	}
	
	function get_productbycategory($limit, $start, $id){
	
		$this->db->select('product_id, image_product_1, category_id, title_product, price_product, desc_product');
		$this->db->where('status_publish', '1');
		$this->db->where('category_id', $id);
		$this->db->order_by('product_id', "desc");		
		$query = $this->db->get('product_foo', $limit , $start);
		$arr = array();
		
		$result = $this->get_categoryid($id);
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}			
					
	}
	
	function get_categoryid($id=null){
	
		$this->db->select('category_id, category_name');
		if(!empty($id)) $this->db->where('category_id', $id);
		$query = $this->db->get('category_product');
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}				
					
	}
	
	function get_newproduct(){
	
		$this->db->select('product_id, image_product_1, category_id, title_product');
		$this->db->where('status_publish', '1');
		$this->db->order_by('product_id', "desc");		
		$query = $this->db->get('product_foo', 3);
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}				
					
	}
	
	function get_bestseller(){
	
		$this->db->select('product_id, image_product_1, category_id, title_product');
		$this->db->where('best_product', '1');
		$this->db->where('status_publish', '1');
		$this->db->order_by('product_id', "desc");		
		$query = $this->db->get('product_foo', 3);
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}				
					
	}
	
	function get_header_content($param){
	
		$table = isset($param['table']) ? $param['table'] : $this->table;
		$id = isset($param['id']) ? $param['id'] : '';
		$field = isset($param['field']) ? $param['field'] : '';
		$sort = isset($param['sort']) ? $param['sort'] : '';
		
		$this->db->order_by($sort, "desc"); 
		$this->db->where($field, $id);
		$query = $this->db->get($table);
			
		if ($query->num_rows() > 0)
		{
		    return $result = $query->result_array();
			
		}	
	}
	
	function get_header_home(){
	
		$this->db->select('header_home_id, header_home_image_1');
		$this->db->where('header_home_status', '1');
		$this->db->order_by('header_home_create', "desc"); 
		$query = $this->db->get('header_home', 5);
			
		if ($query->num_rows() > 0)
		{
		    return $result = $query->result_array();
			
		}	
	}
	
	function get_collection($limit, $start){
		
		$this->db->select('category_id, category_name');		
		$query = $this->db->get('category_product' ,$limit , $start);
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			$result = $query->result_array();
			
			foreach($result as $key => $val){
				
				
				$this->db->select('category_id, image_product_1');		
				$this->db->where('category_id', $val['category_id']);
				$this->db->where('status_publish', '1');
				$this->db->order_by('product_id', "desc"); 
				$sql_product = $this->db->get('product_foo', 1);
			
				if($sql_product->num_rows() > 0){
					$r_product = $sql_product->result_array();
					array_push($arr, $r_product[0]); 
				
					foreach($arr as $k => $v){
						if($v['category_id'] == $val['category_id']){
							$arr[$k]['category_name'] = $val['category_name'];
						}
					}
				
				}
				
			}	
			
			return $result = $arr;
			
		}		
					
	}
	
	function get_press(){
		
		$this->db->select('press_id, press_title, press_image_1, press_desc');
		$this->db->where('press_status_publish', '1');
		$this->db->order_by('press_id', "desc");		
		$query = $this->db->get('press');
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}				
					
					
	}
	
	function get_detail_product($param){
		
		$id = $param['id'];
		$field = $param['field'];
		$table = $param['table'];
		
		$this->db->select($field);
		$this->db->where($id);
		$query = $this->db->get($table);
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
		
		}else{
		
			showerror();
			
		}			
					
					
	}
	
	function get_bearygirls($limit, $start){
		
		$this->db->select('bearlygirl_id, bearlygirl_title, bearlygirl_image_1');
		$this->db->where('bearlygirl_status_publish', '1');
		$this->db->order_by('bearlygirl_id', "desc");		
		$query = $this->db->get('bearlygirl' ,$limit , $start);
		$arr = array();
		
		if ($query->num_rows() > 0)
		{
			
			return $result = $query->result_array();
			
		}				
					
					
	}
	
	function get_footer_text($id = ''){
		
		if(empty($id)) showerror();
		
		$this->db->select('teks_id, teks_desc');
		$this->db->where('teks_position ', $id);
		$this->db->where('teks_status ', '1');
		$this->db->order_by('teks_date', 'desc'); 
		$query = $this->db->get('teks');
			
		if ($query->num_rows() > 0)
		{
		    return $result = $query->result_array();
			
		}
	}
	
	function get_footer($id = ''){
		
		if(empty($id)) showerror();
		
		$this->db->select('image_content_id, image_content_image_1');
		$this->db->where('image_content_position ', $id);
		$this->db->where('image_content_status ', '1');
		$this->db->order_by('image_content_create', 'desc'); 
		$query = $this->db->get('image');
			
		if ($query->num_rows() > 0)
		{
		    return $result = $query->result_array();
			
		}	
	}
	
}
// END Semester_model Class

/* End of file absen_model.php */
/* Location: ./system/application/models/semester_model.php */