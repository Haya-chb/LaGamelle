<?php 
    require('connexion.php');
    $stmt = $db->prepare("SELECT * FROM recette");
    $stmt->execute();
    $recette = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | La Gamelle</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="#">LG</a></li>
                <li><a href="vues/recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer un recette</a></li>
            </ul>
            <div class="connexion">
                <a href="">Inscription</a>
                <a href="">Connexion</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="hero">
            <h1>La Gamelle</h1>
            <p>Parce que vos animaux sont adorables, ils méritent des plats de qualité.</p>

            <form action="" method="GET">
                <label for="search" class="sr-only">Recherche</label>
                <input type="search" name="recherche" id="search" placeholder="Rechercher une recette...">
            </form>

            <img src="/assets/images/accueil.webp" alt="">
        </section>

        <section class="recents">
            <h2>Nos nouvelles recettes</h2>
            <p>Ne ratez rien des nouveautés pour vos compagnons ! Chaque semaine, de nouvelles recettes saines et
                gourmandes arrivent pour ravir chats et chiens. Inspirez-vous et faites plaisir à votre chouchou avec
                des repas faits maison faciles à préparer.</p>

            <?php
                foreach($recette as $r){
                    echo "<h3>".$r['nom_recette']."</h3>";
                }
            ?>
        </section>

        <section class="nous">
            <h2>Que proposons-nous ?</h2>
            <p>Ici, vous trouverez toutes les recettes pour chouchouter votre compagnon à quatre pattes ! Snacks
                rapides, repas gourmands ou petites friandises maison… tout est pensé pour égayer les repas de votre
                chat ou de votre chien et lui faire plaisir à chaque bouchée.</p>

            <div class="cards">
                <div class="card">
                    <h3>Snacks</h3>
                    <p>Des snacks délicieux, parfaits pour leur offrir un petit plaisir sain à tout moment.</p>
                    <a href="vues/recette.php?type=snack">Voir les snacks</a>
                </div>
                <div class="card">
                    <h3>Plats</h3>
                    <p>Des plats variés salés et savoureux, adaptés aux goûts et besoins des animaux.
                    </p>
                    <a href="vues/recette.php?type=plat">Voir les plats</a>
                </div>
                <div class="card">
                    <h3>Desserts</h3>
                    <p>Des desserts gourmands et variés, parfaits pour satisfaire toutes les envies sucrées.</p>
                    <a href="vues/recette.php?type=dessert">Voir les desserts</a>
                </div>
            </div>

            <div class="jsp"></div>
        </section>
    </main>
</body>

</html>