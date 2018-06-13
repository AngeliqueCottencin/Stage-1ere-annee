<?php
require_once("./models/connect-session.php");

//on test si les champs sont remplis, puis s'ils sont vrais (existent) ou faux
if (isset($_POST['login']) && isset($_POST['pwd']) && !empty($_POST['login']) && !empty($_POST['pwd'])){
	
	
	//on fait appelà la fonction getAuthentification et on lui passe en paramètre login et password
	$result = getAuthentification($_POST['login'], $_POST['pwd']);
	
	//var_dump($result);
	if($result){ // si $result est vrai
		
		session_start();
		
		$_SESSION['login'] = $result['login'];
		$_SESSION['role'] = $result['role'];
		
		header ('location:  http://localhost/newpc/index.php?e=accueil&a=welcome');
	}
	
	else{ // si $result est faux
		header('location: http://localhost/newpc/index.php?e=connexion&a=authentification');
	}
	
	
}

// si rien n'est renseigné, on redirige l'utilisateur vers la page d'authentification
else{
	header('location: http://localhost/newpc/index.php?e=connexion&a=authentification');
}