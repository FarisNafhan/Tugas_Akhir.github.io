-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2023 pada 04.42
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `rifki_kategori`
--

CREATE TABLE `rifki_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rifki_kategori`
--

INSERT INTO `rifki_kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'sayur'),
(5, 'buah-buahan'),
(6, 'minuman'),
(7, 'makanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rifki_menu`
--

CREATE TABLE `rifki_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga_menu` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `foto_menu` varchar(100) DEFAULT NULL,
  `status_menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rifki_menu`
--

INSERT INTO `rifki_menu` (`id_menu`, `nama_menu`, `harga_menu`, `id_kategori`, `foto_menu`, `status_menu`) VALUES
(5, 'kentang balado', 10000, 7, 'balado.png', 'tidak tersedia'),
(7, 'kentang goreng', 10000, 7, 'goreng.png', 'tersedia'),
(8, 'kentang tumbuk', 10000, 7, 'tumbuk.png', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rifki_pelanggan`
--

CREATE TABLE `rifki_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(13) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_pelanggan` enum('Gold','Silver','Bronze') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rifki_pelanggan`
--

INSERT INTO `rifki_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telepon`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `jenis_pelanggan`) VALUES
(1, 'rifki', 'italia', '098576443', 'Laki-laki', 'mount everest', '2023-11-02', 'Bronze'),
(2, 'yudha', 'prancis', '888867658', 'Laki-laki', 'russia', '2023-11-08', 'Gold'),
(3, 'yoda', 'death star', '3754437598347', 'Laki-laki', 'saturnus', '2023-11-08', 'Silver');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(6, 'admin'),
(7, 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_role`, `username`, `password`, `nama_user`) VALUES
(3, 6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
(4, 7, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir'),
(6, 7, 'admin cash', '21232f297a57a5a743894a0e4a801fc3', 'mimin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `rifki_kategori`
--
ALTER TABLE `rifki_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `rifki_menu`
--
ALTER TABLE `rifki_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `rifki_pelanggan`
--
ALTER TABLE `rifki_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `rifki_kategori`
--
ALTER TABLE `rifki_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rifki_menu`
--
ALTER TABLE `rifki_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rifki_pelanggan`
--
ALTER TABLE `rifki_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
