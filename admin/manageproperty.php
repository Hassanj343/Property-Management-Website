<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Properties");
	$controller->setpageattr("title","Manage Properties");
   
	include 'inc/header.php';
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }

	$resulttype = $resultmsg ="";

	$PropertyList_rent=$dbconnection->fetchall_byval('properties','type','rent');
    $PropertyList_sale=$dbconnection->fetchall_byval('properties','type','sale');
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
    <a href="addproperty.php" class="btn btn-primary btn-lg">Add Property</a>
    <div>&nbsp;</div>
    <ul id="tabs" class="nav nav-pills" data-tabs="tabs">
        <li class="active"><a href="#rent" data-toggle="tab">To Rent</a></li>
        <li><a href="#sale" data-toggle="tab">For Sale</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content">
        <!-- Property Rent -->
        <div class="tab-pane active" id="rent">
            <br>
            <div class="col-sm-10">
                <div>&nbsp;</div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Property to Rent</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table id="datatable" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PropertyList_rent as $key => $value) { ?>

                                <tr>
                                    <th><?php echo $value['name'];?></th>
                                    <th><?php echo $value['address'];?></th>
                                    <th><a href="modifyproperty.php?id=<?php echo $value['id'];?>">Modify</a></th>
                                </tr>
                            <?php } ?>
                            </tbody>
                            
                            
                           
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
        <!-- Property Rent -->
        <div class="tab-pane" id="sale">
            <br>
            <div class="col-sm-10">
                <div>&nbsp;</div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Property for Sale</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table  class="table table-condensed" id="datatable2">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($PropertyList_sale as $key => $value) { ?>

                                <tr>
                                    <th><?php echo $value['name'];?></th>
                                    <th><?php echo $value['address'];?></th>
                                    <th><a href="modifyproperty.php?id=<?php echo $value['id'];?>">Modify</a></th>
                                </tr>
                            <?php } ?>
                            </tbody>
                            
                            
                           
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div>
    </div>
    
</div>



<?php include 'inc/footer.php'; ?>