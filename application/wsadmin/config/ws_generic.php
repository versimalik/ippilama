<?php

$config['host'] = 'mail.bearhouseshoes.com';
$config['port'] = 587;
$config['username'] = 'bhs@bearhouseshoes.com';
$config['password'] = 'wawan123';
$config['admin'] = 'bhs@bearhouseshoes.com';
$config['name'] = 'Administrator';


//box input search
$config['search'] = array('image', 'header', 'header_content', 'teks');

$config['active'][0] = '<span class="badge badge-danger"><i class="ace-icon glyphicon glyphicon-remove"></i></span>';
$config['active'][1] = '<span class="badge badge-success"><i class="ace-icon glyphicon glyphicon-ok"></i></span>';



//status publish
// $config['status'][0] = 'No Publish';
// $config['status'][1] = 'Publish';

$config['statuses'][0] = '<span class="btn btn-danger btn-sm btn-circle"></span>';
$config['statuses'][1] = '<span class="btn btn-success btn-sm btn-circle"></span>';

//field search
$config['field_search']['or'] = array('ws_article_title', 'ws_article_desc', 'ws_article_status_publish', 'ws_article_keyword', 'ws_article_tags');
// $config['field_search']['and'] = array('ws_status_publish');
$config['field_search']['desc'] = array('ws_article_title');


//setting image
$config['width'] =  235;
$config['height']	= 140;

//setting image thumbnail width & height	
$config['thumb_width'] =  92; //50;
$config['thumb_height']	= 92; //50;

//setting image zoom width & height	
$config['zoom_width'] =  321;
$config['zoom_height']	= 328;

//setting image zoom width & height	
$config['zoom_xtra_width'] =  770;
$config['zoom_xtra_height']	= 450;


//tiny mce editor
$config['plugins'] = 'lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave';
$config['button'][1] = 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect';
$config['button'][2] = 'search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,media,cleanup,help,|,insertdate,inserttime,preview,|,forecolor,backcolor';
$config['button'][3] = 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell';

/* buttion tiny mce editor **

 - bold 			- italic		- underline		- strikethrough		- justifyleft	- justifycenter 
 - justifyright		- justifyfull	- styleselect	- formatselect		- fontselect	- fontsizeselect
 - search			- replace		- bullist		- numlist			- outdent		- indent
 - blockquote		- undo			- redo			- link				- unlink		- anchor			
 - image			- cleanup		- elp			- insertdate		- nserttime		- preview 
 - forecolor		- backcolor		- tablecontrols	- hr				- removeformat	- visualaid	
 - sub				- sup			- charmap		- emotions			- iespell

*/						


/* plugin tiny mce editor **

 - lists		- pagebreak 		- style 		- layer 		- table				- print
 - iespell		- insertdatetime	- preview 		- media 		- searchreplace 	- contextmenu
 - fullscreen 	- noneditable 		- visualchars 	- nonbreaking 	- xhtmlxtras 		- template
 - save			- advhr				- advimage 		- advlink 		- emotions 			- paste 	
 - inlinepopups	- autosave			- directionality 	
 
 */

?>
