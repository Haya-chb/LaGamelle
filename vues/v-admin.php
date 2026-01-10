<?php 
session_start();
if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] !== 'Nichocolat') {
    header('Location: ../index.php');
    exit();
}
include('../controleurs/c-admin.php'); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin | La Gamelle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <header>
        <a href="../index.php" class="logo"><img src="../assets/images/logo.webp" alt="Retour"></a>
        <button class="burger" aria-label="Ouvrir le menu">
            <img src="../assets/images/burger-menu.svg" alt="">
        </button>

        <nav id="menu">
            <ul class="navbar">
                <li><a href="v-admin.php?admin=Recettes" class="<?= ($page === 'Recettes') ? 'active' : '' ?>">Modérer Recettes</a></li>
                <li><a href="v-admin.php?admin=Utilisateurs" class="<?= ($page === 'Utilisateurs') ? 'active' : '' ?>">Gérer Membres</a></li>
                <li><a href="v-admin.php?admin=Avis" class="<?= ($page === 'Avis') ? 'active' : '' ?>">Modérer Avis</a></li>
            </ul>
            <div class="connexion">
                <a href="../index.php" class="btn-quitter">Quitter Admin</a>
            </div>
        </nav>
    </header>

<main class="admin-wrapper">

    <?php if ($page === 'Recettes'): ?>
        <h2 class="admin-title">Panel Recettes</h2>
        <div class="recettes-list">
            <?php if(empty($recettes)): ?>
                <p class="empty-msg">Aucune recette en attente !</p>
            <?php endif; ?>

            <?php foreach ($recettes as $r): 
                $ingredients = selectionIngredientsParRecette($db, $r['id_recette']); 
            ?>
                <div class="card-admin">
                    <div class="card-header">
                        <h3 class="recipe-name"><?= $r['nom_recette'] ?></h3>
                        <span class="badge-animal <?= $r['animal'] ?>"><?= $r['animal'] ?></span>
                    </div> 

                    <div class="card-content">
                        <div class="info-line">
                            <strong>Temps :</strong> <?= $r['temps'] ?> min | 
                            <strong>Catégorie :</strong> <?= $r['categorie_recette'] ?>
                        </div>
                        
                        <div class="details-grid">
                            <div class="ingredients-box">
                                <h4>Ingrédients</h4>
                                <div class="ing-tags">
                                    <?php foreach ($ingredients as $ing): ?>
                                        <span class="ing-tag"><?= $ing['quantite'] ?> <?= $ing['nom_ingredient'] ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="instructions-box">
                                <h4>Instructions</h4>
                                <p><?= nl2br(htmlspecialchars($r['contenu_recette'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <form action="v-admin.php?admin=Recettes" method="POST" enctype="multipart/form-data" class="admin-form">
                            <input type="hidden" name="id_recette" value="<?= $r['id_recette'] ?>">
                            <div class="upload-group">
                                <label>Image finale :</label>
                                <input type="file" name="image_recette" accept="image/*" required>
                            </div>
                            <div class="btn-group">
                                <button type="submit" name="valider" class="btn-publier">PUBLIER</button>
                                <button type="submit" name="action_admin" value="supprimer_recette" class="btn-danger" onclick="return confirm('Supprimer définitivement ?');">SUPPRIMER</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($page === 'Utilisateurs'): ?>
        <h2 class="admin-title">Gestion des Membres</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Animaux</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($utilisateurs as $u): ?>
                    <tr>
                        <td class="pseudo-td"><?= htmlspecialchars($u['pseudo']) ?></td>
                        <td><?= htmlspecialchars($u['mail']) ?></td>
                        <td><span class="tag-animal-small"><?= htmlspecialchars($u['mes_animaux'] ?: 'Aucun') ?></span></td>
                        <td>
                            <form action="v-admin.php?admin=Utilisateurs" method="POST">
                                <input type="hidden" name="id" value="<?= $u['id_utilisateur'] ?>">
                                <button type="submit" name="action_admin" value="supprimer_user" class="btn-danger-small" onclick="return confirm('Bannir ?');">Bannir</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($page === 'Avis'): ?>
        <h2 class="admin-title">Modération Avis</h2>
        <div class="avis-list">
            <?php foreach ($avis as $a): ?>
                <div class="card-admin avis-item">
                    <div class="avis-text">
                        <strong>@<?= htmlspecialchars($a['pseudo']) ?></strong> : 
                        <p>"<?= htmlspecialchars($a['commentaire']) ?>"</p>
                        <span class="note">Note : <?= $a['note'] ?>/5</span>
                    </div>
                    <form action="v-admin.php?admin=Avis" method="POST">
                        <input type="hidden" name="id" value="<?= $a['id_avis'] ?>">
                        <button type="submit" name="action_admin" value="supprimer_avis" class="btn-danger-small">Supprimer</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

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
                    <li><a href="../vues/index.php">Vétérinaires</a></li>
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
</body>

</html>