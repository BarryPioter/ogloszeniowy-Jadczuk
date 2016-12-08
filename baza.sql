
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 08 Gru 2016, 17:38
-- Wersja serwera: 10.0.20-MariaDB
-- Wersja PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `u831737793_serwi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `archiwum`
--

CREATE TABLE IF NOT EXISTS `archiwum` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kate` int(11) NOT NULL,
  `item` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `data` date NOT NULL,
  `vip` int(1) NOT NULL DEFAULT '0',
  KEY `id_user` (`id_user`),
  KEY `id_kate` (`id_kate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `archiwum`
--

INSERT INTO `archiwum` (`id`, `id_user`, `id_kate`, `item`, `opis`, `cena`, `data`, `vip`) VALUES
(6, 1, 4, 'a', 'c', 1, '2016-10-11', 0),
(5, 1, 8, 'c', 'a', 1, '2016-10-12', 0),
(7, 1, 7, 'csss', '13453465', 45, '2016-09-06', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE IF NOT EXISTS `kategorie` (
  `id_kategorii` int(11) NOT NULL AUTO_INCREMENT,
  `kategoria` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_kategorii`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id_kategorii`, `kategoria`) VALUES
(1, 'Obuwie'),
(2, 'Gry'),
(3, 'Odzież'),
(4, 'Samochody'),
(5, 'Komputery'),
(6, 'Zwierzeta'),
(7, 'Meble'),
(8, 'RTV/AGD');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE IF NOT EXISTS `ogloszenia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_kate` int(11) NOT NULL,
  `item` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `vip` int(1) NOT NULL DEFAULT '0',
  `widok` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_kate` (`id_kate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(20) CHARACTER SET utf8 NOT NULL,
  `imie` varchar(15) CHARACTER SET utf8 NOT NULL,
  `nazwisko` varchar(35) CHARACTER SET utf8 NOT NULL,
  `haslo` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `telefon` int(9) NOT NULL,
  `hash` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `aktywny` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id_user`, `nazwa`, `imie`, `nazwisko`, `haslo`, `email`, `telefon`, `hash`, `aktywny`, `admin`) VALUES
(1, 'Barry Pioter', 'Piotr', 'Jadczuk', 'f3ce85cf048270d52e09ef5ed4eff86c', 'speedpower21@wp.pl', 678456123, 'b5b41fac0361d157d9673ecb926af5ae', 1, 1),
(3, 'Peterszmit', 'Piotr', 'Jadczuk', 'f3ce85cf048270d52e09ef5ed4eff86c', 'masselite21@gmail.com', 723889715, '8d6dc35e506fc23349dd10ee68dabb64', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
