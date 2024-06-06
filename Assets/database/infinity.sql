-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220429.4ad66f464f
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 03:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinity`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `stype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `password`, `stype`) VALUES
(169, 'anita', '11', 'sp'),
(162, 'drake', '11', 'user'),
(163, 'eminem', '11', 'user'),
(174, 'gita', '11', 'sp'),
(164, 'jennifer', '11', 'user'),
(160, 'john', '11', 'user'),
(159, 'kushal', '11', 'admin'),
(166, 'mohammed', '11', 'sp'),
(173, 'rajesh', '11', 'sp'),
(165, 'ram', '11', 'sp'),
(175, 'ramesh', '11', 'sp'),
(171, 'sanjay', '11', 'sp'),
(170, 'santosh', '11', 'sp'),
(168, 'sri', '11', 'sp'),
(172, 'sunil', '11', 'sp'),
(167, 'sunita', '11', 'sp'),
(161, 'travis', '11', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serv_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `serv` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `serv_status` varchar(50) NOT NULL,
  `ratings` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `rtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serv_id`, `usr_id`, `sp_id`, `sname`, `serv`, `uname`, `location`, `serv_status`, `ratings`, `rdate`, `rtime`) VALUES
(130, 162, 169, 'Anita Garcia', 'Fitness trainer', 'Drake Laghari', 'Hyderabad', 'Paid', 4, '2022-05-06', '18:58:00'),
(131, 162, 166, 'Mohammed Johnson', 'Mechanic', 'Drake Laghari', 'Hyderabad', 'UnPaid', 1, '2022-05-10', '10:20:00'),
(132, 163, 173, 'Rajesh Lopez', 'Carpenter', 'Eminem Agarwal', 'Meerut', 'Paid', 3, '2022-05-08', '18:31:00'),
(133, 164, 167, 'Sunita Williams', 'Electrician', 'Jennifer Reddy', 'Bangalore', 'Rejected', 0, '2022-05-27', '09:27:00'),
(134, 160, 171, 'Sanjay Davis', 'Pet sitting', 'John balakrishnan', 'Shrirampur', 'UnPaid', 3, '2022-05-28', '21:37:00'),
(135, 162, 174, 'Gita Wilson', 'Plumber', 'Drake Laghari', 'Hyderabad', 'Paid', 3, '2022-05-19', '18:39:00'),
(136, 162, 171, 'Sanjay Davis', 'Pet sitting', 'Drake Laghari', 'Hyderabad', 'Finished', 0, '2022-05-18', '14:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `sproviders`
--

CREATE TABLE `sproviders` (
  `id` int(10) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `smail` varchar(50) NOT NULL,
  `smob` bigint(20) NOT NULL,
  `serv` varchar(50) NOT NULL,
  `slocation` varchar(25) DEFAULT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `scharges` int(70) NOT NULL,
  `sdesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sproviders`
--

INSERT INTO `sproviders` (`id`, `sname`, `smail`, `smob`, `serv`, `slocation`, `stime`, `etime`, `scharges`, `sdesc`) VALUES
(169, 'Anita Garcia', 'anitagarcia76@gmail.com', 5452102369, 'Fitness trainer', 'Meerut', '05:00:00', '12:00:00', 300, 'As a personal trainer, lead individualized workouts incorporating aerobic and anaerobic exercises. Work with clients to evaluate fitness levels, set goals, monitor progress and blast through plateaus. As a group fitness instructor, lead fun, energetic classes for diverse age groups and fitness levels.'),
(174, 'Gita Wilson', 'gitawilson73@gmail.com', 5210000089, 'Plumber', 'Varanasi', '10:20:00', '22:20:00', 200, 'Install, repair, and maintain pipes, valves, fittings, drainage systems, and fixtures in commercial and residential structures.'),
(166, 'Mohammed Johnson', 'mohammedjohnson99@gmail.com', 8865212013, 'Mechanic', 'Delhi', '10:00:00', '22:00:00', 150, 'Highly skilled and dependable with hands-on experience and excellent training to perform service, diagnostics, and repairs on domestic and imported automobiles and trucks.'),
(173, 'Rajesh Lopez', 'rajeshlopez990@gmail.com', 5652011123, 'Carpenter', 'Pune', '09:05:00', '22:25:00', 200, 'Automotive Painters perform repairs to vehicles which have usually been damaged in a collision. Usual work activities listed on an Automotive Painter resume sample are removing rust, filling cavities, masking details, picking the right colors, using paint sprayers, and checking quality when the job is finished.'),
(175, 'Ramesh Anderson', 'Rameshanderson89@gmail.com', 5566889950, 'Photographer', 'Agra', '20:15:00', '18:27:00', 883, 'discussing requirements with clients, performing research for each shoot, using technical equipment, networking with other professionals, arranging photo shoot backgrounds, processing images, and self-marketing.'),
(165, 'Ram Smith', 'Ramsmith88@gmail.com', 7788996520, 'Advocate', 'Shrirampur', '09:00:00', '20:00:00', 889, 'Hands-on experience in maintaining knowledge of the available resources. Immense knowledge of legal and criminal systems. Excellent knowledge of battling various women issues. Ability to maintain policies for all development issues.'),
(171, 'Sanjay Davis', 'sanjaydavis46@gmail.com', 3322665540, 'Pet sitting', 'Chennai', '10:15:00', '18:15:00', 175, 'Responsible of checking on clients pets and assuring that their necessities were being met.'),
(170, 'Santosh Miller', 'santoshmiller90@gmail.com', 7789554630, 'Makeup artist', 'Mumbai', '09:00:00', '22:00:00', 400, 'Highly dedicated and skilled Makeup Artist with an exceptional record of customer service and client satisfaction. Adept at perceiving individual clients’ unique skin tone and corresponding makeup needs and recommending products accordingly. Abel to work well independently or as part of a cosmetology professional team.'),
(168, 'Sri Jones', 'srijones67@gmail.com', 9632545698, 'Doctor', 'Hyderabad', '08:00:00', '22:00:00', 899, 'Responsible physician with 9 years of experience maximizing patient wellness and facility profitability. Seeking to deliver healthcare excellence at Mercy Hospital. At CRMC, maintained 5-star healthgrades score for 112 reviews and 85% patient success.'),
(172, 'Sunil Rodriguez', 'sunilrodriguez89@gmail.com', 5212021350, 'Ac Repairing', 'Kolkata', '10:00:00', '20:20:00', 450, 'In-depth Knowledge and experience to install, maintain and repair AC. Great knowledge of the laws, regulations and safety procedures related to AC equipment. Operational knowledge of electrical circuits and schematics'),
(167, 'Sunita Williams', 'sunitawilliams100@gmail.com', 5265878950, 'Electrician', 'Madras', '08:00:00', '18:00:00', 200, 'Skilled journeyman electrician with 7+ years of experience installing, repairing, and maintaining low-voltage electrical systems. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `umail` varchar(50) NOT NULL,
  `umob` bigint(20) NOT NULL,
  `location` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `umail`, `umob`, `location`) VALUES
(162, 'Drake Laghari', 'drakelaghari66@gmail.com', 7788994455, 'Hyderabad'),
(163, 'Eminem Agarwal', 'eminemagarwal@gmail.com', 8978456582, 'Meerut'),
(164, 'Jennifer Reddy', 'jenniferreddy33@gmail.com', 5566448877, 'Bangalore'),
(160, 'John balakrishnan', 'johnbalakrishnan1@gmail.com', 7894561237, 'Shrirampur'),
(161, 'Travis Iyer', 'travisIyer69@gmail.com', 4567891230, 'Delhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serv_id`);

--
-- Indexes for table `sproviders`
--
ALTER TABLE `sproviders`
  ADD UNIQUE KEY `smail` (`smail`),
  ADD UNIQUE KEY `sname` (`sname`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_service` (`serv`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `uname` (`uname`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sproviders`
--
ALTER TABLE `sproviders`
  ADD CONSTRAINT `sproviders_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



