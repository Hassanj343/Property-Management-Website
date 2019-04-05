<?php 
require_once('Application/init.php');
$controller->setpageattr("name","Home");
$controller->setpageattr("title","Homepage");

$fblinkarr=$dbconnection->ExecCommand("SELECT * FROM settings WHERE name='fblink'");

$box2=$dbconnection->ExecCommand("SELECT value FROM pages WHERE name='services'");
$box2 = $box2[0] ? $box2[0] : "";

$box2_title=$dbconnection->ExecCommand("SELECT title FROM pages WHERE name='services'");
$box2_title = $box2_title[0] ? $box2_title[0] : "";
$featuredproperty=$dbconnection->ExecCommand('SELECT value FROM settings where name="featuredproperty"');
$featuredproperty = $featuredproperty[0] ? unserialize($featuredproperty[0]) : array();
$propertylist=array();

foreach ($featuredproperty as $key => $value) {
	$listarr=$dbconnection->fetch('properties',$key);
	$propertylist[]=$listarr;
}
$query = $pdo->Prepare("SELECT * FROM testimonials LIMIT 1");
$query->Execute();
$testimonial=$query->fetchall();


include('includes/header.php');?>
	
	<section>
		<div class="banner container-fluid">
			
			<div class="featured">
				<ul class="featuredslider">
					<?php
						foreach ($propertylist as $key => $value) {
							$imagepath='Uploads/'. $value['images'] . '/' . $value['mainimage'];;
							?>
							
						<li>
							<p><?php echo $value['name'];?></p>
							<img src="<?php echo $imagepath;?>" alt="Featured Image" width='285' height='206' >
							<p class="addr"><?php echo $value['address'];?> <br> <?php echo $value['city'];?>, <?php echo $value['postcode'];?></p>
							<a href="ViewProperty?id=<?php echo $value['id'];?>" title="View Property">View Property</a>
						</li>
					<?php } ?>
				</ul>
				<div class="controls ">
					<div class="slideprev pull-left text-hide"></div>
					<div class="slidenext pull-right text-hide"></div>
				</div>
			</div>
			<div class="container hpsearch" style="width:480px; border:1px solid black">
				<form method="post" name="searchform" class="row" onsubmit="return submitsearch();">
					<div class="col-sm-8" >
						<input name="search" class="search-input" placeholder="Bradford or BD1">
					</div>
					<div class="col-sm-4">
						<input class="search-btn-sale" type="submit" onclick="document.pressed=this.value" value="For Sale">
					</div>
					<div class="col-sm-4">
						<input class="search-btn-rent" type="submit" onclick="document.pressed=this.value" value="To Rent">
					</div>
					
				</form>
			</div>
	</section>

	<section class="boxes container">
		<div class="row col-md-16">
			<div id="testimonial" class="col-sm-4 pull-left">
				<h5>Testimonial</h5>
				<?php 
				$testimonial = $testimonial[0];
				$path = 'admin/uploads/Testimonials/' . $testimonial['avtar'];
				 ?>
				<div class="icon">
					<img src="<?php echo $path ?>" height="100" width="100">
				</div>
				<div class="detail">
					<h4><?php echo $testimonial['author'] ?></h4>
					<div class="rating">
						<?php for ($i=0; $i < $testimonial['rating']; $i++) { 
							echo '<i class="glyphicon glyphicon-star"></i>';
						} ?>
					</div>
					<div class="view">
						<a class="text-right" href="testimonials.php">View All <i class='glyphicon glyphicon-arrow-right'></i></a>
					</div>
				</div>
				
			</div>
			
			<div id="emptybox" class="col-sm-4 pull-left">
				<h5><?php echo $box2_title;?></h5>
				<p><?php echo substr($box2, 0,155);?> </p>
				<a class="text-right pull-right" href="ViewPage.php?pagename=services" title="<?php echo $box2_title;?>">Continue</a>
			</div>
			<div id="connect" class="col-sm-3 pull-left">
				<a class="facebook text-hide" href="<?php echo $fblinkarr['value']?>" title="Find us on Facebook">Facebook</a>
				<a class="whywhitehall" href="ViewPage.php?pagename=aboutus" title="Why Whitehall">Why Whitehall</a>
			</div>
		</div>
	</section>
<script type="text/javascript">
	$(function() {
	    if($(window).width() < 1200){
	    	$('.hpsearch').slideDown()
	    	$('.hpsearch').css('bottom', '-10px');
	    }
	    
	});
	function submitsearch(){
		if(document.pressed == 'To Rent')
		{
			document.searchform.action = "SearchProperty.php";
		}
		else	if(document.pressed == 'For Sale')
		{
			document.searchform.action = "SearchSale.php";
		}
		return true;
	}
</script>
<?php include('includes/footer.php');?>