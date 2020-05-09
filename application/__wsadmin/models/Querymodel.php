<?php

class Querymodel extends  CI_Model {

	function __construct()
    {
        parent::__construct();
		$this->load->database();

		$this->load->config("ws_thumbnail", true);
		$this->path_image = $this->config->item('ws_thumbnail');
				
    }
	
	function count_all_num_rows($table)
	{
		$table = isset($table) ? $table : $this->table;
		return $this->db->count_all($table);
	}
	
	
	function count_all_result($param){
		
		$table = isset($param['table']) ? $param['table'] : '' ;
		$id = isset($param['id']) ? $param['id'] : '' ;
		$field = isset($param['field']) ? $param['field'] : '' ;
		
		$this->db->like($field, $id);
		$this->db->from($table);
		return $this->db->count_all_results();
	
	}
	
	
	function deleteRecord($param, $table){
		
		$table = isset($table) ? $table : $this->table;
			
		if(!empty($param)){
			
			$expl = explode(',',$param);
			
			$param = array($this->id => $expl[0]);
			$__image = $this->get_image($this->table_image, $param);
			
			$this->db->where($this->id, $expl[0]);
			$result = $this->db->delete($table); 
			
			if($result > 0){
				if(!empty($__image) && is_array($__image)){
					foreach($__image as $key => $val){
						if(!empty($val)){
							@unlink($this->path_image['path_thumb_images'].$this->path_pict.$val['image_path']);  
							@unlink($this->path_image['path_thumb_images'].$this->path_pict.'thumb_'.$val['image_path']);
							@unlink($this->path_image['path_thumb_images'].$this->path_pict.'zoom_'.$val['image_path']);
							@unlink($this->path_image['path_thumb_images'].$this->path_pict.'zoom_xtra_'.$val['image_path']);
						}
					}
				}

				$this->db->where($this->id, $expl[0]);
				$this->db->delete($this->table_image); 
			}
			
			return $result;
		}
	}
	
	
	function deleteRecordNoImage($id, $table){
		
		$table = isset($table) ? $table : $this->table;
	
		if(!empty($id)){
			$this->db->where_in($this->id, $id);
			return $result = $this->db->delete($table); 
		}		
	}
	
	function deleteRecordFile($param, $table){
		
		$table = isset($table) ? $table : $this->table;
		
		if(!empty($param)){
			
			$expl = explode(',',$param);
			
			$param = array($this->id => $expl[0]);
			$__file = $this->get_file($param, null);
			
			$this->db->where($this->id, $expl[0]);
			$result = $this->db->delete($table); 
			
			if($result > 0){
				if(!empty($__file) && is_array($__file)){
					foreach($__file['files'] as $key => $val){
						if(!empty($val)){
							@unlink($this->path_image['path_thumb_file'].$this->path_pict.$val);
						}
					}
				}
			}
			
			return $result;
		}
				
	}
	
	function get_file($param, $table){
		
		$table = isset($table) ? $table : $this->table;
		
		$this->db->where($param);
		$result = $this->db->get($table);
		
		if ($result->num_rows() > 0)
		{
		   $result = $result->result_array();
			
			for($d=1; $d<=$this->count_file; $d++){
				$__result_['files'][] = $result[0][$this->file_upload.'_'.$d];
			}
			
			$__result_['path_file'] = isset($result[0][$this->file_upload]) ? $result[0][$this->file_upload] : '';
			
			return $__result_;
		}
	}
	
	
	function get_image($table, $data){

		$this->db->where($data);
		$q = $this->db->get($table);
		$result = $q->result_array();

		if (!empty($result))
		{
		   	$temp = array();
			foreach ($result as $key => $val) {
				$index = ($val['ws_product_image_index']-1);
				$temp[$index]['image_id'] = $val['ws_product_image_id'];
				$temp[$index]['image_path'] = $val['ws_product_image_path'];
			}			
							
			return $temp;
		}
	}
	
	function editRecord($param, $table, $data_ext=''){
		
		$table = isset($table) ? $table : $this->table;
		
		$this->db->where($param);
		$result = $this->db->get($table);
		
		if ($result->num_rows() > 0)
		{
			$result = $result->result_array();
			
			if(!empty($data_ext)){
				
				$funct = $data_ext['funct'];
				$data = $data_ext['data'];
				$table = $data_ext['table'];

				$result[0]['image'] = $this->$funct($table, $data); 
			}

			return $result;
		}else{
			
			error_page();
			
		}
	}
	
