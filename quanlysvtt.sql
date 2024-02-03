-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2024 at 02:11 AM
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
  `tennhomtt` varchar(255) NOT NULL,
  `ngaybatdau` date NOT NULL,
  `ngayketthuc` date NOT NULL,
  `nhanxet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `congviec`
--

INSERT INTO `congviec` (`id_cv`, `tencongviec`, `tendetai`, `tennhomnguoihuongdan`, `tennhomtt`, `ngaybatdau`, `ngayketthuc`, `nhanxet`) VALUES
(4, 'công việc 1', 'quản lý dữ liệu', 'nhomhd1', 'nhóm 2', '2024-02-01', '2024-02-02', 'thực hiện tốt'),
(5, '1', 'quản lý dữ liệu', '1', '', '2024-02-08', '2024-02-10', '1');

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
('quocc', 'q', 'Quoc@2002', 'user'),
('1', '1', 'Quoc@2002', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `hotensinhvien` varchar(100) NOT NULL,
  `nhomnguoihuongdan` varchar(100) NOT NULL,
  `ythuckyluat` text NOT NULL,
  `diemythuckyluat` float NOT NULL,
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

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`id`, `hotensinhvien`, `nhomnguoihuongdan`, `ythuckyluat`, `diemythuckyluat`, `tuanthuthoigian`, `diemtuanthuthoigian`, `kienthuc`, `diemkienthuc`, `kynangnghe`, `diemkynangnghe`, `kinangdoclap`, `diemkinangdoclap`, `khanangnhom`, `diemkhanangnhom`, `khananggiaiquyetcongviec`, `diemkhananggiaiquyetcongviec`, `danhgiachung`, `ngaydanhgia`) VALUES
(3, '1111', '4', 'tốt', 11, '1', 1, 'tốt', 1, 'tốt', 1, 'tốt', 1, 'tốt', 1, 'tốt', 1, 17, '2024-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `danhgiaandanh`
--

CREATE TABLE `danhgiaandanh` (
  `id_danhgia` int(11) NOT NULL,
  `hoten_nguoidanhgia` varchar(100) NOT NULL,
  `mucdohailong` varchar(100) NOT NULL,
  `nhận xet` text NOT NULL,
  `danhgiakhac` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhgiaandanh`
--

INSERT INTO `danhgiaandanh` (`id_danhgia`, `hoten_nguoidanhgia`, `mucdohailong`, `nhận xet`, `danhgiakhac`) VALUES
(1, '1', '2', '1', '1');

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

--
-- Dumping data for table `kythuctap`
--

