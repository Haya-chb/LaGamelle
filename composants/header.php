<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre ?? 'La Gamelle') ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
    <?php if (isset($cssPage)): ?>
        <link rel="stylesheet" href="assets/css/<?= htmlspecialchars($cssPage) ?>.css">
    <?php endif; ?>

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicon/site.webmanifest">
</head>
<body>


<?php
// Vérification de la connexion
$utilisateurConnecte = isset($_SESSION['id_utilisateur']);
?>

<header class="header">

    <!-- Logo -->
    <a href="/accueil" class="logo" aria-label="Retour à l'accueil">
        <img src="/assets/images/logo.webp" alt="">
    </a>

    <!-- Menu burger -->
    <button
        class="burger"
        type="button"
        aria-label="Ouvrir le menu"
        aria-expanded="false"
        aria-controls="menu"
    >
        <img src="/assets/images/burger-menu.svg" alt="">
    </button>

    <!-- Navigation -->
    <nav id="menu" aria-label="Navigation principale">

        <ul class="navbar">
            <li><a href="/recettes">Nos recettes</a></li>
            <li><a href="/aliments-toxiques">Aliments toxiques</a></li>
            <li><a href="/veterinaires">Trouver un vétérinaire</a></li>
            <li><a href="/contribution">Proposer une recette</a></li>
        </ul>

        <?php if ($utilisateurConnecte): ?>

            <!-- Recherche mobile -->
            <form action="/recettes" method="get" class="mobile-only">
                <label for="recherche-mobile" class="sr-only">
                    Rechercher une recette
                </label>
                <input
                    type="search"
                    id="recherche-mobile"
                    name="recherche"
                    placeholder="Recherchez une recette..."
                >
            </form>

            <!-- Recherche ordinateur -->
            <form action="/recettes" method="get" class="pc-only">
                <label for="recherche-pc" class="sr-only">
                    Rechercher une recette
                </label>
                <input
                    type="search"
                    id="recherche-pc"
                    name="recherche"
                    placeholder="Recherchez une recette..."
                >
            </form>

            <!-- Compte ordinateur -->
            <div class="compte pc-only">
                <a href="/profil?favoris">
                    <img src="/assets/images/favorite-on.svg" alt="Mes favoris">
                </a>

                <a href="/profil">
                    <img src="/assets/images/compte.svg" alt="Mon profil">
                </a>
            </div>

            <!-- Compte mobile -->
            <div class="compte mobile-only">
                <a href="/profil?favoris">Favoris</a>
                <a href="/profil">Compte</a>
            </div>

        <?php else: ?>

            <!-- Utilisateur non connecté -->
            <div class="connexion">
                <a href="/inscription">Inscription</a>
                <a href="/connexion">Connexion</a>
            </div>

        <?php endif; ?>

    </nav>

</header>