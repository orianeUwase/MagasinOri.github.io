<?php
session_start();
include("Connection.php"); 
if(!empty($_GET)){
	//echo 'action';
	switch ($_GET['action']) {
		case 'add':
			//echo 'add';
			if(!empty($_POST['quantity'])){
				//echo $_POST['quantity'];
			}
				$requete=mysqli_query($connection, "SELECT * FROM tblproduct WHERE code='".$_GET["code"]."'") or die ("Erreur1 ");
	    

			   $nombre = mysqli_num_rows($requete);
	            if($nombre >0)
   					{
	                while($resultat=mysqli_fetch_row($requete))
	                {
						$code = $resultat[2];
					    $img= $resultat[3];
					    $price = $resultat[4];
					    $name =  $resultat[1]; 
					} 
				}   
			    //echo $code;
			    $itemArray = array(
			    	$code=>array(
				    	'name' =>$name ,
				    	'code' =>$code,
				    	'quantity' =>$_POST["quantity"],
				    	'price' =>$price)
		    	);
		    	if(!empty($_SESSION["cart_item"])){
		    		echo 'cart not empty';
		    		if(in_array($code, array_keys($_SESSION["cart_item"]))){
		    			foreach ($_SESSION["cart_item"] as $k => $v) {
		    				if($code==$k){
		    					$_SESSION["cart_item"][$k]["quantity"]+=$_POST["quantity"];
		    				}
		    			}
		    		}
		    		else{
		    		$_SESSION["cart_item"]=array_merge($_SESSION["cart_item"],$itemArray);}
		    	}
		    	else{
		    	$_SESSION["cart_item"]=$itemArray;
		    	//print_r($_SESSION["cart_item"]);
		   		}
		break;
		case 'vide':
		unset($_SESSION["cart_item"]);
		echo 'case vide';
		break;
		case 'remove':
		echo 'remove';
		foreach ($_SESSION["cart_item"] as $k => $v) {
			if ($_GET["code"]== $k) {
				unset($_SESSION["cart_item"][$k]);
				if(empty($_SESSION["cart_item"])){
					echo 'cart empty';
				unset($_SESSION["cart_item"]);
				}
			}
			
		}

		break;
		default:
			# code...
			break;
	}
}
else{
	echo 'nooo';
}
?>

<HTML>
<HEAD>
	<TITLE>Panier en PHP</TITLE>  
	<link href="../style/style.css" type="text/css" rel="stylesheet" />   
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>
<BODY>
	<div id="shopping-cart">
        <div class="txt-heading">
        Panier d'achats 
        <a id="btnEmpty" href="ex10.php?action=vide">Videz le panier</a>
        </div>
    <?php
        if(isset($_SESSION["cart_item"])){
        	$itemTotal=0.0;
        
    ?>	 
	<table cellpadding="10" cellspacing="1">
    	<tbody>
        <tr>
            <th style="text-align:left;"><strong>Nom</strong></th>
            <th style="text-align:left;"><strong>Code</strong></th>
            <th style="text-align:right;"><strong>Quantité</strong  ></th>
            <th style="text-align:right;"><strong>Prix</strong></th>
            <th style="text-align:center;"><strong>Action</strong></th>
            </tr>	
    <?php		
        foreach ($_SESSION["cart_item"] as $item){
    ?>
        <tr>
        <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
        <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
        <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
        <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["price"]; ?></td>
        <td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
            <a class="btnRemoveAction" href="ex10.php?action=remove&code=<?php echo $item["code"]; ?>" style="font-size:24px,color:black"><i class="fa fa-trash-o"></i></a>
     	</td>
        </tr>
        <?php
        $itemTotal=$itemTotal+$item["price"];
		}
		?>

        <tr>
        <td colspan="5" align=right>
        	<strong>Total <?php echo  $itemTotal;?></strong>
        </td>
        </tr>
    	</tbody>
	</table>		
  <?php
}
?>
</div>


<div  id="product-grid">
	<div class="txt-heading">Produits &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
		<a href="sessiondestroy.php"> DestroySession</a></div>
     
	<?php
	
    $requete=mysqli_query($connection, "SELECT * FROM tblproduct ORDER BY id ASC") or die ("Erreur1 : Table inexistante");
    
   
   $nombre = mysqli_num_rows($requete);
            if($nombre >0)
	   {
                while($resultat=mysqli_fetch_row($requete))
    
                {
	$code = $resultat[2];
    $img= $resultat[3];
    $price = $resultat[4];
    $name =  $resultat[1];              
    ?>
    


		<div class="product-item">
           
			<form method="post" action="ex10.php?action=add&code=<?php echo $code; ?>">
			<div class="product-image">
          
            <!-- la balise image -->
                <img src="<?php echo '../images/'. $img.'.jpg'; ?>"></div>
            <!-- le nom -->
				<div><strong><?php echo $name; ?></strong></div>
			<!-- le prix -->
				<div class="product-price"><?php echo "$".$price; ?></div>
			<!-- la quantite -->
				<div><input type="text" name="quantity" value="1" size="2" />
					<!-- le button -->
					<input type="submit" value="Ajout au panier" class="btnAddAction" />
				</div>
                  
			</form>
              
		</div>
	<?php
			}
	}
	?>
</div>
</BODY>
</HTML>
