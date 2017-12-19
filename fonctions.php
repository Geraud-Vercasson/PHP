<?php

$GLOBALS['recettes'] = array('café' => array('eau' => 2, 'café' => 2), 'cappuccino' => array('eau' => 2, 'café' => 2, 'lait' => 1),
                    'chocolat' => array('lait' => 3, 'cacao' => 2), 'thé' => array('eau' => 3, 'thé' => 1));

function prepare($recetteArray){

    $recette = "";

    foreach ($recetteArray as $recetteKey => $recetteValue) {
        $recette = $recette.$recetteValue.' * '.$recetteKey.', ';
    }

    $recette = rtrim($recette, ", ");

    return $recette;

}

function prepareCafe($nbSucres){

    $recette = prepare($GLOBALS['recettes']['café']);

    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }

    return $recette;
}

function prepareCappuccino($nbSucres){

    $recette = prepare($GLOBALS['recettes']['cappuccino']);
    
    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }
    
    return $recette;
}

function prepareChocolat($nbSucres){
    
    $recette = prepare($GLOBALS['recettes']['chocolat']);
    
    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }
    
    return $recette;
}

function prepareThe($nbSucres){
    
    $recette = prepare($GLOBALS['recettes']['thé']);

    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }
    
    return $recette;
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

?>