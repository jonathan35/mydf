-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 04:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borneorealestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner`, `position`, `status`, `created`, `modified`) VALUES
(1, 'photo/5fa0aeb5abec8.jpg', 0, '1', '2020-10-27 13:22:45', '2020-11-03 09:13:25'),
(2, 'photo/5fa0aebf767fc.jpg', 2, '1', '2020-10-27 13:28:12', '2020-11-03 09:13:35'),
(3, 'photo/5fa0aec68c735.jpg', 3, '1', '2020-10-27 13:28:16', '2020-11-03 09:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `banner_dashboard`
--

CREATE TABLE `banner_dashboard` (
  `id` int(11) NOT NULL,
  `banner_dashboard` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `position`, `status`, `created`, `modified`) VALUES
(1, '1 & a half Storey Townhouse', 1, '1', '2020-10-27 13:35:32', '2020-10-27 13:35:42'),
(2, 'Apartments', 2, '1', '2020-10-27 13:42:57', '2020-10-27 13:42:57'),
(3, 'Double Storey Semi Detached', 3, '1', '2020-10-27 13:43:04', '2020-10-27 14:40:58'),
(4, 'Double storey Terrace', 4, '1', '2020-10-27 14:40:38', '2020-10-27 20:00:23'),
(5, 'Single Storey Semi Detached', 5, '1', '2020-10-27 14:41:42', '2020-10-27 20:00:27'),
(6, 'Single Storey Terrace', 6, '1', '2020-10-27 14:41:49', '2020-10-27 20:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `title`, `position`, `status`, `content`, `created`, `modified`) VALUES
(1, 'About Us', 0, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div class=\"row\">\r\n<div class=\"col-12 col-md-6\"><strong style=\"font-size: 30px;\">Address</strong><br /><span style=\"color: #808080;\">E-4-27 (Level 4), Gala City Street Mall, Jalan Tun Jugah, 93350 Kuching Sarawak, Malaysia</span> <br /><br /><strong style=\"font-size: 30px;\">Mailbox</strong><br /><span style=\"color: #808080;\">P.O. Box 1283 93726 Kuching Sarawak, Malaysia</span> <br /><br /></div>\r\n<div class=\"col-12 col-md-6\">\r\n<p><strong style=\"font-size: 30px;\"><strong style=\"font-size: 30px;\">H/P</strong><br /></strong><span style=\"color: #808080;\">+6 013 8188773</span></p>\r\n<p><strong style=\"font-size: 30px;\">Phone</strong><br /><span style=\"color: #808080;\">+6 082 265 717 , +6 082 265 718</span></p>\r\n<p><strong style=\"font-size: 30px;\">Fax</strong><br /><span style=\"color: #808080;\">+6 082 265 719</span></p>\r\n<p><strong style=\"font-size: 30px;\">Email</strong><br /><span style=\"color: #808080;\">info@borneorealestate.com.my</span></p>\r\n</div>\r\n</div>\r\n</body>\r\n</html>', '2020-10-27 13:43:52', '2020-11-03 10:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `id` int(11) NOT NULL,
  `developer_photo` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`id`, `developer_photo`, `position`, `status`, `created`, `modified`) VALUES
(1, 'photo/5fa0aed81c68e.png', 1, '1', '2020-10-27 13:36:40', '2020-11-03 09:14:00'),
(2, 'photo/5fa0aeeb8a211.png', 2, '1', '2020-10-27 13:36:43', '2020-11-03 09:14:19'),
(3, 'photo/5fa0af0e2a35d.jpg', 3, '1', '2020-10-27 13:36:48', '2020-11-03 09:14:54'),
(4, 'photo/5fa0af137c1b4.png', 4, '1', '2020-10-27 13:36:52', '2020-11-03 09:14:59'),
(5, 'photo/5fa0af1a14eb1.jpg', 5, '1', '2020-10-27 13:36:58', '2020-11-03 09:15:06'),
(6, 'photo/5fa0af216b190.jpg', 6, '1', '2020-10-27 13:37:01', '2020-11-03 09:15:13'),
(7, 'photo/5fa0af296d32f.jpg', 7, '1', '2020-10-27 13:37:57', '2020-11-03 09:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_block`
--

