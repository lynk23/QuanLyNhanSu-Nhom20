-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 26, 2025 lúc 03:38 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlynhansu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_bangcong`
--

CREATE TABLE `tbl_bangcong` (
  `MaBC` int(11) NOT NULL,
  `Nam` int(11) DEFAULT NULL,
  `Thang` int(11) DEFAULT NULL,
  `Ngay` int(11) DEFAULT NULL,
  `GioVao` int(11) DEFAULT NULL,
  `PhutVao` int(11) DEFAULT NULL,
  `GioRa` int(11) DEFAULT NULL,
  `PhutRa` int(11) DEFAULT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `IDLoaiCong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_bangcong`
--

INSERT INTO `tbl_bangcong` (`MaBC`, `Nam`, `Thang`, `Ngay`, `GioVao`, `PhutVao`, `GioRa`, `PhutRa`, `MaNV`, `IDLoaiCong`) VALUES
(1, 2025, 1, 1, 7, 0, 17, 0, 1, 1),
(2, 2025, 2, 2, 7, 0, 19, 0, 2, 2),
(3, 2025, 3, 3, 7, 0, 18, 0, 3, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_baohiem`
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
-- Đang đổ dữ liệu cho bảng `tbl_baohiem`
--

INSERT INTO `tbl_baohiem` (`IDBH`, `SoBH`, `NgayCap`, `NoiCap`, `NoiKhamBenh`, `MaNV`) VALUES
(101, '123456', '2024-11-12', 'Hà Nội', 'Hà Nội', 11),
(102, '234567', '2023-12-13', 'Hà Nội', 'Hà Nội', 12),
(103, '345678', '2025-01-10', 'Hà Nội', 'Hà Nội', 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_bophan`
--

CREATE TABLE `tbl_bophan` (
  `IDBP` int(11) NOT NULL,
  `TenBP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_bophan`
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
-- Cấu trúc bảng cho bảng `tbl_chucvu`
--

CREATE TABLE `tbl_chucvu` (
  `IDCV` int(11) NOT NULL,
  `TenCV` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hopdong`
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
-- Cấu trúc bảng cho bảng `tbl_khenthuongkyluat`
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
-- Đang đổ dữ liệu cho bảng `tbl_khenthuongkyluat`
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
-- Cấu trúc bảng cho bảng `tbl_loaica`
--

CREATE TABLE `tbl_loaica` (
  `IDLoaiCa` int(11) NOT NULL,
  `TenLoaiCa` varchar(50) DEFAULT NULL,
  `HeSo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_loaicong`
--

CREATE TABLE `tbl_loaicong` (
  `IDLoaiCong` int(11) NOT NULL,
  `TenLC` varchar(50) DEFAULT NULL,
  `HeSo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhanvien`
--

CREATE TABLE `tbl_nhanvien` (
  `MaNV` varchar(15) NOT NULL,
  `HoTen` varchar(50) DEFAULT NULL,
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DienThoai` varchar(50) DEFAULT NULL,
  `CCCD` varchar(50) DEFAULT NULL,
  `DiaChi` varchar(300) DEFAULT NULL,
  `HinhAnh` varbinary(50000) DEFAULT NULL,
  `IDPB` int(11) DEFAULT NULL,
  `IDBP` int(11) DEFAULT NULL,
  `IDCV` int(11) DEFAULT NULL,
  `IDTD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhanvien`
--

INSERT INTO `tbl_nhanvien` (`MaNV`, `HoTen`, `GioiTinh`, `NgaySinh`, `DienThoai`, `CCCD`, `DiaChi`, `HinhAnh`, `IDPB`, `IDBP`, `IDCV`, `IDTD`) VALUES
('NV01', 'Nguyễn Ngọc Linh', b'1', '2004-12-08', '0348624035', '466321654525', 'Hải Dương', NULL, 1, 1, 11, 21),
('NV02', 'Lê Thanh Thảo', b'1', '2004-12-09', '0345485654', '215687439578', 'Hà Nội ', NULL, 2, 2, 12, 22),
('NV03', 'Trịnh Phương An', b'1', '2005-12-06', '0314256987', '023159486798', 'Hà Nội ', NULL, 3, 3, 13, 23),
('NV04', 'Phan Trọng Quân', b'0', '2004-01-03', '0341527895', '321452697854', 'Bắc Ninh', NULL, 4, 4, 14, 24),
('NV05', 'Nguyền Hoàng Dương', b'0', '2004-01-16', '0345678951', '201456348621', 'Hà Nội', NULL, 5, 5, 15, 25),
('NV06', 'Lưu Thanh Duy', b'0', '2004-12-08', '0348795247', '014258369456', 'Bắc Ninh', NULL, 6, 6, 16, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phongban`
--

CREATE TABLE `tbl_phongban` (
  `IDPB` int(11) NOT NULL,
  `TenPB` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phucap`
--

CREATE TABLE `tbl_phucap` (
  `IDPC` int(11) NOT NULL,
  `MaNV` varchar(15) DEFAULT NULL,
  `Ngay` date DEFAULT NULL,
  `NoiDung` varchar(500) DEFAULT NULL,
  `SoTien` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_taikhoan`
--

CREATE TABLE `tbl_taikhoan` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `MaNV` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_taikhoan`
--

INSERT INTO `tbl_taikhoan` (`ID`, `username`, `password`, `MaNV`) VALUES
(1, 'admin', '123456', 'NV01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_tangca`
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
-- Cấu trúc bảng cho bảng `tbl_trinhdo`
--

CREATE TABLE `tbl_trinhdo` (
  `IDTD` int(11) NOT NULL,
  `TenTD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_ungluong`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_bangcong`
--
ALTER TABLE `tbl_bangcong`
  ADD PRIMARY KEY (`MaBC`);

--
-- Chỉ mục cho bảng `tbl_baohiem`
--
ALTER TABLE `tbl_baohiem`
  ADD PRIMARY KEY (`IDBH`);

--
-- Chỉ mục cho bảng `tbl_bophan`
--
ALTER TABLE `tbl_bophan`
  ADD PRIMARY KEY (`IDBP`);

--
-- Chỉ mục cho bảng `tbl_chucvu`
--
ALTER TABLE `tbl_chucvu`
  ADD PRIMARY KEY (`IDCV`);

--
-- Chỉ mục cho bảng `tbl_hopdong`
--
ALTER TABLE `tbl_hopdong`
  ADD PRIMARY KEY (`SoHD`);

--
-- Chỉ mục cho bảng `tbl_khenthuongkyluat`
--
ALTER TABLE `tbl_khenthuongkyluat`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tbl_loaica`
--
ALTER TABLE `tbl_loaica`
  ADD PRIMARY KEY (`IDLoaiCa`);

--
-- Chỉ mục cho bảng `tbl_loaicong`
--
ALTER TABLE `tbl_loaicong`
  ADD PRIMARY KEY (`IDLoaiCong`);

--
-- Chỉ mục cho bảng `tbl_nhanvien`
--
ALTER TABLE `tbl_nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `tbl_phongban`
--
ALTER TABLE `tbl_phongban`
  ADD PRIMARY KEY (`IDPB`);

--
-- Chỉ mục cho bảng `tbl_phucap`
--
ALTER TABLE `tbl_phucap`
  ADD PRIMARY KEY (`IDPC`);

--
-- Chỉ mục cho bảng `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tbl_tangca`
--
ALTER TABLE `tbl_tangca`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tbl_trinhdo`
--
ALTER TABLE `tbl_trinhdo`
  ADD PRIMARY KEY (`IDTD`);

--
-- Chỉ mục cho bảng `tbl_ungluong`
--
ALTER TABLE `tbl_ungluong`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
