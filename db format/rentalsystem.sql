-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 04:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `owner_id`, `username`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 2, 'admin', '$2y$10$hSgljnpmUyrqGIQRxzGXKegN5LHWu.FOVHnbTs3xSKestnf0e/6SG', '2024-07-18 14:40:53', '2024-08-14 19:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `a_id` int(11) NOT NULL COMMENT 'This is just ID not used in code',
  `apartment_id` int(11) NOT NULL COMMENT 'This is the ID we are using to copy the `sno`, and `flat` col from users',
  `owner_id` int(11) NOT NULL,
  `apartment_name` varchar(100) NOT NULL,
  `ap_type` varchar(50) NOT NULL,
  `apartment_rent` decimal(10,2) NOT NULL,
  `apartment_deposit` decimal(10,2) NOT NULL,
  `current_reading` int(15) NOT NULL,
  `last_reading` int(15) NOT NULL,
  `electricity_usage` int(15) NOT NULL,
  `electricity_rate` int(15) NOT NULL,
  `electricity_charges` int(15) NOT NULL,
  `total_rent` int(15) NOT NULL,
  `rent_date` date NOT NULL,
  `apartment_maintainance` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`a_id`, `apartment_id`, `owner_id`, `apartment_name`, `ap_type`, `apartment_rent`, `apartment_deposit`, `current_reading`, `last_reading`, `electricity_usage`, `electricity_rate`, `electricity_charges`, `total_rent`, `rent_date`, `apartment_maintainance`, `created_at`, `updated_at`) VALUES
