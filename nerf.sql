-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 06 jan. 2025 à 15:45
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nerf`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$eL75QtKmJl60LdoLqT.FzeMpWCBrLP.zPNVwbMV5t7DZ1FzZiSY2e', '2025-01-06 14:17:41');

-- --------------------------------------------------------

--
-- Structure de la table `guns`
--

CREATE TABLE `guns` (
  `gun_id` int NOT NULL,
  `gun_image` varchar(255) DEFAULT NULL,
  `gun_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `gun_cadence` decimal(3,2) NOT NULL DEFAULT '0.00',
  `admin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `guns`
--

INSERT INTO `guns` (`gun_id`, `gun_image`, `gun_name`, `description`, `gun_cadence`, `admin_id`) VALUES
(3, 'Nerf_Speedswarm-Photoroom1736173872671.png', 'Speedswarm', 'Dominez vos batailles avec le Nerf Speedswarm, un pistolet automatique compact conçu pour allier rapidité et précision. Avec une cadence de tir fluide et une portée jusqu&#039;à 13,7 mètres, prenez l&#039;avantage à chaque tir.', 0.45, 1),
(5, 'rapidstrike-Photoroom1736173988383.png', 'Rapidstrike', 'Le Nerf Rapidstrike offre une puissance de tir rapide et continue pour des batailles sans fin.', 3.00, 1),
(6, 'rough-cut-300x300-Photoroom1736174014864.png', 'Rough Cut', 'Le Nerf Rough Cut combine puissance et précision dans un design facile à manœuvrer pour des tirs puissants et rapides.', 2.00, 1),
(7, '51N2jvvyqcL-Photoroom1736174050532.png', 'Mega', 'Le Nerf MEGA offre des tirs puissants avec des fléchettes surdimensionnées pour des impacts impressionnants. ', 0.10, 1),
(8, 'nerf-bigshock-768x768-Photoroom1736174082664.png', 'Big Shock', 'Le Nerf Big Shock est un pistolet compact, parfait pour des tirs rapides et puissants.', 1.00, 1),
(9, 'nerf-dart-tag-sharp-shot-Photoroom1736175823839.png', 'Sharp Shot', 'Le Nerf Sharp Shot offre une expérience de jeu dynamique avec une précision accrue et un design adapté aux compétitions.', 0.50, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `guns`
--
ALTER TABLE `guns`
  ADD PRIMARY KEY (`gun_id`),
  ADD UNIQUE KEY `gun_name` (`gun_name`),
  ADD KEY `fk_admin_id` (`admin_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `guns`
--
ALTER TABLE `guns`
  MODIFY `gun_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `guns`
--
ALTER TABLE `guns`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
