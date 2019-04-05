<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Pages");
	$controller->setpageattr("title","Pages");
	include 'inc/header.php';
	$pagesList=array('aboutus');
	$resulttype = $resultmsg ="";
	$DBArr=array();
	
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$content_aboutus=$_POST['content_aboutus'];
	$content_aboutustitle=$_POST['aboutustitle'];


	if($resulttype!='error'){
		$dbconnection->ExecuteCommand("UPDATE `pages` SET `value` = '$content_aboutus' WHERE name='aboutus';");
		$dbconnection->ExecuteCommand("UPDATE `pages` SET `title` = '$content_aboutustitle' WHERE name='aboutus';");
		foreach ($pagesList as $key) {
			$t=$dbconnection->ExecCommand("SELECT value FROM pages WHERE name='$key'");
			$DBArr[$key]=$t[0];
			

		}
		$resulttype='sucess';
		$resultmsg='Pages updated successfully. <a href="index.php">Click here to go back to dashboard.</a>';
	}
}
	foreach ($pagesList as $key) {
		$arr=$dbconnection->ExecCommand("SELECT value, title FROM pages WHERE name='$key'");
		$DBArr[$key.'title']=$arr['title'];
		$DBArr[$key]=$arr['value'];
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
                <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                        	<div class="form-group">
				    			<label for="aboutustitle" class="col-sm-2 control-label">Page Title</label>
				    			<div class="col-sm-10">
				      				<input type="text" class="form-control" name="aboutustitle" value="<?php echo $DBArr['aboutustitle'];?>" placeholder="Page title ">
				    			</div>
				  			</div>
				  			<div>&nbsp;</div>
			    			<div class="col-sm-12">
			      				<textarea name="content_aboutus" cols="110" rows="12"><?php echo $DBArr['aboutus'];?></textarea>
			    			</div>
			  			</div>
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div><center><button type="submit" class="btn btn-lg btn-success"><span class='fa fa-gear'></span> Save Settings</button></center></div>
		</form>
    </div>
<?php include 'inc/footer.php'; ?>