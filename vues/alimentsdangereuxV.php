<?php
session_start();
include('../controleurs/recetteControleur.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aliments toxiques | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/recette.css">
    <link rel="stylesheet" href="../assets/css/dangereux.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicon/site.webmanifest">
</head>

<body>
    <main>
        <section class="dangereux">
            <h1>Les aliments toxiques</h1>
            <p class="subtitle">
                Vous trouverez ici une liste d’aliments à éviter dans l’alimentation de votre animal !
            </p>

            <button class="btn-filtres" aria-expanded="false" aria-controls="filtres">
                Filtres
            </button>
        </section>

        <section class="recettes-container">
            <!-- Formulaire de filtre -->
            <form id="filters" class="filtres">
                <button class="btn-close-filtres"><img src="../assets/images/close.svg"
                        alt="Fermer les filtres"></button>
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
            <!-- Grid des cartes -->
            <div class="grid" id="grid">
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
                                <h2><?= htmlspecialchars($food['name']) ?></h2>
                                <p>Survoler la carte pour en savoir plus !</p>
                            </div>
                            <div class="card-back">
                                <p><?= htmlspecialchars($food['description']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>


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
</body>

</html>