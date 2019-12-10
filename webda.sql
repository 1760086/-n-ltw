-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 12:36 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webda`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `idus1` int(10) NOT NULL,
  `idus2` int(10) NOT NULL,
  `trangthai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID` int(10) UNSIGNED NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL,
  `timeSTT` datetime NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `usID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `status`, `timeSTT`, `img`, `usID`) VALUES
(1, 'jello', '2019-11-29 18:29:38', 'imgSTT/53003650_544437582733046_1008725253318246400_n.jpg', 5),
(2, 'jello', '2019-11-29 18:43:31', 'imgSTT/53003650_544437582733046_1008725253318246400_n.jpg', 5),
(3, 'hello', '2019-11-29 18:47:35', 'non', 5);

-- --------------------------------------------------------

--
-- Table structure for table `usaccount`
--

CREATE TABLE `usaccount` (
  `ID` int(10) UNSIGNED NOT NULL,
  `HoTen` text COLLATE utf8_unicode_ci NOT NULL,
  `Mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Tell` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` text COLLATE utf8_unicode_ci NOT NULL,
  `urlavatar` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usaccount`
--

INSERT INTO `usaccount` (`ID`, `HoTen`, `Mail`, `Tell`, `MatKhau`, `NgaySinh`, `GioiTinh`, `urlavatar`) VALUES
(5, 'Lê Nguyễn Trung Kiên', 'lntkien.17ck1@gmail.com', '0987444606', '$2y$10$9bSkeQ1NgqQ5OpPdKHip7.g.RVOe/HpunSxsk3xQ1esG9hiTHwXE6', '1999-07-03', 'Nam', 'imgAvatar/detective_conan_magic_kaito_kaito_kid_cape_moon_suit_30410_1680x1050.jpg'),
(7, 'Nguyễn Nhi', 'nnynhi.17ck1@gmail.com', '0366775442', '$2y$10$skAlFFHoU5ROZ.p/BpbseOO.ab0J.2l4FPbhx/vkVm5VmwoM0jX82', '1999-11-08', 'Nam', 'imgAvatar/avatar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`idus1`,`idus2`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usaccount`
--
ALTER TABLE `usaccount`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usaccount`
--
ALTER TABLE `usaccount`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
