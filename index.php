<?php
session_start();
if (isset($_POST['btnLogin'])){

	$user=$_POST['username'];
	$pswd=$_POST['password'];
	$_SESSION['Suser']=$user;
	$_SESSION['Spswd']=$pswd;
	login($_SESSION['Suser'],$_SESSION['Spswd']);
	
}
?>
<?php
date_default_timezone_set('America/Toronto');
if(isset($_COOKIE['myDate'])){
	
}else{

$t=time();
$Lt=date("Y-m-d h:i:sa",$t);
setcookie('myDate', $Lt, time() + 365*24*3600, null, null, false, true);}
?>

<!DOCTYPE html>
<html lang="fr">
	
	<head>
	
		<meta charset="utf-8">
		<title>Magasin Scolaire</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Connexion à mon application">
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />

		
		<link rel="stylesheet" type="text/css" href="../style/homes.css"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato:400,700,300" />
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="main">
						<div class="row">
						<div class="col-xs-12 col-sm-6 col-sm-offset-1">	
							<h1>Institut Teccart</h1>
							<h2>Magasin scolaire</h2>
							<form name="login" role="form" class="form-horizontal" method="post" accept-charset="utf-8">
							<!--               //username-->
								<div class="form-group">
								<div class="col-md-8"><input name="username" placeholder="Idenfiant" class="form-control" type="text" id="UserUsername"/></div>
								</div> 
							<!--				//Password-->
								<div class="form-group">
								<div class="col-md-8"><input name="password" placeholder="Mot de passe" class="form-control" type="password" id="UserPassword"/></div>
								</div> 
							<!--				//button-->
								<div class="form-group">
								<div class="col-md-offset-0 col-md-8"><input  class="btn btn-success btn btn-success" type="submit" value="Connexion" name="btnLogin"/></div>
								</div>
							</form>
							<p class="credits">Développé par <a href="http://www.monsite.com" target="_blank">UWase Oriane</a>.</p>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
function login($util,$mot){
include 'connection.php';
$requete=mysqli_query($connection,"select * from membre where code = '$util' and password = '$mot' ;") or die("erreur de selection");
	if(mysqli_num_rows($requete) <=0){
		//echo 'user or pswd incorect';
		phpAlert("Merci d'utiliser un nom d'utilisateur et motPasse Corret");
	}
	else{
	while($resultat=mysqli_fetch_row($requete)){
		$_SESSION['snom']=$resultat[1];
		$_SESSION['spre']=$resultat[2];
		$_SESSION['statut']=$resultat[3];
		if($resultat[3]=='admin')
		{
			
		// echo $resultat[0].' '.$resultat[1].' '.$resultat[2].' '.$resultat[3];
	
//		include 'IndexAdmin.php';
			echo "<script> window.location.href='IndexAdmin.php';</script>";
		}
		else{
			// echo 'utilisateur non admin'.
		echo	"<script> window.location.href='IndexClient.php';</script>";
		}
	}
	}
	
}

?>