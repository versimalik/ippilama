<?php

//====================== IMAGE ===========================//

//path images
$config['path_thumb_images'] = realpath('picture/');

//path gallery images
$config['path_galley'] = realpath(APPPATH . '../../album_gallery/');

//setting type upload
$config['upload_image'] = array('allowed_types' => 'jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG'	
						  ,'upload_path' => $config['path_thumb_images']
						  ,'max_size' => 2000
						  );

//setting image width & height						  
$config['width'] =  240;
$config['height']	= 320;

//setting image thumbnail width & height	
$config['thumb_width'] =  55; //50;
$config['thumb_height']	= 47; //50;

//setting image zoom width & height	
$config['zoom_width'] =  600;
$config['zoom_height']	= 400;

//max count upload image
$config['max_upload']	= 5;

//====================== END IMAGE ===========================//


//====================== FILE ===========================//

//path file
$config['path_thumb_file'] = realpath('file/');

//setting type upload
$config['upload_file'] = array('allowed_types' => 'pdf',
						  'upload_path' => $config['path_thumb_file'],
						  'max_size' => 2000
						  );


//====================== END FILE ===========================//

						  
?>