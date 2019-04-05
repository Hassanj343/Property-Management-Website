<?php 
	if(empty($_GET['pagename'])){
		header('location:404.php');
		die();
	}
	$pagename=$_GET['pagename'];
	require_once('Application/init.php');
	$pagedata=$dbconnection->fetch_byval('pages','name',$pagename);
	if(empty($pagedata)){
		header('location:404.php');
		die();
	}

	$controller->setpageattr("name","$pagename");
	$controller->setpageattr("title",$pagedata['title']);


	include('includes/header.php');
?>
	<section class="MainArea">
		<div class="container">
			<div class="row col-sm-16">
				<h1><?php echo $pagedata['title'];?></h1>
				<?php echo $pagedata['value'];?>
			</div>
		</div>
	</section>
<?php include('includes/footer.php');?>