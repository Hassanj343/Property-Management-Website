<?php 
class Properties{
	/*test*/
	public function fetch_all($type){
		global $pdo;
		$query=$pdo->Prepare("SELECT * FROM $type");
		$query->Execute();
		
		return $query->fetchall();
	}
	public function GetProperty($id,$type){
		global $pdo;
		$query=$pdo->Prepare("SELECT * FROM $type WHERE id=?");
		$query->bindValue(1,$id);
		$query->Execute();
		
		return $query->fetch();
	}
	public function DeleteProperty($value='')
	{
		if(empty($value)){
			return;
		}
		global $pdo;
		global $dbconnection;
		global $controller;
		$foldername = $dbconnection->ExecCommand("SELECT images from properties where id=$value");
		$foldername = $foldername[0] ? $foldername[0] : '';
		$loc = __DIR__ . "/../../Uploads/$foldername";
		$controller->deleteDir($loc);
		$query=$pdo->Prepare("DELETE FROM `properties` WHERE id=?");
		$query->bindValue(1,$value);
		$query->Execute();
	}
	public function GetLastID($type){
		global $pdo;
		$query->Execute();
		return $query->fetch();
	}
	public function UpdateProperty($id,$name,$addr,$postcode,$city,$desc,$imgarry,$lat,$lng,$price,$bed,$features,$mainimage){
		if(empty($id) or empty($name) or empty($addr) or empty($postcode) or empty($city)){
			return false;
		}

		global $pdo;
		
		$query=$pdo->Prepare("UPDATE properties SET name=?, address=?, postcode=?, city=?, description=?, images=?, lat=?, lng=?, price=?, beds=?, features=?, mainimage=? WHERE id=?");
		$query->bindValue(1,$name);
		$query->bindValue(2,$addr);
		$query->bindValue(3,$postcode);
		$query->bindValue(4,$city);
		$query->bindValue(5,$desc);
		$query->bindValue(6,$imgarry);
		$query->bindValue(7,$lat);
		$query->bindValue(8,$lng);
		$query->bindValue(9,$price);
		$query->bindValue(10,$bed);
		$query->bindValue(11,$features);
		$query->bindValue(12,$mainimage);
		$query->bindValue(13,$id);
		$query->Execute();
		$result=true;
		return $result;
	}
	public function InsertProperty($name,$addr,$postcode,$city,$desc,$imgarry,$lat,$lng,$price,$bed,$features,$type,$mainimage){
		$result="";
		if(empty($name) or empty($addr) or empty($postcode) or empty($city)){
			$result=false;
			return $result;
		}
		global $pdo;
		$query=$pdo->Prepare("INSERT INTO properties (name, address, postcode, city, description, images, lat, lng, price, beds, features, type, mainimage) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$query->bindValue(1,$name);
		$query->bindValue(2,$addr);
		$query->bindValue(3,$postcode);
		$query->bindValue(4,$city);
		$query->bindValue(5,$desc);
		$query->bindValue(6,$imgarry);
		$query->bindValue(7,$lat);
		$query->bindValue(8,$lng);
		$query->bindValue(9,$price);
		$query->bindValue(10,$bed);
		$query->bindValue(11,$features);
		$query->bindValue(12,$type);
		$query->bindValue(13,$mainimage);
		$query->Execute();
		$result=true;
		return $result;
	}
}

