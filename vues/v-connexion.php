<?php

include ("../controleurs/c-connexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/connexion.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    

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

