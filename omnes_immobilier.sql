-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 juin 2024 à 12:32
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `omnes_immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `agents_immobilier`
--

DROP TABLE IF EXISTS `agents_immobilier`;
CREATE TABLE IF NOT EXISTS `agents_immobilier` (
  `Nom_prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Courriel` varchar(255) NOT NULL,
  `téléphone` int NOT NULL,
  `ID` int NOT NULL,
  `Spécialité` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  KEY `fk_user_id` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agents_immobilier`
--

INSERT INTO `agents_immobilier` (`Nom_prenom`, `Courriel`, `téléphone`, `ID`, `Spécialité`, `Description`) VALUES
('Dupont Marie', 'marie.dupont@exemple.com', 612345678, 1, 'Immobilier résidentiel', ''),
('Martin Jean', 'jean.martin@exemple.com', 698765432, 2, 'Immobilier commercial', ''),
('Bernard Sophie', 'sophie.bernard@exemple.com', 623456789, 3, 'Terrain', ''),
('Moreau Pierre', 'pierre.moreau@exemple.com', 687654321, 4, 'Appartement à louer', ''),
('Lefevre Emma', 'emma.lefevre@exemple.com', 654321098, 5, 'Appartement à louer', ''),
('', '', 0, 18, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `coordonnees`
--

DROP TABLE IF EXISTS `coordonnees`;
CREATE TABLE IF NOT EXISTS `coordonnees` (
  `Nom et Prénom` int NOT NULL,
  `Adresse Ligne 1` int NOT NULL,
  `Adresse Ligne 2` int NOT NULL,
  `Ville` int NOT NULL,
  `Code Postal` int NOT NULL,
  `Pays` int NOT NULL,
  `Numéro de téléphone` int NOT NULL,
  `ID_coordonnees` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_coordonnees`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liste_agents`
--

DROP TABLE IF EXISTS `liste_agents`;
CREATE TABLE IF NOT EXISTS `liste_agents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `a1` int NOT NULL,
  `a2` int NOT NULL,
  `a3` int NOT NULL,
  `a4` int NOT NULL,
  `a5` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `liste_agents`
--

INSERT INTO `liste_agents` (`id`, `a1`, `a2`, `a3`, `a4`, `a5`) VALUES
(1, 1, 2, 3, 5, 4),
(2, 5, 4, 3, 2, 1),
(3, 1, 2, 3, 4, 5),
(4, 1, 2, 3, 4, 5),
(5, 1, 2, 3, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `proprietes`
--

DROP TABLE IF EXISTS `proprietes`;
CREATE TABLE IF NOT EXISTS `proprietes` (
  `ID_propriete` int NOT NULL AUTO_INCREMENT,
  `Agent_ID` int DEFAULT NULL,
  `Adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prix` int NOT NULL,
  `url_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Statut` varchar(50) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `Detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_propriete`),
  KEY `ID` (`Agent_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `proprietes`
--

INSERT INTO `proprietes` (`ID_propriete`, `Agent_ID`, `Adresse`, `Ville`, `Prix`, `url_image`, `Statut`, `Nom`, `Categorie`, `Detail`) VALUES
(5, 1, '123 Rue de Rivoli', 'Paris', 750000, './maisons/rivoli.jpg', 'à louer', 'Maison rivoli', 'Immobilier résidentiel', 'Découvrez cet élégant appartement de 150 m² situé dans un immeuble prestigieux en plein centre-ville. Offrant une vue panoramique sur la skyline, ce bien exceptionnel se compose de trois chambres spacieuses, d\'un grand salon lumineux avec des baies vitrée'),
(4, 2, '789 Rue de la République', 'Lyon', 600000, './maisons/republique.jpg', 'à vendre', 'Appartement République', 'Immobilier commercial', 'Situé dans un quartier résidentiel paisible, cet appartement de 100 m² est idéal pour une famille. Il comprend trois chambres, une cuisine équipée avec coin repas, un grand salon avec balcon, et une salle de bains avec baignoire. Les pièces sont bien agen'),
(3, 3, '202 Rue Paradis', 'Marseille', 500000, './maisons/paradis.jpg', 'à louer', 'Appartement parisien', 'Appartement à louer', 'Parfait pour un étudiant, ce studio de 25 m² a été récemment rénové et est prêt à emménager. Il dispose d\'une pièce principale avec un coin nuit, un espace de travail, une kitchenette équipée et une salle d\'eau avec douche. Situé à deux pas de l\'universit'),
(2, 4, '404 Rue de Metz', 'Toulouse', 650000, './maisons/metz.jpg', 'à vendre', 'Appartement Toulouse', 'Immobilier résidentiel', 'Vivez l\'exception dans cet appartement de 90 m² doté d\'une terrasse de 20 m² offrant une vue dégagée sur la ville et ses alentours. Composé de deux chambres, d\'un séjour lumineux, d\'une cuisine moderne et d\'une salle de bains élégante, cet espace de vie e'),
(1, 5, '606 Rue de France', 'Nice', 780000, './maisons/rue_de_france.jpg', 'à vendre', 'Appartement centre Paris', 'Immobilier commercial', 'Vivez l\'exception dans cet appartement de 90 m² doté d\'une terrasse de 20 m² offrant une vue dégagée sur la ville et ses alentours. Composé de deux chambres, d\'un séjour lumineux, d\'une cuisine moderne et d\'une salle de bains élégante, cet espace de vie e');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `ID_rdv` int NOT NULL AUTO_INCREMENT,
  `ID_user` int DEFAULT NULL,
  `jour` varchar(255) NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`ID_rdv`),
  KEY `fk_user` (`ID_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mdp` varchar(255) NOT NULL,
  `permission` int NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mdp`, `permission`, `adresse`, `nom`, `prenom`, `email`) VALUES
(14, '1234', 0, '3 avenue ', 'Drochon', 'Paul', 'paul.drochon@gmail.com'),
(15, '1234', 0, 'Bussy', 'Siritham', 'Evan', 'Evan'),
(16, '1234', 2, 'St ger', 'Quaranta', 'Benoit', 'Benoit'),
(17, '1234', 1, 'Paris', 'Bricout', 'Theo', 'Theo'),
(18, '1234', 1, 'Paris', 'Bricout', 'Theo', 'Theo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
