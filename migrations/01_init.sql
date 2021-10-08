-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : maria
-- Généré le : mar. 31 août 2021 à 10:27
-- Version du serveur : 10.5.11-MariaDB-1:10.5.11+maria~focal
-- Version de PHP : 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formaflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
                              `IDCOMPETENCE` int(11) NOT NULL,
                              `LIBELLECOMPETENCE` varchar(128) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`IDCOMPETENCE`, `LIBELLECOMPETENCE`) VALUES
                                                                   (1, 'Informatique'),
                                                                   (2, 'NodeJS'),
                                                                   (3, 'Discord'),
                                                                   (4, 'Chat'),
                                                                   (5, 'React'),
                                                                   (6, 'Météo'),
                                                                   (7, 'Sécurité'),
                                                                   (8, 'Data Scientist'),
                                                                   (9, 'MiCode');

-- --------------------------------------------------------

--
-- Structure de la table `developper`
--

CREATE TABLE `developper` (
                              `IDFORMATION` int(11) NOT NULL,
                              `IDCOMPETENCE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `developper`
--

INSERT INTO `developper` (`IDFORMATION`, `IDCOMPETENCE`) VALUES
                                                             (1, 1),
                                                             (1, 2),
                                                             (1, 3),
                                                             (1, 4),
                                                             (2, 5),
                                                             (2, 6),
                                                             (3, 7),
                                                             (3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
                             `IDFORMATION` int(11) NOT NULL,
                             `LIBELLE` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                             `DESCRIPTION` varchar(255) COLLATE utf8_bin DEFAULT NULL,
                             `IDENTIFIANTVIDEO` varchar(255) COLLATE utf8_bin DEFAULT NULL,
                             `VISIBILITEPUBLIC` tinyint(1) DEFAULT 0,
                             `IMAGE` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`IDFORMATION`, `LIBELLE`, `DESCRIPTION`, `IDENTIFIANTVIDEO`, `VISIBILITEPUBLIC`, `IMAGE`) VALUES
                                                                                                                       (1, 'Tutoriel NodeJS : Créer un bot Discord\n', 'On va changer un peu aujourd\'hui et nous allons découvrir comment créer un bot pour l\'application Discord', 'errnVwm_3mI', 1, 'https://i.ytimg.com/vi/errnVwm_3mI/hqdefault.jpg?sqp=-oaymwEcCPYBEIoBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLAv9kRn8Y3KJ6FT-b71l96mBPAYag'),
                                                                                                                       (2, 'Tutoriel ReactNative : Découverte de React Native, App Météo\n', 'React Native vous permet de construire une application mobile native pilotée en JavaScript gràce au framework React \n', 'Y7rbJRjaYCY', 1, 'https://i.ytimg.com/vi/Y7rbJRjaYCY/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLDLqkG91OrKAyKiDZb4dpmQhHrhcA'),
                                                                                                                       (3, 'Micode x Pôle emploi - Les passionnés du numérique - Data Scientist\n', 'Pôle emploi a donné pour mission au youtubeur Micode de partir à la rencontre de 10 experts du numérique. \n', 'dMvvTSUsHvk', 0, 'https://i.ytimg.com/vi/dMvvTSUsHvk/hq720.jpg?sqp=-oaymwEcCOgCEMoBSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLCrN5r4rGzuuYPLuig_VjZoPoP-Sw');

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
                           `IDINSCRIT` int(11) NOT NULL,
                           `NOMINSCRIT` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                           `PRENOMINSCRIT` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                           `EMAILINSCRIT` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                           `MOTPASSEINSCRIT` varchar(128) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `inscrit`
--
-- Mot de passe 123456

INSERT INTO `inscrit` (`IDINSCRIT`, `NOMINSCRIT`, `PRENOMINSCRIT`, `EMAILINSCRIT`, `MOTPASSEINSCRIT`) VALUES
    (1, 'Demo', 'Demo', 'demo@demo.com', '$2y$12$yZhIAqp94LSNLmaEa2Iu8e0iqt5gnkmQQ3gLdDuM0br3WAWPFYn7u');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
                               `IDUTILISATEUR` int(11) NOT NULL,
                               `NOM` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                               `PRENOM` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                               `MOTPASSE` varchar(128) COLLATE utf8_bin DEFAULT NULL,
                               `EMAIL` varchar(128) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `utilisateur` (`IDUTILISATEUR`, `NOM`, `PRENOM`, `MOTPASSE`, `EMAIL`) VALUES
                                                                                      (1, 'autret', 'carine', '$2a$12$mJ7h1.AQewjLxApgFGiMfuYGeXaadSEWm4JRil6HUxpTWgaSuawre', 'carine.autret@gmail.com'),
                                                                                      (2, 'admin', 'admin', '$2a$12$mJ7h1.AQewjLxApgFGiMfuYGeXaadSEWm4JRil6HUxpTWgaSuawre', 'admin@formaflix.fr');
-- Mot de passe ap3
-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
                         `id` int(11) NOT NULL,
                         `name` text DEFAULT NULL,
                         `videoId` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
    ADD PRIMARY KEY (`IDCOMPETENCE`);

--
-- Index pour la table `developper`
--
ALTER TABLE `developper`
    ADD PRIMARY KEY (`IDFORMATION`,`IDCOMPETENCE`),
    ADD KEY `I_FK_DEVELOPPER_FORMATION` (`IDFORMATION`),
    ADD KEY `I_FK_DEVELOPPER_COMPETENCE` (`IDCOMPETENCE`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
    ADD PRIMARY KEY (`IDFORMATION`),
    ADD UNIQUE KEY `IDENTIFIANTVIDEO` (`IDENTIFIANTVIDEO`);

--
-- Index pour la table `inscrit`
--
ALTER TABLE `inscrit`
    ADD PRIMARY KEY (`IDINSCRIT`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    ADD PRIMARY KEY (`IDUTILISATEUR`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `video_id_uindex` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
    MODIFY `IDCOMPETENCE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
    MODIFY `IDFORMATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `inscrit`
--
ALTER TABLE `inscrit`
    MODIFY `IDINSCRIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    MODIFY `IDUTILISATEUR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `developper`
--
ALTER TABLE `developper`
    ADD CONSTRAINT `developper_ibfk_1` FOREIGN KEY (`IDFORMATION`) REFERENCES `formation` (`IDFORMATION`) ON DELETE NO ACTION ON UPDATE CASCADE,
    ADD CONSTRAINT `developper_ibfk_2` FOREIGN KEY (`IDCOMPETENCE`) REFERENCES `competence` (`IDCOMPETENCE`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
