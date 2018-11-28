<style>
table, th, td {
    padding: 5px;
}
table {
    border: 1px solid black;
	text-align: justify;
	margin-top:50px;
	margin-left: 20px;
}

</style>
<h6>Bienvenue sur la page de CLIENTS du magasin scolaire teccart</h6>
<ul class="nav navbar-nav monNav" id="collapse-m">
	<li class="active"><a href="IndexAdmin.php?lien=Clients&cie=afficher">VISUALISER </a></li>
	<li><a href="IndexAdmin.php?lien=Clients&cie=ajouter" >AJOUTER</a></li>
	<li><a href="IndexAdmin.php?lien=Clients&cie=modifier" >MODIFIER/SUPPRIMER</a></li>

</ul><br/>
<?php
include 'connection.php';
		if (isset($_GET["cie"])){
			$cie=$_GET["cie"];
			switch("$cie"){
				case "afficher":
				include'ClientAffiche.php';
					break;
				case "ajouter":
					include'ClientAdd.php';
					break;
				case "modifier":
					include'ClientUpdate.php';
					break;
				
			}
		}?>
		<table id="t01">
		<caption>Liste des Membres</caption>
		<tr>
		<th>Code</th>
		<th>Nom</th>
		<th>Prenom</th>
		<th>Status</th>
		</tr>
		<?php
     AfficherTousMembres($connection);
		
?>
<?php
function AfficherTousMembres($connection)
{
	$requete=mysqli_query($connection,"select code,nom,prenom,status from membre;") or die("erreur de selection");
	//nombre d'enregistrement retourner par le select
	//Affichage
	while($resultat=mysqli_fetch_row($requete)){
		$code=$resultat[0];
		$nom=$resultat[1];
		$prenom=$resultat[2];
		$status=$resultat[3];
		echo '<tr>   <td>'. $code .'</td>'.
			'<td>'. $nom .'</td>'.
			'<td>'. $prenom .'</td>'.
			'<td>'. $status .'</td>'.
		'</tr>';

	}
}
?>