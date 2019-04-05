<?php
$name = $description = $avtarName = $rating ='';
$files=array();
$target_path = "../uploads/";

if(!isset($name) or !isset($description)){
	header('location:../index.php');
	die();
}
require_once('../../Application/init.php');
$name=$_POST['name'];
$rating=$_POST['rating'];
$description=$_POST['desc'];
if(isset($_FILES['avatar'])){
	$files=$_FILES['avatar'];
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $files["name"]);
$extension = end($temp);

if(in_array($extension, $allowedExts)){
	if(!empty($files)){
		$avtarName=$controller->UploadTestimonial($files['tmp_name'],date("dhis"),$extension);
	}
}

$avtarName=$avtarName.'.'.$extension;

$query = $pdo->Prepare("INSERT INTO `testimonials`(`author`, `description`, `rating`, `avtar`) VALUES (?,?,?,?)");
$query->bindValue(1,$name);
$query->bindValue(2,$description);
$query->bindValue(3,$rating);
$query->bindValue(4,$avtarName);
$query->Execute();
?>
<script type="text/javascript">document.location.href='../testimonials.php?resulttype=Success&msg=Testimonial added successfully'</script>
