<?php

//Parent Menu
$config['menu'] = array('1' => 'Dashboard'
						,'2' => 'User'
						,'3' => 'General'
						);

//Child Menu
$config['sub_menu'][2] = array('List User', 'Permission', 'Log');
$config['sub_menu'][3] = array('Article', 'Event');

//Child Menu Link
$config['sub_menu_link'][2] = array('user', 'permission', 'log');
$config['sub_menu_link'][3] = array('article', 'event');	

///Parent Menu con
$config['menu_icon'] = array('1' => 'fa fa-tachometer'
						,'2' => 'glyphicon glyphicon-user'
						,'3' => 'fa fa-coffee'
						,'7' => 'fa fa-gavel'
						,'8' => 'glyphicon glyphicon-barcode'
					);


?>