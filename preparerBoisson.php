<html>
    <body>
        
    </body>

</html>


<?php
echo "<p>Vous avez commandé : {$_POST['boisson']} </p>";    
include('fonctions.php');
echo "<p>".preparerBoisson($_POST['boisson'], $_POST['sucres'])."</p>";
?>