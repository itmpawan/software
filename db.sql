-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 16, 2021 at 04:34 PM
-- Server version: 5.7.30
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `software`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `organization`, `mobile`, `email`, `password`, `created`) VALUES
(1, 'SR ENTERPRISES', '8219057071', 'srenterpriseskullu@rediffmail.com', '$2y$10$UvQWbkbkLFOsufThaDXQhOftVe6GvtNj61ii2OM8zLk5FePog7YGO', '2021-01-04 12:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `caddress` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `sys_cap` varchar(255) NOT NULL,
  `sys_no` varchar(255) NOT NULL,
  `booking_date` varchar(255) NOT NULL,
  `bill_number` varchar(255) NOT NULL,
  `ins_date` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `cname`, `caddress`, `contact_number`, `sys_cap`, `sys_no`, `booking_date`, `bill_number`, `ins_date`, `remarks`, `balance`, `created_at`, `status`) VALUES
(1, 'Pawan kumar', 'Test', '98145674444', '176047', '2', '01/12/2021', '34', '01/21/2021', 'testing', '500', '2021-01-15 10:14:38', 'InActive'),
(2, 'Arsh', 'test address', '09816707555', '176047', '455', '01/22/2021', '348', '01/11/2021', 'gghh', '59.5', '2021-01-15 10:47:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer_meta`
--

CREATE TABLE `customer_meta` (
  `id` int(11) NOT NULL,
  `customer_id` int(111) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_nature` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_meta`
--

INSERT INTO `customer_meta` (`id`, `customer_id`, `field_name`, `field_nature`, `field_type`, `value`) VALUES
(1, 2, 'ADV.', 'Debit', 'receive', '60.50'),
(2, 2, 'PAY 1', 'Debit', 'receive', '50.00'),
(3, 2, 'PAY 2', 'Debit', 'receive', '30.00'),
(7, 2, 'SYS. COST', 'Credit', 'amount', '200.00'),
(8, 2, 'PPR', 'Credit', 'amount', '10.00'),
(9, 2, 'SUBSIDY', 'Debit', 'amount', '10.00'),
(10, 1, 'SYS. COST', 'Credit', 'amount', '500.00'),
(11, 1, 'PPR', 'Credit', 'amount', '0.00'),
(12, 1, 'SUBSIDY', 'Debit', 'amount', '0.00'),
(13, 1, 'ADV.', 'Debit', 'receive', '0.00'),
(14, 1, 'PAY 1', 'Debit', 'receive', '0.00'),
(15, 1, 'PAY 2', 'Debit', 'receive', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `nature` varchar(255) NOT NULL,
  `ftype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `fname`, `nature`, `ftype`) VALUES
(1, 'SYS. COST', 'Credit', 'amount'),
(2, 'ADV.', 'Debit', 'receive'),
(3, 'PPR', 'Credit', 'amount'),
(4, 'SUBSIDY', 'Debit', 'amount'),
(5, 'PAY 1', 'Debit', 'receive'),
(7, 'PAY 2', 'Debit', 'receive');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `sys_cap` varchar(255) NOT NULL,
  `sys_no` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `ins_date` varchar(255) NOT NULL,
  `dealer` varchar(255) NOT NULL,
  `to_whom` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `sys_cap`, `sys_no`, `model`, `ins_date`, `dealer`, `to_whom`, `place`, `remarks`, `created_at`, `status`) VALUES
(1, '1', '2', '3', '01/19/2021', 'Pawan', 'test', 'Nagrota', 'test', '2021-01-11 9:46:54', 'InActive'),
(3, '11', '12', '13', '01/21/2021', 'John', 'test', 'kangra', 'test', '2021-01-11 10:46:54', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_meta`
--
ALTER TABLE `customer_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_meta`
--
ALTER TABLE `customer_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
