-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Serveur: mysql
-- Généré le : Dim 04 Octobre 2015 à 03:19
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=33 ;

--
-- Contenu de la table `SCORES_REF`
--

INSERT INTO `SCORES_REF` (`IDS`, `CLASSES`, `GROUPS`, `SUBJECTS`, `TYPES`, `SEMESTER`, `PERIODS`, `DATES`, `DELETED`) VALUES
(1, 'IS-C', '1', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(2, 'IS-A1', '2', 'Math2', 'Homework', 'Fall', 2015, '09/26', '0'),
(3, 'IS-A2', '3', 'English', 'Homework', 'Fall', 2015, '09/26', '0'),
(4, 'IS-A2', '4', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(5, 'IS-A1', '5', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(6, 'HS-C English', '6', 'English', 'Homework', 'Fall', 2015, '09/26', '0'),
(7, 'PS-A', '7', 'Math', 'Homework', 'Fall', 2015, '09/27', '0'),
(8, 'HS-C1 Math', '8', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(9, 'HS-C2 Math', '9', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(10, 'HS-D1 Math', '10', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(11, 'HS-D2 Math', '11', 'Math', 'Homework', 'Fall', 2015, '09/26', '0'),
(12, 'IS-C', '12', 'English', 'Homework', 'Fall', 2015, '09/26', '0'),
(13, 'PS-A', '13', 'English', 'Homework', 'Fall', 2015, '09/26', '0'),
(14, 'PS-B', '14', 'English', 'Homework', 'Fall', 2015, '09/26', '0'),
(15, 'HS-B', '15', 'English', 'Test', 'Fall', 2015, '09/02', '0'),
(16, 'HS-B', '16', 'English', 'Test', 'Fall', 2015, '09/09', '0'),
(17, 'HS-B', '17', 'English', 'Test', 'Fall', 2015, '09/16', '0'),
(18, 'HS-B', '18', 'English', 'Test', 'Fall', 2015, '09/23', '0'),
(19, 'HS-B', '19', 'Math', 'Test', 'Fall', 2015, '09/02', '0'),
(20, 'HS-B', '20', 'Math', 'Test', 'Fall', 2015, '09/09', '0'),
(21, 'HS-B', '21', 'Math', 'Test', 'Fall', 2015, '09/16', '0'),
(22, 'HS-B', '22', 'Math', 'Test', 'Fall', 2015, '09/23', '0'),
(23, 'HS-D English', '23', 'English', 'Homework', 'Fall', 2015, '09/29', '0'),
(24, 'HS-B', '24', 'English', 'Test', 'Fall', 2015, '09/29', '0'),
(25, 'HS-B', '25', 'Math', 'Test', 'Fall', 2015, '09/29', '0'),
(26, 'PS-A', '26', 'Math', 'Homework', 'Fall', 2015, '10/03', '0'),
(27, 'HS-C2 Math', '27', 'Math', 'Homework', 'Fall', 2015, '10/03', '0'),
(28, 'HS-C1 Math', '28', 'Math', 'Homework', 'Fall', 2015, '10/03', '0'),
(29, 'HS-D2 Math', '29', 'Math', 'Homework', 'Fall', 2015, '10/03', '0'),
(30, 'HS-D1 Math', '30', 'Math', 'Homework', 'Fall', 2015, '10/03', '0'),
(31, 'PS-B', '31', 'English', 'Homework', 'Fall', 2015, '10/03', '0'),
(32, 'PS-A', '32', 'English', 'Homework', 'Fall', 2015, '10/03', '0');
