<?php 
require_once('Application/init.php');
$controller->setpageattr("name","testimonials");
$controller->setpageattr("title","Testimonials");

$properties=array();
include('includes/header.php');

$testimonials=$dbconnection->fetch_all('testimonials');
?>
	<section class='MainArea'>
		<div class="container">
			<div class="row">
				<div class="testimonials">
					<div class="col-sm-16">
						<div class="listing">
							<?php foreach ($testimonials as $key => $value): ?>
								<div class="col-sm-8 ">
									<div class="panel panel-default testimonial-all">
										<div class="panel-body">
											<center><img src="admin/uploads/Testimonials/<?php echo $value['avtar'] ?>" class="icon"></center>
											<p><?php echo $value['description'] ?>
											</p>
										</div>
										<div class="panel-footer">
											<center>
												<h4><?php echo $value['author'] ?></h4>
												<div class="rating">
													<?php for ($i=0; $i < $value['rating']; $i++) { 
														echo '<i class="glyphicon glyphicon-star"></i>';
													} ?>												
												</div>

											</center>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
				
	</section>

<?php include('includes/footer.php');?>