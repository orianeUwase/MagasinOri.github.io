<style>
	table {
		border: 1px solid black;
		text-align: justify;
		margin-left: 20px;
	}
</style>
<?php
include 'connection.php';
$requete=mysqli_query($connection,"select DISTINCT code from location;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	 $nombre=mysqli_num_rows($requete);
	//Affichage
	if($nombre<=0){
		echo "<H3> Tous le materiel sont Retourner! IL n'y a pas des location en cours</h3>";
	}
	else{
?>
<form method="post" >
<table>
    <tr>
	<td>Code</td>
	<td><select name="membre">
		<?php
		loadMembres($connection);
		
		?>
		</select></td>
	</tr>
	<tr>
	<td><input type="Submit" name="btnAffiche" value="Afficher"/></td>
	</tr>
	</table>

<?php
if(isset($_POST['btnAffiche'])){
	$noClient=$_POST['membre'];
	AfficheClientRents($noClient,$connection);
	PrintConfirmForm($noClient,$connection);
	
}
else if(isset($_POST['btnRetourner'])){
	$client=$_POST['membreH'];
	$noSerie=$_POST['Equipement'];
	echo $noSerie;
	echo $client;
	Retour($client,$noSerie,$connection);

}
?>
<!-- </form> -->
<?php
	}

?>


<?php
function loadMembres($connection){
	$requete=mysqli_query($connection,"select DISTINCT code from location;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	echo $nombre=mysqli_num_rows($requete);
	//Affichage
	if($nombre<=0){
		echo "pas des location en cours";
	}
	else{
	while($resultat=mysqli_fetch_row($requete)){
		$selected="";
		 $choix=$_POST['membre'];
		 $code=$resultat[0];
		 if($choix==$code){
		 	$selected="selected";
		 }
		echo '<option '.$selected.' value='.$code.'>' . $code .'</option>';
	}}
}

function AfficheClientRents($user,$connection){
	
	$requete=mysqli_query($connection,"select noserie,datelocation,dateretour from location where code = '$user';")
	or die("erreur de selection");
	if(mysqli_num_rows($requete) <=0){
		echo 'no data found';
		echo'pas de location en cours';

	}
	else
	{
		echo'<h4>Voici vos equipements en location</h4>';
		?>
		<table>
		<!--	<caption>Voici vos equipements en location</caption>-->
		<tr> 
			<th>Noserie</th>
			<th>DateLocation</th>
			<th>DateRetour</th>
		</tr>
		<?php
			while($resultat=mysqli_fetch_row($requete)){
				echo'<tr> <td>' .$resultat[0].'</td><td> '.$resultat[1].'</td><td> '.$resultat[2].'</td></tr>';
			}
			echo'</table>';
		
	}
}

function UpdateMateriel($connection,$seriesN){
	$requeteUpdate=mysqli_query($connection,"update materiel set disponibilite='1' where noserie='$seriesN' ;") or die("Update Error");
		//Nombre d'enregistrement affectes par update
		$affected=mysqli_affected_rows($connection);
		if($affected<=0){
			echo "aucune information mise a jour";
		}
		else{
			echo $affected ."Donnees mise a jour";
		}
}
//**********Retour d'un materiel******
		//suppresion et update
function Retour($codeCl,$materiel,$connection){
		//TODO: un attribut qui rend unique une ligne besides the PK
	$suppresion=mysqli_query($connection,"delete from location where  noserie='$materiel';") or die("Erreur de suppression");
	$affectee=mysqli_affected_rows($connection);
	if($affectee<=0){
		phpAlert( "Rien supprimer");
	 }
	 else{
		PhpAlert( "Retour effectué avec succes!");
		UpdateMateriel($connection,$materiel);
		echo "<script> window.location.href='IndexAdmin.php?lien=Location&cie=retour';</script>";
	 }
					
}

function loadMateriels($user,$connection){
		$requete=mysqli_query($connection,"select noserie from location where code ='$user';") or die("erreur de selection");
		//nombre d'enregistrement retourner par le select
		$nombre=mysqli_num_rows($requete) ;
		if($nombre<1){
			echo $nombre;
			echo 'pas de materiel disponible';
		}
		else{
			?>
	<table>
	<!--	<caption>Voici vos equipements en location</caption>-->
		<tr>
		<td>Equipement</td>
		<td><select name="Equipement">
		<?php
	//Affichage
	while($resultat=mysqli_fetch_row($requete)){
		$serieN=$resultat[0];
		echo '<option '.$selected.'>' . $serieN .'</option>';
	}
			?>
			</select></td></tr>
		<tr>
		<td><input type="Submit" name="btnRetourner" value="Remettre"/></td>
		</tr>
		</table>
		<?php
	}
}
function loadMat($code,$connection){
	$requete=mysqli_query($connection,"select noserie from location where code ='$code';") or die("erreur de selection");
    //nombre d'enregistrement retourner par le select
    $nombre=mysqli_num_rows($requete) ;
	if($nombre<1){
		// echo $nombre;
		echo 'pas de materiel disponible';
	}
	else{
		while($resultat=mysqli_fetch_row($requete)){
			$selected="";
			$serieN=$resultat[0];
			if($code==$serieN){
				$selected="selected";
			}
			echo '<option '.$selected.'value='.$serieN.'>' . $serieN .'</option>';
		}
	}
}
function PrintConfirmForm($code,$connection){
	//echo 'voulez-vous vraiment supprimer?'.'<br>';
	?>
	<!-- echo " -->
	<!-- <form method='post' action="LocationRet.php"> -->
	<h4>Choissisez l'equipement à remetre</h4>
		<table>
			<!-- <caption>Choissisez l'equip a remetre</caption> -->
			<tr>
			<td>Equipement</td>
			<td><select name='Equipement'>
				<?php
			loadMat($code,$connection);
			?>
			</select>
			<tr><td><input type='hidden' name='membreH' value=' <?php echo $code ;?> '></td></tr>
			<tr><td><input type='Submit' name='btnRetourner' value='Remettre'></td></tr>
			</table>
	</form> <?php
}
?>
		