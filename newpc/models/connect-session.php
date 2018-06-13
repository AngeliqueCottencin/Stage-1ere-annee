<?php

require_once ('./models/connect-db.php');


function getAuthentification($login, $pass){
	global $pdo;
	$query = "SELECT * FROM utilisateurs WHERE login=:login AND password=:pass";
	$prep = $pdo->prepare($query);
	$prep->bindValue(':login', $login);
	$prep->bindValue(':pass', $pass);
	$prep->execute();
	
	
	// on vérifie que la requete renvoie bien une ligne
	if($prep->rowCount() == 1){
		$result = $prep->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	else{
		return false;
	}
	
}