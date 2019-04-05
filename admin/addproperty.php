<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Properties");
	$controller->setpageattr("title","Manage Properties");
    $controller->setpageattr("subtitle","Add Property");
	include 'inc/header.php';
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }

	$resulttype = $resultmsg ="";
    $Sucess=1;

    $file_error;
    $incompatible_file=0;

    $errmsg="Following files could not be uploaded due to incompatible file types. We only accept .gif, .jpeg, .png .<br>";
    $p_name = $mainimage_name = $p_address = $p_postcode = $p_city = $p_description = $p_type = $LATLNG = $p_lat = $price = $bed = $p_lng = "";
    $f_name = $f_type = $f_tmpn = $f_error = $f_size = "";
    
    $property_folder="";

    $allowedtypes = array('image/jpeg', 'image/gif', 'image/png');

    function Sucess($msg){
        if(isset($msg)){
            $resulttype='Sucess';
            $resultmsg = $msg;
        }
    }
    function UploadFile($fname,$foldern,$type,$imgcounter=0){
        $imagecounter=$imgcounter;
        $OK=0;
        $loc="../Uploads/$foldern";
        $property_folder="$foldern";
        $filename="";
        $type = substr($type, 6);
        if($fname && $foldern){
            if (!file_exists($loc)) {
                mkdir($loc, 0777, true);
            }
            $filename="$foldern"."_$imagecounter";
            $imagecounter++;
            if(move_uploaded_file($fname, "$loc/$filename.$type")){
                $OK=1;
            }
            else{
                $OK=0;
            }

        }
        return $foldern;
    }
    $imagecounter=0;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $p_name=$_POST['name'];
    $p_address=$_POST['addr'];
    $p_postcode=$_POST['postcode'];
    $p_city=$_POST['city'];
    $p_description=$_POST['desc'];
    $LATLNG=$geocoding->getLocation($p_postcode);
    $p_lat=$LATLNG['lat'];
    $p_lng=$LATLNG['lng'];
    $price=$_POST['price'];
    $bed=$_POST['beds'];
    $p_type=$_POST['type'];
    $features=$_POST['features'];
    $mainimage=$_FILES['mainimage'];
    if(empty($p_address) or empty($p_postcode)){
        $resulttype='error';
        $resultmsg='Address or Postcode is required!';
    }
        if($resulttype!='error'){
            if(isset($_FILES['images'])){
            $f_name = $_FILES['images']["name"];
            $f_type = $_FILES['images']["type"];
            $f_tmpn = $_FILES['images']["tmp_name"];
            $f_error = $_FILES['images']["error"];
            $f_size = $_FILES['images']["size"];
        }
        $currfolder=date("dhis");
        $pfolder="";
        for($i = 0; $i < count($f_tmpn); $i++){
            if(in_array($f_type[$i], $allowedtypes))    {
                $pfolder=$controller->UploadFile($f_tmpn[$i],$currfolder,$f_type[$i]);
            }
            else{
                $str=$f_name[$i];
                if(strlen($str)>=1){
                    $incompatible_file++;
                    $file_error[]=$f_name[$i];
                }
            }
        }
        if(isset($mainimage)){
            if(file_exists("../Uploads/$currfolder"."/mainimage.png")){
                unlink("../Uploads/$currfolder"."/mainimage.png");
            }
            if(move_uploaded_file($mainimage['tmp_name'], "../Uploads/$currfolder"."/mainimage.png" )){
                $mainimage_name = "mainimage.png";
            }
            else {
                $Success=0;
                $incompatible_file++;
                $file_error[]=$mainimage['name'];
            }
        }
        if($incompatible_file>=1){
            for($i = 0; $i < count($file_error); $i++){
                $t=$file_error[$i];
                if(strlen($t)>=1){
                    $errmsg.=$file_error[$i]."<br>";
                }
            }
            $resulttype='error';
            $resultmsg = $errmsg;
            $Sucess=0;
        }
        else{$Sucess=1;}
        if($Sucess==1){
            $PropertySubmit=$PropertyClass->InsertProperty($p_name,$p_address,$p_postcode,$p_city,$p_description,$pfolder,$p_lat,$p_lng,$price,$bed,$features,$p_type,$mainimage_name);
            
            $resulttype='sucess';
            $resultmsg = "New property added successfully. <a href='manageproperty'> Click Here to return to previous page</a>";
        }
    }
}
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
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
        selector:'.jdesc',
        menubar: "format edit",
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect",

         });
    </script>
    <div class="col-sm-10">
        <form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post" enctype="multipart/form-data">
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" class="form-control">
                        <option value="rent">To Rent</option>
                        <option value="sale">For Sale</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="name" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="price" placeholder="Property Price" required autofocus>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Property Name" required autofocus>
                </div>
            </div>
            
            <div class="form-group col-sm-8">
                <label for="beds" class="col-sm-2 control-label">Beds</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="beds" placeholder="Number of Beds">
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="addr" placeholder="Property Address" required>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="postcode" class="col-sm-2 control-label">Postcode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="postcode" placeholder="Property Postcode" required>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="city" placeholder="Property City" required>
                </div>
            </div>
            <div class="form-group col-sm-10">
                <label for="desc" class="col-sm-2 control-label">Description</label> <br>
                <div class="col-sm-12">
                    <textarea name='desc' class="col-sm-12 jdesc" rows="8" cols="10"></textarea>
                </div> 
            </div>
            <div class="form-group col-sm-10">
                <label for="features" class="col-sm-12 control-label">Features (One feature per line)</label> <br>
                <div class="col-sm-12">
                    <textarea name='features' class="col-sm-12" rows="8" cols="10"></textarea>
                </div> 
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-4 control-label">Main Image</label>
                <div class="col-sm-8">
                    <input type="file" name="mainimage">
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-4 control-label">Images <br><small>Maximum of 10 images</small></label>
                <div class="col-sm-8">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                    <input type="file" name="images[]">
                </div>
            </div>
            <div class="form-group col-sm-offset-6 col-sm-4">
                <button type="submit" class="btn btn-primary">Add Property</button>
                
            </div>
            
        </form>
    </div><!-- /.col -->

<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>