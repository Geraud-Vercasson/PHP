<?php

    session_start();
    include_once('databaseFunctions.php');
    
    if (isset($_POST['ingredient'])){
        $ingredient = $_POST['ingredient'];
        $quantite = $_POST['quantite'];
        
        addToStock($quantite,$ingredient);
    }

?>


<!DOCTYPE html>

<html>

    <body>

    <?php

            $tableau = "<table><thead><th>Ingrédient</th><th>Stock</th></thead><tbody>";
            $ingredientList = getIngredientList();

            foreach ($ingredientList as $value){
               $tableau = $tableau."<tr><td>".$value."</td><td>".getStock($value)."</td></tr>";
            }

            $tableau = $tableau."</tbody></table>";

            echo $tableau;

    ?>
        <form action="ajoutIngredient.php" method="POST">
            <label for="ingredient"> Ingrédient</label>
            <select name="ingredient" id="ingredient">
                <option value="eau">Eau</option>
                <option value="caféPoudre">Café</option>
                <option value="lait">Lait</option>
                <option value="chocolatPoudre">Cacao</option>
                <option value="théPoudre">Thé</option>
                <option value="sucre">Sucre</option>
            </select>
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="0">
            <input type="submit" value="Enregistrer">
            
        </form>
        
        <a href="MachineCafe.php"> Retour en face avant</a>
    </body>

</html>