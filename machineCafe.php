
<html>

<body>
    
<?php
$date = date("D j M H:i:s");
$cafe = "Café";
$cappuccino = "Cappuccino";
$chocolat = "Chocolat";
$the = "Thé";
$statut = "En attente";
$monnaieIntroduite = 0;

echo("Liste des boissons disponibles <ul><li>{$cafe}</li><li>{$cappuccino}</li><li>{$chocolat}</li><li>{$the}</li></ul>");
echo("<p> Crédit : ".$monnaieIntroduite." € </p>");

echo ("<p> {$statut} </p>");

print("<p> Date du serveur : ".$date."</p>");

?>

<form action="preparerBoisson.php" method="POST">
    <p><label for="boisson"> Boisson : </label>
    <input type="radio" name="boisson" value="Café">Café <br>
    <input type="radio" name="boisson" value="Cappuccino">Cappuccino <br>
    <input type="radio" name="boisson" value="Chocolat">Chocolat <br>
    <input type="radio" name="boisson" value="Thé">Thé <br>
    <label for="sucres">Nombre de sucres : </label>
    <br>
    <input type="number" name="sucres" value = 0 >
    <input type="submit" value="Commander !"></input>
</form>
</body>
