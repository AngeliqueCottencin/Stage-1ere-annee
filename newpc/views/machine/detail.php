<?php
require_once('./config.php');
require_once('./models/intervention.php');
require_once('./models/client.php');
require_once('./models/machine.php');


$machine = machine_getByID($_GET["id"]);
?>
<!-- <a href="<?php echo $root?>/index.php?e=machine&a=list"><font size=3 color="#5472AE">Retour à la liste des machines</font></a> -->

<h1 id="details" align="center"><font color="#0131B4">Détails d'une machine</font></h1>
<center>
<form>
	<table class="table-condensed">
		<tr>
			<td><font size=4 color="#6495ED">N° de la machine :</font></td>
			<td><font size=3><?php echo $machine->id?></font></td>
		</tr>
		<tr>
			<td><font size=4 color="#6495ED">N° de l'intervention concernée :</font></td>
			<td><a href="<?php echo $root?>/index.php?e=intervention&a=detail&id=<?php echo $machine->id_intervention?>"><font size=3 color="#5472AE"><?php echo $machine->id_intervention?></font></a></td>
		</tr>
		<tr>
			<td><font size=4 color="#6495ED">Type de machine :</font></td>
			<td><font size=3><?php echo $machine->type?></font></td>
		</tr>
		<tr>
			<td><font size=4 color="#6495ED">Marque de la machine :</font></td>
			<td><font size=3><?php echo $machine->marque?></font></td>
		</tr>
		<tr>
			<td><font size=4 color="#6495ED">Couleur de la machine :</font></td>
			<td><font size=3><?php echo $machine->couleur?></font></td>
		</tr>
		<tr>
			<td><font size=4 color="#6495ED">Réference de la machine :</font></td>
			<td><font size=3> <?php echo $machine->reference?></font></td>
		</tr>
		
	</table>
</form>
</center>