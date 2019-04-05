<?php
session_start();
if(!isset($_SESSION['logged_in'])){
	echo "<script>document.location.href='login.php'</script>";
	die();

}


?>