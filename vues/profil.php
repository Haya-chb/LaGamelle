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
</head>

<body>
    <header>
        <nav>
            <ul class="navbar">
                <li><a href="../index">LG</a></li>
                <li><a href="recette.php">Nos Recettes</a></li>
                <li><a href="">Aliments toxiques</a></li>
                <li><a href="">Trouver un vétérinaire</a></li>
                <li><a href="">Proposer un recette</a></li>
            </ul>
            <div class="compte">
                <a href="">Profil</a>
                <a href="">Favoris</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="headGardien">
            <h1><?= htmlspecialchars($user['pseudo']) ?></h1>
            <button>Modifier le profil</button>
        </section>

        <section class="headAnimal">
            <h1><?= htmlspecialchars($animals[0]['nom_animal']) ?></h1>
            <button>Modifier le profil de <?= htmlspecialchars($animals[0]['nom_animal']) ?></button>

            <label for="animal" class="sr-only">Changer de profil animal :</label>
            <select name="animal" id="animal">
                <option value="">Changer de profil animal</option>
                <?php
                foreach ($animals as $a) {
                    echo "<option value='{$a['nom_animal']}'>{$a['nom_animal']}</option>";
                }
                ?>
            </select>
        </section>

        <section>
            <div class="pages">
                <span><button>Gardien</button></span>
                <span><button>Boule de poil</button></span>
                <span><button>Favoris</button></span>
            </div>

            <section class="infos">
                <h2>Fiche de renseignement</h2>
                <div class="gardien">
                    <div>
                        <p><strong>Nom et prénom :</strong></p>
                        <p> <?= htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']) ?></p>
                    </div>
                    <div>
                        <p><strong>Adresse Mail :</strong></p>
                        <p><?php echo $user['mail']; ?></p>
                    </div>
                    <div>
                        <p><strong>Numéro de téléphone :</strong></p>
                        <p><?php echo $user['numero']; ?></p>
                    </div>
                    <div>
                        <p><strong>Animaux à charge :</strong></p>
                        <?php
                        foreach ($animals as $a) {
                            echo $a['nom_animal'] . ' ';
                        }
                        ?>
                    </div>
                </div>

                <div class="animal">
                    <div>
                        <p><strong>Race :</strong></p>
                        <p></p>
                    </div>
                    <div>
                        <p><strong>Sexe :</strong></p>
                    </div>
                    <div>
                        <p><strong>Age :</strong></p>
                    </div>
                    <div>
                        <p><strong>Anniversaire :</strong></p>
                    </div>
                    <div>
                        <p><strong>Poids :</strong></p>
                    </div>
                </div>
            </section>

            <div class="favoris">
                <?php
                foreach ($favoris as $fav) {
                    echo "<div class='favoris-card'><img src='' alt=''>
                <h2>{$fav['nom_recette']}</h2>
                <span><img src='../assets/images/clock.png' alt=''> {$fav['temps']} min</span>
                <div class='badge'>";

                    if ($fav['animal'] == 'chien') {
                        echo "<img src='../assets/images/dog.png' alt=''><p>Pour {$fav['animal']}</p>
                </div>";
                    } else if ($fav['animal'] == 'chat') {
                        echo "<img src='../assets/images/cat.png' alt=''><p>Pour {$fav['animal']}</p>
                </div>";
                    }
                    echo '<button class="btn-supp" data-recette="' . $fav["id_recette"] . '"> Supprimer </button>
                </div>';
                }
                ?>
            </div>
        </section>
    </main>

    <script src="../assets/js/favoris.js"></script>
</body>

</html>