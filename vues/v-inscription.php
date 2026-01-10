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
  
  <title>Inscription | La Gamelle</title>
</head>
<body>
  
    <header>
        <a href="../index.php" class="logo"><img src="../assets/images/logo.webp" alt="Retour à l'accueil"></a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="index.php">Trouver un vétérinaire</a></li>
            </ul>
            <div class="connexion">
            <a href="v-connexion.php">Connexion</a>
            </div>
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


<div class="container-animaux">
  
  <input type="radio" id="chat" name="espece" class="radio-cachee" value="chat">
  <label for="chat" class="label-animal">
    <img src="../assets/images/tete_chat.webp" alt="Un chat">
    <p>C\'est un chat</p>
  </label>

  <input type="radio" id="chien" name="espece" class="radio-cachee" value="chien">
  <label for="chien" class="label-animal">
    <img src="../assets/images/tete_chien.webp" alt="Un chien">
    <p> C\'est un chien </p>
  </label>

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
<br>
<select name="sexe" id="sexe" required>
  <option value="">Séléctionner dans un sexe</option>
  <option value="Femelle">Femelle</option>
  <option value="Mâle">Mâle</option>
</select>
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

</main>';
?>

    <footer class="main-footer">
        <div class="footer-wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>
        <div class="footer-container">
            <div class="footer-links">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="../vues/recette.php">Nos Recettes</a></li>
                    <li><a href="../vues/alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="..:vues/index.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="../vues/mentions-legales.php">Mentions légales</a></li>
                    <li><a href="../vues/mentions-legales.php#confidentialite">Confidentialité</a></li>
                    <li><a href="../vues/mentions-legales.php#credits">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>
<script src="../assets/js/gsap.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/inscription.js"></script>

</body>
</html>