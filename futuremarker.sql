-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2020 at 07:23 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futuremarker`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `Assignment_ID` int(11) NOT NULL,
  `Course_ID` int(11) DEFAULT NULL,
  `Assignment_Title` varchar(100) DEFAULT NULL,
  `Assignment_desc_dir` varchar(250) DEFAULT NULL,
  `Assignment_grade` int(11) DEFAULT NULL,
  `Assignment_date` datetime DEFAULT NULL,
  `Assignment_deadline` datetime DEFAULT NULL,
  `Assignment_model_ans` varchar(250) DEFAULT NULL,
  `Attachments_dir` varchar(250) DEFAULT NULL,
  `inputs_dir` varchar(250) DEFAULT NULL,
  `outputs_dir` varchar(250) DEFAULT NULL,
  `Dynamic_testing_files` varchar(250) DEFAULT NULL,
  `Feature_testing_file` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Course_ID` int(11) NOT NULL,
  `Course_access_code` varchar(100) DEFAULT NULL,
  `Course_name` varchar(100) DEFAULT NULL,
  `Course_desc` text DEFAULT NULL,
  `Course_image` varchar(250) DEFAULT NULL,
  `Course_material_dir` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doing_assignment`
--

CREATE TABLE `doing_assignment` (
  `Doing_ID` int(11) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Assignment_ID` int(11) DEFAULT NULL,
  `Assignment_grade` int(11) DEFAULT NULL,
  `Assignment_feedback` text DEFAULT NULL,
  `Assignment_alert` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `Enrollment_ID` int(11) NOT NULL,
  `Course_ID` int(11) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `Instructor_ID` int(11) NOT NULL,
  `Instructor_firstname` varchar(20) DEFAULT NULL,
  `Instructor_lastname` varchar(20) DEFAULT NULL,
  `Instructor_Email` varchar(100) DEFAULT NULL,
  `Instructor_password` varchar(50) DEFAULT NULL,
  `Instructor_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `Message_ID` int(11) NOT NULL,
  `From_student` int(11) DEFAULT NULL,
  `From_instructor` int(11) DEFAULT NULL,
  `To_student` int(11) DEFAULT NULL,
  `To_instructor` int(11) DEFAULT NULL,
  `Message_sent_time` datetime DEFAULT NULL,
  `Message_read_time` datetime DEFAULT NULL,
  `Message_content` text DEFAULT NULL,
  `Attachments_dir` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `Notification_ID` int(11) NOT NULL,
  `To_instructor_ID` int(11) DEFAULT NULL,
  `To_student_ID` int(11) DEFAULT NULL,
  `Notification_time` datetime DEFAULT NULL,
  `Notification_content` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Student_firstname` varchar(20) DEFAULT NULL,
  `Student_lastname` varchar(20) DEFAULT NULL,
  `Student_Email` varchar(100) DEFAULT NULL,
  `Student_password` varchar(50) DEFAULT NULL,
  `Student_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `Teaches_ID` int(11) NOT NULL,
  `Instructor_ID` int(11) DEFAULT NULL,
  `Course_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`Assignment_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_ID`);

--
-- Indexes for table `doing_assignment`
--
ALTER TABLE `doing_assignment`
  ADD PRIMARY KEY (`Doing_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Assignment_ID` (`Assignment_ID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`Enrollment_ID`),
  ADD KEY `Course_ID` (`Course_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`Instructor_ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Message_ID`),
  ADD KEY `From_student` (`From_student`),
  ADD KEY `To_student` (`To_student`),
  ADD KEY `From_instructor` (`From_instructor`),
  ADD KEY `To_instructor` (`To_instructor`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Notification_ID`),
  ADD KEY `To_instructor_ID` (`To_instructor_ID`),
  ADD KEY `To_student_ID` (`To_student_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`Teaches_ID`),
  ADD KEY `Instructor_ID` (`Instructor_ID`),
  ADD KEY `Course_ID` (`Course_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`);

--
-- Constraints for table `doing_assignment`
--
ALTER TABLE `doing_assignment`
  ADD CONSTRAINT `doing_assignment_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `doing_assignment_ibfk_2` FOREIGN KEY (`Assignment_ID`) REFERENCES `assignment` (`Assignment_ID`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`From_student`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`To_student`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`From_instructor`) REFERENCES `instructor` (`Instructor_ID`),
  ADD CONSTRAINT `message_ibfk_4` FOREIGN KEY (`To_instructor`) REFERENCES `instructor` (`Instructor_ID`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`To_instructor_ID`) REFERENCES `instructor` (`Instructor_ID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`To_student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`Instructor_ID`) REFERENCES `instructor` (`Instructor_ID`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
