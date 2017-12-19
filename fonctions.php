<?php

function prepareCafe($nbSucres){

    $recette = "2 * eau, 2 * café";

    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }

    return $recette;
}

function prepareCappuccino($nbSucres){

    $recette = "2 * eau, 2 * café, 1 * lait";
    
    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }
    
    return $recette;
}

function prepareChocolat($nbSucres){
    
    $recette = "3 * lait, 2 * cacao";
    
    if ($nbSucres != 0){

        $recette = $recette.", {$nbSucres} * sucres";
    }
    
    return $recette;
}

function prepareThe($nbSucres){
    
    $recette = "3 * eau, 1 * thé";

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