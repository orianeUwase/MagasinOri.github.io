<style>
	table, th, td {
		padding: 5px;
	}
		table 
		{
			border: 1px solid black;
			text-align: justify;
			text-justify:right;
		}
</style>
<?php
include 'connection.php';
if(isset($_POST['btnAjout'])){
if (isset($_POST['nomEqui']) && isset($_POST['codeEqui'])&& $_POST['prix']) {
	
	$equi=$_POST['codeEqui'];
	$no=$_POST['nomEqui'];
	$prix=$_POST['prix'];
	
	insert($equi,$no,$prix,$connection);
//	include 'InventaireAffiche.php';
}
else{
	phpAlert("Erreur lors  de l'insertion! Veillez reessayer!");
}
}
?>
<form method="post" action="#">
	<table>
		<tr>
			<td>Numero de serie</td>
			<td><input type="text" id="codeEqui" name="codeEqui"/></td>
			</tr>
		<tr>
			<td>Nom d'equipment</td>
			<td><input type="text" id="nomEqui" name="nomEqui"/></td>
		</tr>
		<tr>
			<td>Valeur</td>
			<td><input type="text" id="prix" name="prix"/></td>
			</tr>
			<tr>
			<td><input id="btnAjout" type="Submit" name="btnAjout" value="Ajouter"/></td>
			</tr>
	</table>
	<div id="resultat"></div>
</form>
<?php
function insert($code,$nom,$prix,$connection){
	$requeteInsert=mysqli_query($connection,"insert into materiel(noserie,nom,prix)values ('$code','$nom',$prix);") or die("erreur d'insertion");
	$affect=mysqli_affected_rows($connection);
	if($affect<=0){
		phpAlert( "Erreur d'ajout! Veillez reessayer");
	}
	else{
		$msg= $affect."materiel ajouté avec Success";
		phpAlert($msg);
		//show a pop up
	}
}
?>