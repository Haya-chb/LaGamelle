<?php

include ("../connexion.php");
include ("../controles/c-connexion.php");

 echo '<form action="v-connexion.php" method="POST">

<div><label for="login">Login :</label><br>
<input type="text" id="login" name="pseudo"></div>

<div><label for="pswd">Mot de passe :</label><br>
<input type="password" id="pswd" name="pswd"></div>
<input type="submit" name="Connexion" value="Connexion">
</form>';



?>