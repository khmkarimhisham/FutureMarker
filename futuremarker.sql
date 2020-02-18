-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2020 at 09:16 PM
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
  `Assignment_title` varchar(100) DEFAULT NULL,
  `Assignment_desc_dir` varchar(250) DEFAULT NULL,
  `Full_grade` int(11) DEFAULT NULL,
  `Compilation_grade` int(11) DEFAULT NULL,
  `Style_grade` int(11) DEFAULT NULL,
  `Dynamic_test_grade` int(11) DEFAULT NULL,
  `Feature_test_grade` int(11) DEFAULT NULL,
  `Assignment_date` datetime DEFAULT current_timestamp(),
  `Assignment_deadline` datetime DEFAULT NULL,
  `Assignment_model_ans` varchar(250) DEFAULT NULL,
  `Attachments_dir` varchar(250) DEFAULT NULL
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
  `Compilation_grade` int(11) DEFAULT NULL,
  `Style_grade` int(11) DEFAULT NULL,
  `Dynamic_test_grade` int(11) DEFAULT NULL,
  `Feature_test_grade` int(11) DEFAULT NULL,
  `Assignment_feedback` text DEFAULT NULL,
  `Assignment_alert` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_test`
--

CREATE TABLE `dynamic_test` (
  `Test_ID` int(11) NOT NULL,
  `Assignment_ID` int(11) DEFAULT NULL,
  `Input` text DEFAULT NULL,
  `output` text DEFAULT NULL,
  `Test_Attachments` varchar(250) DEFAULT NULL,
  `Hidden` tinyint(1) DEFAULT NULL
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
-- Table structure for table `feature_test`
--

CREATE TABLE `feature_test` (
  `Test_ID` int(11) NOT NULL,
  `Test_name` varchar(100) DEFAULT NULL,
  `regex` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `Instructor_ID` int(11) NOT NULL,
  `Instructor_firstname` varchar(20) DEFAULT NULL,
  `Instructor_lastname` varchar(20) DEFAULT NULL,
  `Instructor_email` varchar(100) DEFAULT NULL,
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
-- Indexes for table `dynamic_test`
--
ALTER TABLE `dynamic_test`
  ADD PRIMARY KEY (`Test_ID`),
  ADD KEY `Assignment_ID` (`Assignment_ID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`Enrollment_ID`),
  ADD KEY `Course_ID` (`Course_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `feature_test`
--
ALTER TABLE `feature_test`
  ADD PRIMARY KEY (`Test_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `Enrollment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `Instructor_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `Message_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `Notification_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teaches`
--
ALTER TABLE `teaches`
  MODIFY `Teaches_ID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `dynamic_test`
--
ALTER TABLE `dynamic_test`
  ADD CONSTRAINT `dynamic_test_ibfk_1` FOREIGN KEY (`Assignment_ID`) REFERENCES `assignment` (`Assignment_ID`);

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
