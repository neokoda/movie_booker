-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 09:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_booker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `username` varchar(32) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `seats` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`username`, `movie_id`, `title`, `date`, `time`, `seats`, `price`, `id`) VALUES
('neokoda', 13, 'Peter Pan ', '2023-07-06', '20:00:00', 'a:6:{i:0;s:1:\"1\";i:1;s:1:\"8\";i:2;s:2:\"28\";i:3;s:2:\"37\";i:4;s:2:\"57\";i:5;s:2:\"64\";}', 210000, 29),
('faizezez', 1, 'John Wick: Chapter 4', '2023-07-20', '13:00:00', 'a:1:{i:0;s:1:\"3\";}', 60000, 31),
('haikal', 1, 'John Wick: Chapter 4', '2023-07-20', '13:00:00', 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"5\";}', 120000, 32),
('neokoda', 0, 'Fast X', '2023-07-05', '13:00:00', 'a:1:{i:0;s:2:\"60\";}', 53000, 33),
('faizezez', 1, 'John Wick: Chapter 4', '2023-07-20', '13:00:00', 'a:1:{i:0;s:2:\"53\";}', 60000, 34),
('neokoda', 0, 'Fast X', '2023-07-06', '13:00:00', 'a:6:{i:0;s:2:\"52\";i:1;s:2:\"53\";i:2;s:2:\"54\";i:3;s:2:\"60\";i:4;s:2:\"61\";i:5;s:2:\"62\";}', 318000, 41),
('neokoda', 0, 'Fast X', '2023-07-06', '13:00:00', 'a:1:{i:0;s:2:\"42\";}', 53000, 42);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `username` varchar(32) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`username`, `password`, `birth_date`, `balance`) VALUES
('babiez', 'C0mpfest!', '2023-01-25', 4000),
('Bondowoso', 'benciRoro1!', '2023-07-01', 500000),
('faizezez', 'hukumUPN67#', '2010-01-02', 726001),
('haikal', 'Haikal123!', '2008-01-04', 880000),
('jizanal', 'Jizan123!', '2010-01-20', 51000),
('neokoda', 'C0mpfest@', '2004-09-26', 3120000),
('neokodaa', 'C0mpfest!', '2023-07-04', 0),
('revansyah', 'Revan123!', '2008-01-01', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
