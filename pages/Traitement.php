<?php 
include 'Connection.php';
$lecode=$_GET['val'];
$requete=mysqli_query($connection,"select * from membre where code ='$lecode';") or die("erreur de selection");
$data=array();
while($res=mysqli_fetch_assoc($requete)){
    $data[]=$res;
}
echo json_encode($data);
?>