<?php
require_once ('connect-db.php');
function inter_getByID($id) {
	global $pdo;
	$req = "SELECT * FROM intervention i where i.id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetch ();
}

function intervention_getList($filtre) {
	global $pdo;
	if (isset ( $filtre ) && ($filtre) != "") {
		$req = "SELECT * FROM intervention i WHERE i.id LIKE :filtre_id;";
		$query = $pdo->prepare ( $req );
		$query->bindValue ( ":filtre_id", "%" . $filtre . "%", PDO::PARAM_INT );
	} else {
		$req = "SELECT * FROM intervention i;";
		$query = $pdo->prepare ( $req );
	}
	$query->execute ();
	return $query->fetchAll ();
}

function intervention_getListByIDClient($id_client) {
	global $pdo;
	$req = "SELECT * FROM intervention i WHERE i.id_client=:id_client ORDER BY i.creation;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id_client", $id_client, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetchAll ();
}

function uneIntervention($id){
	global $pdo;
	$req = "SELECT * FROM intervention WHERE id=:id;";
	$query = $pdo->prepare($req);
	$query->bindValue(":id", $id, PDO::PARAM_INT);
	$query->execute();
	return $query->fetch();
	
}

function inter_add($client, $creation, $probleme, $notes, $solution, $facturation) {
	global $pdo;
	$req = "INSERT INTO intervention(id_client, creation, probleme, notes_travail, solution, facturation) VALUES (:client, :creation, :probleme, :notes, :solution, :facturation);";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":client", $client, PDO::PARAM_INT );
	$query->bindValue ( ":creation", $creation, PDO::PARAM_INT );
	$query->bindValue ( ":probleme", $probleme, PDO::PARAM_STR );
	$query->bindValue ( ":notes", $notes, PDO::PARAM_STR );
	$query->bindValue ( ":solution", $solution, PDO::PARAM_STR );
	$query->bindValue ( ":facturation", $facturation, PDO::PARAM_INT );
	return $query->execute ();
}

function inter_supp($id) {
	global $pdo;
	$req = "DELETE FROM intervention WHERE id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	return $query->execute ();
}


function inter_modif($id, $cli, $creation, $probleme, $notes, $solution, $facturation) {
	global $pdo;
	
	$req = "UPDATE intervention SET id_client=:cli, creation=:creation, probleme=:probleme, notes_travail=:notes, solution=:solution, facturation=:facturation WHERE id=:id;";
	
	$prep = $pdo->prepare ( $req );
	
	$prep->bindValue ( ':cli', $cli, PDO::PARAM_INT );
	$prep->bindValue ( ':creation', $creation, PDO::PARAM_INT );
	$prep->bindValue ( ':probleme', $probleme, PDO::PARAM_STR );
	$prep->bindValue ( ':notes', $notes, PDO::PARAM_STR );
	$prep->bindValue ( ':solution', $solution, PDO::PARAM_STR );
	$prep->bindValue ( ':facturation', $facturation, PDO::PARAM_INT );
	$prep->bindValue ( ':id', $id, PDO::PARAM_INT );
	
	return $prep->execute ();
}
