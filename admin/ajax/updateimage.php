<?php

$foldername=$_REQUEST["loc"];
$imagearr=array();
$dirbase="../../Uploads/";
$dir=$dirbase.$foldername;
$ignore = array( 'cgi-bin', '.', '..','._' );
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

        $imagearr=$images;
	}
}
$imagecount=count($imagearr);
for ($i=0; $i <count($imagearr) ; $i++) {
	$currname=$imagearr[$i];
	$path="../Uploads/$foldername/$currname";
	$disabled;
	?>
	<li>
		<a class="image-w" href="javascript:myFunction('<?php echo $currname ?>','<?php echo $foldername ?>',<?php echo "$imagecount";?>)"> 
			<img width="150" height="100" class="mimage" src="<?php echo $path;?>" >
			<div class="cover">
		        <h4>Remove Image</h4>
		    </div>
		</a>
	</li>
<?php
}}

