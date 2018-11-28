<?php
session_start();
if($_SESSION['statut']!= 'admin'){
	echo "<script> window.location.href='Index.php';</script>";
}
else{
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
}
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
      <li><a href="IndexAdmin.php?lien=Logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	    </ul>
		
		<div class="container">
		<div class="row">
		<div class="col-xs-12">
		<div class="main">
		<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-1">
					
			<h1>Institut Teccart</h1>
			<h2>Magasin scolaire</h2>
			</div>
			</div>
			 <p style="text-align:center"> Bonjour <?php echo $_SESSION['snom'].' '.$_SESSION['spre'];
			 ?> <br/>Premiere connection au site:
			<?php 
			echo $_COOKIE['myDate']; ?> <br/>
			Avec l'adresse IP : <?php echo $ip;?>
			</p>
			<nav class="navbar monNav">
	           <div class="container">
			        <ul class="nav navbar-nav" id="collapse-m">
						<li class="active"><a href="IndexAdmin.php?lien=Accueil">ACCUEIL</a></li>
						<li><a href="IndexAdmin.php?lien=Location" >LOCATIONS</a></li>
						<li><a href="IndexAdmin.php?lien=Inventaire">INVENTAIRE</a></li>
						<li><a href="IndexAdmin.php?lien=Clients">CLIENTS</a></li>
					</ul>
	            </div> <!-- container-->
           </nav>
	
			<?php
					//tester le lien et envoyer vers la page desirer
					if (isset($_GET['lien']))
						{
					switch ($_GET['lien']){
						case 'Accueil':
							
							include'Logout.php';
						break;
						case 'Location':
							// echo'location';
							include'Locations.php';
						break;
						case 'Inventaire':
							// echo'inventaire';
							include'Inventaire.php';
						break;
						case 'Clients':
							// echo'Client';
							include'Client.php';
						break;
						case 'Logout':
							// echo'Logout';
							include'Logout.php';
						break;
						default:
							echo'';
							
					}
					}
					else{
					echo 'Veillez choisir un option dans le menu!';
					}
					?>

			<!-- <p class="credits">Développé par <a href="http://www.monsite.com" target="_blank">UWase Oriane</a>.</p> -->

		</div>
		</div>	
	</div>
	</div>
	</body>
</html>