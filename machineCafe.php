
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        
        <?php

    include('fonctions.php');

        $date = date("D j M H:i:s");
        $cafe = "Café";
        $cappuccino = "Cappuccino";
        $chocolat = "Chocolat";
        $the = "Thé";
        $statut = "En attente";
        
        if (isset($_POST['monnaie'])){
            $monnaieIntroduite = $_POST['monnaie'];

        } else {
            $monnaieIntroduite = 0;
        }

        if (isset($_POST['boisson'])){
            $output = preparerBoisson($_POST['boisson'],$_POST['sucres']);
        }

        echo("Liste des boissons disponibles <ul><li>{$cafe}</li><li>{$cappuccino}</li><li>{$chocolat}</li><li>{$the}</li></ul>");
        echo("<p id='monnaieIntroduite'> Crédit : ".$monnaieIntroduite." € </p>");

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
            <p><label for="boisson"> Boisson : </label>
            <input type="radio" name="boisson" value="café">Café <br>
            <input type="radio" name="boisson" value="cappuccino">Cappuccino <br>
            <input type="radio" name="boisson" value="chocolat">Chocolat <br>
            <input type="radio" name="boisson" value="thé">Thé <br>
            <label for="sucres">Nombre de sucres : </label>
            <br>
            <input type="number" name="sucres" value = 0 >
            <input id="monnaie" type="hidden" name="monnaie" value="<?php echo $monnaieIntroduite; ?>">
            <input type="submit" value="Commander !"></input>
        </form>
    </body>
</html>
