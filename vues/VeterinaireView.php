<?php
session_start();


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
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/favicon/site.webmanifest">
</head>

<body>
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
                    <div class="card-vet" id="vet-<?= $vet['id_veterinaire'] ?>">
                        <div class="card-vet-head">
                            <h3><?= htmlspecialchars($vet['prenom'] . ' ' . $vet['nom']) ?></h3>
                            <div class="note">⭐ <?= htmlspecialchars($vet['note']) ?></div>
                        </div>
                        <div class="separator"></div>
                        <p>
                            <?= htmlspecialchars($vet['adresse']) ?>
                        </p>
                        <p><?= htmlspecialchars($vet['code_postal']) ?>     <?= htmlspecialchars($vet['ville']) ?></p>

                        <a href="index.php?page=veterinaires&action=show&id=<?= $vet['id_veterinaire'] ?>">Accéder à la
                            fiche</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- CARTE -->
            <div id="map"></div>
        </div>
    </main>

    <!-- Leaflet CSS/JS -->
    <script src="../assets/js/gsap.min.js"></script>
    <script src="../assets/js/script.js"></script>
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