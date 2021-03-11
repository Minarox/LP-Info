-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 mars 2021 à 22:34
-- Version du serveur :  5.7.31
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hothothot`
--

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

DROP TABLE IF EXISTS `ban`;
CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `attempt` tinyint(4) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ban`
--

INSERT INTO `ban` (`id`, `ip`, `attempt`, `time`) VALUES
(16, '127.0.0.1', 1, 1615414714);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `sensors`
--

DROP TABLE IF EXISTS `sensors`;
CREATE TABLE IF NOT EXISTS `sensors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sensor_data`
--

DROP TABLE IF EXISTS `sensor_data`;
CREATE TABLE IF NOT EXISTS `sensor_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_id` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sensor_id` (`sensor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sensor_types`
--

DROP TABLE IF EXISTS `sensor_types`;
CREATE TABLE IF NOT EXISTS `sensor_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_google` varchar(255) DEFAULT NULL,
  `id_facebook` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT 'https://i.pinimg.com/originals/96/bd/9a/96bd9aac07e756e952c0c96d1a8e84bd.jpg',
  `role_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `last_connexion` timestamp NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `id_google`, `id_facebook`, `last_name`, `first_name`, `email`, `password`, `is_verified`, `avatar`, `role_id`, `token`, `last_connexion`, `created_at`) VALUES
(5, NULL, NULL, 'Finance', 'Aurélien', 'aurelien.finance04@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Ykt2dkVpcUxyajJCTmxSVA$PPPDsy+nA9I9C3kkmLQS+6A5CTV2I6yMO3jXqvKhMRI', 1, 'https://i.pinimg.com/originals/96/bd/9a/96bd9aac07e756e952c0c96d1a8e84bd.jpg', 1, '3ce52435095b35434a361f5605704e6dc7101c414dac75239b5c87c055018c7894b67c73ef62d5da68c096b0e4655c28061607eab284df227ff7b6a44583e6fb', '2021-03-10 09:15:11', '2021-03-10 23:07:22'),
(6, '9223372036854775807', NULL, 'Finance', 'Aurélien', 'af@siweb.fr', NULL, 1, 'https://lh3.googleusercontent.com/-k8o5305-s6Y/AAAAAAAAAAI/AAAAAAAAAAA/AMZuuclvbWo40vqRc-BIw2eeHnT9osi_Tg/s96-c/photo.jpg', 1, '195d742f9ba3a4c21ea037db74037576f6bb38c4f7674391a29f3c6c32470c5ccf288b991d5828299f19cd771ec7bdaaa1f6bbc7c32582ae2476ca6f4cea6b2c', '2021-03-10 09:11:34', '2021-03-10 23:10:48');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `sensor_types` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD CONSTRAINT `sensor_data_ibfk_1` FOREIGN KEY (`sensor_id`) REFERENCES `sensors` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
