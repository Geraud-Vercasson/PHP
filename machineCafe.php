
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

</body>
