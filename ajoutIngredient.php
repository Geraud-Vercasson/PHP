<?php

    session_start();
    require_once('databaseFunctions.php');
    
    if (isset($_POST['ingredient'])){
        $ingredient = $_POST['ingredient'];
        $quantite = $_POST['quantite'];
        
        addToStock($quantite,$ingredient);
    }

    $ingredientList = getIngredientList();

?>
<!DOCTYPE html>

<html>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Ingrédient</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredientList as $ingredient): ?>
                <tr>
                    <td><?php echo $ingredient; ?></td>
                    <td><?php echo getStock($ingredient); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

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