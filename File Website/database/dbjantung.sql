-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Jan 2022 pada 15.00
-- Versi Server: 10.4.13-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbjantung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbjantung`
--

CREATE TABLE `tbjantung` (
  `id` int(11) NOT NULL,
  `detakjantung` varchar(10) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Dumping data untuk tabel `tbjantung`
--

INSERT INTO `tbjantung` (`id`, `detakjantung`, `waktu`) VALUES
(1, '65', '2022-01-09 12:07:52');

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbjantung`
--
ALTER TABLE `tbjantung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
