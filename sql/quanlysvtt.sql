-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 03:44 PM
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
(20, 'aaaaa', 'aaaa2232', 'asdadasd', '', '2024-02-17', '2024-02-03', 'aaaaaaaaaa'),
(21, 'aaaaaaaaaaa', 'aaaa2232', 'aaaaaaaaaaaaa', '', '2024-02-17', '2024-02-25', 'aaaaaaaaa');

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
(1, '1', '2', '1', '1'),
(2, 'anh quân', '1', 'aaa', '1'),
(3, 'anh quân', '1', 'aaa', '1'),
(4, 's', '1', 'a', 'S'),
(5, 'ádas', '1', 'aaasas', 'âsasas'),
(6, 'ádas', '3', 'aaasas', 'âsasas'),
(7, 'khanhdang', '1', 'eweee', 'eeee'),
(8, 'wwew', '1', 'ewrwer', 'werwer'),
(9, 'wwwwwwwwwwwwwww', '1', 'wwwwwwww', 'wwwwwwwwwwwww'),
(10, 'khanhdang', '1', 'a', 'a'),
(11, 'khanhdang', '1', 'aaa', 'aaaa'),
(12, 'khanhdang', '1', 'aaa', 'aaaa'),
(13, 'khanhdang', '1', 'aa', 'aaa'),
(14, 'khanhdang', '1', 'aaa', 'aaa'),
(15, 'khanhdang', '1', 'aaa', 'aaaa'),
(16, 'khanhdang', '1', 'aaa', 'aaaa'),
(17, 'khanhdang', '1', 'aaa', 'aaaa');

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
(34, 'adasdasdas', 'quản lý sinh viên', '2024-02-29', '2024-02-18'),
(35, 'aaaaaaaasascsfdsad', 'aaaa2232', '2024-03-10', '2024-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `tennganh` varchar(100) NOT NULL,
  `kyhieu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`tennganh`, `kyhieu`) VALUES
('aaaasasadasdasd', 'âsasasas'),
('âsas', 'âsasas'),
('ssss', 'ssss');

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
(15, 'Lê Khánh Đăng', 42342343, 'khanhdang25062001@gmail.com', 'abád', 'Bảo Vệ', 'khang123', 'khang123', '234234', 'https://www.facebook.com/thanhvancute2506/', 'sdfsd', '1708695209_OIP.jpg');

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
(22, 'anhquan', '3', '3', 'quản lý dữ liệu', '2024-01-31 07:44:00', '2024-02-18 07:44:00'),
(23, '1', 'nhóm 1', 'kỳ 1', 'quản lý dữ liệu', '2024-02-08 07:55:00', '2024-02-17 07:55:00'),
(24, 'ssssss', 'abc', 'aaaaaaaasascsfdsad', '', '2024-02-23 20:40:00', '2024-02-23 20:40:00'),
(25, 'ss', 'nhóm 3', 'adasdasdas', 'aaaa2232', '2024-02-17 21:07:00', '2024-02-25 21:07:00'),
(26, 'ss', 'nhóm 3', 'adasdasdas', 'aaaa2232', '2024-02-17 21:07:00', '2024-02-25 21:07:00');

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
(15, 'nhóm 3', 'aa', 'Lê Khánh Đăng', '2024-02-21', '2024-02-16'),
(16, 'nhóm 1s', 'aa', 'Lê Khánh Đăng', '2024-02-23', '2024-02-23');

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
('2000401821', 'Lê Khánh Đăng', 'Nam', '0977088488', 'khanhdang25062001@gmail.com', 'sss', '1ctt20a2', 'sdfsdf', 'âsas', '45', 'abc', 118);

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
('aaaa2232', 'asdasdasd            '),
('aw1', 'â                                                                                                '),
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
('adasdasdasdasdasdasd', 'asdasdasdas'),
('f', 'g'),
('sdfsdf', '1');

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
  ADD PRIMARY KEY (`tennganh`);

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
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `danhgiaandanh`
--
ALTER TABLE `danhgiaandanh`
  MODIFY `id_danhgia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kythuctap`
--
ALTER TABLE `kythuctap`
  MODIFY `id_kythuctap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `nguoihuongdan`
--
ALTER TABLE `nguoihuongdan`
  MODIFY `id_nguoihuongdan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nhomnguoihd`
--
ALTER TABLE `nhomnguoihd`
  MODIFY `id_nhomnguoihd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nhomtt`
--
ALTER TABLE `nhomtt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sinhvien`
--
ALTER TABLE `sinhvien`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

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
  ADD CONSTRAINT `sinhvien_ibfk_2` FOREIGN KEY (`nganh`) REFERENCES `nganh` (`tennganh`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
