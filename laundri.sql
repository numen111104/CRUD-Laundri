-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2023 pada 19.20
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `januari`
--

CREATE TABLE `januari` (
  `ID` int(25) NOT NULL,
  `NKL` varchar(25) NOT NULL,
  `NAMA` varchar(25) NOT NULL,
  `ASRAMA` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `januari`
--

INSERT INTO `januari` (`ID`, `NKL`, `NAMA`, `ASRAMA`) VALUES
(31, '123', 'David John', 'ALI'),
(33, '121', 'ADICONDROW', 'Al-Bassam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `januari`
--
ALTER TABLE `januari`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NKL` (`NKL`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `januari`
--
ALTER TABLE `januari`
  MODIFY `ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
