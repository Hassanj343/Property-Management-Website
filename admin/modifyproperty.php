<?php
	require 'inc/loginchk.php';
	require_once('../Application/init.php');
	$controller->setpageattr("name","Manage Properties");
	$controller->setpageattr("title","Manage Properties");
    $controller->setpageattr("subtitle","Modify Property");
	include 'inc/header.php';
	if(!$controller->has_permission($pagename,$userrank)){?>
		<script type="text/javascript">document.location.href='index.php'</script>
	<?php }


    $imagecount=0;
    $resulttype = $resultmsg="";
    $pid=$_GET['id'];
    if(empty($pid)){?>
        <script type="text/javascript">document.location.href='index.php'</script>
    <?php }
    $Property=$dbconnection->fetch('properties',$pid);
    if(empty($Property)){?>
        <script type="text/javascript">document.location.href='index.php'</script>
    <?php }
    $Sucess=1;

    $file_error;
    $incompatible_file=0;

    $errmsg="Following files could not be uploaded due to incompatible file types. We only accept .gif, .jpeg, .png .<br>";
    $p_name = $mainimage_name =  $p_address = $p_postcode = $p_city = $p_description = $p_type = $LATLNG = $p_lat = $price = $bed = $p_lng = "";
    $f_name = $f_type = $f_tmpn = $f_error = $f_size = "";
    
    $property_folder="";

    $allowedtypes = array('image/jpeg', 'image/gif', 'image/png');

    function Sucess($msg){
        if(isset($msg)){
            $resulttype='Sucess';
            $resultmsg = $msg;
        }
    }
    function GetImages(){
        $dirbase="../Uploads/";
        global $Property;
        $dir=$dirbase.$Property["images"]."";
        global $ignore;
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
    $features=$_POST['features'];
    $imglocation=$_POST['imglocation'];
    if(isset($_FILES['mainimage'])){
        $mainimage=$_FILES['mainimage'];
    }
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
        $currfolder=$imglocation?$imglocation:date("dhis");
        $pfolder="";
        $imagecount=count(GetImages());
        if(isset($_FILES['images'])){
            for($i = 0; $i < count($f_tmpn); $i++){
                if(in_array($f_type[$i], $allowedtypes))    {
                    $pfolder=$controller->UploadFile($f_tmpn[$i],$currfolder,$f_type[$i],count(GetImages()));
                }
                else{
                    $str=$f_name[$i];
                    if(strlen($str)>=1){
                        $incompatible_file++;
                        $file_error[]=$f_name[$i];
                    }
                }
            }
        }
        if(isset($mainimage) and !empty($mainimage['name'])){
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
            if(empty($pfolder)){
                $pfolder=$imglocation;
            }
            $PropertySubmit=$PropertyClass->UpdateProperty($pid,$p_name,$p_address,$p_postcode,$p_city,$p_description,$pfolder,$p_lat,$p_lng,$price,$bed,$features,$mainimage_name);
            
            $resulttype='sucess';
            $resultmsg = "Property updated successfully. <a href='manageproperty.php'> Click Here to return to previous page</a>";
            $Property=$dbconnection->fetch('properties',$pid);
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
<script>

function myFunction(name,loc,imc) {
    if(name ==""){
        alert("Name cannot be empty")
        return;
    }
    if(imc<2){
        alert("Atleast one image is required")
        return;
    }

    var alert=confirm("Are you sure, you want to delete this image?")

    if(alert){
        if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                
                document.getElementById('uploadslot').innerHTML=xmlhttp.responseText;
                UpdateImages(loc);
            }
        }
        xmlhttp.open("GET","ajax/removeimage.php?name="+name+"&loc="+loc+"&imc="+ imc,true);
        xmlhttp.send();
    }
}
function UpdateImages(loc){
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById('manageimages').innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","ajax/updateimage.php?&loc="+loc,true);
    xmlhttp.send();
    
}
function DeleteProperty (id) {
    if(id==""){
        return;
    }
    if(confirm('This property will be permanantly deleted. Are you sure?')){
        document.location.href="inc/removeproperty.php?id="+id;
    }
    // body...
}
</script>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
        selector:'.jdesc',
        menubar: "format edit",
        theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        toolbar: "sizeselect | bold italic | fontselect |  fontsizeselect",

         });
    </script>

    <div class="col-sm-12">
        <form name="form1" action="modifyproperty.php?id=<?php echo "$pid" ?>"  method="post" enctype="multipart/form-data">
            <input name="imglocation" type="hidden" value="<?php echo $Property['images'];?>">
            <div class="form-group col-sm-8">
                <label for="name" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="price" value="<?php echo $Property['price'];?>" required>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $Property['name'];?>" required autofocus>
                </div>
            </div>
            
            <div class="form-group col-sm-8">
                <label for="beds" class="col-sm-2 control-label">Beds</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="beds" value="<?php echo $Property['beds'];?>">
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="addr" value="<?php echo $Property['address'];?>" required>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="postcode" class="col-sm-2 control-label">Postcode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="postcode" value="<?php echo $Property['postcode'];?>" required>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="city" value="<?php echo $Property['city'];?>" required>
                </div>
            </div>
            <div class="form-group col-sm-10">
                <label for="desc" class="col-sm-2 control-label">Description</label> <br>
                <div class="col-sm-12">
                    <textarea name='desc' class="col-sm-12 jdesc" rows="8" cols="10"><?php echo htmlspecialchars($Property['description'])?></textarea>
                </div> 
            </div>
            <div class="form-group col-sm-10">
                <label for="features" class="col-sm-12 control-label">Features (One feature per line)</label> <br>
                <div class="col-sm-12">
                    <textarea name='features' class="col-sm-12" rows="8" cols="10"><?php echo $Property['features']; ?></textarea>
                </div> 
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-4 control-label">Main Image</label>
                <div class="col-sm-8">
                    <input type="file" name="mainimage">
                </div>
            </div>
            <div class="form-group col-sm-8">
                <label for="addr" class="col-sm-12 control-label">Manage Images</label>
                 <div class="col-sm-10">
                    <?php 
                        $imageslist=GetImages();
                        $imagecount = count($imageslist);
                    ?>
                </div>
                <ul class="col-sm-16 manageimages" id="manageimages">
                    <?php 
                    $dir="../Uploads/".$Property["images"]."/";
                    for ($i=0; $i < $imagecount; $i++) { 
                        $currname=$imageslist[$i];
                        $imagepath=$Property['images'];
                        $imagecount=count($imageslist);
                        if($currname != "mainimage2.png"){
                        ?>
                        <li>
                            <a class="image-w" href="javascript:myFunction('<?php echo $currname ?>','<?php echo $imagepath ?>','<?php echo $imagecount ?>')"> 
                                <img class="mimage" width="150"  height="100" src="<?php echo $dir.$imageslist[$i];?>">
                                <div class="cover">
                                    <h4>Remove Image</h3>
                                </div>
                            </a>
                        </li>
                        <?php
                        }   }
                    
                    ?>
                        
                </ul>
            <label class="col-sm-12 control-label">&nbsp</label>
            <label for="addr" class="col-sm-4 control-label">Upload Images</label>
                <div class="col-sm-8 uploadslots" id="uploadslot">
                    <?php
            for($i=0; $i<(10-$imagecount);$i++){
                if($i==0&&$imagecount==0){
                    echo '<small> Main Image</small> <input type="file" name="images[]" required>';
                } else{
                    echo '<input type="file" name="images[]">';
                }
                
            }
        ?>
                </div>
            </div>

            <div class="col-sm-12">
                <center>
                    <div class="form-group col-sm-2">
                        <button type="submit" class="btn btn-primary">Update Property</button>
                    </div>
                    <div class="form-group col-sm-2">
                        <a href="javascript:DeleteProperty(<?php echo $pid?>)" class="btn btn-danger">Remove Property</a>
                    </div>
                </center>
            
            </div>
            
            
        </form>
    </div><!-- /.col -->
<?php include 'inc/footer.php'; ?>
<?php include 'inc/footer.php'; ?>