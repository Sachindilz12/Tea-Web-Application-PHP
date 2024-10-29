-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 07:24 AM
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
-- Database: `tea_quality_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `company_code` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `company_code`, `password`, `created_at`) VALUES
(2, 'kasun', 'driver2', 'kasun123', '2024-10-22 06:48:25'),
(3, 'sachin', 'admin1', 'sachin123', '2024-10-22 06:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_users`
--

CREATE TABLE `contact_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`id`, `username`, `company_code`, `password`) VALUES
(1, 'sachin', 'admin1', 'sachin123'),
(2, 'kasun', 'driver1', 'kasun123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `route` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `address`, `phone_number`, `route`, `year`, `month`) VALUES
(1, 'diilsan', 'DAD', 'DA', '231', 2023, '21'),
(3, 'ssa', 'ggff', '4324324', 'ss222', 2024, '6'),
(4, 'dsds', 'ggff', '544553', 'sadd', 2025, '0'),
(5, 'ssas', 'dsg', '345', 'ee3', 2025, '0'),
(6, 'ssas', 'dsg', '345', 'ee3', 2025, '0');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`vehicle_name`, `vehicle_no`, `driver_name`, `username`, `password`, `longitude`, `latitude`) VALUES
('demo', '11`22', 'sssc', 'sachin', 'sachin123', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `driver_users`
--

CREATE TABLE `driver_users` (
  `username` varchar(50) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_users`
--

INSERT INTO `driver_users` (`username`, `company_code`, `password`) VALUES
('gilbert', 'driver2', 'gilbert123'),
('malitha', 'driver3', 'malitha123'),
('sachin', 'driver1', 'sachin123');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tea_type` varchar(10) NOT NULL,
  `sales_proceeds` varchar(10) NOT NULL,
  `selling_mark` varchar(50) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `total_weight` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `date`, `time`, `tea_type`, `sales_proceeds`, `selling_mark`, `quantity`, `weight`, `total_weight`, `price`) VALUES
(20, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(22, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(23, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(24, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(25, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(26, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(27, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(28, '2024-10-03', '13:49:00', 'FMSG', 'MCB', 'BHS', 23.00, 23.00, 23.00, 233.00),
(29, '2024-10-15', '13:53:00', 'PEKOE', 'LCBL', 'BH', 23.00, 222.00, 34.00, 4423.00);

-- --------------------------------------------------------

--
-- Table structure for table `scan_users`
--

CREATE TABLE `scan_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scan_users`
--

INSERT INTO `scan_users` (`id`, `username`, `company_code`, `password`) VALUES
(1, 'sachin', 'admin1', 'sachin123'),
(2, 'dilshan', 'driver1', 'dilshan123');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tea_type` varchar(10) NOT NULL,
  `sales_proceeds` varchar(10) NOT NULL,
  `selling_mark` varchar(20) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `total_weight` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id`, `date`, `time`, `tea_type`, `sales_proceeds`, `selling_mark`, `quantity`, `weight`, `total_weight`, `price`) VALUES
(1, '2024-08-06', '01:28:00', 'OP', 'MCB', 'BH', 2.00, 22.00, 122.00, 21221.00),
(2, '2024-07-31', '18:49:00', 'OP', 'CTB', 'BH', 44.00, 55.00, 22.00, 23.00);

-- --------------------------------------------------------

--
-- Table structure for table `tea_book`
--

CREATE TABLE `tea_book` (
  `entry_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `bags` int(11) DEFAULT NULL,
  `gross_weight` decimal(10,2) DEFAULT NULL,
  `net_weight` decimal(10,2) DEFAULT NULL,
  `lorry_driver` varchar(100) DEFAULT NULL,
  `factory_supervisor` varchar(100) DEFAULT NULL,
  `factory_manager` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tea_book`
--

INSERT INTO `tea_book` (`entry_id`, `customer_id`, `entry_date`, `bags`, `gross_weight`, `net_weight`, `lorry_driver`, `factory_supervisor`, `factory_manager`) VALUES
(1, 3, '2024-10-16', 34, 45.00, 67.00, 'Driver2', 'Supervisor1', 'Manager2'),
(2, 3, '2024-10-16', 4, 4554.00, 524.00, 'Driver2', 'Supervisor2', 'Manager1'),
(3, 3, '2024-10-16', 4, 4554.00, 524.00, 'Driver2', 'Supervisor2', 'Manager1'),
(16, 3, '2024-10-16', 4, 4554.00, 524.00, 'Driver2', 'Supervisor2', 'Manager1'),
(17, 3, '2024-10-16', 4, 4554.00, 524.00, 'Driver2', 'Supervisor2', 'Manager1'),
(18, 3, '2024-10-16', 4, 4554.00, 524.00, 'Driver2', 'Supervisor2', 'Manager1'),
(19, 3, '2024-10-08', 2, 23.00, 43.00, 'Driver1', 'Supervisor2', 'Manager2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `company_code` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `company_code`, `password`) VALUES
(6, 'sachin', 'admin1', '$2y$10$MBXAQ9tmbWtMnScJDLMMluhVlpgwmAVy6aoYwxya2WekFjv4en0lS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact_users`
--
ALTER TABLE `contact_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `driver_users`
--
ALTER TABLE `driver_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scan_users`
--
ALTER TABLE `scan_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tea_book`
--
ALTER TABLE `tea_book`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_users`
--
ALTER TABLE `contact_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `scan_users`
--
ALTER TABLE `scan_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tea_book`
--
ALTER TABLE `tea_book`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tea_book`
--
ALTER TABLE `tea_book`
  ADD CONSTRAINT `tea_book_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
