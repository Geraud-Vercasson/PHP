
// Fonction addCoin Thomas
function addCoin(coin){

    COMPTEUR += coin;
    COMPTEUR = (Math.round(COMPTEUR*100))/100;

    $('#monnaie').attr('value',COMPTEUR);
    $('#monnaieIntroduite').html('Crédit : ' + (COMPTEUR/100) + ' € ');
    // affiche("Crédit " + COMPTEUR + " €");
        
}

$(document).ready(function(){
    
    // $('#pieces').hide();

    COMPTEUR = Math.round(parseFloat($('#monnaieIntroduite').html().split(' ')[3])*100);
    console.log("compteur " + COMPTEUR);
    
    $('#btnPlusSucre').click(function(){
        addSugar();
    });
    
    $('#btnMoinsSucre').click(function(){
        removeSugar();
    });
    

    $('#btn5cts').click(function(){
        addCoin(5);
    });
    
    
    $('#btn10cts').click(function(){
        addCoin(10);
    });
    
    
    $('#btn20cts').click(function(){
        addCoin(20);
    });
    
    
    $('#btn50cts').click(function(){
        addCoin(50);
    });
    
    
    $('#btn1euro').click(function(){
        addCoin(100);
    });
    
    
    $('#btn2euro').click(function(){
        addCoin(200);
        
        
    });
    
});
