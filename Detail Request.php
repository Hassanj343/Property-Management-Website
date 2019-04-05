<?php 
	if(isset($_POST['id'])) {$_GET['id']=$_POST['id'];}
	if(empty($_GET['id'])){
		header("location:ContactUs.php");
		exit();
	}

	require_once('Application/init.php');
	$controller->setpageattr("name","detailrequest");
	$controller->setpageattr("title","Request Details");
	if(!isset($_GET['id'])){
		header('location:SearchProperty.php');
		die();
	}
$id=$_GET['id'];
$property=$dbconnection->fetch('properties',$id);
if(empty($property)){
	header('location:404.php');
	die();
}

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
	$contact_tel=$dbconnection->ExecCommand("SELECT value FROM settings WHERE name='contact_tel'");
	$contact_tel = $contact_tel[0] ? $contact_tel[0] : '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    
		function ErrorReturn($error){
			$resulttype="Error";
			$resultmsg = $error;
			die();
		}

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

	   	if(strlen($message) < 2) {
	 	   $error_message .= 'The Message you entered do not appear to be valid.<br />';
	   }
	 
	  	if(strlen($error_message) > 0) {
	 		ErrorReturn($error_message);
	   	}
	   	$email_message = "";

	   	function clean_string($string) {
	      $bad = array("content-type","bcc:","to:","cc:","href");
	      return str_replace($bad,"",$string);
	    }

	    $email_message .= "Property Name: ".clean_string($property['name'])."\n";	    
	    $email_message .= "Property Address: ".clean_string($property['address'] . ',' . $property['city']. ',' . $property['postcode'])."\n";	    
	 
	    $email_message .= "Email: ".clean_string($email)."\n";

	    $email_message .= "Contact Number: ".clean_string($telephone)."\n";
	 
	    $email_message .= "Message: ".clean_string($message)."\n";

	    $headers = "From: $email \n\r Reply-To: $email" . 'X-Mailer: PHP/' . phpversion();	   

	    $mail->From = $email;
		$mail->FromName = $name;
		$mail->addAddress($emailto);     // Add a recipient

		$mail->Subject = $email_subject;
		$mail->Body    = $email_message;
		if($emailsent==false){
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
					<h1>Request Details for Property One</h1>
					<?php if($resulttype=="Error"){ ?>
						<p class="alert alert-danger"><?php echo $resultmsg;?></p>
					<?php } else if($resulttype=="Sucess"){?>
						<p class="alert alert-success"><?php echo $resultmsg;?></p>
					<?php }?>	
					<form name="contactus" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<div class="form-group col-sm-8">
							<label class="PropertyDetails">Property Name:</label>
							<label class="PropertyDetails"><?php echo $property['name'];?></label>
						</div>
						<div class="form-group col-sm-8">
							<label class="PropertyDetails">Property Address:</label>
							<label class="PropertyDetails"><?php echo $property['address'];?></label>
						</div>
						<div class="form-group col-sm-8">
							<label class="PropertyDetails">City:</label>
							<label class="PropertyDetails"><?php echo $property['city'];?></label>
						</div>
						<div class="form-group col-sm-8">
							<label class="PropertyDetails">Postcode:</label>
							<label class="PropertyDetails"><?php echo $property['postcode'];?></label>
						</div>
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
							<?php if($emailsent==true){echo '<button type="submit"  class="btn btn-primary disabled pull-right">Send</button>';}
								else {echo '<button type="submit"  class="btn btn-primary pull-right">Send</button>';}
							?>
							
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="contactdetail">

					<h1>Or Call Us</h1>
					<h2> <?php echo substr($contact_tel, 0, 5) . ' ' . substr($contact_tel, 5);?> </h2>
				</div>
			</div>
		</div>
	</section>
<?php include('includes/footer.php');?>