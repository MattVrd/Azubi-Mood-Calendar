-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Dez 2024 um 14:21
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `moodofazubi`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `azubis`
--

CREATE TABLE `azubis` (
  `Azubi_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `azubis`
--

INSERT INTO `azubis` (`Azubi_ID`, `Name`) VALUES
(1, 'Person #1'),
(2, 'Person #2'),
(3, 'Person #3'),
(4, 'Person #4'),
(5, 'Person #5'),
(6, 'Person #6'),
(7, 'Person #7'),
(8, 'Person #8');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `daily_moods`
--

CREATE TABLE `daily_moods` (
  `Entry_ID` int(255) NOT NULL,
  `Azubi_ID` int(255) NOT NULL,
  `Date` date NOT NULL,
  `Mood` int(255) NOT NULL,
  `Energy` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `azubis`
--
ALTER TABLE `azubis`
  ADD PRIMARY KEY (`Azubi_ID`);

--
-- Indizes für die Tabelle `daily_moods`
--
ALTER TABLE `daily_moods`
  ADD PRIMARY KEY (`Entry_ID`),
  ADD UNIQUE KEY `unique_azubi_date` (`Azubi_ID`,`Date`),
  ADD KEY `Azubi_ID` (`Azubi_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `azubis`
--
ALTER TABLE `azubis`
  MODIFY `Azubi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `daily_moods`
--
ALTER TABLE `daily_moods`
  MODIFY `Entry_ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `daily_moods`
--
ALTER TABLE `daily_moods`
  ADD CONSTRAINT `daily_moods_ibfk_1` FOREIGN KEY (`Azubi_ID`) REFERENCES `azubis` (`Azubi_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
