<?php

session_start();

require('fonctions.php');
require_once('databaseFunctions.php');

$boissonsDisponibles = getAvailableDrinks();
$prixDesBoissons = [];
$listeBoisson = getDrinkList();
foreach($listeBoisson as $boisson){
    
    $prixDesBoissons[$boisson] =  getDrinkPrice($boisson);
}

$date = date("D j M H:i:s");
$cafe = "Café";
$cappuccino = "Cappuccino";
$chocolat = "Chocolat";
$the = "Thé";
$statut = "En attente";
$maxSucres = min(5, getStock('sucre'));

if (isset($_POST['monnaie'])){
    $_SESSION['monnaie'] = $_POST['monnaie'];

} else {
    $_SESSION['monnaie'] = 0;
}

if (isset($_POST['boisson'])){

    $output = preparerBoisson($_POST['boisson'],$_POST['sucres']);
}
?>

<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="script.js"></script>
        <meta charset="utf-8">
    </head>
    <body>
        
        <?php if(count($boissonsDisponibles) != 0): ?>
            Liste des boissons disponibles
            <ul>

            <?php foreach($boissonsDisponibles as $boisson): ?>
    
                <li><?php echo ucfirst($boisson) ?></li>

            <?php endforeach; ?>

            </ul>
            <?php else: ?>
            Aucune boisson disponible

        <?php endif; ?>

        <p id='monnaieIntroduite'> Crédit : <?php echo ($_SESSION['monnaie']/100) ?> € </p>

        <p> <?php echo $statut ?> </p>

        <?php if (isset($output)): ?>

            <p> <?php echo $output ?> </p>

        <?php endif; ?>

        <p> Date du serveur : <?php echo $date ?> </p>

        <div id="pieces">
            <img id="btn5cts" src="images/5_cents.png">
            <img id="btn10cts" src="images/10_cents.png">
            <img id="btn20cts" src="images/20_cents.png">
            <img id="btn50cts" src="images/50_cents.png">
            <img id="btn1euro" src="images/1_euros.png">
            <img id="btn2euro" src="images/2_euros.png">
        </div>

        <form action="machineCafe.php" method="POST">
            <p><label for="boisson"> Boisson : </label><br>

            <?php foreach(getDrinkList() as $drink): ?>

            <input type='radio' name='boisson' value='<?php echo $drink; ?>'

            <?php
            
            if (!in_array($drink,$boissonsDisponibles)){
                echo " disabled";
            }
            
            ?> > <?php echo ucfirst($drink) ?>
            </input>
            <br>
            
        <?php endforeach; ?>
            
            <label for="sucres">Nombre de sucres : </label>
            <br>
            <input type="number" name="sucres" value = 0 min = 0 max = <?php echo $maxSucres?>>
            <input id="monnaie" type="hidden" name="monnaie" value="<?php echo $_SESSION['monnaie']; ?>">
            <input type="submit" value="Commander !"></input>
        </form>

        <a href="ajoutIngredient.php">Maintenance</a>
    </body>
</html>
