<?php

session_start();

$GLOBALS['recettes'] = array('café' => array('eau' => 2, 'café' => 2),
                            'cappuccino' => array('eau' => 2, 'café' => 2, 'lait' => 1),
                            'chocolat' => array('lait' => 3, 'cacao' => 2), 
                            'thé' => array('eau' => 3, 'thé' => 1));

if (empty($_SESSION['stock'])) {
    initStock(10,10,10,10,10,30);
}

                        
function prepare($recetteArray, $sucres){

    $recette = "";
    $tableauTempIngredients = [];

    foreach ($recetteArray as $recetteKey => $recetteValue) {

        if (isset($_SESSION['stock'][$recetteKey]) && $_SESSION['stock'][$recetteKey] >= $recetteValue){

            $recette = $recette.$recetteValue.' * '.$recetteKey.', ';
            $tableauTempIngredients[$recetteKey] = $recetteValue;              //Stock dans un tableau temporaire le singrédients à retirer du stock si la boisson peut être créée
            
        } else {
            return "{$recetteKey} : stock insuffisant";
        }
    } 

    
    if ($sucres != 0){
        
        if ($_SESSION['stock']['sucre'] >= $sucres ) {
            $recette = $recette." {$sucres} * sucre";
            if ($sucres > 1) {
                $recette = $recette."s";
            }
            $_SESSION['stock']['sucre'] -= $sucres;
        } else {
            return "sucre : stock insuffisant";
        }
    }
    
    foreach ($tableauTempIngredients as $key => $value) {   //Tous les ingrédients sont disponibles, on retire la quantité dans le tableau temporaire au stock
        $_SESSION['stock'][$key] -= $value;
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

    $boisson = strtolower($boisson);

    switch ($boisson){
        case 'café' :
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
}

function initStock($eau, $cafe, $lait, $cacao, $the, $sucre){

    $ingredients = array('eau' => $eau, 'café' => $cafe, 'lait' => $lait, 'cacao' => $cacao, 'thé' => $the, 'sucre' => $sucre);

    $_SESSION['stock'] = $ingredients;
}

?>