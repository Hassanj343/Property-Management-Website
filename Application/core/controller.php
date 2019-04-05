<?php

class controller {
	protected $pages = array();
	function setpageattr($attr,$value){
		if(empty($attr) or empty($value)){
			return;
		}

		$this->pages[$attr]=$value;
	}

	function getpageattr($attr){
		if(array_key_exists($attr, $this->pages)){
			return $this->pages[$attr];
		}
		return;
	}

	function has_permission($pname,$rank){
		global $adminpages;
		$arr=$adminpages[$pname];
		if($rank>=$arr['Permission']){return 1;}
		return 0;
	}
	function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	function GetImages($loc){
		$dirbase="../Uploads/";
        $dir=$dirbase.$loc;
        
        if(is_dir($dir)){
            if($dh = opendir($dir)){
                $images = array();

                while (($file = readdir($dh)) !== false) {
                	echo "Searching";
                    if (!is_dir($dir.$file)) {
                        $images[$file] = $dir.'/'.$file;
                    }
                }

                closedir($dh);
                echo "Search comp";
                return $images;
            }
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
	function UploadTestimonial($fname,$foldern,$type,$imgcounter=0){
		$imagecounter=$imgcounter;
		$OK=0;
		$loc="../Uploads/Testimonials";
		$property_folder="$foldern";
		$filename="";
		$type = $type;
		if($fname && $foldern){
			if (!file_exists($loc)) {
    			mkdir($loc, 0777, true);
    		}
    		$filename="$foldern";
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

	public static function deleteDir($dirPath) {
	    if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            self::deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($dirPath);
	}

}