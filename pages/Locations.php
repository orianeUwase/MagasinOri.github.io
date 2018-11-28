<h6>Bienvenue sur la page de location du magasin scolaire teccart</h6>
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
<ul class="nav navbar-nav " id="collapse-m">
	<li class="active"><a href="IndexAdmin.php?lien=Location&cie=imprunts">EMPRUNTS</a></li>
	<li><a href="IndexAdmin.php?lien=Location&cie=retour" >RETOUR</a></li>
</ul>
<br/>
<?php
		if (isset($_GET["cie"])){
			$cie=$_GET["cie"];
			switch("$cie"){
				case "imprunts":
				include'LocationImprunt.php';
					break;
				case "retour":
					include'LocationRet.php';
					break;
			}
		}
?>