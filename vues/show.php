<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?> | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/veterinaire.css">
</head>

<body>
    <header>
        <a href="../index.php" class="logo">LG</a>
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu" aria-label="Navigation principale">
            <ul class="navbar">
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="alimentsdangereuxV.php">Aliments toxiques</a></li>
                <li><a href="index.php">Trouver un vétérinaire</a></li>
                <li><a href="v-contribution.php">Proposer une recette</a></li>
            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte">
                        <a href="profil.php?favoris"><img src="assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="profil.php"><img src="assets/images/compte.svg" alt="Accéder à mon profil"></a>
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

    <main class="container-vet">
        <div class="vet-header">
            <div class="vet-photo">
                <img src="<?= '../assets/images/' . htmlspecialchars($vet['image_veterinaire']) ?>"
                    alt="Photo de <?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?>">
            </div>
            <div class="vet-info">
                <h1><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></h1>
                <div class="vet-description">
                    <?php if (!empty($vet['description'])): ?>
                        <p><?= htmlspecialchars($vet['description']) ?></p>
                    <?php else: ?>
                        <p>Le vétérinaire dit « canin » soigne, opère et stérilise surtout les chiens et les chats. Il
                            s'occupe aussi de petits mammifères, de reptiles et d'oiseaux. Il exerce le plus souvent en
                            cabinet; en clinique (il peut alors hospitaliser les animaux) ou bien dans des CHV (centres
                            hospitaliers vétérinaires) qui sont en plus dotés de vétérinaires spécialistes dans
                            différents
                            domaines (médecine interne, chirurgie, dermatologie, imagerie médicale, etc).</p>
                    <?php endif; ?>
                </div>
                <div class="vet-contact">
                    <h2>Contact</h2>
                    <div class="contact-item">
                        <img src="../assets/images/loca.svg" alt="">
                        <span><?= htmlspecialchars($vet['ville']) ?></span>
                    </div>
                    <div class="contact-item">
                        <img src="../assets/images/phone.png" alt="">
                        <span><a
                                href="tel:<?= htmlspecialchars($vet['telephone']) ?>"><?= htmlspecialchars($vet['telephone']) ?></a></span>
                    </div>
                    <div class="contact-item">
                        <img src="../assets/images/mail.svg" alt="">
                        <span><a
                                href="mailto:<?= htmlspecialchars($vet['email']) ?>"><?= htmlspecialchars($vet['email']) ?></a></span>
                    </div>
                </div>
            </div>
        </div>

        <section class="recettes">
            <?php
            if (!empty($recettesAssociees)) {
                foreach ($recettesAssociees as $recette) {
                    $id = (int) $recette['id_recette'];
                    $nom = htmlspecialchars($recette['nom_recette']);
                    $temps = (int) $recette['temps'];
                    $animal = htmlspecialchars($recette['animal']);

                    echo "<div class='recette'>";
                    echo "<a class='recette-link' href='recette-detail.php?id={$id}'>
                            <div class='img'></div>
                            <img src='../assets/images/pin.png' alt='' class='pin'>
                            <h2>{$nom}</h2>
                            <span class='temps'><img src='../assets/images/clock.png' alt=''> {$temps} min</span>
                            <div class='badge'>";

                    if ($recette['animal'] == 'chien') {
                        echo "<img src='../assets/images/dog.png' alt=''><p>Pour {$animal}</p></div>";
                    } else if ($recette['animal'] == 'chat') {
                        echo "<img src='../assets/images/cat.png' alt=''><p>Pour {$animal}</p></div>";
                    } else {
                        echo "</div>";
                    }

                    echo "</a>";
                    echo "</div>";
                }
            }
            ?>
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
                    <li><a href="../recette.php">Nos Recettes</a></li>
                    <li><a href="../alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="../index.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="../mentions-legales.php">Mentions légales</a></li>
                    <li><a href="../mentions-legales.php#confidentialite">Confidentialité</a></li>
                    <li><a href="../mentions-legales.php#credits">Crédits</a></li>
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