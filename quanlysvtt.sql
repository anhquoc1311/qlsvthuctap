-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 11:38 AM
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

--
-- Dumping data for table `congviec`
--

INSERT INTO `congviec` (`id_cv`, `tencongviec`, `tendetai`, `tennhomnguoihuongdan`, `ngaybatdau`, `ngayketthuc`, `nhanxet`) VALUES
(1, 'làm form', 'quanlyhethong', 'nnn', '2024-01-08', '2024-01-11', 'làm cho hệ thống tốt'),
(2, '1', 'quanlyhethong', '1', '2024-01-25', '2024-02-03', '1');

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
('Vnpt ', 'admin', 'Vnpt@123', 'admin'),
('quocc', 'q', 'Quoc@2002', 'user');

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
('khoahoc', '2'),
('kinhte1', 'kt');

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
(4, 'anh thư', 1, 'anh@gmail.ocm', 'nhân viên', '1', 'anhquoc', '123456', 'zalo', 'facde', 'g', 'g');

-- --------------------------------------------------------

--
-- Table structure for table `nhomnguoihd`
--

CREATE TABLE `nhomnguoihd` (
  `id_nhomnguoihd` int(11) NOT NULL,
  `tennhomnguoihuongdan` varchar(100) NOT NULL,
  `tennhomthuctap` varchar(100) NOT NULL,
  `kithuctap` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL,
  `thoigianbatdau` datetime DEFAULT NULL,
  `thoigianketthuc` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhomtt`
--

CREATE TABLE `nhomtt` (
  `id` int(11) NOT NULL,
  `tennhom` varchar(100) NOT NULL,
  `detai` varchar(100) NOT NULL,
  `hotensinhvien` varchar(100) NOT NULL,
  `ngaybd` date NOT NULL,
  `ngaykt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhomtt`
--

INSERT INTO `nhomtt` (`id`, `tennhom`, `detai`, `hotensinhvien`, `ngaybd`, `ngaykt`) VALUES
(1, 'as', 'qlsv', 'hi', '2024-01-17', '2024-01-18'),
(2, 'thm', '1', '1', '2024-01-11', '2024-01-26'),
(3, 'nhóm 1', '1', 'Trần Anh Quốc', '2024-01-17', '2024-02-03'),
(4, '1', '1', '', '2024-01-17', '2024-01-26'),
(5, '11', '11', '', '2024-01-19', '2024-02-03'),
(6, 'sâ', '11', 'thư', '2024-01-11', '2024-02-04'),
(7, 'aaa', 'aaa', 'Trần Anh Quốc', '2024-01-17', '2024-02-02'),
(8, 'nnn', 'ffff', 'aaaaaaaaaa', '2024-01-17', '2024-01-25');

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
('2000416233', 'anhquoc', 'Nam', '0795915320', 'a@gmail.com', '1', '1', 'Sư phạm kỹ thuật', 'khoahoc', '1', '2', 101),
('2000416210', 'Trần Anh Quốc', 'Nam', '0795915320', 'anhquoc@gmail.com', 'vĩnh long', '1ctt', 'truongkinhte', 'cntt', '45', 'nhom1', 102);

-- --------------------------------------------------------

--
-- Table structure for table `tendetai`
--

CREATE TABLE `tendetai` (
  `tendetai` varchar(100) NOT NULL,
  `mota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tendetai`
--

INSERT INTO `tendetai` (`tendetai`, `mota`) VALUES
('quanlyhethong', '1'),
('quanlysinhvien', 'làm 1 web quản lý sinh viên');

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
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id_nhomnguoihd`);

--
-- Indexes for table `nhomtt`
--
ALTER TABLE `nhomtt`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `congviec`
--
ALTER TABLE `congviec`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kythuctap`
--
ALTER TABLE `kythuctap`
  MODIFY `id_kythuctap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  MODIFY `id_nguoihuongdan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  MODIFY `id_nhomnguoihd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhomtt`
--
ALTER TABLE `nhomtt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`truonghoc`) REFERENCES `truong` (`truonghoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`nganh`) REFERENCES `nganh` (`nganh`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
