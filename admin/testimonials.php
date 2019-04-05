<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Testimonials");
	$controller->setpageattr("title","Testimonials");
	include 'inc/header.php';
	$resultmsg=$resulttype='';
	;
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php } 
	if(isset($_GET['resulttype'])){
		$resulttype=$_GET['resulttype'];
		$resultmsg=$_GET['msg'];
	}
	$testimonials=$dbconnection->fetch_all('testimonials');
	?>
	<?php 
		if(!empty($resulttype)){?>
			<div class="alert alert-info">
				<b><?php echo "$resulttype";?> : </b><?php echo $resultmsg ?>
			</div>
		<?php }	?>
	<div class="col-sm-16">
		<div class="testimonials">
			<div class="col-sm-16 testimonial">
				<a href="addtestimonials.php" class="btn btn-primary">Add Testimonials</a>
				<table id="datatable" class="table table-bordered">
	                <thead>
	                	<tr>
		                    <th>Icon</th>
		                    <th>Name</th>
		                    <th>Description</th>
		                    <th>Rating</th>
		                    <th>Action</th>
		                </tr>
	                </thead>    
	                <tbody>

	                <?php foreach ($testimonials as $key => $value): ?>
	                	<tr>
	                        <th><img src="uploads/Testimonials/<?php echo $value['avtar'];?>" width="100" height="100"></th>
	                        <th><?php echo $value['author'] ?></th>
	                        <th><?php echo $value['description'] ?></th>
	                        <th> <?php echo $value['rating'] ?>/5 </th>
	                        <th><a href="javascript:void()" onclick="RemoveFeedback(<?php echo $value['id'] ?>);" >Remove</a></th>
	                    </tr>
	                <?php endforeach ?>
	                	
	                </tbody>
	                	
	            </table>
			</div>
		</div>
		
	</div>

<script type="text/javascript">
	function RemoveFeedback(id){
		if(id==""){
			return
		}
		if(confirm('Are you sure you want to delete this testimonial?')){
			$.ajax({
			  	url: "ajax/removetestimonial.php",
			  	type: "POST",
				data: { 'id': id}
				}).done(function() {
				  document.location.href='testimonials.php';
				});
		}
	}
</script>
<?php include 'inc/footer.php'; ?>
