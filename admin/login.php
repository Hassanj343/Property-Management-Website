<?php 
require_once('../Application/init.php');
session_start();
$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = stripcslashes($_POST["username"]);
  	$password = stripcslashes($_POST["password"]);
	if(empty($username) or empty($password)){
		$error = "Both username and password are required";
	} else{
		$password = crypt($password, $AUTH_KEY);
		echo $password;
		$result=$dbconnection->ExecCommand("SELECT * FROM users WHERE username='$username' AND password='$password'");
		if(!empty($result)){
	  		$_SESSION['logged_in']=true;
        	$_SESSION['userid']=$result['id'];
        	$_SESSION['userrank']=$result['permission'];
        	echo '<script type="text/javascript">window.location = "index.php"</script>';
        }	else {
	  		$error = 'Username or Password entered is invalid!';
	  	}



	}
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css">

</head>
<body class="container">
	<div class="row main">
		<center><h1>Login to continue</center>
		<?php 
			if(!empty($error)){?>
				<div class="alert alert-danger" role="alert"><?php echo $error;?></div>
			<?php } ?>
		<form method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
			<div class="fields">
				<div>
					<label for="username">Username:</label>
					<input class="col-sm-12" name="username" placeholder="Username" required>
				</div>
				<div>
					<label for="password">Password:</label>
					<input class="col-sm-12" type="password" name="password" placeholder="Password" required>
				</div>

				<!-- <a href="#">Forgot your password?</a> -->
			</div>	

			<div class="buttons">
				<center><button type="submit" class="btn btn-lg">Login</button></center>
			</div>
		</form>
	</div>

</body>
</html>