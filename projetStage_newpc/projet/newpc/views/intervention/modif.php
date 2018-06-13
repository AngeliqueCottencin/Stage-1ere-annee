<?php
if ($_SESSION ['role'] == "admin") {
	require_once ('./config.php');
	require_once ('./models/client.php');
	require_once ('./models/machine.php');
	require_once ('./models/intervention.php');
	
	$filtre = "";
	$list = client_getList ( $filtre );
	
	$cli = "";
	$creation = "";
	$probleme = "";
	$notes = "";
	$solution = "";
	$facturation = "";
	
	if (isset ( $_GET ["id"] )) {
		$inter = uneIntervention ( $_GET ["id"] );
		$id = $inter->id;
		$cli = $inter->id_client;
		$creation = $inter->creation;
		$probleme = $inter->probleme;
		$notes = $inter->notes_travail;
		$solution = $inter->solution;
		$facturation = $inter->facturation;
		
		if (isset ( $_GET ["cli"] ) && isset ( $_GET ["creation"] ) && isset ( $_GET ["probleme"] ) && isset ( $_GET ["notes"] ) && isset ( $_GET ["solution"] ) && isset ( $_GET ["facturation"] )) {
			$cli = $_GET ["cli"];
			$creation = $_GET ["creation"];
			$probleme = $_GET ["probleme"];
			$notes = $_GET ["notes"];
			$solution = $_GET ["solution"];
			$facturation = $_GET ["facturation"];
			
			$modif_ok = inter_modif ( $id, $cli, $creation, $probleme, $notes, $solution, $facturation );
			if ($modif_ok) {
				header ( 'location: http://localhost/newpc/index.php?e=intervention&a=list' );
			}
		}
	}
	
	?>
<!--<a href="<?php echo $root?>/index.php?e=intervention&a=list"><font size=3 color="#5472AE"> Retour à la liste des interventions</font></a>-->
<h1 id="form" align="center"> <font color="#0131B4">Modification des informations concernant une intervention</font></h1>
<h3 id="form" align="center"><font color="#0131B4">Veuillez modifier uniquement les données concernées</font></h3>

<center>
	<form method="GET" action="./index.php">
		<input type="hidden" name="e" value="intervention"> <input
			type="hidden" name="a" value="modif">
		<table class="table-condensed">
			<tr>
				<td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
			</tr>
			<tr>
				<td><font size=3>Client :</font></td>
				<td><font size=3><select name="cli">
				<?php foreach($list as $client){ ?>
					<option value="<?php echo $cli?>"><?php echo $client->id?></option>
				<?php } ?>
				</select></font></td>
				<td><a href="<?php echo $root?>/index.php?e=client&a=ajout"><font size=3 color="#5472AE">Cliquez ici pour ajouter un client</font></a></td>
			</tr>
			<tr>
				<td><font size=3>Date de création :</font></td>
				<td><font size=3><input type="date" name="creation"
					value="<?php echo $creation?>" placeholder="date de création"></font></td>
			</tr>

			<tr>
				<td><font size=3>Problème :</font></td>
				<td><font size=3><textarea name="probleme" placeholder="problème du client"><?php echo $probleme?></textarea></font></td>
			</tr>
			<tr>
				<td><font size=3>Notes de travail :</font></td>
				<td><font size=3><textarea name="notes" placeholder="notes de travail"><?php echo $notes?></textarea></font></td>
			</tr>
			<tr>
				<td><font size=3>Solution :</font></td>
				<td><font size=3><textarea name="solution" placeholder="solution proposée"><?php echo $solution?></textarea></font></td>
			</tr>
			<tr>
				<td><font size=3>Facturation :</font></td>
				<td><font size=3><input type="number" step="any" name="facturation"
					value="<?php echo $facturation?>" placeholder="prix à payer"></font></td>
			</tr>
		</table>
		<button type="submit" name="update" class="btn btn-primary" id="update">Valider les modifications</button>
	</form>
</center>


<h3 id="form" align="center"> <font color="#0131B4">Tableau récapitulatif des clients par rapport à leur n° client</font></h3>
<table border = 1 class='table' class="table table-hower">
	<tr>
		<th><font size=4 color="#6495ED">N° client</font></th>
		<th><font size=4 color="#6495ED">Nom</font></th>
		<th><font size=4 color="#6495ED">Prénom</font></th>
	</tr>
	<?php
	foreach ( $list as $client ) {
		?>
	<tr>
		<td><a href="<?php echo $root;?>/index.php?e=client&a=detail&id=<?php echo $client->id;?>"><font size=3 color="#5472AE"><?php echo $client->id?></font>
		</a></td>
		<td><font size=3 ><?php echo $client->nom?></font></td>
		<td><font size=3 ><?php echo $client->prenom?></font></td>
	</tr>
	<?php
	}
	?>
</table>
<?php

} else {
	echo ("Vous n'avez pas la permission !");
}
?>