	function insertRecord ($data = '', $data_id = '', $table = '', $type='', $data_ext='') {
		
		$table = isset($table) ? $table : $this->table;
		
		if(!empty($data)){
			
			$success = $this->db->insert($table, $data); 
		
			if(isset($success)){
			
				$id = $this->db->insert_id(); 
				
				if(!empty($type) && $type == 'image'){
					
					$result = $this->__insert_data_image($id, $data_id, $table);
					
					if(!empty($result['error']))  { 
						return $result;
					}
					
				}else if(!empty($type) && $type == 'file'){
				 
					$result = $this->__insert_data_file($data, $id, $data_id, $table);
					
					if(!empty($result['error']))  { 
						return $result;
					}
					
				}
				
			}

			if(!empty($data_ext)){
				$funct = $data_ext['funct'];
				$data = $data_ext['data'];

				$this->$funct($data, $this->db->insert_id()); 
			}

			return $this->db->insert_id();
			
		}else{
		
			return;		
		
		}
	}
	
	function __insert_data_file($data, $id, $data_id, $table){
		
		foreach($_FILES as $name => $value){
			if(isset($value['size']) && $value['size'] > 0){
			
				$path = $this->path_image['path_thumb_file'].$this->path_pict;
				
				if(!is_dir($path)){
					mkdir($path, 0777);
				}
				
				$result_cek = $this->cek_upload($name, 'file');
				
				if(!empty($result_cek['error'])){
					
					$err['error']['File_'.$value['number']] = $result_cek['error'];
					$this->db->where($this->id, $id);
					$this->db->delete($this->table);
					return $err;
					
				}else{
					
					$param = array('table' => $table, 
								'field_name' => $data_id, 
								'id' => $id,
								'file_name' => slug_text($data[$this->title_input_en]).'-'.$data[$this->report_years],
								'file' => $this->file_upload.'_'.$value['number'],
								'type' => $value['type'],
								'number' => $value['number']);
					
					$this->__insertFile($param);
					
				}	
			}
		}
	
	}
	
	function __insert_data_image($id, $data_id, $table){

		foreach($_FILES as $name => $value){
			if(isset($value['size']) && $value['size'] > 0){
			
				$path = $this->path_image['path_thumb_images'].$this->path_pict;
				
				if(!is_dir($path)){
					mkdir($path, 0777);
				}
				
				$result_cek = $this->cek_upload($name, 'image');
				
				if(!empty($result_cek['error'])){
					
					$err['error']['image_'.$value['number']] = 'Image '.$value['number'].$result_cek['error'];
					$this->db->where($this->id, $id);
					$this->db->delete($this->table);
				
					return $err;
					
				}else{
					
					$param = array('table' => 'ws_product_image', 
								'field_name' => $data_id, 
								'id' => $id,
								'img' => $this->image_upload.'_'.$value['number'],
								'type' => $value['type'],
								'number' => $value['number']);
					
					$this->__insertImage($param);
					
				}	
			}
		}
	}
	
