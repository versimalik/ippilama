<?php $status = isset($this->__config['status']) ? $this->__config['status'] : ''; ?>

<div class="nav-search" id="nav-search">
	<?php echo form_open('../'.url_admin().$this->module.'/search?','method=GET', array('class'=>'form-search') ); 
		
		$this->load->config("ws_generic", true);
		$cfg_box_search = $this->config->item("ws_generic");
		
		if (!in_array($this->module, $cfg_box_search['search'])){	
			
			$data = array(
			  'name'        => 'q'
			  ,'class'       => 'nav-search-input'
			  ,'placeholder' =>'Search ...'
			  ,'id'=>'nav-search-input'
			  ,'autocomplete'=>'off'
			);

			$input = '<span class="input-icon">';
			$input.= form_input($data);
			$input.= '<i class="ace-icon fa fa-search nav-search-icon"></i>';
			$input.= '</span>';
			echo $input;
			// echo '<i class="ace-icon fa fa-search nav-search-icon"></i>';
			
		
		}
		
		if(isset($status) && $status != ''){
		
			$status['all'] = 'All';
			$selected = array('all');
			echo form_dropdown('s', $status, $selected);

		}
		?>

		<?php
		// $attr = array(
		// 	  'type'	 => 'submit'
		// 	  ,'class'   => 'search-btn btn btn-sm btn-primary'
		// 	  ,'content' => '<i class="glyphicon glyphicon-search">&nbsp;<strong>Search</strong></i>'
		// 	);


                // <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                // <i class="ace-icon fa fa-search nav-search-icon"></i>
            

		// echo '&nbsp;&nbsp;'.button($attr);
		echo form_close();
	?>
</div>
