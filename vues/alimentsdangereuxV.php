<?php 
session_start();
include('../controleurs/FoodController.php'); 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les aliments toxiques</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
    <link rel="stylesheet" href="../assets/css/dangereux.css">
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
                <li><a href="alimentsdangereuxV.php" class="active">Aliments toxiques</a></li>
                <li><a href="VeterinaireView.php">Trouver un vétérinaire</a></li>
                <li><a href="v-contribution.php">Proposer une recette</a></li>
            </ul>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<form action="controleurs/recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>';

                echo '<div class="compte">
                        <a href="profil.php?favoris"><img src="../assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                        <a href="vues/profil.php"><img src="../assets/images/compte.svg" alt="Accéder à mon profil"></a>
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
        <section class="dangereux">
            <h1>Les aliments toxiques</h1>
            <p class="subtitle">
                Vous trouverez ici une liste d’aliments à éviter dans l’alimentation de votre animal !
            </p>

            <button class="btn-filtres" aria-expanded="false" aria-controls="filtres">
                Filtres
            </button>

            <!-- Formulaire de filtre -->
            <form id="filters" class="filtres">
                <button class="btn-close-filtres"><img src="../assets/images/close.svg" alt="Fermer les filtres"></button>
                <select name="species" id="species-filter">
                    <option value="all">Espèce</option>
                    <option value="chat">Chat</option>
                    <option value="chien">Chien</option>
                </select>
                <select name="type" id="type-filter">
                    <option value="all">Type d’aliment</option>
                    <option value="fruit">Fruit</option>
                    <option value="sucre">Sucré</option>
                    <option value="boisson">Boisson</option>
                    <option value="legume">Légume</option>
                    <option value="viande">Viande</option>
                    <option value="laitage">Laitage</option>
                    <option value="poisson">Poisson</option>
                    <option value="oeuf">Œuf</option>
                    <option value="autre">Autre</option>
                </select>
                <button type="button" id="reset-btn" class="btn-reset">Réinitialiser</button>
            </form>
        </section>

        <!-- Grid des cartes -->
        <section class="grid" id="grid">
            <?php foreach ($dangereux as $food): ?>
                <div class="card" data-species="<?= htmlspecialchars($food['species']) ?>"
                    data-type="<?= htmlspecialchars($food['type']) ?>">
                    <div class="card-inner">

                        <div class="card-front">
                            <div class="badge <?= $food['species'] === 'chat' ? 'badge-chat' : 'badge-chien' ?>">
                                <span class="icon">
                                    <img
                                        src="../assets/images/<?= $food['species'] === 'chat' ? 'icon-chat.svg' : 'icon-chien.svg' ?>">
                                </span>
                                <span class="badge-text">Pour <?= htmlspecialchars($food['species']) ?></span>
                            </div>

                            <div class="illus">
                                <img src="../<?= htmlspecialchars($food['image']) ?>"
                                    alt="<?= htmlspecialchars($food['name']) ?>">
                            </div>

                            <h3><?= htmlspecialchars($food['name']) ?></h3>
                            <p>Survoler la carte pour en savoir plus !</p>
                        </div>

                        <div class="card-back">
                            <p><?= htmlspecialchars($food['description']) ?></p>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
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
                    <li><a href="../vues/recette.php">Nos Recettes</a></li>
                    <li><a href="../vues/alimentsdangereuxV.php">Aliments toxiques</a></li>
                    <li><a href="../vues/VeterinaireView.php">Vétérinaires</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>Informations</h3>
                <ul>
                    <li><a href="../vues/mentions-legales.php">Mentions légales</a></li>
                    <li><a href="../vues/mentions-legales.php#confidentialite">Confidentialité</a></li>
                    <li><a href="../vues/mentions-legales.php#credits">Crédits</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 La Gamelle - Fait avec passion pour vos animaux.</p>
        </div>
    </footer>

    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/recette.js"></script>

    <!-- ---------------------- JS Filtre ---------------------- -->
    <script>
        const speciesFilter = document.getElementById('species-filter');
        const typeFilter = document.getElementById('type-filter');
        const resetBtn = document.getElementById('reset-btn');
        const cards = document.querySelectorAll('.card');

        function filterCards() {
            const speciesValue = speciesFilter.value;
            const typeValue = typeFilter.value;

            cards.forEach(card => {
                const cardSpecies = card.dataset.species;
                const cardType = card.dataset.type;

                const matchesSpecies = speciesValue === 'all' || speciesValue === cardSpecies;
                const matchesType = typeValue === 'all' || typeValue === cardType;

                card.style.display = (matchesSpecies && matchesType) ? '' : 'none';
            });
        }

        // Écoute les changements sur les select
        speciesFilter.addEventListener('change', filterCards);
        typeFilter.addEventListener('change', filterCards);

        // Réinitialiser
        resetBtn.addEventListener('click', () => {
            speciesFilter.value = 'all';
            typeFilter.value = 'all';
            filterCards();
        });
    </script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/gsap.min.js"></script>
</body>
</html>