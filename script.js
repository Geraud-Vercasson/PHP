
// Fonction addCoin Thomas
function addCoin(coin){

    COMPTEUR += coin;
    COMPTEUR = (Math.round(COMPTEUR*100))/100;
    if (COMPTEUR < 1){
        $('#monnayeur').html('Crédit : ' + Math.round(COMPTEUR*100) + " Cts");
    } else {
        $('#monnayeur').html('Crédit : ' + COMPTEUR + " €");       
    }

    $('#monnaie').attr('value',COMPTEUR);
    $('#monnaieIntroduite').html('Crédit : ' + COMPTEUR + ' € ');
    // affiche("Crédit " + COMPTEUR + " €");
        
}

$(document).ready(function(){
    
    // $('#pieces').hide();

    COMPTEUR = parseFloat($('#monnaieIntroduite').html().split(' ')[3]);
    console.log("compteur " + COMPTEUR);
    
    $('#btnPlusSucre').click(function(){
        addSugar();
    });
    
    $('#btnMoinsSucre').click(function(){
        removeSugar();
    });
    

    $('#btn5cts').click(function(){
        addCoin(0.05);
    });
    
    
    $('#btn10cts').click(function(){
        addCoin(0.1);
    });
    
    
    $('#btn20cts').click(function(){
        addCoin(0.2);
    });
    
    
    $('#btn50cts').click(function(){
        addCoin(0.5);
    });
    
    
    $('#btn1euro').click(function(){
        addCoin(1);
    });
    
    
    $('#btn2euro').click(function(){
        addCoin(2);
        
        
    });
    
});
