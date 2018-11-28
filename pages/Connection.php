<?php
 $connection = mysqli_connect('localhost','root','','magasinscolaire') or die("error");
mysqli_select_db($connection,'magasinscolaire')or die("erreur de connexion a la base de de donnees");
	//selection
	/*$selection=mysqli_query($connection,"select * from materiel;")or die("erreur de selection");
	while($resultat=mysqli_fetch_row($selection)){
		$code=$resultat[0];
		$nom=$resultat[1];
		$prix=$resultat[1];
		$pic=$resultat[1];
		echo $code .'	'.$nom.'	'.$prix.'	'.$pic.'<br>';
	}*/

?>
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}?>