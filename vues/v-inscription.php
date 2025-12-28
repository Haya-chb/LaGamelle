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
  
<?php
echo '

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

<div class="etape4-1">
<div>
<label for="race">Sa race :</label>
<br><input type="text" name="race" id="race" required>
</div>

<div>
<label for="nom_animal"> Son nom :</label>
<br><input type="text" name="nom_animal" id="nom_animal" required>
</div>

<div>
<label for="agee"> Son âge:</label>
<br><input type="number" name="age" id="age" required>
</div>
</div>

<div class="etape4-2">

<div>
<label for="agee"> Son anniversaire:</label>
<br><input type="date" name="anniv" id="anniv" required>
</div>

<div>
<label for="age"> Son poids:</label>
<br><input type="number" name="poids" id="poids" required>
</div>

<div>
<label for="sexe"> Son sexe:</label>
<br><input type="text" name="sexe" id="sexe" required>
</div>
</div>
</fieldset>

</section>

<div>
<input type="submit" name="action" value="Précédent" class="button">

<input type="submit" name="action" value="Continuer" class="button">
</div>
<input type="submit" name="action" value="Valider" class="button dis">



</form>';
?>

</body>
</html>