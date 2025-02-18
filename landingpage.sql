-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 03:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landingpage`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_pic` int(11) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_pic`, `kegiatan`, `gambar`) VALUES
(14, 'Mewarnai', 'IMG_20231204_171743.jpg'),
(15, 'Games', 'IMG-20230411-WA0051.jpg'),
(18, 'Nobar', 'IMG_20230410_160524_HDR.jpg'),
(20, 'Menulis', 'menulis.jpg'),
(21, 'Praktik Shalat', 'shalat.jpg'),
(22, 'Baca Cahayaku', 'jilid.jpg'),
(23, 'tidur', 'IMG_20220110_173748_HDR.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_teach` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_teach`, `nama`, `jabatan`, `foto`) VALUES
(9, 'Lisna Oktaviani', 'Kepala Sekolah', 'maguru.png'),
(11, 'Zulhida', 'Administrasi', 'diem.png'),
(12, 'Namirah', 'Walas Alif', 'meguri.png'),
(13, 'Diajeng Julia Larasari', 'Walas Ba', 'download__1_-removebg-preview.png'),
(14, 'Intan Delima', 'Walas TA', 'muter.png'),
(15, 'Maulida', 'Walas Tsa', 'meguri.png');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_pel` int(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `ket` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_pel`, `gambar`, `judul`, `ket`) VALUES
(23, 'IMG-20220809-WA0011.jpg', 'Pembukaan', 'Dipimpin oleh salah satu murid yang ditunjuk untuk menyiapkan lalu membaca Al Fatihah dan doa belajar bersama-sama'),
(24, 'IMG-20221108-WA0011.jpg', 'Murojaah', 'Murojaah hafalan doa/hadits/surat/pelajaran yang sudah pernah di pelajari sebelum-sebelumnya'),
(25, 'IMG-20220907-WA0011.jpg', 'Belajar', 'Memberikan materi baru sesuai dengan kurikulum yang sudah di siapkan, bisa menulis, menghafal, dsb'),
(26, 'IMG-20220707-WA0011.jpg', 'Baca Jilid', 'Satu persatu murid maju untuk membaca jilid pada bagiannya masing-masing'),
(27, 'IMG-20221026-WA0016.jpg', 'Penutup', 'Doa penutup dipimpin oleh salah satu murid yang ditunjuk untuk menyiapkan lalu membaca khataman al quran / surat al asr dan doa penutup majelis'),
(28, 'IMG-20211209-WA0014.jpg', 'Test Materi', 'Diberikan pertanyaan seputar materi yang tadi diberikan dan yang bisa menjawab paling cepat boleh pulang terlebih dahulu');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('dea', '000'),
('sensei', '#1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_pic`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_teach`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_pel`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_pic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_teach` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id_pel` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
