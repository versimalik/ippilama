<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('printr'))
{
	function printr($printr)
	{
			echo'<pre>'; print_r($printr); 	echo'</pre>';
		
		return; 
	}
}

if ( ! function_exists('format_rupiah'))
{
	function format_rupiah($param){
		
		$rupiah = 'Rp '.number_format($param,0,',','.');
	  
		return $rupiah;
	}
}


if ( ! function_exists('no_record'))
{
	function no_record($param)
	{
		$counter = 0;
		
		for($i=1; $i <= $param[1] ;$i++){
			$counter = $counter + $param[0];
		}
		
		$result = ($counter - ($param[0] - 1));

		return $result; 
	}
}

if ( ! function_exists('no_image'))
{
	function no_image()
	{	
		return base_url('picture').'/default/no_image.jpg';
	}
}

if ( ! function_exists('error_page'))
{
	function error_page()
	{	
		redirect(base_url('ws/wsadmin.php/error'), 'refresh');
	}
}


if ( ! function_exists('login_page'))
{
	function login_page()
	{	
		redirect('../ws/wsadmin.php/login', 'refresh');
	}
}

if ( ! function_exists('url_admin'))
{
	function url_admin()
	{	
		$url = 'ws/wsadmin.php/';
		return $url;
	}
}

if ( ! function_exists('slug_text'))
{
	function slug_text($string)
	{			
		return str_replace(' ', '-',$string);
	}
}



