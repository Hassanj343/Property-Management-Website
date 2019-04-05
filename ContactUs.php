<?php 

	require_once('Application/init.php');
	$controller->setpageattr("name","contactus");
	$controller->setpageattr("title","Contact Us");


	include('includes/header.php');
	$resulttype = $name = $email = $message = $resultmsg ="";
	$SettingsList=array('smtp_host','smtp_user','smtp_pass','smtp_host','contact_address','contact_postcode',
		'contact_city','contact_tel','contact_email');
	$DBArr=array();
	foreach ($SettingsList as $key) {
		$t=$dbconnection->ExecCommand("SELECT value FROM settings WHERE name='$key'");
		$t = $t[0] ? $t[0] : '';

		$DBArr[$key]=$t;
	}
	require 'Api/PHP Mailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $DBArr['smtp_host'];  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $DBArr['smtp_user'];                 // SMTP username
	$mail->Password = $DBArr['smtp_pass'];                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	$emailto=$DBArr['contact_email'];
	$resulttype;$resultmsg;
	$emailsent=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		

		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
			$name=$_POST['name'];
			$message=$_POST['message'];
			$email=$_POST['email'];
			$telephone=$_POST['number'];
		}

		$email_subject = "Message from $name | Whitehall Properties";
		$error_message = "";
	 
	    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	 
	  	if(!preg_match($email_exp,$email)) {
	  		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	 	}

	    $string_exp = "/^[A-Za-z .'-]+$/";

	  	if(!preg_match($string_exp,$name)) {
	     	$error_message .= 'The Name you entered does not appear to be valid.<br />';
		}

	   	if(strlen($message) < 4) {
	 	   $error_message .= 'The Message you entered do not appear to be valid.<br />';
	   }
	 
	  	if(strlen($error_message) > 0) {
	 		$resulttype="Error";
			$resultmsg = $error_message;
	   	}
	   	$email_message = "";

	   	function clean_string($string) {
	      $bad = array("content-type","bcc:","to:","cc:","href");
	      return str_replace($bad,"",$string);
	    }

	    $email_message .= "Name: ".clean_string($name)."\n";
	 
	    $email_message .= "Email: ".clean_string($email)."\n";

	    $email_message .= "Contact Number: ".clean_string($telephone)."\n";
	 
	    $email_message .= "Message: ".clean_string($message)."\n";

	    $headers = "From: $email \n\r Reply-To: $email" . 'X-Mailer: PHP/' . phpversion();	   

	    $mail->From = $email;
		$mail->FromName = $name;
		$mail->addAddress($emailto);     // Add a recipient

		$mail->Subject = $email_subject;
		$mail->Body    = $email_message;
		
		if($emailsent==false && $resulttype!='Error'){
			if(!$mail->send()) {
				$resulttype="Error";
				$resultmsg='Message could not be sent.<br>'.'Error: ' . $mail->ErrorInfo;
			} else {
			    $resulttype="Sucess";
				$resultmsg="
				Thank you for contacting us<br>
	We have received your enquiry and will respond to you as soon as possible. 
	For urgent enquiries please call us on one of the telephone numbers on side.
				";
				$emailsent=true;
			}
	}
}
?>

	<section role="main" class="container contactus">
		<div class="row">
			<div class="col-sm-12 pull-left">
				<div class="contactform">
					<h1>Contact Us</h1>
					<?php if($resulttype=="Error"){ ?>
						<p class="alert alert-danger"><?php echo $resultmsg;?></p>
					<?php } else if($resulttype=="Sucess"){?>
						<p class="alert alert-success"><?php echo $resultmsg;?></p>
					<?php }?>	
					<form name="contactus" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						
						<div class="form-group col-sm-8">
							<label for="name">Name *</label>
							<input type="text" name="name" class="form-control col-sm-12" required autofocus/>
						</div>
						<div class="form-group col-sm-8">
							<label for="name">E-Mail *</label>
							<input type="email" name="email" class="form-control col-sm-12" required/>
						</div>
						<div class="form-group col-sm-16">
							<label for="name">Contact Number *</label>
							<input type="number" name="number" class="form-control col-sm-12" required/>
						</div>
						<div class="form-group col-sm-16">
							<label for="name">Message *</label>
							<textarea name="message" class="form-control" rows="8" cols="50" required></textarea>
						</div>
						<div class="form-group col-sm-16">
							<?php if($emailsent==true){echo '<button type="submit"  class="btn btn-success disabled pull-right">Send</button>';}
								else {echo '<button type="submit"  class="btn btn-success pull-right">Send</button>';}
							?>
							
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="contactdetail">
					<h1>EMAIL</h1>
					<p><?php echo $DBArr['contact_email'];?></p>
					<h1>TELEPHONE</h1>
					<p> <?php echo substr($DBArr['contact_tel'], 0, 5) . ' ' . substr($DBArr['contact_tel'], 5);?> </p>
					<h1> Emergency out of hours number </h1>
					<p> 07564923312 </p>
					<h1>ADDRESS</h1>
					<p>Whitehall Properties.</p>
					<p><?php echo $DBArr['contact_address'];?></p>
					<p><?php echo $DBArr['contact_city'];?></p>
					<p><?php echo $DBArr['contact_postcode'];?></p>
					<p>United Kingdom</p>
				</div>
			</div>
			<div class="col-sm-16">
			<div class="roundedbg-top"><h1><span class="glyphicon glyphicon-map-marker"></span> Our Location</h1></div>
			<iframe
			  	width="940"
			  	height="400"
			  	frameborder="0" style="border:0"
			  	src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClPdN9HSCTPCrIs-UwBwANsxdR6fk7dlc
			  	&q=<?php echo $DBArr['contact_postcode'];?>">
			</iframe>
			</div>
		</div>
	</section>
<?php include('includes/footer.php');?>