<?php
	//funktsioonid, mis on seotud andmebaasiga
	
	// loon andmebaasi ühenduse
	require_once("../config_global.php");
	$database = "if15_hendrik7";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);

	
	//võtab andmed ja sisestab andmebaasi
	function createUser(){
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
				
		//muutujad tulemustele
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
				
			//kontrollin kas tulemusi leiti
			if($stmt->fetch()){
			//ab'i oli midagi
			echo "Email ja parool õiged, kasutaja id=".$id_from_db;
					
			}else{
			//ei leidnud
				echo "wrong credentails!";
					
			}
				
		$stmt->close();
		
	}
	
	
	function loginUser(){
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
				
		// asendame ? märgid, ss - s on string email, s on string password
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
	}
	
	//Paneme ühenduse kinni
	$mysqli->close();
	
?>