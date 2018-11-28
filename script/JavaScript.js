$(document).ready(function(){
    $('#btnAjout').click (function(){
        
        var codeaffiche = $('#codeClient').val();
        $.get("Traitement.php?val="+ codeaffiche, function (data) {
                var membre = JSON.parse(data);
                $('#prenom').val(membre[0].prenom);
                $('#nom').val(membre[0].nom);
            $ ('#mdp').val(membre[0].password); 
        });
    });
    $("#remettre").click(function(){
       
        var codeMem=$('#codeMembre').val();
        var  codeEqui=$("#Equipement").val();
       $.get("TraitementRetour.php?membre="+codeMem+"&materiel="+codeEqui,function(data)
       {
           if(data){
            alert("Equipement retourner");
           // window.location.reload(true);
            $.post('server.php', $('#theForm').serialize())
           }
           else{
            alert('Errorrrrr');
           }
       });
    });

});