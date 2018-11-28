<style>
	
	#t01{
			margin: 10px;
		}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td {
		padding: 15px;
		text-align: left;
	}
	table#t01 tr:nth-child(even) {
		background-color: #eee;
	}
	table#t01 tr:nth-child(odd) {
	background-color: #fff;
	}
	table#t01 th {
		background-color: black;
		color: white;
	}
</style>
<body>
	<table id="t01">
		<caption>Liste des equipments</caption>
		<tr>
		<th>Code</th>
		<th>Nom</th>
		<th>Prix $</th>
		<th>Disponible</th>
		</tr>
		<?php
		$Total=0;
		include 'connection.php';
		$requete=mysqli_query($connection,"select * from materiel;") or die("erruer de selection");
		//nombre d'enregistrement retourner par le select
		// echo $nombre=mysqli_num_rows($requete) .'<br>';
		//Affichage
		while($resultat=mysqli_fetch_row($requete)){
			$code=$resultat[0];
			$nom=$resultat[1];
			$prix=$resultat[2];
			if($resultat[3]==1){
				$dispo='oui';
			}
			elseif($resultat[3]==0){
				$dispo='non';
			}
			echo '<tr> <td>'. $code .'</td>'.
					'<td>'. $nom .'</td>'.
					'<td>'. $prix .'</td>'.
					'<td>'. $dispo .'</td>'.
				'</tr>';
			$Total+=$prix;
		}
			// echo '</table>';
			echo '<br><h2> la valeur de linventaire est: $ '.$Total;
		?>
	</table>
</body>