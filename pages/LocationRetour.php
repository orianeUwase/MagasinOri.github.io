<?php
include 'connection.php';
if(isset($_POST['btnAffiche'])){
	$membre=$_POST['membre'];
	AfficheClientRents($membre,$connection);
	
}

?>
<style>
table {
    border: 1px solid black;
	text-align: justify;
	margin-top:50px;
	margin-left: 20px;
}
</style>
<form id="theForm"method="post">
	<table>
    <tr>
	<td>Code</td>
	<td><select id="codeMembre" name="membre">
		<?php
		loadMembres($connection);
		?>
		</select></td>
	</tr>
	<tr>
	<td><input type="Submit" name="btnAffiche" value="Afficher"/></td>
	</tr>
	</table>
	</form>
	<?php
	if(isset($_POST['btnAffiche'])){
		// $equi=$_POST['Equipement'];
		// echo "<input type='hidden' name='Equipement' value='$equi'>";
		
		if(isset($_POST['btnRetourner'])){
			
			echo 'retour';
		}
		else{
			// loadMateriels($membre,$connection);
			//echo $_POST['Equipement'];
		}
	//echo $equi;
	}
	?>

<?php
function loadMembres($connection){
	$requete=mysqli_query($connection,"select DISTINCT code from location;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	if(mysqli_num_rows($requete)<=0){
		echo'Pas de location en cours';

	}
	else{
		//Affichage
		while($resultat=mysqli_fetch_row($requete)){
			$selected=""; 
			$choix=($_POST['membre']);
			$code=$resultat[0];
			if($choix==$code){
				$selected="selected";
			}
			echo '<option '.$selected.' value='.$code.'>' . $code .'</option>';
		}
	}
}
//
function AfficheClientRents($user,$connection){
	
	$requete=mysqli_query($connection,"select noserie,datelocation,dateretour from location where code = '$user';")
	or die("erreur de selection");
	if(mysqli_num_rows($requete) <=0){
		echo'pas de location en cours';

	}
	else
	{
		//echo'<br><h3>Voici vos equipements en location</h3>';
	
		?>
		<br/>
		<table>
			<caption>Voici vos equipements en location</caption>
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
			loadMateriels($user,$connection);
	}
}
//
// Ajout de materiels Imprunter dans le select
function loadMateriels($user,$connection){
	$requete=mysqli_query($connection,"select noserie from location where code ='$user';") or die("erreur de selection");
    //nombre d'enregistrement retourner par le select
    $nombre=mysqli_num_rows($requete) ;
	if($nombre<1){
		// echo $nombre;
		// echo 'pas de materiel disponible';
	}
	else{
		?>
			<table>
				<!--	<caption>Voici vos equipements en location</caption>-->
				<tr>
				<td>Equipement</td>
				<td><select id="Equipement" name="Equipement">
				<?php
				//Affichage
				while($resultat=mysqli_fetch_row($requete))
				{
					$serieN=$resultat[0];
					echo '<option '.$selected.'>' . $serieN .'</option>';
				}
				?>
				</select></td></tr>
				<tr>
				<td>	
				<input type="Submit" id="remettre" name="btnRetourner" value="Remettre"/></td>

				</tr>
			</table>
		<?php
	}
}

?>
<script src="../script/jquery.min.js"></script>
<script src="../script/Javascript.js"></script>
