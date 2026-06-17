-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 17. jun 2026 ob 11.45
-- Različica strežnika: 10.4.32-MariaDB
-- Različica PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `spletna_knjigarna`
--

-- --------------------------------------------------------

--
-- Struktura tabele `avtorji`
--

CREATE TABLE `avtorji` (
  `id_avtor` int(11) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `priimek` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `avtorji`
--

INSERT INTO `avtorji` (`id_avtor`, `ime`, `priimek`) VALUES
(1, 'J.K.', 'Rowling'),
(2, 'Ivan', 'Cankar'),
(3, 'Agatha', 'Christie'),
(4, 'J.K.D', 'D'),
(5, 'branko', 'brajde'),
(6, 'gapsre', 'hocevar');

-- --------------------------------------------------------

--
-- Struktura tabele `kategorije`
--

CREATE TABLE `kategorije` (
  `id_kategorija` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `kategorije`
--

INSERT INTO `kategorije` (`id_kategorija`, `naziv`) VALUES
(1, 'Fantazija'),
(2, 'Drama'),
(3, 'Kriminalka'),
(6, 'ROMANTIKA'),
(7, 'zabavno'),
(8, 'alkoholik');

-- --------------------------------------------------------

--
-- Struktura tabele `knjige`
--

CREATE TABLE `knjige` (
  `id_knjiga` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `datoteka` varchar(255) NOT NULL,
  `id_avtor` int(11) NOT NULL,
  `id_kategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `knjige`
--

INSERT INTO `knjige` (`id_knjiga`, `naslov`, `opis`, `slika`, `datoteka`, `id_avtor`, `id_kategorija`) VALUES
(1, 'Harry Potter', 'Čarovniška pustolovščina.', 'harrypotter.jpg', 'harry.pdf', 1, 1),
(2, 'Na klancu', 'Slovenski roman.', 'naklancu.jfif', 'naklancu.pdf', 2, 2),
(3, 'Umor na Orient ekspresu', 'Detektivska zgodba.', 'orient.jpg', 'orient.pdf', 3, 3),
(7, 'HARRY', 'HARY POTTER', 'https://www.sbm.itb.ac.id/wp-content/uploads/2025/08/Hary.png', 'HARRY.PDF', 4, 6),
(8, 'SVINJAC', 'SIIKMIBI', 'https://www.dnevnik.rs/sites/default/files/styles/news_full_desktop/public/2023-10/Simovi%C4%87.jpg.webp', 'SIMI.PDF', 5, 7),
(9, 'gasper kocevar', 'gapi je ful srckan', 'https://images.sidearmdev.com/crop?url=https%3A%2F%2Fdxbhsrqyrr690.cloudfront.net%2Fsidearm.nextgen.sites%2Fgobulldogs.com%2Fimages%2F2025%2F9%2F29%2FKocevar_Gasper.png&width=180&height=270&type=webp', 'gasper.pdf', 6, 8);

-- --------------------------------------------------------

--
-- Struktura tabele `komentarji`
--

CREATE TABLE `komentarji` (
  `id_komentar` int(11) NOT NULL,
  `besedilo` text NOT NULL,
  `id_uporabnik` int(11) NOT NULL,
  `id_knjiga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `komentarji`
--

INSERT INTO `komentarji` (`id_komentar`, `besedilo`, `id_uporabnik`, `id_knjiga`) VALUES
(1, 'Odlična knjiga!', 1, 1),
(2, 'Zelo zanimiva.', 2, 2),
(3, 'jejejejej\r\n', 1, 2),
(4, 'sad', 1, 2),
(5, 'gf', 1, 3),
(6, 'zčo', 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabele `prenosi`
--

CREATE TABLE `prenosi` (
  `id` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `id_knjiga` int(11) NOT NULL,
  `id_uporabnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `prenosi`
--

INSERT INTO `prenosi` (`id`, `datum`, `id_knjiga`, `id_uporabnik`) VALUES
(1, '2026-05-20 10:52:46', 1, 1),
(2, '2026-05-20 10:52:46', 2, 2),
(3, '2026-06-03 12:33:32', 2, 1),
(4, '2026-06-05 10:28:49', 3, 1),
(5, '2026-06-05 11:05:57', 3, 1),
(6, '2026-06-05 11:51:59', 2, 1),
(7, '2026-06-10 12:04:05', 3, 1),
(8, '2026-06-10 12:04:19', 3, 1),
(9, '2026-06-11 09:04:01', 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `uporabniki`
--

CREATE TABLE `uporabniki` (
  `id_uporabnik` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `geslo` varchar(255) NOT NULL,
  `vloga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Odloži podatke za tabelo `uporabniki`
--

INSERT INTO `uporabniki` (`id_uporabnik`, `username`, `email`, `geslo`, `vloga`) VALUES
(1, 'marko', 'marko@gmail.com', '1234', 'admin'),
(2, 'ana', 'ana@gmail.com', 'geslo', 'uporabnik'),
(3, 'janej', 'janej.raziskovalec@gmail.com', '21342', 'uporabnik'),
(4, 'janej', '', '', 'uporabnik'),
(5, '121', '123@SADS', '123', 'uporabnik');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `avtorji`
--
ALTER TABLE `avtorji`
  ADD PRIMARY KEY (`id_avtor`);

--
-- Indeksi tabele `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id_kategorija`);

--
-- Indeksi tabele `knjige`
--
ALTER TABLE `knjige`
  ADD PRIMARY KEY (`id_knjiga`),
  ADD KEY `knjige_fkey_1` (`id_avtor`),
  ADD KEY `knjige_fkey_2` (`id_kategorija`);

--
-- Indeksi tabele `komentarji`
--
ALTER TABLE `komentarji`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `komentarji_fkey_1` (`id_uporabnik`),
  ADD KEY `komentarji_fkey_2` (`id_knjiga`);

--
-- Indeksi tabele `prenosi`
--
ALTER TABLE `prenosi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prenosi_fkey_1` (`id_knjiga`),
  ADD KEY `prenosi_fkey_2` (`id_uporabnik`);

--
-- Indeksi tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`id_uporabnik`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `avtorji`
--
ALTER TABLE `avtorji`
  MODIFY `id_avtor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT tabele `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id_kategorija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT tabele `knjige`
--
ALTER TABLE `knjige`
  MODIFY `id_knjiga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT tabele `komentarji`
--
ALTER TABLE `komentarji`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT tabele `prenosi`
--
ALTER TABLE `prenosi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `id_uporabnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `knjige`
--
ALTER TABLE `knjige`
  ADD CONSTRAINT `knjige_fkey_1` FOREIGN KEY (`id_avtor`) REFERENCES `avtorji` (`id_avtor`),
  ADD CONSTRAINT `knjige_fkey_2` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorije` (`id_kategorija`);

--
-- Omejitve za tabelo `komentarji`
--
ALTER TABLE `komentarji`
  ADD CONSTRAINT `komentarji_fkey_1` FOREIGN KEY (`id_uporabnik`) REFERENCES `uporabniki` (`id_uporabnik`),
  ADD CONSTRAINT `komentarji_fkey_2` FOREIGN KEY (`id_knjiga`) REFERENCES `knjige` (`id_knjiga`);

--
-- Omejitve za tabelo `prenosi`
--
ALTER TABLE `prenosi`
  ADD CONSTRAINT `prenosi_fkey_1` FOREIGN KEY (`id_knjiga`) REFERENCES `knjige` (`id_knjiga`),
  ADD CONSTRAINT `prenosi_fkey_2` FOREIGN KEY (`id_uporabnik`) REFERENCES `uporabniki` (`id_uporabnik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
