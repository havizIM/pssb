-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06 Mei 2019 pada 13.36
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sk_pssb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` enum('Admin','Guru','Panitia','Kepsek') NOT NULL,
  `foto` text NOT NULL,
  `tgl_registrasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Aktif','Nonaktif','','') NOT NULL,
  `token` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nip`, `nama`, `username`, `password`, `level`, `foto`, `tgl_registrasi`, `status`, `token`) VALUES
('7201160106', 'Kalyssa Innara Putri', 'kalyssaip', '1ixhd', 'Guru', 'user.jpg', '2019-03-28 17:38:51', 'Aktif', 'e2baa50d717f2e8'),
('admin', 'Administrator', 'admin', 'admin', 'Admin', 'user.jpg', '2019-03-28 10:55:33', 'Aktif', 'd033e22ae348aeb'),
('Lagi', 'lagi', 'lagi', 'tpysz', 'Guru', 'user.jpg', '2019-04-11 10:52:14', 'Aktif', '4b0aba0f566991a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `username` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
