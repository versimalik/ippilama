<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//BARU
if ( ! function_exists('input_box'))
{
	function input_box($attribute, $label='', $note='')
	{	
		if(!is_array($label)){
			$labels = form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));	
		}else{
			$labels = form_label(isset($label['name']) ? $label['name'] : '', '',$label['attr']);
		}

		$tag_html = '<div class="form-group">';
		$tag_html.= $labels;
		$tag_html.= '<div class="col-lg-9">'.form_input($attribute).'</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

if ( ! function_exists('textarea_box'))
{
	function textarea_box($attribute, $label='', $note='')
	{	
		
		if(!is_array($label)){
			$labels = form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));	
		}else{
			$labels = form_label(isset($label['name']) ? $label['name'] : '', '',$label['attr']);
		}

		$tag_html = '<div class="form-group">';
		$tag_html.= $labels;
 		$tag_html.= '<div class="col-lg-9">'.form_textarea($attribute).'</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

if ( ! function_exists('select_multi_box_search'))
{
	function select_multi_box_search($name, $option, $value = '', $label)
	{
		
		$tag_html = '<div class="form-group">';
		$tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));
		$tag_html.= '<div class="col-sm-4">';
		$tag_html.= '<select name="'.$name.'" multiple="" class="chosen-select validate[required] form-control tag-input-style" id="form-field-select-4" data-placeholder="Choose Category...">';
		$tag_html.= option_box_category($option, 0, $value);
		$tag_html.= '</select>';	
		$tag_html.= '</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

if ( ! function_exists('select_box_search'))
{
	function select_box_search($name, $option, $value = '', $label, $root='')
	{
		
		$tag_html = '<div class="form-group">';
		$tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));
		$tag_html.= '<div class="col-sm-4">';
		$tag_html.= '<select name="'.$name.'" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose a State...">';
		if(empty($root)) $tag_html.= '<option value="0">Root</option>';
		$tag_html.= option_box_category($option, 0, serialize(array($value)));
		$tag_html.= '</select>';
		$tag_html.= '</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

if ( ! function_exists('option_box_search'))
{
	function option_box_search($name, $option, $value = '', $ext = '', $label)
	{
		
		$tag_html = '<div class="form-group">';
		$tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));
		$tag_html.= '<div class="col-sm-2">'; 
		$tag_html.= '<select name="'.$name.'" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose Diskon ...">';
		$tag_html.= '<option value="">---</option>';
			foreach($option as $key => $val){
				if(($value != '') && ($value == $key)) {
					$sel = 'selected';
				}		else{
					$sel = '';
				
				}	
				$tag_html.= '<option value="'.$key.'" '.$sel.'>'.$val.$ext.'</option>';
			}
		$tag_html.= '</select>';	
		$tag_html.= '</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

if ( ! function_exists('option_box'))
{
	function option_box($name, $option, $value = '', $label)
	{
		$tag_html = '<div class="form-group">';
		$tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));
		$tag_html.= '<div class="col-sm-4">';
		$tag_html.= '<select name="'.$name.'" id="form-field-select-3" >';
			foreach($option as $key => $val){
					if(($value != '') && ($value == $key)) {
						$sel = 'selected';
					}		else{
						$sel = '';
					
					}	
					$tag_html.= '<option value="'.$key.'" '.$sel.'>'.$val.'</option>';
				}
		$tag_html.= '</select>';
		$tag_html.= '</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}


if ( ! function_exists('option_box_category'))
{
	function option_box_category($data, $parent=0, $value='')
	{

		if(!is_array(unserialize($value))) $value='';

		$selected='';

		static $i = 1;
		$tab = str_repeat(' ',$i);

		static $a = 0;
		$pusher = '-';

		$showPusher = str_repeat($pusher,$a);
		if(isset($data[$parent]))
		{
			$html = $tab;
			$i++;
			foreach($data[$parent] as $key => $val)
			{
				$a++; $selected=''; 
				$child = option_box_category($data, $val['ws_category_id'], $value);

				if($val['ws_category_parent_id'] == 0)
				{
					$listChild = '';
				}

				$html .= $tab;
				if(!empty($value) && in_array($val['ws_category_id'], unserialize($value))) {
					$selected='selected="selected"'; 
				}

				$html .= '<option value="'.$val['ws_category_id'].'"'.$selected.' >'.$showPusher.' '.$val['ws_category_name'].'</option>';
				$a--;

				if($child)
				{
					$i--;
					$html .= $child;
					$html .= $tab;
				}
					
			}
			$html .= $tab;
			return $html;
		}
		else
		{
			return false;
		}
	}	
}


