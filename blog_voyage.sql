-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 02 fév. 2023 à 13:52
-- Version du serveur : 10.10.2-MariaDB
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_voyage`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `titre` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_utilisateur` (`id_utilisateur`),
  UNIQUE KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cat_art`
--

DROP TABLE IF EXISTS `cat_art`;
CREATE TABLE IF NOT EXISTS `cat_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_art` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_cat` (`id_cat`),
  UNIQUE KEY `id_art` (`id_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_article` (`id_article`),
  UNIQUE KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`, `id_utilisateur`) VALUES
(19, 'admin', 32),
(20, 'membre', 33),
(21, 'admin', 34),
(22, 'membre', 35),
(23, 'membre', 36),
(24, 'admin', 37),
(25, 'membre', 38),
(26, 'admin', 39),
(27, 'admin', 40),
(28, 'membre', 41),
(29, 'admin', 42),
(30, 'membre', 43),
(31, 'membre', 44);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`) VALUES
(32, 'armin', 'e4f3e01bcd95f4152cdb512d7c4dcbc23c58be5478ad4b', 'sq'),
(33, 'aa', 'e4fb19ac43f5c892279f07502d4ae18f809b3cf208ed4b', 'aa@aa.aa'),
(34, 'aa', 'e4f6f748402441bbeb0832b4b95d0843aee3aa3f7f6d4b', 'aa@zz.zz'),
(35, 'admin', 'e4f12da5dc841a47dc13e0c2923c859eaab93c6cd68d4b', 'aa@zz.bbb'),
(36, 'test', 'e4f0919441e079e04e4504e1ace46cb5be4c5662f42d4b', 'test@ss.ss'),
(37, 'aa', 'e4f1cf19e21e3433374149f8cac173aa6af1c727dcfd4b', 'aa@zz.sssq'),
(38, 'admin', 'e4f4e15050f4ec70af08af17eeb1fa9f9b06a83a9e6d4b', 'qq@ww.uu'),
(39, 'nouveladmin', 'e4fa6dd8d7e9fd510883c5e2602a75f8e81671e613cd4b', 'qq@po.ui'),
(40, 'alal', 'e4f5ad3df62dd40cef964cd4e5d116b88f5a944805dd4b', 'alala@aa.aa'),
(41, 'aa', 'e4f62f77152f5f843091e1013214eb8054591917312d4b', 'lolo@aa.aa'),
(42, 'tomy', 'e4f488014676aeb3ff3b93c588c35d2e75a54a8ccb6d4b', 'qs@wxs.qz'),
(43, 'aa', 'e4fa0a243467a19eee94f25614618458689b1e0063bd4b', 'zz@zz.zz'),
(44, 'alfred', 'e4fa0a243467a19eee94f25614618458689b1e0063bd4b', 'zz@ds.dr');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cat_art`
--
ALTER TABLE `cat_art`
  ADD CONSTRAINT `cat_art_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat_art_ibfk_2` FOREIGN KEY (`id_art`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `droits`
--
ALTER TABLE `droits`
  ADD CONSTRAINT `droits_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
