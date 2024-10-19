-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 12:53 AM
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
-- Database: `expensemanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_type`, `category_name`, `category_image`) VALUES
(1, 'income', 'Salary', 'feature.png'),
(2, 'income', 'Business Income/Profit', 'default.jpg'),
(3, 'income', 'Freelancing', 'default.jpg'),
(4, 'income', 'Investment', 'default.jpg'),
(5, 'income', 'Pension', 'cut_down_guilt.jpg'),
(6, 'income', 'Allowance', 'default.jpg'),
(7, 'income', 'Pocket Money', 'default.jpg'),
(8, 'income', 'Loan Received', 'default.jpg'),
(9, 'income', 'Rent Received', 'default.jpg'),
(10, 'expense', 'Transport', 'default.jpg'),
(11, 'expense', 'Bills & Utilities', 'default.jpg'),
(12, 'expense', 'Fuel & Maintenance', 'default.jpg'),
(13, 'expense', 'Shopping', 'default.jpg'),
(14, 'expense', 'Load Paid', 'default.jpg'),
(15, 'expense', 'Food & Drinks', 'default.jpg'),
(16, 'expense', 'Grocery', 'default.jpg'),
(17, 'expense', 'Gifts', 'default.jpg'),
(18, 'expense', 'Family', 'default.jpg'),
(19, 'expense', 'Other Expenses', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `otp_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(400) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_verify` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_verify`, `created_at`) VALUES
(81, 'Salman Ansari', 'salman@3rdeyesoft.com', 'pass', 1, '2024-10-15 22:50:58'),
(82, 'Salman Ansari', 'sa307485@gmail.com', '123456789', 1, '2024-10-16 16:00:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