(1, 15, 2, 'K1', '1BHK', 9000.00, 10000.00, 2250, 2200, 50, 13, 650, 9650, '2024-08-01', 2000.00, '2024-08-10 16:49:02', '2024-08-15 06:56:40'),
(5, 16, 2, 'K2', '1BHK', 8500.00, 10000.00, 1300, 1250, 50, 13, 650, 9150, '2024-08-15', 0.00, '2024-08-14 19:26:01', '2024-08-14 19:41:40'),
(6, 14, 2, 'K3', '1BHK', 9000.00, 11000.00, 1250, 1200, 50, 13, 650, 9650, '2024-07-31', 0.00, '2024-08-14 19:45:32', '2024-08-14 19:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `apartments_rec`
--

CREATE TABLE `apartments_rec` (
  `a_id` int(11) NOT NULL COMMENT 'This is just ID not used in code',
  `apartment_id` int(11) NOT NULL COMMENT 'This is the ID we are using to copy the `sno`, and `flat` col from users',
  `owner_id` int(11) NOT NULL,
  `apartment_name` varchar(100) NOT NULL,
  `ap_type` varchar(50) NOT NULL,
  `apartment_rent` decimal(10,2) NOT NULL,
  `apartment_deposit` decimal(10,2) NOT NULL,
  `current_reading` int(15) NOT NULL,
  `last_reading` int(15) NOT NULL,
  `electricity_usage` int(15) NOT NULL,
  `electricity_rate` int(15) NOT NULL,
  `electricity_charges` int(15) NOT NULL,
  `total_rent` int(15) NOT NULL,
  `rent_date` date NOT NULL,
  `apartment_maintainance` decimal(10,2) NOT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments_rec`
--

INSERT INTO `apartments_rec` (`a_id`, `apartment_id`, `owner_id`, `apartment_name`, `ap_type`, `apartment_rent`, `apartment_deposit`, `current_reading`, `last_reading`, `electricity_usage`, `electricity_rate`, `electricity_charges`, `total_rent`, `rent_date`, `apartment_maintainance`, `inserted_at`, `created_at`, `updated_at`) VALUES
(1, 37, 2, 'check del', '1rk', 9000.00, 12000.00, 2124, 2121, 3, 13, 39, 9039, '2024-08-01', 0.00, '2024-08-14 22:32:40', '2024-08-14 22:00:00', '2024-08-14 22:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `dropdown_options`
--

CREATE TABLE `dropdown_options` (
  `id` int(11) NOT NULL,
  `option_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oldtenants`
--

CREATE TABLE `oldtenants` (
  `oldtenantid` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `apartment_name` varchar(15) NOT NULL,
  `tenant_name` varchar(100) NOT NULL,
  `tenant_job` varchar(100) NOT NULL,
  `tenant_address` varchar(255) NOT NULL,
  `tenant_contact` varchar(20) NOT NULL,
  `tenant_parent` varchar(100) NOT NULL,
  `parent_contact` int(20) NOT NULL,
  `tenant_doc_1` varchar(255) NOT NULL,
  `tenant_doc_2` varchar(255) NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_deposit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oldtenants`
--

INSERT INTO `oldtenants` (`oldtenantid`, `tenant_id`, `apartment_id`, `apartment_name`, `tenant_name`, `tenant_job`, `tenant_address`, `tenant_contact`, `tenant_parent`, `parent_contact`, `tenant_doc_1`, `tenant_doc_2`, `date_of_entry`, `t_deposit`) VALUES
(1, 0, 0, 'K3', 'New roommate', 'stud', 'kolhapur', '321649', 'lal', 4353234, 'IMG_3023.JPG', 'IMG_3025.JPG', '2024-08-24 12:39:21', 0),
(3, 8, 15, 'K1', 'latest tenant with flat name', 'gg', 'near RTGI', '90898', 'pop', 89487593, 'IMG_3023.JPG', 'IMG_3024.JPG', '2024-08-24 12:39:21', 0),
(6, 9, 15, 'K1', 'dfad', 'dfadfass', 'fasdfas', '34322', 'adafa', 34234, 'IMG_0348.MOV', 'IMG_0352.MOV', '2024-08-24 12:39:21', 0),
(7, 1, 15, '', 'adi', 'student', 'near RGI', '9028', 'mummy', 98812, 'A001_07271531_C003.mov', 'A001_07271533_C004.mov', '2024-08-24 12:39:21', 0),
(8, 10, 15, 'K1', 'ada', 'asdfa', 'fasdfa', '465463', 'dadfas', 4353, 'IMG_0335.MOV', 'IMG_3023.JPG', '2024-08-24 12:39:21', 0),
(9, 11, 15, 'K1', 'o one', 'noen', 'near RGI', '943895892', 'fathe', 984958, 'IMG_3024.JPG', 'IMG_0348.MOV', '2024-08-24 12:39:21', 0),
(10, 12, 15, 'K1', 'asdfas', 'fasdfas', 'fasdfas', '0', 'fdasfasdf', 0, 'IMG_0348.MOV', 'dpmadir.MOV', '2024-08-24 12:39:21', 0),
(11, 13, 15, 'K1', 'no oen', 'dafasf ', 'n3eae', '9', 'adsfas', 9873948, 'IMG_3022.JPG', 'IMG_0353.MOV', '2024-08-24 12:39:21', 0),
(12, 14, 15, 'K1', 'ten3', 'stud', 'RGI', '874857', 'pap', 84938, '', '', '2024-08-24 12:39:21', 0),
(13, 15, 15, 'K1', 'ten1', 'dfasd', 'dfasdfas', '545345', 'sdfasdfa', 4353245, 'IMG_3026.JPG', 'IMG_0348.MOV', '2024-08-24 12:39:21', 0),
(14, 16, 15, 'K1', 'ten2', 'asdfasdhasd', 'dafasdf', '2341345124', 'adfasdfas', 53463546, 'IMG_0352.MOV', 'IMG_0348.MOV', '2024-08-24 12:39:21', 0),
(15, 4, 14, '', 'akash', 'stud', 'kolhapur', '988810', 'papa', 888923, 'IMG_3022.JPG', 'IMG_3023.JPG', '2024-08-24 12:39:21', 0),
(16, 5, 14, '', 'new one', 'none', 'address its is ', '84830', 'fater', 78884, 'IMG_3023.JPG', 'IMG_3026.JPG', '2024-08-24 12:39:21', 0),
(18, 18, 14, 'K3', 'tenant304', 'noene', 'near Rgi', '9405820', 'pop', 9834095, 'IMG_7559.DNG', 'IMG_7559.DNG', '2024-08-24 12:39:21', 0),
(19, 19, 14, 'K3', 'balala', 'kfgasc', 'aldkjfaslk', '87495', 'kfdgjlkas', 980980, 'IMG_7660.MOV', 'IMG_7559.DNG', '2024-08-24 12:39:21', 0),
(20, 20, 14, 'K3', 'dfgdsfad', 'fasdfasdfa', 'asdfasd', '324234', 'adsfasdf', 2342342, 'IMG_8960.MP4', 'IMG_7576 (1).MOV', '2024-08-24 12:39:21', 0),
(21, 21, 14, 'K3', 'tenant2', 'kjdfa', 'adlkjfls', '95409', 'kasdflgj', 98443, 'college_pcm.xml', 'IMG_5369.MOV', '2024-08-24 12:39:21', 0),
(22, 24, 16, 'K2', 'aditya new', 'none ', 'near RGI', '98698349', 'noen', 98495832, 'IMG_7576 (1).MOV', 'IMG_5368.MOV', '2024-08-24 14:18:35', 0),
(23, 26, 14, 'K2', 'new added from unknown flat', 'none', 'near ghr', '9405909', 'dkfljadsk', 9, 'LOR Shreenath Project.docx', 'LOR Shreenath HOD.docx', '2024-08-28 11:00:14', 0),
(24, 29, 15, 'K1', 'added to k1', 'asdfas', 'adsfasdf', '234234', 'cdsaga', 234234, 'LOR Sanspots SK.docx', 'LOR Shreenath Project.docx', '2024-08-28 11:18:41', 0),
(25, 25, 15, 'K1', 'me', 'noenwo', 'asdfa', '98778787', 'noaea', 898778, 'LOR Shreenath HOD.docx', 'LOR Shreenath Project.docx', '2024-08-28 11:18:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `owners table`
--

CREATE TABLE `owners table` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `owner_con` varchar(20) NOT NULL,
  `owner_email` varchar(100) NOT NULL,
  `owner_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners table`
--

INSERT INTO `owners table` (`owner_id`, `owner_name`, `owner_con`, `owner_email`, `owner_address`) VALUES
(2, 'ad', '45352', 'dsaf@gg.bo', 'advesdcx');

-- --------------------------------------------------------

--
-- Table structure for table `rentaltransactions`
--

CREATE TABLE `rentaltransactions` (
  `transaction_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `tenant_in_date` date NOT NULL,
  `tenant_out_date` date NOT NULL,
  `tenant_deposit_paid` decimal(10,2) NOT NULL,
  `tenant_rent_paid` decimal(10,2) NOT NULL,
  `last_energy_reading` varchar(20) NOT NULL,
  `current_energy_reading` varchar(20) NOT NULL,
  `electricity_usage` int(11) NOT NULL,
  `electricity_rate` int(15) NOT NULL,
  `electricity_charges` int(15) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `total_rent` int(10) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `apartment_name` varchar(15) NOT NULL,
  `tenant_name` varchar(100) NOT NULL,
  `tenant_job` varchar(100) NOT NULL,
  `tenant_address` varchar(255) NOT NULL,
  `tenant_contact` varchar(20) NOT NULL,
  `tenant_parent` varchar(100) NOT NULL,
  `parent_contact` varchar(20) NOT NULL,
  `tenant_doc_1` varchar(255) NOT NULL,
  `tenant_doc_2` varchar(255) NOT NULL,
  `date_of_entry` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_deposit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `apartment_id`, `apartment_name`, `tenant_name`, `tenant_job`, `tenant_address`, `tenant_contact`, `tenant_parent`, `parent_contact`, `tenant_doc_1`, `tenant_doc_2`, `date_of_entry`, `t_deposit`) VALUES
(6, 16, 'K2', 'K2 tenant', 'none', 'nowhere', '9999', 'lala', '90949', 'IMG_3023.JPG', 'IMG_3027.JPG', '2024-08-02 12:30:21', 0),
(17, 15, 'K1', 'ten34', 'adsfaj', 'adfasfaklff', '8934759', 'jasdfka', '809734985', '../uploads/17_Aadhar_1725722076.JPG', '../uploads/17_ID_1725722076.JPG', '2024-08-07 16:17:00', 2000),
(22, 17, 'K4', 'k4 gg', 'nothing', 'local he bhai', '980934850', 'paap', '908405982', 'Screenshot 2024-08-17 103340.png', 'Ideathon 2024 Tech for Sustainable and Inclusive Financial Futures.pdf', '2024-08-18 13:27:15', 0),
(23, 15, 'K1', 'ghule', 'architect', 'near raisoni', '850983948', 'ghule', '98398395', 'IMG_7577.MOV', 'IMG_5369.MOV', '2024-08-24 09:13:11', 0),
(27, 14, 'K3', 'another one', 'jksdfkgjahk', 'adsfjal', '8989867', 'nsdlkaflds', '98977878', 'LOR Shreenath HOD.docx', 'LOR Shreenath Project.docx', '2024-08-28 10:56:56', 1200),
(28, 14, 'K3', 'add new tenant k3', 'jkdaslkfnasdl', 'adksfalksdj', '9808090', 'kasjdokfgjos', '98080890', 'LOR Shreenath Project.docx', 'LOR Shreenath HOD.docx', '2024-08-28 11:01:12', 12312),
(30, 16, 'K2', 'to k2', 'kasdjfgkajl', ';sakdfopdgjs', '545446', 'slkadfjgkasj', '94858978', 'LOR Sanspots SK.docx', 'LOR Shreenath Project.docx', '2024-08-28 11:02:45', 8234),
(31, 15, 'K1', 'NewUserWDoc', 'student', 'near RGI', '89894548', 'pa', '984598921', '', '', '2024-09-07 15:29:23', 1200),
(32, 15, 'K1', 'adsfasd', 'dsafadf', 'sdfasdfas', '34223523', 'dasfas', '234234', 'IMG_2987.JPG', 'IMG_2993.JPG', '2024-09-07 15:40:55', 435),
(33, 15, 'K1', 'asdfasdfas', 'asdfahadfg', 'asdfasdfasdg', '56456464', 'adfasdfa', '234345', 'IMG_2989.JPG', 'IMG_2993.JPG', '2024-09-07 15:42:53', 532),
(34, 15, 'K1', 'ThisName', 'noen', 'RGI', '897857328', 'chaha', '94387598', '../uploads/ThisName_Aadhar_1725723899.JPG', '../uploads/ThisName_ID_1725723899.JPG', '2024-09-07 15:44:59', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `flat` varchar(11) NOT NULL,
  `flat_type` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `flat`, `flat_type`, `username`, `password`, `dt`) VALUES
(14, 'K3', '1BHK', 'krushnakunj@k3', '$2y$10$rxfr/sWrXAC9QTpo10r9J.WWUG9Vjl2zOQ6ap5oNINQem2cVmgR1a', '2024-07-21 22:09:25'),
(15, 'K1', '1BHK', 'krushnakunj@k1', '$2y$10$ju3.4o1oFHkEPiAxC32Ck.jAKl.qobPYeJGqcWplyx/M7/c7cS8am', '2024-07-21 22:30:13'),
(16, 'K2', '1BHK', 'user2', '$2y$10$7fbX0QkeSGTNIGLlQe8aQO9uYVheODgeyYH5KfCHnMFTZ8Il3/Bmu', '2024-07-21 23:04:24'),
(17, 'K4', '1BHK', 'krushnakunj@k4', '$2y$10$T0j1dwmhewvH4Eo5wtOm/.fKnele.x/YQkI1nVcpPyXaKLiujeGE6', '2024-07-24 18:05:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_user` (`username`),
  ADD UNIQUE KEY `owner_id` (`owner_id`);

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `apartment_id` (`apartment_id`),
  ADD KEY `aprtmnt-owner` (`owner_id`);

--
-- Indexes for table `apartments_rec`
--
ALTER TABLE `apartments_rec`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `apartment_id` (`apartment_id`),
  ADD KEY `aprtmnt-owner` (`owner_id`);

--
-- Indexes for table `dropdown_options`
--
ALTER TABLE `dropdown_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oldtenants`
--
ALTER TABLE `oldtenants`
  ADD PRIMARY KEY (`oldtenantid`);

--
-- Indexes for table `owners table`
--
ALTER TABLE `owners table`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `rentaltransactions`
--
ALTER TABLE `rentaltransactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `trnsctn-tenant-aprtmnt` (`apartment_id`,`tenant_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`),
  ADD KEY `tenant-aprtmnt` (`apartment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This is just ID not used in code', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `apartments_rec`
--
ALTER TABLE `apartments_rec`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'This is just ID not used in code', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dropdown_options`
--
ALTER TABLE `dropdown_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oldtenants`
--
ALTER TABLE `oldtenants`
  MODIFY `oldtenantid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `owners table`
--
ALTER TABLE `owners table`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rentaltransactions`
--
ALTER TABLE `rentaltransactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `owner-owner` FOREIGN KEY (`owner_id`) REFERENCES `owners table` (`owner_id`);

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `aprtmnt-owner` FOREIGN KEY (`owner_id`) REFERENCES `owners table` (`owner_id`),
  ADD CONSTRAINT `aprtmnt-user-flat` FOREIGN KEY (`apartment_id`) REFERENCES `users` (`sno`);

--
-- Constraints for table `rentaltransactions`
--
ALTER TABLE `rentaltransactions`
  ADD CONSTRAINT `trnsctn-tenant-aprtmnt` FOREIGN KEY (`apartment_id`,`tenant_id`) REFERENCES `tenants` (`apartment_id`, `tenant_id`);

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenant-aprtmnt` FOREIGN KEY (`apartment_id`) REFERENCES `users` (`sno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
