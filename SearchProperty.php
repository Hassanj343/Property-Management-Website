<?php 
require_once('Application/init.php');
$controller->setpageattr("name","viewproperty");
$controller->setpageattr("title","Property Search");

$Location = $Radius = $LATLNG="";
$sql = "SELECT * FROM 'properties'";
if(isset($_POST['search']) && !empty($_POST['search'])){
	$Location=$_POST['search'];
	$LATLNG=$geocoding->getLocation($Location);
}
if(isset($_POST['radius'])){
	$Radius=$_POST['radius'];
	
}
if(!empty($LATLNG)){
	$sql = "SELECT *, ( 3959 * acos( cos( radians(" . $LATLNG['lat'] .") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(" . $LATLNG['lng'] .") ) + sin( radians(" . $LATLNG['lat'] .") ) * sin( radians( lat ) ) ) ) AS distance FROM properties HAVING distance < $Radius ORDER BY distance ;";
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
                    	$images[] = $file;
                    }
                }
            }

            closedir($dh);
            return $images;
        }
    }
}


$quarry=$pdo->Prepare($sql);
$quarry->Execute();
$temp=$quarry->fetchall();

foreach ($temp as $key => $value) {
	if($value['type']=='sale'){
		$properties[]=$value;
	}
}
if(empty($properties)){
	$properties=$dbconnection->fetchall_byval('properties','type','rent');
}
;
include('includes/header.php');


?>
	<section class='MainArea'>
		<div class="container">
			<div class="row">
				<div class="search">
					<form method="post" action="searchproperty.php" class="row">
						<div class="col-sm-8" >
							<input name="search" class="search-input" placeholder="Bradford or BD1" value="<?php echo "$Location";?>">
						</div>
						<div class="col-sm-5 search-radius">
							<select name="radius">
								<option value="1">Within 1 mile</option>
								<option value="5">Within 5 miles</option>
								<option value="10">Within 10 miles</option>
								<option value="15">Within 15 miles</option>
								<option value="20">Within 20 miles</option>
							</select>
						</div>
						<div class="col-sm-2">
							<button type="submit" title="Search" class="search-btn">Search</span></button>
						</div>
					</form>
				</div>
				<div class="PropertyResult">
				<?php if(!empty($Location)){
					echo "<center><h3 class='pagetitle'>Property for Sale in $Location</h3>";
				} else {
					echo "<center><h3 class='pagetitle'>&nbsp;</h3>";
				}?>

					</center>
					<div class="PropertyList col-sm-16">
						<?php
						foreach ($properties as $key => $value) {?>
							<div class="listing">
								<div class="col-sm-12">
									<h3 class="title">&pound; <?php echo $value['price'];?> - <?php echo $value['name'];?>
									<br>
									<small><?php echo $value['address'];?>, <?php echo $value['city'];?> <?php echo $value['postcode'];?></small>
									</h3>
									<p class="desc">
									
										<?php
											$desc=$value['description'];
											$desc=substr(strip_tags($desc), 0,320);
											echo "$desc";
										?>
									</p>
									<a href="ViewProperty.php?id=<?php echo $value['id'];?>" class="pull-right">View Property</a>
								</div>
								<div class="col-sm-4">
									<?php
									$Images='Uploads/'. $value['images'] . '/' . $value['mainimage'];
									echo "<a href='ViewProperty.php?id=". $value['id'] . "'>";
									echo "<img src='$Images' height='150' width'150' class'image'></a>";
									?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
				
	</section>

<?php include('includes/footer.php');?>