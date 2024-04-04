-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 avr. 2024 à 22:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recensement_commune`
--

-- --------------------------------------------------------

--
-- Structure de la table `habitants`
--

CREATE TABLE `habitants` (
  `matricule` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `sexe` enum('Feminin','Masculin') NOT NULL,
  `id_statut` int(11) NOT NULL,
  `id_age` int(11) NOT NULL,
  `id_situation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitants`
--

INSERT INTO `habitants` (`matricule`, `nom`, `prenom`, `sexe`, `id_statut`, `id_age`, `id_situation`) VALUES
(5, 'Diallo', 'Mariama', 'Feminin', 1, 6, 1),
(6, 'Diop', 'Fatou', 'Feminin', 1, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `situation_matrimoniale`
--

CREATE TABLE `situation_matrimoniale` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `situation_matrimoniale`
--

INSERT INTO `situation_matrimoniale` (`id`, `libelle`) VALUES
(1, 'Celibataire'),
(2, 'Marié(e)'),
(3, 'Divorcé(e)'),
(4, 'Veuve/veuf');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`id`, `libelle`) VALUES
(1, 'Civile'),
(2, 'Chef_de_quartier'),
(3, 'Badian_Gokh');

-- --------------------------------------------------------

--
-- Structure de la table `tranches_age`
--

CREATE TABLE `tranches_age` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tranches_age`
--

INSERT INTO `tranches_age` (`id`, `libelle`) VALUES
(6, '1 _ 20 ans'),
(7, '21 _ 40 ans'),
(8, '41 _ 60 ans'),
(9, '61 _ 80 ans'),
(10, '81 _ 100 ans');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `habitants`
--
ALTER TABLE `habitants`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `id_statut` (`id_statut`,`id_age`,`id_situation`),
  ADD KEY `id_age` (`id_age`),
  ADD KEY `id_situation` (`id_situation`);

--
-- Index pour la table `situation_matrimoniale`
--
ALTER TABLE `situation_matrimoniale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tranches_age`
--
ALTER TABLE `tranches_age`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `habitants`
--
ALTER TABLE `habitants`
  MODIFY `matricule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `situation_matrimoniale`
--
ALTER TABLE `situation_matrimoniale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tranches_age`
--
ALTER TABLE `tranches_age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `habitants`
--
ALTER TABLE `habitants`
  ADD CONSTRAINT `habitants_ibfk_1` FOREIGN KEY (`id_age`) REFERENCES `tranches_age` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `habitants_ibfk_2` FOREIGN KEY (`id_situation`) REFERENCES `situation_matrimoniale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `habitants_ibfk_3` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
