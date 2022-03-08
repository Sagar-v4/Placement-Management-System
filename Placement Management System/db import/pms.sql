-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2022 at 09:41 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17562213_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `pms_admin_info`
--

CREATE TABLE `pms_admin_info` (
  `admin_id` int(5) NOT NULL,
  `admin_first_name` varchar(20) DEFAULT NULL,
  `admin_middle_name` varchar(20) DEFAULT NULL,
  `admin_last_name` varchar(20) DEFAULT NULL,
  `admin_power` tinyint(1) DEFAULT 0,
  `admin_gender` varchar(10) DEFAULT NULL,
  `admin_email` varchar(60) DEFAULT NULL,
  `admin_password` varchar(100) DEFAULT NULL,
  `admin_dob` date DEFAULT NULL,
  `admin_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_admin_media`
--

CREATE TABLE `pms_admin_media` (
  `admin_media_id` int(5) NOT NULL,
  `admin_id` int(5) DEFAULT NULL,
  `admin_profile_pic` varchar(100) DEFAULT NULL,
  `admin_profile_pic_thumb` varchar(100) DEFAULT NULL,
  `admin_cover_pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_info`
--

CREATE TABLE `pms_company_info` (
  `company_id` int(5) NOT NULL,
  `company_name` varchar(40) DEFAULT NULL,
  `company_email` varchar(60) DEFAULT NULL,
  `company_password` varchar(100) DEFAULT NULL,
  `company_link` varchar(150) DEFAULT NULL,
  `company_description` varchar(1000) DEFAULT NULL,
  `company_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_media`
--

CREATE TABLE `pms_company_media` (
  `company_media_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_profile_pic` varchar(100) DEFAULT NULL,
  `company_profile_pic_thumb` varchar(100) DEFAULT NULL,
  `company_cover_pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_notification`
--

CREATE TABLE `pms_company_notification` (
  `company_notification_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_notification_class` varchar(40) DEFAULT NULL,
  `company_notification_detail` varchar(500) DEFAULT NULL,
  `company_notification_seen` tinyint(1) DEFAULT 0,
  `company_notification_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_requirements`
--

CREATE TABLE `pms_company_requirements` (
  `company_requirement_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_name` varchar(40) DEFAULT NULL,
  `company_requirement_name` varchar(40) DEFAULT NULL,
  `company_requirement_description` varchar(1000) DEFAULT NULL,
  `company_requirement_post` varchar(50) DEFAULT NULL,
  `company_requirement_vacancy` int(5) DEFAULT NULL,
  `company_requirement_pic` varchar(100) DEFAULT NULL,
  `company_requirement_min_percentage` decimal(5,2) DEFAULT NULL,
  `company_requirement_min_cgpa` decimal(4,2) DEFAULT NULL,
  `company_requirement_min_percentage_12th` decimal(5,2) DEFAULT NULL,
  `company_requirement_min_salary` int(10) DEFAULT NULL,
  `company_requirement_last_date` date DEFAULT NULL,
  `company_requirement_status` tinyint(1) NOT NULL DEFAULT 1,
  `company_requirement_exam_status` tinyint(1) NOT NULL DEFAULT 1,
  `company_requirement_exam_date` datetime DEFAULT NULL,
  `company_requirement_exam_date_end` datetime DEFAULT NULL,
  `company_requirement_exam_time` time DEFAULT NULL,
  `company_requirement_interview_status` tinyint(1) NOT NULL DEFAULT 1,
  `company_requirement_interview_date` datetime DEFAULT NULL,
  `company_requirement_interview_date_end` datetime DEFAULT NULL,
  `company_requirement_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_requirement_exam_create`
--

CREATE TABLE `pms_company_requirement_exam_create` (
  `exam_question_id` int(5) NOT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `company_id` int(5) DEFAULT NULL,
  `question_description` varchar(1000) DEFAULT NULL,
  `option_1` varchar(100) DEFAULT NULL,
  `option_2` varchar(100) DEFAULT NULL,
  `option_3` varchar(100) DEFAULT NULL,
  `option_4` varchar(100) DEFAULT NULL,
  `option_correct` varchar(100) DEFAULT NULL,
  `exam_question_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_company_requirement_exam_submitted`
--

CREATE TABLE `pms_company_requirement_exam_submitted` (
  `exam_question_submitted_id` int(5) NOT NULL,
  `exam_question_id` int(5) DEFAULT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `company_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `option_submitted` varchar(100) DEFAULT NULL,
  `option_correct` varchar(100) DEFAULT NULL,
  `student_presented_at` datetime DEFAULT NULL,
  `exam_question_submitted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_contact_us`
--

CREATE TABLE `pms_contact_us` (
  `contact_us_id` int(5) NOT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `contact_subject` varchar(100) DEFAULT NULL,
  `contact_message` varchar(1000) DEFAULT NULL,
  `contact_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_exam_pass`
--

CREATE TABLE `pms_exam_pass` (
  `exam_pass_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `total_correct_ans` int(5) DEFAULT NULL,
  `pms_interview_call` tinyint(1) DEFAULT 0,
  `exam_pass_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_forgot_password`
--

CREATE TABLE `pms_forgot_password` (
  `forgot_password_id` int(5) NOT NULL,
  `user_id` int(5) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `token` int(6) DEFAULT NULL,
  `token_status` tinyint(1) DEFAULT 1,
  `token_submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_interview_pass`
--

CREATE TABLE `pms_interview_pass` (
  `interview_pass_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `interview_time` datetime DEFAULT NULL,
  `interview_link` varchar(200) DEFAULT NULL,
  `candidates_marks` int(5) DEFAULT NULL,
  `candidates_extra_detail` varchar(1000) DEFAULT NULL,
  `placement_pass` tinyint(1) DEFAULT 0,
  `interview_pass_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_placed`
--

CREATE TABLE `pms_placed` (
  `placed_id` int(5) NOT NULL,
  `interview_pass_id` int(5) DEFAULT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `placed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_student_applied_req`
--

CREATE TABLE `pms_student_applied_req` (
  `student_applied_req_id` int(5) NOT NULL,
  `company_id` int(5) DEFAULT NULL,
  `company_requirement_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `student_percentage` decimal(4,2) DEFAULT NULL,
  `student_cgpa` decimal(3,2) DEFAULT NULL,
  `student_percentage_12` decimal(4,2) DEFAULT NULL,
  `student_applied_req_status` tinyint(1) DEFAULT 1,
  `company_requirement_exam_status` tinyint(1) DEFAULT 1,
  `company_requirement_interview_status` tinyint(1) DEFAULT 1,
  `student_applied_req_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_student_info`
--

CREATE TABLE `pms_student_info` (
  `student_id` int(5) NOT NULL,
  `student_first_name` varchar(20) DEFAULT NULL,
  `student_middle_name` varchar(20) DEFAULT NULL,
  `student_last_name` varchar(20) DEFAULT NULL,
  `student_gender` varchar(10) DEFAULT NULL,
  `student_dob` date DEFAULT NULL,
  `student_address` varchar(100) DEFAULT NULL,
  `student_locality` varchar(20) DEFAULT NULL,
  `student_city` varchar(20) DEFAULT NULL,
  `student_district` varchar(20) DEFAULT NULL,
  `student_pincode` int(6) DEFAULT NULL,
  `student_state` varchar(20) DEFAULT NULL,
  `student_country` varchar(20) DEFAULT NULL,
  `student_phone_number` bigint(10) DEFAULT NULL,
  `student_std_code` int(3) DEFAULT NULL,
  `student_telephone_number` int(8) DEFAULT NULL,
  `student_email` varchar(60) DEFAULT NULL,
  `student_password` varchar(100) DEFAULT NULL,
  `student_percentage_10th` decimal(4,2) DEFAULT NULL,
  `student_percentage_12th` decimal(4,2) DEFAULT NULL,
  `student_high_degree` varchar(20) DEFAULT NULL,
  `student_high_discipline` varchar(20) DEFAULT NULL,
  `student_high_university` varchar(50) DEFAULT NULL,
  `student_high_city` varchar(20) DEFAULT NULL,
  `student_high_state` varchar(20) DEFAULT NULL,
  `student_high_passing` date DEFAULT NULL,
  `student_high_percentage` decimal(4,2) DEFAULT NULL,
  `student_high_cgpa` decimal(3,2) DEFAULT NULL,
  `student_ad1_degree` varchar(20) DEFAULT NULL,
  `student_ad1_discipline` varchar(20) DEFAULT NULL,
  `student_ad1_university` varchar(50) DEFAULT NULL,
  `student_ad1_passing` year(4) DEFAULT NULL,
  `student_ad1_percentage` decimal(4,2) DEFAULT NULL,
  `student_ad1_cgpa` decimal(3,2) DEFAULT NULL,
  `student_ad2_degree` varchar(20) DEFAULT NULL,
  `student_ad2_discipline` varchar(20) DEFAULT NULL,
  `student_ad2_university` varchar(50) DEFAULT NULL,
  `student_ad2_passing` year(4) DEFAULT NULL,
  `student_ad2_percentage` decimal(4,2) DEFAULT NULL,
  `student_ad2_cgpa` decimal(3,2) DEFAULT NULL,
  `student_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_student_media`
--

CREATE TABLE `pms_student_media` (
  `student_media_id` int(5) NOT NULL,
  `student_id` int(5) DEFAULT NULL,
  `student_profile_pic` varchar(150) DEFAULT NULL,
  `student_profile_pic_thumb` varchar(150) DEFAULT NULL,
  `student_cover_pic` varchar(150) DEFAULT NULL,
  `student_10th_marksheet` varchar(100) DEFAULT NULL,
  `student_12th_marksheet` varchar(100) DEFAULT NULL,
  `student_high_marksheet` varchar(100) DEFAULT NULL,
  `student_ad1_marksheet` varchar(100) DEFAULT NULL,
  `student_ad2_marksheet` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_student_notification`
--

CREATE TABLE `pms_student_notification` (
  `student_notification_id` int(5) NOT NULL,
  `student_id` int(5) DEFAULT NULL,
  `student_notification_class` varchar(40) DEFAULT NULL,
  `student_notification_detail` varchar(500) DEFAULT NULL,
  `student_notification_seen` tinyint(1) DEFAULT 0,
  `student_notification_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pms_users`
--

CREATE TABLE `pms_users` (
  `user_id` int(5) NOT NULL,
  `admin_id` int(5) DEFAULT NULL,
  `company_id` int(5) DEFAULT NULL,
  `student_id` int(5) DEFAULT NULL,
  `user_email` varchar(60) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1,
  `user_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pms_admin_info`
--
ALTER TABLE `pms_admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `pms_admin_media`
--
ALTER TABLE `pms_admin_media`
  ADD PRIMARY KEY (`admin_media_id`),
  ADD KEY `fk_admin_id` (`admin_id`);

--
-- Indexes for table `pms_company_info`
--
ALTER TABLE `pms_company_info`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_email` (`company_email`);

--
-- Indexes for table `pms_company_media`
--
ALTER TABLE `pms_company_media`
  ADD PRIMARY KEY (`company_media_id`),
  ADD KEY `fk_company_id` (`company_id`);

--
-- Indexes for table `pms_company_notification`
--
ALTER TABLE `pms_company_notification`
  ADD PRIMARY KEY (`company_notification_id`),
  ADD KEY `fk_company_com_noti_id` (`company_id`);

--
-- Indexes for table `pms_company_requirements`
--
ALTER TABLE `pms_company_requirements`
  ADD PRIMARY KEY (`company_requirement_id`),
  ADD KEY `fk_company_req_id` (`company_id`);

--
-- Indexes for table `pms_company_requirement_exam_create`
--
ALTER TABLE `pms_company_requirement_exam_create`
  ADD PRIMARY KEY (`exam_question_id`),
  ADD KEY `fk_company_exam_create_id` (`company_id`),
  ADD KEY `fk_company_req_exam_create_id` (`company_requirement_id`);

--
-- Indexes for table `pms_company_requirement_exam_submitted`
--
ALTER TABLE `pms_company_requirement_exam_submitted`
  ADD PRIMARY KEY (`exam_question_submitted_id`),
  ADD KEY `fk_company_exam_submitted_id` (`company_id`),
  ADD KEY `fk_student_exam_submitted_id` (`student_id`),
  ADD KEY `fk_company_req_exam_submitted_id` (`company_requirement_id`),
  ADD KEY `fk_exam_que_exam_submitted_id` (`exam_question_id`);

--
-- Indexes for table `pms_contact_us`
--
ALTER TABLE `pms_contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `pms_exam_pass`
--
ALTER TABLE `pms_exam_pass`
  ADD PRIMARY KEY (`exam_pass_id`),
  ADD KEY `fk_company_exam_pass_id` (`company_id`),
  ADD KEY `fk_student_exam_pass_id` (`student_id`),
  ADD KEY `fk_company_req_exam_pass_id` (`company_requirement_id`);

--
-- Indexes for table `pms_forgot_password`
--
ALTER TABLE `pms_forgot_password`
  ADD PRIMARY KEY (`forgot_password_id`),
  ADD KEY `fk_user_id_forgot` (`user_id`);

--
-- Indexes for table `pms_interview_pass`
--
ALTER TABLE `pms_interview_pass`
  ADD PRIMARY KEY (`interview_pass_id`),
  ADD KEY `fk_company_interview_pass_id` (`company_id`),
  ADD KEY `fk_student_interview_pass_id` (`student_id`),
  ADD KEY `fk_company_req_interview_pass_id` (`company_requirement_id`);

--
-- Indexes for table `pms_placed`
--
ALTER TABLE `pms_placed`
  ADD PRIMARY KEY (`placed_id`),
  ADD KEY `fk_company_placed_id` (`company_id`),
  ADD KEY `fk_student_placed_id` (`student_id`),
  ADD KEY `fk_interview_pass_placed_id` (`interview_pass_id`),
  ADD KEY `fk_company_req_placed_id` (`company_requirement_id`);

--
-- Indexes for table `pms_student_applied_req`
--
ALTER TABLE `pms_student_applied_req`
  ADD PRIMARY KEY (`student_applied_req_id`),
  ADD KEY `fk_student_applied_id` (`student_id`),
  ADD KEY `fk_company_req_applied_id` (`company_requirement_id`),
  ADD KEY `fk_company_applied_id` (`company_id`);

--
-- Indexes for table `pms_student_info`
--
ALTER TABLE `pms_student_info`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- Indexes for table `pms_student_media`
--
ALTER TABLE `pms_student_media`
  ADD PRIMARY KEY (`student_media_id`),
  ADD KEY `fk_student_id` (`student_id`);

--
-- Indexes for table `pms_student_notification`
--
ALTER TABLE `pms_student_notification`
  ADD PRIMARY KEY (`student_notification_id`),
  ADD KEY `fk_student_stu_noti_id` (`student_id`);

--
-- Indexes for table `pms_users`
--
ALTER TABLE `pms_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `fk_adminid` (`admin_id`),
  ADD KEY `fk_companyid` (`company_id`),
  ADD KEY `fk_studentid` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pms_admin_info`
--
ALTER TABLE `pms_admin_info`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_admin_media`
--
ALTER TABLE `pms_admin_media`
  MODIFY `admin_media_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_info`
--
ALTER TABLE `pms_company_info`
  MODIFY `company_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_media`
--
ALTER TABLE `pms_company_media`
  MODIFY `company_media_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_notification`
--
ALTER TABLE `pms_company_notification`
  MODIFY `company_notification_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_requirements`
--
ALTER TABLE `pms_company_requirements`
  MODIFY `company_requirement_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_requirement_exam_create`
--
ALTER TABLE `pms_company_requirement_exam_create`
  MODIFY `exam_question_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_company_requirement_exam_submitted`
--
ALTER TABLE `pms_company_requirement_exam_submitted`
  MODIFY `exam_question_submitted_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_contact_us`
--
ALTER TABLE `pms_contact_us`
  MODIFY `contact_us_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_exam_pass`
--
ALTER TABLE `pms_exam_pass`
  MODIFY `exam_pass_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_forgot_password`
--
ALTER TABLE `pms_forgot_password`
  MODIFY `forgot_password_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_interview_pass`
--
ALTER TABLE `pms_interview_pass`
  MODIFY `interview_pass_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_placed`
--
ALTER TABLE `pms_placed`
  MODIFY `placed_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_student_applied_req`
--
ALTER TABLE `pms_student_applied_req`
  MODIFY `student_applied_req_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_student_info`
--
ALTER TABLE `pms_student_info`
  MODIFY `student_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_student_media`
--
ALTER TABLE `pms_student_media`
  MODIFY `student_media_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_student_notification`
--
ALTER TABLE `pms_student_notification`
  MODIFY `student_notification_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pms_users`
--
ALTER TABLE `pms_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pms_admin_media`
--
ALTER TABLE `pms_admin_media`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `pms_admin_info` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_company_media`
--
ALTER TABLE `pms_company_media`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_company_notification`
--
ALTER TABLE `pms_company_notification`
  ADD CONSTRAINT `fk_company_com_noti_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_company_requirements`
--
ALTER TABLE `pms_company_requirements`
  ADD CONSTRAINT `fk_company_req_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_company_requirement_exam_create`
--
ALTER TABLE `pms_company_requirement_exam_create`
  ADD CONSTRAINT `fk_company_exam_create_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_exam_create_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_company_requirement_exam_submitted`
--
ALTER TABLE `pms_company_requirement_exam_submitted`
  ADD CONSTRAINT `fk_company_exam_submitted_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_exam_submitted_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exam_que_exam_submitted_id` FOREIGN KEY (`exam_question_id`) REFERENCES `pms_company_requirement_exam_create` (`exam_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_exam_submitted_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_exam_pass`
--
ALTER TABLE `pms_exam_pass`
  ADD CONSTRAINT `fk_company_exam_pass_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_exam_pass_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_exam_pass_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_forgot_password`
--
ALTER TABLE `pms_forgot_password`
  ADD CONSTRAINT `fk_user_id_forgot` FOREIGN KEY (`user_id`) REFERENCES `pms_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pms_interview_pass`
--
ALTER TABLE `pms_interview_pass`
  ADD CONSTRAINT `fk_company_interview_pass_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_interview_pass_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_interview_pass_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_placed`
--
ALTER TABLE `pms_placed`
  ADD CONSTRAINT `fk_company_placed_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_placed_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_interview_pass_placed_id` FOREIGN KEY (`interview_pass_id`) REFERENCES `pms_interview_pass` (`interview_pass_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_placed_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_student_applied_req`
--
ALTER TABLE `pms_student_applied_req`
  ADD CONSTRAINT `fk_company_applied_id` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_req_applied_id` FOREIGN KEY (`company_requirement_id`) REFERENCES `pms_company_requirements` (`company_requirement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_applied_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_student_media`
--
ALTER TABLE `pms_student_media`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_student_notification`
--
ALTER TABLE `pms_student_notification`
  ADD CONSTRAINT `fk_student_stu_noti_id` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pms_users`
--
ALTER TABLE `pms_users`
  ADD CONSTRAINT `fk_adminid` FOREIGN KEY (`admin_id`) REFERENCES `pms_admin_info` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_companyid` FOREIGN KEY (`company_id`) REFERENCES `pms_company_info` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_studentid` FOREIGN KEY (`student_id`) REFERENCES `pms_student_info` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
