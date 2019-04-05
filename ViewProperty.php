<?php 
require_once('Application/init.php');
$controller->setpageattr("name","viewproperty");
$controller->setpageattr("title","View Property");
if(!isset($_GET['id'])){
	header('location:SearchProperty.php');
	die();
}
function GetImages($loc){
	$dirbase="Uploads/";
	global $ignore;
    $dir=$dirbase.$loc;
    if(is_dir($dir)){
        if($dh = opendir($dir)){
            $images = array();

            while (($file = readdir($dh)) !== false) {
                if (!is_dir($dir.$file)) {
                	if ( !in_array($file, $ignore)){
                		if($file != "mainimage.png"){

                			$images[$file] = $dir.'/'.$file;
                		}
	                    
	                }
                    
                }
            }

            closedir($dh);
            return $images;
        }
    }
}
$id=$_GET['id'];
$property=$dbconnection->fetch('properties',$id);
if(empty($property)){
	header('location:404.php');
	die();
}
include('includes/header.php');
$contact_tel=$dbconnection->ExecCommand("SELECT value FROM settings WHERE name='contact_tel'");
$contact_tel = $contact_tel[0] ? $contact_tel[0] : '';
?>

	<br>
	<section role="main" class="container MainAreaProperty">
		<div class="row">
			<div class="col-sm-4 sidebar">
				<div class="PropertyDetail">
					<h1>Property Detail</h1>
					<p><?php echo $property['name'];?></p>
					<p><?php echo $property['address'];?></p>
					<p><?php echo $property['city'];?></p>
					<p><?php echo $property['postcode'];?></p>
				</div>
				<hr />
				<div class="Contact">
					<center><a href="Detail Request.php?id=<?php echo $id;?>" class="btn btn-info btn-lg">Request Details</a></center>
					<h1>or call: <b><?php echo substr($contact_tel, 0, 5) . ' ' . substr($contact_tel, 5);?></b></h1>
				</div>

				<hr />
				<div class="Features">
					<h1>Key Features</h1>
					<ul>
						<?php
						$ids = explode("\n", str_replace("\r", "", $property['features']));
						foreach ($ids as $key => $value) {
							echo "<li>$value</li>";
						}
						?>
						
					</ul>
				</div>
				<hr />
				<div class="location">
				
					<h1>Property Location</h1>
					<iframe
					  	width="225"
					  	height="250"
					  	frameborder="0" style="border:0"
					  	src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClPdN9HSCTPCrIs-UwBwANsxdR6fk7dlc
					  	&q=<?php echo $property['postcode'];?>">
					</iframe>
				</div>
			</div>
			<br>
			<div class="col-sm-12 PropertyArea">
				<div class="header">
					<div class="col-sm-10">
						<h1 class="PropertyName">
							<b><?php echo $property['name'];?>
							<br />
							<small><?php echo $property['address'];?>, <?php echo $property['city'];?>, <?php echo $property['postcode'];?></small></b>
						</h1>
					</div>
					<div class="col-sm-6 text-right">
						<h1>£<?php echo $property['price'];?></h1>
					</div>
				</div>
				<div class="Slider">
					<?php
					$images=GetImages($property['images']);
					$mainimage = "Uploads/" . $property['images'] . '/mainimage.png';
					?>
					<ul class="bxslider">
						<li><img src='<?php echo $mainimage ?>' width='730' height='400'></li>
						<?php 
							foreach ($images as $key => $value) {
								echo "<li><img src='$value' width='730' height='400'></li>";
							}
						?>
						
					</ul>
					<div id="bx-pager" class="bxsliderpager">
						<a data-slide-index='0' href=''><img src='<?php echo $mainimage ?>' height='150' width='150' /></a>
						<?php 
							$counter=1;
							foreach ($images as $key => $value) {
								echo "<a data-slide-index='$counter' href=''><img src='$value' height='150' width='150' /></a>";
								$counter++;
							}
						?>
					  	
					</div>
				</div>
				<div class="propertydesc">
					<h1>Description</h1>
					<div class="desc">
						<?php echo $property['description'];?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php include('includes/footer.php');?>