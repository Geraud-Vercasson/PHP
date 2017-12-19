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

    foreach ($recetteArray as $recetteKey => $recetteValue) {

        if (isset($_SESSION['stock'][$recetteKey]) && $_SESSION['stock'][$recetteKey] >= $recetteValue){

            $recette = $recette.$recetteValue.' * '.$recetteKey.', ';
            $_SESSION['stock'][$recetteKey] -= $recetteValue;
            
        } else {
            return "{$recetteKey} : stock insuffisant";
        }
    } 
    var_dump($_SESSION['stock']);
    
    if ($sucres != 0){
    
        $recette = $recette.", {$sucres} * sucres";
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