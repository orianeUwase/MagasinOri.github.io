<!-- <h6>Bienvenue sur la page de CLIENTS ADD du magasin scolaire teccart</h6> -->
<?php
	// include 'connection.php';
		if(isset($_POST['btnClient'])){
	$name=$_POST['nomClient'];
		$surname=$_POST['prenomClient'];
		$pass=$_POST['passClient'];
			if (VerifyData($name,$surname,$pass)) {
				AjouterUnMembre($connection,$name,$surname,$pass);
				
			}
			else{
				echo 'données manquantes';
			}
	}
?>
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
	.btn{
		margin-left:90px;
	}
</style> -->

<form method="POST" action="#">
	<table>
		<tr>
		<td>Nom</td>
		<td><input type="text" name="nomClient"/></td>
	</tr>
	<tr>
		<td>Prenom</td>
		<td><input type="text" name="prenomClient"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="Password" name="passClient"/></td>
	</tr>
	<tr>
		<td >
			<input type="Submit" class="btn" name="btnClient" value="Ajouter"/>
		</td>
	</tr>
	</table>
</form>
<?php
function VerifyData($name,$prenom,$passW){
	if ($name==""||$prenom==""||$passW=="") {
		return false;
	}
	else{
		return True;
	}
}
function AjouterUnMembre($connection,$newNom,$newPrenom,$newPass){
  	$newCode=substr($newNom,0,3).substr($newPrenom,0,2);
	$insertQuery=mysqli_query($connection,"insert into membre(code,nom,prenom,status,password)
		values('$newCode','$newNom','$newPrenom','membre','$newPass');")or die("erreur d'insertion");
		$affect=mysqli_affected_rows($connection);
		  if($affect<=0){
			echo "Aucun ajout";
			  }
		  else{
			echo "Insertion correcte";
		       }		
}
?>