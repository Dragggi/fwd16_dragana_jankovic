-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2017 at 10:24 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `assignment2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure1` ()  begin
select * from query1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure2` ()  begin
select * from query2;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure3` (IN `illness` VARCHAR(255))  begin
select * from query3
where illness = diagnos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure4` (IN `patient_name` VARCHAR(255))  begin
select * from query4
where patient_name = patient;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure5` (IN `doctor_name` VARCHAR(255))  begin select * from query5 where doctor_name = doctor; end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure6` ()  begin  select * from query6 ; end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id_diag` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id_diag`, `Name`) VALUES
(1, 'Cancer'),
(2, 'Depressive disorder'),
(3, 'Anxiety'),
(4, 'Mental illness'),
(5, 'HIV'),
(6, 'Diarrie'),
(7, 'Heartattack'),
(8, 'Headache'),
(9, 'Stockholm syndrome'),
(10, 'Schizo'),
(11, 'Allergy'),
(12, 'Mental disorder'),
(13, 'Hyperactivty'),
(14, 'Nightmares'),
(15, 'Agression'),
(16, 'Rabies');

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `id_doc` int(11) NOT NULL DEFAULT '0',
  `First_Name` varchar(55) DEFAULT NULL,
  `Last_Name` varchar(55) DEFAULT NULL,
  `id_hosp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`id_doc`, `First_Name`, `Last_Name`, `id_hosp`) VALUES
(119, 'Hanibal', 'Lector', 65),
(128, 'Thomas', 'Lord', 65),
(143, 'Marc', 'Hopkins', 65);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id_hosp` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id_hosp`, `Name`) VALUES
(65, 'ASYLUM');

-- --------------------------------------------------------

--
-- Table structure for table `Medication`
--

CREATE TABLE `Medication` (
  `id_med` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(55) DEFAULT NULL,
  `Dose` varchar(55) DEFAULT NULL,
  `id_diag` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Medication`
--

INSERT INTO `Medication` (`id_med`, `Name`, `Dose`, `id_diag`) VALUES
(22, 'Alevedon', '22ml', 1),
(33, 'Panodil', ' 34ml', 2),
(44, 'Amfetamin', '50ml', 3),
(55, 'Cannabis', '60ml', 4),
(66, 'Helium', '66ml', 5),
(77, 'Valium', '64ml', 6),
(88, 'Latex', '69ml', 7),
(99, 'Opium', '89ml', 8),
(100, 'Palmolive', '9ml', 9),
(111, 'Alevedon', '42ml', 10),
(333, 'Panodil', '734ml', 11),
(444, 'Amfetamin', '450ml', 12),
(555, 'Cannabis', '660ml', 13),
(666, 'Helium', '666ml', 14),
(777, 'Valium', '654ml', 15),
(888, 'Latex', '698ml', 16);

-- --------------------------------------------------------

--
-- Table structure for table `Nurse`
--

CREATE TABLE `Nurse` (
  `id_nurse` int(11) NOT NULL DEFAULT '0',
  `First_Name` varchar(55) DEFAULT NULL,
  `Last_Name` varchar(55) DEFAULT NULL,
  `id_hosp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Nurse`
--

INSERT INTO `Nurse` (`id_nurse`, `First_Name`, `Last_Name`, `id_hosp`) VALUES
(21, 'Ben', 'Carson', 65),
(29, 'Kim', 'Carter', 65),
(32, 'Louise', 'West', 65),
(33, 'Ana', 'Davis', 65),
(37, 'Sandy', 'Scott', 65);

-- --------------------------------------------------------

--
-- Table structure for table `Nurse_Patient`
--

CREATE TABLE `Nurse_Patient` (
  `id_nurse` int(11) NOT NULL DEFAULT '0',
  `id_pat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Nurse_Patient`
--

INSERT INTO `Nurse_Patient` (`id_nurse`, `id_pat`) VALUES
(21, 55),
(21, 65),
(21, 83),
(29, 55),
(32, 98),
(32, 99),
(33, 51),
(33, 99),
(37, 83),
(37, 99);

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `id_pat` int(11) NOT NULL DEFAULT '0',
  `First_Name` varchar(55) DEFAULT NULL,
  `Last_Name` varchar(55) DEFAULT NULL,
  `id_doc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`id_pat`, `First_Name`, `Last_Name`, `id_doc`) VALUES
(51, 'David', 'Carl', 119),
(55, 'Dave', 'Scott', 119),
(65, 'Luke', 'Broke', 128),
(83, 'Mona', 'Lane', 143),
(98, 'Simon', 'Rick', 143),
(99, 'Peter', 'Norn', 143);

-- --------------------------------------------------------

--
-- Table structure for table `pat_diag`
--

