-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 04, 2023 lúc 08:04 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `work`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name_admin` varchar(250) NOT NULL,
  `pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `name_admin`, `pass`) VALUES
(1, 'nguyen', 1234),
(4, 'admin', 1111),
(5, 'abc', 1234),
(6, 'acount', 1111),
(7, 'hello', 2222);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `name_subject` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`id_subject`, `name_subject`) VALUES
(4, 'HTML'),
(5, 'CSS'),
(6, 'JAVASCRIPT'),
(7, 'LAVAREL'),
(9, 'ASP.NET'),
(10, 'ASP.NET CORE'),
(11, 'ASP.NET FRAMEWORK'),
(12, 'JQUERY'),
(13, 'PYTHON'),
(14, 'SQL'),
(15, 'MYSQL'),
(16, 'REACTJS'),
(17, 'ANGULAR'),
(30, 'HTML7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `birth` date DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `job` varchar(250) NOT NULL,
  `school` varchar(250) NOT NULL,
  `experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `birth`, `email`, `phone`, `photo`, `sex`, `job`, `school`, `experience`) VALUES
(308, 'quangkhai', '7h2SRjU1PPDr0tCISoS9nYM0QINIaubNJZgHKCMUjgQ6PgQfDPnHWOLeOIHrngz7Te8z/r9vs4Uvzwy2RVjj5A==', '2023-04-04', 'xahoatai@gmail.com', '0877811722', 'a13984288856a5fe780b49c6408ebb66.', 'female', 'HR', 'harval', 'làm việc tại mỹ tho'),
(310, 'nguyen', 'JlPFRCH8zanx5qq0+uiWspflY1sHeww5+SObUgyHNIcd1qfBKdMziNLnlWIzoVyZB/puy8PruVmbI/dFd+TZtg==', '2001-03-20', 'trannguyen20032001@gmail.com', '0866791622', 'e5857147174cac6106e11a92b30ab8c4.jpg', 'male', 'Intern php', 'Hanoi industry of university', 'Làm bài tập lớn cùng nhóm tại trường.\r\ndự án cá nhân: xây dựng  Website bán hàng bằng ngôn ngữ PHP gồm các chức năng:\r\n+Đăng nhập\r\n+Thêm, sửa, xóa sản phẩm\r\n+Tìm kiếm sản phẩm theo tên\r\nVăn bản là một loại hình phương tiện để ghi nhận, lưu giữ và truyền đạt các thông tin từ chủ thể này sang chủ thể khác bằng ký hiệu gọi là chữ viết. Nó gồm tập hợp các câu có tính trọn vẹn về nội dung, hoàn chỉnh về hình thức, có tính liên kết chặt chẽ và hướng tới một mục tiêu giao tiếp nhất định.[1][2][3][4] Hay nói khác đi, văn bản là một dạng sản phẩm của hoạt động giao tiếp bằng ngôn ngữ được thể hiện ở dạng viết trên một chất liệu nào đó (giấy, bia đá,...). Văn bản bao gồm các tài liệu, tư liệu, giấy tờ có giá trị pháp lý nhất định, được sử dụng trong hoạt động của các cơ quan Nhà nước, các tổ chức chính trị, chính trị - xã hội, các tổ chức kinh tế... như: các văn bản pháp luật, các công văn, tài liệu, giấy tờ.'),
(311, 'doan', 'ICHp1wPWMf88RX+sISxbUnN5A7SZQSdN/u+hX/GvZ1kkQydbOQLNiPIYkDIj0/AAVjE5HjuQ8t5BogBGHw3EDQ==', '2023-04-03', 'doan@gmail.com', '0999888777', '11555f711144bcd6b43f838d2775aed2.jpg', 'male', 'farmer', 'sosial', 'very much'),
(312, 'nguyen2003', 'ydebVbRvu92no7jjOpU+G3HXDvUo/HKcm4VM+lC+t8rBIkfoqO3M6B+vqsn8P3wpltNPW69LJPIj6Gk0t3GRWQ==', '2023-04-05', 'nguyen@outlook.com', '0122122322', '0f416e6002291db26a29a2e0f6ab4611.', 'female', 'sesion', 'mvc', ''),
(313, 'Van', 'D7Phrw/dIZGoGKkSc30shaizMbChd32eXxx1yOQ7yIFERSIzK7n/cZ/8DuhKN43FJ0RoxrhZY1P/0YcZcpZ0DQ==', '2023-04-12', 'vn@gmail.com', '1222254687', '7fb307cacb3620f0b5024d1e3ad4add3.jpg', 'male', 'intern lavarel', '', ''),
(314, 'acount', 'D9DONrbYcmimF0jkDzfkD55JzJ3BtewoJmGQSx/rw5V25Ky4zZP8/SS8ohKQQy8tvG3W8IerpJKuQH79ZZYiow==', '2023-04-03', 'xahoatai@gmail.com', '0999888777', 'df8c35b43ea81e0ac78f68c2573e728a.', 'male', 'lao cong', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_subject`
--

CREATE TABLE `user_subject` (
  `id_user` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `experience_year` int(11) NOT NULL,
  `last_use` int(11) NOT NULL,
  `level` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_subject`
--

INSERT INTO `user_subject` (`id_user`, `id_subject`, `experience_year`, `last_use`, `level`) VALUES
(3, 5, 1, 2023, 5),
(4, 4, 12, 2023, 4),
(10, 3, 1, 2, 2),
(6, 3, 2, 2023, 4),
(6, 8, 2, 2019, 2),
(6, 13, 3, 112, 2),
(12, 4, 12, 3212, 3),
(6, 4, 0, 0, 0),
(6, 16, 12, 1221, 4),
(23, 4, 2, 2222, 4),
(296, 5, 5, 2019, 4),
(271, 4, 3, 2023, 4),
(0, 16, 3242, 3241, 1),
(0, 13, 324, 324, 2),
(0, 4, 2, 2019, 2),
(0, 5, 234, 222, 4),
(303, 4, 2, 2, 2),
(0, 6, 2, 2019, 4),
(0, 16, 4, 2020, 2),
(0, 17, 7, 2021, 3),
(0, 6, 2, 2019, 4),
(0, 16, 4, 2020, 2),
(0, 17, 7, 2021, 3),
(0, 6, 2, 2019, 4),
(0, 16, 4, 2020, 2),
(0, 17, 7, 2021, 3),
(0, 6, 2, 2019, 4),
(0, 16, 4, 2020, 2),
(0, 17, 7, 2021, 3),
(0, 6, 2, 2019, 4),
(0, 16, 4, 2020, 2),
(0, 17, 7, 2021, 3),
(308, 12, 6, 2019, 2),
(308, 10, 324, 2011, 3),
(306, 15, 23432, 234, 1),
(306, 13, 324, 324, 3),
(306, 9, 2, 234, 1),
(306, 30, 23432, 234, 2),
(308, 5, 2, 324, 1),
(308, 13, 2, 2019, 2),
(307, 14, 2, 2, 1),
(308, 17, 324, 234, 1),
(307, 16, 2, 3, 2),
(307, 13, 2, 3, 1),
(305, 13, 324, 2, 1),
(305, 14, 234, 2, 2),
(305, 9, 0, 324, 1),
(305, 6, 23432, 324, 3),
(308, 7, 324, 2019, 2),
(309, 15, 234, 234, 4),
(309, 30, 234, 2019, 3),
(309, 12, 324, 222, 4),
(310, 4, 4, 2019, 4),
(310, 5, 4, 2016, 3),
(310, 6, 5, 2022, 5),
(310, 7, 6, 2018, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `ad_name` (`name_admin`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