	function __insertImage ($param){
		
		$field_name = isset($param['field_name']) ? $param['field_name'] : '';
		$img = isset($param['img']) ? $param['img'] : '';
		$id = isset($param['id']) ? $param['id'] : '';
		$img_type = isset($param['type']) ? $param['type'] : '';
		$number = isset($param['number']) ? $param['number'] : '';
		$table = isset($param['table']) ? $param['table'] : '';
		
		$expl = explode('/', $img_type);
		// $image = array($img => $expl[0].'_'.$id.'_'.$number.'.'.$expl[1]);
		$image = $expl[0].'_'.$id.'_'.$number.'.'.$expl[1];
		
		$data = array('ws_product_image_date_create' => time()
					,'ws_product_image_path' => $image
					,'ws_product_image_index' => $number
					,$field_name => $id
				);

		$result = $this->db->insert($table, $data); 
		
		/* Insert Image */
		if(!empty($result)){
			
			$this->load->library('upload');
			$image_data = $this->upload->data();
			
			//Create image
			$config = array(
				'image_library' => 'gd2',
				'source_image' => $image_data['full_path'],
				'new_image' => $this->path_image['path_thumb_images'].$this->path_pict.$expl[0].'_'.$id.'_'.$number.'.'.$expl[1],
				'maintain_ration' => true,
				'width' => $this->__config['width'],
				'height' => $this->__config['height']
			);
			
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();
			//end Create image
			
			//Create image thumbnail
			$config_thumb = array(
				'image_library' => 'gd2',
				'source_image' => $image_data['full_path'],
				'new_image' => $this->path_image['path_thumb_images'].$this->path_pict.'thumb_'.$expl[0].'_'.$id.'_'.$number.'.'.$expl[1],
				'maintain_ration' => false,
				'width' => $this->__config['thumb_width'],
				'height' => $this->__config['thumb_height']
			);
			
			$this->load->library('image_lib', $config_thumb);
			$this->image_lib->initialize($config_thumb);
			$this->image_lib->resize();
			$this->image_lib->clear();
			//end Create image thumbnail
			
			//Create image zoom
			$config_zoom = array(
				'image_library' => 'gd2',
				'source_image' => $image_data['full_path'],
				'new_image' => $this->path_image['path_thumb_images'].$this->path_pict.'zoom_'.$expl[0].'_'.$id.'_'.$number.'.'.$expl[1],
				'maintain_ration' => true,
				'width' => $this->__config['zoom_width'],
				'height' => $this->__config['zoom_width']
			);
			
			$this->load->library('image_lib', $config_zoom);
			$this->image_lib->initialize($config_zoom);
			$this->image_lib->resize();
			$this->image_lib->clear();
			//end Create image zoom
			
			
			//Create image zoom
			$config_xtra_zoom = array(
				'image_library' => 'gd2',
				'source_image' => $image_data['full_path'],
				'new_image' => $this->path_image['path_thumb_images'].$this->path_pict.'zoom_xtra_'.$expl[0].'_'.$id.'_'.$number.'.'.$expl[1],
				'maintain_ration' => true,
				'width' => $this->__config['zoom_xtra_width'],
				'height' => $this->__config['zoom_xtra_height']
			);
			
			$this->load->library('image_lib', $config_xtra_zoom);
			$this->image_lib->initialize($config_xtra_zoom);
			$this->image_lib->resize();
			$this->image_lib->clear(); 
			//end Create image zoom
			
			@unlink($this->path_image['path_thumb_images'].'/'.$image_data['orig_name']);  
			@unlink($this->path_image['path_thumb_images'].'/'.$image_data['file_name']);
			
		}
		
		return;
		
	}

	function __insertFile ($param){
		
		$field_name = isset($param['field_name']) ? $param['field_name'] : '';
		$file = isset($param['file']) ? $param['file'] : '';
		$id = isset($param['id']) ? $param['id'] : '';
		$file_type = isset($param['type']) ? $param['type'] : '';
		$filname = isset($param['file_name']) ? $param['file_name'] : '';
		$number = isset($param['number']) ? $param['number'] : '';
		
		$expl = explode('/', $file_type);
		$data = array($file => $filname.'_'.$id.'_'.$number.'.'.$expl[1]);
	
		$this->db->where($field_name, $id);
		$result = $this->db->update($this->table, $data);
		
		if(!empty($result)){
			
			$this->load->library('upload');
			$file_data = $this->upload->data();
			rename($file_data['full_path'], $this->path_image['path_thumb_file'].$this->path_pict.$filname.'_'.$id.'_'.$number.'.'.$expl[1]);
						
			@unlink($this->path_image['path_thumb_file'].'/'.$file_data['orig_name']);  
			
		}
		
		return;
		
	}

	function updateRecord ($data = '', $data_id = '', $table = '', $type='', $data_ext='') {
		
		$table = isset($table) ? $table : $this->table;
		
		$i=0;
		foreach($_FILES as $name => $value){
			if(isset($value['size']) && $value['size'] > 0){
				
				$result_cek = $this->cek_upload($name, $type);

				if(!empty($result_cek))  {
					
					$err['error']['image_'.$value['number']] = $result_cek['error'];
									
				}else{
					
					if(!empty($type) && $type == 'image'){
							
						$param = array('table' => 'ws_product_image', 
									'field_name' => $data_id, 
									'id' => $data[$this->id],
									'img' => $this->image_upload.'_'.$value['number'],
									'type' => $value['type'],
									'number' => $value['number']);
						
						$this->__insertImage($param);
					
					}else{
					
						$param = array('table' => 'ws_product_image', 
								'field_name' => $data_id, 
								'id' => $data[$this->id],
								'file_name' => slug_text($data[$this->title_input_en]).'-'.$data[$this->report_years],
								'file' => $this->file_upload.'_'.$value['number'],
								'type' => $value['type'],
								'number' => $value['number']);
					
						$this->__insertFile($param);				
											
					}
					
					$i++;
				}	
			}	
		}
		
		if(!empty($result_cek))  { 
		
			return $err;
		}
			
		$this->db->where($data_id, $data[$data_id]);
		unset($data[$data_id]);
		
		$result = $this->db->update($table, $data); 
		
		if(!empty($data_ext)){
			$funct = $data_ext['funct'];
			$data = $data_ext['data'];
			$id = $data_ext['id'];
			$this->$funct($data, $id); 
		}

		return $result;
		
	}

