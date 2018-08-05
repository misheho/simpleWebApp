-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 06 Mars 2018 à 23:34
-- Version du serveur :  5.5.59-0+deb8u1
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `langues`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_hist`
--

CREATE TABLE IF NOT EXISTS `utilisateur_hist` (
`ID_UT_HIST` int(10) NOT NULL,
  `ID_UT` int(10) NOT NULL,
  `ID_MOT` int(30) NOT NULL,
  `ECHEC` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur_hist`
--

INSERT INTO `utilisateur_hist` (`ID_UT_HIST`, `ID_UT`, `ID_MOT`, `ECHEC`) VALUES
(1, 1, 5, 0),
(14, 1, 4, 0),
(15, 1, 0, 0),
(16, 1, 1, 0),
(17, 1, 2, 0),
(18, 1, 10, 0),
(19, 1, 8, 0),
(20, 1, 11, 1),
(21, 1, 9, 0),
(22, 0, 0, 0),
(23, 1, 16, 1),
(24, 2, 87, 0),
(25, 2, 93, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `utilisateur_hist`
--
ALTER TABLE `utilisateur_hist`
 ADD PRIMARY KEY (`ID_UT_HIST`), ADD UNIQUE KEY `id_ut_id_mot` (`ID_UT`,`ID_MOT`), ADD KEY `ID_UT` (`ID_UT`), ADD KEY `ID_MOT` (`ID_MOT`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utilisateur_hist`
--
ALTER TABLE `utilisateur_hist`
MODIFY `ID_UT_HIST` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
