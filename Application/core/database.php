<?php
	/**
	 * 
	 */
	 class dbconnection
	 {
	 	
	 	function fetch_all($table){
	 		global $pdo;
	 		$query = $pdo->Prepare("SELECT * FROM $table");
	 		$query->Execute();
	 		return $query->fetchall();
	 	}
	 	function fetch($table,$id){
	 		global $pdo;
	 		$query = $pdo->Prepare("SELECT * FROM $table WHERE id=$id");
	 		$query->Execute();
	 		return $query->fetch();
	 	}
	 	function fetchall_byval($table,$id,$val){
	 		global $pdo;
	 		$query = $pdo->Prepare("SELECT * FROM $table WHERE $id='$val'");
	 		$query->Execute();
	 		return $query->fetchall();
	 	}
	 	function fetch_byval($table,$id,$val){
	 		global $pdo;
	 		$query = $pdo->Prepare("SELECT * FROM $table WHERE $id='$val'");
	 		$query->Execute();
	 		return $query->fetch();
	 	}
	 	function ExecCommand($cmd){
	 		global $pdo;
	 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 		$query = $pdo->Prepare($cmd);
	 		$query->Execute();
	 		return $query->fetch();
	 	}
	 	function ExecuteCommand($cmd){
	 		global $pdo;
	 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 		$query = $pdo->Prepare($cmd);
	 		$query->Execute();
	 	}

	 } 

?>