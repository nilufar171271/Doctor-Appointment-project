-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 02:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` text NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `consult_status` int(11) NOT NULL DEFAULT 0,
  `seen_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_id`, `doctor_id`, `date`, `booking_date`, `message`, `transaction_id`, `status`, `consult_status`, `seen_status`) VALUES
(0, 36, 2329, '2023-01-10', '2023-01-10 13:41:23', 'hi', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nid` bigint(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `specialist_id` int(11) NOT NULL,
  `practice_time_start` varchar(255) NOT NULL,
  `practice_time_stop` varchar(255) NOT NULL,
  `serial_time_start` varchar(255) NOT NULL,
  `serial_time_stop` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `bkash_merchant_no` varchar(20) NOT NULL,
  `consult_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `full_name`, `email`, `password`, `nid`, `mobile`, `photo`, `qualification`, `specialist_id`, `practice_time_start`, `practice_time_stop`, `serial_time_start`, `serial_time_stop`, `status`, `bkash_merchant_no`, `consult_fee`) VALUES
(2327, 'neela', 'neela@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1234567, '01876904321', '1673253813WhatsApp Image 2023-01-07 at 11.13.41 PM.jpeg', 'MBBS', 2, '12 AM', '4 PM', '12 AM', '4 PM', 1, '01876904321', 500),
(2328, 'Plato Goff', 'palukygyw@mailinator.com', 'e10adc3949ba59abbe56e057f20f883e', 52, '62', '1673279991Dr.-Anisul-Awal.jpg', 'Molestiae mollit con', 2, '8 PM', '11 PM', '8 PM', '11 PM', 1, '83', 73),
(2329, 'nusrat', 'nusrat@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '09', '1673357954Dr.-Taimoon-Nahar-Khanom.jpg', 'mbbs', 4, '1 PM', '11 PM', '1 PM', '10 PM', 1, '09', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nid` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `full_name`, `age`, `gender`, `mobile`, `email`, `address`, `nid`, `password`) VALUES
(36, 'Mahi', '23', 'Female', 1839275940, 'mahi@gmail.com', 'chandgaon r/a', 0, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `sl_no` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` varchar(255) NOT NULL,
  `plm_descript` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `patient_id`, `doctor_id`, `sl_no`, `date`, `age`, `plm_descript`, `note`) VALUES
(1044, 33, 2313, 1546453525, '2019-01-02 18:25:50', '35', 'asdsd', 'sdsdfsf'),
(1045, 32, 2313, 1546453554, '2019-01-02 18:26:06', '22', 'sdfs', 'dfsdfsdf'),
(1046, 33, 2313, 1546677278, '2019-01-05 08:35:04', '35', 'zsdsd', 'sfddfd'),
(0, 36, 2329, 1673358398, '2023-01-10 13:54:05', '', 'high fever', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `prescript_medicine_details`
--

CREATE TABLE `prescript_medicine_details` (
  `id` int(11) NOT NULL,
  `prescript_id` int(11) NOT NULL,
  `med_name` varchar(255) NOT NULL,
  `med_taking_time` varchar(255) NOT NULL,
  `med_taking_dura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescript_medicine_details`
--

INSERT INTO `prescript_medicine_details` (`id`, `prescript_id`, `med_name`, `med_taking_time`, `med_taking_dura`) VALUES
(51, 1044, 'sdfsdf', '3', '3 months'),
(52, 1044, 'sdfsdf', '3', '3 months'),
(53, 1044, 'sdfsdf', '3', '3'),
(54, 1045, 'sdfsdf', 'sdfsdf', 'sfs'),
(55, 1046, 'bjhhj', '3', '3 months'),
(0, 0, 'napa', '3 times', '1 month');

-- --------------------------------------------------------

--
-- Table structure for table `prescript_test_details`
--

CREATE TABLE `prescript_test_details` (
  `id` int(11) NOT NULL,
  `prescript_id` int(11) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `test_report` varchar(255) DEFAULT NULL,
  `labratorian_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `report_details` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescript_test_details`
--

INSERT INTO `prescript_test_details` (`id`, `prescript_id`, `test_name`, `description`, `test_report`, `labratorian_id`, `status`, `report_details`) VALUES
(35, 1044, 'sdfsdf', 'sdfsdfsdf', NULL, NULL, 0, NULL),
(36, 1044, 'sdfsdf', 'sdfsdfsdf', NULL, NULL, 0, NULL),
(37, 1045, 'sdfsdf', 'sdfsdf', NULL, NULL, 0, NULL),
(38, 1046, 'werer', 'rert', NULL, NULL, 0, NULL),
(0, 0, 'n/a', 'n/a', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report_generate`
--

CREATE TABLE `report_generate` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_rep_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specialist_lookup`
--

CREATE TABLE `specialist_lookup` (
  `specialist_id` int(11) NOT NULL,
  `specialist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialist_lookup`
--

INSERT INTO `specialist_lookup` (`specialist_id`, `specialist`) VALUES
(1, 'Medicine specialist'),
(2, 'Cardiologist'),
(3, 'Gynecologist'),
(4, 'Oncologist'),
(5, 'Surgeon'),
(6, 'Forensic pathologist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2331;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
