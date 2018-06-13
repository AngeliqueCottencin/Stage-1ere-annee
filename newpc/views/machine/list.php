<?php
require_once ('./config.php');
require_once ('./models/intervention.php');
require_once ('./models/machine.php');

$filtre = "";
if (isset ( $_GET ["query"] )) {
	$filtre = $_GET ["query"];
}

$list = machine_getList ( $filtre );

if ($_SESSION ['role'] == "admin") {
	
	if (isset ( $_GET ["sup"] )) {
		machine_supp ( $_GET ["sup"] );
		header ( 'location: http://localhost/newpc/index.php?e=machine&a=list' );
	}
	
	if (isset ( $_GET ["update"] )) {
		machine_modif ( $_GET ['interv'], $_GET ['type'], $_GET ['marque'], $_GET ['couleur'], $_GET ['reference'] );
	}
} 
?>
<h1 align="center"><font color="#0131B4">Liste des machines</font></h1>
<h3 align="center"><a href="<?php echo $root?>/index.php?e=machine&a=ajout"><font size=4 color="#5472AE">Cliquez ici pour ajouter une machine</font></a></h3>


<form method="get" action="./index.php">
	<input type="hidden" name="e" value="machine"> 
	<input type="hidden" name="a" value="list"> 
	<font size=3>Recherche : </font>
	<input type="search" id="search" placeholder="Rechercher une machine" name="query" value="<?php echo $filtre?>">
</form>


<table border = 1 class='table' class="table table-hower">
	<tr>
		<th><font size=4 color="#6495ED">N° de machine</font></th>
		<th><font size=4 color="#6495ED">N° d'intervention</font></th>
		<th><font size=4 color="#6495ED">Type de machine</font></th>
		<th><font size=4 color="#6495ED">Marque de la machine</font></th>
		<th><font size=4 color="#6495ED">Couleur de la machine</font></th>
		<th><font size=4 color="#6495ED">Réference de la machine</font></th>
		<?php if($_SESSION['role'] == "admin"): ?>
			<th><font size=4 color="#6495ED">Modifier les informations</font></th>
			<th><font size=4 color="#6495ED">Supression d'une machine</font></th>
		<?php endif; ?>


	</tr>
	<?php
	foreach ( $list as $machine ) {
		?>
	<tr>
		<td><a href="<?php echo $root?>/index.php?e=machine&a=detail&id=<?php echo $machine->id?>"><font size=3 color="#5472AE">
		<?php echo $machine->id?></font>
		</a></td>
		<?php if($machine->id_intervention){?>
		<td><a
			href="<?php echo $root?>/index.php?e=intervention&a=detail&id=<?php echo $machine->id_intervention?>">
			<font size=3 color="#5472AE"><?php echo $machine->id_intervention?></font>
		</a></td>
		<?php } else{?>
		<td><font size=3> Cette intervention n'existe pas ou a été supprimé </font></td>
		<?php }?>
		<td><font size=3><?php echo $machine->type?></font></td>
		<td><font size=3><?php echo $machine->marque?></font></td>
		<td><font size=3><?php echo $machine->couleur?></font></td>
		<td><font size=3><?php echo $machine->reference?></font></td>
		<?php if($_SESSION['role'] == "admin"): ?>
			<td><a href="<?php echo $root?>/index.php?e=machine&a=modif&id=<?php echo($machine->id) ?>"><font size=3 color="#5472AE">Modifier</font></a></td>
		<td><a href="<?php echo $root?>/index.php?e=machine&a=list&sup=<?php echo $machine->id;?>"><font size=3 color="#5472AE">Supprimer</font></a></td>
  		<?php endif; ?>
	</tr>
	<?php
	}
	?>
</table>
