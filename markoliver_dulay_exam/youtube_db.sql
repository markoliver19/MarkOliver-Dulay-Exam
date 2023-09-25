-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2023 at 12:35 PM
-- Server version: 5.7.34
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youtube_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channels`
--

CREATE TABLE `youtube_channels` (
  `id` int(11) NOT NULL,
  `channel_id` varchar(250) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_channel_videos`
--

CREATE TABLE `youtube_channel_videos` (
  `id` int(11) NOT NULL,
  `channel_id` varchar(255) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `youtube_channels`
--
ALTER TABLE `youtube_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `youtube_channel_videos`
--
ALTER TABLE `youtube_channel_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
