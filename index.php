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
                <li><a href="">Proposer une recette</a></li>
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
                    <div class="timeline-icon">🥗</div>
                    <p>Nos recettes sont conçues avec des ingrédients sûrs et comestibles pour les humains. Vous pouvez expérimenter en cuisine et préparer des plats savoureux pour vous.</p>
                    <h3>Des ingrédients sûrs pour votre animal</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">⚠️</div>
                    <p>Certaines choses bonnes pour vous peuvent être dangereuses pour votre compagnon. Chocolat, oignon ou raisin, par exemple, sont à éviter.</p>
                    <h3>Vérifiez pour votre animal</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">📖</div>
                    <p>La Gamelle vous aide à identifier facilement les aliments à risque et à adapter vos recettes pour qu’elles restent délicieuses et sûres.</p>
                    <h3>Consultez notre guide</h3>
                    <div class="point"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-icon">⏱️</div>
                    <p>Avant de cuisiner pour votre compagnon, consultez notre liste des aliments dangereux. Vous assurerez sa sécurité tout en préparant de bons plats.</p>
                    <h3>Agissez vite !</h3>
                    <div class="point"></div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>