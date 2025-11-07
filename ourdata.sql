-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2025 at 10:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ourdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_det_reg`
--

CREATE TABLE `admin_det_reg` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) DEFAULT NULL,
  `eMail` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(12) DEFAULT NULL,
  `passWord` varchar(15) DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_det_reg`
--

INSERT INTO `admin_det_reg` (`id`, `fullName`, `eMail`, `phoneNumber`, `passWord`, `date_joined`) VALUES
(8, 'The Fuirful Code', 'thefruitfulcode@gmail.com', '07045141032', 'fruitful', '2025-11-05 11:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `cable_plans`
--

CREATE TABLE `cable_plans` (
  `id` int(11) NOT NULL,
  `startimes_basic` decimal(11,0) DEFAULT NULL,
  `startimes_nova` decimal(11,0) DEFAULT NULL,
  `startimes_smart` decimal(11,0) DEFAULT NULL,
  `startimes_super` decimal(11,0) DEFAULT NULL,
  `gotv_jinja` decimal(11,0) DEFAULT NULL,
  `gotv_jolli` decimal(11,0) DEFAULT NULL,
  `gotv_max` decimal(11,0) DEFAULT NULL,
  `gotv_smallie` decimal(11,0) DEFAULT NULL,
  `dstv_compact` decimal(11,0) DEFAULT NULL,
  `dstv_great_wall_standalone` decimal(11,0) DEFAULT NULL,
  `dstv_padi` decimal(11,0) DEFAULT NULL,
  `dstv_yanga` decimal(11,0) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_plans`
--

CREATE TABLE `data_plans` (
  `id` int(11) NOT NULL,
  `airtel_five` decimal(11,0) DEFAULT NULL,
  `airtel_four` decimal(11,0) DEFAULT NULL,
  `airtel_half` decimal(11,0) DEFAULT NULL,
  `airtel_one` decimal(11,0) DEFAULT NULL,
  `airtel_three` decimal(11,0) DEFAULT NULL,
  `airtel_two` decimal(11,0) DEFAULT NULL,
  `glo_five` decimal(11,0) DEFAULT NULL,
  `glo_four` decimal(11,0) DEFAULT NULL,
  `glo_half` decimal(11,0) DEFAULT NULL,
  `glo_one` decimal(11,0) DEFAULT NULL,
  `glo_three` decimal(11,0) DEFAULT NULL,
  `glo_two` decimal(11,0) DEFAULT NULL,
  `mobile_five` decimal(11,0) DEFAULT NULL,
  `mobile_four` decimal(11,0) DEFAULT NULL,
  `mobile_half` decimal(11,0) DEFAULT NULL,
  `mobile_one` decimal(11,0) DEFAULT NULL,
  `mobile_three` decimal(11,0) DEFAULT NULL,
  `mobile_two` decimal(11,0) DEFAULT NULL,
  `mtnCG_five` decimal(11,0) DEFAULT NULL,
  `mtnCG_four` decimal(11,0) DEFAULT NULL,
  `mtnCG_half` decimal(11,0) DEFAULT NULL,
  `mtnCG_one` decimal(11,0) DEFAULT NULL,
  `mtnCG_three` decimal(11,0) DEFAULT NULL,
  `mtnCG_two` decimal(11,0) DEFAULT NULL,
  `mtn_five` decimal(11,0) DEFAULT NULL,
  `mtn_four` decimal(11,0) DEFAULT NULL,
  `mtn_half` decimal(11,0) DEFAULT NULL,
  `mtn_one` decimal(11,0) DEFAULT NULL,
  `mtn_three` decimal(11,0) DEFAULT NULL,
  `mtn_two` decimal(11,0) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_users`
--

CREATE TABLE `data_users` (
  `id` int(11) NOT NULL,
  `names` varchar(100) DEFAULT NULL,
  `pass_word` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `e_mail` varchar(60) DEFAULT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `pin` varchar(4) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_users`
--

INSERT INTO `data_users` (`id`, `names`, `pass_word`, `gender`, `e_mail`, `phone_no`, `country`, `pin`, `image`, `date_joined`) VALUES
(3, 'Oniye Abdullahi Masud', 'kunmasin', 'Male', 'oniyeabdullahi00@gmail.com', '09015621510', 'Nigeria', '1234', 'profileUploads/1762342872_download (13).jpeg', '2025-11-05 11:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_type` varchar(20) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `device_type` varchar(30) DEFAULT NULL,
  `ip_address` varchar(40) DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `reference` varchar(60) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_balance`
--

CREATE TABLE `wallet_balance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `current_balance` decimal(11,0) DEFAULT NULL,
  `previous_balance` decimal(11,0) DEFAULT NULL,
  `deduction_amount` decimal(11,0) DEFAULT NULL,
  `funded_amount` decimal(11,0) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_det_reg`
--
ALTER TABLE `admin_det_reg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fullName` (`fullName`);

--
-- Indexes for table `cable_plans`
--
ALTER TABLE `cable_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_plans`
--
ALTER TABLE `data_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_users`
--
ALTER TABLE `data_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `wallet_balance`
--
ALTER TABLE `wallet_balance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_det_reg`
--
ALTER TABLE `admin_det_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cable_plans`
--
ALTER TABLE `cable_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_plans`
--
ALTER TABLE `data_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_users`
--
ALTER TABLE `data_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_balance`
--
ALTER TABLE `wallet_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
