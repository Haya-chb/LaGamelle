<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?> | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/veterinaire.css">

        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicon/site.webmanifest">
</head>

<body>

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
                    $img = $recette['image_recette'];

                    echo "<div class='recette'>";
                    echo "<a class='recette-link' href='recette-detail.php?id={$id}'>
                            <div class='img'><img src='../assets/images/{$img}' alt=''></div>
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


    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>