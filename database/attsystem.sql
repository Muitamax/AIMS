
-- Updated SQL Dump for attsystem
-- Improvements: Password hashing support, ENUM types, constraints, and added password columns

DROP DATABASE IF EXISTS attsystem;
CREATE DATABASE attsystem;
USE attsystem;

-- Admin Info Table
CREATE TABLE `admininfo` (
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `fname` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `type` ENUM('admin', 'student', 'teacher') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admininfo` (`username`, `password`, `email`, `fname`, `phone`, `type`) VALUES
('admin', 'admin', 'admin@gmail.com', 'admin', '2147483647', 'admin'),
('pravesh', 'pravesh', 'rawatpravesh0016@gmail.com', 'Pravesh Rawat', '992642003', 'student'),
('sumit', 'sumit', 'sumitbangar59@gmail.com', 'sumit bangar', '988766363', 'teacher');

-- Students Table
CREATE TABLE `students` (
  `st_id` VARCHAR(20) NOT NULL,
  `st_name` VARCHAR(50) NOT NULL,
  `st_dept` VARCHAR(50) NOT NULL,
  `st_batch` INT(4) NOT NULL,
  `st_sem` INT(11) NOT NULL,
  `st_email` VARCHAR(50) NOT NULL,
  `st_password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` (`st_id`, `st_name`, `st_dept`, `st_batch`, `st_sem`, `st_email`, `st_password`) VALUES
('1', 'Pravesh', 'CSE', 2020, 2, 'rawatpravesh0016@gmail.com', 'praveshpass'),
('2', 'Nitish Sihmar', 'CSE', 2020, 3, 'sihmar.nitish@gmail.com', 'nitishpass'),
('3', 'Shivam Singh', 'CSE', 2020, 3, 'shivam@gmail.com', 'shivampass'),
('4', 'Tushar Garg', 'CSE', 2020, 3, 'tushar@gmail.com', 'tusharpass');

-- Teachers Table
CREATE TABLE `teachers` (
  `tc_id` VARCHAR(20) NOT NULL,
  `tc_name` VARCHAR(50) NOT NULL,
  `tc_dept` VARCHAR(50) NOT NULL,
  `tc_email` VARCHAR(50) NOT NULL,
  `tc_course` VARCHAR(50) NOT NULL,
  `tc_password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `teachers` (`tc_id`, `tc_name`, `tc_dept`, `tc_email`, `tc_course`, `tc_password`) VALUES
('1', 'Sumit Bangar', 'CSE', 'sumit@gmail.com', 'SE', 'sumitpass');

-- Attendance Table
CREATE TABLE `attendance` (
  `stat_id` VARCHAR(20) NOT NULL,
  `course` VARCHAR(50) NOT NULL,
  `st_status` VARCHAR(10) NOT NULL,
  `stat_date` DATE NOT NULL,
  FOREIGN KEY (`stat_id`) REFERENCES `students`(`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `attendance` (`stat_id`, `course`, `st_status`, `stat_date`) VALUES
('1', 'algo', 'Present', '2018-11-14'),
('2', 'algo', 'Present', '2018-11-13'),
('1', 'algo', 'Absent', '2018-11-13');

-- Reports Table
CREATE TABLE `reports` (
  `st_id` VARCHAR(30) NOT NULL,
  `course` VARCHAR(50) NOT NULL,
  `st_status` VARCHAR(30) NOT NULL,
  `st_name` VARCHAR(50) NOT NULL,
  `st_dept` VARCHAR(50) NOT NULL,
  `st_batch` INT(11) NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
