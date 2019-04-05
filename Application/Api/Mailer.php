<?php

require 'PHP Mailer/PHPMailerAutoload.php';
/**
* 
*/
class Mailer
{
	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $SMTP_HOST;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $SMTP_EMAIL;                 // SMTP username
	$mail->Password = $SMTP_PASS;                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepteds
	$mail->FromName = $SMTP_FRM;
	function SendMail($arr){
		print_r($arr);
		$person = $arr['TO'];
		$mail->addAddress($person);     // Add a recipient
		$mail->Subject = $arr['subject'];
		$mail->Body    = $arr['msg'];
		if(!$mail->send()) {
		    return $mail->ErrorInfo;
		} else {
		    return 'Success';
		}
	}	
}



	






