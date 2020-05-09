<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function tinymce($config_name) {
	
	$CI =& get_instance();
	$config = $CI->load->config($config_name);
	$config_tiny = $CI->config->item($config_name);

	// <!-- TinyMCE -->
	$tinymce = '<script type="text/javascript" src="'.base_url().'tinymce/js/tiny_mce.js"></script>';
	$tinymce.= '<script type="text/javascript">';
	// O2k7 skin
	$tinymce.= 'tinyMCE.init({
			// General options
			mode : "exact",
			elements : "elm2",
			theme : "advanced",
			skin : "o2k7",
			plugins : "'.$config_tiny['plugins'].'",
			file_browser_callback : "ajaxfilemanager",
			
			
			// Theme options
			theme_advanced_buttons1 : "'.$config_tiny['button'][1].'",
			theme_advanced_buttons2 : "'.$config_tiny['button'][2].'",
			theme_advanced_buttons3 : "'.$config_tiny['button'][3].'",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "'.base_url().'tinymce/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "'.base_url().'tinymce/lists/template_list.js",
			external_link_list_url : "'.base_url().'tinymce/lists/link_list.js",
			external_image_list_url : "'.base_url().'tinymce/lists/image_list.js",
			media_external_list_url : "'.base_url().'tinymce/lists/media_list.js",

			// Replace values for the template plugin
			
			setup : function(elm2) {
		      elm2.onKeyUp.add(function(elm2, e) {
		          $(".elm2formError").remove(); //tinymce
		      });
		   }

		})';
		
		
	$tinymce.= '
			function ajaxfilemanager(field_name, url, type, win) {
				var ajaxfilemanagerurl = "'.base_url().'tinymce/js/plugins/ajaxfilemanager/ajaxfilemanager.php";
				var view = "detail";
				switch (type) {
					case "image":
					view = "thumbnail";
						break;
					case "media":
						break;
					case "flash": 
						break;
					case "file":
						break;
					default:
						return false;
				}
				tinyMCE.activeEditor.windowManager.open({
					url: "'.base_url().'tinymce/js/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
					width: 782,
					height: 440,
					inline : "yes",
					close_previous : "no"
				},{
					window : win,
					input : field_name
				});
				
				/* return false;			
				var fileBrowserWindow = new Array();
				fileBrowserWindow["file"] = ajaxfilemanagerurl;
				fileBrowserWindow["title"] = "Ajax File Manager";
				fileBrowserWindow["width"] = "782";
				fileBrowserWindow["height"] = "440";
				fileBrowserWindow["close_previous"] = "no";
				tinyMCE.openWindow(fileBrowserWindow, {
				  window : win,
				  input : field_name,
				  resizable : "yes",
				  inline : "yes",
				  editor_id : tinyMCE.getWindowArg("editor_id")
				});
				
				return false;*/
		}';
	
	
	$tinymce.= '</script>';
	//<!-- /TinyMCE -->
	
	return $tinymce;
	
}


?>
