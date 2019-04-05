<?php 
	require_once('Application/init.php');
	$controller->setpageattr("name","404 Page Not Found!");
	$controller->setpageattr("title",'404 Page Not Found!');


	include('includes/header.php');
?>
	<section class="container">
		<div class="row">
			<div id="content" class="col-sm-16">
				<h1 style="text-align:center;font-size:36px">404 Page Not Found!</h1>
				<h4 style="text-align:center">The page you requested was not found.<br><p><a href="index">Click here to go back to homepage</a></p></h4></h4>
			</div>
		</div>
	</section>