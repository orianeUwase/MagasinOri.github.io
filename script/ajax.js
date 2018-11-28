$(document).ready(function(){
	$("#btnAjout").click(function(e){
		e.PreventDefault();
		$.post('InventaireAjout.php',{
		code:$("#codeClient").val(),
		nom:$("#nomClient").val(),
		prix:$("#prixClient").val(),
	}, function( data){
		 if(data == 'Success'){
                     $("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
                }
                else{
                    
                     $("#resultat").html("<p>Erreur lors de la connexion...</p>");
                }
	},
	'text'
	);
});
});