CREATE TABLE `home_block` (
  `id` int(11) NOT NULL,
  `block_text` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_block`
--

INSERT INTO `home_block` (`id`, `block_text`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Numerous of deals done', 1, '1', '2020-10-27 13:42:15', '2020-10-27 13:42:15'),
(2, '40 team members at your services', 2, '1', '2020-10-27 13:42:26', '2020-10-27 13:42:26'),
(3, '24/7 available around the clock', 3, '1', '2020-10-27 13:42:33', '2020-10-27 13:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `temp_password` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `group_id`, `location`, `name`, `email`, `username`, `password`, `temp_password`, `status`, `created`, `modified`) VALUES
(1, 1, 5, 'Administrator', 'jonathan.wphp@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, '2020-07-30 14:31:35', '2020-09-04 15:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `property` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` varchar(19) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `property`, `name`, `email`, `contact`, `message`, `status`, `date`, `created`, `modified`) VALUES
(1, 'NEW Vision Heights (Phase 2) 1 and a half Townhouse', 'Jonathan', 'jonathan.wphp@gmail.com', NULL, 'asdasdadaa adsadas dasdsad', 'New', '2020-10-30 13:13:56', '2020-10-30 13:13:56', '2020-10-30 14:36:48'),
(2, 'NEW Vision Heights (Phase 2) 1 and a half Townhouse', 'Wong', 'jonathan.wphp@gmail.com', NULL, 'adadasdsa dasdsa d', 'New', '2020-10-30 13:13:56', '2020-10-30 13:21:52', '2020-11-03 17:46:10'),
(3, 'NEW Vision Heights (Phase 2) 1 and a half Townhouse', 'Jonathan Wong', 'jonathan.wphp@gmail.com', '0168653947', 'testing message here, can i ask that this ', '2020-10-30 14:55:48', NULL, '2020-10-30 14:55:48', '2020-10-30 14:55:48'),
(4, 'NEW Vision Heights (Phase 2) 1 and a half Townhouse', 'Jonathan Wong', 'jonathan.wphp@gmail.com', '0168653947', 'Testing message, can i ask you about the location. asdsadsdasdsadsadsadd asd', 'New', '2020-10-30 14:57:47', '2020-10-30 14:57:47', '2020-11-03 17:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `message_contact`
--

CREATE TABLE `message_contact` (
  `id` int(11) NOT NULL,
  `property` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` varchar(19) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_contact`
--

INSERT INTO `message_contact` (`id`, `property`, `name`, `designation`, `address`, `company`, `email`, `contact`, `message`, `status`, `date`, `created`, `modified`) VALUES
(1, NULL, 'Jonathan', 'Mr.', 'lot 123, jln asdasdas dasdasdas', '', 'jonathan.wphp@gmail.com', '123123213213', 'messagfe asda dasdasdasdasdasdasd asd asd', 'New', '2020-11-03 11:10:37', '2020-11-03 11:10:37', '2020-11-03 12:58:57'),
(2, NULL, 'jonathan', 'Mr.', 'aadsda dasdsa', 'ABC Company', 'jonathan.wphp@gmail.com', '123213213', 'asdasd asdasdasd', 'New', '2020-11-03 11:13:56', '2020-11-03 11:13:56', '2020-11-03 12:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `navigator`
--

CREATE TABLE `navigator` (
  `id` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `conceal_date` date DEFAULT NULL,
  `file_attachment` varchar(255) DEFAULT NULL,
  `news_content` longtext DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `photo`, `news_date`, `release_date`, `conceal_date`, `file_attachment`, `news_content`, `position`, `status`, `created`, `modified`) VALUES
(1, 'BNM maintains OPR at 1.75% at final monetary policy meeting for 2020', 'photo/5fa132f20b97d.jpg', '2020-11-03', '2020-11-04', '2020-11-06', NULL, 'KUALA LUMPUR (Nov 3): Bank Negara Malaysia (BNM) has decided to maintain the Overnight Policy Rate (OPR) at 1.75% today as the country’s economic activity is projected to improve further and as the central bank expects the nation’s underlying inflation to remain subdued as the world economy contends with the resurgence in Covid-19 cases.\r\n\r\nIn a statement today, BNM said the global economy continues to recover, led by improvements in manufacturing and export activity although the resurgence in Covid-19 cases suggests that the global economic recovery will likely remain uneven in the near term.\r\n\r\n\"For Malaysia, the latest indicators point towards significant improvement in economic activity in the third quarter. The introduction of targeted measures to contain Covid-19 in several states could affect the momentum of the recovery in the fourth quarter. Nonetheless, growth for the year 2020 is expected to be within the earlier forecasted range.', 2, '1', '2020-11-03 17:40:34', '2020-11-03 18:41:53'),
(2, 'Welcome to Our New Website', 'photo/5fa12eb926726.jpg', '2020-11-06', '0000-00-00', '0000-00-00', 'photo/5fa1277a80a83.png', 'Welcome to Our New Website. So needless to say, it is important that your website is doing the best job it can, representing your company and brand. Nothing reflects worse on a brand than a static and archaic website. Are you questioning whether its time for a new redesign for your company’s website? If so, we’ve compiled a list of some critical reasons to consider building a new website.', 1, '1', '2020-11-03 17:48:42', '2020-11-03 18:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `position`, `status`, `content`, `created`, `modified`) VALUES
(1, 'About Us', 0, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><img src=\"../../photo/5fa0afa25a4d4.jpg\" alt=\"\" width=\"3036\" height=\"1137\" /></p>\r\n<p>&nbsp;</p>\r\n<h2>Introduction</h2>\r\n<p>Borneo Real Estate was established in November 1987 as a proprietorship by the Principal, Mr. Aubrey Chan Yaw Kwong. With the passing of time, Borneo Real Estate has become a household name in East Malaysia mainly due to their strong presence in localized property scene in Kuching and Sarawak while marketing peninsula properties and overseas properties.</p>\r\n<p>&nbsp;</p>\r\n<h2>Vision Statement</h2>\r\n<p>To stand out as a leading real estate entity with passion for service professionalism and recognition delighting our customers whom we see as the essence of our core business.</p>\r\n<p>&nbsp;</p>\r\n<h2>Mission Statement</h2>\r\n<p>To be the most passionately referred real estate agency in the Real Estate Industry, while striving to provide our clients with the optimum service and satisfaction they deserve. Service is the heart of our business.</p>\r\n', '2020-10-27 13:43:52', '2020-11-03 09:17:39'),
(2, 'Services', 0, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h1><strong class=\"news\">Range of Services</strong></h1>\r\n<ul>\r\n<li class=\"content\"><strong>Specializes in sale, purchase and rental of all types of real estate</strong><br />Residential Houses, Comdominiums, Lands, Commercial &amp; Industrial Properties.</li>\r\n<li class=\"content\"><strong>Project Marketing</strong></li>\r\n<li class=\"content\"><strong>Project Development</strong></li>\r\n<li class=\"content\"><strong>Property Market Research</strong></li>\r\n<li class=\"content\"><strong>Property Exhibition Specialist</strong><br />Advice and implementation of proven marketing strategies for commercial, retail, industrial and office property exhibition - with results orientated and proven track record.</li>\r\n<li class=\"content\"><strong>Overseas Land Investment</strong></li>\r\n</ul>\r\n</body>\r\n</html>', '2020-10-27 13:44:23', '2020-11-03 18:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `parent_table` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `parent_table`, `parent_id`, `status`, `position`, `photo`, `created`, `modified`) VALUES
(10, 'property', '1', '1', 0, 'photo/5fa0af4082d05.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(9, 'property', '1', '1', 0, 'photo/5fa0af4081fe4.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(8, 'property', '1', '1', 0, 'photo/5fa0af408122f.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(7, 'property', '1', '1', 0, 'photo/5fa0af40808e6.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(6, 'property', '1', '1', 0, 'photo/5fa0af407fe86.jpg', '2020-11-03 09:15:44', '2020-11-03 09:15:44'),
(11, 'pages', '0', '1', 0, 'photo/5fa0afa25a4d4.jpg', '2020-11-03 09:17:22', '2020-11-03 09:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `new` varchar(255) DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `bathrooms` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `category`, `photo`, `name`, `location`, `size`, `new`, `bedrooms`, `bathrooms`, `position`, `status`, `description`, `created`, `modified`) VALUES
(1, '1', 'photo/5fa0af59bb4f1.jpg', 'NEW Vision Heights (Phase 2) 1 and a half Townhouse', 'Jalan Batu Kawa', '', 'Yes', '3', '2', 1, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>3 rooms 2 bathrooms 2 allocated parkings 1,150 or 1,300 square feet For more information, please leave a message on the \"CONTACT US\" page and we will get back to you. LIMITED UNITS AVAILABLE Thank you.&', '2020-10-27 14:38:21', '2020-11-03 09:16:09'),
(2, '3', 'photo/5fa0af6e2f3d1.jpg', 'NEW Vision Heights Double-storey Semi-D (Phase 2)', 'Jalan Batu Kawa', '', 'Yes', '4', '4', 2, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>New DS Semi-D, Vision Heights for sale. Large build up, about 24\'6\"x47\'2\". 4 bedrooms, 4 bathrooms. High, solid ground. Less than 5 mins away from Batu Kawa eMart.<br /><br />For more information, pleas', '2020-10-27 14:40:00', '2020-11-03 09:16:30'),
(3, '4', 'photo/5fa0af77e5c64.jpg', ' NEW Vision Heights Double-storey Terrace (Phase 2)', 'Jalan Batu Kawa', '', 'Yes', '4', '3', 3, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<div align=\"left\">Large built up, about 22 x 44 (Terrace) 23\"6 x 44 (Terrace) 4 bedrooms, 3 bathrooms. High, solid ground. Less than 5 mins away from Batu Kawa eMart.</div>\r\n<div align=\"left\">&nbsp;</div>\r', '2020-10-27 14:43:07', '2020-11-03 09:16:39'),
(4, '2', 'photo/5fa0af82f05ba.jpg', 'Royal Oak Condominium, Jalan Stutong Baru', 'Jalan Stutong Baru', '1237', 'Yes', '3', '2', 4, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>A 6-7 storey condominium located at Jalan Stutong Baru, facing Kuching International Airport\'s runway, it is one of the blooming areas offered in Kuching. Royal Oak - designed as the ideal escape from t', '2020-10-27 14:44:41', '2020-11-03 09:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `user` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `previous_url` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_logout` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user`, `ip`, `country`, `previous_url`, `login_logout`, `created`) VALUES
(1, 'login:1', '127.0.0.1', '', 'http://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-10-27 12:48:31'),
(2, 'login:1', '127.0.0.1', '', 'http://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-10-30 11:01:36'),
(3, 'login:1', '127.0.0.1', '', 'http://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-10-30 13:30:30'),
(4, 'login:1', '127.0.0.1', '', 'https://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-11-02 15:25:17'),
(5, 'login:1', '::1', '', 'http://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-11-03 09:10:31'),
(6, 'login:1', '::1', '', 'https://localhost/borneorealestate.com.my/cms/authentication/login.php', 'login', '2020-11-03 17:23:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_dashboard`
--
ALTER TABLE `banner_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_block`
--
ALTER TABLE `home_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_contact`
--
ALTER TABLE `message_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigator`
--
ALTER TABLE `navigator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banner_dashboard`
--
ALTER TABLE `banner_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_block`
--
ALTER TABLE `home_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message_contact`
--
ALTER TABLE `message_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `navigator`
--
ALTER TABLE `navigator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
