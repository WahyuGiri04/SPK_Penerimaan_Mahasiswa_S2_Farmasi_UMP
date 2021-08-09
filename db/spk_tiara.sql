-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16 Des 2020 pada 16.07
-- Versi Server: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_tiara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `atribut`
--

CREATE TABLE `atribut` (
  `id_atribut` int(12) NOT NULL,
  `nama_atribut` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `atribut`
--

INSERT INTO `atribut` (`id_atribut`, `nama_atribut`) VALUES
(1, 'Benefit'),
(2, 'Cost');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(10) NOT NULL,
  `kode_banding` varchar(100) NOT NULL,
  `kode_pembanding` varchar(100) NOT NULL,
  `bobot` double(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `kode_banding`, `kode_pembanding`, `bobot`) VALUES
(177, 'C1', 'C1', 1.0000),
(178, 'C1', 'C2', 0.1111),
(179, 'C1', 'C3', 1.0000),
(180, 'C1', 'C4', 5.0000),
(181, 'C1', 'C5', 2.0000),
(182, 'C1', 'C6', 0.5000),
(183, 'C1', 'C7', 5.0000),
(184, 'C2', 'C1', 9.0000),
(185, 'C2', 'C2', 1.0000),
(186, 'C2', 'C3', 7.0000),
(187, 'C2', 'C4', 7.0000),
(188, 'C2', 'C5', 7.0000),
(189, 'C2', 'C6', 7.0000),
(190, 'C2', 'C7', 7.0000),
(191, 'C3', 'C1', 1.0000),
(192, 'C3', 'C2', 0.1429),
(193, 'C3', 'C3', 1.0000),
(194, 'C3', 'C4', 3.0000),
(195, 'C3', 'C5', 1.0000),
(196, 'C3', 'C6', 1.0000),
(197, 'C3', 'C7', 3.0000),
(198, 'C4', 'C1', 0.2000),
(199, 'C4', 'C2', 0.1429),
(200, 'C4', 'C3', 0.3333),
(201, 'C4', 'C4', 1.0000),
(202, 'C4', 'C5', 0.3333),
(203, 'C4', 'C6', 0.3333),
(204, 'C4', 'C7', 3.0000),
(205, 'C5', 'C1', 0.5000),
(206, 'C5', 'C2', 0.1429),
(207, 'C5', 'C3', 1.0000),
(208, 'C5', 'C4', 3.0000),
(209, 'C5', 'C5', 1.0000),
(210, 'C5', 'C6', 0.3333),
(211, 'C5', 'C7', 1.0000),
(212, 'C6', 'C1', 2.0000),
(213, 'C6', 'C2', 0.1429),
(214, 'C6', 'C3', 1.0000),
(215, 'C6', 'C4', 3.0000),
(216, 'C6', 'C5', 3.0000),
(217, 'C6', 'C6', 1.0000),
(218, 'C6', 'C7', 3.0000),
(219, 'C7', 'C1', 0.2000),
(220, 'C7', 'C2', 0.1429),
(221, 'C7', 'C3', 0.3333),
(222, 'C7', 'C4', 0.3333),
(223, 'C7', 'C5', 1.0000),
(224, 'C7', 'C6', 0.3333),
(225, 'C7', 'C7', 1.0000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_konversi_data_mahasiswa`
--

CREATE TABLE `data_konversi_data_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `no_mahasiswa` varchar(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `asal_ptn` varchar(11) NOT NULL,
  `nilai_kriteria` int(10) NOT NULL,
  `kode_kriteria` varchar(12) NOT NULL,
  `fix_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_konversi_data_mahasiswa`
--

INSERT INTO `data_konversi_data_mahasiswa` (`id_mahasiswa`, `id_pendaftaran`, `no_mahasiswa`, `nama_mahasiswa`, `jenis_kelamin`, `asal_ptn`, `nilai_kriteria`, `kode_kriteria`, `fix_kriteria`) VALUES
(1, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 3, 'C1', 3),
(2, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 4, 'C1', 3),
(3, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 5, 'C1', 3),
(4, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 4, 'C1', 3),
(5, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 3, 'C1', 3),
(6, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 2, 'C1', 3),
(7, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 4, 'C1', 3),
(8, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 3, 'C1', 3),
(9, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 3, 'C1', 3),
(10, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 4, 'C1', 3),
(11, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 2, 'C1', 3),
(12, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 4, 'C1', 3),
(13, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 4, 'C1', 3),
(14, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 2, 'C1', 3),
(15, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 4, 'C1', 3),
(16, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 3, 'C1', 3),
(17, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 3, 'C1', 3),
(18, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 5, 'C1', 3),
(19, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 5, 'C1', 3),
(20, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 4, 'C1', 3),
(21, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 3, 'C1', 3),
(22, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 1, 'C2', 3),
(23, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 1, 'C2', 3),
(24, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 2, 'C2', 3),
(25, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 1, 'C2', 3),
(26, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 2, 'C2', 3),
(27, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 1, 'C2', 3),
(28, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 2, 'C2', 3),
(29, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 1, 'C2', 3),
(30, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 1, 'C2', 3),
(31, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 1, 'C2', 3),
(32, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 1, 'C2', 3),
(33, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 2, 'C2', 3),
(34, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 1, 'C2', 3),
(35, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 1, 'C2', 3),
(36, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 1, 'C2', 3),
(37, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 2, 'C2', 3),
(38, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 2, 'C2', 3),
(39, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 1, 'C2', 3),
(40, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 2, 'C2', 3),
(41, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 1, 'C2', 3),
(42, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 1, 'C2', 3),
(43, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 1, 'C2', 3),
(44, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 1, 'C2', 3),
(45, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 1, 'C2', 3),
(46, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 4, 'C3', 3),
(47, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 3, 'C3', 3),
(48, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 3, 'C3', 3),
(49, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 4, 'C3', 3),
(50, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 4, 'C3', 3),
(51, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 4, 'C3', 3),
(52, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 4, 'C3', 3),
(53, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 2, 'C3', 3),
(54, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 1, 'C3', 3),
(55, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 2, 'C3', 3),
(56, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 2, 'C3', 3),
(57, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 3, 'C3', 3),
(58, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 3, 'C3', 3),
(59, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 4, 'C3', 3),
(60, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 4, 'C3', 3),
(61, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 3, 'C3', 3),
(62, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 3, 'C3', 3),
(63, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 4, 'C3', 3),
(64, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 3, 'C3', 3),
(65, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 4, 'C3', 3),
(66, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 4, 'C3', 3),
(67, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 1, 'C3', 3),
(68, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 3, 'C3', 3),
(69, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 4, 'C3', 3),
(70, 1, '1921141895', 'YURIKE ELANDA', 'P', 'UNIVERSITAS', 3, 'C3', 3),
(71, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 4, 'C4', 3),
(72, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 3, 'C4', 3),
(73, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 4, 'C4', 3),
(74, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 3, 'C4', 3),
(75, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 5, 'C4', 3),
(76, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 4, 'C4', 3),
(77, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 4, 'C4', 3),
(78, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 4, 'C4', 3),
(79, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 2, 'C4', 3),
(80, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 3, 'C4', 3),
(81, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 3, 'C4', 3),
(82, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 4, 'C4', 3),
(83, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 4, 'C4', 3),
(84, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 5, 'C4', 3),
(85, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 5, 'C4', 3),
(86, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 4, 'C4', 3),
(87, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 4, 'C4', 3),
(88, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 4, 'C4', 3),
(89, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 4, 'C4', 3),
(90, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 3, 'C4', 3),
(91, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 4, 'C4', 3),
(92, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 3, 'C4', 3),
(93, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 2, 'C4', 3),
(94, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 4, 'C4', 3),
(95, 1, '1921141895', 'YURIKE ELANDA', 'P', 'UNIVERSITAS', 4, 'C4', 3),
(96, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 5, 'C5', 3),
(97, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 3, 'C5', 3),
(98, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 4, 'C5', 3),
(99, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 4, 'C5', 3),
(100, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 5, 'C5', 3),
(101, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 4, 'C5', 3),
(102, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 5, 'C5', 3),
(103, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 4, 'C5', 3),
(104, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 5, 'C5', 3),
(105, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 3, 'C5', 3),
(106, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 5, 'C5', 3),
(107, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 5, 'C5', 3),
(108, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 4, 'C5', 3),
(109, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 5, 'C5', 3),
(110, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 5, 'C5', 3),
(111, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 4, 'C5', 3),
(112, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 4, 'C5', 3),
(113, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 4, 'C5', 3),
(114, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 4, 'C5', 3),
(115, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 4, 'C5', 3),
(116, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 4, 'C5', 3),
(117, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 3, 'C5', 3),
(118, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 3, 'C5', 3),
(119, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 5, 'C5', 3),
(120, 1, '1921141895', 'YURIKE ELANDA', 'P', 'UNIVERSITAS', 4, 'C5', 3),
(121, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 5, 'C6', 3),
(122, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 3, 'C6', 3),
(123, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 4, 'C6', 3),
(124, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 3, 'C6', 3),
(125, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 4, 'C6', 3),
(126, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 4, 'C6', 3),
(127, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 4, 'C6', 3),
(128, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 2, 'C6', 3),
(129, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 2, 'C6', 3),
(130, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 4, 'C6', 3),
(131, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 2, 'C6', 3),
(132, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 3, 'C6', 3),
(133, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 3, 'C6', 3),
(134, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 5, 'C6', 3),
(135, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 4, 'C6', 3),
(136, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 5, 'C6', 3),
(137, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 4, 'C6', 3),
(138, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 4, 'C6', 3),
(139, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 5, 'C6', 3),
(140, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 5, 'C6', 3),
(141, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 5, 'C6', 3),
(142, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 3, 'C6', 3),
(143, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 3, 'C6', 3),
(144, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 5, 'C6', 3),
(145, 1, '1921141895', 'YURIKE ELANDA', 'P', 'UNIVERSITAS', 2, 'C6', 3),
(146, 1, '1929900001', 'INA LISTINA', 'P', 'Universitas', 4, 'C7', 3),
(147, 1, '1929900002', 'DHEANGGARA RESTY RAHMANINGRUM', 'P', 'Universitas', 2, 'C7', 3),
(148, 1, '1921014302', 'ARINDA NUR CAHYANI', 'P', 'Universitas', 2, 'C7', 3),
(149, 1, '1921017984', 'AJENG PUSPO AJI', 'P', 'Sekolah Tin', 2, 'C7', 3),
(150, 1, '1901012673', 'TIAS EKA RAHMAWATI', 'P', 'Sekolah Tin', 4, 'C7', 3),
(151, 1, '1901012765', 'ESTI FEBRI FATWAMI', 'P', 'Universitas', 3, 'C7', 3),
(152, 1, '1921072526', 'RAHMAWATI', 'P', 'STIKES BAKT', 2, 'C7', 3),
(153, 1, '1901013458', 'BELLA ROSNA GUSTIKA', 'P', 'Universitas', 2, 'C7', 3),
(154, 1, '1921083123', 'GANJAR TAUFIK PATU ROHMAN', 'L', 'STIKes Bakt', 1, 'C7', 3),
(155, 1, '1921102501', 'SITI FARAH HARDIYATI', 'P', 'UNIVERSITAS', 4, 'C7', 3),
(156, 1, '1921106064', 'NINA KARLINA', 'P', 'UNIVERSITAS', 1, 'C7', 3),
(157, 1, '1921130618', 'CUT AINUL MARDHIYYAH', 'P', 'SEKOLAH TIN', 1, 'C7', 3),
(158, 1, '1921136151', 'BAGUS RIYANTO', 'L', 'Universitas', 4, 'C7', 3),
(159, 1, '1901013991', 'ERMA NUR HANIFAH', 'P', 'Universitas', 2, 'C7', 3),
(160, 1, '1901013992', 'ANWAR ROSYADI', 'L', 'Universitas', 1, 'C7', 3),
(161, 1, '1901014127', 'ARI SUWANTI', 'L', 'Universitas', 4, 'C7', 3),
(162, 1, '1901014128', 'MONICA FEBRI ANDARI', 'P', 'Universitas', 2, 'C7', 3),
(163, 1, '1921136184', 'NOVI', 'P', 'SEKOLAH TIN', 4, 'C7', 3),
(164, 1, '1921139124', 'NINDITA SARI NASTITI', 'P', 'UNIVERSITAS', 3, 'C7', 3),
(165, 1, '1921139873', 'MARATUL QOYYIMAH', 'P', 'STIKES MUHA', 3, 'C7', 3),
(166, 1, '1921140301', 'GANJAR TAUFIK FATU ROHMAN', 'L', 'STIKes Bakt', 4, 'C7', 3),
(167, 1, '1921141829', 'KHAFID MAHBUB', 'L', 'UNIVERSITAS', 3, 'C7', 3),
(168, 1, '1921141868', 'FARAH DESTYANA NURAINY', 'P', 'UNIVERSITAS', 1, 'C7', 3),
(169, 1, '1921139643', 'RAKHMAWATI HANIFAH', 'P', 'UNIVERSITAS', 4, 'C7', 3),
(170, 1, '1921141895', 'YURIKE ELANDA', 'P', 'UNIVERSITAS', 2, 'C7', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_mahasiswa`
--

CREATE TABLE `data_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `no_mahasiswa` varchar(100) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(11) NOT NULL,
  `asal_ptn` varchar(110) NOT NULL,
  `nilai_kriteria` double(100,9) NOT NULL,
  `kode_kriteria` varchar(12) NOT NULL,
  `fix_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_mahasiswa`
--

INSERT INTO `data_mahasiswa` (`id_mahasiswa`, `id_pendaftaran`, `no_mahasiswa`, `nama_mahasiswa`, `jenis_kelamin`, `asal_ptn`, `nilai_kriteria`, `kode_kriteria`, `fix_kriteria`) VALUES
(1, 1, '3001', 'Giri', 'L', 'UMP', 3.000000000, 'C1', 1),
(2, 1, '3001', 'Giri', 'L', 'UMP', 120.000000000, 'C2', 1),
(3, 1, '3001', 'Giri', 'L', 'UMP', 4.000000000, 'C3', 1),
(4, 1, '3001', 'Giri', 'L', 'UMP', 5.000000000, 'C4', 1),
(5, 1, '3001', 'Giri', 'L', 'UMP', 4.000000000, 'C5', 1),
(6, 1, '3001', 'Giri', 'L', 'UMP', 3.000000000, 'C6', 1),
(7, 1, '3001', 'Giri', 'L', 'UMP', 4.000000000, 'C7', 1),
(8, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 4.000000000, 'C1', 1),
(9, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 120.000000000, 'C2', 1),
(10, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 5.000000000, 'C3', 1),
(11, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 5.000000000, 'C4', 1),
(12, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 5.000000000, 'C5', 1),
(13, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 5.000000000, 'C6', 1),
(14, 1, '3002', 'Tias Eka Sucipto', 'P', 'UMP', 4.000000000, 'C7', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fix_bobot_kriteria`
--

CREATE TABLE `fix_bobot_kriteria` (
  `id_bobot` int(10) NOT NULL,
  `kode_banding` varchar(100) NOT NULL,
  `kode_pembanding` varchar(100) NOT NULL,
  `bobot` double(6,4) NOT NULL,
  `fix_bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fix_bobot_kriteria`
--

INSERT INTO `fix_bobot_kriteria` (`id_bobot`, `kode_banding`, `kode_pembanding`, `bobot`, `fix_bobot`) VALUES
(1, 'C1', 'C1', 1.0000, 1),
(2, 'C1', 'C2', 0.1111, 1),
(3, 'C1', 'C3', 1.0000, 1),
(4, 'C1', 'C4', 5.0000, 1),
(5, 'C1', 'C5', 2.0000, 1),
(6, 'C1', 'C6', 0.5000, 1),
(7, 'C1', 'C7', 5.0000, 1),
(8, 'C2', 'C1', 9.0000, 1),
(9, 'C2', 'C2', 1.0000, 1),
(10, 'C2', 'C3', 7.0000, 1),
(11, 'C2', 'C4', 7.0000, 1),
(12, 'C2', 'C5', 7.0000, 1),
(13, 'C2', 'C6', 7.0000, 1),
(14, 'C2', 'C7', 7.0000, 1),
(15, 'C3', 'C1', 1.0000, 1),
(16, 'C3', 'C2', 0.1429, 1),
(17, 'C3', 'C3', 1.0000, 1),
(18, 'C3', 'C4', 3.0000, 1),
(19, 'C3', 'C5', 1.0000, 1),
(20, 'C3', 'C6', 1.0000, 1),
(21, 'C3', 'C7', 3.0000, 1),
(22, 'C4', 'C1', 0.2000, 1),
(23, 'C4', 'C2', 0.1429, 1),
(24, 'C4', 'C3', 0.3333, 1),
(25, 'C4', 'C4', 1.0000, 1),
(26, 'C4', 'C5', 0.3333, 1),
(27, 'C4', 'C6', 0.3333, 1),
(28, 'C4', 'C7', 3.0000, 1),
(29, 'C5', 'C1', 0.5000, 1),
(30, 'C5', 'C2', 0.1429, 1),
(31, 'C5', 'C3', 1.0000, 1),
(32, 'C5', 'C4', 3.0000, 1),
(33, 'C5', 'C5', 1.0000, 1),
(34, 'C5', 'C6', 0.3333, 1),
(35, 'C5', 'C7', 1.0000, 1),
(36, 'C6', 'C1', 2.0000, 1),
(37, 'C6', 'C2', 0.1429, 1),
(38, 'C6', 'C3', 1.0000, 1),
(39, 'C6', 'C4', 3.0000, 1),
(40, 'C6', 'C5', 3.0000, 1),
(41, 'C6', 'C6', 1.0000, 1),
(42, 'C6', 'C7', 3.0000, 1),
(43, 'C7', 'C1', 0.2000, 1),
(44, 'C7', 'C2', 0.1429, 1),
(45, 'C7', 'C3', 0.3333, 1),
(46, 'C7', 'C4', 0.3333, 1),
(47, 'C7', 'C5', 1.0000, 1),
(48, 'C7', 'C6', 0.3333, 1),
(49, 'C7', 'C7', 1.0000, 1),
(50, 'C1', 'C1', 1.0000, 2),
(51, 'C1', 'C2', 0.1111, 2),
(52, 'C1', 'C3', 1.0000, 2),
(53, 'C1', 'C4', 5.0000, 2),
(54, 'C1', 'C5', 2.0000, 2),
(55, 'C1', 'C6', 0.5000, 2),
(56, 'C1', 'C7', 5.0000, 2),
(57, 'C2', 'C1', 9.0000, 2),
(58, 'C2', 'C2', 1.0000, 2),
(59, 'C2', 'C3', 7.0000, 2),
(60, 'C2', 'C4', 7.0000, 2),
(61, 'C2', 'C5', 7.0000, 2),
(62, 'C2', 'C6', 7.0000, 2),
(63, 'C2', 'C7', 7.0000, 2),
(64, 'C3', 'C1', 1.0000, 2),
(65, 'C3', 'C2', 0.1429, 2),
(66, 'C3', 'C3', 1.0000, 2),
(67, 'C3', 'C4', 3.0000, 2),
(68, 'C3', 'C5', 1.0000, 2),
(69, 'C3', 'C6', 1.0000, 2),
(70, 'C3', 'C7', 3.0000, 2),
(71, 'C4', 'C1', 0.2000, 2),
(72, 'C4', 'C2', 0.1429, 2),
(73, 'C4', 'C3', 0.3333, 2),
(74, 'C4', 'C4', 1.0000, 2),
(75, 'C4', 'C5', 0.3333, 2),
(76, 'C4', 'C6', 0.3333, 2),
(77, 'C4', 'C7', 3.0000, 2),
(78, 'C5', 'C1', 0.5000, 2),
(79, 'C5', 'C2', 0.1429, 2),
(80, 'C5', 'C3', 1.0000, 2),
(81, 'C5', 'C4', 3.0000, 2),
(82, 'C5', 'C5', 1.0000, 2),
(83, 'C5', 'C6', 0.3333, 2),
(84, 'C5', 'C7', 1.0000, 2),
(85, 'C6', 'C1', 2.0000, 2),
(86, 'C6', 'C2', 0.1429, 2),
(87, 'C6', 'C3', 1.0000, 2),
(88, 'C6', 'C4', 3.0000, 2),
(89, 'C6', 'C5', 3.0000, 2),
(90, 'C6', 'C6', 1.0000, 2),
(91, 'C6', 'C7', 3.0000, 2),
(92, 'C7', 'C1', 0.2000, 2),
(93, 'C7', 'C2', 0.1429, 2),
(94, 'C7', 'C3', 0.3333, 2),
(95, 'C7', 'C4', 0.3333, 2),
(96, 'C7', 'C5', 1.0000, 2),
(97, 'C7', 'C6', 0.3333, 2),
(98, 'C7', 'C7', 1.0000, 2),
(99, 'C1', 'C1', 1.0000, 3),
(100, 'C1', 'C2', 0.1111, 3),
(101, 'C1', 'C3', 1.0000, 3),
(102, 'C1', 'C4', 5.0000, 3),
(103, 'C1', 'C5', 2.0000, 3),
(104, 'C1', 'C6', 0.5000, 3),
(105, 'C1', 'C7', 5.0000, 3),
(106, 'C2', 'C1', 9.0000, 3),
(107, 'C2', 'C2', 1.0000, 3),
(108, 'C2', 'C3', 7.0000, 3),
(109, 'C2', 'C4', 7.0000, 3),
(110, 'C2', 'C5', 7.0000, 3),
(111, 'C2', 'C6', 7.0000, 3),
(112, 'C2', 'C7', 7.0000, 3),
(113, 'C3', 'C1', 1.0000, 3),
(114, 'C3', 'C2', 0.1429, 3),
(115, 'C3', 'C3', 1.0000, 3),
(116, 'C3', 'C4', 3.0000, 3),
(117, 'C3', 'C5', 1.0000, 3),
(118, 'C3', 'C6', 1.0000, 3),
(119, 'C3', 'C7', 3.0000, 3),
(120, 'C4', 'C1', 0.2000, 3),
(121, 'C4', 'C2', 0.1429, 3),
(122, 'C4', 'C3', 0.3333, 3),
(123, 'C4', 'C4', 1.0000, 3),
(124, 'C4', 'C5', 0.3333, 3),
(125, 'C4', 'C6', 0.3333, 3),
(126, 'C4', 'C7', 3.0000, 3),
(127, 'C5', 'C1', 0.5000, 3),
(128, 'C5', 'C2', 0.1429, 3),
(129, 'C5', 'C3', 1.0000, 3),
(130, 'C5', 'C4', 3.0000, 3),
(131, 'C5', 'C5', 1.0000, 3),
(132, 'C5', 'C6', 0.3333, 3),
(133, 'C5', 'C7', 1.0000, 3),
(134, 'C6', 'C1', 2.0000, 3),
(135, 'C6', 'C2', 0.1429, 3),
(136, 'C6', 'C3', 1.0000, 3),
(137, 'C6', 'C4', 3.0000, 3),
(138, 'C6', 'C5', 3.0000, 3),
(139, 'C6', 'C6', 1.0000, 3),
(140, 'C6', 'C7', 3.0000, 3),
(141, 'C7', 'C1', 0.2000, 3),
(142, 'C7', 'C2', 0.1429, 3),
(143, 'C7', 'C3', 0.3333, 3),
(144, 'C7', 'C4', 0.3333, 3),
(145, 'C7', 'C5', 1.0000, 3),
(146, 'C7', 'C6', 0.3333, 3),
(147, 'C7', 'C7', 1.0000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fix_kriteria`
--

CREATE TABLE `fix_kriteria` (
  `id_ket_krit` int(12) NOT NULL,
  `kode_kriteria` varchar(50) NOT NULL,
  `nama_ket_krit` varchar(100) NOT NULL,
  `id_atribut` int(12) NOT NULL,
  `fix_kriteria` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fix_kriteria`
--

INSERT INTO `fix_kriteria` (`id_ket_krit`, `kode_kriteria`, `nama_ket_krit`, `id_atribut`, `fix_kriteria`) VALUES
(1, 'C1', 'IPK', 1, 1),
(2, 'C2', 'TPA', 1, 1),
(3, 'C3', 'Latar Belakang Ilmu Kefarmasian', 1, 1),
(4, 'C4', 'Latar Belakang mengambil Program Magister', 1, 1),
(5, 'C5', 'Kesesuaian Pekerjaan dengan prodi yang diambil', 1, 1),
(6, 'C6', 'kemampuan berkomunikasi', 1, 1),
(7, 'C7', 'kemampuan bahasa inggris', 1, 1),
(8, 'C1', 'IPK', 1, 2),
(9, 'C2', 'TPA', 1, 2),
(10, 'C3', 'Latar Belakang Ilmu Kefarmasian', 1, 2),
(11, 'C4', 'Latar Belakang mengambil Program Magister', 1, 2),
(12, 'C5', 'Kesesuaian Pekerjaan dengan prodi yang diambil', 1, 2),
(13, 'C6', 'kemampuan berkomunikasi', 1, 2),
(14, 'C7', 'kemampuan bahasa inggris', 1, 2),
(15, 'C1', 'IPK', 1, 3),
(16, 'C2', 'TPA', 1, 3),
(17, 'C3', 'Latar Belakang Ilmu Kefarmasian', 1, 3),
(18, 'C4', 'Latar Belakang mengambil Program Magister', 1, 3),
(19, 'C5', 'Kesesuaian Pekerjaan dengan prodi yang diambil', 1, 3),
(20, 'C6', 'kemampuan berkomunikasi', 1, 3),
(21, 'C7', 'kemampuan bahasa inggris', 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fix_perangkingan`
--

CREATE TABLE `fix_perangkingan` (
  `id_perangkingan` int(10) NOT NULL,
  `id_pendaftaran` int(10) NOT NULL,
  `no_mahasiswa` varchar(100) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nilai_preferensi` decimal(10,8) NOT NULL,
  `keterangan` int(10) NOT NULL,
  `tanggal_pendaftaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fix_perangkingan`
--

INSERT INTO `fix_perangkingan` (`id_perangkingan`, `id_pendaftaran`, `no_mahasiswa`, `nama_mahasiswa`, `nilai_preferensi`, `keterangan`, `tanggal_pendaftaran`) VALUES
(2, 1, '3001', 'daskldjals', '17.35527746', 0, '06-Aug-2020'),
(3, 1, '3001', 'Giri', '62.40727652', 0, '06-Aug-2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gelombang`
--

CREATE TABLE `gelombang` (
  `id_gelombang` int(10) NOT NULL,
  `gelombang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gelombang`
--

INSERT INTO `gelombang` (`id_gelombang`, `gelombang`) VALUES
(1, 'Gelombang 1'),
(2, 'Gelombang 2'),
(3, 'Gelombang 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id_kelamin` int(10) NOT NULL,
  `kelamin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id_kelamin`, `kelamin`) VALUES
(1, 'L'),
(2, 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan_penilaian`
--

CREATE TABLE `keterangan_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `keterangan` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keterangan_penilaian`
--

INSERT INTO `keterangan_penilaian` (`id_penilaian`, `keterangan`) VALUES
(1, 'Tidak Baik'),
(2, 'Kurang Baik'),
(3, 'Cukup Baik'),
(4, 'Baik'),
(5, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_ket_krit` int(12) NOT NULL,
  `kode_kriteria` varchar(50) NOT NULL,
  `nama_ket_krit` varchar(100) NOT NULL,
  `id_atribut` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_ket_krit`, `kode_kriteria`, `nama_ket_krit`, `id_atribut`) VALUES
(1, 'C1', 'IPK', 1),
(2, 'C2', 'TPA', 1),
(3, 'C3', 'Latar Belakang Ilmu Kefarmasian', 1),
(4, 'C4', 'Latar Belakang mengambil Program Magister', 1),
(5, 'C5', 'Kesesuaian Pekerjaan dengan prodi yang diambil', 1),
(6, 'C6', 'kemampuan berkomunikasi', 1),
(8, 'C7', 'kemampuan bahasa inggris', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_minimum_preferensi`
--

CREATE TABLE `nilai_minimum_preferensi` (
  `id_minimum_preferensi` int(11) NOT NULL,
  `nilai_minimum` double(10,7) NOT NULL,
  `fix_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_minimum_preferensi`
--

INSERT INTO `nilai_minimum_preferensi` (`id_minimum_preferensi`, `nilai_minimum`, `fix_kriteria`) VALUES
(1, 22.1800000, 1),
(2, 22.1800000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkingan`
--

CREATE TABLE `perangkingan` (
  `id_perangkingan` int(10) NOT NULL,
  `id_pendaftaran` int(10) NOT NULL,
  `no_mahasiswa` varchar(100) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nilai_preferensi` double NOT NULL,
  `keterangan` int(10) NOT NULL,
  `tanggal_pendaftaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perangkingan`
--

INSERT INTO `perangkingan` (`id_perangkingan`, `id_pendaftaran`, `no_mahasiswa`, `nama_mahasiswa`, `nilai_preferensi`, `keterangan`, `tanggal_pendaftaran`) VALUES
(1, 1, '3001', 'Giri', 62.407276517, 1, '06-Aug-2020'),
(2, 1, '3002', 'Tias Eka Sucipto', 62.935959818, 1, '06-Aug-2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pv`
--

CREATE TABLE `pv` (
  `id_pv` int(11) NOT NULL,
  `pv` double(10,9) NOT NULL,
  `fix_pv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pv`
--

INSERT INTO `pv` (`id_pv`, `pv`, `fix_pv`) VALUES
(1, 0.119691533, 1),
(2, 0.505175348, 1),
(3, 0.094450391, 1),
(4, 0.049989142, 1),
(5, 0.067818449, 1),
(6, 0.123361464, 1),
(7, 0.039513674, 1),
(8, 0.119691533, 2),
(9, 0.505175348, 2),
(10, 0.094450391, 2),
(11, 0.049989142, 2),
(12, 0.067818449, 2),
(13, 0.123361464, 2),
(14, 0.039513674, 2),
(15, 0.119691533, 3),
(16, 0.505175348, 3),
(17, 0.094450391, 3),
(18, 0.049989142, 3),
(19, 0.067818449, 3),
(20, 0.123361464, 3),
(21, 0.039513674, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `range_penilaian`
--

CREATE TABLE `range_penilaian` (
  `id_range_penilaian` int(11) NOT NULL,
  `kode_kriteria` varchar(11) NOT NULL,
  `nilai_awal` double(100,5) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `nilai_akhir` double(100,5) NOT NULL,
  `fix_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `range_penilaian`
--

INSERT INTO `range_penilaian` (`id_range_penilaian`, `kode_kriteria`, `nilai_awal`, `id_penilaian`, `nilai_akhir`, `fix_kriteria`) VALUES
(1, 'C1', 0.00000, 1, 1.99000, 1),
(2, 'C1', 2.00000, 2, 2.75000, 1),
(3, 'C1', 2.76000, 3, 3.00000, 1),
(4, 'C1', 3.01000, 4, 3.50000, 1),
(5, 'C1', 3.51000, 5, 4.00000, 1),
(6, 'C2', 0.00000, 1, 80.00000, 1),
(7, 'C2', 81.00000, 2, 100.00000, 1),
(8, 'C2', 101.00000, 3, 120.00000, 1),
(9, 'C2', 121.00000, 4, 140.00000, 1),
(10, 'C2', 141.00000, 5, 160.00000, 1),
(11, 'C3', 0.00000, 1, 1.00000, 1),
(12, 'C3', 1.10000, 2, 2.00000, 1),
(13, 'C3', 2.10000, 3, 3.00000, 1),
(14, 'C3', 3.10000, 4, 4.00000, 1),
(15, 'C3', 4.10000, 5, 5.00000, 1),
(16, 'C4', 0.00000, 1, 1.00000, 1),
(17, 'C4', 1.10000, 2, 2.00000, 1),
(18, 'C4', 2.10000, 3, 3.00000, 1),
(19, 'C4', 3.10000, 4, 4.00000, 1),
(20, 'C4', 4.10000, 5, 5.00000, 1),
(21, 'C5', 0.00000, 1, 1.00000, 1),
(22, 'C5', 1.10000, 2, 2.00000, 1),
(23, 'C5', 2.10000, 3, 3.00000, 1),
(24, 'C5', 3.10000, 4, 4.00000, 1),
(25, 'C5', 4.10000, 5, 5.00000, 1),
(26, 'C6', 0.00000, 1, 1.00000, 1),
(27, 'C6', 1.10000, 2, 2.00000, 1),
(28, 'C6', 2.10000, 3, 3.00000, 1),
(29, 'C6', 3.10000, 4, 4.00000, 1),
(30, 'C6', 4.10000, 5, 5.00000, 1),
(31, 'C1', 0.00000, 1, 1.99000, 3),
(32, 'C1', 2.00000, 2, 2.75000, 3),
(33, 'C1', 2.76000, 3, 3.00000, 3),
(34, 'C1', 3.01000, 4, 3.50000, 3),
(35, 'C1', 3.51000, 5, 4.00000, 3),
(36, 'C2', 0.00000, 1, 80.00000, 3),
(37, 'C2', 81.00000, 2, 100.00000, 3),
(38, 'C2', 101.00000, 3, 120.00000, 3),
(39, 'C2', 121.00000, 4, 140.00000, 3),
(40, 'C2', 141.00000, 5, 169.00000, 3),
(41, 'C3', 0.00000, 1, 1.00000, 3),
(42, 'C3', 1.10000, 2, 2.00000, 3),
(43, 'C3', 2.10000, 3, 3.00000, 3),
(44, 'C3', 3.10000, 4, 4.00000, 3),
(45, 'C3', 4.10000, 5, 5.00000, 3),
(46, 'C4', 0.00000, 1, 1.00000, 3),
(47, 'C4', 1.10000, 2, 2.00000, 3),
(48, 'C4', 2.10000, 3, 3.00000, 3),
(49, 'C4', 3.10000, 4, 4.00000, 3),
(50, 'C4', 4.10000, 5, 5.00000, 3),
(51, 'C5', 0.00000, 1, 1.00000, 3),
(52, 'C5', 1.10000, 2, 2.00000, 3),
(53, 'C5', 2.10000, 3, 3.00000, 3),
(54, 'C5', 3.10000, 4, 4.00000, 3),
(55, 'C5', 4.10000, 5, 5.00000, 3),
(56, 'C6', 0.00000, 1, 1.00000, 3),
(57, 'C6', 1.10000, 2, 2.00000, 3),
(58, 'C6', 2.10000, 3, 3.00000, 3),
(59, 'C6', 3.10000, 4, 4.00000, 3),
(60, 'C6', 4.10000, 5, 5.00000, 3),
(61, 'C7', 0.00000, 1, 1.00000, 3),
(62, 'C7', 1.10000, 2, 2.00000, 3),
(63, 'C7', 2.10000, 3, 3.00000, 3),
(64, 'C7', 3.10000, 4, 4.00000, 3),
(65, 'C7', 4.10000, 5, 5.00000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_cr`
--

CREATE TABLE `tabel_cr` (
  `id_cr` int(10) NOT NULL,
  `n` int(10) NOT NULL,
  `ci` decimal(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tabel_cr`
--

INSERT INTO `tabel_cr` (`id_cr`, `n`, `ci`) VALUES
(1, 1, '0.0000'),
(2, 2, '0.0000'),
(3, 3, '0.5200'),
(4, 4, '0.8900'),
(5, 5, '1.1100'),
(6, 6, '1.2500'),
(7, 7, '1.3500'),
(8, 8, '1.4000'),
(9, 9, '1.4500'),
(10, 10, '1.4900');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id_pendaftaran` int(10) NOT NULL,
  `tahun_pendaftaran` int(100) NOT NULL,
  `gelombang` int(10) NOT NULL,
  `fix_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id_pendaftaran`, `tahun_pendaftaran`, `gelombang`, `fix_kriteria`) VALUES
(1, 2020, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(2, 'pengambil keputusan', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atribut`
--
ALTER TABLE `atribut`
  ADD PRIMARY KEY (`id_atribut`);

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `kode_banding` (`kode_banding`);

--
-- Indexes for table `data_konversi_data_mahasiswa`
--
ALTER TABLE `data_konversi_data_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `fix_bobot_kriteria`
--
ALTER TABLE `fix_bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`),
  ADD KEY `kode_banding` (`kode_banding`);

--
-- Indexes for table `fix_kriteria`
--
ALTER TABLE `fix_kriteria`
  ADD PRIMARY KEY (`id_ket_krit`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indexes for table `fix_perangkingan`
--
ALTER TABLE `fix_perangkingan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indexes for table `gelombang`
--
ALTER TABLE `gelombang`
  ADD PRIMARY KEY (`id_gelombang`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id_kelamin`);

--
-- Indexes for table `keterangan_penilaian`
--
ALTER TABLE `keterangan_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_ket_krit`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indexes for table `nilai_minimum_preferensi`
--
ALTER TABLE `nilai_minimum_preferensi`
  ADD PRIMARY KEY (`id_minimum_preferensi`);

--
-- Indexes for table `perangkingan`
--
ALTER TABLE `perangkingan`
  ADD PRIMARY KEY (`id_perangkingan`);

--
-- Indexes for table `pv`
--
ALTER TABLE `pv`
  ADD PRIMARY KEY (`id_pv`);

--
-- Indexes for table `range_penilaian`
--
ALTER TABLE `range_penilaian`
  ADD PRIMARY KEY (`id_range_penilaian`);

--
-- Indexes for table `tabel_cr`
--
ALTER TABLE `tabel_cr`
  ADD PRIMARY KEY (`id_cr`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atribut`
--
ALTER TABLE `atribut`
  MODIFY `id_atribut` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT for table `data_konversi_data_mahasiswa`
--
ALTER TABLE `data_konversi_data_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `data_mahasiswa`
--
ALTER TABLE `data_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fix_bobot_kriteria`
--
ALTER TABLE `fix_bobot_kriteria`
  MODIFY `id_bobot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `fix_kriteria`
--
ALTER TABLE `fix_kriteria`
  MODIFY `id_ket_krit` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `fix_perangkingan`
--
ALTER TABLE `fix_perangkingan`
  MODIFY `id_perangkingan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gelombang`
--
ALTER TABLE `gelombang`
  MODIFY `id_gelombang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id_kelamin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `keterangan_penilaian`
--
ALTER TABLE `keterangan_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_ket_krit` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `nilai_minimum_preferensi`
--
ALTER TABLE `nilai_minimum_preferensi`
  MODIFY `id_minimum_preferensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `perangkingan`
--
ALTER TABLE `perangkingan`
  MODIFY `id_perangkingan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pv`
--
ALTER TABLE `pv`
  MODIFY `id_pv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `range_penilaian`
--
ALTER TABLE `range_penilaian`
  MODIFY `id_range_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `tabel_cr`
--
ALTER TABLE `tabel_cr`
  MODIFY `id_cr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id_pendaftaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
