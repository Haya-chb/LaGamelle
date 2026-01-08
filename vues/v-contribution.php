<?php
session_start();
include("../controleurs/c-contribution.php");

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contribution.css">
     <link rel="stylesheet" href="../assets/css/form.css">

    <title>Proposition de recette</title>
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
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte">
                        <a href="vues/profil.php?favoris"><img src="assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="vues/profil.php"><img src="assets/images/compte.svg" alt="Accéder à mon profil"></a>
                     </div>';
            } else {
                echo '<div class="connexion">
                        <a href="vues/v-inscription.php">Inscription</a>
                        <a href="vues/v-connexion.php">Connexion</a>
                    </div>';
            }

            ?>
        </nav>
    </header>

<span>


<aside>
   
<h1>Proposez-nous une recette !</h1>
<p>Vous avez une recette maison que votre compagnon adore ? <br>
Partagez-la avec nous ! 
<br><br>
Qu'il s'agisse de biscuits pour chiens, de friandises pour chats ou de repas faits main, nous adorons découvrir vos idées gourmandes.</p>

</aside>



<main>


<div class="progress-container">
  <div class="step-progression" id="stepProgression"></div>
  <div class="step-number">1</div>
  <div class="step-number">2</div>
  <div class="step-number">3</div>
</div>

<form action="v-contribution.php" method="POST" >


<fieldset id="etape1">
<div><label for="nom">Nom de la recette :</label>
<br>
<input type="text" id="nom" name="nom" require > </div>

<div>
   <label for="categorie">Catégorie :</label>
   <select name="categorie" id="categorie">
    <option value="snack">Choisir une difficulté</option>
    <br>
    <option value="snack">Snack</option>
    <option value="plat">Plat</option>
    <option value="dessert">Dessert</option>
   </select>
</div>

<div>
   <label for="animal">Cette recette est destiné à :</label>
   <br>
   <select name="animal" id="animal">
    <option value="">Choisir un animal</option>
    <option value="chat">Chat</option>
    <option value="chien">Chien</option>
   </select>
</div>

<div>
   <label for="niveau">Niveau de difficulté :</label>
   <select name="niveau" id="niveau">
    <option value="">Choisire une difficulté</option>
    <option value="1">Facile</option>
    <option value="2">Moyen</option>
    <option value="3">Difficile</option>
   </select>
</div>

<div>
    <label for="temps">Temps de préparation (en minutes) :</label><br>
    <input type="number" id="temps" name="temps" placeholder="Ex: 15" required>
</div>

</fieldset>


<fieldset aria-describedby="ingredientTexte" id="etape2">
<legend>Ingrédients :</legend>

<button type="button" id="afficherIngredient">Sélectionner des ingrédients</button>
<button type="button" id="masquerIngredient"> Masquer les ingrédients </button>

<section id='ingredient'>

<p id="ingredientTexte">Sélectionnez un ou plusieurs ingrédients</p>

<?php


foreach ($afficher as $row){
echo'<div>
    <input type="checkbox" id="'.$row["nom_ingredient"].'" name="'.$row["id_ingredient"].'"> 
    <label for="'.$row["nom_ingredient"].'">'.$row["nom_ingredient"].'</label>
</div>'; 
};

?>

</section>

<p>Votre ingrédient ne s'y trouve pas. Ajouter le !</p>

<button type="button" id="buttonAjouter">Ajouter un ingredient</button>

<section id="sectionAjouter"> 

</section>

<section id="ingredientQuantite">

</section>


</fieldset>




<fieldset id="etape3">

<div>
<label for="recette">Étapes de la recette :</label><br>
<textarea name="recette" id="recette" rows="10" cols="65" ></textarea>
</div>

</fieldset>





<div>
<input type="button" name="action" id="prevBtn" value="Précédent" class="button">

<input type="button" name="action" id="nextBtn" value="Continuer" class="button">

<input type="submit"name="action" class="button" value="Envoyer ma recette">
</div>

 

</form>

</main>

</span>

<script src="../assets/js/contribution.js"></script>
<script src="../assets/js/inscription.js"></script>

</body>
</html>