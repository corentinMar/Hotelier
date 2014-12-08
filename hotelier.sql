-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Décembre 2014 à 20:12
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hotelier`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
`idAdministrateur` int(11) NOT NULL,
  `loginAdministrateur` text NOT NULL,
  `mdpAdministrateur` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`idAdministrateur`, `loginAdministrateur`, `mdpAdministrateur`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `baignoire`
--

CREATE TABLE IF NOT EXISTS `baignoire` (
  `idChambre` int(11) NOT NULL,
`idBaignoire` int(11) NOT NULL,
  `prixBaignoire` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `baignoire`
--

INSERT INTO `baignoire` (`idChambre`, `idBaignoire`, `prixBaignoire`) VALUES
(3, 1, 20),
(5, 2, 20),
(6, 3, 20);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE IF NOT EXISTS `chambre` (
  `idHotel` int(11) NOT NULL,
`idChambre` int(11) NOT NULL,
  `nomChambre` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`idHotel`, `idChambre`, `nomChambre`, `type`) VALUES
(1, 1, 'E100', 1),
(1, 2, 'E101', 1),
(1, 3, 'E102', 2),
(1, 4, 'E201', 1),
(1, 5, 'E202', 2),
(1, 6, 'E103', 1);

-- --------------------------------------------------------

--
-- Structure de la table `douche`
--

CREATE TABLE IF NOT EXISTS `douche` (
  `idChambre` int(11) NOT NULL,
`idDouche` int(11) NOT NULL,
  `prixDouche` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `douche`
--

INSERT INTO `douche` (`idChambre`, `idDouche`, `prixDouche`) VALUES
(1, 1, 10),
(2, 2, 10),
(4, 3, 10),
(6, 4, 10);

-- --------------------------------------------------------

--
-- Structure de la table `frigo`
--

CREATE TABLE IF NOT EXISTS `frigo` (
  `idChambre` int(11) NOT NULL,
`idFrigo` int(11) NOT NULL,
  `prixFrigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `idAdministrateur` int(11) NOT NULL,
`idHotel` int(11) NOT NULL,
  `nomHotel` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `hotel`
--

INSERT INTO `hotel` (`idAdministrateur`, `idHotel`, `nomHotel`) VALUES
(1, 1, 'Hotel des Hotels');

-- --------------------------------------------------------

--
-- Structure de la table `television`
--

CREATE TABLE IF NOT EXISTS `television` (
  `idChambre` int(11) NOT NULL,
`idTelevision` int(11) NOT NULL,
  `prixTelevision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
 ADD PRIMARY KEY (`idAdministrateur`);

--
-- Index pour la table `baignoire`
--
ALTER TABLE `baignoire`
 ADD PRIMARY KEY (`idBaignoire`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
 ADD PRIMARY KEY (`idChambre`);

--
-- Index pour la table `douche`
--
ALTER TABLE `douche`
 ADD PRIMARY KEY (`idDouche`);

--
-- Index pour la table `frigo`
--
ALTER TABLE `frigo`
 ADD PRIMARY KEY (`idFrigo`);

--
-- Index pour la table `hotel`
--
ALTER TABLE `hotel`
 ADD PRIMARY KEY (`idHotel`);

--
-- Index pour la table `television`
--
ALTER TABLE `television`
 ADD PRIMARY KEY (`idTelevision`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
MODIFY `idAdministrateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `baignoire`
--
ALTER TABLE `baignoire`
MODIFY `idBaignoire` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
MODIFY `idChambre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `douche`
--
ALTER TABLE `douche`
MODIFY `idDouche` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `frigo`
--
ALTER TABLE `frigo`
MODIFY `idFrigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hotel`
--
ALTER TABLE `hotel`
MODIFY `idHotel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `television`
--
ALTER TABLE `television`
MODIFY `idTelevision` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
