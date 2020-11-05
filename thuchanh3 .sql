-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 10, 2020 lúc 05:17 AM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thuchanh3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bienban`
--

CREATE TABLE `bienban` (
  `id` int(5) NOT NULL,
  `tenNVP` varchar(50) DEFAULT NULL,
  `cmnd` varchar(12) DEFAULT NULL,
  `loaipt` varchar(30) DEFAULT NULL,
  `bienso` varchar(10) DEFAULT NULL,
  `diadiem` varchar(255) DEFAULT NULL,
  `loivp` varchar(255) DEFAULT NULL,
  `mucphat` varchar(255) DEFAULT NULL,
  `hannop` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bienban`
--

INSERT INTO `bienban` (`id`, `tenNVP`, `cmnd`, `loaipt`, `bienso`, `diadiem`, `loivp`, `mucphat`, `hannop`) VALUES
(10018, 'Đỗ Thị Lan Hương', '0123456789', 'Xe máy', '29h13670', 'Nga tu so', 'Vượt đèn đỏ', '750,000', '2020-06-17'),
(10020, 'Phạm Công Đức Anh', '0123456', 'Xe đạp điện', '29cd123', 'Nga tu so', 'Vượt đèn đỏ', '750,000', '2020-06-12'),
(10021, 'Lê Xuân Hải', '1232', 'Ô tô', '29h13670', 'Vĩnh phúc', 'Trở quá số người', '750,000', '2020-05-27'),
(10023, 'Nguyen Nhat Minh', '0123456789', 'Xe máy', '29cd123', 'Vĩnh phúc', 'Vượt đèn vàng', '150,000', '2020-07-09'),
(10539, 'Nguyen Nhat Minh', '0123456789', 'Xe tải', '29cd123', ' Nga tu so', 'Vượt đèn vàng', '900,000', '2020-08-01'),
(10540, 'Nguyen Nhat Minh', '0123456789', 'Xe đạp điện', '29h13670', 'Nga tu so', 'Vượt đèn xanh', '650.000', '2020-06-13'),
(10541, 'Nguyen Nhat Minh', '0123456789', 'Xe máy', '29h13670', 'Hà đông', 'Vượt đèn xanh', '650.000', '2020-06-13'),
(10542, 'Nguyen Nhat Minh', '0123456789', 'Xe tải', '29h13670', 'Nga tu so', 'Vượt đèn xanh', '650.000', '2020-06-13'),
(10543, 'Đỗ Thị Lan Hương', '1450', 'Ô tô', '29h13670', 'Nga tu so', 'Vượt đèn đỏ', '750,000', '2020-06-17'),
(10563, 'Phạm Công Đức Anh', '0123456', 'Xe máy', '29cd123', 'Nga tu so', 'Không đội mũ bảo hiểm', '1,500,000', '2020-07-16'),
(10564, 'Nguyen Nhat Minh', '189', 'Xe máy', '29cd123', 'Vĩnh phúc', 'Vượt đèn vàng', '150,000', '2020-06-06'),
(10565, 'Nguyen Nhat Minh', '10598', 'Xe tải', '29cd123', 'Nga tu so', 'Vượt đèn vàng', '900,000', '2020-06-07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `cmt` varchar(12) NOT NULL,
  `hoten` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `anh` mediumtext,
  `isadmin` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `password`, `cmt`, `hoten`, `email`, `anh`, `isadmin`, `active`) VALUES
('admin123', '$2y$10$xv37smIzd.BLyh4M807E8uJDVMDJzCeGB1blXSAuZs7Vi0Sbq6evO', '0123456789', 'Nguyễn Nhật Minh', 'sheamus199989@gmail.com', NULL, 0, 0),
('huong', '$2y$10$AM8Fmzb6ltdarxduaka7auCDg51S5zQHHGYFwmR92Uqbc8EXrZxHm', '027166656500', 'Đỗ thị Lan Hương', 'sheamus199989@gmail.com', NULL, 0, 0),
('admin', '$2y$10$xY1f2oqMFmxM/c2kCkk78.tmed8lrm.HjijTxbHfbIY', '09789816532', 'nhatminh', 'sheamus199989@gmail.com', NULL, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bienban`
--
ALTER TABLE `bienban`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cmt`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bienban`
--
ALTER TABLE `bienban`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10566;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
