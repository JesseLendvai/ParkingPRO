-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 02 apr 2018 om 00:21
-- Serverversie: 5.7.19
-- PHP-versie: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

DROP TABLE IF EXISTS `factuur`;
CREATE TABLE IF NOT EXISTS `factuur` (
  `factuurcode` int(11) NOT NULL AUTO_INCREMENT,
  `factuurdatum` datetime NOT NULL,
  `kenteken` varchar(8) NOT NULL,
  `typeparking` varchar(1) NOT NULL,
  `aankomst` datetime NOT NULL,
  `vertrek` datetime NOT NULL,
  `uitrijtijd` time NOT NULL,
  PRIMARY KEY (`factuurcode`),
  KEY `fk_factuur_klant_idx` (`kenteken`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`factuurcode`, `factuurdatum`, `kenteken`, `typeparking`, `aankomst`, `vertrek`, `uitrijtijd`) VALUES
(1, '2018-03-07 00:00:00', '12-12-12', 'v', '2018-03-08 00:00:00', '2018-03-09 00:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

DROP TABLE IF EXISTS `klant`;
CREATE TABLE IF NOT EXISTS `klant` (
  `kenteken` varchar(8) NOT NULL,
  `voornaam` varchar(35) NOT NULL,
  `tussenvoegsel` varchar(11) DEFAULT NULL,
  `achternaam` varchar(35) NOT NULL,
  `straatnaam` varchar(35) NOT NULL,
  `huisnummer` varchar(5) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `woonplaats` varchar(35) NOT NULL,
  `emailadres` varchar(254) NOT NULL,
  `wachtwoord` varchar(20) DEFAULT NULL,
  `telefoonnummer` varchar(10) NOT NULL,
  `rekeningnummer` varchar(20) NOT NULL,
  `rol` varchar(1) NOT NULL DEFAULT 'u',
  `auth_key` varchar(20) DEFAULT NULL,
  `passwordCreated` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kenteken`),
  UNIQUE KEY `rekeningnummer_UNIQUE` (`rekeningnummer`),
  UNIQUE KEY `emailadres_UNIQUE` (`emailadres`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`kenteken`, `voornaam`, `tussenvoegsel`, `achternaam`, `straatnaam`, `huisnummer`, `postcode`, `woonplaats`, `emailadres`, `wachtwoord`, `telefoonnummer`, `rekeningnummer`, `rol`, `auth_key`, `passwordCreated`) VALUES
('12-12-12', 'jan', 'de', 'man', 'pleur', '6', '3512JP', 'blah', 'deathcoderz1337@gmail.com', 'hoi123', '06234234', 'NLasdsadsa', 'u', 'ffC7ilDmBkwULVBeSlKj', '0'),
('12-23-14', 'myron', 'de', 'bruijn', 'twijnen', '6', '3421JN', 'Oudewater', 'myronwoody@gmail.com', 'hoi123', '0640663889', 'NLSDASDSADASD', 'a', '17JKlqQjx2OsWqJsoybY', '0'),
('23-VW-92', 'Indy', '', 'Vierboom', 'Leisteen', '21', '3991SK', 'Houten', 'indyvierboom@gmail.com', NULL, '0642595459', 'INGB000224839', 'u', 'dVbJpMn7bAfo6380iqTV', '0'),
('as-as-as', 'asd', 'asda', 'sda', 'sd', 'asd', 'asd', 'asda', 'test@gmail.com', 'asdasd', 'asda', 'sd', 'u', 'HjXQxa5ItIv2KPbo3Qz', '1'),
('qw-qw-qw', 'qwe', 'qwe', 'qwe', 'qwe', 'qw', 'wqe', 'qwe', 'qwe@gmail.com', 'hoi123', 'qwe', 'qwe', 'u', 'dZq0G1dMVicLDaP53s4', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

DROP TABLE IF EXISTS `reservering`;
CREATE TABLE IF NOT EXISTS `reservering` (
  `kenteken` varchar(8) NOT NULL,
  `typeparking` varchar(1) NOT NULL,
  `aankomst` datetime NOT NULL,
  PRIMARY KEY (`kenteken`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`kenteken`, `typeparking`, `aankomst`) VALUES
('12-12-12', 'v', '2018-03-08 15:12:00'),
('12-23-14', 'v', '2018-03-09 04:05:00'),
('23-VW-92', 'v', '2018-03-07 14:00:00'),
('as-as-as', 'v', '0001-01-01 03:01:00'),
('qw-qw-qw', 'v', '0001-01-01 01:02:00');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `fk_factuur_klant` FOREIGN KEY (`kenteken`) REFERENCES `klant` (`kenteken`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `fk_reservering_klant` FOREIGN KEY (`kenteken`) REFERENCES `klant` (`kenteken`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
