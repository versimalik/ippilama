<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body style="padding:20px;background:#FFFFFF;margin:0;padding:0margin:0 auto;font-family:Tahoma, Verdana, Arial, 'Trebuchet MS';font-size: 12px;color:#333333;line-height:normal;">
	<style type="text/css">
	a {color: #973100; text-decoration:none; outline:none}
	a:hover {text-decoration:none; outline:none; color:#CC0000}
	.email_box{width:500px; padding:25px 19px; border:1px solid #DDD;}
	
	</style>
	<div class="email_box">
		
		<?php 
			if(isset($forgot)){
				
				echo isset($content_forgot) ? $content_forgot : '';
			
			}else{
				
				echo isset($content) ? $content : '';
							
			} 
		?>
		<br/><br/><br/><br/>
		<strong>Terima Kasih</strong>
		<br/>
		Administrator
	</div>
</body>
</html>