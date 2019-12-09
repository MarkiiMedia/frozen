-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1:3306
-- Genereringstid: 09. 12 2019 kl. 11:16:48
-- Serverversion: 5.7.24
-- PHP-version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frozen_db`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `tm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `score_labyrint` int(255) NOT NULL,
  `score_arcade` int(255) NOT NULL,
  `score_snake` int(255) NOT NULL,
  `score_breakout` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Data dump for tabellen `login`
--

INSERT INTO `login` (`id`, `user_name`, `pass`, `tm`, `score_labyrint`, `score_arcade`, `score_snake`, `score_breakout`) VALUES
(39, 'hejhej', '812f0c80b533a3a918dae3094cca02cea9b0b6a50b3d8b37fd32d909bfad91d9e712149e234ee693fc4d911331ee5800618357d7abdb48e325dd0c4c298b1e3e', '2019-11-25 11:30:00', 0, 0, 0, 0),
(23, 'Mark', '3b409f8ee50cffb3223ac8886f125b4f722529d9f3e33e1a3acfb028092c166cbd933941efce1c4f9c487a416c6f11daee769754bb1a00686c088c245d60eb1c', '2019-09-25 10:07:15', 0, 0, 0, 0),
(38, 'Mark3', 'd141fd6decf897ca09166ed8b632e09bdd900cce82737d3fd1120940c9f61cfd3590ee40473a47b1ccf6a455f46884535e642929b1e563575583270c03cd1a69', '2019-09-25 12:17:01', 0, 0, 0, 0),
(40, 'Markiiduved', '2cc32091a62880059da706e84705dcdee0cc40941324f8b2319dbd7e304b69fd29a2c01af2162255e8ad32be1a5448f3528bbb079d7d2976586cca3a3bf86e9a', '2019-11-25 11:38:17', 0, 0, 0, 0),
(41, 'AndersNy', '9cf7d397cc2e774c327aaf1dbc6e78d6fe6c74b4f5816629ee647399b8f4c89c0d1eab0cfc0fdaf986f9aa7f3cc728d77bd0080c8bfad47491e39e8621098779', '2019-11-26 14:01:21', 0, 0, 0, 0),
(42, 's', '2bc4311527bb68fda2eec99258aa41ad3ab6521f8a256907ea6303ff484f28238263f28ffdc59f718eafa411370888694d58f3bda7547691c5abc4a01ff35721', '2019-11-27 13:14:09', 0, 0, 0, 0),
(43, 'Markii', '35ac150ac26099751e5f1fad259b050c801a1fd63c241453f58c498eb50025b0ecd1b2938571a7c3f60e77da3bf677dcd0aa63ced3ecf610ca229e414cf726c4', '2019-12-07 00:30:29', 522, 800, 60, 24);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