if ( ! function_exists('button'))
{
	function button($attr)
	{
		
		$button = form_button($attr);

		return $button;
	}
}


if ( ! function_exists('input_tags'))
{
	function input_tags($attribute, $label='')
	{	
		
		
		$tag_html = '<div class="form-group">';
        $tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right', 'for'=>'form-field-tags'));
        $tag_html.= '<div class="col-sm-9"><div class="inline">'.form_input($attribute).'</div></div>';
        $tag_html.= '</div>';

		return $tag_html;
	}
}


if ( ! function_exists('input_box_hidden'))
{
	function input_box_hidden($attribute, $label='')
	{	
		
		
		$tag_html = '<div class="form-group">';
        $tag_html.= form_label(isset($label) ? $label : '', '',array('id' => 'form-input-readonly', 'class' => 'col-sm-3 control-label no-padding-right', 'readonly'=>''));
        $tag_html.= '<div class="col-lg-9">'.form_input($attribute).'</div>';
        $tag_html.= '</div>';

		return $tag_html;
	}
}


if ( ! function_exists('multiupload'))
{
	function multiupload($count=4, $image=null, $path='')
	{
		
		$CI =& get_instance();
		
		$tag_html = '';
		
			
		if(!empty($image)){
			
			$config = $CI->load->config->item('ws_thumbnail');
			$dir_image = $config['path_thumb_images'];
			// $i=1;

			for($i=0; $i<($count); $i++){
				
				$j = ($i+1);
				$img = isset($image[$i]['image_path']) ? $image[$i]['image_path'] : '';
				$file = $dir_image.$path.'thumb_'.$img;
				
				if(file_exists($file)) {
					$img_file = base_url('picture').$path.'zoom_'.$image[$i]['image_path'];
				}else{
					$img_file = no_image();
				}
				
				$button = '<span class="butimage btn btn-xs btn-danger">';
				$button.= '<i class="glyphicon glyphicon-trash"></i>';
				$button.= ' Delete Image';
				$button.= '</span>';

				if(empty($img)) $button = '';

				$__upload__ = '<div class="form-group">';
				$__upload__.= '<div class="col-xs-12">';
				// $__upload__.= '<center class="imgview'.($i+1).'"><img src="'.$img_file.'" alt="Image'.($j+1).'" />'.$button.'</center><br/>';
				$__upload__.= '<center class="imgview'.($i+1).'"><img src="'.$img_file.'" alt="Image'.($j+1).'" /></center><br/>';
				$__upload__.= form_upload('userfile['.$i.']','', 'multiple="" id="id-input-image-'.$j.'"');
				$__upload__.= '</div>';
				$__upload__.= '</div>';
				
				
				$tag_html = $tag_html.$__upload__;
				// $i++;	
			}
		
		}else{
			
			for($i=1; $i<=($count); $i++){
				
				$__upload__ = '<div class="form-group">';
				$__upload__.= '<div class="col-xs-12">';
				$__upload__.= form_upload('userfile['.$i.']','', 'multiple="" id="id-input-image-'.$i.'"');
				$__upload__.= '</div>';
				$__upload__.= '</div>';
				
				$tag_html = $tag_html.$__upload__;
	
			}
		
		
		}
				
		return $tag_html;
	}
}
 
