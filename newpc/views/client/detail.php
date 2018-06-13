<?php
require_once('./config.php');
require_once('./models/client.php');
require_once('./models/intervention.php');

$client = client_getByID($_GET["id"]);
$list = intervention_getListByIDClient($_GET["id"]);

?>
<!--<a href="<?php echo $root?>/index.php?e=client&a=list"><font size=3 color="#5472AE">Retour à la liste des clients</font></a> -->

<h1 id="details" align="center"><font color="#0131B4">Détails d'un Client</font></h1>
<center>
	<form>
		<table class="table-condensed">
			<tr>
				<td><font size=4 color="#6495ED">N° Client :</font></td>
				<td><font size=3 ><?php echo $client->id?></font></td>
			</tr>
			<tr>
				<td><font size=4 color="#6495ED">Nom :</font></td>
				<td><font size=3 ><?php echo $client->nom?></font></td>
			</tr>
			<tr>
				<td><font size=4 color="#6495ED">Prénom :</font></td>
				<td><font size=3 ><?php echo $client->prenom?></font></td>
			</tr>
			<tr>
				<td><font size=4 color="#6495ED">Adresse :</font></td>
				<td><font size=3 ><?php echo $client->adresse?></font></td>
			</tr>
			<tr>
				<td><font size=4 color="#6495ED">Téléphone :</font></td>
				<td><font size=3 ><?php echo $client->telephone?></font></td>
			</tr>
		</table>
	</form>
</center>



<h3 id="details" align="center"><font color="#0131B4">Liste des interventions qui concernent le client</font><a href="<?php echo $root?>/index.php?e=intervention&a=list"><font size=3 color="#5472AE">(Accès à la liste des interventions)</font></a>
</h3>
<h3 align="center"><a href="<?php echo $root?>/index.php?e=intervention&a=ajout"><font size=3 color="#5472AE">Cliquez ici si vous souhaitez ajouter une intervention</font></a></h3>

<form>
<table border = 1 class='table' class="table table-hower">
		<tr>
			<th><font size=4 color="#6495ED">N° d'intervention </font></th>
			<th><font size=4 color="#6495ED">Date de création </font></th>
			<th><font size=4 color="#6495ED">Problème </font></th>
			<th><font size=4 color="#6495ED">Notes de travail </font></th>
			<th><font size=4 color="#6495ED">Solution </font></th>
			<th><font size=4 color="#6495ED">Facturation </font></th>		
						
		</tr>
				
		<?php
		foreach($list as $intervention){
		?>
		
		<tr>	
			<td><a href="<?php echo $root?>/index.php?e=intervention&a=detail&id=<?php echo $intervention->id?>"><font size=3 color="#5472AE"><?php echo $intervention->id?></font></a></td>
			<td><font size=3 ><?php echo $intervention->creation?></font></td>
			<td><font size=3 ><?php echo $intervention->probleme?></font></td>
			<td><font size=3 ><?php echo $intervention->notes_travail?></font></td>
			<td><font size=3 ><?php echo $intervention->solution?></font></td>
			<td><font size=3 ><?php echo $intervention->facturation?></font></td>
		</tr>
		
		<?php 
		}
		?>
	</table>
</form>