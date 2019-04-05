<?php
	$id;
	if(isset($_POST['id'])){
		$id=$_POST['id'];
	} else{
		header('location:index.php');
	}
	require_once('../../Application/init.php');

$query = $pdo->Prepare("DELETE FROM `testimonials` WHERE id=?");
$query->bindValue(1,$id);
$query->Execute();
?>