<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Testimonials");
	$controller->setpageattr("title","Testimonials");
	include 'inc/header.php';
	$resulttype='';
	$resultmsg='';
	if(isset($_GET['error'])){
		$resulttype=$_GET['error'];
	}
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index'</script>
	<?php } ?>
	<?php
		if(!empty($resulttype)){?>
			<div class='alert alert-danger'>
				<b>Error:</b><?php echo $resulttype ?>;
			</div>
		<?php } ?>
	<div class="col-sm-10">
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title">Add Testimonial</h3>
            </div>
			<div class="box-body row">

				<form action="inc/addtestimonial.php" method="post" enctype="multipart/form-data">
					<div id="formitems">
						<div class="form-group">
							<label class="col-sm-2">Person Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" placeholder="Enter name" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Person Icon</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="avatar" id="file">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2">Rating</label>
							<div class="col-sm-10">
								<select class="form-control" name="rating">
									<option value="1"> 1 Star </option>
									<option value="2"> 2 Star </option>
									<option value="3"> 3 Star </option>
									<option value="4"> 4 Star </option>
									<option value="5"> 5 Star </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-12">Description</label>
							<div class="col-sm-12">
								<textarea name="desc" id="desc" cols="10" rows="10" class="form-control" required></textarea>
							</div>
						</div>
					</div>
				
			</div>
			<div class="box-footer">
				<center><button class="btn btn-primary"> Add Testimonial</button></center>
			</div>
			</form>
		</div>
		
	</div>

<?php include 'inc/footer.php'; ?>