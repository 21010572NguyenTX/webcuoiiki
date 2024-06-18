-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minato`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('a', '202cb962ac59075b964b07152d234b70'),
('aa', '202cb962ac59075b964b07152d234b70'),
('aaa', '202cb962ac59075b964b07152d234b70'),
('abc', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `image`) VALUES
(3, 'bui truong', 'buitruong132100@gmail.com', 0x75706c6f6164732f53637265656e73686f7420323032332d30382d3033203230303332362e706e67),
(6, 'cc', 'cc@gmail.com', 0x75706c6f6164732f53637265656e73686f7420323032332d30392d3231203134313233382e706e67),
(111120, 'abcd', 'aaa@gmail.com', ''),
(111121, 'abcd', 'aaa@gmail.com', ''),
(111122, 'abcd', 'aaa@gmail.', ''),
(111123, 'abcd', 'aaa@gmail.', ''),
(111124, 'abcd', 'aaa@gmail.com', ''),
(111125, 'abcd', 'aaa@gmail.com', ''),
(111126, 'abcd', 'aaa@gmail.com', ''),
(111127, 'abcd', 'aaa@gmail.com', ''),
(111128, 'abcd', 'aaa@gmail.com', ''),
(111129, 'abcd', 'aaa@gmail.com', ''),
(111130, 'abcd', 'aaa@gmail.com', ''),
(111131, 'abcd', 'aaa@gmail.com', ''),
(111132, 'abcd', 'aaa@gmail.com', ''),
(111133, 'abcd', 'aaa@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
