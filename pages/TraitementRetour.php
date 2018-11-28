<?php 
include 'Connection.php';
$lecode=$_GET['membre'];
$lemat=$_GET['materiel'];
 Retour($lecode,$lemat,$connection);
?>
<?php
    function UpdateMateriel($connection,$seriesN){
        $requeteUpdate=mysqli_query($connection,"update materiel set disponibilite='0' where noserie='$seriesN' ;") or die("Update Error");
        //Nombre d'enregistrement affectes par update
        $affected=mysqli_affected_rows($connection);
        if($affected<=0){
            echo "aucune information";
        }
        else{
            echo $affected ."Donnees mise a jour";
        }
    }
    
    //**********Retour d'un materiel******
    //suppresion et update
    function Retour($membre,$materiel,$connection){
        //TODO: un attribut qui rend unique une ligne besides the PK
        $suppresion=mysqli_query($connection,"delete from location where code='$membre' and  noserie='$materiel';") or die("Erreur de suppression");
        $affectee=mysqli_affected_rows($connection);
        if($affectee<=0){
            echo "Rien supprimer";
        }
        else{
            echo $affectee. "Donnees supprimer";
            UpdateMateriel($connection,$materiel);
        }
                
    }
?>