<?php
	include 'connection.php';
if(isset($_POST['btnImprunter']))
{
	$lecode=$_POST['codeClient'];
	$materiel=$_POST['noseries'];
	$dateLoc=$_POST['DateLocation'];
	$dateRet=$_POST['DateRetour'];
// echo $lecode.'  '.$materiel.' '.$dateLoc.' '.$dateRet ;
	imprunter($lecode,$materiel,$dateLoc,$dateRet,$connection);
}
?>
<style>
table {
    border: 1px solid black;
	text-align: justify;
   
	text-justify:right;
}

</style>
<form method="post" action="#">
<table>
<tr>
	<td>Code</td>
	<td><select name="codeClient"><?php
		loadMembres($connection);
		?>
		</select>
	</td>
	</tr>
<tr>
	<td>Materiel</td>
	<td><select name="noseries"><?php
		loadMateriels($connection);
		?>
		</select></td>
</tr>
<tr>
	<td>DateLocation</td>
	<td><input type="date" name="DateLocation" value="<?php echo date('Y-m-d');?>" /></td>
</tr>
<tr>
	<td>DateRetour</td>
	<td><input type="date" name="DateRetour" value="<?php echo date('Y-m-d',strtotime(date('Y-m-d').'+30 DAY'));?>"/></td>
<!--value du retour :30 jours du date imprunt-->
</tr>
	<tr>
	<td><input type="Submit" name="btnImprunter" value="Imprunter"/></td>
	</tr>
</table>
</form>
<?php
function imprunter($code,$material,$dateLo,$dateRe,$connection){
	$requeteInsert=mysqli_query($connection,"insert into location(code,noserie,datelocation,dateretour)values ('$code','$material','$dateLo','$dateRe');") or die("erreur d'insertion");
 $affect=mysqli_affected_rows($connection);
if($affect<=0){
	echo "Aucun ajout";
}
else{
	phpAlert("Location Enregistré avec succes! N'oubliez pas de le remetre a temps!");
	//update le status du materiel
	MiseAjourMateriel($connection,$material);
}
}

?>
<?php //BLOCK DE FONCTIONS 
// Ajout de membres dans le select
function loadMembres($connection){
	$requete=mysqli_query($connection,"select code from membre;") or die("erreur de selection");
//nombre d'enregistrement retourner par le select
 $nombre=mysqli_num_rows($requete) ;
//Affichage
while($resultat=mysqli_fetch_row($requete)){
	$code=$resultat[0];
	echo '<option '.$selected.'>' . $code .'</option>';
}
}
// Ajout de materiels disponibles dans le select
function loadMateriels($connection){
	$requete=mysqli_query($connection,"select noserie from materiel where disponibilite ='1';") or die("erreur de selection");
    //nombre d'enregistrement retourner par le select
$nombre=mysqli_num_rows($requete) ;
	if($nombre<1){
		// echo $nombre;
		echo 'pas de materiel disponible';
	}
	else{
		// echo $nombre;
//Affichage
while($resultat=mysqli_fetch_row($requete)){
	$serieN=$resultat[0];
	echo '<option '.$selected.'>' . $serieN .'</option>';
}
	}
}
// mise a jour de la disponibilite d'un materiel imprunter
function MiseAjourMateriel($connection,$seriesN){
	$requeteUpdate=mysqli_query($connection,"update materiel set disponibilite='0' where noserie='$seriesN' ;") or die("Update Error");
//Nombre d'enregistrement affectes par update
$affected=mysqli_affected_rows($connection);
if($affected<=0){
	// echo "aucune information";
	return false;
}
else{
	// echo $affected ."Donnees mise a jour";
	return true;
}
}

?>