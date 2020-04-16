-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 avr. 2020 à 15:32
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`) VALUES
(1, 'lotfi', 'La premiere nouvelle ', 'salut a tous c\'est aujourd\'hui que je crée mon premier projet en pdo ', '2020-04-16 00:00:00', '2020-04-16 00:00:00'),
(2, 'news 2', 'la news 2', 'la news 2', '2020-04-16 00:00:00', '2020-04-16 00:00:00'),
(3, 'news 3', 'news 3 ', 'news 3 c\'est de la bombe', '2020-04-16 00:00:00', '2020-04-16 00:00:00'),
(4, 'news 4', 'news 4 ', 'news 4', '2020-04-16 00:00:00', '2020-04-16 00:00:00'),
(5, 'news 5 ', 'news 5 ', 'news 5 ', '2020-04-16 00:00:00', '2020-04-16 00:00:00'),
(6, 'news 7', 'news 7', 'news 7', '2020-04-16 00:00:00', '2020-04-16 15:03:23'),
(7, 'news 8', 'news 8', 'news8', '2020-04-16 15:05:45', '2020-04-16 15:05:45'),
(12, 'news 11', 'news 11', '<div><strong>bienvenue dans la news n&deg;11</strong></div>', '2020-04-16 16:13:18', '2020-04-16 17:17:37'),
(11, 'news 9', 'ajout d\'un editeur ', '<div><strong>sssssssssss</strong></div>', '2020-04-16 16:09:57', '2020-04-16 16:09:57'),
(13, 'news 12', 'news 12', '<h1 style=\"text-align: left;\"><span style=\"font-size: 36pt; color: #e03e2d;\"><strong>news 12</strong></span></h1>', '2020-04-16 16:56:56', '2020-04-16 17:19:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
