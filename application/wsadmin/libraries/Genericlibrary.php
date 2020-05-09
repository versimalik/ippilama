<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Genericlibrary {
		
	public function __construct() {
        
		$CI =& get_instance();
		$CI->load->library('phpmailler/phpmailer');
		$CI->load->config('ws_generic', true);
		$this->conf_generic = $CI->load->config('ws_generic');
		//printr($CI);
    }
	
	public function __templateEmail($TEdata = null, $data = null){
		
		$CI =& get_instance();
		$TEdata['template'] = $CI->load->view('module/global/email/template_email', $data, true);
		//send email
		$result = $this->__sendEmail($TEdata);
		
		return $result;
	}
	
	public function __sendEmail($Edata = null){
		
		//printr($Edata);
		//die();
		
		if(empty($Edata)) {
			
			$result = array('Message not sent ... &nbsp;&nbsp; Silahkan coba lagi');
			return $result;
		
		}
		
		$to = $Edata['email'];
		$name = $Edata['name'];
		$subject = $Edata['subject'];
		$body = $Edata['template'];
		
		//smtp
		$host = $this->conf_generic['host'];
		$port = $this->conf_generic['port'];
		$username = $this->conf_generic['username'];
		$password = $this->conf_generic['password'];
		
		$mail             = new PHPMailer();
		$mail->IsSMTP();
		//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = $host; 
		$mail->Port       = $port; 
		$mail->Username   = $username; 
		$mail->Password   = $password;  
		$mail->SetFrom($this->conf_generic['admin'], $this->conf_generic['name']);
		$mail->AddReplyTo($this->conf_generic['admin'], $this->conf_generic['name']);
		$mail->Subject    = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name); //tujuan

		if($mail->Send()) {
			
			$result = array('succes' => "Message sent ... &nbsp;&nbsp; Check Email Anda");
			return $result;
		
		} else { echo "Mailer Error: " . $mail->ErrorInfo; }
		
	}
	
	

}