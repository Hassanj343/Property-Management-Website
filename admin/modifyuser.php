<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Users");
	$controller->setpageattr("title","Manage Users");
	$controller->setpageattr("subtitle","Modify User");
	include 'inc/header.php';
	$resulttype = $resultmsg ="";
	if(isset($_SESSION['modifyuserid'])){
		$_GET['id']=$_SESSION['modifyuserid'];
	}
	if(!isset($_GET['id'])){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php } else{$_SESSION['modifyuserid']=$_GET['id'];}
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }
	$UserDetail = $dbconnection->ExecCommand("SELECT * FROM users WHERE id=" . $_SESSION['modifyuserid']); //get list of details from database
	if(empty($UserDetail)){
		echo "Error 2";
		?>
		<script type="text/javascript">//document.location.href='index.php'</script>
	<?php }
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$p_name=$_POST['name'];
	$p_newpass = $_POST['newpassword'];
	$p_reppass = $_POST['repeatpassword'];
	$p_email = $_POST['email'];
	$p_rank=$_POST['rank'];
	if(!empty($p_newpass) or !empty($p_reppass)){
		if($p_newpass != $p_reppass){
			$resulttype='error';
			$resultmsg='New Password and Repeat password does not match!';
		}
	}

	if($resulttype!='error'){
		unset($UserDetail);
		$newpassword = $p_newpass;

		$SQL="UPDATE users SET email='$p_email', name='$p_name', permission='$p_rank'";
		if(!empty($newpassword)){
			$SQL =$SQL . ", password='" . crypt($p_newpass,$AUTH_KEY) . "'";
		}
		$SQL =$SQL . " WHERE id=" . $_SESSION['modifyuserid'];
		$dbconnection->ExecuteCommand($SQL);
		$UserDetail = $dbconnection->ExecCommand("SELECT * FROM users WHERE id=" . $_SESSION['modifyuserid']); //get list of details from database
		$resulttype='sucess';
		$resultmsg='User Modification successful. <a href="index.php">Click here to go back to dashboard.</a>';
		unset($_SESSION['modifyuserid']);
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
			  			<div class="form-group">&nbsp;</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Name</label>
			    			<div class="col-sm-8">
			      				<input style="display: none;" type="text" class="hidden" name="name" autocomplete="off">
			      				<input style="display: none;" type="text" class="hidden" name="name" autocomplete="off">
			      				<input type="text" class="form-control namefield" name="name" placeholder="Name" value="<?php echo $UserDetail['name']?$UserDetail['name']:'';?>">
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
               <div class="box-footer">
               		<div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">User Access</label>
			    			<div class="col-sm-8">
			      				
			      				<select name="rank" class="btn btn-default">
			      					<option <?php if($UserDetail['permission']==1) echo 'selected="selected"';?> value="1">Add / Modify Properties</option>
			      					<option <?php if($UserDetail['permission']==2) echo 'selected="selected"';?> value="2">Add / Modify / Delete Properties</option>
			      					<option <?php if($UserDetail['permission']==3) echo 'selected="selected"';?> value="3" >Manage Properties + Website Settings</option>
			      					<option <?php if($UserDetail['permission']==4) echo 'selected="selected"';?> value="4">Full Access</option>
			      				</select>
			    			</div>
			  			</div>
                    </div>
               </div>
            </div><!-- /.box -->
            <div id="boxpassword" class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Change Password</h3>
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