<?php
session_start();
include_once('controleurs/recette.php');
include_once('controleurs/user.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil | La Gamelle</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
    <main>
        <section class="hero">
            <h1>La Gamelle</h1>
            <p>Parce que vos animaux sont adorables, ils méritent des plats de qualité.</p>
        </section>

        <section class="recents">
            <h2>Nos nouvelles recettes</h2>
            <p>Ne ratez rien des nouveautés pour vos compagnons ! Chaque semaine, de nouvelles recettes saines et
                gourmandes arrivent pour ravir chats et chiens. Inspirez-vous et faites plaisir à votre chouchou avec
                des repas faits maison faciles à préparer.</p>
            <section class="new"></section>
        </section>

        <section class="nous">
            <h2>Que proposons-nous ?</h2>
            <p>Ici, vous trouverez toutes les recettes pour chouchouter votre compagnon à quatre pattes ! Snacks
                rapides, repas gourmands ou petites friandises maison… tout est pensé pour égayer les repas de votre
                chat ou de votre chien et lui faire plaisir à chaque bouchée.</p>

            <div class="cards">
                <div class="card">
                    <div class="img"></div>
                    <h3>Snacks</h3>
                    <p>Des snacks délicieux, parfaits pour leur offrir un petit plaisir sain à tout moment.</p>
                    <a href="vues/recette.php?type=snack">Voir les snacks</a>
                </div>
                <div class="card">
                    <div class="img"></div>
                    <h3>Plats</h3>
                    <p>Des plats variés salés et savoureux, adaptés aux goûts et besoins des animaux.
                    </p>
                    <a href="vues/recette.php?type=plat">Voir les plats</a>
                </div>
                <div class="card">
                    <div class="img"></div>
                    <h3>Desserts</h3>
                    <p>Des desserts gourmands et variés, parfaits pour satisfaire toutes les envies sucrées.</p>
                    <a href="vues/recette.php?type=dessert">Voir les desserts</a>
                </div>
            </div>

            <div class="jsp"></div>
        </section>

        <section class="croquette">
            <h2>De nouvelles recettes saines pour remplacer les croquettes.</h2>
            <div class="croquette-container">
                <div class="gauche">
                    <div>
                        <h3>Des aliments sains</h3>
                        <p>De nouvelles recettes saines pour remplacer les croquettes.</p>
                    </div>
                    <div>
                        <h3>Des recettes personnalisées</h3>
                        <p>Des recettes proposées par rapport à la race de votre animal, ses préférences et ses
                            problèmes de santés éventuels</p>
                    </div>
                </div>
                <div class="img"></div>
                <div class="droite">
                    <div>
                        <h3>Tout pour sa santé</h3>
                        <p>Des recettes qui respectent leurs régimes alimentaitaires ou leurs problèmes de santé.</p>
                    </div>
                    <div>
                        <h3>Ajouter vos propres recettes</h3>
                        <p>Proposez des recettes qui seront validées ou refusées par nos modérateurs, selon leur
                            conformité avec nos valeurs éthiques.</p>
                        <a href="">Ajouter une recette</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="aliment">
            <h2>Des aliments dangeureux pour vos animaux !</h2>
            <div class="timeline">
                <div class="timeline-step">
                    <div class="timeline-icon"></div>
                    <p>De nombreux ingrédients que nous utilisons chaque jour en cuisine sont parfaitement comestibles
                        pour les humains. Fruits, légumes, produits laitiers ou féculents : ils font partie de nos
                        habitudes alimentaires.</p>
                    <h3>Des ingrédients du quotidien</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">⚠️</div>
                    <p>Cependant, chez les chiens et les chats, certains aliments peuvent provoquer de graves troubles :
                        intoxications, problèmes digestifs, atteintes neurologiques ou rénales. Le chocolat, l’oignon,
                        l’ail ou encore le raisin en sont des exemples courants..</p>
                    <h3>Des risques méconnus</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">📖</div>
                    <p>La Gamelle met à votre disposition une liste claire des aliments dangereux, adaptée à chaque
                        espèce. Vous savez immédiatement quels ingrédients éviter et comment ajuster vos recettes en
                        toute sécurité.</p>
                    <h3>Un guide pour éviter les erreurs</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">⏱️</div>
                    <p>Avant de préparer un repas maison pour votre animal, prenez quelques secondes pour vérifier les
                        ingrédients. Un simple réflexe peut éviter des risques inutiles et garantir son bien-être au
                        quotidien.</p>
                    <h3>Protégez votre compagnon</h3>
                    <div class="point"></div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/script.js"></script>
</body>

</html>