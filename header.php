<?php 

$pagetitle = $controller->getpageattr('title'); 
$pagename = $controller->getpageattr('name');
$SettingsList=array('contact_tel','contact_email');
$DBArr=array();
foreach ($SettingsList as $key) {
	$t=$dbconnection->ExecCommand("SELECT value FROM settings WHERE name='$key'");
	$t = $t[0] ? $t[0] : '';
	$DBArr[$key]=$t;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php if(isset($pagetitle)){
    	echo "<title>$pagetitle | Whitehall Properties</title>";
    } else{
    	echo "<title>Whitehall Properties</title>";
    }
    ?>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://necolas.github.io/normalize.css/3.0.1/normalize.css"></link>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </head>
  <body onload="navsetactive()">
	<header class="container">
		<h1 class="row col-md-3 text-hide">
			<a class="logo" href='index.php'><a class="" href='index.php'><img src="images/logo-new.png" alt="Whitehall Properties" width="200" height="140"/></a>
		</h1>
		<div class="row col-9">
			<div class="pull-right">
				<p class="contact-phone text-right"><span class="glyphicon glyphicon-earphone"></span> <?php echo substr($DBArr['contact_tel'], 0, 5) . ' ' . substr($DBArr['contact_tel'], 5);?></p>
				<p class="contact-email text-right"><span class="glyphicon glyphicon-envelope"></span> <?php echo $DBArr['contact_email'];?></p>
			</div>
		</div>
	</header>
	<nav class="navhome">
		<ul class="pull-right">
			<?php if($pagename=="Home"){
				echo '<li><a href="index.php" title="Home" class="active"><span class="glyphicon glyphicon-home"> </span> Home</a></li>';
			}	else{
				echo '<li><a href="index.php" title="Home"><span class="glyphicon glyphicon-home"> </span> Home</a></li>';
			}?>
			
			<?php if($pagename=="investorproperty"){
				echo '<li><a href="SearchSale.php" class="active" title="For Sale">For Sale</a></li>';
			}	else{
				echo '<li><a href="SearchSale.php" title="For Sale">For Sale</a></li>';
			}?>
			
			<?php if($pagename=="viewproperty"){
				echo '<li><a class="active" href="ViewProperty.php" title="To Rent">To Rent</a></li>';
			}	else{
				echo '<li><a href="ViewProperty.php" title="To Rent">To Rent</a></li>';
			}?>
			<?php if($pagename=="contactus"){
				echo '<li><a class="active" href="ContactUs.php" title="Contact Us">Contact Us</a></li>';
			}	else{
				echo '<li><a href="ContactUs.php" title="Contact Us">Contact Us</a></li>';
			}?>
		</ul>
	</nav>

	
