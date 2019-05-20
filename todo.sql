-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 07:14 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `description`, `finished`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dmart', 'item1 , item2', 0, '2019-05-19 11:24:23', '2019-05-19 11:24:23'),
(2, 1, 'demo', 'demo12345', 0, '2019-05-19 13:13:18', '2019-05-19 13:13:18'),
(3, 1, 'new entry', 'new qw3h flkrjfn jfewhjkwf', 1, '2019-05-19 13:16:52', '2019-05-19 13:16:52'),
(4, 1, 'reminder', 'buy cake', 1, '2019-05-19 13:17:40', '2019-05-19 13:17:40'),
(5, 1, 'check UI', 'see', 0, '2019-05-19 13:20:40', '2019-05-19 13:20:40'),
(6, 1, 'check id', 'adding this data updated', 0, '2019-05-19 13:30:14', '2019-05-19 22:32:44'),
(7, 1, 'hi ', 'demo123345', 1, '2019-05-19 13:31:30', '2019-05-19 13:31:30'),
(8, 1, 'new ', 'this is fun', 1, '2019-05-19 13:33:22', '2019-05-19 13:33:22'),
(9, 1, 'checking  updated new', 'insertion success updated new', 0, '2019-05-19 13:37:51', '2019-05-19 22:30:54'),
(10, 7, 'new enrtry', 'this is to remind me about buying cake', 0, '2019-05-19 13:51:26', '2019-05-19 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `salt`, `password`) VALUES
(1, 'demo1', 'demo1@gmail.com', '56e00a04af', 'OGNmOGY3Yzg0Y2JmNDk4NTZhZDY3NTZhNTkwZjg3MGI4NzAzYWRjOQ=='),
(7, 'demouser', 'demouser@gmail.com', 'dcbad6aa95', 'ZmVkN2IwYzhlYjYxOTFkYzQ0ZmY1MzFmYzI2MzM4NWZiMWNjNjM3NA==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
