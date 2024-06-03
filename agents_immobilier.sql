-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 03 juin 2024 à 07:10
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
('Lefevre Emma', 'emma.lefevre@exemple.com', 654321098, 5, 'Appartement à louer', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
