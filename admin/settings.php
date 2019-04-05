<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Settings");
	$controller->setpageattr("title","Settings");
	include 'inc/header.php';
	$SettingsList=array('fblink','smtp_host','smtp_user','smtp_pass','smtp_host','contact_address','contact_postcode',
		'contact_city','contact_tel','contact_email','homepage_box2','homepage_box2_title');
	$resulttype = $resultmsg ="";
	$DBArr=array();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$postarr=array();
	foreach ($SettingsList as $key) {
		$t=$_POST[$key];
		$postarr[$key]=$t;
	}

	if($resulttype!='error'){
		unset($DBArr);
		foreach ($SettingsList as $key) {
			if($key=='contact_tel'){
				$postarr[$key]=str_replace(' ', '', $postarr[$key]);
			}
			if($key=='homepage_box2'){
				$dbconnection->ExecuteCommand("UPDATE pages SET value='" . $postarr['homepage_box2'] . "' WHERE name='services'");
			} elseif($key=='homepage_box2_title'){
				$dbconnection->ExecuteCommand("UPDATE pages SET title='" . $postarr['homepage_box2_title'] . "' WHERE name='services'");
			} else{
				$dbconnection->ExecuteCommand("UPDATE settings SET value='" .$postarr[$key] . "' WHERE name='$key'");
			}
		}
		$resulttype='sucess';
		$resultmsg='Settings saved successfully. <a href="index.php">Click here to go back to dashboard.</a>';
	}
}

foreach ($SettingsList as $key) {
	$t = '';
	if($key=='homepage_box2'){
		$t=$dbconnection->ExecCommand("SELECT value FROM pages WHERE name='services'");
	} elseif($key=='homepage_box2_title'){
		$t=$dbconnection->ExecCommand("SELECT title FROM pages WHERE name='services'");
	} else{
		$t=$dbconnection->ExecCommand("SELECT value FROM settings WHERE name='$key'");
	}
	
	$DBArr[$key]=$t[0];
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
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>

        tinymce.init({
        selector:'textarea',
    	menubar: "format edit",
    	theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect",

   		 });

    </script>
    <div class="col-sm-8">
    	<form id="usersettings" method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
    		<div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">General Configuration</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">Facebook Link</label>
			    			<div class="col-sm-8">

			      				<input type="text" class="form-control namefield" name="fblink" placeholder="Facebook Page Address" value="<?php echo $DBArr['fblink']?>">
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Email Settings</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">SMTP Host</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="smtp_host" placeholder="e.g. smtp.domain.com" value="<?php echo $DBArr['smtp_host']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">SMTP Username</label>
			    			<div class="col-sm-8">
			    				<input type="text" class="form-control namefield hidden" name="smtp_user">
			      				<input type="text" class="form-control namefield" name="smtp_user" placeholder="e.g. user@domain.com" value="<?php echo $DBArr['smtp_user']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">SMTP Password</label>
			    			<div class="col-sm-8">
			    				<input type="password" class="form-control namefield  hidden" name="smtp_pass">
			      				<input type="password" class="form-control namefield" name="smtp_pass" placeholder="e.g. p@55w0rd" value="<?php echo $DBArr['smtp_pass']?>">
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Contact Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
			    			<label class="col-sm-4 control-label">Address</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="contact_address" placeholder="eg. 123 Sample Lane" value="<?php echo $DBArr['contact_address']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Postcode</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="contact_postcode" placeholder="eg. BD1 1BD" value="<?php echo $DBArr['contact_postcode']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">City</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="contact_city" placeholder="eg. London" value="<?php echo $DBArr['contact_city']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Telephone</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="contact_tel" placeholder="eg. 01234 123456" value="<?php echo $DBArr['contact_tel']?>" required>
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">E-MAIL Address</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="contact_email" placeholder="eg. info@someone.com" value="<?php echo $DBArr['contact_email']?>" required>
			    			</div> 
			  			</div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Homepage Information</h3>
                </div>
                <div class="box-body">
                    <div class="row">
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Box 2 Title</label>
			    			<div class="col-sm-8">
			      				<input type="text" class="form-control namefield" name="homepage_box2_title"  value="<?php echo $DBArr['homepage_box2_title']?>">
			    			</div>
			  			</div>
			  			<div class="form-group">
			    			<label class="col-sm-4 control-label">Box 2 Content</label>
			    			<div class="col-sm-8">
			    				<textarea name="homepage_box2" cols="110" rows="12"><?php echo $DBArr['homepage_box2']?></textarea>
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div><center><button type="submit" class="btn btn-lg btn-success"><span class='fa fa-gear'></span> Save Settings</button></center></div>
		</form>
    </div>
<?php include 'inc/footer.php'; ?>