INSERT INTO `kythuctap` (`id_kythuctap`, `tenkythuctap`, `tendetai`, `ngaybatdau`, `ngayketthuc`) VALUES
(3, 'kỳ 1', 'quản lý sinh viên', '2024-02-03', '2024-02-04');

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
  `tennguoihuongdan` varchar(100) NOT NULL,
  `tennhomthuctap` varchar(100) NOT NULL,
  `kithuctap` varchar(100) NOT NULL,
  `tendetai` varchar(100) NOT NULL,
  `thoigianbatdau` datetime DEFAULT NULL,
  `thoigianketthuc` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhomnguoihd`
--

INSERT INTO `nhomnguoihd` (`id_nhomnguoihd`, `tennguoihuongdan`, `tennhomthuctap`, `kithuctap`, `tendetai`, `thoigianbatdau`, `thoigianketthuc`) VALUES
(6, 'nhóm 1', 'nhóm 1', 'nhóm 1', 'nhóm 1', '2024-01-23 14:41:00', '2024-01-24 14:41:00'),
(7, 'nhóm 1', 'nhóm 1', 'nhóm 1', 'nhóm 1', '2024-01-23 14:41:00', '2024-01-24 14:41:00'),
(8, 'nhóm 1', 'nhóm 1', 'nhóm 1', 'nhóm 1', '2024-01-23 14:41:00', '2024-01-24 14:41:00'),
(9, 'nhóm 1', 'nhóm 1', 'nhóm 1', 'nhóm 1', '2024-01-23 14:41:00', '2024-01-24 14:41:00'),
(10, '1', '1', '1', '1', '2024-01-11 14:46:00', '2024-02-08 14:46:00'),
(11, '1111', '1111', '1111', '1111', '2024-02-09 19:57:00', '2024-02-16 19:57:00'),
(12, 'anhquan', '3', '3', 'quản lý dữ liệu', '2024-01-31 07:44:00', '2024-02-18 07:44:00'),
(16, 'anhha', '3', '3', 'quản lý dữ liệu', '2024-02-14 07:46:00', '2024-02-24 07:46:00'),
(17, 'anhhao', '11', '3', 'quản lý sinh viên', '2024-02-06 07:45:00', '2024-02-15 07:45:00'),
(18, 'anhhao', '11', '3', 'quản lý dữ liệu', '2024-02-06 07:45:00', '2024-02-15 07:45:00'),
(19, 'anhhao', '11', '3', 'quản lý dữ liệu', '2024-02-06 07:45:00', '2024-02-15 07:45:00'),
(20, 'anhquan', '3', '3', 'quản lý dữ liệu', '2024-01-31 07:44:00', '2024-02-18 07:44:00'),
(21, 'anhquan', '3', '3', 'quản lý dữ liệu', '2024-01-31 07:44:00', '2024-02-18 07:44:00'),
(22, 'anhquan', '3', '3', 'quản lý dữ liệu', '2024-01-31 07:44:00', '2024-02-18 07:44:00'),
(23, '1', 'nhóm 1', 'kỳ 1', 'quản lý dữ liệu', '2024-02-08 07:55:00', '2024-02-17 07:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `nhomtt`
--

CREATE TABLE `nhomtt` (
  `id` int(11) NOT NULL,
  `tennhom` varchar(255) NOT NULL,
  `detai` varchar(100) NOT NULL,
  `hotensinhvien` varchar(100) NOT NULL,
  `ngaybd` date NOT NULL,
  `ngaykt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhomtt`
--

INSERT INTO `nhomtt` (`id`, `tennhom`, `detai`, `hotensinhvien`, `ngaybd`, `ngaykt`) VALUES
(3, 'nhóm 1', '1', 'Trần Anh Quốc', '2024-01-17', '2024-02-03'),
(6, 'sâ', '11', 'thư', '2024-01-11', '2024-02-04'),
(7, 'aaa', 'aaa', 'Trần Anh Quốc', '2024-01-17', '2024-02-02'),
(11, 'nhóm 2', 'quản lý dữ liệu', 'quốc thư', '2024-02-01', '2024-02-08');

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
('2000416210', 'Trần Anh Quốc', 'Nam', '0795915320', 'anhquoc@gmail.com', 'vĩnh long', '1ctt', 'truongkinhte', 'cntt', '45', 'nhom1', 102),
('2000416234', 'Anh Thư', 'Nữ', '0795915323', 'thu@gmail.com', 'mang thít', '1', 'Sư phạm kỹ thuật', 'khoahoc', '1', 'anh Minh', 103),
('2000416235', 'Nhựt Hào', 'Nam', '0795915324', 'Hao@gmail.com', 'mang thít', '1', 'Sư phạm kỹ thuật', 'khoahoc', '1', 'anh Minh', 104);

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
('quản lý dữ liệu', 'thực hiện 3 sinh viên'),
('quản lý sinh viên', 'thực hiện khoảng 5-10 sinh viên');

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
-- Indexes for table `danhgiaandanh`
--
ALTER TABLE `danhgiaandanh`
  ADD PRIMARY KEY (`id_danhgia`);

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
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `danhgiaandanh`
--
ALTER TABLE `danhgiaandanh`
  MODIFY `id_danhgia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kythuctap`
--
ALTER TABLE `kythuctap`
  MODIFY `id_kythuctap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  MODIFY `id_nguoihuongdan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  MODIFY `id_nhomnguoihd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `nhomtt`
--
ALTER TABLE `nhomtt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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
