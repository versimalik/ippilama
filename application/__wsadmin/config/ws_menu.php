<?php

//Parent Menu
$config['menu'] = array('1' => 'Dashboard'
						,'2' => 'User'
						,'6' => 'General'
						// ,'3' => 'Content'
						,'7' => 'Product'
						// ,'4' => 'Category'
						// ,'5' => 'Diskon'
					);

//Child Menu
$config['sub_menu'][2] = array('List User', 'Permission', 'Log');
// $config['sub_menu'][3] = array('Article');
$config['sub_menu'][6] = array('Category', 'Diskon', 'Tags');

//Child Menu Link
$config['sub_menu_link'][2] = array('user', 'permission', 'log');
// $config['sub_menu_link'][3] = array('article');	
$config['sub_menu_link'][6] = array('category', 'diskon', 'tags');

///Parent Menu con
$config['menu_icon'] = array('1' => 'fa fa-tachometer'
						,'2' => 'glyphicon glyphicon-user'
						,'3' => 'fa fa-coffee'
						// ,'4' => 'fa fa-cogs'
						// ,'5' => 'fa fa-cogs'
						,'6' => 'fa fa-leaf'
						,'7' => 'fa fa-gavel'
					);


?>