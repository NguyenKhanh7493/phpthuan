-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 24, 2019 lúc 07:55 AM
-- Phiên bản máy phục vụ: 10.1.37-MariaDB
-- Phiên bản PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phpthuan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `avatar`, `phone`, `status`, `group_id`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Như Khánh', 'nguyenkhanh7493@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1.jpg', '0964245027', 1, 1, '2019-06-16 00:00:00', '2019-06-16 00:00:00'),
(4, 'Nguyen Khanh', 'khanhlongqt7498@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'cauhienluong.jpg', '9642450274', 0, NULL, '2019-06-19 17:15:58', '0000-00-00 00:00:00'),
(5, 'Đoàn Thị Xuân Hiếu', 'xuanhieu7496@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '61423975_439968869902354_447199313483792384_n.jpg', '0972024098', 1, NULL, '2019-06-22 07:02:51', '0000-00-00 00:00:00'),
(6, 'Khánh Nè', 'khanhoideptrairua@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'tải xuống.jpg', '9720240982', 0, NULL, '2019-06-22 07:05:37', '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
