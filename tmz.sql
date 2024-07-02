-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 01:49 AM
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
('TMZ101001', '$2y$10$0ZuBT/aaRr7XAiSbg/WhzuctR6fGSJ00cHNSfY5wDX.wf7dU1riMO', 'Inactive', 'Registered'),
('TMZ101002', '$2y$10$SujYg9GlfZbVBanOFu/yT.yZzTu0yR.Y97VyNKKXn5CVbQlE52kHC', 'Inactive', 'Registered'),
('TMZ101004', '$2y$10$whbqBE26A0nV4ez/HkCJ8uITmmv7YT.mksNu0i/kRJUNtFXhSFM5S', 'Active', 'Registered'),
('TMZ101005', '$2y$10$BuZRFcQjkgL0T72SLIj1Quw9YvOg4k3EbeSXR5OzO9MX70I4XQkHe', 'Inactive', 'Registered'),
('TMZ101006', '$2y$10$s9/NswuZGZs9WoxHrG/LxO2buNwtheeDv5j8ouKcJalQDUgPzxhpO', 'Inactive', 'Registered'),
('TMZ101007', '$2y$10$M1g/BaN/ruuN4bRot02Xw.QrGV7TRWLm.w2XGNOJMAE4KdkUdPVRW', 'Active', 'Registered'),
('TMZ101008', '$2y$10$1JGHsAl5icrxvGpnNA2kUeWvTYQqec.SvtKxdZF9/8VGyOI9rnMvy', 'Inactive', 'Registered'),
('TMZ101009', '$2y$10$HHh3RdsT8kUi0cAMyR33pO4O5SSOkQE7.dfdRI1pdcxHQ5zj9..Gq', 'Active', 'Registered'),
('TMZ101010', '$2y$10$qdIn35fIzepFrP0260Z8V.fT5C1C9J4LyaKj7Gc9Pb5ifasJdAY1a', 'Inactive', 'Registered');

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
('TMZ101006', 'Market Analyst ', 'profiles/keane.png', 'Keane', 'Mariano', 9235162564, 'keane@gmail.com', '205, LIGAS 2, BACOOR, CAVITE', 'Freelance/Self-employed', '5', '5', '1998-11-01', 'Other', 'India', 'Hindi', 'No Bio'),
('TMZ101007', 'Back-End Developer', 'profiles/dwight.png', 'Dwight', 'Rivera', 9556222654, 'dwight@gmail.com', 'Earth', 'Temporary', '2', '4', '2016-05-03', 'Male', 'Russia', 'German', 'No Bio'),
('TMZ101008', 'Back-End Developer', 'profiles/lorenz.png', 'Lorenz', 'Manaog', 9588762215, 'lorenz@gmail.com', 'Unang kaliwa tas kanan', 'Freelance/Self-employed', '5', '12', '2007-05-30', 'Male', 'Pakistan', 'Indonesian', 'No Bio'),
('TMZ101009', 'Front-End Developer', 'profiles/pic.png', 'Jamaine', 'Malabanan', 9696969699, 'jamaine@gmail.com', 'Basta malayo', 'Full Time', '1', '1', '2014-06-12', 'Female', 'Egypt', 'Hindi', 'No Bio'),
('TMZ101010', 'UI/UX Designer', 'profiles/noprofile.png', 'Marc', 'Pasquin', 9551515444, 'marc@gmail.com', 'Tabi ng mars', 'Part Time', '2', '2', '2017-06-03', 'Male', 'Russia', 'Telugu', 'No Bio');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Employee_ID` varchar(20) NOT NULL,
  `Via` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`Project_ID`, `Project_Title`, `Project_Description`, `Number_of_Employee`, `Finished`, `Due`) VALUES
(1, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 5, 0, '2024-09-05'),
(2, 'Building a Scalable Cloud Infrastructure for Data Analytics', 'Architect and deploy a scalable cloud infrastructure tailored for intensive data analytics workloads. This project involves selecting appropriate cloud services (e.g., AWS, Azure), designing fault-tolerant data pipelines, optimizing data storage and retrieval mechanisms, and implementing automated monitoring and scaling solutions. The objective is to enable efficient data processing, analysis, and visualization while ensuring high availability and cost-effectiveness in a cloud-native environment.', 3, 0, '2024-09-12');

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
-- Dumping data for table `task`
--

INSERT INTO `task` (`Task_ID`, `Task_Title`, `Task_Description`, `Status`, `Type`, `Start`, `Due`, `Employee_ID`, `Project_ID`) VALUES
(1, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Finished', 'Task', '2024-07-03', '2024-08-09', 'TMZ101001', 0),
(2, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101002', 0),
(3, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101004', 0),
(4, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Finished', 'Task', '2024-07-03', '2024-08-09', 'TMZ101005', 0),
(5, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101006', 0),
(6, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101007', 0),
(7, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101008', 0),
(8, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101009', 0),
(9, 'Implementing AI-driven Personalization for E-commerce Platforms', 'Develop a machine learning model that utilizes customer behavior data to personalize product recommendations on an e-commerce platform. The task involves collecting and preprocessing data, training and fine-tuning the model, and integrating it into the existing platform infrastructure. Ensure scalability and performance optimization to enhance user experience and increase conversion rates.', 'Pending', 'Task', '2024-07-03', '2024-08-09', 'TMZ101010', 0),
(10, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 'Finished', 'Project', '2024-07-03', '2024-09-05', 'TMZ101004', 1),
(11, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 'Finished', 'Project', '2024-07-03', '2024-09-05', 'TMZ101005', 1),
(12, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 'Pending', 'Project', '2024-07-03', '2024-09-05', 'TMZ101009', 1),
(13, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 'Pending', 'Project', '2024-07-03', '2024-09-05', 'TMZ101010', 1),
(14, 'Enhancing Cybersecurity Measures through Multi-factor Authentication (MFA)', 'Design and implement a robust multi-factor authentication (MFA) system to bolster the security of our companys digital assets. This task includes researching MFA protocols, developing a scalable authentication framework, integrating it with existing systems, and conducting thorough testing to ensure reliability and user-friendliness. The goal is to mitigate risks associated with unauthorized access and enhance overall cybersecurity posture.', 'Pending', 'Project', '2024-07-03', '2024-09-05', 'TMZ101001', 1),
(15, 'Building a Scalable Cloud Infrastructure for Data Analytics', 'Architect and deploy a scalable cloud infrastructure tailored for intensive data analytics workloads. This project involves selecting appropriate cloud services (e.g., AWS, Azure), designing fault-tolerant data pipelines, optimizing data storage and retrieval mechanisms, and implementing automated monitoring and scaling solutions. The objective is to enable efficient data processing, analysis, and visualization while ensuring high availability and cost-effectiveness in a cloud-native environment.', 'Pending', 'Project', '2024-07-03', '2024-09-12', 'TMZ101002', 2),
(16, 'Building a Scalable Cloud Infrastructure for Data Analytics', 'Architect and deploy a scalable cloud infrastructure tailored for intensive data analytics workloads. This project involves selecting appropriate cloud services (e.g., AWS, Azure), designing fault-tolerant data pipelines, optimizing data storage and retrieval mechanisms, and implementing automated monitoring and scaling solutions. The objective is to enable efficient data processing, analysis, and visualization while ensuring high availability and cost-effectiveness in a cloud-native environment.', 'Pending', 'Project', '2024-07-03', '2024-09-12', 'TMZ101008', 2),
(17, 'Building a Scalable Cloud Infrastructure for Data Analytics', 'Architect and deploy a scalable cloud infrastructure tailored for intensive data analytics workloads. This project involves selecting appropriate cloud services (e.g., AWS, Azure), designing fault-tolerant data pipelines, optimizing data storage and retrieval mechanisms, and implementing automated monitoring and scaling solutions. The objective is to enable efficient data processing, analysis, and visualization while ensuring high availability and cost-effectiveness in a cloud-native environment.', 'Pending', 'Project', '2024-07-03', '2024-09-12', 'TMZ101001', 2),
(18, 'Developing a Blockchain-based Supply Chain Management System', 'Create a decentralized supply chain management system using blockchain technology. Tasks include designing smart contracts for transparent and secure transaction recording, integrating IoT devices for real-time data tracking, and implementing a user-friendly interface for stakeholders. The goal is to enhance traceability, reduce fraud, and streamline logistics operations across the supply chain ecosystem.', 'Pending', 'Task', '2024-07-03', '2024-09-06', 'TMZ101006', 0),
(19, 'Developing a Blockchain-based Supply Chain Management System', 'Create a decentralized supply chain management system using blockchain technology. Tasks include designing smart contracts for transparent and secure transaction recording, integrating IoT devices for real-time data tracking, and implementing a user-friendly interface for stakeholders. The goal is to enhance traceability, reduce fraud, and streamline logistics operations across the supply chain ecosystem.', 'Pending', 'Task', '2024-07-03', '2024-09-06', 'TMZ101007', 0),
(20, 'Developing a Blockchain-based Supply Chain Management System', 'Create a decentralized supply chain management system using blockchain technology. Tasks include designing smart contracts for transparent and secure transaction recording, integrating IoT devices for real-time data tracking, and implementing a user-friendly interface for stakeholders. The goal is to enhance traceability, reduce fraud, and streamline logistics operations across the supply chain ecosystem.', 'Pending', 'Task', '2024-07-03', '2024-09-06', 'TMZ101010', 0),
(21, 'Developing a Blockchain-based Supply Chain Management System', 'Create a decentralized supply chain management system using blockchain technology. Tasks include designing smart contracts for transparent and secure transaction recording, integrating IoT devices for real-time data tracking, and implementing a user-friendly interface for stakeholders. The goal is to enhance traceability, reduce fraud, and streamline logistics operations across the supply chain ecosystem.', 'Finished', 'Task', '2024-07-03', '2024-09-06', 'TMZ101002', 0);

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
