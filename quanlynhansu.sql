-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2026 at 03:12 PM
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
-- Database: `quanlynhansu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baohiem`
--

CREATE TABLE `tbl_baohiem` (
  `IDBH` int(11) NOT NULL,
  `SoBH` varchar(50) DEFAULT NULL,
  `NgayCap` date DEFAULT NULL,
  `NoiCap` varchar(50) DEFAULT NULL,
  `NoiKhamBenh` varchar(50) DEFAULT NULL,
  `MaNV` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_baohiem`
--

INSERT INTO `tbl_baohiem` (`IDBH`, `SoBH`, `NgayCap`, `NoiCap`, `NoiKhamBenh`, `MaNV`) VALUES
(101, '123456', '2024-11-12', 'Hà Nội', 'Hà Nội', 11),
(102, '234567', '2023-12-13', 'Hà Nội', 'Hà Nội', 12),
(103, '345678', '2025-01-10', 'Hà Nội', 'Hà Nội', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bophan`
--

CREATE TABLE `tbl_bophan` (
  `IDBP` int(11) NOT NULL,
  `TenBP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_bophan`
--

INSERT INTO `tbl_bophan` (`IDBP`, `TenBP`) VALUES
(1, 'Kinh Doanh'),
(2, 'Kế Toán'),
(3, 'Nhân Sự'),
(4, 'Kỹ Thuật'),
(5, 'Marketing'),
(6, 'Logistics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chamcong`
--

CREATE TABLE `tbl_chamcong` (
  `MaCC` int(11) NOT NULL,
  `MaNV` varchar(15) DEFAULT NULL,
  `Hoten` varchar(50) DEFAULT NULL,
  `Ngay` date DEFAULT NULL,
  `TrangThai` varchar(500) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chamcong`
--

INSERT INTO `tbl_chamcong` (`MaCC`, `MaNV`, `Hoten`, `Ngay`, `TrangThai`, `is_deleted`) VALUES
(1, 'NV01', 'Nguyễn Ngọc Linh', '2026-01-04', 'Đi làm', 0),
(2, 'NV02', 'Nguyễn Trường Giang', '2026-01-04', 'Đi làm', 0),
(3, 'NV03', 'Trịnh Phương An', '2026-01-04', 'Đi làm', 0),
(4, 'NV04', 'Phan Trọng Quân', '2026-01-04', 'Đi làm', 0),
(5, 'NV05', 'Nguyền Hoàng Dương', '2026-01-03', 'Đã nghỉ', 1),
(6, 'NV06', 'Lưu Thanh Duy', '2026-01-03', 'Đã nghỉ', 1),
(8, 'NV07', 'abc', '2026-01-04', 'Đi làm', 1),
(9, 'NV07', 'abc', '2026-01-04', 'Đã nghỉ', 1),
(10, 'NV07', 'abc', '2026-01-04', 'Đã nghỉ', 1),
(11, 'NV07', 'jjhh', '2026-01-04', 'Đi làm', 1),
(12, 'NV05', 'Nguyền Hoàng Dương', '2026-01-04', 'Đi làm', 0),
(13, 'NV06', 'Lưu Thanh Duy', '2026-01-04', 'Đi làm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chucvu`
--

CREATE TABLE `tbl_chucvu` (
  `IDCV` int(11) NOT NULL,
  `TenCV` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_chucvu`
--

INSERT INTO `tbl_chucvu` (`IDCV`, `TenCV`) VALUES
(1, 'Giám Đốc'),
(2, 'Phó Giám đốc'),
(3, 'Quản Lý'),
(4, 'Trưởng Phòng'),
(5, 'Phó Trưởng phòng');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hopdong`
--

CREATE TABLE `tbl_hopdong` (
  `SoHD` int(11) NOT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `NgayKi` date DEFAULT NULL,
  `NoiDung` varchar(5000) DEFAULT NULL,
  `LanKy` int(11) DEFAULT NULL,
  `ThoiHan` varchar(50) DEFAULT NULL,
  `HeSoLuong` float DEFAULT NULL,
  `MaNV` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khenthuongkyluat`
--

CREATE TABLE `tbl_khenthuongkyluat` (
  `ID` int(11) NOT NULL,
  `SoKTKL` int(11) DEFAULT NULL,
  `NoiDung` varchar(500) DEFAULT NULL,
  `Ngay` date DEFAULT NULL,
  `MaNV` varchar(15) DEFAULT NULL,
  `Loai` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_khenthuongkyluat`
--

INSERT INTO `tbl_khenthuongkyluat` (`ID`, `SoKTKL`, `NoiDung`, `Ngay`, `MaNV`, `Loai`) VALUES
(1, 1001, 'Hoàn thành xuất sắc nhiệm vụ quý I', '2025-03-10', 'NV01', 1),
(2, 1002, 'Đi làm muộn nhiều lần', '2025-04-15', 'NV02', 0),
(3, 1003, 'Đạt doanh số cao nhất tháng', '2025-07-05', 'NV03', 1),
(4, 1004, 'Vi phạm nội quy công ty', '2025-08-12', 'NV04', 0),
(5, 1005, 'Tinh thần làm việc tốt', '2025-09-12', 'NV05', 1),
(6, 1006, 'Hoàn Thành Nhiệm Vụ Qúy II', '2025-10-12', 'NV06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaica`
--

CREATE TABLE `tbl_loaica` (
  `IDLoaiCa` int(11) NOT NULL,
  `TenLoaiCa` varchar(50) DEFAULT NULL,
  `HeSo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_luong`
--

CREATE TABLE `tbl_luong` (
  `ID` int(11) NOT NULL,
  `MaNV` varchar(15) DEFAULT NULL,
  `hoten` varchar(255) NOT NULL,
  `Luongcoban` int(11) DEFAULT NULL,
  `Phucap` int(11) DEFAULT NULL,
  `ThueTNCN` int(11) DEFAULT NULL,
  `Tongluong` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_luong`
--

INSERT INTO `tbl_luong` (`ID`, `MaNV`, `hoten`, `Luongcoban`, `Phucap`, `ThueTNCN`, `Tongluong`, `is_deleted`) VALUES
(1, 'NV01', 'Nguyễn Ngọc Linh', 5000000, 2000000, 500000, 6500000, 0),
(2, 'NV02', 'Lê Thanh Thảo', 5000000, 2000000, 500000, 6500000, 0),
(3, 'NV03', 'Trịnh Phương An', 5000000, 2000000, 500000, 6500000, 0),
(4, 'NV04', 'Phan Trọng Quân', 5000000, 2000000, 500000, 6500000, 0),
(5, 'NV05', 'Nguyền Hoàng Dương', 5000000, 2000000, 500000, 6500000, 0),
(6, 'NV06', 'Lưu Thanh Duy', 5000000, 0, 0, 5000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `MaNV` varchar(15) NOT NULL,
  `HoTen` varchar(50) DEFAULT NULL,
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DienThoai` varchar(50) DEFAULT NULL,
  `CCCD` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(300) DEFAULT NULL,
  `IDPB` int(11) DEFAULT NULL,
  `IDBP` int(11) DEFAULT NULL,
  `IDCV` int(11) DEFAULT NULL,
  `IDTD` int(11) DEFAULT NULL,
  `TrangThai` varchar(50) NOT NULL DEFAULT 'Còn làm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`MaNV`, `HoTen`, `GioiTinh`, `NgaySinh`, `DienThoai`, `CCCD`, `DiaChi`, `IDPB`, `IDBP`, `IDCV`, `IDTD`, `TrangThai`) VALUES
('NV01', 'Nguyễn Ngọc Linh', b'1', '2004-12-08', '0348624035', '466321654525', 'Hải Dương', 1, 1, 11, 21, 'Còn làm'),
('NV02', 'Lê Thanh Thảo', b'1', '2004-12-09', '0345485654', '215687439578', 'Hà Nội ', 2, 2, 12, 22, 'Còn làm'),
('NV03', 'Trịnh Phương An', b'1', '2005-12-06', '0314256987', '023159486798', 'Hà Nội ', 3, 3, 13, 23, 'Còn làm'),
('NV04', 'Phan Trọng Quân', b'0', '2004-01-03', '0341527895', '321452697854', 'Bắc Ninh', 4, 4, 14, 24, 'Còn làm'),
('NV05', 'Nguyền Hoàng Dương', b'0', '2004-01-16', '0345678951', '201456348621', 'Hà Nội', 5, 5, 15, 25, 'Còn làm'),
('NV06', 'Lưu Thanh Duy', b'0', '2004-12-08', '0348795247', '014258369456', 'Bắc Ninh', 6, 6, 16, 26, 'Còn làm'),
('NV67165', 'linh', b'1', '2004-02-06', '0945758', NULL, NULL, 0, NULL, 0, NULL, 'Còn làm');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phongban`
--

CREATE TABLE `tbl_phongban` (
  `IDPB` int(11) NOT NULL,
  `TenPB` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_phongban`
--

INSERT INTO `tbl_phongban` (`IDPB`, `TenPB`) VALUES
(1, 'Phòng Marketing'),
(2, 'Phòng Kế Toán'),
(3, 'Phòng Nhân Sự'),
(4, 'Phòng Hành Chính'),
(5, 'Phòng Nghiên Cứu và Phát Triển');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taikhoan`
--

CREATE TABLE `tbl_taikhoan` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `MaNV` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_taikhoan`
--

INSERT INTO `tbl_taikhoan` (`ID`, `username`, `password`, `MaNV`, `role`) VALUES
(1, 'admin', '123456', 'NV01', 'admin'),
(2, 'admin01', 'Admin@01', 'admin01', 'admin'),
(3, 'Đặng Hà', 'Ha@1234', 'NV0782', 'nhanvien');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tangca`
--

CREATE TABLE `tbl_tangca` (
  `ID` int(11) NOT NULL,
  `Nam` int(11) DEFAULT NULL,
  `Thang` int(11) DEFAULT NULL,
  `Ngay` int(11) DEFAULT NULL,
  `SoGio` float DEFAULT NULL,
  `MaNV` varchar(15) DEFAULT NULL,
  `IDLoaiCa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trinhdo`
--

CREATE TABLE `tbl_trinhdo` (
  `IDTD` int(11) NOT NULL,
  `TenTD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ungluong`
--

CREATE TABLE `tbl_ungluong` (
  `ID` int(11) NOT NULL,
  `Nam` int(11) DEFAULT NULL,
  `Thang` int(11) DEFAULT NULL,
  `Ngay` int(11) DEFAULT NULL,
  `SoTien` float DEFAULT NULL,
  `TrangThai` bit(50) DEFAULT NULL,
  `MaNV` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_baohiem`
--
ALTER TABLE `tbl_baohiem`
  ADD PRIMARY KEY (`IDBH`);

--
-- Indexes for table `tbl_bophan`
--
ALTER TABLE `tbl_bophan`
  ADD PRIMARY KEY (`IDBP`);

--
-- Indexes for table `tbl_chamcong`
--
ALTER TABLE `tbl_chamcong`
  ADD PRIMARY KEY (`MaCC`);

--
-- Indexes for table `tbl_chucvu`
--
ALTER TABLE `tbl_chucvu`
  ADD PRIMARY KEY (`IDCV`);

--
-- Indexes for table `tbl_hopdong`
--
ALTER TABLE `tbl_hopdong`
  ADD PRIMARY KEY (`SoHD`);

--
-- Indexes for table `tbl_khenthuongkyluat`
--
ALTER TABLE `tbl_khenthuongkyluat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_loaica`
--
ALTER TABLE `tbl_loaica`
  ADD PRIMARY KEY (`IDLoaiCa`);

--
-- Indexes for table `tbl_luong`
--
ALTER TABLE `tbl_luong`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_manv` (`MaNV`);

--
-- Indexes for table `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Indexes for table `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  ADD PRIMARY KEY (`IDPB`);

--
-- Indexes for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_tangca`
--
ALTER TABLE `tbl_tangca`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_trinhdo`
--
ALTER TABLE `tbl_trinhdo`
  ADD PRIMARY KEY (`IDTD`);

--
-- Indexes for table `tbl_ungluong`
--
ALTER TABLE `tbl_ungluong`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chamcong`
--
ALTER TABLE `tbl_chamcong`
  MODIFY `MaCC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_luong`
--
ALTER TABLE `tbl_luong`
  ADD CONSTRAINT `fk_luong_nhanvien` FOREIGN KEY (`MaNV`) REFERENCES `tbl_nhanvien` (`MaNV`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