if ( ! function_exists('datetimepicker_box'))
{
	function datetimepicker_box($attribute, $label='', $note='')
	{	
		$tag_html = '<div class="form-group">';
		$tag_html.= form_label(isset($label) ? $label : '', '',array('class' => 'col-sm-3 control-label no-padding-right'));
		$tag_html.= '<div class="col-lg-9">'.form_input($attribute).'</div>';
		$tag_html.= '</div>';
		
		return $tag_html;
	}
}

/*
,'title_box' => input_box(array('id' => $this->title_input
													,'placeholder'=>"Title"
													,'maxlength'=>"70"
													,'id' => 'date-timepicker1 validate[required] col-xs-10 col-sm-10'
													,'name'	=> $this->title_input
													,'value' => set_value($this->title_input, isset($title_input) ? $title_input : '')), $label = 'Date *')


<label for="date-timepicker1">Date/Time Picker</label>

														<div class="input-group">
															<input id="date-timepicker1" type="text" class="form-control" />
															<span class="input-group-addon">
																<i class="fa fa-clock-o bigger-110"></i>
															</span>
														</div>
*/

// ========================== Batas ================================ //















if ( ! function_exists('checkall_box'))
{
	function checkall_box($name = null, $value = null)
	{
		
		$attr = array(
			'name'      => 'checkall'
			,'checked'  => FALSE
			,'id'		=> 'checkall'
			,'class'	=>'ace'
		);

		$tag_html = '<label class="pos-rel">';
		$tag_html.= form_checkbox($attr);
		$tag_html.= '<span class="lbl"></span>';
		$tag_html.= '</label>';

		return $tag_html;
	}
}




if ( ! function_exists('check_box'))
{
	function check_box($name, $value, $class='', $_menu_id='', $true='')
	{
		if($true == TRUE){
			
			$checked = TRUE;
			
		}elseif(!empty($_menu_id)){
			foreach($_menu_id as $key => $val){
				if($val == $value) {
					$checked = TRUE;
					break;
				}else{
					$checked = FALSE;
				}
			}
		}else{
			$checked = FALSE;
		}		
		
		$attr = array(
			'name'        => $name,
			'class'       => $class,
			'value'       => $value,
			'checked'     => $checked
		);

		$tag_html = '<label class="pos-rel">';
		$tag_html.= form_checkbox($attr);
		$tag_html.= '<span class="lbl"></span>';
		$tag_html.= '</label>';
		
		return $tag_html;
	}
}





if ( ! function_exists('upload'))
{
	function upload($name='', $label = '', $id='', $count=1)
	{

		for($i=1; $i<=($count); $i++){

			$tag_html = '<div class="form-group">';
			$tag_html.= form_label(isset($label[$i]['label']) ? $label[$i]['label'] : 'IMAGE', '',array('class' => 'control-label col-lg-2'));
			$tag_html.= '<div class="col-lg-8">';
			$tag_html.= '<div class="fileupload fileupload-new" data-provides="fileupload">';
			$tag_html.= '<div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>';
			$tag_html.= '<div><span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span>';
			$tag_html.= '<span class="fileupload-exists">Change</span><input type="file" name="'.$name.'"/></span>';
			$tag_html.= '<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>';
			$tag_html.= '</div>';
			$tag_html.= '</div>';
			$tag_html.= '</div>';
			$tag_html.= '</div>';
		
		}

		return $tag_html;
	}
}




if ( ! function_exists('get_menu'))
{
	function get_menu($data, $parent = 0 ){
		
		static $i = 1;
		$tab = str_repeat(' ',$i);
		static $a = 0;
		$pusher = '-';
		$showPusher = str_repeat($pusher,$a);

		if(isset($data[$parent]))
		{
			$html = $tab;
			$i++;
			foreach($data[$parent] as $key => $val)
			{
				$a++;
				$child = get_menu($data, $val['ws_category_id']);

				if($val['ws_category_parent_id'] == 0)
				{
					$listChild = '';
				}
				$html .= $tab;
				$html .= '<option value="'.$val['ws_category_id'].'">'.$showPusher.' '.$val['ws_category_name'].'</option>';
				$a--;
				if($child)
				{
					$i--;
					$html .= $child;
					$html .= $tab;
				}
			}
			$html .= $tab;
			return $html;
		}
		else
		{
			return false;
		}
	}
}






























