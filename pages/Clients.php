<?php
include 'connection.php';
if(isset($_POST['codeClient'])){
    
	$no=$_POST['codeClient'];
	$name=$_POST['nomClient'];
	$surname=$_POST['prenomClient'];
	$pass=$_POST['passClient'];
		if(isset($_POST['btnClient'])){
		switch ($_POST['btnClient'])
		{
		case 'Ajouter':
			echo' bouton '.$_POST['btnClient'].'<br>';
			if (VerifyData($no,$name,$surname,$pass)){
				echo 'data present';
				AjouterUnMembre($connection,$name,$surname,$pass);
			}
			else{
				echo 'no data present';
			}
			
			break;
		case 'Afficher':
			echo' bouton '. $_POST['btnClient'].'<br>';
			AfficherUnMembre($connection,$no);
			break;
		case 'Modifier':
			echo' bouton '. $_POST['btnClient'].'<br>';
			if (VerifyInputs($no,$name,$surname)){
				echo 'data present';
				ModifierUnMembre($connection,$no,$name,$surname);
			}
			else{
				echo 'no data present';
			}
			break;
		case 'Supprimer':
			echo' bouton '. $_POST['btnClient'].'<br>';
			//SupprimerUnMembre($connection,$no);
			if (VerifyData($no,$name,$surname,$pass)){
				echo 'data present';
			}
			else{
				echo 'no data present';
			}
			break;
		case 'AfficherTous':
			echo' bouton '. $_POST['btnClient'].'<br>';
			AfficherTousMembres($connection);
			break;
			
		}
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
}
</style>
<form method="post" action="#">                                                 
		         <ul class="nav navbar-nav" id="collapse-m" >

	<li><input type="Submit" name="btnClient" value="Ajouter"/></li>
	<li><input type="Submit" name="btnClient" value="Afficher"/></li>
	<li><input type="Submit" name="btnClient" value="Modifier"/></li>
	<li><input type="Submit" name="btnClient" value="Supprimer"/></li>		 
	<li><input type="Submit" name="btnClient" value="AfficherTous"/></li>		 
	</ul>
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

</table>
</form>
<?php
function VerifyData($code,$name,$prenom,$passW){
	if ($code==""||$name==""||$prenom==""||$passW=="") {
		return false;
	}
	else{
		return True;
	}
}
function VerifyInputs($code,$name,$prenom){
	if ($code==""||$name==""||$prenom=="") {
		return false;
	}
	else{
		return True;
	}
}


function loadMembres($connection)
{
	$requete=mysqli_query($connection,"select code from membre;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	//Affichage
	while($resultat=mysqli_fetch_row($requete)){
	$code=$resultat[0];
	echo '<option '.$selected.'>' . $code .'</option>';
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
function AfficherTousMembres($connection)
	{
	$requete=mysqli_query($connection,"select code,nom,prenom from membre;") or die("erreur de selection");
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
function ModifierUnMembre($connection,$lecode,$lenom,$leprenom){
	$newCode=substr($lenom,0,3).substr($leprenom,0,2);
	$requeteUpdate=mysqli_query($connection,"update membre set code='$newCode', nom='$lenom', prenom='$leprenom' where code='$lecode';") or die("Update Error");
	//Nombre d'enregistrement affectes par update
	$affected=mysqli_affected_rows($connection);
	if($affected<=0){
	echo "aucune information";
	}
	else{
	echo $affected ."Donnees mise a jour";
	}	
}
function validateAdmin()
{
			
}
function SupprimerUnMembre($connection,$lecode){
	//Avant de supprimer demander la confirmation par mot de passe
      if( rechercheMembre($connection,$lecode)){
      	echo 'le membre existe';
      }
      else{
      	echo 'Erreur de selection du membre';
      }
	// 	$suppresion=mysqli_query($connection,"delete from membre where code='$lecode';") or die("Erreur de suppression");
	// $affectee=mysqli_affected_rows($connection);
	// if($affectee<=0){
	// 	echo "Rien supprimer";
	// }
	// else{
	// 	echo $affectee. "Donnees supprimer";
	// }
}
?>