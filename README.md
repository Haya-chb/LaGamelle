# README – La Gamelle

## URL du site : https://lagaamelle.fr

## Url tableur Opquast et accéssibilité : https://docs.google.com/spreadsheets/d/14QeysxklN1QNs3so0HiC1ZEYmkPKsPkjABZ14Si7lBA/edit?usp=sharing


# Réinstaller le site et la base de donnée sur un autre serveur

## Insérer la base de donnée  : 

1 - Créer une base de donnée se nommant "lagamelle" : CREATE DATABASE lagamelle;

2 - Importer le fichier lagamelle.sql via phpMyAdmin

3 - Modifier le fichier connexion.php avec vos informations (utilisateur et mdp)

## Insérer les fichiers : 

1 - Ouvrir le gestionnaire de fichier de votre serveur

2 - Zipper le dossier fournit

3 - Le déposer à la racine de votre serveur (/var/www/html/)

4 - Le dézipper


## Dimensionnement du serveur

### Petit trafic (≤ 100 utilisateurs/jour)
- 1 vCPU

- 1 Go RAM

- 10 Go stockage

### Trafic moyen (100 à 1 000 utilisateurs/jour)

- 2 vCPU

- 2 à 4 Go RAM

- 20 Go stockage

### Trafic élevé (> 1 000 utilisateurs/jour)

- 4 vCPU

- 8 Go RAM

- Cache PHP (OPcache)

- Hébergement dédié ou cloud