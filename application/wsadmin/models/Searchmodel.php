<?php

class Searchmodel extends  CI_Model {
	
	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
		// $this->output->enable_profiler(TRUE);		
    }
	
	function search_limit_count($param=null, $keyword=null, $table=null)
	{
		
		//$k_word = $this->__proses_keyword($keyword);
		$key_word = isset($keyword['q']) ? $keyword['q'] : '';
		$key_status = isset($keyword['status'] ) ? $keyword['status'] : '';
		$k_word = $key_word;
		
		$field_or = isset($param['or']) ? $param['or'] : '';
		$field_and = isset($param['and']) ? $param['and'] : '';
		
		if(isset($field_or) && $field_or != ''){
		
			foreach($field_or as $key => $val){
				
				$field = $this->db->or_like($val, $k_word);
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
				
				$field = $this->db->or_like($val, $k_word, 'after');
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
				
				$field = $this->db->or_like($val, $k_word, 'before');
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
			}
		
		}
		//printr($field);
		
		$this->db->from($table);
		$count = $this->db->count_all_results();
		
		return $count;
		
	}
	
	function search_limit_data($param=null, $keyword=null, $limit=null, $table=null)
	{
		
		$page = isset($limit['page']) ? $limit['page'] : '';
		$offset = isset($limit['offset']) ? $limit['offset'] : '';
		
		$key_word = isset($keyword['q']) ? $keyword['q'] : '';
		$key_status = isset($keyword['status'] ) ? $keyword['status'] : '';
		
		//$k_word = $this->__proses_keyword($keyword);
		$k_word = $key_word;
		
		$field_or = isset($param['or']) ? $param['or'] : '';
		$field_and = isset($param['and']) ? $param['and'] : '';
		$field_sort = isset($param['desc']) ? $param['desc'] : '';
		
		if(isset($field_or) && $field_or != ''){
			
			foreach($field_or as $key => $val){
				
				$field = $this->db->or_like($val, $k_word);
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
				
				$field = $this->db->or_like($val, $k_word, 'after');
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
				
				$field = $this->db->or_like($val, $k_word, 'before');
				
				if(isset($field_and) && $field_and != ''){
					foreach($field_and as $k => $v){
						$field = $this->db->like($v, $key_status);
					}
				}
				
			}
			
		}
		
		// printr($field);
		
		if(!empty($field_sort)) {
			foreach($field_sort as $key => $val){
				$this->db->order_by($val, $key); 
			}
		}
		
		$this->db->limit($page, $offset);			
		$query = $this->db->get($table);
		$data = $query->result_array();

		//printr($query);

		return $data;
		
	}
		
	function __proses_keyword($keyword = null){
		
		$this->user_config = $this->load->config('config', true);
		
		foreach($this->user_config['status'] as $key => $val){
			
			if(strtolower($keyword) == strtolower($val)){
				
				$result = $key;
				break;
				
			}else{
		
				$result = $keyword; 
				
			}
		
		}
		
		return $result;
	}
	
	
	function search_log_data($param = null, $limit = null){
		
		if(!empty($param)){
			
			$start_date = isset($param['start']) ? $param['start'] : '';
			$end_date = isset($param['end']) ? $param['end'] : '';
			$field = isset($param['field']) ? $param['field'] : '';
			$table = isset($param['table']) ? $param['table'] : '';
			$page = isset($limit['page']) ? $limit['page'] : '';
			$offset = isset($limit['offset']) ? $limit['offset'] : '';
			
			
			$where = array($field.' >=' => $start_date
						   ,$field.' <=' => $end_date
						);
			
			$this->db->order_by($this->id, "desc");	
			$this->db->where($where);
			$this->db->limit($page, $offset);	
			
			$query = $this->db->get($table);
			
			// printr($this->db->where($where));	
			
			if ($query->num_rows() > 0){
				foreach($query->result_array() as $row){
					$result[] = $row;
				}
				
				return $result;
			}		
		}
		
	}
	
	
	function search_log_count($param = null, $limit = null){
		
		if(!empty($param)){
			
			$start_date = isset($param['start']) ? $param['start'] : '';
			$end_date = isset($param['end']) ? $param['end'] : '';
			$field = isset($param['field']) ? $param['field'] : '';
			$table = isset($param['table']) ? $param['table'] : '';
			$page = isset($limit['page']) ? $limit['page'] : '';
			$offset = isset($limit['offset']) ? $limit['offset'] : '';
			
			
			$where = array($field.' >=' => $start_date
						   ,$field.' <=' => $end_date
						);
				
			$this->db->where($where);
			$query = $this->db->get($table);
			
			if($query->num_rows() > 0){
				foreach($query->result_array() as $row){
					$data[] = $row;
				}
				
				$count = count($data);
				return $count;
			}		
		}
		
	}
	

}


