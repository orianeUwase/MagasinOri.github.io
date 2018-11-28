<!-- <style>
	table, th, td {
    
    padding: 5px;
	}
	table {
	border: 1px solid black;
	border-spacing: 15px;
	margin-top:50px;
	margin-left: 20px;
	}
</style> -->
<?php
// include 'connection.php';

if(isset($_POST['btnClient'])){
	// echo 'ok';
	// $no=$_POST['codeClient'];
	// echo $no;
	AfficherUnMembre($connection,$no);
}
?>

<!-- <h6>Bienvenue sur la page de CLIENTS AFFICHE du magasin scolaire teccart</h6> -->
<form >
<table>
	<tr>
		<td>Code</td>
		<td><select id="codeClient" name="codeClient"><?php
			loadMembres($connection);
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Nom</td>
		<td><input id="nom" type="text" name="nomClient"/></td>
	</tr>
	<tr>
		<td>Prenom</td>
		<td><input id="prenom" type="text" name="prenomClient"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input id="mdp" type="Password" name="passClient"/></td>
	</tr>
	<tr><td>
	<input type="button" id="btnAjout" name="btnAfficheTous" value="AfficheAjax"/>

	</td>
	</tr>
</table>
</form>
		

<script src="../script/jquery.min.js"></script>
<script src="../script/Javascript.js"></script>

<?php
function loadMembres($connection)
{
	$requete=mysqli_query($connection,"select code from membre;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	//Affichage
	while($resultat=mysqli_fetch_row($requete)){
	$code=$resultat[0];
	echo '<option >' . $code .'</option>';
   }
}

function AfficherUnMembre($connection,$lecode){
	$requete=mysqli_query($connection,"select code,nom,prenom from membre where code ='$lecode';") or die("erreur de selection");
	 //nombre d'enregistrement retourner par le select
	 //Affichage
		 while($resultat=mysqli_fetch_row($requete)){
		$code=$resultat[0];
		$nom=$resultat[1];
		$prenom=$resultat[2];
		echo $code ."	";
		echo $nom ." 	";
	 	echo $prenom ."  	".'<br>';
   }
}

?>