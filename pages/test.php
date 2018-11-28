<?php
    include 'connection.php';
if(isset($_POST['btnAffiche']))
    {echo 'ok';
        $cod=$_POST['codeMem2'];
    echo '<form method="post">
    Choisir Code: <select name="Nomat2">';
    $requete=mysqli_query($connection,"select noserie,datelocation from location where code='$cod' ;")or die("Erreur de requete SQL");
    while($resultat=mysqli_fetch_row($requete))
    {
        $code = $resultat[0];
        $datel=$resultat[1];
        if($choix==$code){
        $selected="selected";
        }
        else
        {
        $selected="";
        }
        echo "<option value= '$code' $selected>$code loué le $datel</option>";
    }      
    echo'<input type="hidden" name="codechoisi" value="'.$cod.'">
    </select><br/><br/>
    <input type="submit" value="Supprimer" name="delLoc">
    </form>' ;
}
else if(isset($_POST['delLoc']))
{
$code=$_POST['codechoisi'];
$mee=$_POST['Nomat2'];
$requete=mysqli_query($connection,"select noserie,datelocation from location where code='$code' ;")or die("Erreur de requete SQL");
$resultat=mysqli_fetch_row($requete);
$datel=$resultat[1];              
mysqli_query($connection,"delete from location where code='$code'and noserie='$mee' and datelocation='$datel';") or die("Erreur de requete de suppression");
echo "location supprimée";
mysqli_query($connection,"update materiel set disponibilite=1 where noserie='$mee' ;") or die("Erreur de la requete Update");
}
?>
<?php
echo "<h3 style='margin-right:500px;'>Listes des Locations </h3>";
echo'<table border="1" style="text-align:center;">
<tr>
<th>Code</th>
<th>No serie</th>
<th>Date location</th>
<th>Date de retour</th>
<th>Prix de la location</th>
</tr>';       ?>
<?php
$requetee=mysqli_query($connection,"select * from location ;")or die("Erreur de requete SQL");
while($resultatt=mysqli_fetch_row($requetee))
{    echo "<tr>" .
'<td>'. $resultatt[0].'</td>'.
'<td>'. $resultatt[1].'</td>'.               
'<td>'. $resultatt[2].'</td>'.
'<td>'. $resultatt[3].'</td>'.

"</tr>";
}        
echo '</table>';
?>
<h3>Compte/Retour</h3>
<form method="post">
Choisir Code: <select name="codeMem2">
<?php
$requete=mysqli_query($connection,"select distinct(code) from location;")or die("Erreur de requete SQL");
while($resultat=mysqli_fetch_row($requete))
{
$code = $resultat[0];
if($choix==$code){
$selected="selected";
}
else
{
$selected="";
echo "<option value= '$code' $selected>$code</option>";
}
} ?>
</select><br/><br/>
<input type="submit" name="btnAffiche
">
</form>
