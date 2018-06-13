<?php
require_once ('./config.php');
require_once ('./models/intervention.php');
require_once ('./models/client.php');

$filtre = "";
if (isset ( $_GET ["query"] )) {
	$filtre = $_GET ["query"];
}

$list = intervention_getList ( $filtre );

if ($_SESSION ['role'] == "admin") {
	
	if (isset ( $_GET ["sup"] )) {
		inter_supp ( $_GET ["sup"] );
		header ( 'location: http://localhost/newpc/index.php?e=intervention&a=list' );
	}
	
	if (isset ( $_GET ["update"] )) {
		inter_modif ( $_GET ['cli'], $_GET ['creation'], $_GET ['probleme'], $_GET ['notes'], $_GET ['solution'], $_GET ['facturation'] );
	}
} 
?>

<h1 align="center"><font color="#0131B4">Liste des interventions</font></h1>
<h3 align="center"><a href="<?php echo $root?>/index.php?e=intervention&a=ajout"><font size=4 color="#5472AE">Cliquez ici pour ajouter une intervention</font></a></h3>

<form method="get" action="./index.php">
	<input type="hidden" name="e" value="intervention">
	<input type="hidden" name="a" value="list">
Recherche : <input type="search" id="search" name="query" value="<?php echo $filtre?>" placeholder="Rechercher une intervention">
</form>


<table border = 1 class='table' class="table table-hower">
	<tr>
		<th><font size=4 color="#6495ED">N° d'intervention</font></th>
		<th><font size=4 color="#6495ED">Date de créationv</font></th>
		<th><font size=4 color="#6495ED">Client</font></th>
		<th><font size=4 color="#6495ED">Problème</font></th>
		<th><font size=4 color="#6495ED">Notes de travail</font></th>
		<th><font size=4 color="#6495ED">Solution</font></th>
		<th><font size=4 color="#6495ED">Facturation</font></th>
		<?php if($_SESSION['role'] == "admin"): ?>
			<th><font size=4 color="#6495ED">Modifier les informations</font></th>
			<th><font size=4 color="#6495ED">Suppression d'une intervention</font></th>
		<?php endif;?>
		
	</tr>
	<?php
	foreach($list as $inter){
	?>
	<tr>
		<td><a href="<?php echo $root?>/index.php?e=intervention&a=detail&id=<?php echo $inter->id?>"><font size=3 color="#5472AE"><?php echo $inter->id?></font></a></td>
		<td><font size=3 ><?php echo $inter->creation?></font></td>
		
		<td><a href="<?php echo $root?>/index.php?e=client&a=detail&id=<?php echo $inter->id_client?>"><font size=3 color="#5472AE"><?php echo client_getLabel($inter->id_client)?></font></a></td>
		
		<td><font size=3 ><?php echo $inter->probleme?></font></td>
		<td><font size=3 ><?php echo $inter->notes_travail?></font></td>
		<td><font size=3 ><?php echo $inter->solution?></font></td>
		<td><font size=3 ><?php echo $inter->facturation?></font></td>
		<?php if($_SESSION['role'] == "admin"): ?>
			<td><a href="<?php echo $root?>/index.php?e=intervention&a=modif&id=<?php echo($inter->id) ?>"><font size=3 color="#5472AE">Modifier</font></a></td>
			<td><a href="<?php echo $root?>/index.php?e=intervention&a=list&sup=<?php echo $inter->id;?>"><font size=3 color="#5472AE">Supprimer</font></a></td>
		<?php endif;?>
	</tr>
	<?php
	}
	?>
</table>
