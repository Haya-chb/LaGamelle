<?php

include ("../controleurs/c-connexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    
 <header>
        <nav>
            <ul class="navbar">
                <li><a href="#">LG</a></li>
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer une recette</a></li>
            </ul>
        </nav>
    </header>
<?php
 echo '<form action="v-connexion.php" method="POST">




<div><label for="login">Login :</label><br>
<input type="text" id="login" name="pseudo" required></div>

<div><label for="pswd">Mot de passe :</label><br>
<input type="password" id="pswd" name="pswd" required></div>


<input type="submit" name="Connexion" value="Se connecter" class="button">


</form>';
?>

</body>
</html>

