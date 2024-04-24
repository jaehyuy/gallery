-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 09:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgldibuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tgldibuat`, `userid`) VALUES
(30, 'kitten', 'album anak kucing', '2024-04-23', 13),
(31, 'deco', 'moodboard deco', '2024-04-23', 13),
(32, 'design', 'moodboard design', '2024-04-23', 13),
(33, 'fish', 'ini album ikan', '2024-04-23', 13),
(34, 'swan', 'kumpulan foto angsa', '2024-04-24', 14),
(35, 'scenery', 'ini pemandangan', '2024-04-24', 14),
(36, 'js', 'tes 2', '2024-04-24', 15),
(37, 'gf', 'tes 3', '2024-04-24', 15);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(225) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tglunggah` date NOT NULL,
  `lokasifile` varchar(225) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tglunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(58, 'fish 1', 'ikan', '2024-04-23', '66276f203071a-download (4).jpeg', 33, 13),
(59, 'ikan 2', 'ini ikan kedua', '2024-04-23', '66276f6891d0f-my taste.jpeg', 33, 13),
(60, 'ikan 3', 'ini ikan ketiga', '2024-04-23', '66276f9cdf4b5-astronauths.jpeg', 33, 13),
(61, 'kucing 1', 'mpus', '2024-04-23', '66276fdcd3724-download (3).jpeg', 32, 13),
(62, 'kucing 2', 'mpus 2', '2024-04-23', '66276fefbf2d8-Miho is ready.jpeg', 31, 13),
(63, 'kucing 3', 'ketigaaaa', '2024-04-23', '2001591438-!!.jpeg', 31, 13),
(64, 'minoo', 'deco couple 1', '2024-04-23', '6627708e4f07b-MOODBOARD DESIGN Minju ft Sunwoo by @scribbnle on telegram.jpeg', 31, 13),
(65, 'winjae', 'winter-jaemin', '2024-04-23', '662770adbb4a9-MOODBOARD DESIGN Winter ft Jaemin by @scribbnle on telegram.jpeg', 31, 13),
(66, 'najen', 'karina-jeno', '2024-04-23', '662771040cc35-LOVEBOARD YOO KARINA AESPA & LEE JENO NCT.jpeg', 31, 13),
(67, 'jeno', 'mb design 1', '2024-04-23', '590879033-semangka.jpg', 31, 13),
(68, 'jaemin', 'mb design 2', '2024-04-23', '66277182b4c36-MOODBOARD DECO BAD BOY NIGHTRIDE JAEMIN NCT.jpeg', 32, 13),
(69, 'jaehyun', 'mb design 3', '2024-04-23', '6627719dd6ae8-moodboard design from @kalalic on telegram_ (2).jpeg', 32, 13),
(70, 'love swan', 'ini angsa 1', '2024-04-24', '66286e5fb60aa-Swan Whose Mate Was Killed At Zoo Dies Of A Broken Heart.jpeg', 34, 14),
(71, 'couples', 'angsa 2', '2024-04-24', '66286e7c38c6f-Swans on a Stream giclee print.jpeg', 34, 14),
(72, 'fairys', 'fairy', '2024-04-24', '191603078-Autumn lake Lucerne.jpeg', 34, 14),
(73, 'scenery 2', 'pemandangan juga', '2024-04-24', '66286f191cae5-download (9).jpeg', 34, 14),
(75, 'tes 2', 'tes', '2024-04-24', '662870a09c0ca-download (14).jpeg', 37, 15),
(76, 'semongko', 's', '2024-04-24', '1960307091-semangka.jpg', 33, 13),
(77, 'tes4', 'tg', '2024-04-24', '6628a1927ac24-3f6e934d-07f4-4126-b0ad-f2e266a82c7e.jpeg', 30, 13);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomen` text NOT NULL,
  `tglkomen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomen`, `tglkomen`) VALUES
(20, 58, 13, 'asdggfa', '2024-04-23'),
(21, 61, 13, 'gemas nyaa', '2024-04-24'),
(23, 58, 15, '1', '2024-04-24'),
(24, 58, 15, '22', '2024-04-24'),
(25, 58, 13, '33', '2024-04-24'),
(26, 67, 13, 'semongko', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tgllike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tgllike`) VALUES
(39, 61, 13, '2024-04-24'),
(40, 58, 15, '2024-04-24'),
(41, 58, 13, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `namalengkap` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `foto`) VALUES
(13, 'maid', 'maid', '@', 'Zemira', 'untung', '2053371237-kitty in water 🫧.jpeg'),
(14, 'jaehyuy', 'jaehyuy', '@', 'Mira', 'hhh', ''),
(15, 'zahra', 'zahra', 'zahraslsa02@gmail.com', 'Zahra', 'Labuhan Dalam', ''),
(18, 'rai', 'rai', '@', 'raraa', 'ffdr', '1515095476-download (14).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD UNIQUE KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD UNIQUE KEY `fotoid` (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD UNIQUE KEY `komentarid` (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD UNIQUE KEY `likeid` (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`);

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
