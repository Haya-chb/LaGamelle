<?php

include ("../controleurs/c-connexion.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/form.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Connexion</title>
</head>
<body>
    
<header>
        <a href="#" class="logo">LG</a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer une recette</a></li>
            </ul>
          <div class="connexion">
                        <a href="vues/v-inscription.php">Inscription</a>
                        <a href="vues/v-connexion.php">Connexion</a>
                    </div>
            

        </nav>
    </header>


<main>
<?php
 echo '<form action="v-connexion.php" method="POST">


<div><label for="login">Login :</label><br>
<input type="text" id="login" name="pseudo" required></div>

<div><label for="pswd">Mot de passe :</label><br>
<input type="password" id="pswd" name="pswd" required></div>


<input type="submit" name="Connexion" value="Se connecter" class="button">


</form>';
?>

</main>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/gsap.min.js"></script>
</body>
</html>

