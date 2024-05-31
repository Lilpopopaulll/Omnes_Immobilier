-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 mai 2024 à 22:31
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
  `Numéro de téléphone` int NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `Spécialité` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agents_immobilier`
--

INSERT INTO `agents_immobilier` (`Nom_prenom`, `Courriel`, `Numéro de téléphone`, `ID`, `Spécialité`, `Description`) VALUES
('Dupont Marie', 'marie.dupont@exemple.com', 612345678, 1, 'Immobilier résidentiel', ''),
('Martin Jean', 'jean.martin@exemple.com', 698765432, 2, 'Immobilier commercial', ''),
('Bernard Sophie', 'sophie.bernard@exemple.com', 623456789, 3, 'Terrain', ''),
('Moreau Pierre', 'pierre.moreau@exemple.com', 687654321, 4, 'Appartement à louer', ''),
('Lefevre Emma', 'emma.lefevre@exemple.com', 654321098, 5, 'Appartement à louer', '');

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
-- Structure de la table `proprietes`
--

DROP TABLE IF EXISTS `proprietes`;
CREATE TABLE IF NOT EXISTS `proprietes` (
  `ID_propriete` int NOT NULL AUTO_INCREMENT,
  `Agent_ID` int DEFAULT NULL,
  `Adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prix` int NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Statut` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_propriete`),
  KEY `ID` (`Agent_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `proprietes`
--

INSERT INTO `proprietes` (`ID_propriete`, `Agent_ID`, `Adresse`, `Ville`, `Prix`, `Image`, `Statut`) VALUES
(1001, 1, '123 Rue de Rivoli', 'Paris', 750000, 'rivoli.jpg', 'à louer'),
(2057, 2, '789 Rue de la République', 'Lyon', 600000, 'republique.jpg', 'à vendre'),
(3089, 3, '202 Rue Paradis', 'Marseille', 500000, 'paradis.jpg', 'à louer'),
(4123, 4, '404 Rue de Metz', 'Toulouse', 650000, 'metz.jpg', 'à vendre'),
(5176, 5, '606 Rue de France', 'Nice', 780000, 'rue_de_france.jpg', 'à vendre');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `ID_rdv` int NOT NULL AUTO_INCREMENT,
  `Lundi` time NOT NULL,
  `Mardi` time NOT NULL,
  `Mercredi` time NOT NULL,
  `Jeudi` time NOT NULL,
  `Vendredi` time NOT NULL,
  `Samedi` time NOT NULL,
  `ID_user` int DEFAULT NULL,
  PRIMARY KEY (`ID_rdv`),
  KEY `fk_user` (`ID_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mdp`, `permission`, `adresse`, `nom`, `prenom`) VALUES
(1, '1234', 3, '', '', ''),
(2, '', 0, '', '', ''),
(3, 'de', 0, 'de', 'de', 'de'),
(4, 'de', 0, 'dede', 'de', 'dedd'),
(5, 'dzdz', 0, 'dzdz', 'dzd', 'dzd'),
(6, 'dz', 0, 'dz', 'dz', 'dzdz'),
(7, 'de', 0, 'de', 'de', 'Evan'),
(8, 'fe', 0, 'fe', 'fe', 'efe'),
(9, '1234', 0, 'Theo', 'de', 'Theo'),
(10, '1234', 0, 'Evan', 'de', 'Evan'),
(11, 'dede', 0, 'de', 'de', 'Evan'),
(12, '1234', 0, 'de', 'de', 'Herve');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