	function queryRecord($page = '', $offset = '', $table){
		
		$table = isset($table) ? $table : $this->table;
		
		$this->db->order_by($this->id, "desc");
		$this->db->limit($page, $offset);
		$query = $this->db->get($table);
		
		if ($query->num_rows() > 0)
		{
		   $result = $query->result_array();
		  
		   return $result;
		}
	}
	
	function cek_upload($name_upload, $type){
		
		$this->load->library('upload');
		
		if($type == 'image'){
			$config = $this->path_image['upload_image'];
		}else if($type == 'file'){
			$config = $this->path_image['upload_file'];
		}
		
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($name_upload))
		{			
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	
	}
	
	function bestProduct($param, $table){
		
		$table = isset($table) ? $table : $this->table;
		$expl = explode(',',$param);
		
		$this->db->select($this->best);
		$query = $this->db->get($table);
		
		if ($query->num_rows() > 0)
		{
		   $result = $query->result_array();
		  
		}
				
		if($expl[1] == 0){
		
			$data[$this->best] = '1';
		
		}else{
			
			$data[$this->best] = '0';
		
		}
		
		$this->db->where($this->id,$expl[0]);
		$result = $this->db->update($table,$data);	
												
		return $result;
	
	}
	
	//==== MODULE MENU =============================
	function get_menus($permission_id){
		$this->db->where($permission_id);
		$check = $this->db->get('ws_menus');
		return $__check = $check->result_array();

	}

	function menus($data){

		$ser = md5(serialize($data['ws_menus_temp']));
		$this->db->where(array('ws_permission_id' => $data['ws_permission_id']));
		$check = $this->db->get('ws_menus');
		$__check = $check->result_array();

		if(empty($__check)){
			
			$data['ws_menus_temp'] = serialize($data['ws_menus_temp']);
			$data['ws_menus_code'] = $ser;
			$success = $this->db->insert('ws_menus', $data); 
			return $success;
		
		}else{

			$data['ws_menus_temp'] = serialize($data['ws_menus_temp']);
			$data['ws_menus_code'] = $ser;
			$this->db->where('ws_permission_id', $data['ws_permission_id']);
			$success = $this->db->update('ws_menus', $data); 
			return $success;

		}
	
	}	

	function delete_menus($id, $table){
		$table = isset($table) ? $table : $this->table;
		
		if(!empty($id)){
			$this->db->where($this->id, $id);
			$result = $this->db->delete($table); 
			if($result){
				$this->db->where('ws_permission_id', $id);
				return $result = $this->db->delete('ws_menus'); 
			}
		}		
	}

	
	//==== MODULE CATEGORY =============================
	function updateCategory($data, $id){
		
		$this->db->where('ws_product_id', $id);
		$this->db->delete('ws_temp_category'); 
		
		$this->insertCategory($data, $id);

	}

	function insertCategory($data, $id){
		
		$data = unserialize($data);
		
		foreach($data as $key => $val){
			$result[$key]['ws_temp_category_date_create'] = time(); 
			$result[$key]['ws_category_product_id'] = $val;
			$result[$key]['ws_product_id'] =  $id; 
		}

		$this->db->insert_batch('ws_temp_category', $result); 

	}

	function get_category(){
		$this->db->select('ws_category_id, ws_category_parent_id, ws_category_name');
		$this->db->where('ws_category_status', '1');
		$check = $this->db->get('ws_category');
		$__check = $check->result_array();
		if(!empty($__check)){				
			foreach($__check as $key => $val){
				$parent_id = $val['ws_category_parent_id'];
				$result[$parent_id][$key] = $val;
			}					
			return $result;
		}
	}
	
	function get_diskon(){
		$this->db->select('ws_diskon_id, ws_diskon_value');
		$this->db->where('ws_diskon_status_publish', '1');
		$q = $this->db->get('ws_diskon_foo');
		$__result = $q->result_array();
		
		foreach($__result as $key => $val){
			$keys = $val['ws_diskon_id'];
			$vals = $val['ws_diskon_value'];
			$result[$keys] = $vals;
		}

		return $result;
	}
	
	function get_tags(){
		$this->db->select('ws_tags_value');
		$q = $this->db->get('ws_tags_foo');
		$__result = $q->result_array();
		
		foreach($__result as $key => $val){
			$vals = $val['ws_tags_value'];
			$result[] = $vals;
		}

		return $result;
	}

}