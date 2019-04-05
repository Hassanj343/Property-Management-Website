<?php
	require 'loginchk.php';
	require_once('../../Application/init.php');
	$controller->setpageattr("name","Manage Properties");
	$controller->setpageattr("title","Manage Properties");
	include 'header.php';

	if(!$controller->has_permission($pagename,$userrank) or !isset($_GET['id']) or empty($_GET['id'])){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }
	$id=$_GET['id']; 
	$PropertyClass->DeleteProperty($id);?>
	<script type="text/javascript">document.location.href='../manageproperty.php'</script>
