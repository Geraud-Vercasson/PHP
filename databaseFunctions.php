<?php

$identification = json_decode(file_get_contents('config.json'));

try
{
    $DATABASE = new PDO('mysql:host=localhost;dbname=machinecafe;charset=utf8',$identification->username, $identification->password);

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


function getRecipe($drink){
    global $DATABASE;
    $preparedQuery = $DATABASE->prepare("SELECT ingredients.name 
                                        AS 'ingrédient', recette.quantite AS 'quantité'
                                        FROM ingredients
                                        JOIN recette
                                        ON ingredients.id = recette.ingredients_id
                                        JOIN boissons
                                        ON boissons.id = recette.boissons_id
                                        WHERE boissons.name = :drink");
    $recipe = [];

    $preparedQuery->execute(array(':drink' => $drink));
    while($donnees = $preparedQuery->fetch()){
       $recipe[$donnees['ingrédient']] = $donnees['quantité'];
    
    }
    
    $preparedQuery->closeCursor();
    return $recipe;
    
}

function getDrinkList(){
    global $DATABASE;
    $drinkList = [];
    $reponse = $DATABASE->query("SELECT boissons.name AS 'Boisson' FROM boissons");
     while($donnees = $reponse ->fetch()){
        $drinkList[count($drinkList)] = $donnees['Boisson'];
     }
     $reponse->closeCursor();
     return $drinkList;
}


function getIngredientList(){
    global $DATABASE;
    $reponse = $DATABASE->query("SELECT ingredients.name FROM ingredients");
    $ingredientList = $reponse->fetchAll(PDO::FETCH_COLUMN); // fetchAll avec en option FETCH_COLUMN pour avoir un array des ingrédients
    $reponse->closeCursor();
    return $ingredientList;
}

function getStock($ingredientName){
    global $DATABASE;
    $query = "SELECT ingredients.stock
                FROM ingredients
                WHERE ingredients.name = :ingredient";

    $reponse = $DATABASE->prepare($query);
    $reponse->execute(array(":ingredient" => $ingredientName));
    $stockIngredient = intval($reponse->fetch()['stock']);
    $reponse->closeCursor();
    return $stockIngredient;
}

function removeFromStock($quantity, $ingredientName){
    global $DATABASE;
    $query = "UPDATE ingredients
                SET ingredients.stock = ingredients.stock - :quantite
                WHERE ingredients.name = :ingredient";
    $preparedQuery = $DATABASE->prepare($query);
    $preparedQuery->execute(array(":quantite" => $quantity, ":ingredient" => $ingredientName));

    $preparedQuery->closeCursor();


}

function addToStock($quantity,$ingredientName){
    global $DATABASE;
    $query = "UPDATE ingredients
                SET ingredients.stock = ingredients.stock + :quantite
                WHERE ingredients.name = :ingredient";
    $preparedQuery = $DATABASE->prepare($query);
    $preparedQuery->execute(array(':quantite' => $quantity, ':ingredient' => $ingredientName));
    $preparedQuery->closeCursor();
}

function removeDrinkFromStock($drink){
    global $DATABASE;
    $recipe = getRecipe($drink);
    foreach ($recipe as $ingredientName => $quantity){
        removeFromStock($quantity, $ingredientName);
    }


}

function getDrinkPrice($drinkName){
    global $DATABASE;
    $query = "SELECT boissons.prix
            FROM boissons
            WHERE boissons.name = :drink";
    $reponse = $DATABASE->prepare($query);
    $reponse->execute(array(":drink" => $drinkName));
    $drinkPrice = intval($reponse->fetch()['prix']);
    $reponse->closeCursor();
    return $drinkPrice;
}

function getAvailableDrinks(){
    global $DATABASE;
    $query = "SELECT boissons.name
                FROM recette
                JOIN ingredients
                ON ingredients.id = recette.ingredients_id
                JOIN boissons
                ON boissons.id = recette.boissons_id
                GROUP BY boissons.id
                HAVING MIN(recette.quantite <= ingredients.stock) != 0";

    $reponse = $DATABASE->query($query);
    $availableDrinks = $reponse->fetchall(PDO::FETCH_COLUMN);
    return $availableDrinks;
}

    ?>