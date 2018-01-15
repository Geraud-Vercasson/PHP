<?php

require_once("databaseFunctions.php");

function renduMonnaie($monnaieARendre){

    $moneyTable = getMoneyTable();
    var_dump($moneyTable);

    $aRendre = $monnaieARendre;
    $tabRendu = [];
    $mauvaisePiece = 0;
    $compteurDeFail = 0;
    $tableauFails = [];
    
    
    
    while ($aRendre > 0 && $compteurDeFail < 10) {
        
        $hasBroke = false;
        
        foreach($moneyTable as $valeurFaciale => $stock){
            echo $valeurFaciale." : ".$stock;
            echo "<br \>";

            if($stock > 0 && $aRendre >= $valeurFaciale && $valeurFaciale != $mauvaisePiece){
                array_push($tabRendu, $valeurFaciale);
                $moneyTable[$valeurFaciale]--;
                $aRendre -= $valeurFaciale;
                $hasBroke = true;
                break;
            }
        }

        if($hasBroke){
            continue;
        }

        array_push($tableauFails, $tabRendu);
        $mauvaisePiece = array_pop($tabRendu);
        $moneyTable[$mauvaisePiece] += 1;
        $aRendre += $mauvaisePiece;
        $compteurDeFail++;
    }

    foreach($moneyTable as $valeurFaciale => $stock){
        setMoneyStock($valeurFaciale,$stock);
    }

    return $tabRendu;
    
}

?>