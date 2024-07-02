-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 03:01 PM
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
-- Database: `tmz`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Employee_ID` varchar(20) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Account_Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Employee_ID`, `Password`, `Status`, `Account_Status`) VALUES
('TMZ101001', '$2y$10$BnqvC7T9F.gvMu5LtAmH2eP1oabwG5bpF5vyP8beUrmNCSA4OwhUe', 'Inactive', 'Registered'),
('TMZ101002', '$2y$10$pZs5/ZWef0VUUhvU4oKnteei0S.ba5K1Nx4kPX.Bq.4tZoNUFHMda', 'Inactive', 'Registered'),
('TMZ101004', '$2y$10$whbqBE26A0nV4ez/HkCJ8uITmmv7YT.mksNu0i/kRJUNtFXhSFM5S', 'Active', 'Registered'),
('TMZ101005', '$2y$10$BuZRFcQjkgL0T72SLIj1Quw9YvOg4k3EbeSXR5OzO9MX70I4XQkHe', 'Inactive', 'Registered'),
('TMZ101006', '$2y$10$s9/NswuZGZs9WoxHrG/LxO2buNwtheeDv5j8ouKcJalQDUgPzxhpO', 'Inactive', 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `Employee_ID` varchar(20) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Birthday` date NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`Employee_ID`, `Firstname`, `Lastname`, `Contact`, `Email`, `Address`, `Birthday`, `Gender`, `Country`, `Language`) VALUES
('TMZ101003', 'Erwin', 'Valez', 9846257554, 'erwin@gmail.com', 'Maine st., Molino IV, Bacoor, Cavite', '2003-11-24', 'Male', 'Philippines', 'Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `Employee_ID` varchar(20) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Contact` bigint(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Type_of_Employment` varchar(50) NOT NULL,
  `Working_Days` varchar(50) NOT NULL,
  `Working_Hours` varchar(50) NOT NULL,
  `Birthday` date NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Language` varchar(50) NOT NULL,
  `Bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`Employee_ID`, `Position`, `picture`, `Firstname`, `Lastname`, `Contact`, `Email`, `Address`, `Type_of_Employment`, `Working_Days`, `Working_Hours`, `Birthday`, `Gender`, `Country`, `Language`, `Bio`) VALUES
('TMZ101001', 'Front-End Developer', 'profiles/ferd.png', 'Ferdinand', 'Olaira', 9587776969, 'ferd@gmail.com', 'Blk 14 lot 28 Garnet Street, Silvertowne 4, Malagasang 2-B Imus City Cavite', 'Full Time', '5', '8', '2004-04-12', 'Male', 'Philippines', 'Tagalog', 'I am Ferdy '),
('TMZ101002', 'Front-End Developer', 'profiles/kate.png', 'Kate', 'Pades', 9564552584, 'kate@gmail.com', 'BLK 8 LOT 40 GTV1 MAMBOG 3, BACOOR CITY', 'Full Time', '5', '9', '2003-05-13', 'Female', 'Philippines', 'English', 'No Bio'),
('TMZ101004', 'UI/UX Designer', 'profiles/walid.png', 'Walid', 'Dimao', 9255525566, 'walid@gmail.com', 'EUGENIO VILLANUEVA AVE, GREENTOWN VILLAGE, TOCLONG ||-B, IMUS, CAVITE', 'Internship', '7', '24', '2003-06-14', 'Male', 'Russia', 'Urdu', 'No Bio'),
('TMZ101005', 'Product Manager', 'profiles/kane.png', 'Kane', 'Rosales', 9541516575, 'kanep@gmail.com', 'B. 36, L. 23, JADE RESIDENCES, MALAGASANG I-G, IMUS CITY, CAVITE', 'Contract', '3', '12', '2003-10-26', 'Male', 'Egypt', 'Wu', 'No Bio'),
('TMZ101006', 'Market Analyst ', 'profiles/keane.png', 'Keane', 'Mariano', 9235162564, 'keane@gmail.com', '205, LIGAS 2, BACOOR, CAVITE', 'Freelance/Self-employed', '5', '5', '1998-11-01', 'Other', 'India', 'Hindi', 'No Bio');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Employee_ID` varchar(20) NOT NULL,
  `Via` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`Employee_ID`, `Via`) VALUES
('TMZ101002', 'kate@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `Project_ID` int(10) NOT NULL,
  `Project_Title` varchar(100) NOT NULL,
  `Project_Description` text NOT NULL,
  `Number_of_Employee` int(10) NOT NULL,
  `Finished` int(10) NOT NULL,
  `Due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `Task_ID` int(10) NOT NULL,
  `Task_Title` varchar(200) DEFAULT NULL,
  `Task_Description` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Start` date NOT NULL,
  `Due` date NOT NULL,
  `Employee_ID` varchar(20) DEFAULT NULL,
  `Project_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_ID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`Task_ID`),
  ADD KEY `Employee_ID` (`Employee_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `accounts` (`Employee_ID`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `accounts` (`Employee_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
