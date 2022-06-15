-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 15 juin 2022 à 15:13
-- Version du serveur : 10.8.3-MariaDB-1:10.8.3+maria~jammy
-- Version de PHP : 8.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

CREATE TABLE `administration` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id`, `login`, `mdp`) VALUES
(1, 'Admin', '$2y$10$/zLPk4n4k3BPqxvIhrM0JeEeCcRPlBQkqhxs3p.0QE1lMTvXsosiu');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`id`, `nom`, `login`, `mdp`) VALUES
(1, 'RT', 'Gestio-1', '$2y$10$zZGc6QOUkgnOiZydaDyLV.0ILINAC5h0t9idYDg4tI0Qv9z9ksZHq'),
(2, 'CS', 'Gestio-2', '$2y$10$n7ZbPU6rvsw5HIyvZNHuPOqq3mmYC3DoS1yoFBb48h4kDDvad87Qy'),
(3, 'GIM', 'Gestio-3', '$2y$10$jIU4s5RdCJjVZGAWY2jTt.kf9loNyFPqDCUE9r35j6Q/c16bmOErm');

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

CREATE TABLE `capteur` (
  `id` int(11) NOT NULL,
  `salle` text NOT NULL,
  `etage` int(11) NOT NULL,
  `type` text NOT NULL,
  `batiment` int(11) NOT NULL,
  `topic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id`, `salle`, `etage`, `type`, `batiment`, `topic`) VALUES
(1, 'E001', 0, 'temperature', 1, 'iut/RT/etage0/E001/temperature'),
(2, 'E001', 0, 'co2', 1, 'iut/RT/etage0/E001/co2'),
(3, 'E101', 1, 'temperature', 2, 'iut/CS/etage1/E101/temperature'),
(4, 'E202', 2, 'co2', 3, 'iut/GIM/etage1/E202/co2'),
(5, 'E102', 1, 'temperature', 1, 'iut/GIM/etage1/E102/temperature'),
(6, 'E102', 1, 'co2', 1, 'iut/GIM/etage1/E102/co2'),
(9, 'E103', 1, 'temperature', 1, 'iut/RT/etage1/E103/temperature'),
(10, 'E103', 1, 'co2', 1, 'iut/RT/etage1/E103/co2'),
(11, 'E202', 2, 'temperature', 3, 'iut/GIM/etage1/E202/temperature'),
(12, 'E101', 1, 'co2', 2, 'iut/CS/etage1/E101/co2'),
(13, 'E203', 2, 'temperature', 2, 'iut/CS/etage2/E203/temperature'),
(14, 'E203', 2, 'co2', 2, 'iut/CS/etage2/E203/co2');

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

CREATE TABLE `mesure` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `valeur`
--

CREATE TABLE `valeur` (
  `id` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  `id_capteur` int(11) NOT NULL,
  `id_mesure` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_batiment` (`batiment`);

--
-- Index pour la table `mesure`
--
ALTER TABLE `mesure`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `valeur`
--
ALTER TABLE `valeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mesure` (`id_mesure`),
  ADD KEY `id_capteur` (`id_capteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `mesure`
--
ALTER TABLE `mesure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `valeur`
--
ALTER TABLE `valeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD CONSTRAINT `id_batiment` FOREIGN KEY (`batiment`) REFERENCES `batiment` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `valeur`
--
ALTER TABLE `valeur`
  ADD CONSTRAINT `id_capteur` FOREIGN KEY (`id_capteur`) REFERENCES `capteur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_mesure` FOREIGN KEY (`id_mesure`) REFERENCES `mesure` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
