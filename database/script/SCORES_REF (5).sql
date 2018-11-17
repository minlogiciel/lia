-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Serveur: mysql
-- Généré le : Ven 08 Juillet 2016 à 01:30
-- Version du serveur: 5.1.55
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lia_usa`
--

-- --------------------------------------------------------

--
-- Structure de la table `SCORES_REF`
--

CREATE TABLE IF NOT EXISTS `SCORES_REF` (
  `IDS` int(11) NOT NULL AUTO_INCREMENT,
  `CLASSES` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `GROUPS` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  `SUBJECTS` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `TYPES` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `SEMESTER` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `PERIODS` int(11) DEFAULT NULL,
  `DATES` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `DELETED` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`IDS`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=608 ;

--
-- Contenu de la table `SCORES_REF`
--

INSERT INTO `SCORES_REF` (`IDS`, `CLASSES`, `GROUPS`, `SUBJECTS`, `TYPES`, `SEMESTER`, `PERIODS`, `DATES`, `DELETED`) VALUES
(566, 'HS-B1', '566', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(567, 'HS-A2', '567', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(568, 'HS-C', '568', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(569, 'HS-A1', '569', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(570, 'IS-A', '570', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(571, 'PS-A', '571', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(572, 'IS-C', '572', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(573, 'PS-B', '573', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(574, 'PS-A', '574', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(575, 'IS-C', '575', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(576, 'HS-A2', '576', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(577, 'IS-A', '577', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(578, 'HS-B1', '578', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(579, 'HS-A1', '579', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(580, 'HS-B2', '580', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(581, 'HS-C', '581', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(582, 'HS-D1', '582', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(583, 'HS-D1', '583', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(584, 'HS-D2', '584', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(585, 'HS-B2', '585', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(586, 'HS-D2', '586', 'Math', 'Homework', 'Summer', 2016, '07/06', '0'),
(587, 'PS-B', '587', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(588, 'HS-A2', '588', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(589, 'HS-A2', '589', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(590, 'HS-A1', '590', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(591, 'HS-A1', '591', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(592, 'HS-B1', '592', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(593, 'HS-D2', '593', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(594, 'HS-C', '594', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(595, 'HS-C', '595', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(596, 'HS-B2', '596', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(597, 'HS-D1', '597', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(598, 'HS-D1', '598', 'English', 'Homework', 'Summer', 2016, '07/06', '0'),
(599, 'HS-D2', '599', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(600, 'PS-A', '600', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(601, 'IS-A', '601', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(602, 'PS-A', '602', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(603, 'HS-B1', '603', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(604, 'IS-A', '604', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(605, 'IS-C', '605', 'Math', 'Homework', 'Summer', 2016, '07/07', '0'),
(606, 'IS-C', '606', 'English', 'Homework', 'Summer', 2016, '07/07', '0'),
(607, 'HS-B2', '607', 'Math', 'Homework', 'Summer', 2016, '07/07', '0');
