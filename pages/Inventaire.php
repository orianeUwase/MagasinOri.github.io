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
<h5>Bienvenue sur l'inventaire du magasin scolaire teccart</h5>
<ul class="nav navbar-nav monNav" id="collapse-m">
	<li class="active"><a href="IndexAdmin.php?lien=Inventaire&cie=Affiche">AFFICHER</a></li>
	<li><a href="IndexAdmin.php?lien=Inventaire&cie=Ajout" >AJOUTER</a></li>

</ul><br/>
<?php
		if (isset($_GET["cie"])){
			$cie=$_GET["cie"];
			switch("$cie"){
				case "Affiche":
				include'InventaireAffiche.php';
					break;
				case "Ajout":
					include'InventaireAjout.php';
					break;
			}
		}
		?>