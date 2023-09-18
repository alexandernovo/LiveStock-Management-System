-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 03:56 AM
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
-- Database: `capstone2`
--

-- --------------------------------------------------------

--
-- Table structure for table `dastaff`
--

CREATE TABLE `dastaff` (
  `DAStaff_id` int(30) NOT NULL,
  `DAStaff_firstname` varchar(30) DEFAULT NULL,
  `DAStaff_lastname` varchar(30) DEFAULT NULL,
  `DAStaff_username` varchar(30) DEFAULT NULL,
  `DAStaff_password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dastaff`
--

INSERT INTO `dastaff` (`DAStaff_id`, `DAStaff_firstname`, `DAStaff_lastname`, `DAStaff_username`, `DAStaff_password`) VALUES
(1, 'Alexander', 'Novo', 'Admin', '$2y$10$Ga2/DpBy62XasIhA3nmMrO.SCdNkt2YVG176v6IAZfu//zGvsyfYW');

-- --------------------------------------------------------

--
-- Table structure for table `inspector`
--

CREATE TABLE `inspector` (
  `Inspector_id` int(30) NOT NULL,
  `DAStaff_id` int(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspector`
--

INSERT INTO `inspector` (`Inspector_id`, `DAStaff_id`, `firstname`, `lastname`, `username`, `password`, `contact`, `address`, `status`) VALUES
(1, 1, 'CJ', 'Duting', 'CJDuting', '$2y$10$hNDmMj0JgGP2xWWEL.BT/u4IH0.3LGOTE60Pm0.jfOmZ216SmMSwe', '+639673059833', 'Manduriao, Iloilo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspectstatus`
--

CREATE TABLE `inspectstatus` (
  `inspectstatus_id` int(250) NOT NULL,
  `Schedule_id` int(30) DEFAULT NULL,
  `Inspector_id` int(30) DEFAULT NULL,
  `inspect_status` varchar(30) DEFAULT NULL,
  `inspect_reason` varchar(100) DEFAULT NULL,
  `inspect_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspectstatus`
--

INSERT INTO `inspectstatus` (`inspectstatus_id`, `Schedule_id`, `Inspector_id`, `inspect_status`, `inspect_reason`, `inspect_datetime`) VALUES
(22, 23, 1, 'Accepted', NULL, '2023-04-28 21:02:57'),
(23, 24, 1, 'Accepted', NULL, '2023-04-28 21:02:50'),
(24, 25, 1, 'Accepted', NULL, '2023-04-28 21:03:12'),
(25, 26, 1, 'Accepted', NULL, '2023-04-28 21:03:10'),
(26, 27, NULL, 'Pending', NULL, '2023-05-02 12:48:52'),
(27, 28, NULL, 'Pending', NULL, '2023-05-02 12:48:52'),
(28, 29, NULL, 'Pending', NULL, '2023-05-02 12:51:16'),
(29, 30, NULL, 'Pending', NULL, '2023-05-02 12:51:16'),
(30, 31, 1, 'Accepted', NULL, '2023-05-02 13:31:12'),
(31, 32, 1, 'Pending', NULL, '2023-05-02 13:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `mso`
--

CREATE TABLE `mso` (
  `MSO_id` int(200) NOT NULL,
  `DAStaff_id` int(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `registereddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mso`
--

INSERT INTO `mso` (`MSO_id`, `DAStaff_id`, `firstname`, `lastname`, `username`, `password`, `contact`, `address`, `status`, `registereddate`) VALUES
(1, 1, 'Jorrine', 'Simaurio', 'JorrineSimaurio', '$2y$10$xzRNL9D.kQSVgMoxWY5/Q.kjn.KpmLHDoygyKmky6di2EQc5cTSqq', '+639673059833', 'Lapaz, Iloilo', 1, '2023-04-12 23:30:06'),
(2, 1, 'Leam', 'Galicia', 'LeamGalicia', '$2y$10$VQsiSWVLAGuZRnspPa3W5uxlf2tDWwKeLfvChgOf4.0dbJljPmr9m', '+639673059833', 'Dumanggas', 1, '2023-04-28 12:52:11'),
(3, 1, 'Kayn', 'Kameko', 'KaynKameko', '$2y$10$U1woHl6kROLHHFYMvCNk1.JozAki815PKVn0uj0IflPmq9p2jkxAK', '+639673059833', 'Laboris sunt minus ', 1, '2023-05-02 04:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `paymentstatus`
--

CREATE TABLE `paymentstatus` (
  `payment_id` int(200) NOT NULL,
  `inspectstatus_id` int(30) DEFAULT NULL,
  `Treasurer_id` int(30) DEFAULT NULL,
  `payment_status` varchar(30) DEFAULT NULL,
  `payment_price` float NOT NULL,
  `payment_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentstatus`
--

INSERT INTO `paymentstatus` (`payment_id`, `inspectstatus_id`, `Treasurer_id`, `payment_status`, `payment_price`, `payment_datetime`) VALUES
(13, 23, NULL, 'Not Paid', 0, '2023-04-28 21:02:50'),
(14, 22, NULL, 'Not Paid', 0, '2023-04-28 21:02:57'),
(15, 25, 1, 'Not Paid', 89, '2023-04-28 21:13:53'),
(16, 24, 1, 'Not Paid', 100, '2023-04-28 21:13:59'),
(17, 30, 1, 'Not Paid', 60, '2023-05-02 13:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(200) NOT NULL,
  `index_id` int(200) DEFAULT NULL,
  `MSO_id` int(30) DEFAULT NULL,
  `Animal_type` varchar(30) DEFAULT NULL,
  `Animal_quantity` varchar(60) DEFAULT NULL,
  `Animal_weight` varchar(60) DEFAULT NULL,
  `Animal_origin` varchar(60) DEFAULT NULL,
  `schedule_status` int(2) DEFAULT NULL,
  `schedule_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `index_id`, `MSO_id`, `Animal_type`, `Animal_quantity`, `Animal_weight`, `Animal_origin`, `schedule_status`, `schedule_datetime`) VALUES
(23, 1, 1, 'Carabao', '1', '87', 'Alexander Novo', 1, '2023-04-29 12:00:00'),
(24, 1, 1, 'Pig', '1', '76', 'Leam Gomie Galicia', 1, '2023-04-29 12:00:00'),
(25, 2, 2, 'Cow', '1', '78', 'Alexander Novo', 1, '2023-04-28 12:00:00'),
(26, 2, 2, 'Horse', '1', '67', 'John Christian Estribo', 1, '2023-04-28 12:00:00'),
(27, 3, 3, 'Pig', '1', '67', 'Alexander Novo', 1, '2023-05-02 17:10:00'),
(28, 3, 3, 'Carabao', '1', '90', 'Ruy Embiagi', 1, '2023-05-02 17:10:00'),
(29, 4, 1, 'Pig', '1', '89', 'Alexander Novo', 1, '2023-05-02 17:00:00'),
(30, 4, 1, 'Horse', '1', '67', 'Ruden Buensusausage', 1, '2023-05-02 17:00:00'),
(31, 5, 1, 'Pig', '1', '87', 'Alexander Novo', 1, '2023-05-03 12:00:00'),
(32, 5, 1, 'Pig', '1', '89', 'Alexander Novo', 1, '2023-05-03 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `treasurer`
--

CREATE TABLE `treasurer` (
  `Treasurer_id` int(30) NOT NULL,
  `DAStaff_id` int(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treasurer`
--

INSERT INTO `treasurer` (`Treasurer_id`, `DAStaff_id`, `firstname`, `lastname`, `username`, `password`, `contact`, `address`, `status`) VALUES
(1, 1, 'Chloyd', 'Pernia', 'ChloydPernia', '$2y$10$O7YaaLmzprga.IdNeRettOLdBUvQN/QLdd8gWAc70miUlruzx3te2', '+639673059833', 'Lapaz, Iloilo', 1),
(2, 1, 'Anne', 'Lynn', 'AnneLynn', '$2y$10$oFMCKt4wkWsdoagRqfs47.eaox3ptTTnj5NLiUU9SOl.7zN.DM7xO', '+639673059833', 'Lapaz, Iloilo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Error reading structure for table capstone2.users: #1932 - Table &#039;capstone2.users&#039; doesn&#039;t exist in engine
-- Error reading data for table capstone2.users: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `capstone2`.`users`&#039; at line 1

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dastaff`
--
ALTER TABLE `dastaff`
  ADD PRIMARY KEY (`DAStaff_id`);

--
-- Indexes for table `inspector`
--
ALTER TABLE `inspector`
  ADD PRIMARY KEY (`Inspector_id`),
  ADD KEY `DAStaff_id` (`DAStaff_id`);

--
-- Indexes for table `inspectstatus`
--
ALTER TABLE `inspectstatus`
  ADD PRIMARY KEY (`inspectstatus_id`),
  ADD KEY `Schedule_id` (`Schedule_id`),
  ADD KEY `Inspector_id` (`Inspector_id`);

--
-- Indexes for table `mso`
--
ALTER TABLE `mso`
  ADD PRIMARY KEY (`MSO_id`),
  ADD KEY `DAStaff_id` (`DAStaff_id`);

--
-- Indexes for table `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `inspectstatus_id` (`inspectstatus_id`),
  ADD KEY `Treasurer_id` (`Treasurer_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `MSO_id` (`MSO_id`);

--
-- Indexes for table `treasurer`
--
ALTER TABLE `treasurer`
  ADD PRIMARY KEY (`Treasurer_id`),
  ADD KEY `DAStaff_id` (`DAStaff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dastaff`
--
ALTER TABLE `dastaff`
  MODIFY `DAStaff_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inspector`
--
ALTER TABLE `inspector`
  MODIFY `Inspector_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inspectstatus`
--
ALTER TABLE `inspectstatus`
  MODIFY `inspectstatus_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mso`
--
ALTER TABLE `mso`
  MODIFY `MSO_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentstatus`
--
ALTER TABLE `paymentstatus`
  MODIFY `payment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `treasurer`
--
ALTER TABLE `treasurer`
  MODIFY `Treasurer_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inspector`
--
ALTER TABLE `inspector`
  ADD CONSTRAINT `inspector_ibfk_1` FOREIGN KEY (`DAStaff_id`) REFERENCES `dastaff` (`DAStaff_id`);

--
-- Constraints for table `inspectstatus`
--
ALTER TABLE `inspectstatus`
  ADD CONSTRAINT `inspectstatus_ibfk_1` FOREIGN KEY (`Schedule_id`) REFERENCES `schedule` (`schedule_id`),
  ADD CONSTRAINT `inspectstatus_ibfk_2` FOREIGN KEY (`Inspector_id`) REFERENCES `inspector` (`Inspector_id`);

--
-- Constraints for table `mso`
--
ALTER TABLE `mso`
  ADD CONSTRAINT `mso_ibfk_1` FOREIGN KEY (`DAStaff_id`) REFERENCES `dastaff` (`DAStaff_id`);

--
-- Constraints for table `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD CONSTRAINT `paymentstatus_ibfk_1` FOREIGN KEY (`inspectstatus_id`) REFERENCES `inspectstatus` (`inspectstatus_id`),
  ADD CONSTRAINT `paymentstatus_ibfk_2` FOREIGN KEY (`Treasurer_id`) REFERENCES `treasurer` (`Treasurer_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`MSO_id`) REFERENCES `mso` (`MSO_id`);

--
-- Constraints for table `treasurer`
--
ALTER TABLE `treasurer`
  ADD CONSTRAINT `treasurer_ibfk_1` FOREIGN KEY (`DAStaff_id`) REFERENCES `dastaff` (`DAStaff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
