<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Users");
	$controller->setpageattr("title","Manage Users");
	$controller->setpageattr("subtitle","Add User");
	include 'inc/header.php';
	$resulttype = $resultmsg ="";
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$username=$_POST['username'];
	$password=$_POST['newpassword'];
	$reppassword=$_POST['repeatpassword'];
	$email=$_POST['email'];
	$name=$_POST['name'];
	$rank=$_POST['rank'];
	$userexist=$dbconnection->ExecCommand("SELECT * FROM users WHERE username='$username'");
	if($password!=$reppassword){
		$resulttype='error';
		$resultmsg="Both password does not match!";
	} elseif (!empty($userexist)) {
		$resulttype='error';
		$resultmsg="Username with this user already exists, please try different username.";
	}

	if($resulttype!='error'){
		$password=crypt($password,$AUTH_KEY);
		$dbconnection->ExecuteCommand("INSERT INTO users (username, name, password, email, permission) VALUES('$username', '$name', '$password', '$email', $rank)");
		$resulttype='sucess';
		$resultmsg="User $username added successfully. <a href='manageusers.php'> Click Here to return to previous page</a>";
	}
}
?>
    <?php if(isset($resulttype)){
    	if($resulttype=='error'){?>
    		<div class="alert alert-danger">
				<?php echo $resultmsg;?>
            </div>  
	<?php } 
		if($resulttype=='sucess'){?>
			<div class="alert alert-success">
                <?php echo $resultmsg;?>
            </div>  
		<?php } }?>
    <div class="col-sm-8">
    	<form id="usersettings" method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
    		<div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Account Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">Username</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control" required name="username" placeholder="Username">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Display Name</label>
			    			<div class="col-sm-8">
			      				<input style="display: none;" type="text" class="hidden" name="name" autocomplete="off">
			      				<input type="text" class="form-control" name="name" placeholder="Display Name">
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
               <div class="box-footer">
               		<div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">User Access</label>
			    			<div class="col-sm-8">
			      				<input style="display: none;" type="text" class="hidden" name="name" autocomplete="off">
			      				<select name="rank" class="btn btn-default">
			      					<option value="1">Add / Modify Properties</option>
			      					<option value="2">Add / Modify / Delete Properties</option>
			      					<option value="3">Manage Properties + Website Settings</option>
			      					<option value="4">Full Access</option>
			      				</select>
			    			</div>
			  			</div>
                    </div>
               </div>
            </div><!-- /.box -->
            <div id="boxpassword" class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Password</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label for="newpassword" class="col-sm-4 control-label">New Password</label>
			    			<div class="col-sm-8">
			      				<input type="password" class="form-control" id="newpass" name="newpassword" required placeholder="New Password">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label for="repeatpassword" class="col-sm-4 control-label">Repeat Password</label>
			    			<div class="col-sm-8">
			      				<input type="password" class="form-control" id="reppass" name="repeatpassword" required placeholder="Repeat Password">
			    			</div>
			  			</div>
                    </div>
                </div>
            </div>
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Recovery Email</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label for="email" class="col-sm-4 control-label">E-mail Address</label>
			    			<div class="col-sm-8">
			      				<input type="email" class="form-control" name="email" placeholder="Email">
			    			</div>
			  			</div>
                    </div>
                </div>
                <div class="box-footer">

                </div>
            </div>

            <div><center><button type="submit" class="btn btn-lg btn-success"><span class='fa fa-gear'></span> Add User</button></center></div>
		</form>
    </div>
<?php include 'inc/footer.php'; ?>