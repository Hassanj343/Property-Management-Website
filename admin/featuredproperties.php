<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Featured Properties");
	$controller->setpageattr("title","Featured Properties");
   
	include 'inc/header.php';
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }

	$resulttype = $resultmsg ="";

	$PropertyList=$dbconnection->fetch_all('properties');
    $fproperty=$dbconnection->ExecCommand('SELECT value FROM settings where name="featuredproperty"');
    $fproperty = unserialize($fproperty[0]);


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $arr= array();
    if(isset($_POST['fproperty'])){
        $arr=$_POST['fproperty'];
    }
    
    if(empty($arr)){
        $resulttype='error';
        $resultmsg='Atleast one featured property is required!.';
    }
    $finalisedarr=array();
    unset($fproperty);
    foreach ($arr as $key => $value) {
        $finalisedarr[$value]=$value;
    }
    $endresult=serialize($finalisedarr);
    $dbconnection->ExecuteCommand("UPDATE settings SET value='$endresult' WHERE name='featuredproperty'");
    $resulttype='sucess';
    $resultmsg='Featured Properties updated successfully. <a href="index">Click here to go back to dashboard.</a>';
    $fproperty=$dbconnection->ExecCommand('SELECT value FROM settings where name="featuredproperty"');
    $fproperty = unserialize($fproperty[0]);
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
    <div class="col-sm-10">
    	
        <form id="usersettings" method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">    
    	<button type="submit" class="btn btn-primary btn-lg">Update Featured Properties</button>
        <br>
        <div>&nbsp;</div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User's List</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed">
                    
                    <tr>
                        <th style="width: 10px"></th>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                    
                    <?php foreach ($PropertyList as $key => $value) { 
                        $checked="";
                        if(in_array($value['id'], $fproperty)){
                            $checked='checked';
                        }
                        ?>
                    	<tr>
	                        <th style="width: 10px"> <input type="checkbox" <?php echo $checked;?> name="fproperty[]" value="<?php echo $value['id'];?>"</th>
	                        <th><?php echo $value['name'];?></th>
	                        <th><?php echo $value['address'];?></th>
	                    </tr>
                   	<?php } ?>
                    
                    
                   
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        </form>
    </div><!-- /.col -->
</div>
<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>