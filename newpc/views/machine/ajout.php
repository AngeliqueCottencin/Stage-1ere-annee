<?php
require_once ('./config.php');
require_once ('./models/intervention.php');
require_once ('./models/client.php');
require_once('./models/machine.php');

$filtre = "";
$list = intervention_getList ( $filtre );

if (isset ( $_GET ["interv"] ) && ($_GET ["type"]) && ($_GET ["marque"]) && ($_GET ["couleur"]) && ($_GET ["reference"])) {
	machine_add ( $_GET ["interv"], $_GET ["type"], $_GET ["marque"], $_GET ["couleur"], $_GET ["reference"] );
	header ( 'location: http://localhost/newpc/index.php?e=machine&a=list' );
}
?>

<!--<a href="<?php echo $root?>/index.php?e=machine&a=list"><font size=3 color="#5472AE">Retour à la liste des machines</font></a>-->
<h1 id="form" align="center"><font color="#0131B4">Ajout d'une machine</font></h1>
<h3 id="form" align="center"><font color="#0131B4">Veuillez remplir ce formulaire pour ajouter une machine à la liste des machines</font></h3>
<center>
	<form method="GET" action="./index.php">
		<input type="hidden" name="e" value="machine"> <input type="hidden"
			name="a" value="ajout">
		<table class="table-condensed">
			<tr>
				<td><font size=3>N° d'intervention :</font></td>
				<td><font size=3><select name="interv">
				<?php foreach($list as $inter){?>
					<option><?php echo $inter->id?></option>
				<?php } ?>
				</select></font></td>
				<td><a href="<?php echo $root?>/index.php?e=intervention&a=ajout"><font
						size=3 color="#5472AE">Cliquez ici pour ajouter une intervention</font></a></td>
			</tr>
			<tr>
				<td><font size=3>Type de machine :</font></td>
				<td><font size=3><input type="text" name="type" placeholder="type de machine"></font></td>
			</tr>
			<tr>
				<td><font size=3>Marque de la machine :</font></td>
				<td><font size=3><input type="text" name="marque"
					placeholder="marque de la machine"></font></td>
			</tr>
			<tr>
				<td><font size=3>Couleur de la machine :</font></td>
				<td><font size=3><input type="text" name="couleur"
					placeholder="couleur de la machine"></font></td>
			</tr>
			<tr>
				<td><font size=3>Réference de la machine :</font></td>
				<td><font size=3><input type="text" name="reference"
					placeholder="référence de la machine"></font></td>
			</tr>

		</table>
		<button type="submit" name="ajout" class="btn btn-primary" id="ajout">Ajouter une machine</button>
	</form>
</center>

<h3 id="form" align="center"> <font color="#0131B4">Tableau récapitulatif des interventions par rapport au n°
d'intervention</font></h3>

<table border = 1 class='table' class="table table-hower">
	<tr>
		<th><font size=4 color="#6495ED">N° d'intervention</font></th>
		<th><font size=4 color="#6495ED">Date de création</font></th>
		<th><font size=4 color="#6495ED">Nom et prénom du client concerné</font></th>
		<th><font size=4 color="#6495ED">Problème</font></th>
	</tr>
	<?php
	foreach ( $list as $inter ) {
		?>
	<tr>
		<td><a
			href="<?php echo $root;?>/index.php?e=inter&a=detail&id=<?php echo $inter->id;?>"><font size=3 color="#5472AE">
		<?php echo $inter->id?></font></a></td>
		<td><font size=3 ><?php echo $inter->creation?></font></td>
		<td><a href="<?php echo $root;?>/index.php?e=client&a=detail&id=<?php echo $inter->id_client;?>"><font size=3 color="#5472AE"><?php echo client_getLabel($inter->id_client)?></font></a></td>		
		<td><font size=3 ><?php echo $inter->probleme?></font></td>
	</tr>
	<?php
	}
	?>
</table>