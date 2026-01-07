<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Les aliments toxiques</title>

<?php 
include('../controleurs/FoodController.php');
?>

<style>

@font-face {
    font-family: 'Nobulina';
    src: url('../assets/polices/NobulinaDemo-Inktrap.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'KelsonSans';
    src: url('../assets/polices/KelsonSans-Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'KelsonSans';
    src: url('../assets/polices/KelsonSans-Bold.woff2') format('woff2');
    font-weight: 700;
    font-style: normal;
}
@font-face {
    font-family: 'LouisGeorge';
    src: url('../assets/polices/LouisGeorgeCafe.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}
@font-face {
    font-family: 'LouisGeorge';
    src: url('../assets/polices/LouisGeorgeCafe-Bold.woff2') format('woff2');
    font-weight: 700;
    font-style: normal;
}

:root{
    --bg:#FFEAD2;
    --yellow:#FFC83D;
    --pink:#FF8BCB;
    --red:#B70000;
    --accent:#E53A1D;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: 'KelsonSans', sans-serif;
    font-weight:400;
    background:var(--bg);
}

/* ---------------------- */

main{
    padding:40px 30px;
}

h1{
    font-family: 'Nobulina', serif;
    font-size:72px;
}

.subtitle{
    margin:20px 0 40px;
}

.filters {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
}

/* Style des select */
.filters select {
    padding: 10px 20px;
    border-radius: 50px;
    border: none;
    background-color: var(--pink);
    color: black;
    font-family: 'KelsonSans', sans-serif;
   background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"><polygon points="0,0 10,0 5,5" fill="black"/></svg>');
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 10px;
    padding-right: 40px;
    cursor: pointer;
    appearance: none;
}

/* Style du bouton réinitialiser */
.filters .reset-btn {
    margin-left:auto;
    padding:10px 18px;
    border-radius:30px;
    border:none;
    background:var(--accent);
    color:black;
    cursor:pointer;
}

/* cartes */

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(230px,1fr));
    gap:30px;
}

.card {
    border-radius:18px;
    padding:0;
    min-height:350px;
    text-align:center;
    color:white;
    cursor:pointer;
    perspective: 1000px;
    width: 100%;
    height: 100%;
}

.card-inner {
    width: 100%;
    height: 100%;
    transition: transform 0.6s ease;
    transform-style: preserve-3d;
    border-radius: 18px;
}

/* Rotation au survol */
.card:hover .card-inner {
    transform: rotateY(180deg);
}

/* Faces */
.card-front,
.card-back {
    position: absolute;
    inset: 0;
    padding:20px;
    border-radius: 18px;
    backface-visibility: hidden;
}

.card-front {
    background: var(--red);
    backface-visibility: hidden;
}


.card-back {
    background: #8f0000;
    transform: rotateY(180deg);
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    justify-content: center;
}

.card-back p {
    font-size: 1rem;
    line-height: 1.5;
    overflow-y: auto;
    max-height: 100%;
}

.badge {
  position: absolute;
  top: 0px;
  left: -30px;
  width: 140px;
  height: 33px;
  padding: 8px;
  border-radius: 999px;
  display: flex;
  align-items: center;

  transform: rotate(-25deg);
}

.icon {
  width: 25px;
  height: 25px;
  background: #b1160f;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon img {
  width: 16px;
  height: 16px;
  object-fit: contain;
}

.badge-text {
  padding-left: 13px;
  padding-top: 3px;
  color: black;
}

.badge-chat {
  background-color: #f5c24c;;
}

.badge-chien {
  background-color: #F791C3;
}

.illus{
    width:170px;
    height:170px;
    border-radius:50%;
    background:#FFD4A3;
    margin:30px auto;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
}

.illus img {
    width: 130px;
    height: 130px;
    object-fit: contain;
}

.card h3{
    font-size:20px;
    margin-bottom:13px;
}

.card-front p{
    font-size:13px;
    opacity:0.9;
}




/* responsive */
@media(max-width:600px){
    h1{
        font-size:42px;
    }

    .search input{
        width:180px;
    }
}
</style>
</head>
<body>

<header>

</header>

<main>

<h1>Les aliments toxiques</h1>
<p class="subtitle">
    Vous trouverez ici une liste d’aliment à éviter dans l’alimentation de votre animal !
</p>

<form method="GET" class="filters">
    <select name="species">
        <option value="all">Espèce</option>
        <option value="chat" <?= ($_GET['species'] ?? '') === 'chat' ? 'selected' : '' ?>>Chat</option>
        <option value="chien" <?= ($_GET['species'] ?? '') === 'chien' ? 'selected' : '' ?>>Chien</option>
    </select>

    <select name="type">
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

    <button type="submit">Filtrer</button>
    <a href="index.php" class="reset-btn">Réinitialiser</a>
</form>

<section class="grid">
<?php foreach ($dangereux as $food): ?>
    <div class="card">
        <div class="card-inner">

            <div class="card-front">
                <div class="badge <?= $food['species'] === 'chat' ? 'badge-chat' : 'badge-chien' ?>">
                    <span class="icon">
                        <img src="../assets/images/<?= $food['species'] === 'chat' ? 'icon-chat.svg' : 'icon-chien.svg' ?>">
                    </span>
                    <span class="badge-text">Pour <?= htmlspecialchars($food['species']) ?></span>
                </div>

                <div class="illus">
                    <img src="../<?= htmlspecialchars($food['image']) ?>" alt="<?= htmlspecialchars($food['name']) ?>">
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
