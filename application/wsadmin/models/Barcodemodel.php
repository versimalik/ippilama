<?php

class Barcodemodel extends  CI_Model {

	function __construct()
    {
        parent::__construct();
		$this->load->database();

	}
	
	function insertRecord ($data = '', $data_id = '', $table = '', $type='', $data_ext='') {
		
		$table = isset($table) ? $table : $this->table;
		
		if(!empty($data)){
			
			$query = "INSERT INTO ".$this->table."(ws_barcode_date_create, ws_barcode_title, ws_user_create) 
						VALUES (".$data["ws_barcode_date_create"].", ".$data["ws_barcode_title"].", '".$data["ws_user_create"]."')
						ON DUPLICATE KEY UPDATE ws_barcode_count=(ws_barcode_count+1)";

			$success = $this->db->query($query);

			return $success;
			
		}else{
		
			return;		
		
		}
	}


}