<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/mentions.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicon/site.webmanifest">
</head>

<body>
    <header>
        <a href="../index.php" class="logo"><img src="../assets/images/logo.webp" alt="Retour à l'accueil"></a>
        <div class="mobile-only">
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';
            }
            ?>
        </div>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li class="mobile-only"><a href="../index.php">Accueil</a></li>
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="index.php">Trouver un vétérinaire</a></li>
                <li><a href="v-contribution.php">Proposer une recette</a></li>

            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="recette.php" method="get" class="pc-only">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte pc-only">
                        <a href="profil.php?favoris"><img src="../assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="profil.php"><img src="../assets/images/compte.svg" alt="Accéder à mon profil"></a>
                     </div>';

                echo '<div class="compte mobile-only">
                        <a href="profil.php?favoris">Favoris</a>
                        <a href="profil.php">Compte</a>
                        <a href="../deconnexion.php">Déconnexion</a>
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
    <main>
        <section class="legal-content" id="legales">
            <h1>Mentions Légales</h1>

            <h3>Éditeur du site</h3>
            <p><strong>Nom :</strong> Université Gustave Eiffel</p>
            <p><strong>Adresse :</strong> 5 bd Descartes, 77420 Champs-sur-Marne</p>
            <p><strong>Contact :</strong> +33 01 60 95 75 00</p>
            <p><strong>n° SIRET : </strong>130 026 123 00013</p>
            <p><strong>Forme juridique :</strong> EPSCP</p>

            <h3>Responsable de la protection des données (DPO) :</h3>
            <p><strong>Véronique JUGE</strong></p>
            <p><strong>Contact :</strong> <a
                    href="mailto:protectiondesdonnees-dpo@univ-eiffel.fr">protectiondesdonnees-dpo@univ-eiffel.fr</a>
            </p>
            <p><strong>Adresse :</strong> 5 bd Descartes, 77420 Champs-sur-Marne</p>
            <p><strong>Numéro de téléphone :</strong> +33 (0)1 60 95 75 00</p>

            <h3>Hébergement</h3>
            <p>Le site est hébergé par la société o2switch, SAS au capital de 100 000 €, dont le siège social est situé
                Chemin des Pardiaux, 63000 Clermont-Ferrand. <br> Téléphone : 04 44 44 60 40 <br> Site web : <a
                    href="http://www.o2switch.fr">www.o2switch.fr</a></p>

            <h3>Membres et rôles de l’équipe</h3>
            <p>Ce site a été conçu dans le cadre d’un projet étudiant par quatre membres de l’Université Gustave Eiffel.
            </p>
            <p>Haya Chaibi, Lola BENETEAU et Reda IDMAIS et Nathalia VILASSE, graphistes et développeuses, ont contribué
                à la maquette et au
                développement du site.
            </p>

            <h3>Propriété intellectuelle</h3>
            <p>Toute reproduction du code, design ou contenu provenant du site est interdite sans autorisation.</p>

            <ul>
                <li>Le code, le design et la structure du site ont été réalisés par les membres du projet.</li>
                <li>Les images et vidéos proviennent de sources externes libres de droits ou citées selon les licences
                    respectives.</li>
            </ul>


            <h3>Protection des données personnelles</h3>
            <p>
                Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit
                d'accès, de
                rectification et de suppression des données vous concernant. Pour exercer ces droits, contactez-nous à
                l’adresse suivante : <a href="mailto:datafem@gmail.com">contact@lagamelle.com</a> ou au <a
                    href="tel:+33767017040">+33 7 12 34 56 78</a>.
            </p>

            <h3>Cookies</h3>
            <p>Ce site n'utilise pas de cookies de suivi. Seuls des cookies techniques nécessaires au bon fonctionnement
                du site peuvent être utilisés.</p>

            </div>
        </section>

        <section class="confidentialite" id="confidentialite">
            <h2>Politique de Confidentialité</h2>

            <p class="intro">Chez <strong>La Gamelle</strong>, nous prenons soin de vos données autant que de vos
                animaux. Cette page explique quelles informations nous collectons lorsque vous créez un compte.</p>

            <article>
                <h3>1. Collecte des données</h3>
                <p>Lorsque vous créez un compte ou utilisez notre plateforme, nous collectons :</p>
                <ul>
                    <li><strong>Informations d'identification :</strong> Votre nom, prénom et adresse email.</li>
                    <li><strong>Données d'utilisation :</strong> Vos recettes enregistrées en favoris.</li>
                    <li><strong>Contributions :</strong> Les recettes que vous proposez via notre interface de
                        contribution.</li>
                </ul>
            </article>

            <article>
                <h3>2. Utilisation de vos données</h3>
                <p>Vos données sont utilisées exclusivement pour :</p>
                <ul>
                    <li>Gérer votre espace personnel et vos favoris.</li>
                    <li>Vous permettre de proposer et suivre vos propres recettes.</li>
                    <li>Sécuriser l'accès à votre compte utilisateur.</li>
                </ul>
            </article>

            <article>
                <h3>3. Stockage et Sécurité</h3>
                <p>Vos informations sont stockées de manière sécurisée. Nous ne revendons jamais vos données à des
                    tiers. Les mots de passe sont hachés en base de données pour garantir votre sécurité.</p>
            </article>

            <article>
                <h3>4. Vos droits (RGPD)</h3>
                <p>Vous restez maître de vos données. À tout moment, vous pouvez :</p>
                <ul>
                    <li>Modifier vos informations depuis votre profil.</li>
                    <li>Demander la suppression définitive de votre compte utilisateur.</li>
                </ul>
            </article>
        </section>

        <section class="credit" id="credits">
            <h2>Crédits et Ressources</h2>
            <p><strong>Illustrations de l'accueil :</strong> Nathalia VILASSE</p>
            <p><strong>Animations :</strong> GSAP.</p>
            <p><strong>Typographies :</strong> Nobulina, Kelson Sans, Louis George Cafe.</p>
        </section>
    </main>
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
                    <li><a href="recette.php">Nos Recettes</a></li>
                    <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="VeterinaireView.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="#legales">Mentions légales</a></li>
                    <li><a href="#confidentialite">Confidentialité</a></li>
                    <li><a href="#credits">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>

    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>