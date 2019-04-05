<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Dashboard");
	$controller->setpageattr("title","Dashboard");
	include 'inc/header.php';

	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php } ?>
	<div class="col-sm-10">
		<?php 
			echo "$userrank <br>";
	        foreach ($adminpages as $key => $value) {
	            $class="";
	            if($value['Permission']<=$userrank && $value['hidden']==false){
	                ?>
	                <a class="btn-dashboard" href="<?php echo $value['location'];?>">
	                	<h3><?php echo $key;?></h3>
	                	<i class="fa fa-<?php echo $value['fa icon'];?> icon pull-right"></i>
	                </a>
	                
	        <?php } } ?>
	</div>

<?php include 'inc/footer.php'; ?>