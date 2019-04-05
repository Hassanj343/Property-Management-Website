<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Users");
	$controller->setpageattr("title","Manage Users");
	include 'inc/header.php';
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }

	$resulttype = $resultmsg ="";

	$UsersList=$dbconnection->fetch_all('users');
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
    	<a href="adduser.php" class="btn btn-primary btn-lg">Add User</a>
    	<br>
    	<div>&nbsp;</div>
    	<div class="box">
            <div class="box-header">
                <h3 class="box-title">User's List</h3>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table id="datatable" class="table table-condensed">
                    
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Options</th>
                    </tr>
                    <?php foreach ($UsersList as $key => $value) { ?>

                    	<tr>
	                        <th style="width: 10px"><?php echo $value['id'];?></th>
	                        <th><?php echo $value['username'];?></th>
	                        <th><?php echo $value['email'];?></th>
	                        <th><a href="modifyuser.php?id=<?php echo $value['id'];?>" disabled><span class='fa fa-gear'> </span> Manage User</a></th>
	                    </tr>
                   	<?php } ?>
                    
                   
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>