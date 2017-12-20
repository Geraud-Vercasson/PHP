<?php

    session_start();

    
    if (isset($_SESSION['stock'])){
        
        if (isset($_POST['ingredient'])){
            $cle = $_POST['ingredient'];
            $quantite = $_POST['quantite'];
            
            $_SESSION['stock'][$cle] += $quantite;
        }
    }

?>


<!DOCTYPE html>

<html>

    <body>

    <?php

        if (isset($_SESSION['stock'])){
            $tableau = "<table><thead><th>Ingrédient</th><th>Stock</th></thead><tbody>";

            foreach ($_SESSION['stock'] as $key => $value){
               $tableau = $tableau."<tr><td>".$key."</td><td>".$value."</td></tr>";
            }

            $tableau = $tableau."</tbody></table>";

            echo $tableau;


        } else {
            echo 'Passez d\'abord devant la machine!';
        }
    ?>
        <form action="ajoutIngredient.php" method="POST">
            <label for="ingredient"> Ingrédient</label>
            <select name="ingredient" id="ingredient">
                <option value="eau">Eau</option>
                <option value="café">Café</option>
                <option value="lait">Lait</option>
                <option value="cacao">Cacao</option>
                <option value="thé">Thé</option>
                <option value="sucre">Sucre</option>
            </select>
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="0">
            <input type="submit" value="Enregistrer">
            
        </form>
        
        <a href="MachineCafe.php"> Retour en face avant</a>
    </body>

</html>