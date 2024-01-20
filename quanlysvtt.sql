-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 08:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlysvtt`
--

-- --------------------------------------------------------

--
-- Table structure for table `congviec`
--

CREATE TABLE `congviec` (
  `id_cv` int(11) NOT NULL,
  `tencongviec` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL,
  `tennhomnguoihuongdan` varchar(100) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL,
  `nhanxet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `hotensinhvien` varchar(100) NOT NULL,
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
-- Table structure for table `kythuctap`
--

CREATE TABLE `kythuctap` (
  `id_kythuctap` int(11) NOT NULL,
  `tenkythuctap` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `nganh` varchar(100) NOT NULL,
  `kyhieu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`nganh`, `kyhieu`) VALUES
('cntt', '1ctt'),
('cntt2', '2'),
('kt', '1');

-- --------------------------------------------------------

--
-- Table structure for table `nguoihuongdan`
--

CREATE TABLE `nguoihuongdan` (
  `id_nguoihuongdan` int(11) NOT NULL,
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

--
-- Dumping data for table `nguoihuongdan`
--

INSERT INTO `nguoihuongdan` (`id_nguoihuongdan`, `ten`, `sdt`, `gmail`, `chucdanh`, `phong`, `username`, `password`, `zalo`, `facebook`, `github`, `avata`) VALUES
(1, 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `nhomnguoihd`
--

CREATE TABLE `nhomnguoihd` (
  `id_nhomnguoihd` int(11) NOT NULL,
  `tennhomnguoihuongdan` varchar(100) NOT NULL,
  `tennhomthuctap` varchar(100) NOT NULL,
  `kithuctap` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhomthuctap`
--

CREATE TABLE `nhomthuctap` (
  `tennhomthuctap` varchar(100) NOT NULL,
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

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`mssv`, `hotensinhvien`, `gioitinh`, `sdt`, `gmail`, `diachi`, `malop`, `truonghoc`, `nganh`, `khoa`, `nhomnguoihuongdan`, `id`) VALUES
('2000416222', 'anhquoc', 'Nam', '0795915320', 'quoc@gmail.com', '1', '1', 'kt', 'cntt', '1', '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tendetai`
--

CREATE TABLE `tendetai` (
  `tendetai` varchar(100) NOT NULL,
  `mota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truong`
--

CREATE TABLE `truong` (
  `truonghoc` varchar(100) NOT NULL,
  `kyhieutruong` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truong`
--

INSERT INTO `truong` (`truonghoc`, `kyhieutruong`) VALUES
('kt', '1'),
('Sư phạm kỹ thuật', 'spkt'),
('truongkinhte', 'tk1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`id_cv`),
  ADD KEY `tendetai` (`tendetai`);

--
-- Indexes for table `kythuctap`
--
ALTER TABLE `kythuctap`
  ADD PRIMARY KEY (`id_kythuctap`),
  ADD KEY `tendetai` (`tendetai`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`nganh`);

--
-- Indexes for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  ADD PRIMARY KEY (`id_nguoihuongdan`);

--
-- Indexes for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  ADD PRIMARY KEY (`id_nhomnguoihd`),
  ADD KEY `tennhomthuctap` (`tennhomthuctap`);

--
-- Indexes for table `nhomthuctap`
--
ALTER TABLE `nhomthuctap`
  ADD PRIMARY KEY (`tennhomthuctap`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `truonghoc` (`truonghoc`),
  ADD KEY `nganh` (`nganh`);

--
-- Indexes for table `tendetai`
--
ALTER TABLE `tendetai`
  ADD PRIMARY KEY (`tendetai`);

--
-- Indexes for table `truong`
--
ALTER TABLE `truong`
  ADD PRIMARY KEY (`truonghoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  MODIFY `id_nguoihuongdan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `congviec`
--
ALTER TABLE `congviec`
  ADD CONSTRAINT `congviec_ibfk_1` FOREIGN KEY (`tendetai`) REFERENCES `tendetai` (`tendetai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kythuctap`
--
ALTER TABLE `kythuctap`
  ADD CONSTRAINT `kythuctap_ibfk_1` FOREIGN KEY (`tendetai`) REFERENCES `tendetai` (`tendetai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  ADD CONSTRAINT `nhomnguoihd_ibfk_1` FOREIGN KEY (`tennhomthuctap`) REFERENCES `nhomthuctap` (`tennhomthuctap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`truonghoc`) REFERENCES `truong` (`truonghoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`nganh`) REFERENCES `nganh` (`nganh`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
