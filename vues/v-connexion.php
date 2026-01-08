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
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="index..php">Trouver un vétérinaire</a></li>
                <li><a href="v-contribution.php">Proposer une recette</a></li>
            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte">
                        <a href="profil.php?favoris"><img src="../assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="vues/profil.php"><img src="../assets/images/compte.svg" alt="Accéder à mon profil"></a>
                     </div>';
            } else {
                echo '<div class="connexion">
                        <a href="v-inscription.php">Inscription</a>
                        <a href="v-connexion.php">Connexion</a>
                    </div>';
            }
            ?>
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

