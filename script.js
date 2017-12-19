
// /*Déclaration des variables*/
let COMPTEUR = 0;
// let NBSUCRES = 0;
let SELECTED = "";


function affiche(string){
    $('#afficheur').html(string);
}

function total(){
    let total = 0;

    total += PIECES['5cts'] * 0.05;
    total += PIECES['10cts'] * 0.10;
    total += PIECES['20cts'] * 0.20;
    total += PIECES['50cts'] * 0.50;
    total += PIECES['1euro'] * 1;
    total += PIECES['2euros'] * 2;

    total = Math.round(total * 100) / 100

    return total;
}

function resetDrink(){
    $('#btnThe').attr('src', 'images/btn_the_0.png');
    $('#btnCafe').attr("src","images/btn_espresso_0.png");
    $("#btnChocolat").attr("src", "images/btn_chocolat_0.png");
    $("#btnCappuccino").attr("src", "images/btn_cappuccino_0.png");
    }
    
function selectDrink(doSelect, drink){
    resetDrink();
    if (drink === 'thé'){
        if (doSelect === true){
            $('#btnThe').attr('src', 'images/btn_the_2.png');
        } else {
            $('#btnThe').attr('src', 'images/btn_the_0.png');
        }
    }
    
    if (drink === 'café'){
        if (doSelect === true) {
            $('#btnCafe').attr("src","images/btn_espresso_2.png");
        } else {
            $('#btnCafe').attr("src","images/btn_espresso_0.png");
        }
    }
    
    if (drink === 'chocolat'){
        if (doSelect === true) {
            $("#btnChocolat").attr("src", "images/btn_chocolat_2.png");
        } else {
            $("#btnChocolat").attr("src", "images/btn_chocolat_0.png");
        }
    }
    
    if (drink === 'cappuccino'){
        if (doSelect === true) {
            $("#btnCappuccino").attr("src", "images/btn_cappuccino_2.png");
        } else {
            $("#btnCappuccino").attr("src", "images/btn_cappuccino_0.png");
        }
    }

    if (doSelect === true){
        SELECTED = drink;
    } else {
        SELECTED = "";
    }

    

}

function addSugar(){
    let tableauSrcSucres = ["images/Sucre_Etat_0.png",
    "images/Sucre_Etat_1.png",
    "images/Sucre_Etat_2.png",
    "images/Sucre_Etat_3.png",
    "images/Sucre_Etat_4.png",
    "images/Sucre_Etat_5.png"];
    
    if (NBSUCRES < 5) {
        NBSUCRES = NBSUCRES + 1;
    }
    
    $('#sucres').attr('src',tableauSrcSucres[NBSUCRES]);
    
}

function removeSugar(){
    let tableauSrcSucres = ["images/Sucre_Etat_0.png",
    "images/Sucre_Etat_1.png",
    "images/Sucre_Etat_2.png",
    "images/Sucre_Etat_3.png",
    "images/Sucre_Etat_4.png",
    "images/Sucre_Etat_5.png"];
    
    if (NBSUCRES > 0) {
        NBSUCRES = NBSUCRES - 1;
    }
    
    $('#sucres').attr('src',tableauSrcSucres[NBSUCRES]);
    
}

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

// function resetCoins(){

//     COMPTEUR = 0;
//     let coins = ['5cts','10cts','20cts','50cts','1euro','2euros'];

//     if ( COMPTEUR === 0){
//         $("#monnayeur").html("Crédit : " + COMPTEUR + " €");
//     }
//     console.log(COMPTEUR);

//     for (let i = 0; i < coins.length; i++){
//         PIECES[coins[i]] = 0;
//     }
// }


// function buy(nb5ct, nb10ct, nb20ct, nb50ct, nb1e,nb2e, price){
//     let total = nb5ct*5 + nb10ct*10 + nb20ct*20 + nb50ct*50 + nb1e*100 + nb2e*200;
//     total= total/100;
//     if(total>=price){
//         return true; 
//     } else {
//         return false;
//     }
// }


// function displayDrink(){
//     $('#gobeletFond').addClass('gobeletBack');
//     $('#gobeletFace').addClass('gobeletFront');
// }

// function displayTouillette(){
//     $('#touillette').addClass('touillette');
// }

// function displayBoisson(boissonChoisie){
//     $('#boisson').removeClass().addClass('gobeletElement');
//     let className = "";
//     if (boissonChoisie === "café"){
//         className = "boissonCafe";
//     } else if (boissonChoisie === "cappuccino"){
//         className = 'boissonCappuccino';
//     } else if (boissonChoisie === "chocolat"){
//         className = "boissonChocolat";
//     } else if (boissonChoisie === 'thé'){
//         className = 'boissonThe';
//     }
//     $('#boisson').addClass(className);
// }

// function displaySucre(){
//     $('#sucre').addClass('boissonSucre');
// }

// function removeSucre(){
//     $('#sucre').removeClass('boissonSucre');
// }
// /* Script*/
// function removeTouillette(){
//     $('#touillette').removeClass('touillette');
// }
// function removeDrink(){
//     $('#gobeletFond').removeClass('gobeletBack');
//     $('#gobeletFace').removeClass('gobeletFront');
//     $('#touillette').removeClass('touillette');
//     $('#sucre').removeClass('boissonSucre');
//     $('#boisson').removeClass().addClass('gobeletElement');
// }       

/* Script*/
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
    
    // $("#btnCappuccino").click(function(){
    //     let select = true;
    //     if ($("#btnCappuccino").attr('src') === 'images/btn_cappuccino_2.png'){
    //         select = false;
    //     }
        
    //     selectDrink(select,"cappuccino");
    // });
    
    // $('#btnCafe').click(function(){
    //     let select = true;
    //     if ($('#btnCafe').attr('src') === 'images/btn_espresso_2.png'){
    //         select = false;
    //     }
        
    //     selectDrink(select,'café');
    // });
    
    // $('#btnChocolat').click(function(){
    //     let select = true;
    //     if ($('#btnChocolat').attr('src') === 'images/btn_chocolat_2.png'){
    //         select = false;
    //     }
        
    //     selectDrink(select,'chocolat');
    // });
    
    // $('#btnThe').click(function(){
    //     let select = true;
    //     if ($('#btnThe').attr('src') === 'images/btn_the_2.png'){
    //         select = false;
    //     }
        
    //     selectDrink(select,'thé');
    // });
    
    // $('#fente').click(function(){
    //     if ($('#pieces').css("display") === "none"){
            
    //         $('#pieces').show();
    //     } else {
            
    //         $('#pieces').hide();
    //     }
    // });
    
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
    
    // $('#btnPay').click(function(){
    //     let drinkPrice = 0.5;
        
    //     let canBuy = buy(PIECES['5cts'],PIECES['10cts'],PIECES['20cts'],PIECES['50cts'],PIECES['1euro'],PIECES['2euros'],drinkPrice);
        
    //     if (canBuy && SELECTED !== "") {
    //         displayDrink();
    //         if (NBSUCRES > 0){
    //             displaySucre();
    //             displayTouillette();
    //         } else {
    //             removeSucre();
    //             removeTouillette();
    //         }
            
    //         displayBoisson(SELECTED);
    //     } else {
    //         affiche('crédit insuffisant ou pas select : crédit actuel ' + COMPTEUR + '€');
    //     }
        
    // });
    
    // $('#btnCancel').click(function(){
    //     resetCoins();
    //     affiche("crédit : " + COMPTEUR + "€");
    //     removeDrink();
        
    // });
    
});
