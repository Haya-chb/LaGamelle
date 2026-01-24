-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 10 jan. 2026 à 22:52
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lagamelle`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `fk_utilisateur` int NOT NULL,
  `nom_animal` varchar(50) NOT NULL,
  `race` varchar(10) NOT NULL,
  `age` int NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `anniversaire` date NOT NULL,
  `poids` int NOT NULL,
  `espece` varchar(10) NOT NULL,
  PRIMARY KEY (`id_animal`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id_animal`, `fk_utilisateur`, `nom_animal`, `race`, `age`, `sexe`, `anniversaire`, `poids`, `espece`) VALUES
(1, 4, 'Jasmin', 'Dobermann', 0, 'Mâle', '2026-01-10', 4, 'chien'),
(2, 4, 'Luna', 'Siamois', 3, 'Femelle', '2026-01-10', 1, 'chat');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `note` int NOT NULL,
  `fk_utilisateur` int NOT NULL,
  `fk_recette` int NOT NULL,
  PRIMARY KEY (`id_avis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dangereux`
--

DROP TABLE IF EXISTS `dangereux`;
CREATE TABLE IF NOT EXISTS `dangereux` (
  `id_dangereux` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `species` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(500) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_dangereux`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dangereux`
--

INSERT INTO `dangereux` (`id_dangereux`, `name`, `species`, `type`, `image`, `description`) VALUES
(1, 'Le Chocolat', 'chat', 'sucre', 'assets/images/Chocolate Bar.svg', 'Le chocolat contient de la théobromine et de la caféine, deux substances que le chat ne peut pas éliminer correctement. Elles provoquent une accélération du rythme cardiaque, des tremblements, de l’agitation, des vomissements, et peuvent entraîner des convulsions ou un coma en cas d’ingestion importante.'),
(2, 'Le café', 'chat', 'boisson', 'assets/images/café.png', 'La caféine stimule dangereusement le système nerveux et cardiaque du chat. De très faibles doses peuvent provoquer agitation, halètement, tremblements, arythmies et, dans les cas graves, des convulsions.'),
(3, 'L\'alcool', 'chat', 'boisson', 'assets/images/bière.png', 'L’alcool est extrêmement toxique pour les chats même en très petites quantités. Il provoque une chute rapide du taux de sucre, des difficultés respiratoires, des vomissements, une baisse de température corporelle, pouvant aller jusqu’au coma.'),
(4, 'L\'oignon', 'chat', 'legume', 'assets/images/oignon.png', 'L’oignon, sous toutes ses formes, détruit les globules rouges du chat. Cela peut entraîner une anémie hémolytique, avec fatigue, respiration difficile et urine foncée.'),
(5, 'L\'ail', 'chat', 'legume', 'assets/images/ail.png', 'Encore plus toxique que l’oignon, l’ail contient des composés sulfuriques qui endommagent les globules rouges, provoquant anémie, faiblesse, vomissements et accélération du rythme cardiaque.'),
(6, 'Le poireau', 'chat', 'legume', 'assets/images/poireau.png\r\n', 'Comme l’oignon et l’ail, le poireau contient des substances oxydantes qui détruisent les globules rouges du chat. Il peut entraîner vomissements, diarrhée et anémie.'),
(7, 'Le raisin', 'chat', 'fruit', 'assets/images/Grape.svg', 'Le raisin peut provoquer chez le chat une insuffisance rénale aiguë, parfois mortelle même à faible dose.'),
(8, 'L\'avocat', 'chat', 'fruit', 'assets/images/Avocado.svg', 'L’avocat contient une toxine appelée persine. Elle peut entraîner troubles digestifs, vomissements, diarrhée et difficultés respiratoires selon la dose et la sensibilité du chat.'),
(9, 'Les agrumes', 'chat', 'fruit', 'assets/images/agrumes.png', 'Les agrumes contiennent des huiles essentielles irritantes pour le système digestif du chat. Ils peuvent provoquer salivation excessive, vomissements, diarrhée, et parfois une dépression du système nerveux.'),
(10, 'La pâte crue', 'chat', 'autre', 'assets/images/pate.png', 'La pâte crue gonfle dans l’estomac du chat et peut provoquer une distension dangereuse. De plus, la fermentation de la levure produit de l’alcool, entraînant des risques d’empoisonnement alcoolique.\r\n'),
(11, 'Les noix de macadamia', 'CHAT', 'fruit', 'assets/images/noix-du-brésil.png', 'Les noix de macadamia contiennent des toxines qui provoquent vomissements, faiblesse, hyperthermie et tremblements. Même en petites quantités, elles peuvent être dangereuses.'),
(12, 'Les os cuits', 'chat', 'viande', 'assets/images/os-pour-chien.png', 'Les os cuits se cassent en éclats tranchants qui peuvent perforer l’œsophage, l’estomac ou les intestins. Ils peuvent aussi causer des obstructions digestives.'),
(13, 'Le lait', 'chat', 'laitage', 'assets/images/bidon-de-lait.png', 'La plupart des chats adultes sont intolérants au lactose. Le lait provoque alors diarrhée, gaz, crampes abdominales et inconfort digestif.'),
(14, 'Le thon (en excès)', 'chat', 'poisson', 'assets/images/boîte-de-conserve.png', 'Le thon n’est pas dangereux en petite quantité, mais il ne constitue pas un aliment équilibré pour le chat.'),
(15, 'La viande crue contaminée', 'chat', 'viande', 'assets/images/steak.png', 'La viande crue peut contenir des bactéries dangereuses comme salmonella, E. coli ou des parasites.'),
(16, 'Les œufs crus', 'chat', 'oeuf', 'assets/images/oeuf.png', 'Les œufs crus peuvent contenir des bactéries et bloquer l’absorption de la biotine.'),
(17, 'Les aliments salés', 'chat', 'sucre', 'assets/images/salami.png', 'Une consommation excessive de sel peut provoquer chez le chat une intoxication au sodium.'),
(18, 'Le xylitol', 'chat', 'sucre', 'assets/images/sucre.png', 'Le xylitol est extrêmement toxique pour les chats.'),
(19, 'Les champignons', 'chat', 'legume', 'assets/images/champignon.png', 'Certains champignons peuvent être mortels pour le chat.'),
(20, 'La pomme de terre crue', 'chat', 'legume', 'assets/images/pomme-de-terre.png', 'Les pommes de terre crues contiennent de la solanine toxique.'),
(21, 'Le chocolat', 'chien', 'sucre', 'assets/images/Chocolate Bar.svg', 'La caféine stimule dangereusement le cœur et le cerveau du chien.'),
(22, 'Le café', 'chien', 'boisson', 'assets/images/café.png', 'L’alcool est très toxique pour le chien.');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `fk_recette` int NOT NULL,
  `fk_utilisateur` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`fk_recette`, `fk_utilisateur`) VALUES
(2, 0),
(2, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(16, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id_ingredient` int NOT NULL AUTO_INCREMENT,
  `nom_ingredient` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id_ingredient`, `nom_ingredient`) VALUES
(1, 'Riz'),
(2, 'Poulet'),
(3, 'Carottes'),
(4, 'Huile de colza'),
(5, 'Compléments minéreau'),
(6, 'Levure de bière'),
(7, 'Saumon'),
(8, 'Riz brun'),
(9, 'Yaourt'),
(10, 'Épinard cuit'),
(11, 'Brin de persil'),
(12, 'Huile d\'olive'),
(13, 'Steack haché'),
(14, 'Haricots verts'),
(15, 'Riz soufflé'),
(16, 'Huile de saumon'),
(17, 'Blanc de poulet'),
(18, 'Courgettes'),
(19, 'Jus de cuisson de poisson'),
(20, 'Poulet deossé'),
(21, 'Foie de volaille'),
(22, 'Potiron'),
(23, 'Farine complète'),
(24, 'Pomme'),
(25, 'Oeuf'),
(26, 'Canelle en poudre'),
(27, 'Beurre de cacahuète'),
(28, 'Myrtilles'),
(29, 'Patate douce'),
(30, 'Flocons d\'avoine'),
(31, 'Fromage blanc'),
(32, 'Jus d\'une boite de thon'),
(33, 'Eau'),
(34, 'Herbe à chat'),
(35, 'Fraises'),
(36, 'Noix de coco rapé'),
(37, 'Banane mûre'),
(38, 'Farine d\'avoine'),
(39, 'Levure chimique'),
(40, 'Thon'),
(41, 'Lait spécial chat'),
(42, 'Farine'),
(43, 'Huile de saumon'),
(44, 'Pâte à friandise liq'),
(45, 'Petites friandises'),
(46, 'Boite de thon'),
(47, 'Tranche jambon');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_recette`
--

DROP TABLE IF EXISTS `ingredient_recette`;
CREATE TABLE IF NOT EXISTS `ingredient_recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_recette` int NOT NULL,
  `fk_ingredient` int NOT NULL,
  `quantite` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ingredient_recette`
--

INSERT INTO `ingredient_recette` (`id`, `fk_recette`, `fk_ingredient`, `quantite`) VALUES
(1, 5, 1, '50g'),
(2, 5, 2, '150g'),
(3, 5, 3, '50g'),
(4, 5, 4, '1 cuillère à soupe'),
(5, 5, 5, '1 mesure'),
(6, 5, 6, '1 cuillère à soupe'),
(7, 6, 7, '130g'),
(8, 6, 8, '80g'),
(9, 6, 9, '40g'),
(10, 6, 10, '150g'),
(11, 6, 11, NULL),
(12, 6, 12, '1 cuillère à soupe'),
(13, 10, 17, '100g'),
(14, 10, 18, '20g'),
(15, 10, 4, '1 cuillère à café'),
(16, 10, 6, 'Une pincée'),
(17, 7, 13, '1'),
(18, 7, 3, '70g'),
(19, 7, 15, '20g'),
(20, 7, 14, '20g'),
(21, 7, 16, '1 cuillère à soupe'),
(22, 9, 7, '80g'),
(23, 9, 1, '20g'),
(24, 9, 19, '1 cuillère à soupe'),
(25, 8, 20, '70g'),
(26, 8, 21, '30g'),
(27, 8, 22, '30g'),
(32, 14, 23, '150g'),
(33, 14, 24, '1'),
(34, 14, 25, '1'),
(35, 14, 26, 'Une pincée'),
(36, 16, 27, '2 cuillères à soupe'),
(37, 16, 28, 'quelques'),
(38, 16, 9, '1 pot'),
(39, 15, 29, '1'),
(40, 15, 30, '100g'),
(41, 15, 0, '1 cuillère à café'),
(42, 2, 2, 'un petit morceau'),
(43, 2, 6, '1/2'),
(44, 2, 31, '2 cuillères à soupe'),
(45, 3, 32, NULL),
(46, 3, 33, '50ml'),
(47, 3, 34, 'Une pincée'),
(48, 4, 35, '2'),
(49, 4, 9, '1 cuillère à soupe'),
(50, 17, 9, '3 cuillère à soupe'),
(51, 17, 35, '2 à 3'),
(52, 17, 36, 'Une pincée'),
(53, 18, 37, '1'),
(54, 18, 25, '1'),
(55, 18, 27, '2 cuillère à soupe'),
(56, 18, 38, '100g'),
(57, 18, 39, '1/2 cuillère à café'),
(58, 12, 46, NULL),
(59, 12, 33, NULL),
(60, 11, 47, '1'),
(61, 11, 25, '1'),
(62, 11, 45, '100g'),
(63, 11, 12, '1 cuillère à café'),
(64, 11, 41, '1');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id_recette` int NOT NULL AUTO_INCREMENT,
  `nom_recette` varchar(50) NOT NULL,
  `contenu_recette` text NOT NULL,
  `image_recette` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `temps` int NOT NULL,
  `categorie_recette` varchar(20) NOT NULL,
  `fk_utilisateur` int NOT NULL,
  `animal` varchar(5) NOT NULL,
  `niveau` int NOT NULL,
  PRIMARY KEY (`id_recette`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id_recette`, `nom_recette`, `contenu_recette`, `image_recette`, `temps`, `categorie_recette`, `fk_utilisateur`, `animal`, `niveau`) VALUES
(1, 'Gâteau aux fruits rouges', 'Épluchez d’abord la carotte puis râpez-la. Pelez la banane et découpez-la en de petits morceaux, que vous ajoutez à la carotte râpée. Prenez les deux œufs, séparez les blancs des jaunes et ajoutez les jaunes au mélange banane/carotte. Mélangez bien.\r\n\r\nFaites tiédir l’huile de coco afin qu’elle se fluidifie et mélangez-y les drops de chocolat sans cacao pour chien. Ajoutez le mélange huile de coco/chocolat à la préparation banane/carotte/jaune d’œuf.\r\n\r\nIncorporez ensuite la farine de millet. Mélangez encore le tout jusqu’à obtenir une belle pâte.\r\n\r\nRépartissez la pâte dans deux petits moules ronds à bords amovibles, l’un de 12 cm de diamètre, l’autre de 8 cm de diamètre. Dans l’idéal, utilisez deux moules de diamètres différents afin de pouvoir superposer les deux couches de gâteau, comme une pièce montée. N’oubliez pas de graisser les formes avec un peu d’huile de coco au préalable.\r\n\r\nFaites cuire les deux gâteaux pour chien à 180 degrés chaleur tournante, pendant 35 minutes.\r\n\r\nSortez ensuite les gâteaux du four et laissez-les refroidir. Pendant ce temps, préparez la crème.\r\n\r\nRéchauffez légèrement l’huile de coco pour la fluidifier. Ajoutez-y ensuite le fromage blanc et le jaune d’œuf puis mélangez bien.\r\n', 'fruit_rouge.png', 60, 'dessert', 0, 'chien', 2),
(2, 'Mousse au fromage blanc', 'Dans un petit bol, fouettez le fromage blanc pour le rendre bien lisse.\r\n\r\nIncorporez délicatement les miettes de poulet.\r\n\r\nSaupoudrez la levure de bière sur le dessus juste avant de servir (cela donne un petit goût de fromage dont les chats sont fous).\r\n', 'mousse.jpg', 5, 'dessert', 0, 'chat', 1),
(3, 'Glace à la Mer', 'Mélangez le jus de thon et l\'eau pour diluer légèrement les arômes.\r\n\r\nVersez le mélange dans un bac à glaçons (ne remplissez les alvéoles qu\'à moitié pour faire de petites portions).\r\n\r\nSaupoudrez un peu d\'herbe à chat dans chaque alvéole.\r\n\r\nPlacez au congélateur.\r\n\r\nSortez un glaçon et placez-le dans une coupelle : votre chat va s\'amuser à le lécher au fur et à mesure qu\'il fond.\r\n', NULL, 5, 'dessert', 0, 'chat', 1),
(4, 'Délices de Fraise au Yaourt', 'Lavez la fraise et retirez la queue verte.\r\n\r\nÉcrasez la fraise à la fourchette jusqu\'à obtenir une purée sans gros morceaux.\r\n\r\nMélangez la purée de fraise avec le yaourt grec.\r\n\r\nServez immédiatement en petite portion.\r\n', 'yaourt.png', 10, 'dessert', 0, 'chat', 1),
(5, 'Le poulet haricots', 'Faire cuire le riz jusqu’à ce qu’il soit très collant, puis rincez le bien. \r\n\r\nFaites blanchir les légumes coupés en tout petits morceaux, ils doivent s’écraser facilement. \r\n\r\nJuste avant la fin de cuisson des légumes, vous pouvez ajouter le poulet haché pour qu’il cuise légèrement. \r\n\r\nMélangez le tout, vous pouvez éventuellement mixer si jamais votre chien fait des difficultés au début. \r\n\r\nAjoutez les compléments vitaminés.', NULL, 30, 'plat', 0, 'chien', 2),
(6, 'Saumon sauvage', 'Préparez vos épinards (faites les cuire si nécessaire ou les faire fondre dans une casserole avec un verre d’eau). \r\n\r\nFaites cuire le riz selon les indications de votre paquet. \r\n\r\nPendant ce temps, découpez votre saumon et ajoutez-le dans l’eau bouillante (ainsi que vos petites crevettes préalablement décortiquées). \r\n\r\nPour réaliser la sauce qui va bien avec, délayez le yaourt dans un bol avec le persil mixé et l’huile. \r\n\r\nEssorez le riz, le saumon puis incorporez les épinards en mélangeant le tout. \r\n\r\nDressez la gamelle de votre chien et posez délicatement sur votre préparation culinaire la sauce blanche. ', 'saumon.png', 35, 'plat', 0, 'chien', 3),
(7, 'Bœuf carotte mijoté', 'Épluchez vos carottes, lavez-les et coupez-les en petits dés. \r\n\r\nFaites de même avec les haricots. \r\n\r\nPlongez vos légumes découpés dans l’eau bouillante ainsi que le riz. \r\n\r\nSur la fin de la cuisson, ajoutez la viande et retirez votre casserole du feu. \r\n\r\nÉgouttez si nécessaire, vous devez garder un peu d’eau de cuisson. \r\n\r\nAjoutez la touche finale en versant une bonne cuillère à soupe d’huile de saumon.', 'boeuf_carotte.png', 25, 'plat', 0, 'chien', 1),
(8, 'Pâté de foie', 'Faites bouillir le poulet et les foies de volaille pendant 15 minutes.\r\n\r\nPendant ce temps, préparez une purée de potiron bien lisse (sans sel ni beurre).\r\n\r\nHachez finement les viandes cuites.\r\n\r\nMélangez la viande à la purée de potiron jusqu\'à obtenir une texture de pâtée.\r\n\r\nLaissez refroidir complètement.\r\n', 'foie.png', 25, 'plat', 0, 'chat', 2),
(9, 'Poisson Rose', 'Faites cuire le riz dans un grand volume d\'eau jusqu\'à ce qu\'il soit très tendre (surcuisson conseillée pour la digestion du chat).\r\n\r\nPochez le poisson à l\'eau ou à la vapeur sans aucun ajout de sel.\r\n\r\nVérifiez minutieusement l\'absence d\'arêtes.\r\n\r\nÉmiettez le poisson à la fourchette et mélangez-le au riz avec un peu de jus de cuisson pour l\'hydratation.\r\n', NULL, 15, 'plat', 0, 'chat', 1),
(10, 'Mijoté de poulet', 'Coupez le poulet en tout petits dés adaptés à la mâchoire de votre chat.\r\n\r\nRâpez finement la courgette.\r\n\r\nFaites cuire le poulet et la courgette à la vapeur ou à l\'eau bouillante pendant environ 10 minutes.\r\n\r\nÉgouttez le tout et laissez tiédir.\r\n\r\nAjoutez l\'huile de colza et mélangez bien avant de servir.\r\n', 'mijote_poulet.webp', 20, 'plat', 0, 'chat', 1),
(11, 'Friandise au jambon', 'Préchauffez le four à 180°C pendant 10 minutes.\r\nMixez la tranche de jambon afin qu\'elle soit bien moulinée.\r\nDans le bol, ajoutez le jambon mouliné, le lait, l’œuf, la farine et l\'huile d\'olive.\r\n\r\nMélangez jusqu\'à l\'obtention d\'une boule de pâte.\r\n\r\nSaupoudrez le plan de travail de farine et déposez la boule de pâte.\r\nÉtalez la pâte à l\'aide d\'un rouleau à pâtisserie.\r\n\r\nCoupez les friandises avec l\'emporte-pièce et déposez-les sur le papier sulfurisé.\r\n\r\nCuire les friandises pendant 20 minutes à 180 C° au four à chaleur tournante.\r\n', 'friandise_jambon.webp', 40, 'snack', 0, 'chat', 1),
(12, 'Glaçons au thon', 'Ajoutez le thon et un verre d\'eau dans le mixeur.\r\n\r\nMixez.\r\n\r\nVersez la préparation dans le moule à glaçons.\r\n\r\nPlacez les glaçons au thon au congélateur pendant au moins 3 heures.\r\n', 'glacon-thon.webp', 10, 'snack', 0, 'chat', 1),
(14, 'Biscuit pomme canelle', 'Préchauffez votre four à 180°C.\r\n\r\nRâpez finement la pomme (après avoir retiré le trognon et les pépins).\r\n\r\nDans un saladier, mélangez la farine, l\'œuf et la pomme râpée jusqu\'à obtenir une pâte ferme.\r\n\r\nÉtalez la pâte sur un plan de travail fariné et découpez des formes à l\'emporte-pièce.\r\n\r\nEnfournez sur une plaque pendant 25 à 30 minutes jusqu\'à ce qu\'ils soient bien secs.\r\n\r\nLaissez refroidir complètement pour qu\'ils durcissent.\r\n', 'biscuit_pomme.jpg', 40, 'snack', 0, 'chien', 1),
(15, 'Bouchées de patate douce', 'Faites cuire la patate douce à l\'eau ou à la vapeur jusqu\'à ce qu\'elle soit très tendre. Retirez la peau.\r\n\r\nÉcrasez la chair en purée lisse.\r\n\r\nMixez légèrement les flocons d\'avoine pour en faire une poudre grossière et ajoutez-les à la purée avec l\'huile de coco.\r\n\r\nFormez de petites boules avec vos mains.\r\n\r\nPlacez-les sur une plaque de four et aplatissez-les légèrement avec une fourchette.\r\n\r\nFaites cuire 15 minutes à 170°C. Ces snacks restent un peu moelleux à l\'intérieur.\r\n', 'patate_douce.webp', 50, 'snack', 0, 'chien', 2),
(16, 'Glace', 'Mélangez le yaourt et le beurre de cacahuète dans un bol jusqu\'à obtenir une texture homogène.\r\n\r\nDéposez une myrtille au fond de chaque alvéole d\'un moule à glaçons ou d\'un moule en silicone.\r\n\r\nVersez le mélange par-dessus.\r\n\r\nPlacez au congélateur pendant au moins 4 heures.\r\n\r\nDémoulez et donnez un glaçon à la fois à votre chien.\r\n', 'glace_bdc.webp', 5, 'snack', 0, 'chien', 1),
(17, 'Puppuccino', 'Écrasez les fruits rouges à la fourchette jusqu\'à obtenir un coulis épais.\r\n\r\nDans un petit verre ou un bol, déposez le yaourt grec.\r\n\r\nVersez le coulis de fruits par-dessus et mélangez légèrement pour créer un effet marbré.\r\n\r\nSaupoudrez avec un tout petit peu de noix de coco râpée pour la décoration et le goût.\r\n\r\nServez immédiatement.\r\n', 'puppucino.webp', 5, 'dessert', 0, 'chien', 1),
(18, 'Muffins Banane', 'Préchauffez votre four à 180°C.\r\n\r\nDans un saladier, écrasez la banane en purée lisse.\r\n\r\nAjoutez l\'œuf et le beurre de cacahuète, puis mélangez bien.\r\n\r\nIncorporez la farine et la levure jusqu\'à obtenir une pâte homogène.\r\n\r\nRépartissez la pâte dans des moules à mini-muffins (graissés avec un peu d\'huile de coco si nécessaire).\r\n\r\nEnfournez pendant 15 à 20 minutes.\r\n\r\nLaissez refroidir complètement avant de donner un muffin à votre chien (la mie chaude peut être indigeste).\r\n', 'muffin_banane.jpg', 30, 'dessert', 0, 'chien', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(100) NOT NULL,
  `prenom_utilisateur` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `numero_utilisateur` int NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail`, `numero_utilisateur`, `pseudo`, `password`) VALUES
(1, 'Dupont', 'Nicolat', 'nico@gmail.fr', 123456789, 'Nichocolat', '$2y$10$81MpiUrOG70s1PQdDUCZ5O7KI9.pyD/6dDY.US9SPEj7HYF8stf1O');

-- --------------------------------------------------------

--
-- Structure de la table `veterinaires`
--

DROP TABLE IF EXISTS `veterinaires`;
CREATE TABLE IF NOT EXISTS `veterinaires` (
  `id_veterinaire` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `note` mediumint NOT NULL,
  `image_veterinaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `latitude` bigint NOT NULL,
  `longitude` bigint NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_veterinaire`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `veterinaires`
--

INSERT INTO `veterinaires` (`id_veterinaire`, `prenom`, `nom`, `telephone`, `adresse`, `code_postal`, `ville`, `email`, `note`, `image_veterinaire`, `latitude`, `longitude`, `created_at`) VALUES
(1, 'Leyla', 'Dupont', '+33 1 99 00 12 45', '12 rue des Lilas', 75011, 'Paris', 'leyla.dupont@vetmail.fr', 5, 'leyla.jpeg', 49, 2, '2025-12-17 09:01:00'),
(2, 'Thomas', 'Dupont', '+33 6 99 00 01 23', '8 rue Lepic', 75018, 'Paris', 'thomas.martin@vetmail.fr', 4, 'thomas.webp', 0, 0, '2025-12-17 09:01:00'),
(3, 'Camille', 'Rousseau', '+33 2 99 00 55 88', '25 avenue du Parc', 69006, 'Lyon', 'camille.rousseau@vetmail.fr', 5, 'camille.jpg', 46, 5, '0000-00-00 00:00:00'),
(4, 'Nicolas', 'Bernard', '+33 6 99 00 88 99', '4 place Bellecour', 69002, 'Lyon', 'nicolas.bernard@vetmail.fr', 4, 'nicolas.jpg', 46, 5, '0000-00-00 00:00:00'),
(5, 'Sarah', 'Morel', '+33 4 99 00 77 44', '18 rue Gambetta', 31000, 'Toulouse', 'sarah.morel@vetmail.fr', 4, 'sarah.jpg', 44, 1, '0000-00-00 00:00:00'),
(6, 'Julien', 'Faure', '+33 9 99 00 22 33', '6 rue des Carmes', 31000, 'Toulouse', 'julien.faure@vetmail.fr\r\n', 4, 'julien.avif', 44, 1, '0000-00-00 00:00:00'),
(7, 'Elodie', 'Joie', '+33 6 99 00 45 67', '40 rue Gambetta', 33000, 'Bordeaux', 'elodie.joie@vetmail.fr', 5, 'elodie.avif', 45, -1, '0000-00-00 00:00:00'),
(8, 'Maxime', 'Petit', '+33 7 00 00 44 55', '9 quai des Chartrons', 33300, 'Bordeaux', 'maxime.petit@vetmail.fr', 5, 'maxime.avif', 45, -1, '0000-00-00 00:00:00'),
(9, 'Anna', 'Garnier', '+33 3 99 00 33 21', '22 boulevard de la Liberté', 35000, 'Rennes', 'anna.garnier@vetmail.fr', 4, 'anais.avif', 48, -2, '0000-00-00 00:00:00'),
(10, 'Louis', 'Chevalier', '+33 5 99 00 99 11', '15 rue Saint-Hélier', 35000, 'Rennes', 'louis.chevalier@vetmail.fr\r\n', 5, 'louis.avif', 48, -2, '0000-00-00 00:00:00'),
(11, 'Maya', 'Bruno', '+33 7 00 00 11 22', '30 avenue Jean Médecin', 6000, 'Nice', 'maya.bruno@vetmail.fr', 4, 'maya.jpg', 44, 7, '0000-00-00 00:00:00'),
(12, 'Antoine', 'Marchand', '+33 8 00 99 00 11', '5 quai Lunel', 6300, 'Nice', 'antoine.marchand@vetmail.fr', 4, 'antoine.webp', 44, 7, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `veterinaire_recette`
--

DROP TABLE IF EXISTS `veterinaire_recette`;
CREATE TABLE IF NOT EXISTS `veterinaire_recette` (
  `fk_recette` int NOT NULL,
  `fk_veterinaire` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `veterinaire_recette`
--

INSERT INTO `veterinaire_recette` (`fk_recette`, `fk_veterinaire`) VALUES
(1, 2),
(2, 3),
(4, 5),
(5, 7),
(6, 1),
(7, 11),
(8, 10),
(9, 4),
(10, 6),
(11, 8),
(12, 9),
(13, 12),
(14, 1),
(15, 2),
(16, 3),
(17, 4),
(18, 5),
(6, 6),
(12, 7),
(9, 8),
(4, 9),
(2, 10),
(3, 11),
(1, 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
