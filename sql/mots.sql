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
-- Structure de la table `mots`
--

CREATE TABLE IF NOT EXISTS `mots` (
`ID_MOT` int(30) unsigned NOT NULL,
  `ID_CONCEPT` int(30) unsigned DEFAULT NULL,
  `ID_LEC` int(6) unsigned DEFAULT NULL,
  `LABEL` varchar(250) NOT NULL,
  `LANG` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `PRON` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `ATTRIBUT_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ATTRIBUT_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ATTRIBUT_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mots`
--

INSERT INTO `mots` (`ID_MOT`, `ID_CONCEPT`, `ID_LEC`, `LABEL`, `LANG`, `PRON`, `ATTRIBUT_1`, `ATTRIBUT_2`, `ATTRIBUT_3`) VALUES
(84, 1, 1, 'dog', 'en', '/dɒɡ/', 'nom', 'n', 'sg.'),
(87, 1, 1, 'chien', 'fr', '/ ʃjɛ̃/', 'nom', 'm', 'sg.'),
(88, 2, 1, 'cat', 'en', '/kÃ¦t/', 'nom', 'n', 'sg.'),
(89, 2, 1, 'chat', 'fr', '/Êƒa/', 'nom', 'm', 'sg.'),
(90, 3, 1, 'horse', 'en', '/hÉ”Ë(r)s/', 'nom', 'n', 'sg.'),
(91, 3, 1, 'cheval', 'fr', '/ÊƒÉ™.val/', 'nom', 'm', 'sg.'),
(92, 4, 2, 'car', 'en', ' /kÉ‘Ë(r)/', 'nom', 'n', 'sg.'),
(93, 4, 2, 'voiture', 'fr', '/vwa.tyÊ/', 'nom', 'f', 'sg.'),
(94, 5, 2, 'bus', 'en', '/bÊŒs/', 'nom', 'n', 'sg.'),
(95, 5, 2, 'bus', 'fr', '/bys/', 'nom', 'm', 'sg.'),
(96, NULL, 1, 'Raining cats and dogs.', 'en', NULL, NULL, NULL, NULL),
(97, NULL, 1, 'That dog wonâ€™t hunt.', 'en', NULL, NULL, NULL, NULL),
(99, NULL, 2, 'He was quite content sitting on the bus, reading his paper and soaking up the atmosphere.', 'en', NULL, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `mots`
--
ALTER TABLE `mots`
 ADD PRIMARY KEY (`ID_MOT`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `mots`
--
ALTER TABLE `mots`
MODIFY `ID_MOT` int(30) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
