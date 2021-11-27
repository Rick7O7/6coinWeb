-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 13. Okt 2021 um 15:39
-- Server-Version: 10.3.29-MariaDB-0+deb10u1
-- PHP-Version: 7.3.29-1+0~20210701.86+debian10~1.gbp7ad6eb

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `6coin`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `data`
--

CREATE TABLE `data` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `data`
--

INSERT INTO `data` (`username`, `password`) VALUES
('root', 'kAyZklsc8oYc5xzMh9aE1eg.3kuSqpVS9uButcVRGpG7b2h/1i4ai'),
('rick', 'bqC1vcNfjbV.Qq.9Luluce2hnN7VqBS9t9/SusemO2N3vTLhr9Cza'),
('jean', 'bjoiq9yo2R4d/8ErdoxBSO8v0Jd9nNnJHh807BmDxI1A9IQagw7O.'),
('root2', 'bxLHA7kT2OrI77Fq3G8GQ.NVVKwAMDNGar.pUli9RWsJtRPl44kjO');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gift`
--

CREATE TABLE `gift` (
  `value` text NOT NULL,
  `from_user` text NOT NULL,
  `iban` text NOT NULL,
  `code` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `gift`
--

INSERT INTO `gift` (`value`, `from_user`, `iban`, `code`, `link`) VALUES
('10000', 'root2', '6C00802022882288', '7X0V3MJNHUYDYGOPGRFT', 'https://6coin.de/claim_gift.php?code=7X0V3MJNHUYDYGOPGRFT'),
('10000', 'root2', '6C00802022882288', 'S6XYQPQW4G2MJL39BVW7', 'https://6coin.de/claim_gift.php?code=S6XYQPQW4G2MJL39BVW7');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konto`
--

CREATE TABLE `konto` (
  `konto_owner` text NOT NULL,
  `iban` text NOT NULL,
  `pin` text NOT NULL,
  `user_id` text NOT NULL,
  `konto_value` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `konto`
--

INSERT INTO `konto` (`konto_owner`, `iban`, `pin`, `user_id`, `konto_value`, `date`) VALUES
('Jean-Luca Tews', '6C00802022882288', '0809', 'root2', '9999989999', '09/90');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profil`
--

CREATE TABLE `profil` (
  `username` text NOT NULL,
  `verify` text NOT NULL,
  `bann` text NOT NULL,
  `admin` text NOT NULL,
  `2fa` text NOT NULL,
  `email_adress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `profil`
--

INSERT INTO `profil` (`username`, `verify`, `bann`, `admin`, `2fa`, `email_adress`) VALUES
('root', 'false', 'false', 'false', 'false', 'tewsjean@gmail.com'),
('rick', 'false', 'false', 'false', 'false', 'admin@a.a'),
('jean', 'false', 'false', 'false', 'false', 'a@a.a'),
('root2', 'false', 'false', 'false', 'false', 'tewsjean70@gmail.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `username` text NOT NULL,
  `admin` int(11) NOT NULL,
  `pro` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `supporter` int(11) NOT NULL,
  `pink_banana` int(11) NOT NULL,
  `beta_mem` int(11) NOT NULL,
  `partner` int(11) NOT NULL,
  `10k` int(11) NOT NULL,
  `100k` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
