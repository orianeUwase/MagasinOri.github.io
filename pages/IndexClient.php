<?php
	session_start();
	// if(isset($_SESSION['Suser'])){
	 	include 'connection.php';
	// 	$user=$_SESSION['Suser'];
	// 	$res=AfficherUser($user,$connection);
	// 	//echo '<h5> Salut '.$res.'</h1>';
	// 	//AfficheClientRents($user,$connection);
	// 	if(isset($_POST['btnQuitter'])){
	// 		session_destroy();
	// 		echo 'byee';
	// 	}
	// }
	// else{
	// 	echo 'Votre session est fini';
	// }
?>
<!DOCTYPE html>
<html lang="fr">
	
	<head>
	
		<meta charset="utf-8">
		<title>Magasin Scolaire</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Connexion à mon application">
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />

		<!-- ci-dessous notre fichier CSS -->
		<link rel="stylesheet" type="text/css" href="../style/home.css"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:400,700,300" />
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>

		<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Switch Account</a></li>
      <li><a href="IndexClient.php?lien=Logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
		
		<div class="container">
		<div class="row">
		<div class="col-xs-12">
		<div class="main">
		<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-1">
			<h1>Institut Teccart</h1>
			<h2>Magasin scolaire</h2>
			<h3> Bonjour <?php echo $_SESSION['snom'].' '.$_SESSION['spre'];?></h3>
			 What do you wanna do today?
			</div>
			</div>
			<nav class="navbar monNav">
	           <div class="container">
				   
			        <ul class="nav navbar-nav" id="collapse-m">
						<li class="active"><a href="IndexClient.php?lien=Locations">Acceder au LOCATIONS</a></li>
						<li><a href="IndexClient.php?lien=Panier" >Acceder au PANIER</a></li>
					</ul>
	            </div> <!-- container-->
           </nav>
			<?php
					//tester le lien et envoyer vers la page desirer
					if (isset($_GET['lien']))
						{
					switch ($_GET['lien']){
						case 'Locations':
						$user=$_SESSION['Suser'];
						AfficheClientRents($user,$connection);
						break;
						case 'Panier':
							echo'location';
							echo "<script> window.location.href='ex10.php';</script>";
						break;
						case 'Logout':
							echo'Logout';
							include'Logout.php';
						break;
						default:
							echo'';
							
					}
					}
					else{
					echo 'pas encore';
					}
			?>
			<p class="credits">Développé par <a href="http://www.monsite.com" target="_blank">UWase Oriane</a>.</p>

		</div>
		</div>	
	</div>
	</div>
	</body>
</html>
<?php
	function AfficherUser($code,$connection){
		$requete=mysqli_query($connection,"select nom,prenom from membre where code ='$code';");
			while($resultat=mysqli_fetch_row($requete)){
				$res=$resultat[0];
				$res=$res. ' '.$resultat[1];
			}
			return $res;
	}
	function AfficheClientRents($user,$connection){
	
		$requete=mysqli_query($connection,"select noserie,datelocation,dateretour from location where code = '$user';")
		or die("erreur de selection");
		if(mysqli_num_rows($requete) <=0){
			echo 'no data found';
			echo'pas de location en cours';

		}else{
			echo'<h3>Voici vos equipements en location</h3>';
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
?>