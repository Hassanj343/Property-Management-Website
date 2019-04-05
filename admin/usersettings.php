<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","User Settings");
	$controller->setpageattr("title","Setting");
	include 'inc/header.php';
	$resulttype = $resultmsg ="";
	$UserDetail = $dbconnection->ExecCommand("SELECT * FROM users WHERE id=" . $_SESSION["userid"]); //get list of details from database
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$p_name=$_POST['name'];
	$p_currpass=$_POST['currentpassword'];
	$p_newpass = $_POST['newpassword'];
	$p_reppass = $_POST['repeatpassword'];
	$p_email = $_POST['email'];

	if(!empty($p_currpass) or !empty($p_newpass) or !empty($p_reppass)){
		if(crypt($_POST['currentpassword'], $AUTH_KEY)!=$UserDetail['password']){
			$resulttype='error';
			$resultmsg='Current Passsword does not match your password. try again!';
		}	elseif(crypt($p_newpass,$AUTH_KEY) == $p_currpass){
			$resulttype='error';
			$resultmsg='New Password cannot be same as old one.';
		}	elseif($p_newpass != $p_reppass){
			$resulttype='error';
			$resultmsg='New Password and Repeat password does not match!';
		}	elseif(strlen($p_newpass)<=5){
			$resulttype='error';
			$resultmsg='New password cannot be less than 6 characters';
		}
	}

	if($resulttype!='error'){
		unset($UserDetail);
		$newpassword = $p_newpass;

		$SQL="UPDATE users SET email='$p_email', name='$p_name'";
		if(!empty($newpassword)){
			$SQL =$SQL . ", password='" . crypt($p_newpass,$AUTH_KEY) . "'";
		}
		$SQL =$SQL . " WHERE id=" . $_SESSION['userid'];
		$dbconnection->ExecuteCommand($SQL);
		$UserDetail = $dbconnection->ExecCommand("SELECT * FROM users WHERE id=" . $_SESSION["userid"]); //get list of details from database
		if(!empty($newpassword)){
			session_destroy();
			?>
				<script type="text/javascript">document.location.href='index.php'</script>
			<?php
		}
	}
}




?>
	<?php if(empty($user_email)){
        ?> 
            <div class="callout callout-danger">
                <i class="fa fa-warning"></i>
                <b>Warning:</b> Recovery email not found!. It is recomended that you set your recovery email.
            </div>

    <?php }?>
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
			      				<?php echo $UserDetail['username'];?>
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
               <div class="box-footer">
               		<div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">Name</label>
			    			<div class="col-sm-8">
			      				<input style="display: none;" type="text" class="hidden" name="name" autocomplete="off">
			      				<input type="text" class="form-control namefield" name="name" placeholder="Name" value="<?php echo $UserDetail['name']?$UserDetail['name']:'';?>">
			    			</div>
			  			</div>
                    </div>
               </div>
            </div><!-- /.box -->
            <div id="boxpassword" class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Change Password</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label for="currentpassword" class="col-sm-4 control-label">Current Password</label>
			    			<div class="col-sm-8">
			      				<input type="password" class="form-control" id="currpass" name="currentpassword" placeholder="Current Password">
			    			</div>
			  			</div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="form-group">
			    			<label for="newpassword" class="col-sm-4 control-label">New Password</label>
			    			<div class="col-sm-8">
			      				<input type="password" class="form-control" id="newpass" name="newpassword" placeholder="New Password">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label for="repeatpassword" class="col-sm-4 control-label">Repeat Password</label>
			    			<div class="col-sm-8">
			      				<input type="password" class="form-control" id="reppass" name="repeatpassword" placeholder="Repeat Password">
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
			      				<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $UserDetail['email']?$UserDetail['email']:'';?>">
			    			</div>
			  			</div>
                    </div>
                </div>
                <div class="box-footer">

                </div>
            </div>

            <div><center><button type="submit" class="btn btn-lg btn-success"><span class='fa fa-gear'></span> Save Settings</button></center></div>
		</form>
    </div>
<?php include 'inc/footer.php'; ?>