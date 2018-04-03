-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 mrt 2018 om 14:59
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `factuur` (
  `factuurcode` int(11) NOT NULL,
  `factuurdatum` datetime NOT NULL,
  `kenteken` varchar(8) NOT NULL,
  `typeparking` varchar(1) NOT NULL,
  `aankomst` datetime NOT NULL,
  `vertrek` datetime NOT NULL,
  `uitrijtijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`factuurcode`, `factuurdatum`, `kenteken`, `typeparking`, `aankomst`, `vertrek`, `uitrijtijd`) VALUES
(1, '2018-03-07 00:00:00', '12-12-12', 'v', '2018-03-08 00:00:00', '2018-03-09 00:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
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
  `auth_key` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`kenteken`, `voornaam`, `tussenvoegsel`, `achternaam`, `straatnaam`, `huisnummer`, `postcode`, `woonplaats`, `emailadres`, `wachtwoord`, `telefoonnummer`, `rekeningnummer`, `rol`, `auth_key`) VALUES
('12-12-12', 'jan', 'de', 'man', 'pleur', '6', '3512JP', 'blah', 'deathcoderz1337@gmail.com', 'hoi123', '06234234', 'NLasdsadsa', 'u', 'ffC7ilDmBkwULVBeSlKj'),
('12-23-14', 'myron', 'de', 'bruijn', 'twijnen', '6', '3421JN', 'Oudewater', 'myronwoody@gmail.com', 'Welkom2013', '0640663889', 'NLSDASDSADASD', 'a', '17JKlqQjx2OsWqJsoybY'),
('23-VW-92', 'Indy', '', 'Vierboom', 'Leisteen', '21', '3991SK', 'Houten', 'indyvierboom@gmail.com', NULL, '0642595459', 'INGB000224839', 'u', 'dVbJpMn7bAfo6380iqTV');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE `reservering` (
  `kenteken` varchar(8) NOT NULL,
  `typeparking` varchar(1) NOT NULL,
  `aankomst` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`kenteken`, `typeparking`, `aankomst`) VALUES
('12-12-12', 'v', '2018-03-08 15:12:00'),
('12-23-14', 'v', '2018-03-09 04:05:00'),
('23-VW-92', 'v', '2018-03-07 14:00:00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`factuurcode`),
  ADD KEY `fk_factuur_klant_idx` (`kenteken`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`kenteken`),
  ADD UNIQUE KEY `rekeningnummer_UNIQUE` (`rekeningnummer`),
  ADD UNIQUE KEY `emailadres_UNIQUE` (`emailadres`);

--
-- Indexen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`kenteken`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `factuur`
--
ALTER TABLE `factuur`
  MODIFY `factuurcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
