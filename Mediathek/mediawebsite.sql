-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Dez 2016 um 20:04
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mediawebsite`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_books`
--

CREATE TABLE `tbl_books` (
  `bookID` int(11) NOT NULL,
  `bookTitle` varchar(50) NOT NULL,
  `bookAuthor` varchar(50) NOT NULL,
  `bookCategory` varchar(255) DEFAULT NULL,
  `bookDesc` text,
  `bookPic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_films`
--

CREATE TABLE `tbl_films` (
  `filmID` int(11) NOT NULL,
  `filmTitle` varchar(50) NOT NULL,
  `filmDirector` varchar(50) NOT NULL,
  `filmGenre` varchar(255) DEFAULT NULL,
  `filmDesc` text,
  `filmPic` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_pictures`
--

CREATE TABLE `tbl_pictures` (
  `pictureID` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `bookID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_posters`
--

CREATE TABLE `tbl_posters` (
  `posterID` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indizes für die Tabelle `tbl_films`
--
ALTER TABLE `tbl_films`
  ADD PRIMARY KEY (`filmID`);

--
-- Indizes für die Tabelle `tbl_pictures`
--
ALTER TABLE `tbl_pictures`
  ADD PRIMARY KEY (`pictureID`);

--
-- Indizes für die Tabelle `tbl_posters`
--
ALTER TABLE `tbl_posters`
  ADD PRIMARY KEY (`posterID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT für Tabelle `tbl_films`
--
ALTER TABLE `tbl_films`
  MODIFY `filmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `tbl_pictures`
--
ALTER TABLE `tbl_pictures`
  MODIFY `pictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT für Tabelle `tbl_posters`
--
ALTER TABLE `tbl_posters`
  MODIFY `posterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
