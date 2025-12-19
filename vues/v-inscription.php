<?php

include("../controleurs/c-inscription.php");


echo '

<form action="v-inscription.php" method="POST">

<div id="etape1">

<label for="pseudo"> Pseudo :</label>
<br><input type="text" name="pseudo" id="pseudo" required>

<label for="pswd">Mot de passe :</label>
<br><input type="password" name="pswd" id="pswd" required>

</div>



<div id="etape2">
<label for="prenom"> Prénom :</label>
<br><input type="text" name="prenom" id="prenom" required>

<label for="nom">Nom :</label>
<br><input type="text" name="nom" id="nom" required>

<label for="mail">Email :</label>
<br><input type="email" name="mail" id="mail" required>

<label for="telephone">Numéro de téléphone :</label>
<br><input type="tel" name="telephone" id="telephone" required>

</div>



<div id="etape3">

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

</div>



<div id="etape4">

<fildset>

<legend>Votre boule de poile</legend>


<label for="race">Sa race :</label>
<br><input type="text" name="race" id="race" required>

<label for="nom_animal"> Son nom :</label>
<br><input type="text" name="nom_animal" id="nom_animal" required>

<label for="agee"> Son âge:</label>
<br><input type="number" name="age" id="age" required>

<label for="agee"> Son anniversaire:</label>
<br><input type="date" name="anniv" id="anniv" required>

<label for="age"> Son poids:</label>
<br><input type="number" name="poids" id="poids" required>

<label for="sexe"> Son sexe:</label>
<br><input type="text" name="sexe" id="sexe" required>

</div>



<input type="submit" name="action" value="Précédent">

<input type="submit" name="action" value="Continuer">

<input type="submit" name="action" value="Valider">



</form>

';


?>