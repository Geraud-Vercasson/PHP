<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once('databaseFunctions.php');

foreach(getDrinkList() as $drink) {

    $GLOBALS['recettes'][$drink] = getRecipe($drink);
    $GLOBALS['prix'][$drink] = getDrinkPrice($drink);
}


// if (empty($_SESSION['stock'])) {
//     initStock(10,10,10,10,10,30);
// }

                        
function prepare($recetteArray, $sucres){

    $recette = "";
    $tableauTempIngredients = [];


    foreach ($recetteArray as $recetteIngredient => $recetteValue) {

        if (getStock( $recetteIngredient) >= $recetteValue){

            $recette = $recette.$recetteValue.' * '.$recetteIngredient.', ';
            $tableauTempIngredients[$recetteIngredient] = $recetteValue;              //Stock dans un tableau temporaire le singrédients à retirer du stock si la boisson peut être créée
            
        } else {
            return "{$recetteIngredient} : stock insuffisant";
        }
    } 

    
    if ($sucres != 0){
        
        if (getStock('sucre') >= $sucres ) {
            $recette = $recette." {$sucres} * sucre";
            if ($sucres > 1) {
                $recette = $recette."s";
            }
            removeFromStock($sucres,'sucre');
        } else {
            return "sucre : stock insuffisant";
        }
    }
    foreach ($tableauTempIngredients as $ingredient => $quantity){   //Tous les ingrédients sont disponibles, on retire la quantité dans le tableau temporaire au stock
        removeFromStock($quantity,$ingredient);
    }


    $recette = rtrim($recette, ", ");

    return $recette;

}

function prepareCafe($nbSucres){


    return prepare($GLOBALS['recettes']['café'],$nbSucres);

}

function prepareCappuccino($nbSucres){

    return prepare($GLOBALS['recettes']['cappuccino'],$nbSucres);
    
}

function prepareChocolat($nbSucres){
    
    return prepare($GLOBALS['recettes']['chocolat'], $nbSucres);

}

function prepareThe($nbSucres){
    
    return prepare($GLOBALS['recettes']['thé'], $nbSucres);

}

function preparerBoisson($boisson, $nbSucres){

    if (canPay($boisson)){
        
        switch ($boisson){
            case 'café' :
            echo "boisson : ".$boisson;
                return prepareCafe($nbSucres);
            case 'thé' :
                return prepareThe($nbSucres);
            case 'cappuccino' :
                return prepareCappuccino($nbSucres);
            case 'chocolat' :
                return prepareChocolat($nbSucres);
            default:
                return "Entrée incorrecte";
    
        }
    } else return "Provisions insuffisantes";

}


function canPay($boisson){
    if ($_SESSION['monnaie'] >= $GLOBALS['prix'][$boisson]) {
        $_SESSION['monnaie'] -= $GLOBALS['prix'][$boisson];
        return true;
    }
    return false;
}



?>