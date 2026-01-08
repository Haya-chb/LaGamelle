<?php
// =======================
// DETECTION D'UNE RECHERCHE ACTIVE
// =======================
$hasSearch =
    (!empty($_GET['name']) && trim($_GET['name']) !== '')
    || (!empty($_GET['city']) && trim($_GET['city']) !== '');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire des vétérinaire | La Gamelle</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="../assets/css/veterinaire.css">
    <style>
        .container {
            display: flex;
            gap: 20px;
        }

        .results {
            width: 40%;
            max-height: 600px;
            overflow-y: auto;
        }

        #map {
            width: 60%;
            height: 600px;
        }

        .card-vet {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
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
                <li><a href="VeterinaireView.php" class="active">Trouver un vétérinaire</a></li>
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
        <!-- BARRE DE RECHERCHE -->
        <form method="GET" action="index.php" class="form">
            <input type="hidden" name="page" value="veterinaires">
            <input type="hidden" name="action" value="index">

            <!-- INPUT NOM -->
            <div class="input-wrapper left">
                <img src="../assets/images/person.svg" alt="" class="input-icon">
                <input type="text" name="name" placeholder="       Nom ou prénom"
                    value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
            </div>

            <!-- INPUT VILLE -->
            <div class="input-wrapper right">
                <img src="../assets/images/loca.svg" alt="" class="input-icon">
                <input type="text" name="city" placeholder=".      Ville"
                    value="<?= htmlspecialchars($_GET['city'] ?? '') ?>">
            </div>

            <button type="submit">Rechercher</button>
        </form>


        <!-- BOUTON EFFACER LA RECHERCHE (AFFICHE UNIQUEMENT SI RECHERCHE) -->
        <?php if ($hasSearch): ?>
            <form method="GET" action="index.php" class="vet-reset-form">
                <input type="hidden" name="page" value="veterinaires">
                <input type="hidden" name="action" value="index">

                <button type="submit" class="vet-reinitialiser">
                    Effacer la recherche
                </button>
            </form>
        <?php endif; ?>

        <div class="container">
            <!-- LISTE -->
            <div class="results" id="vet-list">
                <?php foreach ($veterinaires as $vet): ?>
                    <div class="card-vet" id="vet-<?= $vet['id'] ?>">
                        <h3><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></h3>
                        <div class="separator"></div>
                        <p>
                            <?= htmlspecialchars($vet['adresse']) ?><br>
                            <?= htmlspecialchars($vet['code_postal']) ?>     <?= htmlspecialchars($vet['ville']) ?><br>
                            <?= htmlspecialchars($vet['telephone']) ?>
                        </p>
                        <div class="note">⭐ <?= htmlspecialchars($vet['note']) ?></div>
                        <a href="index.php?page=veterinaires&action=show&id=<?= $vet['id'] ?>">
                            <button>Accéder à la fiche</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- CARTE -->
            <div id="map"></div>
        </div>
    </main>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // =======================
        // DONNEES PASSEES DEPUIS PHP
        // =======================
        const veterinaireData = <?= json_encode($veterinaires) ?>;

        // =======================
        // INITIALISATION DE LA MAP
        // =======================
        const map = L.map('map').setView([46.8, 2.3], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // =======================
        // ICONES
        // =======================
        const defaultIcon = L.icon({
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
        });

        const selectedIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png'
        });

        // =======================
        // VARIABLES
        // =======================
        let currentSelectedMarker = null;
        const allMarkers = [];

        // =======================
        // RESET FUNCTION
        // =======================
        function resetSelection() {
            if (currentSelectedMarker) {
                currentSelectedMarker.setIcon(defaultIcon);
                currentSelectedMarker = null;
            }

            document.querySelectorAll('.card-vet').forEach(card => {
                card.style.display = 'block';
            });
        }

        // =======================
        // CREATION DES MARKERS
        // =======================
        veterinaireData.forEach(vet => {
            if (!vet.latitude || !vet.longitude) return;

            const lat = parseFloat(vet.latitude);
            const lng = parseFloat(vet.longitude);

            if (isNaN(lat) || isNaN(lng)) return;

            const marker = L.marker([lat, lng], { icon: defaultIcon }).addTo(map);
            allMarkers.push(marker);

            marker.on('click', (e) => {
                L.DomEvent.stopPropagation(e);

                if (currentSelectedMarker) {
                    currentSelectedMarker.setIcon(defaultIcon);
                }

                marker.setIcon(selectedIcon);
                currentSelectedMarker = marker;

                document.querySelectorAll('.card-vet').forEach(card => card.style.display = 'none');

                const selectedCard = document.getElementById(`vet-${vet.id}`);
                if (selectedCard) {
                    selectedCard.style.display = 'block';
                    selectedCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

                map.flyTo([lat, lng], 14, { duration: 1.0 });
            });
        });

        // =======================
        // ZOOM AUTO AU CHARGEMENT
        // =======================
        if (allMarkers.length > 0) {
            const group = new L.featureGroup(allMarkers);
            map.fitBounds(group.getBounds().pad(0.2));
        }

        // =======================
        // RESET AU CLIC SUR LA MAP
        // =======================
        map.on('click', (e) => {
            if (e.originalEvent.target.closest('.leaflet-marker-icon')) return;
            resetSelection();
        });
    </script>
</body>
</html>