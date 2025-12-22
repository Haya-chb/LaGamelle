<?php
require '../controleurs/user.php';
require '../controleurs/animal.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profil.css">
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
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer une recette</a></li>
            </ul>
            <div class="connexion pc-only">
                <a href="">Inscription</a>
                <a href="">Connexion</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="head">
            <div class="section flex head-gardien head-favoris active">
                <div class="img"></div>
                <div>
                    <h1><?= htmlspecialchars($user['pseudo']) ?></h1>
                </div>
            </div>
            <div class="section flex head-compagnon">
                <div class="img"></div>
                <div>
                    <h1 class="animal-name"><?= htmlspecialchars($animals[0]['nom_animal']) ?></h1>
                </div>
            </div>

            <div class="section flex compagnon-modif">
                <button id="compagnon-modif">Modifier le profil de <?= htmlspecialchars($animals[0]['nom_animal']) ?></button>
                <label for="animal" class="sr-only">Changer de profil animal :</label>
                <select name="animal" id="animal">
                    <option value="">Changer de profil animal</option>
                    <?php
                    foreach ($animals as $index => $a) {
                        echo "<option value='{$index}'>{$a['nom_animal']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button class="section gardien-modif active">Modifier mon profil</button>
        </section>

        <section>
            <div class="pages">
                <button id="gardien" class="nav-btn active" data-target="gardien">
                    <img src="../assets/images/profil.svg" alt="" aria-hidden="false">
                    <span class="text">Gardien</span>
                </button>
                <button id="compagnon" class="nav-btn" data-target="compagnon">
                    <img src="../assets/images/animal.svg" alt="" aria-hidden="false">
                    <span class="text">Boule de poil</span>
                </button>
                <button id="favoris" class="nav-btn" data-target="favoris">
                    <img src="../assets/images/favorite-on.svg" alt="" aria-hidden="false">
                    <span class="text">Favoris</span>
                </button>
            </div>

            <div class="section gardien active">
                <h2>Fiche de renseignement</h2>
                <div>
                    <p><strong>Nom et prénom :</strong></p>
                    <p> <?= htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']) ?></p>
                </div>
                <div>
                    <p><strong>Adresse Mail :</strong></p>
                    <p><?php echo htmlspecialchars($user['mail']); ?></p>
                </div>
                <div>
                    <p><strong>Numéro de téléphone :</strong></p>
                    <p><?php echo htmlspecialchars($user['numero']); ?></p>
                </div>
                <div>
                    <p><strong>Animaux à charge :</strong></p>
                    <div class="animal">
                        <?php
                        foreach ($animals as $a) {
                            echo '<span>';
                            echo "<img src='../assets/images/{$a["espece"]}-profil.png' alt='' class='icon'><p>" . htmlspecialchars($a['nom_animal']) . "</p>";
                            echo '</span>';
                        }
                        ?>
                        <span><img src="../assets/images/ajout.png" alt="Ajouter un animal" class="icon">
                            <p>Ajouter</p>
                        </span>
                    </div>
                </div>
            </div>

            <div class="section compagnon">
                <h2>Fiche de renseignement</h2>
                <div>
                    <p><strong>Espèce :</strong></p>
                    <p class="animal-espece"><?php echo htmlspecialchars($animals[0]['espece']); ?></p>
                </div>
                <div>
                    <p><strong>Race :</strong></p>
                    <p class="animal-race"><?php echo htmlspecialchars($animals[0]['race']); ?></p>
                </div>
                <div>
                    <p><strong>Sexe :</strong></p>
                    <p class="animal-sexe"><?php echo htmlspecialchars($animals[0]['sexe']); ?></p>
                </div>
                <div>
                    <p><strong>Age :</strong></p>
                    <p class="animal-age"><?php echo htmlspecialchars($animals[0]['age']); ?> ans</p>
                </div>
                <div>
                    <p><strong>Anniversaire :</strong></p>
                    <p class="animal-anniv"><?php echo htmlspecialchars($animals[0]['anniversaire']); ?></p>
                </div>
                <div>
                    <p><strong>Poids :</strong></p>
                    <p class="animal-poids"><?php echo htmlspecialchars($animals[0]['poids']); ?> kg</p>
                </div>
            </div>

            <div class="section favoris">
                <?php
                if (!empty($favoris)) {
                    foreach ($favoris as $fav) {
                        echo "<div class='recette favoris-card'><div class='img'></div>
                        <img src='../assets/images/pin.png' alt='' class='pin'>
                <h2>{$fav['nom_recette']}</h2>
                <span class='temps'><img src='../assets/images/clock.png' alt=''> {$fav['temps']} min</span>
                <div class='badge'>";

                        if ($fav['animal'] == 'chien') {
                            echo "<img src='../assets/images/dog.png' alt=''><p>Pour {$fav['animal']}</p>
                </div>";
                        } else if ($fav['animal'] == 'chat') {
                            echo "<img src='../assets/images/cat.png' alt=''><p>Pour {$fav['animal']}</p>
                </div>";
                        }
                        echo '<button class="btn-supp" data-recette="' . $fav["id_recette"] . '"><img src="../assets/images/favorite-on.svg" alt=""> <span class="sr-only">Ajouter aux favoris</span></button></div>';
                    }
                } else {
                    echo "<p class='rien'> Aucun favoris pour l'instant. </p>";
                }
                ?>
            </div>
        </section>
    </main>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/favoris.js"></script>
    <script>
        //Change les infos de l'animal au changement dans le select
        const animals = <?= json_encode($animals, JSON_UNESCAPED_UNICODE); ?>;

        const select = document.getElementById('animal');
        select.addEventListener('change', () => {
            const index = select.value;
            if (index === "") return;

            const animal = animals[index];

            document.getElementById('compagnon-modif').textContent = 'Modifier le profil de ' + animal.nom_animal
            document.querySelector('.animal-name').textContent = animal.nom_animal;
            document.querySelector('.animal-espece').textContent = animal.espece;
            document.querySelector('.animal-race').textContent = animal.race;
            document.querySelector('.animal-sexe').textContent = animal.sexe;
            document.querySelector('.animal-age').textContent = animal.age + ' ans';
            document.querySelector('.animal-anniv').textContent = animal.anniversaire;
            document.querySelector('.animal-poids').textContent = animal.poids + ' kg';
        });


        // Navigation sur la page
        const buttons = document.querySelectorAll('.nav-btn');
        const sections = document.querySelectorAll('.section');

        function showSection(target) {
            // reset sections
            sections.forEach(section => section.classList.remove('active'));

            // reset boutons
            buttons.forEach(btn => btn.classList.remove('active'));

            // bouton actif
            const activeBtn = document.querySelector(`[data-target="${target}"]`);
            if (activeBtn) activeBtn.classList.add('active');

            // sections liées
            document.querySelectorAll(`.${target}`).forEach(el =>
                el.classList.add('active')
            );

            document.querySelectorAll(`.head-${target}`).forEach(el =>
                el.classList.add('active')
            );

            document.querySelectorAll(`.${target}-modif`).forEach(el =>
                el.classList.add('active')
            );
        }

        // écouteurs
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                showSection(btn.dataset.target);
            });
        });



    </script>

</body>

</html>