CREATE TABLE `pat_diag` (
  `id_pat` int(11) NOT NULL DEFAULT '0',
  `id_diag` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pat_diag`
--

INSERT INTO `pat_diag` (`id_pat`, `id_diag`) VALUES
(51, 1),
(51, 2),
(51, 8),
(55, 3),
(55, 6),
(55, 11),
(55, 14),
(55, 15),
(65, 4),
(65, 12),
(65, 13),
(83, 5),
(83, 6),
(83, 10),
(98, 4),
(98, 11),
(99, 1),
(99, 9),
(99, 16);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query1`
-- (See below for the actual view)
--
CREATE TABLE `query1` (
`number of diag` bigint(21)
,`id_pat` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query2`
-- (See below for the actual view)
--
CREATE TABLE `query2` (
`total of patients` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query3`
-- (See below for the actual view)
--
CREATE TABLE `query3` (
`medication` varchar(55)
,`dose` varchar(55)
,`diagnos` varchar(55)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query4`
-- (See below for the actual view)
--
CREATE TABLE `query4` (
`id_pat` int(11)
,`patient` varchar(55)
,`Nurse` varchar(55)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query5`
-- (See below for the actual view)
--
CREATE TABLE `query5` (
`id_pat` int(11)
,`patient` varchar(55)
,`doctor` varchar(55)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `query6`
-- (See below for the actual view)
--
CREATE TABLE `query6` (
`total_patient` bigint(21)
,`name` varchar(55)
);

-- --------------------------------------------------------

--
-- Structure for view `query1`
--
DROP TABLE IF EXISTS `query1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query1`  AS  select count(0) AS `number of diag`,`pat_diag`.`id_pat` AS `id_pat` from `pat_diag` group by `pat_diag`.`id_pat` ;

-- --------------------------------------------------------

--
-- Structure for view `query2`
--
DROP TABLE IF EXISTS `query2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query2`  AS  select count(`patient`.`id_pat`) AS `total of patients` from `patient` ;

-- --------------------------------------------------------

--
-- Structure for view `query3`
--
DROP TABLE IF EXISTS `query3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query3`  AS  select `med`.`Name` AS `medication`,`med`.`Dose` AS `dose`,`diag`.`Name` AS `diagnos` from (`medication` `med` join `diagnosis` `diag` on((`med`.`id_diag` = `diag`.`id_diag`))) ;

-- --------------------------------------------------------

--
-- Structure for view `query4`
--
DROP TABLE IF EXISTS `query4`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query4`  AS  select `patient`.`id_pat` AS `id_pat`,`patient`.`First_Name` AS `patient`,`nurse`.`First_Name` AS `Nurse` from ((`nurse_patient` join `patient` on((`nurse_patient`.`id_pat` = `patient`.`id_pat`))) join `nurse` on((`nurse_patient`.`id_nurse` = `nurse`.`id_nurse`))) ;

-- --------------------------------------------------------

--
-- Structure for view `query5`
--
DROP TABLE IF EXISTS `query5`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query5`  AS  select `patient`.`id_pat` AS `id_pat`,`patient`.`First_Name` AS `patient`,`doctor`.`First_Name` AS `doctor` from (`patient` join `doctor` on((`patient`.`id_doc` = `doctor`.`id_doc`))) ;

-- --------------------------------------------------------

--
-- Structure for view `query6`
--
DROP TABLE IF EXISTS `query6`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `query6`  AS  select count(`patient`.`id_pat`) AS `total_patient`,`diagnosis`.`Name` AS `name` from ((`pat_diag` join `patient` on((`pat_diag`.`id_pat` = `patient`.`id_pat`))) join `diagnosis` on((`pat_diag`.`id_diag` = `diagnosis`.`id_diag`))) where (`diagnosis`.`Name` = 'Rabies') ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id_diag`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `id_hosp` (`id_hosp`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id_hosp`);

--
-- Indexes for table `Medication`
--
ALTER TABLE `Medication`
  ADD PRIMARY KEY (`id_med`),
  ADD KEY `id_diag` (`id_diag`);

--
-- Indexes for table `Nurse`
--
ALTER TABLE `Nurse`
  ADD PRIMARY KEY (`id_nurse`),
  ADD KEY `id_hosp` (`id_hosp`);

--
-- Indexes for table `Nurse_Patient`
--
ALTER TABLE `Nurse_Patient`
  ADD PRIMARY KEY (`id_nurse`,`id_pat`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id_pat`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Indexes for table `pat_diag`
--
ALTER TABLE `pat_diag`
  ADD PRIMARY KEY (`id_pat`,`id_diag`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id_hosp`) REFERENCES `hospital` (`id_hosp`);

--
-- Constraints for table `Medication`
--
ALTER TABLE `Medication`
  ADD CONSTRAINT `medication_ibfk_1` FOREIGN KEY (`id_diag`) REFERENCES `diagnosis` (`id_diag`);

--
-- Constraints for table `Nurse`
--
ALTER TABLE `Nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`id_hosp`) REFERENCES `hospital` (`id_hosp`);

--
-- Constraints for table `Patient`
--
ALTER TABLE `Patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `doctor` (`id_doc`);