// Lama


if ( ! function_exists('multi_upload'))
{
	function multi_upload($count, $id=null)
	{
		
		$CI =& get_instance();
		
		$upload = '';
		
			
		if(!empty($id)){
			
			$img = $CI->querymodel->get_image($id, null);
			$config = $CI->load->sharedconfig('config_thumbnail');
			$dir_image = $config['path_thumb_images'];
			
			foreach($img['images'] as $key => $val){
				
				$file = $dir_image.$img['path_image'].'thumb_'.$val;
				
				if(file_exists($file)) {
					$img_file = base_url('picture').$img['path_image'].'thumb_'.$val;
				}else{
					$img_file = no_image();
				}
				
				$__upload__ = form_fieldset();
				$__upload__.= '<div id="picture">';
				$__upload__.= '<img src="'.$img_file.'" alt="Image'.($key+1).'" />';
				$__upload__.= '</div>';
				$__upload__.= form_fieldset_close();

				$__upload__.= form_fieldset();
				$__upload__.= form_label('Image '.($key+1));
				$__upload__.= form_upload('userfile[]','','size=20');
				$__upload__.= form_fieldset_close();
				
				$upload = $upload.$__upload__;
				
			}
		
		}else{
		
			for($i=1; $i<=($count); $i++){
	
				$__upload__ = form_fieldset();
				$__upload__.= form_label('Image '.$i);
				$__upload__.= form_upload('userfile['.$i.']','','size=20');
				$__upload__.= form_fieldset_close();
				
				$upload = $upload.$__upload__;
	
			}
		
		
		}
				
		return $upload;
	}
}

if ( ! function_exists('multi_upload_file'))
{
	function multi_upload_file($count, $id=null, $note)
	{
		
		$CI =& get_instance();
		
		$upload = '';
		
			
		if(!empty($id)){
			
			$files = $CI->querymodel->get_file($id, null);
			$config = $CI->load->sharedconfig('config_thumbnail');
			$dir_image = $config['path_thumb_file'];
			
			printr($files);
			// die;
			
			foreach($files['files'] as $key => $val){
				
				$file = $dir_image.$files['path_file'].'thumb_'.$val;
				
				if(file_exists($file)) {
					$img_file = base_url('file').$files['path_file'].$val;
				}else{
					$img_file = no_image();
				}
				
				$__upload__ = form_fieldset();
				$__upload__.= '<div id="picture">';
				$__upload__.= '<img src="'.$img_file.'" alt="Image'.($key+1).'" />';
				$__upload__.= '</div>';
				$__upload__.= form_fieldset_close();

				$__upload__.= form_fieldset();
				$__upload__.= form_label('Image '.($key+1));
				$__upload__.= form_upload('userfile[]','','size=20');
				$__upload__.= !empty($note) ? '<div class="reset10"></div><span style="margin-left:10px; color: #7B040F; font-weight:bold">'.$note.'</span>' : '';
				$__upload__.= form_fieldset_close();
				
				$upload = $upload.$__upload__;
				
			}
		
		}else{
		
			for($i=1; $i<=($count); $i++){
	
				$__upload__ = form_fieldset();
				$__upload__.= form_label('File '.$i);
				$__upload__.= form_upload('userfile['.$i.']','','size=20');
				$__upload__.= !empty($note) ? '<div class="reset10"></div><span style="margin-left:10px; color: #7B040F; font-weight:bold">'.$note.'</span>' : '';
				$__upload__.= form_fieldset_close();
				
				$upload = $upload.$__upload__;
	
			}
		
		
		}
				
		return $upload;
	}
}






if ( ! function_exists('radio_box'))
{
	function radio_box($name, $value, $checked)
	{
		$data = array(
					'name'        => $name,
					'value'       => $value,
					'checked'     => $checked,
					'style'       => 'margin-bottom:15px'
				);
		
		$radio_box = form_radio($data);
		
		return $radio_box;
		
	}
}



