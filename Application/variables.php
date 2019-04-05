<?php

$controller = new controller();
$dbconnection = new dbconnection();
$geocoding = new geocoder();
$PropertyClass = new Properties();

$AUTH_KEY='$2a$07$6QZTyvbWLhSnD3V3dr4h0u8Xnpkig/kKRlJzT0KnhrvFHiggXhcRq0';

//Mailer Variables
$SMTP_HOST='smtp.mail.yahoo.com';
$SMTP_EMAIL='pcvisionltd@yahoo.co.uk';
$SMTP_PASS='Bradford75';  
$SMTP_FRM='Whitehall Properties';
//End Mailer Variables
$ignore = array( 'cgi-bin', '.', '..','._' );
$adminpages = array(
	'Dashboard' =>array('location'=>'index.php','Permission'=>'0','fa icon'=>'dashboard','hidden'=>false),
	'About Us' =>array('location'=>'pages.php','Permission'=>'3','fa icon'=>'gear','hidden'=>false),
	'Manage Users' =>array('location'=>'manageusers.php','Permission'=>'4','fa icon'=>'user','hidden'=>false),
	'Manage Properties' =>array('location'=>'manageproperty.php','Permission'=>'3','fa icon'=>'building','hidden'=>false),
	'Featured Properties' =>array('location'=>'featuredproperties.php','Permission'=>'3','fa icon'=>'building','hidden'=>false),
	'Testimonials' =>array('location'=>'testimonials.php','Permission'=>'3','fa icon'=>'reply','hidden'=>false),
	'Settings' =>array('location'=>'settings.php','Permission'=>'3','fa icon'=>'gear','hidden'=>false),

	);