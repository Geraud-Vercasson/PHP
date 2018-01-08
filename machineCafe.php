<?php

session_start();

?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="script.js"></script>
        <meta charset="utf-8">
    </head>
    <body>
        
        <?php

        include('fonctions.php');
        include_once('databaseFunctions.php');

        $boissonsDisponibles = getAvailableDrinks();

        $date = date("D j M H:i:s");
        $cafe = "Café";
        $cappuccino = "Cappuccino";
        $chocolat = "Chocolat";
        $the = "Thé";
        $statut = "En attente";
        
        if (isset($_POST['monnaie'])){
            $_SESSION['monnaie'] = $_POST['monnaie'];

        } else {
            $_SESSION['monnaie'] = 0;
        }

        if (isset($_POST['boisson'])){

            $output = preparerBoisson($_POST['boisson'],$_POST['sucres']);
        }

        if(count($boissonsDisponibles) != 0){
            echo("Liste des boissons disponibles <ul>");

            foreach($boissonsDisponibles as $boisson){
    
                echo "<li>".ucfirst($boisson)."</li>";
            }
            echo ("</ul>");
        } else {
            echo "Aucune boisson disponible";
        }
        echo("<p id='monnaieIntroduite'> Crédit : ". $_SESSION['monnaie']." € </p>");

        echo ("<p> {$statut} </p>");
        if (isset($output)){
            echo ("<p> {$output} </p>");
        }

        print("<p> Date du serveur : ".$date."</p>");

        

        ?>

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
        <?php

        foreach(getDrinkList() as $drink){
            $boutonHTML = "<input type='radio' name='boisson' value='$drink'";
            
            if (!in_array($drink,$boissonsDisponibles)){
                $boutonHTML = $boutonHTML." disabled";
            }
            
            $boutonHTML = $boutonHTML.">".ucfirst($drink)." <br>";
            echo $boutonHTML;
        }

        $maxSucres = min(5, getStock('sucre'));
        ?>
            
            <label for="sucres">Nombre de sucres : </label>
            <br>
            <input type="number" name="sucres" value = 0 min = 0 max = <?php echo $maxSucres?>>
            <input id="monnaie" type="hidden" name="monnaie" value="<?php echo $_SESSION['monnaie']; ?>">
            <input type="submit" value="Commander !"></input>
        </form>

        <a href="ajoutIngredient.php">Maintenance</a>
    </body>
</html>
