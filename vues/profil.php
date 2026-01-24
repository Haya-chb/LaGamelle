<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../index.php');
    exit;
}

require '../controleurs/userControleur.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profil.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicon/site.webmanifest">
</head>

<body>
    <header>
        <a href="../index.php" class="logo"><img src="../assets/images/logo.webp" alt="Retour à l'accueil"></a>
        <div class="mobile-only">
            <form action="recette.php" method="get">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>
            
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
            <form action="recette.php" method="get" class="pc-only">
                <label for="recherche" class="sr-only">Recherchez une recette</label>
                <input type="search" name="recherche" placeholder="Recherchez une recette...">
            </form>
            <div class="compte pc-only">
                <a href="profil.php?favoris"><img src="../assets/images/favorite-on.svg" alt="Voir mes favoris"></a>
                <a href="../deconnexion.php" class="deco">Déconnexion</a>
            </div>
            <div class="compte mobile-only">
                <a href="../deconnexion.php" class="deco">Déconnexion</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="head">
            <div class="section flex head-gardien head-favoris active">
                <div>
                    <h1><?= htmlspecialchars($user[0]['pseudo']) ?></h1>
                </div>
            </div>
            <div class="section flex head-compagnon">
                <div>
                    <h1 class="animal-name"><?= htmlspecialchars($user[0]['nom_animal']) ?></h1>
                </div>
            </div>

            <div class="section flex compagnon-modif">
                <button id="compagnon-modif">Modifier le profil de
                    <?= htmlspecialchars($user[0]['nom_animal']) ?></button>
                <?php
                if (count($user) > 1) {
                    echo '<label for="animal" class="sr-only">Changer de profil animal :</label>
                <select name="animal" id="animal">
                    <option value="">Changer de profil animal</option>';


                    foreach ($user as $index => $a) {
                        echo "<option value='{$index}'>{$a['nom_animal']}</option>";
                    }

                    echo '</select>';
                }
                ?>
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
                    <img src="../assets/images/favorite-profil.svg" alt="" aria-hidden="false">
                    <span class="text">Favoris</span>
                </button>
            </div>

            <div class="section gardien active">
                <h2>Fiche de renseignement</h2>
                <div>
                    <p><strong>Nom et prénom :</strong></p>
                    <p> <?= htmlspecialchars($user[0]['prenom_utilisateur']) . ' ' . htmlspecialchars($user[0]['nom_utilisateur']) ?>
                    </p>
                </div>
                <div>
                    <p><strong>Adresse Mail :</strong></p>
                    <p><?php echo htmlspecialchars($user[0]['mail']); ?></p>
                </div>
                <div>
                    <p><strong>Numéro de téléphone :</strong></p>
                    <p><?php echo htmlspecialchars($user[0]['numero_utilisateur']); ?></p>
                </div>
                <div>
                    <p><strong>Animaux à charge :</strong></p>
                    <div class="animal">
                        <?php
                        foreach ($user as $a) {
                            echo '<span>';
                            echo "<img src='../assets/images/{$a["espece"]}.svg' alt='' class='icon'><p>" . htmlspecialchars($a['nom_animal']) . "</p>";
                            echo '</span>';
                        }
                        ?>
                        <span id="addBtn"><img src="../assets/images/ajout.png" alt="Ajouter un animal" class="icon">
                            <p>Ajouter</p>
                        </span>
                    </div>
                </div>
            </div>

            <div class="section compagnon">
                <h2>Fiche de renseignement</h2>
                <div>
                    <p><strong>Espèce :</strong></p>
                    <p class="animal-espece"><?php echo htmlspecialchars($user[0]['espece']); ?></p>
                </div>
                <div>
                    <p><strong>Race :</strong></p>
                    <p class="animal-race"><?php echo htmlspecialchars($user[0]['race']); ?></p>
                </div>
                <div>
                    <p><strong>Sexe :</strong></p>
                    <p class="animal-sexe"><?php echo htmlspecialchars($user[0]['sexe']); ?></p>
                </div>
                <div>
                    <p><strong>Age :</strong></p>
                    <p class="animal-age"><?php echo htmlspecialchars($user[0]['age']); ?> ans</p>
                </div>
                <div>
                    <p><strong>Anniversaire :</strong></p>
                    <p class="animal-anniv"><?php echo htmlspecialchars($user[0]['anniversaire']); ?></p>
                </div>
                <div>
                    <p><strong>Poids :</strong></p>
                    <p class="animal-poids"><?php echo htmlspecialchars($user[0]['poids']); ?> kg</p>
                </div>
            </div>

            <div class="section favoris">
                <?php
                if (!empty($favoris)) {
                    foreach ($favoris as $fav) {
                        $id = (int) $fav['id_recette'];
                        $imgSrc = ($fav['image_recette']);
                        $nom = htmlspecialchars($fav['nom_recette']);
                        $temps = (int) $fav['temps'];
                        $animal = htmlspecialchars($fav['animal']);

                       echo"<div class='recette '><a class='recette-link' href='recette-detail.php?id={$id}'>
                                <div class='img'><img width='219px' src='../assets/images/{$imgSrc}' alt=''></div>
                                <img src='../assets/images/pin.png' alt='' class='pin'>
                                <h2>{$nom}</h2>
                                <span class='temps'><img src='../assets/images/clock.png' alt=''> {$temps} min</span>
                                <div class='badge'>";
                        if ($fav['animal'] == 'chien') {
                            echo "<img src='../assets/images/dog.png' alt=''><p>Pour {$animal}</p></div>";
                        } else if ($fav['animal'] == 'chat') {
                            echo "<img src='../assets/images/cat.png' alt=''><p>Pour {$animal}</p></div>";
                        } else {
                            echo "</div>";
                        }
                        echo "</a>";
                        echo '<button class="btn-supp" data-recette="' . $fav["id_recette"] . '"><img src="../assets/images/favorite-on.svg" alt=""> <span class="sr-only">Ajouter aux favoris</span></button></div>';
                    }
                } else {
                    echo "<p class='rien'> Aucun favoris pour l'instant. </p>";
                }
                ?>
            </div>
        </section>
        <section class="modal">
            <!-- FORMULAIRE MODIF PROFIL -->
            <div class="gardien-form">
                <h2>Modifier vos informations</h2>
                <form action="../controleurs/userControleur.php" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $user[0]['id_utilisateur']; ?>">
                    <div>
                        <label for="pseudo">Pseudo :</label><br>
                        <input type="text" name="pseudo" id="pseudo"
                            value="<?php echo htmlspecialchars($user[0]['pseudo']); ?>" required>
                    </div>
                    <br>
                    <div>
                        <label for="nom">Nom :</label><br>
                        <input type="text" name="nom" id="nom"
                            value="<?php echo htmlspecialchars($user[0]['nom_utilisateur']); ?>" require>
                    </div>
                    <br>
                    <div>
                        <label for="prenom">Prénom :</label><br>
                        <input type="text" name="prenom" id="prenom"
                            value="<?php echo htmlspecialchars($user[0]['prenom_utilisateur']); ?>" require>
                    </div>
                    <br>
                    <div>
                        <label for="mail">Mail :</label><br>
                        <input type="email" name="mail" id="mail" value="<?php echo htmlspecialchars($user[0]['mail']); ?>"
                            require>
                    </div>
                    <br>
                    <div>
                        <label for="numero">Numéro de téléphone :</label><br>
                        <input type="tel" name="numero" id="numero"
                            value="<?php echo htmlspecialchars($user[0]['numero_utilisateur']); ?>" require>
                    </div>
                    <br>
                    <div class="btn">
                        <button class="annuler">Annuler</button>
                        <input type="submit" value="Modifier" name="update">
                    </div>
                </form>
            </div>
            <!-- FORMULAIRE MODIF ANIMAL -->
            <div class="compagnon-form">
                <h2>Modifier les infos de votre boule de poil</h2>
                <form action="../controleurs/userControleur.php" method="post" class="compagnon-form">
                    <input type="hidden" name="id-animal" value="<?php echo $user[0]['id_animal']; ?>">
                    <div>
                        <label for="nom-animal">Nom :</label><br>
                        <input type="text" name="nom-animal" id="nom-animal"
                            value="<?php echo htmlspecialchars($user[0]['nom_animal']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="espece">Espèce :</label><br>
                        <input type="text" name="espece" id="espece"
                            value="<?php echo htmlspecialchars($user[0]['espece']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="sexe">Sexe :</label><br>
                        <input type="text" name="sexe" id="sexe"
                            value="<?php echo htmlspecialchars($user[0]['sexe']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="race">Race :</label><br>
                        <input type="text" name="race" id="race"
                            value="<?php echo htmlspecialchars($user[0]['race']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="age">Age :</label><br>
                        <input type="text" name="age" id="age"
                            value="<?php echo htmlspecialchars($user[0]['age']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="annniv">Anniversaire :</label><br>
                        <input type="date" name="anniv" id="anniv"
                            value="<?php echo htmlspecialchars($user[0]['anniversaire']); ?>">
                    </div>
                    <br>
                    <div>
                        <label for="poids">Poids de l'animal :</label><br>
                        <input type="number" name="poids" id="poids"
                            value="<?php echo htmlspecialchars($user[0]['poids']); ?>">
                    </div>
                    <br>
                    <div class="btn">
                        <button class="annuler">Annuler</button>
                        <input type="submit" value="Modifier" name="updateCompagnon">
                    </div>
                </form>
            </div>
            <!-- FORMULAIRE AJOUT ANIMAL -->
            <div class="ajout-animal-form">
                <h2>Ajouter un nouveau compagnon</h2>
                <form action="../controleurs/animal.php" method="post">
                    <input type="hidden" name="fk_user" value="<?php echo $user[0]['id_utilisateur']; ?>">

                    <div>
                        <label for="new-nom">Nom de l'animal :</label><br>
                        <input type="text" name="nom-animal" id="new-nom" placeholder="Ex: Rex" required>
                    </div>
                    <br>
                    <div>
                        <label for="new-espece">Espèce :</label><br>
                        <select name="espece" id="new-espece" required>
                            <option value="chien">Chien</option>
                            <option value="chat">Chat</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="new-sexe">Sexe :</label><br>
                        <select name="sexe" id="new-sexe" required>
                            <option value="Mâle">Mâle</option>
                            <option value="Femelle">Femelle</option>
                        </select>
                    </div>
                    <br>
                    <div>
                        <label for="new-race">Race :</label><br>
                        <input type="text" name="race" id="new-race" placeholder="Ex: Labrador" required>
                    </div>
                    <br>
                    <div>
                        <label for="new-age">Âge :</label><br>
                        <input type="number" name="age" id="new-age" required>
                    </div>
                    <br>
                    <div>
                        <label for="new-anniv">Date d'anniversaire :</label><br>
                        <input type="date" name="anniv" id="new-anniv" required>
                    </div>
                    <br>
                    <div>
                        <label for="new-poids">Poids (kg) :</label><br>
                        <input type="number" step="0.1" name="poids" id="new-poids" required>
                    </div>
                    <br>
                    <div class="btn">
                        <button type="button" class="annuler">Annuler</button>
                        <input type="submit" value="Ajouter l'animal" name="addAnimal">
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/favoris.js"></script>
    <script>
        //Btn de mofif et ajout
        let updateGardien = document.querySelector('.gardien-modif');
        let updateCompagnon = document.querySelector('#compagnon-modif');
        let ajoutCompagnon = document.querySelector('#addBtn');

        let modal = document.querySelector('.modal');
        const forms = document.querySelectorAll('.modal > div');

        function openModal(formClass) {
            // Cache tous les formulaires d'abord
            forms.forEach(f => f.style.display = 'none');
            // Affiche le bon
            document.querySelector('.' + formClass).style.display = 'block';
            modal.classList.add('show');
        }

        function closeModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                forms.forEach(f => f.style.display = 'none');
            }, 300);
        }

        // Écouteurs d'ouverture
        updateGardien.addEventListener('click', () => openModal('gardien-form'));
        updateCompagnon.addEventListener('click', () => openModal('compagnon-form'));
        ajoutCompagnon.addEventListener('click', () => openModal('ajout-animal-form'));

        // Écouteurs de fermeture
        document.querySelectorAll('.annuler').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                closeModal();
            });
        });

        // Fermer si on clique sur le fond noir
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        //Change les infos de l'animal au changement dans le select
        const animals = <?= json_encode($user, JSON_UNESCAPED_UNICODE); ?>;

        const select = document.getElementById('animal');
        if (select !== null) {
            select.addEventListener('change', () => {
                const index = select.value;
                if (index === "") return;

                const animal = animals[index];
                console.log(animals[index]);

                document.getElementById('compagnon-modif').textContent = 'Modifier le profil de ' + animal.nom_animal
                document.querySelector('.animal-name').textContent = animal.nom_animal;
                document.querySelector('.animal-espece').textContent = animal.espece;
                document.querySelector('.animal-race').textContent = animal.race;
                document.querySelector('.animal-sexe').textContent = animal.sexe;
                document.querySelector('.animal-age').textContent = animal.age + ' ans';
                document.querySelector('.animal-anniv').textContent = animal.anniversaire;
                document.querySelector('.animal-poids').textContent = animal.poids + ' kg';

                //Mise à jour du formulaire de modification
                const form = document.querySelector('.compagnon-form');

                // On utilise l'attribut name pour être sûr
                form.querySelector('input[name="id-animal"]').value = animal.id_animal;
                form.querySelector('input[name="nom-animal"]').value = animal.nom_animal;
                form.querySelector('input[name="espece"]').value = animal.espece;
                form.querySelector('input[name="sexe"]').value = animal.sexe;
                form.querySelector('input[name="race"]').value = animal.race;
                form.querySelector('input[name="age"]').value = animal.age;
                form.querySelector('input[name="anniv"]').value = animal.anniversaire;
                form.querySelector('input[name="poids"]').value = animal.poids;
            });
        }

        // Navigation sur la page
        const buttons = document.querySelectorAll('.nav-btn');
        const sections = document.querySelectorAll('.section');

        function showSection(target) {
            history.pushState(null, '', `?${target}`);

            //Reset et Activation
            sections.forEach(section => section.classList.remove('active'));
            buttons.forEach(btn => btn.classList.remove('active'));
            const activeBtn = document.querySelector(`[data-target="${target}"]`);
            if (activeBtn) activeBtn.classList.add('active');

            const targets = document.querySelectorAll(`.${target}, .head-${target}, .${target}-modif`);
            targets.forEach(el => el.classList.add('active'));

            //Animation GSAP
            const tl = gsap.timeline();

            //le header et les blocs de contenu
            const head = document.querySelector(`.head-${target}.active`);
            const content = document.querySelectorAll(`.section.${target}.active > div, .section.${target}.active > h2, .section.${target}.active .recette`);

            // Animation du Header
            if (head) {
                tl.fromTo(head,
                    { opacity: 0, y: -20 },
                    { opacity: 1, y: 0, duration: 0.4, ease: "power2.out" }
                );
            }

            // L'effet de cascade
            tl.fromTo(content,
                {
                    opacity: 0,
                    y: -10,
                    clipPath: "inset(0% 0% 100% 0%)"
                },
                {
                    opacity: 1,
                    y: 0,
                    clipPath: "inset(0% 0% 0% 0%)",
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    clearProps: "clip-path"
                },
                "-=0.2"
            );
        }

        // écouteurs
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                showSection(btn.dataset.target);
            });
        });

        // Au chargement de la page
        window.addEventListener('DOMContentLoaded', () => {
            const query = window.location.search.substring(1);

            if (query && ['gardien', 'compagnon', 'favoris'].includes(query)) {
                showSection(query);
            } else {
                showSection('gardien');
            }
        });
    </script>

</body>

</html>