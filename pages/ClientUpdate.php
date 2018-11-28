<!-- <h6>Bienvenue sur la page de CLIENTS UPDATE du magasin scolaire teccart</h6> -->
<?php
	//  include 'connection.php';
		if(isset($_POST['btnClient'])){
		$code=$_POST['codeClient'];
		$name=$_POST['nomClient'];
		$surname=$_POST['prenomClient'];
		$pass=$_POST['passClient'];
		switch ($_POST['btnClient'])
		{
			case 'Modifier':
			if (VerifyInputs($code,$name,$surname)){
				//echo 'data present';
				ModifierUnMembre($connection,$code,$name,$surname);
			}
			else{
				phpAlert( 'Merci de remplir les champs requis!');
			}
			break;
			case 'Delete':
			// if (VerifyData($code)){
				
				if(isset($_POST['confirm'])){
						
					if($_POST['confirm']=='O'){
						// phpAlert( ' les champs requis OK!');
						// echo $code;
									SupprimerUnMembre($connection,$code);
							}
					elseif($_POST['confirm']=='N'){
								//echo 'supression annuler';
								phpAlert('supression annuler');
								//echo '<script type="text/javascript">alert("hello!");</script>';
							}
					
				}
				else{
					PrintConfirmForm($name,$surname,$pass,$code);
				}
		
			// }
			// else{
			// 	phpAlert( 'Merci de remplir les champs requis!');
			// }
			break;
			
		}
	}

?>
<style>
table, th, td {
    
    padding: 5px;
}
table {
	border: 1px solid black;
    border-spacing: 15px;
    margin-left:90px;
}
.btn{
	margin-left:90px;
}
</style>

<form method="POST" action="#">
	<table>
	<tr>
		<td>Code</td>
		<td><select name="codeClient" id="codeClient"><?php
			loadMembres($connection);
			?>
			</select>
		</td>
	</tr>
		<tr>
		<td>Nom</td>
		<td><input type="text" name="nomClient" id="nomClient"/></td>
	</tr>
	<tr>
		<td>Prenom</td>
		<td><input type="text" name="prenomClient" id="prenomClient"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="Password" name="passClient" id="passClient"/></td>
	</tr>
	<tr>
		<td >
			<input type="Submit" class="btn" name="btnClient" id="btnModify" value="Modifier"/>
		</td>
	
	
		<td >
			<input type="Submit" class="btn" name="btnClient" id="btnDelete"  value="Delete"/>
		</td>
	</tr>
	</table>
</form>
   <script src="../script/ajax.js"></script>
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
function VerifyInputs($code,$name,$prenom){
	if ($code==" "||$name==""||$prenom=="") {
		return false;
	}
	else{
		return True;
	}
}
function VerifyData($code){
	if ($code==" ") {
		return false;
	}
	else{
		return True;
	}
}
function ModifierUnMembre($connection,$lecode,$lenom,$leprenom){
	$newCode=substr($lenom,0,3).substr($leprenom,0,2);
	$requeteUpdate=mysqli_query($connection,"update membre set code='$newCode', nom='$lenom', prenom='$leprenom' where code='$lecode';") or die("Update Error");
	//Nombre d'enregistrement affectes par update
	$affected=mysqli_affected_rows($connection);
	if($affected<=0){
	echo "aucune information";
	}
	else{
	phpAlert('Donnees mise a jour Avec Success');
	}	
}
function rechercheMembre($connection,$unCode){
		$requete=mysqli_query($connection,"select * from membre where code ='$unCode';") or die("erreur de selection");
		$nb=mysqli_num_rows($requete);
		echo $nb.'<br>';
			if(mysqli_num_rows($requete) <=0)
			{
		return false;
		    }
			else{
		return True;
		}
}
function SupprimerUnMembre($connection,$lecode){
		$suppresion=mysqli_query($connection,"delete from membre where code='$lecode';") or die("Erreur de suppression");
	$affectee=mysqli_affected_rows($connection);
	if($affectee<=0){
		phpAlert( "Rien supprimer");
	}
	else{
		phpAlert("Donnees supprimer Avec Succes");
	}
}
function PrintConfirmForm($name,$surname,$pass,$code){
	//echo 'voulez-vous vraiment supprimer?'.'<br>';
	echo "
	<form method='post'>
		<table><tr><td>voulez-vous vraiment supprimer?</td></tr>
		<tr><td><input type='submit' name='confirm' value='O'/></td>
		<td><input type='submit' name='confirm' value='N'/></td></tr>
		<tr><td><input type='hidden' name='btnClient' value='Delete'>
		<input type='hidden' name='nomClient' value='$name'>
		<input type='hidden' name='prenomClient' value='$surname'>
		<input type='hidden' name='passClient' value='$pass'>
		<input type='hidden' name='codeClient' value='$code'></td></tr></table>
	</form>"; 
}

?>