-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Mar 2021, 20:44
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `przychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` tinytext DEFAULT NULL,
  `surname` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `surname`) VALUES
(1, 'Jan', 'Jankowski'),
(2, 'Bernardyn', 'Brzechwa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Login` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `Login`, `password`, `name`, `surname`, `email`) VALUES
(1, 'Bartman', 'BB123', 'Bartosz ', 'Bohdziewicz', 'bohdziewicz.bartosz@gmail.com'),
(4, 'Bartman2', 'BB123', 'Bartosz ', 'Bohdziewicz', 'bohdziewicz.bartosz@gmail.com'),
(5, 'Bartman3', 'BB123', 'Bartosz ', 'Bohdziewicz', 'bohdziewicz.bartosz@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `visits`
--

CREATE TABLE `visits` (
  `id_user` int(11) NOT NULL,
  `data` time NOT NULL,
  `id_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `visits`
--

INSERT INTO `visits` (`id_user`, `data`, `id_doctor`) VALUES
(1, '08:00:00', 1),
(4, '15:20:00', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
