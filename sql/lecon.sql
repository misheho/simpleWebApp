-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 06 Mars 2018 à 23:33
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
-- Structure de la table `lecon`
--

CREATE TABLE IF NOT EXISTS `lecon` (
`ID_LEC` int(6) unsigned NOT NULL,
  `NOM` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DESCR` varchar(240) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LANG` varchar(2) NOT NULL DEFAULT 'fr'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lecon`
--

INSERT INTO `lecon` (`ID_LEC`, `NOM`, `DESCR`, `LANG`) VALUES
(1, 'Animaux', 'Vocabulaire des animaux, phrases et expressions contenants noms des animaux', 'fr'),
(2, 'Transport', 'Tous sur les moyens de transport', 'fr'),
(3, 'Famille', 'Membres de la famille, vie familiale', 'fr');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `lecon`
--
ALTER TABLE `lecon`
 ADD PRIMARY KEY (`ID_LEC`), ADD KEY `NOM` (`NOM`), ADD KEY `ID_LEC` (`ID_LEC`), ADD KEY `ID_LEC_2` (`ID_LEC`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `lecon`
--
ALTER TABLE `lecon`
MODIFY `ID_LEC` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
