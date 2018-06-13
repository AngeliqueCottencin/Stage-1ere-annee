<?php
require_once ('connect-db.php');
function machine_getList($filtre) {
	global $pdo;
	if (isset ( $filtre ) && ($filtre) != "") {
		$req = "SELECT * FROM machine m WHERE m.type LIKE :filtre_type OR m.marque LIKE :filtre_marque;";
		$query = $pdo->prepare ( $req );
		$query->bindValue ( ":filtre_type", "%" . $filtre . "%", PDO::PARAM_STR );
		$query->bindValue ( ":filtre_marque", "%" . $filtre . "%", PDO::PARAM_STR );
	} else {
		$req = "SELECT * FROM machine m;";
		$query = $pdo->prepare ( $req );
	}
	$query->execute ();
	return $query->fetchAll ();
}
function machine_getByID($id) {
	global $pdo;
	$req = "SELECT * FROM machine m where m.id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetch ();
}
function machine_getListByIDIntervention($id_intervention) {
	global $pdo;
	$req = "SELECT * FROM machine m WHERE m.id_intervention=:id_intervention ORDER BY m.id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id_intervention", $id_intervention, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetchAll ();
}
function uneMachine($id) {
	global $pdo;
	$req = "SELECT * FROM machine WHERE id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetch ();
}
function machine_supp($id) {
	global $pdo;
	$req = "DELETE FROM machine WHERE id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	return $query->execute ();
}
function machine_add($interv, $type, $marque, $couleur, $reference) {
	global $pdo;
	$req = "INSERT INTO machine(id_intervention, type, marque, couleur, reference) VALUES (:interv, :type, :marque, :couleur, :reference);";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":interv", $interv, PDO::PARAM_INT );
	$query->bindValue ( ":type", $type, PDO::PARAM_STR );
	$query->bindValue ( ":marque", $marque, PDO::PARAM_STR );
	$query->bindValue ( ":couleur", $couleur, PDO::PARAM_STR );
	$query->bindValue ( ":reference", $reference, PDO::PARAM_STR );
	return $query->execute ();
}

function machine_modif($id,$interv, $type, $marque, $couleur, $reference) {
	global $pdo;
	
	$req = "UPDATE machine SET id_intervention=:interv, type=:type, marque=:marque, couleur=:couleur, reference=:reference WHERE id=:id;";
	
	$query = $pdo->prepare ( $req );
	
	$query->bindValue ( ':interv', $interv, PDO::PARAM_INT );
	$query->bindValue ( ':type', $type, PDO::PARAM_STR );
	$query->bindValue ( ':marque', $marque, PDO::PARAM_STR );
	$query->bindValue ( ':couleur', $couleur, PDO::PARAM_STR );
	$query->bindValue ( ':reference', $reference, PDO::PARAM_STR );
	$query->bindValue ( ':id', $id, PDO::PARAM_INT );
	
	
	return $query->execute ();
}