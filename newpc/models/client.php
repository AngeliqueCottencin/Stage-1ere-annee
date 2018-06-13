<?php
require_once ('./models/connect-db.php');

function client_getLabel($id) {
	$client = client_getByID ( $id );
	if ($client == null) {
		echo "Ce client n'existe pas ou a été supprimé.";
	} else {
		return $client->prenom . " " . $client->nom;
	}
}
function client_getByID($id) {
	global $pdo;
	$req = "SELECT * FROM client c where c.id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetch ();
}

function id_client($id){
	global $pdo;
	$req = "SELECT id FROM client WHERE id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue( ":id", $id, PDO::PARAM_INT );
	$query->execute ();
	return $query->fetchAll ();	
}


function client_getList($filtre) {
	global $pdo;
	if (isset ( $filtre ) && ($filtre) != "") {
		$req = "SELECT * FROM client c WHERE c.nom LIKE :filtre_nom OR c.prenom LIKE :filtre_prenom;";
		$query = $pdo->prepare ( $req );
		$query->bindValue ( ":filtre_nom", "%" . $filtre . "%", PDO::PARAM_STR );
		$query->bindValue ( ":filtre_prenom", "%" . $filtre . "%", PDO::PARAM_STR );
	} else {
		$req = "SELECT * FROM client c;";
		$query = $pdo->prepare ( $req );
	}
	
	$query->execute ();
	return $query->fetchAll ();
}


function unClient($id){
	global $pdo;
	$req = "SELECT * FROM client WHERE id=:id;";
	$query = $pdo->prepare($req);
	$query->bindValue(":id", $id, PDO::PARAM_INT);
	$query->execute();
	return $query->fetch();
	
}


function client_add($nom, $prenom, $adresse, $telephone) {
	global $pdo;
	$req = "INSERT INTO client(nom, prenom, adresse, telephone) VALUES (:nom, :prenom, :adresse, :telephone);";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":nom", $nom, PDO::PARAM_STR );
	$query->bindValue ( ":prenom", $prenom, PDO::PARAM_STR );
	$query->bindValue ( ":adresse", $adresse, PDO::PARAM_STR );
	$query->bindValue ( ":telephone", $telephone, PDO::PARAM_STR );
	return $query->execute ();
}


function client_supp($id) {
	global $pdo;
	$req = "DELETE FROM client WHERE id=:id;";
	$query = $pdo->prepare ( $req );
	$query->bindValue ( ":id", $id, PDO::PARAM_INT );
	return $query->execute ();
}


function client_modif($id, $nom, $prenom, $adresse, $telephone) {
	global $pdo;

	$req = "UPDATE client SET nom=:nom, prenom=:prenom, adresse=:adresse, telephone=:telephone WHERE id=:id;";
	
	$prep = $pdo->prepare ( $req );
	
	$prep->bindValue ( ':nom', $nom, PDO::PARAM_STR );
	$prep->bindValue ( ':prenom', $prenom, PDO::PARAM_STR );
	$prep->bindValue ( ':adresse', $adresse, PDO::PARAM_STR );
	$prep->bindValue ( ':telephone', $telephone, PDO::PARAM_STR );
	$prep->bindValue ( ':id', $id, PDO::PARAM_INT );
	
	return $prep->execute ();
}
	