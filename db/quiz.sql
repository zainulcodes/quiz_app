-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 02:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 'Apa yang dimaksud dengan 1 mol zat?', '6,02 × 10^22 partikel', '6,02 × 10^23 partikel', '6,02 × 10^24 partikel', '1 partikel', 'B'),
(2, 'Berapa jumlah partikel dalam 2 mol atom?', '6,02 × 10^23', '1,204 × 10^23', '1,204 × 10^24', '2,408 × 10^24', 'C'),
(3, 'Berapa mol dari 12 gram karbon (Ar C = 12)?', '0,5 mol', '1 mol', '2 mol', '12 mol', 'B'),
(4, 'Berapa massa 0,5 mol air (H2O, Mr = 18)?', '18 gram', '12 gram', '9 gram', '6 gram', 'C'),
(5, 'Berapa mol dari 44 gram CO2 (Mr = 44)?', '0,5 mol', '1 mol', '2 mol', '44 mol', 'B'),
(6, 'Berapa jumlah molekul dalam 0,25 mol O2?', '6,02 × 10^23', '3,01 × 10^23', '1,505 × 10^23', '0,25 × 10^23', 'C'),
(7, 'Berapa massa dari 3 mol NaCl (Mr = 58,5)?', '117 gram', '175,5 gram', '58,5 gram', '200 gram', 'B'),
(8, 'Berapa mol dalam 11 gram CO2 (Mr = 44)?', '0,5 mol', '0,25 mol', '1 mol', '2 mol', 'B'),
(9, 'Berapa volume 2 mol gas pada STP?', '22,4 liter', '44,8 liter', '11,2 liter', '2 liter', 'B'),
(10, 'Berapa mol partikel dalam 3,01 × 10^23 molekul?', '1 mol', '0,25 mol', '0,5 mol', '2 mol', 'C'),
(11, 'Berapa jumlah atom dalam 1 mol H2O?', '6,02 × 10^23', '1,204 × 10^24', '1,806 × 10^24', '3,01 × 10^23', 'C'),
(12, 'Berapa massa 0,2 mol CaCO3 (Mr = 100)?', '10 gram', '20 gram', '30 gram', '50 gram', 'B'),
(13, 'Jika terdapat 22 gram CO2, berapa jumlah molekulnya?', '6,02 × 10^23', '3,01 × 10^23', '1,505 × 10^23', '0,5 × 10^23', 'B'),
(14, 'Berapa volume 0,75 mol gas pada STP?', '22,4 liter', '11,2 liter', '16,8 liter', '33,6 liter', 'C'),
(15, 'Berapa jumlah atom O dalam 1 mol CO2?', '6,02 × 10^23', '1,204 × 10^24', '1,806 × 10^24', '3,01 × 10^23', 'B'),
(16, 'Berapa gram NaOH yang diperlukan untuk menghasilkan 2 mol NaOH? (Mr = 40)', '40 gram', '60 gram', '80 gram', '100 gram', 'C'),
(17, 'Jika 11,2 liter gas pada STP, berapa jumlah molekulnya?', '6,02 × 10^23', '3,01 × 10^23', '1,505 × 10^23', '0,5 × 10^23', 'B'),
(18, '6 gram H2 (Mr = 2) setara dengan berapa mol dan jumlah molekul?', '2 mol dan 1,204 × 10^24', '3 mol dan 1,806 × 10^24', '1 mol dan 6,02 × 10^23', '0,5 mol dan 3,01 × 10^23', 'B'),
(19, 'Berapa massa 1,5 × 10^23 molekul CO2 (Mr = 44)?', '22 gram', '11 gram', '44 gram', '5,5 gram', 'B'),
(20, 'Sebanyak 5,6 liter gas (STP) memiliki massa 14 gram. Berapa Mr gas tersebut?', '28', '44', '56', '14', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `questions_attempts`
--

CREATE TABLE `questions_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions_attempts`
--

INSERT INTO `questions_attempts` (`id`, `user_id`, `name`, `email`, `score`, `duration`, `created_at`) VALUES
(1, 2, 'M Zainul Anwar', 'zainul.mex23@gmail.com', 15, 600, '2026-04-11 10:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `name`, `email`, `score`, `duration`, `created_at`) VALUES
(5, 2, 'M Zainul Anwar', 'zainul.mex23@gmail.com', 0, 441, '2026-04-12 09:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 'Ibu kota Indonesia?', 'Bandung', 'Jakarta', 'Surabaya', 'Solo', 'B'),
(2, '5 x 5 = ?', '10', '20', '25', '30', 'C'),
(3, 'Langit berwarna?', 'Merah', 'Hijau', 'Biru', 'Kuning', 'C'),
(7, 'Ibu  Kota Jawa Timur ?', 'Malang', 'Sidoarjo', 'Mojokerto', 'Surabaya', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `quiz_taken` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `quiz_taken`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '0'),
(2, 'M Zainul Anwar', 'zainul.mex23@gmail.com', NULL, 'user', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_attempts`
--
ALTER TABLE `questions_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `questions_attempts`
--
ALTER TABLE `questions_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
