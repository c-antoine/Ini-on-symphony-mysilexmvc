-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 07 nov. 2017 à 14:42
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `links`
--

INSERT INTO `links` (`id`, `id_user`, `id_pc`) VALUES
(8, 12, 15);

-- --------------------------------------------------------

--
-- Structure de la table `pcs`
--

CREATE TABLE `pcs` (
  `id` int(11) NOT NULL,
  `vendeur` varchar(150) NOT NULL,
  `os` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pcs`
--

INSERT INTO `pcs` (`id`, `vendeur`, `os`) VALUES
(1, 'ASUS', 'LINUX'),
(2, 'HP', 'Microsoft 7.78');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`) VALUES
(2, 'Darmond', 'Gérard'),
(1, 'De Funes', 'Louis');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD KEY `id` (`id`);

--
-- Index pour la table `pcs`
--
ALTER TABLE `pcs`
  ADD KEY `id` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `pcs`
--
ALTER TABLE `pcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
