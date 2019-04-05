<?php
  $foldername=$_REQUEST["loc"];
  $filename=$_REQUEST["name"];
  $imagecount=$_REQUEST["imc"];
  
  function Update_Upload(){
    global $imagecount;
        for($i=0; $i<(10-$imagecount);$i++){
            if($i==0&&$imagecount==0){
                echo '<small> Main Image</small> <input type="file" name="images[]" required>';
            } else{
                echo '<input type="file" name="images[]">';
            }
        }
    }

  if(empty($foldername) or empty($filename)){
    header("location:../index.php");
    die();
  }
  $loc = "../../Uploads/$foldername";
  if(is_dir($loc)){
    if(unlink($loc."/$filename")){
      $imagecount=$imagecount-1;
      Update_Upload();
      return true;
    }
  }