-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 11:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlsvtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `congviec`
--

CREATE TABLE `congviec` (
  `id` int(11) NOT NULL,
  `tendetai` varchar(100) NOT NULL,
  `nhomnhd` varchar(100) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL,
  `nhanxet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dangky`
--

CREATE TABLE `dangky` (
  `tentk` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `quyen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dangky`
--

INSERT INTO `dangky` (`tentk`, `username`, `password`, `quyen`) VALUES
('Vnpt ', 'admin', 'Vnpt@123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `tensinhvien` varchar(100) NOT NULL,
  `nhomnguoihuongdan` varchar(100) NOT NULL,
  `ythuckyluat` text NOT NULL,
  `diemythuckyuat` float NOT NULL,
  `tuanthuthoigian` text NOT NULL,
  `diemtuanthuthoigian` float NOT NULL,
  `kienthuc` text NOT NULL,
  `diemkienthuc` float NOT NULL,
  `kynangnghe` text NOT NULL,
  `diemkynangnghe` float NOT NULL,
  `kinangdoclap` text NOT NULL,
  `diemkinangdoclap` float NOT NULL,
  `khanangnhom` text NOT NULL,
  `diemkhanangnhom` float NOT NULL,
  `khananggiaiquyetcongviec` text NOT NULL,
  `diemkhananggiaiquyetcongviec` float NOT NULL,
  `danhgiachung` float NOT NULL,
  `ngaydanhgia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detai`
--

CREATE TABLE `detai` (
  `id` int(11) NOT NULL,
  `tendetai` int(11) NOT NULL,
  `motadetai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kythuctap`
--

CREATE TABLE `kythuctap` (
  `id` int(11) NOT NULL,
  `ngaybd` date NOT NULL,
  `ngaykt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `id` int(11) NOT NULL,
  `tennganh` varchar(100) NOT NULL,
  `kyhieu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoihuongdan`
--

CREATE TABLE `nguoihuongdan` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `sdt` int(11) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `chucdanh` varchar(100) NOT NULL,
  `phong` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `zalo` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `github` varchar(100) NOT NULL,
  `avata` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhomnguoihd`
--

CREATE TABLE `nhomnguoihd` (
  `id` int(11) NOT NULL,
  `tennguoihuongdan` varchar(100) NOT NULL,
  `kithuctap` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `mssv` varchar(100) NOT NULL,
  `hotensinhvien` varchar(100) NOT NULL,
  `gioitinh` varchar(100) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `gmail` varchar(100) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `malop` varchar(100) NOT NULL,
  `truonghoc` varchar(100) NOT NULL,
  `nganh` varchar(100) NOT NULL,
  `khoa` varchar(100) NOT NULL,
  `nhomnguoihuongdan` varchar(100) NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truong`
--

CREATE TABLE `truong` (
  `id` int(11) NOT NULL,
  `truonghoc` varchar(100) NOT NULL,
  `kyhieutruong` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detai`
--
ALTER TABLE `detai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kythuctap`
--
ALTER TABLE `kythuctap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truong`
--
ALTER TABLE `truong`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `congviec`
--
ALTER TABLE `congviec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detai`
--
ALTER TABLE `detai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kythuctap`
--
ALTER TABLE `kythuctap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nganh`
--
ALTER TABLE `nganh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `truong`
--
ALTER TABLE `truong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congviec`
--
ALTER TABLE `congviec`
  ADD CONSTRAINT `congviec_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detai`
--
ALTER TABLE `detai`
  ADD CONSTRAINT `detai_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kythuctap`
--
ALTER TABLE `kythuctap`
  ADD CONSTRAINT `kythuctap_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`);

--
-- Constraints for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  ADD CONSTRAINT `nguoihuongdan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nhomnguoihd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
