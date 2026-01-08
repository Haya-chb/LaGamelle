<?php

include("../controleurs/c-inscription.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/inscription.css">
  <link rel="stylesheet" href="../assets/css/form.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  
  <title>Inscription</title>
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


<?php
echo '

<main>

<div class="progress-container">
  <div class="step-progression" id="stepProgression"></div>
  <div class="step-number">1</div>
  <div class="step-number">2</div>
  <div class="step-number">3</div>
  <div class="step-number">4</div>
  <div class="step-number">5</div>
</div>

<form action="v-inscription.php" method="POST">

<section id="etape1">

<div>
<label for="pseudo"> Pseudo :</label>
<br><input type="text" name="pseudo" id="pseudo" required>
</div>

<div>
<label for="pswd">Mot de passe :</label>
<br><input type="password" name="pswd" id="pswd" required>
</div>

</section>



<section id="etape2">

<div>
<label for="prenom"> Prénom :</label>
<br><input type="text" name="prenom" id="prenom" required>
</div>

<div>
<label for="nom">Nom :</label>
<br><input type="text" name="nom" id="nom" required>
</div>

<div>
<label for="mail">Email :</label>
<br><input type="email" name="mail" id="mail" required>
</div>

<div>
<label for="telephone">Numéro de téléphone :</label>
<br><input type="tel" name="telephone" id="telephone" required>
</div>

</section>



<section id="etape3">

<fieldset>

 <legend>Espèce de votre boule de poil :</legend>

 <div>
    <input type="radio" id="chat" name="espece" value="chat" />
    <label for="chat">Chat</label>
  </div>

  <div>
    <input type="radio" id="chien" name="espece" value="chien" />
    <label for="chien">Chien</label>
  </div>

</fieldset>

</section>



<section id="etape4">

<fieldset>

<legend>Votre boule de poile</legend>

<span class="etape4-1">
<div>
<label for="race">Sa race :</label>
<br><input type="text" name="race" id="race" required>
</div>

<div>
<label for="nom_animal"> Son nom :</label>
<br><input type="text" name="nom_animal" id="nom_animal" required>
</div>

<div>
<label for="age"> Son âge:</label>
<br><input type="number" name="age" id="age" required>
</div>
</span>

<span class="etape4-2">

<div>
<label for="anniv"> Son anniversaire:</label>
<br><input type="date" name="anniv" id="anniv" required>
</div>

<div>
<label for="poids"> Son poids:</label>
<br><input type="number" name="poids" id="poids" required>
</div>

<div>
<label for="sexe"> Son sexe:</label>
<br><input type="text" name="sexe" id="sexe" required>
</div>

</span>

</fieldset>

</section>

<div>
<input type="button" name="action" id="prevBtn" value="Précédent" class="button">

<input type="button" name="action" id="nextBtn" value="Continuer" class="button">
<input type="submit" name="action" value="Valider" class="button">
</div>


</form>

<main>';
?>

<script src="../assets/js/inscription.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/gsap.min.js"></script>
</body>
</html>