-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 12 Février 2016 à 12:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `base`
--

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE IF NOT EXISTS `statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page` varchar(250) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `host` varchar(60) NOT NULL DEFAULT '',
  `navigateur` varchar(100) NOT NULL DEFAULT '',
  `referer` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `statistiques`
--

INSERT INTO `statistiques` (`id`, `date`, `page`, `ip`, `host`, `navigateur`, `referer`) VALUES
(5, '2016-02-12 11:06:58', '/test/statistiques.php', '::1', 'DESKTOP-S9UHT6T', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.0.10802 Safa', 'http://localhost/test/'),
(6, '2016-02-12 11:53:56', '/test/statistiques.php', '::1', 'DESKTOP-S9UHT6T', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.0.10802 Safa', 'http://localhost/test/'),
(7, '2016-02-12 11:54:49', '/test/statistiques.php', '::1', 'DESKTOP-S9UHT6T', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.0.10802 Safa', 'http://localhost/test/'),
(8, '2016-02-12 12:02:34', '/test/statistiques.php', '::1', 'DESKTOP-S9UHT6T', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Saf', 'http://localhost/test/'),
(9, '2016-02-12 12:18:40', '/test/statistiques.php', '127.0.0.1', 'DESKTOP-S9UHT6T', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Saf', 'http://127.0.0.1/test/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
