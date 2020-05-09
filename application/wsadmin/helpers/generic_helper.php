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
		redirect(base_url('wsadmin.php/error'), 'refresh');
	}
}


if ( ! function_exists('login_page'))
{
	function login_page()
	{	
		redirect('../wsadmin.php/login', 'refresh');
	}
}

if ( ! function_exists('url_admin'))
{
	function url_admin()
	{	
		$url = 'wsadmin.php/';
		return $url;
	}
}

if ( ! function_exists('slug_text'))
{
	function slug_text($text)
	{			
		// replace non letter or digits by -
	    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	 
	    // trim
	    $text = trim($text, '-');
	 
	    // transliterate
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	 
	    // lowercase
	    $text = strtolower($text);
	 
	    // remove unwanted characters
	    $text = preg_replace('~[^-\w]+~', '', $text);
	 	
	    if (empty($text))
	    {
	        return 'n-a';
	    }

	    return $text;
	}
}

if ( ! function_exists('GetMenu'))
{
	function GetMenu(){
		$sess = $_SESSION['username'];
		$result = array();
        
		$CI =& get_instance();
        $CI->load->model('querymodel');
        
        if(!empty($sess['ws_permission_id'])){
	        $result = $CI->querymodel->get_menus(array('ws_permission_id' => $sess['ws_permission_id']));
	        if(!empty($result)){
	            $menu_temp = unserialize($result[0]['ws_menus_temp']);
	        }
    	}
        return $result;
    }        
}

if ( ! function_exists('TanggalIndo'))
{
	function TanggalIndo($tanggal=null, $time=true, $day=true) {   

        $date = strtotime($tanggal);

        $hari=date('w', $date);
        $tgl =date('d', $date);
        $bln =date('m', $date);
        $thn =date('Y', $date);

        switch($hari){      
            case 0 :
                $hari='Minggu';
                break;
            case 1 :
                $hari='Senin';
                break;
            case 2 :
                $hari='Selasa';
                break;
            case 3 :
                $hari='Rabu';
                break;
            case 4 :
                $hari='Kamis';
                break;
            case 5 :
                $hari="Jum'at";
                break;
            case 6 :
                $hari='Sabtu';
                break;
            default:
                $hari='UnKnown';
                break;
        }
    
        switch($bln){       
            case 1 :
                $bln='Januari';
                break;
            case 2 :
                $bln='Februari';
                break;
            case 3 :
                $bln='Maret';
                break;
            case 4 :
                $bln='April';
                break;
            case 5 :
                $bln='Mei';
                break;
            case 6 :
                $bln="Juni";
                break;
            case 7 :
                $bln='Juli';
                break;
            case 8 :
                $bln='Agustus';
                break;
            case 9 :
                $bln='September';
                break;
            case 10 :
                $bln='Oktober';
                break;      
            case 11 :
                $bln='November';
                break;
            case 12 :
                $bln='Desember';
                break;
            default:
                $bln='UnKnown';
                break;
        }

        if($time)
        {   
            $day = ($day==true) ? $hari .', ': '';
            $format = $day.$tgl." ".$bln." ".$thn .' | '. strftime('%H:%M', $date) . ' WIB';
        }else{
            $day = ($day==true) ? $hari .', ': '';
            $format = $day. $tgl." ".$bln." ".$thn;
        }

        return $format;
    }
}
