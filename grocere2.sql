-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 03:47 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocere2`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `region` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `area` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `region`, `location`, `area`, `price`, `position`, `status`, `created`, `modified`) VALUES
(1, '1', 1, '7th Mile', '3.10', '0', '2', '2020-05-12 12:13:19', '2020-07-06 15:26:55'),
(2, '1', 1, 'Pending', '9.00', '1', '2', '2020-06-17 12:32:52', '2020-07-06 15:26:55'),
(3, '1', 1, 'Satok', '8.00', '1', '2', '2020-06-17 13:03:31', '2020-07-06 15:26:55'),
(4, '3', 4, 'Location A', '10.00', '1', '1', '2020-07-02 11:22:44', '2020-07-02 11:22:44'),
(5, '3', 4, 'Centre Point', '0.00', '1', '1', '2020-07-06 15:27:58', '2020-07-06 15:28:06'),
(7, '3', 4, 'Marina Square 2', '2.00', '2', '1', '2020-07-06 15:28:40', '2020-07-06 15:29:10'),
(9, '3', 4, 'Saberkas Commercial Centre', '5.00', '3', '1', '2020-07-06 15:29:14', '2020-07-06 15:29:14'),
(10, '3', 4, 'Senadin', '10.00', '4', '1', '2020-07-06 15:29:43', '2020-07-06 15:29:43'),
(11, '2', 5, 'Sungei Merah', '5.00', '1', '1', '2020-07-07 11:30:09', '2020-07-07 11:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `banner`, `position`, `status`, `created`, `modified`) VALUES
(15, 'photo/5f0943bbc6a70.jpg', '2', '1', '2020-07-11 12:44:43', '2020-07-29 01:29:01'),
(20, 'photo/5f20619e20bde.jpg', '1', '1', '2020-07-29 01:34:22', '2020-07-29 01:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `banner_dashboard`
--

CREATE TABLE `banner_dashboard` (
  `id` int(11) NOT NULL,
  `banner_dashboard` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `banner_dashboard`
--

INSERT INTO `banner_dashboard` (`id`, `banner_dashboard`, `position`, `status`, `created`, `modified`) VALUES
(2, 'photo/5f09466df33ce.jpg', '', '1', '2020-06-29 15:20:23', '2020-07-11 12:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `position`, `status`, `created`, `modified`) VALUES
(5, 'Nutribest', '0', '1', '2020-07-02 12:22:13', '2020-07-02 12:22:13'),
(12, 'Brand C', '3', '2', '2020-07-09 12:18:06', '2020-07-09 12:18:14'),
(13, 'None', '', '1', '2020-07-27 17:20:19', '2020-07-27 17:20:19'),
(14, 'Coldstar', '2', '1', '2020-07-27 17:22:47', '2020-07-27 17:22:57'),
(15, 'Mushroom', '3', '1', '2020-07-27 17:35:16', '2020-07-27 17:35:16'),
(16, 'QL Suria', '4', '1', '2020-07-27 18:26:25', '2020-07-27 18:26:25'),
(17, 'Cab', '5', '1', '2020-07-27 18:39:07', '2020-07-27 18:39:07'),
(18, 'PA Food', '6', '1', '2020-07-27 20:13:58', '2020-07-27 20:13:58'),
(19, 'Valley Fresh', '7', '1', '2020-07-29 18:38:21', '2020-07-29 18:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `position`, `status`, `created`, `modified`) VALUES
(3, 'Beverages', '0', '2', '2020-05-18 12:11:17', '2020-05-18 12:25:11'),
(4, 'Fresh Produce', '1', '1', '2020-07-06 14:45:46', '2020-07-27 13:09:19'),
(5, 'Chilled & Frozen', '2', '1', '2020-07-27 13:09:14', '2020-07-27 13:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) DEFAULT NULL,
  `setup` varchar(2000) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `setup`, `description`, `created`, `modified`) VALUES
(1, 'Logo', 'images/cadpis_logo.jpg', 'path to logo for Website', '2014-10-02 09:50:00', '2018-03-01 13:44:57'),
(2, 'Home Page Title', 'IMCKENZIE', 'Home Page Title', '2016-03-11 00:00:00', '2018-11-30 09:55:42'),
(3, 'Kuching GiG', 'kuching, Kuching Gig, Gig Economy, Borneo Gig, Gig Kuching, Gig Marketplace, kuching marketplace, Kuching Murah, Kuching Budget,', 'Kuching GiG is the Online Platform of Gig Marketplace for the Hustling Community.', '2019-05-07 00:00:00', '2020-02-04 13:59:44'),
(4, 'Default mp/dun to be display', '59', 'Default mp/dun to be display', '2019-10-14 00:00:00', '2019-10-31 16:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `position` varchar(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `description`, `position`, `status`, `created`, `modified`) VALUES
(1, 'About Us', '<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">The Ray of Hope Initiative Limited (ROHI) is a non-profit organisation founded in November 2012. ROHI is dedicated to helping individuals and families living within our community in Singapore, who are going through hardships, who may otherwise have no access to assistance.</span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI\'s&nbsp;<strong></strong><strong>vision</strong>&nbsp;is to build</span></span><span style=\"font-size: medium;\">&nbsp;a trusted platform, incorporating casework and counselling as well as programmes for the people in our community to help one another, as a positive giving experience cultivates a greater sense of individual responsibility, leading to stronger cohesion within our community.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI\'s&nbsp;<strong></strong><strong>mission</strong>&nbsp;is to help donors in our community help those who have fallen through the cracks.</span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI takes a structured approach. We work with all our recipients to estimate their income and living expenses, debts, medical bills et cetera before funds are raised.&nbsp;Disbursements are made in instalments, sometimes in the form of vouchers to ensure that the money is used appropriately. And we ensure that there is personal touch for giving where donors receive continuous and timely updates on recipients\' progress.</span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"color: #008080;\"><span style=\"font-size: large;\"><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\"><span style=\"text-decoration: underline;\">Our Values</span></span></span></span></span></strong></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI abides by four core values. They are:</span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"font-size: large;\"><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\">1) Accountability &amp; Transparency</span></span></span></span></span></strong></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We&nbsp;collect, administer and disburse donations in an honest and transparent manner.<br /> <br /> <strong></strong><strong></strong></span></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\">2) Fairness &amp; Respect</span></span></strong></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We&nbsp;help all who need help, regardless of race, language, religion or social status. We must always be neutral and unbiased regardless of our own personal views.&nbsp;</span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\">3) Communication</span></span></strong></span></p>\r\n<p><span style=\"color: black;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: small;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-size: small;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We&nbsp;share our decision-making process, give timely and unbiased updates on cases, be open to feedback, and ensure we maintain an efficient and effective platform for our donors.</span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p>\r\n<p><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"font-size: large;\"><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><span style=\"color: #000000;\"><span style=\"font-family: verdana, geneva;\">4) Maximise Social Impact</span></span></span></span></span></strong></span></p>\r\n<p><span style=\"font-family: georgia, palatino;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">Through innovation, partnerships and prudent resource allocation, we strive to touch the lives of as many people in need as possible, as well as ensure that every dollar donated achieves optimal results.<br /> <!--[if !supportLineBreakNewLine]--></span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '1', '1', '2015-11-23 02:49:21', '2017-12-01 17:25:55');
INSERT INTO `contents` (`id`, `title`, `description`, `position`, `status`, `created`, `modified`) VALUES
(3, 'Privacy Policy', '<p class=\"MsoNormal\">&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">A.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Who We Are?</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">1.&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This Privacy Policy applies to the products, services, website(s) provided, mobile application(s) provided and/or the activities conducted, by The Ray of Hope Initiative Limited (&ldquo;ROHI&rdquo;, \"we\", \"our\", \"us\"). We are a non-profit organisation registered in Singapore (Registration number 201229333H) at 9 Battery road, #15-01, Straits Trading Building, Singapore (049910).</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">B.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; What Is The Purpose Of This Policy?</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The purpose of this Privacy Policy is to inform you and provide you with an understanding of how we handle, collect, use, disclose and deal with personal data about you that you give us, that we receive through third parties or that is in our possession. This Privacy Policy covers all of our platforms, whether across websites (&ldquo;Site&rdquo;) and applications (&ldquo;App&rdquo;) in mobile, tablet or other electronic devices. Please read this Privacy Policy carefully. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We take our responsibilities under Singapore&rsquo;s Personal Data Protection Act (the &ldquo;PDPA&rdquo;) seriously. We also recognize the importance of the personal data you have entrusted to us and believe that it is our responsibility to properly manage, protect and process your personal data.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">C.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; What Information Do We Collect?</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &ldquo;Personal data&rdquo; is defined under the PDPA to mean data, whether true or not, about an individual who can be identified from that data, or from that data and other information to which an organisation has or is likely to have access. ROHI collects information about you when you use our mobile application, websites and other online products and services and throughout other interactions and services you have with us. Personal data which we may collect include:</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">- Name</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">- Home Address</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">- Contact Information</span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">We will collect your personal data in accordance with the PDPA. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We may also collect and store certain information automatically when you visit the Site. Examples include the internet protocol (IP) address used to connect your computer or device to the internet, connection information such as browser type and version, your operating system and platform, a unique reference number linked to the data you enter on our system, login details, the full URL clickstream to, through and from the Site (including date and time), cookie number and your activity on our Site, including the pages you visited, the searches you made and, if relevant, the services you purchased or donations you made.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We may receive information about you from third parties if you use any websites or social media platforms operated by third parties (for example, Facebook, Instagram, Twitter etc.) and, if such functionality is available, you have chosen to link your profile on the Site with your profile on those other websites or social media platforms.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">D.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cookies</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We may use cookies to identify you from other users on the Site or App. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A cookie is a small file of letters and numbers that we store on your browser or the hard drive of your computer or device. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You can block or deactivate cookies in your browser settings.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">10.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We use log-in cookies in order to remember you when you have logged in for a seamless experience. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">11.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We use session cookies to track your movements from page to page and in order to store your selected inputs so you are not constantly asked for the same information. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">12.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This Site uses Google Analytics which is one of the most widespread and trusted analytics solution on the web for helping us to understand how you use the Site and ways that we can improve your experience. These cookies may track things such as how long you spend on the Site and the pages that you visit so we can continue to produce engaging content.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">13.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; By continuing to use the Site or the App, you are agreeing to the use of cookies on the Site as outlined above. However, please note that we have no control over the cookies used by third parties.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">14.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For further information on types of cookies and how they work visit www.allaboutcookies.org</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">E.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Purposes for Which We Collect, Use Or Disclose Your Personal Data</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">15.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ROHI will/may collect, use, disclose and/or process your personal data for one or more of the following purposes: </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administering, facilitating, processing and/or dealing in any matters relating to your use of the App or the Site; </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; monitoring, processing and/or tracking your use of the App or the Site in order to provide you with a seamless experience, facilitating or administering your use of the App or the Site, and/or to assist us in improving your experience in using the App or the Site;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; assessing, administering, processing and/or managing your donation(s);</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; assessing and processing your request for the purchase of and/or subscription to our products and/or services;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; registering you as a donor of ROHI; and/or to deal with, process and/or administer the account that you may open with us, including to facilitate your transactions or activities on the Site, or your transactions or activities with us;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administering, facilitating and/or dealing with your relationship with us;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administering, facilitating, processing and/or dealing in (i) any transactions, activities carried out by you in the App or on the Site or with us, or (ii) your donations to us;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; carrying out your instructions or responding to any enquiry given by (or purported to be given by) you or on your behalf;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; contacting you or communicating with you via phone/voice call, text message and/or fax message, email and/or postal mail for the purposes of administering and/or managing your use of the App or Site, your account with us, your relationship with us or any transactions or donation(s) made by you with us. You acknowledge and agree that such communication by us could be by way of the mailing of correspondence, documents or notices to you, which could involve disclosure of certain personal data about you to bring about delivery of the same as well as on the external cover of envelopes/mail packages</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; carrying out due diligence or other screening activities (including background checks) in accordance with legal or regulatory obligations (whether Singapore or foreign country) applicable to us or our affiliates/associated companies, the requirements or guidelines of governmental authorities (whether Singapore or foreign country) which we determine are applicable to us or our affiliates/associated companies,&nbsp; and/or our risk management procedures that may be required by law (whether Singapore or foreign country) or that may have been put in place by us or our affiliates/associated companies;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(k)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to prevent or investigate any fraud, unlawful activity or omission or misconduct, whether or not there is any suspicion of the aforementioned; dealing with conflict of interests; or dealing with and/or investigating complaints;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(l)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; complying with or as required by any applicable law, governmental or regulatory requirements of any jurisdiction applicable to us or our affiliates/associated companies, including meeting the requirements to make disclosure under the requirements of any law binding on us or our affiliates/associated companies, and/or for the purposes of any guidelines issued by regulatory or other authorities (whether of Singapore or elsewhere), with which we or our affiliates/associated companies are expected to comply;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(m)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; complying with or as required by any request or direction of any governmental authority (whether Singapore or foreign country) which we are expected to comply with; or responding to requests for information from public agencies, ministries, statutory boards or other similar authorities (including but not limited to the Commissioner of Charities, Inland Revenue Authority of Singapore) (whether Singapore or foreign country). For the avoidance of doubt, this means that we may/will disclose your personal data to the aforementioned parties upon their request or direction;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(n)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; conducting research, surveys, market surveys, analysis and/or development activities (including but not limited to data analytics, surveys and/or profiling) to improve our services and facilities, or to improve our understanding of your interests, concerns and preferences, in order to enhance any continued interaction between yourself and us connected or in relation to the Site, or improve any of our products or services or your relationship with us. Without limiting the generality of the foregoing, we may/will in this regard send you surveys by way of email or postal mail;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(o)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; storing, hosting, backing up (whether for disaster recovery or otherwise) of your personal data, whether within or outside Singapore;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(p)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; facilitating, dealing with and/or administering external audit(s) or internal audit(s) of the business of ROHI;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(q)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; for marketing purpose if you have separately consented to it, and in this regard, we would be providing you by way of postal mail, electronic transmission to your email address(es), voice call, SMS/MMS or fax, depending on the mode of communication you have consented to, with marketing, advertising and promotional information, materials and/or documents relating to products and/or services (including products and/or services of third party organizations whom ROHI may collaborate or tie up with) that ROHI (including its affiliates/related corporations) or such third party organizations may be selling, marketing, offering or promoting, whether such products or services exist now or are created in the future;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(r)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dealing with and/or facilitating a business asset transaction or a potential business assert transaction, where such transaction involves ROHI as a participant or involves only a related corporation or affiliated company of ROHI as a participant or involves ROHI and/or any one or more of ROHI&rsquo;s related corporations or affiliated companies as participant(s), and there may be other third party organizations who are participants in such transaction. &ldquo;business asset transaction&rdquo; means the purchase, sale, lease, merger or amalgamation or any other acquisition, disposal or financing of an organization or a portion of an organization or of any of the business or assets of an organization;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; anonymization of your personal data. In this regard, you acknowledge that personal data that has been anonymized is no longer personal data and the requirements of the PDPA would no longer apply to such anonymized data; and</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(t)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; record-keeping purposes and producing statistics and research for internal and/or statutory reporting and/or record-keeping requirements, of ROHI or of its affiliates/related corporations;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(the purposes set out in this paragraph [15] above shall be collectively referred to as the &ldquo;Purposes&rdquo;) </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">16.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ROHI may/will need to disclose your personal data to third parties, whether located within or outside Singapore, for one or more of the above Purposes, as such third parties, would be processing your personal data for one or more of the above Purposes. In this regard, you hereby acknowledge, agree and consent that we may/are permitted to disclose your personal data to such third parties (whether located within or outside Singapore) for one or more of the above Purposes and for the said third parties to subsequently collect, use, disclose and/or process your personal data for one or more of the above Purposes. Without limiting the generality of the foregoing or of paragraph 15, such third parties include :</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; our associated or affiliated organizations or related corporations;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any of our agents, contractors or third party service providers that process or will be processing your personal data on our behalf including but not limited to those which provide administrative or other services to us such as mailing houses, telecommunication companies, information technology companies, marketing companies, call centers and data centers; </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; banks, credit card companies and/or third parties to process and/or deal with your donation(s); and </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; third parties to whom disclosure by ROHI is for one or more of the Purposes and such third parties would in turn be collecting and processing your personal data for one or more of the Purposes.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">17.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We may share your information with any member of our group (which means our affiliates, related corporations or associated organizations), if any, from time to time for one or more of the Purposes. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">18.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You may withdraw your consent for the collection, use and/or disclosure of your personal data in our possession or under our control by emailing us at info@rayofhope.sg. We will process your request 48hrs from such a request for withdrawal of consent being made, and will thereafter not collect, use and/or disclose your personal data in the manner stated in your request, unless an exception under the law or a provision in the law permits us to. However, your withdrawal of consent could result in certain legal consequences arising from such withdrawal, including us being unable to perform the transactions requested by you or result in the termination of our relationship.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">19.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We may collect, use, disclose or process your personal data for other purposes that do not appear above. However, we will notify you of such other purpose at the time of obtaining your consent, unless processing of your personal data without your consent is permitted by the PDPA or by law.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">20.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To the extent permitted by law, we may/will also be collecting from sources other than yourself, personal data about you, for one or more of the above Purposes, and thereafter using, disclosing and/or processing such personal data for one or more of the above Purposes. We may combine information we receive from other sources with information you give to us and information we collect about you. We may use this information and the combined information for the Purposes set out above (depending on the types of information we receive).</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">21.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Making A Donation. Your credit/debit card information is collected by third-party payment vendor MS Payment mcpayment.com. This use of your information is based on their terms of service and policies, which you should review. We do not collect or have access to the credit/debit card information our third-party payment vendor MC Payment collects to process online transactions.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provision Of Third Party Personal Data By You</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">22.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Should you provide ROHI with personal data of individual(s) other than yourself, you represent and warrant to ROHI and you hereby confirm that:</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; prior to disclosing such personal data to us, you would have and had obtained consent from the individuals whose personal data are being disclosed to us, to:</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; permit you to disclose the individuals&rsquo; personal data to ROHI for the Purposes; and</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; permit ROHI to collect, use, disclose and/or process the individuals&rsquo; personal data for the Purposes, as set out in paragraph [15] above;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any personal data of individuals that you disclose to us is accurate; and</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; you are validly acting on behalf of such individuals and that you have the authority of such individuals to provide their personal data to ROHI and for ROHI to collect, use, disclose and process such personal data for the Purposes.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">G.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; How Do We Store Data?</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">23.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Security of your personal data is important to us. We take appropriate action to protect personal data from loss, misuse, unauthorized access or disclosure, alteration or destruction using the same safeguards as we use for our own proprietary information. All information you provide to us is stored on our secure servers and any payment transactions will be encrypted using SSL technology or equivalent. Where we have given you (or where you have chosen) a password which enables you to access certain parts of the Site, you are responsible for keeping this password confidential. We ask you not to share a password with anyone.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">24.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We cannot accept liability for loss of personal data due to cause beyond our control or omissions of other users or third parties.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">25.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We will put in place measures such that your personal data in our possession or under our control is destroyed and/or anonymized as soon as it is reasonable to assume that (i) the purpose for which that personal data was collected is no longer being served by the retention of such personal data; and (ii) retention is no longer necessary for any other legal or business purposes.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">H.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rights</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">26.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You have the right to access and/or correct any personal data that we hold about you, subject to exceptions under the law. This right can be exercised at any time by emailing us at info@rayofhope.sg. We will need enough information from you in order to ascertain your identity as well as the nature of your request, so as to be able to deal with your request. With respect to your access request, we may charge a fee in order to process it.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">27.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For a request to access personal data, once we have sufficient information from you to deal with the request, we will seek to provide you with the relevant personal data within 30 days. Where we are unable to respond to you within the said 30 days, we will notify you of the soonest possible time within which we can provide you with the information requested. Note that the PDPA exempts certain types of personal data from being subject to your access request.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">28.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For a request to correct personal data, once we have sufficient information from you to deal with the request, we will correct your personal data within 30 days. Where we are unable to do so within the said 30 days, we will notify you of the soonest practicable time within which we can make the correction. Note that the PDPA exempts certain types of personal data from being subject to your correction request as well as provides for situation(s) when correction need not be made by us despite your request. We will send the corrected personal data to every other organization to which the personal data was disclosed by us within a year before the date the correction was made, unless that other organization does not need the corrected personal data for any legal or business purpose.&nbsp; </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">29.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We hold and deal with your data in accordance with the PDPA. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">I.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Administration and Management of Personal Data</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">30.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We will take reasonable efforts to ensure that your personal data is accurate and complete, if your personal data is likely to be used by ROHI to make a decision that affects you, or disclosed to another organization. However, this means that you must also update us of any changes in your personal data that you had initially provided us with. We will not be responsible for relying on inaccurate or incomplete personal data arising from your not updating us of any changes in your personal data that you had initially provided us with.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">31.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Where your personal data is to be transferred out of Singapore, we will comply with the PDPA in doing so. In this regard, this includes us taking appropriate steps to ascertain that the foreign recipient organization of the personal data is bound by legally enforceable obligations to provide to the transferred personal data a standard of protection that is at least comparable to the protection under the Act. This may include us entering into an appropriate contract with the foreign recipient organization dealing with the personal data transfer or permitting the personal data transfer without such a contract if the PDPA or law permits us to</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">J.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Complaint Process</span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">32.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you have any complaint or grievance regarding about how we are handling your personal data or about how we are complying with the PDPA, we welcome you to contact us with your complaint or grievance. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">33.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please contact us with your complaint or grievance by emailing us at: <a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">info@rayofhope.sg</a></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">34.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Where you are sending an email in which you are submitting a complaint, your indication at the subject header that it is a PDPA complaint would assist us in attending to your complaint speedily by passing it on to the relevant staff in our organization to handle. For example, you could insert the subject header as &ldquo;PDPA Complaint&rdquo;. </span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">35.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We will certainly strive to deal with any complaint or grievance that you may have speedily and fairly.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><span style=\"font-size: small;\">K.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; General </span></span></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">36.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We reserve the right to amend the terms of this Privacy Policy at our discretion. Any amended Privacy Policy will be posted on our website and can be viewed at www.ROHI.sg.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">37.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You are encouraged to visit the above website from time to time to ensure that you are well informed of our latest policies in relation to personal data protection</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">38.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your consent that is given pursuant to this Privacy Policy is additional to and does not supersede any other consents that you had provided to ROHI with regard to processing of your personal data.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">39.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For the avoidance of doubt, in the event that Singapore personal data protection law permits an organization such as us to collect, use or disclose your personal data without your consent, such permission granted by the law shall continue to apply.</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">40.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you have any queries on this Privacy Policy or any other queries in relation to how we may manage, protect and/or process your personal data, please do not hesitate to contact our Data Protection Officer at: <a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">info@rayofhope.sg</a></span></p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>\r\n<p><span style=\"font-size: small;\"> </span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: small;\">Last Updated on 15 March, 2017</span></p>', '3', '1', '2015-11-25 03:25:15', '2017-09-12 10:51:46');
INSERT INTO `contents` (`id`, `title`, `description`, `position`, `status`, `created`, `modified`) VALUES
(4, 'Terms & Conditions', '<p class=\"MsoNormal\"><strong><span>ROHI WEBSITE AND DONATION TERMS &amp; CONDITIONS</span></strong></p>\r\n<p class=\"MsoNormal\">This website,<a href=\"../../..//\" target=\"_blank\">&nbsp;www.rohi.sg, </a>is provided by the Ray of Hope Initiative Limited (registration number 201229333H) (hereinafter referred to as &ldquo;<strong>ROHI</strong>&rdquo;, &ldquo;<strong>we</strong>&rdquo;, &ldquo;<strong>our</strong>&rdquo; and &ldquo;<strong>us</strong>&rdquo;). ROHI is a non-profit organisation and a full member of National Council of Social Service. &nbsp;The term &ldquo;<strong>you</strong>&rdquo; refers to the user or viewer of the Website (defined below). The term &ldquo;<strong>cases</strong>&rdquo; refer to ROHI&rsquo;s recipients/beneficiaries.</p>\r\n<p class=\"MsoNormal\"><span>These terms and conditions (the &ldquo;<strong>Terms</strong>&rdquo;) are divided into two (2) sections. Part I &ndash; General Terms (the &ldquo;<strong>General Terms</strong>&rdquo;) governs your access and use of the Website (defined below). Part II &ndash; Donation Terms (the &ldquo;<strong>Donation Terms</strong>&rdquo;) sets out additional terms and conditions that apply specifically to any and all donations made by you to ROHI through the Website (these are in addition to the Part I General Terms that apply to the use of the Website to make donations to ROHI). Please read these Terms carefully.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>By :</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">accessing and/or using the Website; and/or</span></p>\r\n<p class=\"MsoNormal\"><span>(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;making&nbsp;any donations to ROHI through the Website,</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>you are agreeing to and you are deemed to have agreed to, be bound by these Terms.&nbsp;If you do not wish to be bound by these Terms, you should not continue to use or access the Website and/or make any donations to ROHI&nbsp;through the Website.&nbsp;</span><span lang=\"EN-SG\">This is a contract between (a) you (either an individual or the entity you represent); and (b) ROHI, that governs your access and use of the Website, and/or donations made by you to ROHI through the Website.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>If you have any questions about these Terms, or if you wish to send us any notices in relation to these Terms, you may contact us at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\"><span>info@rayofhope.sg</span><span>.</span></a></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><strong><span style=\"text-decoration: underline;\"><span>Part I &ndash; General Terms</span></span></strong></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>1.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>DEFINITIONS AND INTERPRETATION</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>1.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In these Terms, unless the context requires otherwise:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Applicable Laws</strong>&rdquo; means any statutes, laws, rules, regulations, codes and ordinances, any judicial or administrative court rulings or judgments, of any country, that are applicable to you and/or ROHI.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Content</strong>&rdquo; or &ldquo;<strong>Contents</strong>&rdquo; means any data&nbsp;&nbsp;and/or information that is available, accessible or stored in the Website in an electronic form, including, without limitation, any information, advertisements, documents, text, files, images, sounds, moving images and videos.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Donation Platform</strong>&rdquo; means the online platform available on the Website to allow users to make donations to ROHI and the fundraising campaigns and cases available on the Website.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Fundraising Page</strong>&rdquo; means a portion or webpage of the Website in which users post fundraising campaigns and cases.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Fundraising Platform</strong>&rdquo; means the online fundraising platform available on the Website to allow users to create fundraising campaigns to help raise funds for deserving cases.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Guidelines</strong>&rdquo; means any and all additional terms, guidelines, policies and/or rules prescribed or issued by ROHI with respect to the access and use of the Website and/or any donations made by you to ROHI through the Website, whether existing now or issued by ROHI at a future date, and which forms part of these Terms between ROHI and you and that may be posted by ROHI on the Website, including any revised or amended version of the same as issued by ROHI from time to time and that may be posted on the Website. Such revised or amended version of the same shall apply to you and you are deemed to have accepted the same, from the time it is published on the Website.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">&ldquo;<strong>Intellectual Property Rights</strong>&rdquo; means any and all rights existing from time to time (both current and future) under patent law, copyright law, trade secret law, trademark law, unfair competition law, and any and all other proprietary rights, and any and all applications, renewals, extensions and restorations thereof, now or hereafter in force and effect worldwide, or capable of protection in any relevant country in the world.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Parties</strong>&rdquo; means you and ROHI collectively and &ldquo;<strong>Party</strong>&rdquo; means either one of them.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>User Account</strong>&rdquo; means an account that is created by a user of the Website, and which is protected by a secure password chosen by the user, in order to access and use the certain functionalities or features of the Website, including but not limited to the Donation Platform and the Fundraising Platform.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\">(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ldquo;<strong>Website</strong>&rdquo; means the website with the url &ldquo;<a href=\"../../..//\" target=\"_blank\">www.rohi.sg&rdquo;</a> and includes any functionality or feature provided therein.</p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>1.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unless the contrary intention appears:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The word &ldquo;person&rdquo; includes an individual, a firm, a body corporate, a partnership, joint venture, an unincorporated body or association, or any government agency, and includes a reference to the person&rsquo;s executors, administrators, successors, substitutes (including, without limitation, persons taking by novation) and assigns;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No rule of construction applies to the disadvantage of a Party because that Party was responsible for the preparation of these Terms or any part of it; and</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Headings are inserted for convenience and do not affect the interpretation of these Terms.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>AGREEMENT</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>2.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;These Terms represent an agreement entered into between you and ROHI concerning:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;your&nbsp;access and/or use of the Website; and/or</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;any donations made by you to ROHI through the Website, as the case may be.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>By your proceeding with (i) and/or (ii) above, you are declaring that you have read, understood and agree to accept and be bound by and comply with these Terms.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>2.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; These Terms may be amended or supplemented from time to time by ROHI at its sole discretion, by posting revisions or a revised/amended set of the Terms (or the General Terms or Donation Terms) on the Website. Your continued access or use of the Website, and/or donations to ROHI through the Website, following the posting of any changes or modifications will constitute your acceptance of such changes, modifications, supplements or of such modified Terms.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>2.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You agree to be bound by and to fully observe and comply with these Terms including any Guidelines that may be issued by ROHI from time to time, with regard to your access and/or use of the Website, and/or your donations to ROHI through the Website.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>USER ACCOUNT</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>3.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;In order to access and use certain functionalities and features of the Website, including but not limited to the Fundraising Platform and the Donation Platform, you will be required to create and log in to a User Account&nbsp;</span><span lang=\"EN-SG\">which will be protected by a secured password chosen by you. In order to create a User Account, you must provide the necessary information required, including but not limited to your name, email address and mobile phone number, which you warrant to be true, accurate and current. If we discover that the User Account information you have provided us is/are not true or current, ROHI is entitled to immediately suspend or terminate your access to or use of your User Account and the various functionalities and features of the Website which are accessible only to users with valid User Accounts.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\">3.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;You acknowledge and agree that you are responsible for maintaining the confidentiality, safekeeping and security of your User Account details, including any passwords that may be used to access to your User Account. You must promptly notify ROHI at&nbsp;<a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">info@rayofhope.sg&nbsp;</a>if you know or suspect that your password or User Account has been compromised. Please note that in accessing and using your User Account through the Website, you must ensure that you continue to comply with the Terms and other Guidelines which may be issued by ROHI from time to time.</p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>3.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Without prejudice to the foregoing, you shall be solely liable and responsible for any activity conducted through your User Account or using your User Account information, unless you have notified ROHI in writing of the closure, compromise or misuse of your User Account and ROHI has received such notification. You acknowledge that ROHI would not have the means to verify the identity of the party using your User Account information or your username and password on the Website and you agree that ROHI will not be responsible, in any way whatsoever, for losses or damages suffered by you or any third party if there is any unauthorised use of your User Account, username or password</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>USER CONDUCT AND WEBSITE USAGE</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">You are entitled to access and use the Website in accordance with these General Terms.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You must always use the Website and its associated services in a responsible and legal manner. In particular, but without limitation:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If you create a Fundraising Page on ROHI, it is your responsibility to ensure that the content and/or photograph that you are uploading on your Fundraising Page , in particular any photographs or images, do not infringe any third party&rsquo;s Intellectual Property Rights, including but not limited to copyright. If such content and/or photographs that you are uploading on your Fundraising Page belongs to a third party, you must obtain the relevant owner&rsquo;s written consent to use it in full compliance with Applicable Laws. You shall, at our request, provide us with documentary evidence of such written consent. We reserve the right and you agree that we have the right, to remove any content, pictures, photographs or copies of the same from personal Fundraising Pages, at our sole and absolute discretion and without notice:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for any or no reason whatsoever;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;if their copyright status is in any doubt;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(iii)&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;and/or if we are not satisfied that you have obtained the necessary rights or permissions to post such content, pictures or photographs.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>If you suspect a breach of any third party&rsquo;s Intellectual Property Rights, including but not limited to copyright, on the Website, please send us a message at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\"><span>info@rayofhope.sg</span><span>.</span></a></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other than in relation to your own Fundraising Page, you may not remove or change anything on the Website. In addition, you must not:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; misrepresent your identity or affiliation with any other person or organisation;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; use the Website to send junk email or \"spam\" to people who do not wish to receive email from you; and</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(iii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;use the Website to conduct, display or forward surveys, raffles, lotteries, contests, pyramid schemes or chain letters.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI reserves the right to cancel your User Account and/or delete any Fundraising Page without notice in the event of :</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a breach by you of any of these Terms; or</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for any or no reason whatsoever, at ROHI&rsquo;s absolute discretion.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You must not:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; reproduce or make any copies of the Website and/or any Contents in or on the Website, in whole or in part, including any software therein, except with the prior written consent of ROHI</span><span lang=\"EN-SG\">;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; use the Website to facilitate or participate in any illegal activity or engage in any activity that ROHI, in its absolute discretion, considers to be inappropriate;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; modify, adapt, translate, sell, reverse engineer, decompile or disassemble any portion of the Website or attempt to do the same;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">remove, circumvent, disable, damage or otherwise interfere with security-related features of the Website, including but not limited to&nbsp;</span><span>attempting to bypass the network firewall or any features that:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">are designed to verify the identity of a user;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">prevent or restrict the access to or use of any particular functionalities of the Website;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(iii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">prevent or restricts the access to, use of, or the copying of any Content that is made available or accessible through the Website</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(e)&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; access or use any part of the Website which you are not authorized to use or devise ways to circumvent security in order to access part of the Website which you are not authorized to access. This includes but is not limited to scanning networks with the intent to breach and/or evaluate security, whether or not the intrusion results in access to such parts of the Website which you are not authorized to access or use;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; delete any trade marks, signs, logos, trade names used by ROHI,&nbsp;&nbsp;and/or other proprietary rights notices that is/are displayed on the Website therein;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">use the Website for any purpose that is unlawful or prohibited by these Terms or by Applicable Laws;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">use the Website in any manner that could damage, disable, overburden, or impair the operation of the Website provided therein, or interfere with any other persons\" access to and use of the Website;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">use any device, software or routine, including, but not limited to, any viruses, trojan horses, worms, time bombs or cancel bots intended to damage or interfere with the proper working of the Website provided therein and/or to intercept or expropriate any Content, system, data or personal data from the Website; and/or</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang=\"EN-SG\">transmit any Content of any type that : (1) infringes or violates any rights of any party; (2) is false, racist, offensive, defamatory, inaccurate, misleading or fraudulent; and/or (3) violates any Applicable Laws.&nbsp;While&nbsp;</span><span>we do not actively edit or monitor the Website, we reserve the right to remove or edit any Content posted on the Website at our sole discretion and without notice. If you notice any such Content on the Website, please send us a message at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\"><span>info@rayofhope.sg</span><span>.</span></a></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>4.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ROHI reserves the right to immediately and indefinitely restrict your access to and use of the Website in any way considered reasonably necessary if it suspects that you are engaging in any of the above behaviours set out above in Clause 4.2(b) and Clause 4.4.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>USE OF THE FUNDRAISING PLATFORM</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>5.1.&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI provides the Fundraising Platform to allow users to create Fundraising Pages where they can post fundraising campaigns to help raise funds for deserving cases in Singapore. All Users must comply with the following when using the Fundraising Platform:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users are not allowed to create a personal Fundraising Page on the Website to collect donations for themselves;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users shall be responsible for ensuring that all Fundraising Pages and campaigns created comply with any and all Applicable Laws;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users are not allowed to create Fundraising Pages for purposes connected wholly or partly with persons, events or objects outside Singapore; and</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Users must seek and obtain the permission of the relevant beneficiary and/or his/her family before creating a Fundraising Page and fundraising campaign on the Website on the beneficiary&rsquo;s and/or his/her family&rsquo; behalf. Such consent and permission shall include: (i) authorization for ROHI to collect donations on the beneficiary&rsquo;s and/or his/her family&rsquo;s behalf; and (ii) the beneficiary&rsquo;s and/or his/her family&rsquo;s consent to ROHI collecting, using and disclosing their personal data for the purpose of verifying the legitimacy of the fundraising campaign and case, and for the purpose of posting information, including their photographs, relating to their situation on the Fundraising Page and Website. In this regard, users shall provide documentary evidence of such consent and permission upon request by ROHI.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;While the list below is not exhaustive, the following campaigns are not allowed to be listed on ROHI&rsquo;s Website:</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;campaigns containing pornographic, sexual content, adult services of any kind;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;campaigns associated with or involving terrorist or hate group activities;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;campaigns related to drug abuse, underage tobacco and alcohol consumption;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;campaigns related to gambling, betting, lottery or raffle;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;campaigns containing hurtful, graphic, racist, sexist or any harmful content; and/or</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;campaigns involving any damage or hurt to human or animals.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI disapproves of, and does not wish to be involved in, dangerous sports or unusual challenges. It is your responsibility to check with ROHI to ensure that that your chosen fundraising activity does not contravene ROHI&rsquo;s policies. We reserve the right, at our absolute discretion and without notice, to remove your Fundraising Page when we deem your fundraising activity inappropriate or unnecessarily dangerous.</span></p>\r\n<p class=\"MsoNormal\"><span>5.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI takes reasonable measures to ensure that there is donor accountability. Fundraising Pages, fundraising campaigns and cases created through the Fundraising Platform and posted by users will appear in red boxes and be classified as &ldquo;not verified&rdquo; while our ROHI Case Managers carry out the process of verifying the facts of the fundraising campaigns and cases.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Unverified fundraising campaigns and cases will appear in such red boxes until ROHI Case Managers have sighted all relevant documents and reports and/or met the recipient and his/her family in person. Once our Case Managers have carried out all the necessary verification to ascertain the legitimacy and veracity of the fundraising campaigns or cases, the relevant fundraising campaign or case posted online will then turn green and be classified &ldquo;verified&rdquo;.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fundraising campaigns and cases which remain unverified for a period of 7 days&nbsp;and/or which do not pass our due diligence processes will be taken down and removed from the Website.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI reserves the right to take down and remove any Fundraising Pages, fundraising campaigns and cases from the Website at its sole and absolute discretion and without any obligation to account to the relevant user who created the relevant Fundraising Page and posted the relevant fundraising campaign and case.&nbsp;&nbsp;[In such event, all donations collected on behalf of the relevant beneficiary and/or his/her family&rsquo;s behalf as at the date of removal of the Fundraising Page, fundraising campaign or case will, at ROHI&rsquo;s option and sole discretion, be transferred to the relevant beneficiary and/or his/her family or redirected to other fundraising campaigns and cases.&nbsp;&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>5.8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI may from time to time issue Guidelines relating to the use of the Fundraising Platform and/or relating to the creation of Fundraising Pages and posting of fundraising campaigns and cases. All use of the Fundraising Platform and the creation of Fundraising Pages and posting of fundraising campaigns and cases shall be subject to these Terms and such Guidelines which may be issued by ROHI from time to time.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>MAKING DONATIONS</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>6.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You may make donations to ROHI through the Website. In doing so, these Terms (comprising both the General Terms and the Donation Terms) represent the agreement entered into between you and ROHI concerning the donation made by you to ROHI. By making a donation with ROHI, you are declaring that you have read, understood and agree to accept and be bound by and comply with these Terms and that any donations you make is compliant with Applicable Laws.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>6.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI provides the Donation Platform to allow users to donate to a fundraising campaign and case of their choice&nbsp;[or to other fundraising campaigns in the Website as ROHI deems fit in general. Donations can be made through the Donation Platform through the following methods:</span></p>\r\n<p class=\"MsoNormal\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../../../donate.php?sta=cases\" target=\"_blank\">&nbsp;Donating to individual cases;&nbsp;</a></p>\r\n<p class=\"MsoNormal\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../../../donate.php?sta=monthly\" target=\"_blank\">&nbsp;Donating monthly;</a></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href=\"../../../donate.php?sta=one_time\" target=\"_blank\"><span>One-time donation</span><span>;</span></a></p>\r\n<p class=\"MsoNormal\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../../../donate.php?sta=honor\" target=\"_blank\">Make a gift donation </a>in honor of someone\'s special occasion - Weddings, birthdays, anniversaries or the birth of a child;</p>\r\n<p class=\"MsoNormal\">(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"../../../donate.php?sta=memory_gift_one_time\" target=\"_blank\">&nbsp;</a><a href=\"../../../donate.php?sta=memory_gift_one_time\" target=\"_blank\">Memorial gift </a>&ndash; gifts donated in memory of someone special.</p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>6.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You must be 18 years of age or older to make a donation.&nbsp;&nbsp;If you are not, do not access and use the Website to make a donation without the consent, permission and/or supervision of your parent and/or guardian.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>6.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We do not store your credit card or debit card details. We utilize MC Payment as our merchant facility. For recurring donations, we use the services of MC Payment which stores your credit card or debit card data. We provide no warranty as to the safety or security of MC Payment&rsquo;s payment and merchant facilities.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>6.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unless otherwise expressly stated herein, all donations are strictly non-refundable and you hereby agree to the same.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>DISCLAIMER OF WARRANTIES AND LIABILITY</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>7.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You acknowledge and agree that the Website (including all Contents and cases (whether verified or unverified) therein) are provided on an &ldquo;as is,&rdquo; &ldquo;as available&rdquo; basis without warranties of any kind, whether expressed or implied, including but not limited to, warranties of title, merchantability, satisfactory quality, fitness for a particular purpose or non-infringement. Without limiting the generality of the foregoing, ROHI expressly disclaims any warranty, condition, guarantee, term or representation as to the reliability, accuracy, completeness, and validity of any Content on the Website, including but not limited to any cases (whether verified or unverified) and/or any information,&nbsp;&nbsp;content or material relating to ROHI, and ROHI does not provide any warranty, condition, term or representation that the functionalities and features available on the Website will be secure, uninterrupted or error-free, or that any defects will be corrected. Any and all such warranties, conditions, terms and representations are specifically excluded.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>7.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI assumes no responsibility for errors or omissions in the Content on the Website, including but not limited to any cases (whether verified or unverified) and/or any information, content or material relating to ROHI, including factual or other inaccuracies or typographical errors. You wholly assume all risks in your access and use of the Website. Hence, ROHI does not warrant, and excludes all liability in respect of:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the accuracy, completeness, fitness for purpose or legality of any information published by ROHI through the Website, or that is communicated to you relating to the Website and/or any cases (whether verified or unverified);</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the Website (including any Contents therein) in respect of their quality, usability, fitness for purpose or any other aspect thereof; and</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;any of the information, data, materials or facilities contained or incorporated in or on the Website, and/or the accuracy of the same.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>7.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI, and any third parties (as the case may be) who make their software available in conjunction with or through the Website disclaim any warranties regarding security, reliability, timeliness, and performance of the Website. You further understand and agree that your access and use of the Website is at your own discretion and risk and that you will be solely responsible for any loss or damages to yourself, to your mobile device system or computer or loss of data that results from your access and use of the Website.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>7.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI does not guarantee, represent or warrant that:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the Website will be free from viruses or error free;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;that you will be able to access the Website or that&nbsp;access to the Website will be uninterrupted;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;that the Website and any Content contained therein will meet your requirements or be fit for your purposes, whether or not such requirements or purposes have been informed to ROHI or otherwise; and/or</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;any information provided via the Website is accurate.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>7.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You acknowledge that your access and use of the Website presents the possibility of human and machine errors, inaccuracies, omissions, delays, and losses, including the inadvertent loss of data which may give rise to loss or damage suffered by you, and you agree and undertake that you shall not hold ROHI liable in any way whatsoever for the said loss or damage.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>7.6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">To the extent permitted by law, you agree that ROHI shall not be liable to you in contract, tort (including negligence or breach of statutory duty) or otherwise howsoever and whatever the cause thereof, for any:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">loss of your data whatsoever;&nbsp;or</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;indirect, consequential, collateral, special or incidental loss or damage suffered or incurred by you in connection with your use of the Website or your donations through the Website. For the purposes of this clause, indirect or consequential loss or damage includes, without limitation, loss of existing or anticipated revenue or profits, anticipated savings or business, loss of data or goodwill, business interruption, loss of use or value of any equipment including software, claims of third parties, and all associated and incidental costs and expenses.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">7.7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where ROHI&rsquo;s liability is not expressly excluded under these Terms or under any Applicable Laws, ROHI&rsquo;s liability to you in contract, tort (including negligence) or otherwise howsoever and whatever the cause thereof, arising by reason of or in connection with these Terms and/or the Website (including the Contents therein), shall be limited to the aggregate sum of $1000.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>WARRANTIES</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>8.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You warrant that all information and Content provided by you to ROHI, including on any personal Fundraising Page:</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;is/are true and correct;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;is/are not misleading or deceptive, defamatory or obscene;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;does/do not infringe a third party\'s Intellectual Property Rights; and</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;can be lawfully published by ROHI.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>8.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You will indemnify and keep ROHI indemnified against all claims, costs, expenses, damages, liability or loss arising in relation to a breach of any of the above warranties.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>INTELLECTUAL PROPERTY</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You acknowledge that ROHI or third parties (as the case may be) own all rights, title and interest in and to the Website and/or the Content except for the Content that was provided by you to ROHI) and/or Intellectual Property Rights in the Website, including without limitation software relating thereto, and you shall not do or permit any act which is directly or indirectly likely to prejudice the rights, title or interest of the said rightful owner(s) in and to any of the aforesaid. Unless otherwise expressly permitted by mandatory Applicable Laws, you agree not to modify, adapt, translate, prepare derivative works from, or decompile, reverse engineer, disassemble or otherwise attempt to derive source code from the Website. Without prejudice to the generality of the foregoing, you shall not use in any way and shall not reproduce any Content except for the Content that was provided by you to ROHI) contained in the Website and/ or trademarks that are associated with ROHI and/or that you have sight of when accessing and using the Website without our prior written approval.&nbsp;</span><span>Inquiries and permission requests may be submitted to&nbsp;</span><span><a href=\"mailto:info@rayofhope.sg\">i</a><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">nfo@rayofhope.sg</a></span><span><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">.</a></span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI hereby grants to you a limited personal, non-sub-licensable, non-transferable, revocable, terminable and non-exclusive license to access and use the Website (the &ldquo;<strong>Licence</strong>&rdquo;). The grant of this Licence does not constitute a transfer or sale of the Website or any copy thereof, and ROHI retains all right, title, and interest in and to the Website, including any software or any Intellectual Property Rights therein.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You undertake that you shall not use and you shall not allow the use of, any of the trademarks that are associated with ROHI and/or that you have sight of when accessing and using the Website, in any of the following ways:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>as part of any corporate or legal business name, which you are connected with, involved in or participating in;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>in connection with any of your services or activities;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>as part of any domain name, homepage, electronic address, metatag, or otherwise in connection with the Internet or a website, except with the prior written consent of ROHI; and</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span>with any prefix, suffix, or other modifying words, terms, designs, or symbols.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You agree and undertake that:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;all rights, title, interest and any goodwill in any of the trademarks that are associated with ROHI and/or that you have sight of when accessing and using the Website, or any derivatives thereof, belong exclusively and wholly to ROHI and that you shall not under any circumstances gain any right to or interest or goodwill in any of the trademarks that are associated with ROHI and/or that you have sight of when accessing and using the Website or any derivatives thereof independently of ROHI; and</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;you shall not register domain names associated with or including the any of the trademarks that are associated with ROHI and/or that you have sight of when accessing and using the Website, or any derivatives thereof, or any name that is confusingly similar to any of them including any visual or phonetic&nbsp;</span><span>equivalent</span><span lang=\"EN-SG\">&nbsp;or other derivation thereof (hereinafter referred to as &ldquo;<strong>Domain Names</strong>&rdquo;) and that ROHI shall retain at all times all legal and beneficial rights, title and interest in the Domain Names.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You hereby grant to ROHI a worldwide, non-exclusive, irrevocable, perpetual, sub-licensable and royalty-free licence to use, disclose, publish, communicate to the public, adapt, modify, process, host, reproduce and deal in&nbsp;any content, information, materials, Intellectual Property Rights and/or data that you upload, post on the Website and/or provide to ROHI, in any way whatsoever as determined by ROHI in its absolute discretion, for:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the purpose of and/or in any campaigns and cases, whether now or in the future; and/or</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the business and/or operations of ROHI.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">This licence survives termination of this agreement without limit in point in time.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">9.6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You represent and warrant to ROHI that:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;you have the right to grant the licence at Clause 9.5;&nbsp;&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;your uploading and posting of such content, information, materials, Intellectual Property Rights and/or data on the Website, and/or the provision of the same to ROHI and ROHI&rsquo;s subsequent use of and dealings with such content, information, materials, Intellectual Property Rights and/or data pursuant to the licence under Clause 9.5, does and will not infringe any third-party rights, including but not limited to Intellectual Property Rights of any third party.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>10.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>REMOVAL OF CONTENT</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>10.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All Fundraising Pages must not incorporate any content that ROHI, in its absolute discretion, considers is inappropriate for inclusion on the Website. ROHI may, but is obliged to, discuss with you prior to removing all or any part of the content on any Fundraising Page. In any case, ROHI reserves the absolute right to remove any of your content including your Fundraising Pages, at any time, for any or no reason whatsoever, without consultation. ROHI also reserves the right to prohibit fundraisers who breach these Terms from using the Website in the future.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>10.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If there are any questionable campaigns that require intervention of government or regulatory bodies, ROHI will/may work with such bodies to take reasonable actions pertaining to such campaigns. If you are aware of any questionable campaign on the Website or of any violations of these Terms, you can it by email to&nbsp;</span><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\"><span>info@rayofhope.sg</span></a><span>&nbsp;or call +65 6705 1912.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>11.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><strong><span lang=\"EN-SG\">PERSONAL DATA PROTECTION</span></strong></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\">11.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You agree that ROHI may collect, use, disclose and/or process your personal data, as set out in our Privacy Policy, which can be accessed at <a href=\"../../../page/Mw==\" target=\"_blank\"><span style=\"text-decoration: underline;\"><span>ROHI Privacy Policy</span></span>.</a> You acknowledge that you have read and agree to our said Privacy Policy.</p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>11.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You acknowledge and agree that your personal data may also be disclosed to our cases, third party beneficiaries of your donations&nbsp;(unless you expressly notify us not to disclose your identity to such third party beneficiaries), third party service providers, agents and/or affiliates or related corporations, and/or other third parties, whether sited in Singapore or outside of Singapore, for one or more of the purposes set out in our Privacy Policy.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">11.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You&nbsp;</span><span>represent</span><span lang=\"EN-SG\">&nbsp;and warrant that:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for personal data of any third-party individuals that you disclose to ROHI or that you disclose to ROHI in the course of accessing and using your User Account (if applicable) and/or accessing and using the Website, that you would have prior to disclosing such personal data to ROHI obtained consent from the individuals whose personal data are being disclosed, to:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;permit you to disclose the individuals&rsquo; personal data to ROHI for the purposes as set out in ROHI&rsquo;s Privacy Policy (which can be viewed at </span><span style=\"text-decoration: underline;\"><span lang=\"EN-SG\"><a href=\"../../../page/Mw==\" target=\"_blank\">ROHI Privacy Policy</a></span></span><span lang=\"EN-SG\">); and</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; permit ROHI to collect, use, disclose and/or process the individuals&rsquo; personal data for the purposes as set out in ROHI&rsquo;s Privacy Policy, including&nbsp;</span><span>disclosing</span><span lang=\"EN-SG\">&nbsp;the said personal data to ROHI&rsquo;s third party service providers or agents, which may be sited outside of Singapore, for the purposes as set out in ROHI&rsquo;s Privacy Policy and such third-party service providers or agents of ROHI processing their personal data for the purposes as set out in ROHI&rsquo;s Privacy Policy;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;any personal data of individuals that you will be or are disclosing to ROHI are accurate; and</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for any personal data of individuals that you disclose to ROHI, that you are validly acting on behalf of such individuals and that you have the authority of such individuals to provide their personal data to ROHI and for ROHI, its third-party services providers and agents to collect, use, disclose and process such personal data for the purposes as set out in ROHI&rsquo;s Privacy Policy.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>12.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>COMPLAINTS</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>12.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI will handle all complaints received in accordance with&nbsp;our complaints resolution procedure, details which can be obtained by visiting the \"</span><span style=\"text-decoration: underline;\"><span><a href=\"../../../about_us/Nw==\" target=\"_blank\">Contact Us</a></span></span><span>\" section of the Website.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>13.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>INDEMNITY</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>13.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You agree to defend, indemnify and hold harmless ROHI, its subsidiaries and affiliated companies, and their officers, directors, employees, contractors and agents from and against any and all claims, causes of action, damages, obligations, losses, liabilities, costs or debt, and expenses (including solicitors&rsquo; fees and costs) including all amounts paid in settlement, arising out of, related to or in connection with your breach of these Terms, your access or use of the Website, your use of your User Account (if applicable) and/or your failure to comply with any Applicable Laws. ROHI may assume the exclusive defense and control of any matter for which you have agreed to indemnify ROHI and you agree to assist and cooperate with ROHI in the defense or settlement of any such matters.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>14.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ALTERATION OF THE WEBSITE AND TERMINATION OF USER ACCOUNT AND TERMINATION OF THE LICENCE</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>14.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI may amend or modify all or part of the Website (including any of its Contents) at any time.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>14.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span lang=\"EN-SG\">ROHI has the right to and you acknowledge that ROHI can:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;withdraw any information, data or content forming a part of the Website; or</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;immediately suspend, withdraw or terminate:</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; your User Account (if applicable);</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;your access and use of the Website; and/or</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">(iii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the Licence,</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">at any time, without liability and without notice to you or any third party, for any or no reason whatsoever. You shall not hold ROHI liable in any way whatsoever for any of the aforesaid. Without limiting the generality of the foregoing, in the event that your access and/or use of your User Account and/or the Website is in breach of these Terms, ROHI has the right to immediately terminate your User Account (if applicable), your access and use of the Website, and/or remove any Fundraising Pages created by you, without notice and take all such action as it considers appropriate, desirable or necessary including but not limited to taking legal action against you.</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span lang=\"EN-SG\">14.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any&nbsp;</span><span>termination</span><span lang=\"EN-SG\">&nbsp;or suspension of your User Account (if applicable) shall not entitle you to receive any compensation in respect of the termination.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>15.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>GOVERNING LAW AND DISPUTE RESOLUTION</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>15.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;These Terms, and/or the agreement entered into with you for your access or use of the Website, are governed by and shall be construed in accordance with the laws of Singapore.&nbsp;&nbsp;Any dispute arising out of or in connection with these Terms and/or the said agreement, including any question regarding its existence, validity or termination, shall be referred to and finally resolved by arbitration administered by the Singapore International Arbitration Centre (&ldquo;SIAC&rdquo;) in accordance with the Arbitration Rules of the Singapore International Arbitration Centre (\"SIAC Rules\") for the time being in force, which rules are deemed to be incorporated by reference in this clause. The seat of the arbitration shall be Singapore. The Tribunal shall consist of one (1) arbitrator. The language of the arbitration shall be English.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>15.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For the purpose of enforcing this Agreement and notwithstanding Clause 15.1,&nbsp;ROHI has absolute discretion to&nbsp;seek equitable relief from a court of competent jurisdiction, as it may choose, without first attempting to resolve a dispute under Clause 15.1 and you hereby submit to the jurisdiction of the court which ROHI may seek relief from under this subclause. For the avoidance of doubt, the right under this subclause is only extended to ROHI and not to you.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>16.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LINKS TO THIRD PARTY CONTENT</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>16.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nothing in or on the Website shall be considered an endorsement, representation or warranty of or by ROHI with respect to any third party or any third party\'s websites, content, products, services or otherwise. Without limiting the generality of the foregoing, the foregoing applies to any advertising content whether paid or unpaid, as well as links that may be provided in the Website or the contents available and accessible through the Website. Such links (if any) are provided solely as a convenience to you. You use such links to access third party content, websites or applications at your own risk. ROHI makes no representations or guarantees regarding the availability or content (including its truthfulness, accuracy, completeness, timeliness or reliability) of such third-party content, websites or applications in respect of which links have been provided in the Website, nor with regard to broken links. Your relationship and any transactions with other organizations through their websites or otherwise are your own responsibility.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>16.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All Intellectual Property Rights to any and all such third-party content, websites or applications accessible through links contained on the Website belong to their respective owners. ROHI does not claim to have any rights over the same and in no circumstances, shall ROHI be considered to be associated or affiliated in whatever manner with any such Intellectual Property Rights used or appearing on any and all such third-party content, websites or applications accessible through links contained on the Website.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>17.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LINKS TO THIS WEBSITE</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>17.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Except as expressly set forth at clause 17.2, caching and links to (including deep linking), and the framing of the Website and/or any of the web pages therein are prohibited.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>17.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Linking to the home page: You may link to the home page of the Website,&nbsp;provided you notify ROHI in writing before you do so and provided always that ROHI may at any time object to such linking and if ROHI so objects, you must immediately remove such link.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>17.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Under no circumstances shall ROHI be considered to be associated or affiliated in whatever manner with any Intellectual Property Rights used or appearing on websites that link to the Website and/or any of the web pages therein. ROHI reserves the right to disable any unauthorized links or frames and disclaims any responsibility for the content available on any other website that links to the Website.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>18.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>MISCELLANEOUS</strong></span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><span>18.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI accepts no liability for any failure to comply with these Terms where such failure is due to circumstances beyond ROHI&rsquo;s reasonable control. &nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If any provision of these Terms (or parts of any provision) is held to be invalid, unenforceable or illegal for any reason, the remaining provisions of these Terms (or the remaining parts of that provision) shall nevertheless continue in full force. If a competent court or arbitral tribunal holds any part of these Terms to be unenforceable as drafted, we may replace those terms with similar terms to the extent enforceable under applicable laws and regulations, without changing the remaining terms of these Terms.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;These&nbsp;Terms are the entire agreement between you and ROHI in relation to your access and use of the Website and/or any donations made by you to ROHI through the Website and shall supersede all previous communications (whether written, oral or otherwise), discussions or letters relating to the same.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No delay in enforcing any provision of these Terms will be construed to be a waiver of any rights under that provision.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The rights to access and use your User Account (if applicable) and/or this Website is personal to you, and you may not transfer or assign to a third party any of your rights and obligations as defined in these Terms. ROHI may freely assign, transfer or sub-contract these Terms or our rights and obligations under these Terms, in whole or in part, without your prior consent or prior notice to you.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;These Terms are entered into between you and ROHI. For the avoidance of doubt, except as expressly stated in these Terms, a person who is not a party to this Terms shall have no right under the Contracts (Rights of Third Parties) Act (Cap. 53B) to enforce any of the terms of these Terms.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>18.7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You agree that no joint venture, partnership, employment, or agency relationship will exist between you and ROHI as a result of these Terms.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>19.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>CONTACT&nbsp;AND NOTICE</strong></span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>19.1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For questions related to these Terms of Use, please get in touch with us at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\"><span>info@rayofhope.sg</span></a><span>&nbsp;or call +65 6705 1912.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>19.2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any notice that ROHI intends to give to you may be carried out by posting the relevant notice on the Website and/or by sending any such notice to any contact information you may have provided ROHI with. You are deemed to have received notice of the same upon ROHI posting the relevant notice on the Website and/or by sending any such notice to any contact information you may have provided ROHI with.</span></p>\r\n<p class=\"MsoNormal\"><strong><span>&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\"><strong></strong>These Donation Terms apply separately to each donation that you make. By confirming on the Website that you wish to make a donation you agree to be bound by these Donation Terms for that donation and for each recurring donation in the case of recurring donations.</p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>20.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You acknowledge and agree to the following:</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All donations are non-refundable.&nbsp;However, if you have made an error in your donation, please notify your card provider immediately. We will consider authorizing a refund in exceptional circumstances, but we reserve the right to apply a fee for the refund before such a refund is processed. Subject to the aforesaid, we will only consider your request for a refund if your request reaches us within 1 hour from your donation. Please contact us at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\"><span style=\"text-decoration: underline;\"><span>info@rayofhope.sg</span></span></a><span>&nbsp;for requests for refund.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your transaction to make a donation on the Website will be processed through our third-party payment services provider, MC Payment. By confirming that you wish to proceed with your donation you hereby authorize MC Payment to request funds from your credit card or debit card provider.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any donations made through the Website using a credit card or debit card are final. If you become aware that your credit card or debit card has been lost, stolen or is being used fraudulently, it is your responsibility to report the issue to your financial institution. We may, at our absolute discretion, refund the donation where we have investigated and are satisfied that the donation was unauthorized by you and that you (or anyone authorized by you) have not acted fraudulently or carelessly. We reserve the right to apply a fee to process such a refund.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;These Terms will apply to successive donations made through the Website where you have set up a recurring donation. When you set up a recurring donation you will be scheduling a series of donations to be made on a specific day of the month that you choose, on a monthly basis, until you cancel the recurring donation. You agree that these Terms will apply to each of the donations in that series. By confirming that you wish to proceed with a recurring donation you authorize our payment service provider MC Payment to request funds from your credit card or debit card on the day of each month that you have stipulated through your application on the Website. To cancel your recurring donation, please contact us at&nbsp;</span><a href=\"mailto:info@rayofhope.sg\"><span style=\"text-decoration: underline;\"><span>info@rayofhope.sg</span></span></a><span>.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All donations are at your own risk.&nbsp;&nbsp;Accordingly, please make sure that when you donate to a case or beneficiary, you understand how the donations will be used.&nbsp;&nbsp;ROHI is not responsible for any misuse of the funds by the beneficiary or his/her family.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We will use reasonable endeavors to channel your donations to a fundraising campaign and case of your choice or interest, if so indicated by you. In the event that the total donations received for a fundraising campaign and case exceeds what is required, you agree and authorize ROHI&nbsp;to redirect your donation to other fundraising campaigns and cases at ROHI.</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>In the event that you choose to donate to red and &ldquo;unverified&rdquo; cases before the cases are verified and the cases do not pass our ROHI due diligence process or remains unverified for a period of 7 days, the cases will be taken down from ROHI website.&nbsp;&nbsp;In such event, you agree and authorize ROHI to redirect any amounts donated to unverified cases to other fundraising campaign(s) and case(s) on the Website, at ROHI&rsquo;s sole and absolute discretion.&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>&nbsp;</span></p>\r\n<p class=\"MsoNormal\"><span>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If you have requested for your donation to be made to a specific case or beneficiary, and we are unable to disburse donations to the beneficiary or recipient within a reasonable amount of time&nbsp;due to incorrect or insufficiently supplied details, we will try to contact the beneficiary or recipient to obtain the required information. If we are unable to find or contact the beneficiary or recipient and/or he/she does not respond to our inquiries within a reasonable period of time, you agree and authorize&nbsp;ROHI to disburse your donated funds to other fundraising campaigns and cases on the Website at ROHI&rsquo;s absolute discretion. If the beneficiary or recipient contacts us after the funds have been&nbsp;redirected to another case of ROHI&rsquo;s option, you agree that your donation will be deemed disbursed in accordance with your specified purpose, and we will not&nbsp;be required to disburse any funds to such beneficiary or recipient. Keeping your personal contact details up-to-date is the best way to ensure donations are directed to where you want them to go should we need to contact you for further details on the beneficiary or recipient.</span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>\r\n<p class=\"MsoNormal\"><span>21.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROHI reserves the right to amend or supplement these Donation Terms from time to time at its sole discretion by posting revisions or a revised/amended set of the Terms and/or Donation Terms on the Website. Any donations made to ROHI through the Website following the posting of any changes or modifications will constitute your acceptance of such changes, modifications, supplements or of such modified Donation Terms.</span></p>', '4', '1', '2015-11-25 03:46:52', '2017-09-12 10:56:59');
INSERT INTO `contents` (`id`, `title`, `description`, `position`, `status`, `created`, `modified`) VALUES
(6, 'FAQs', '<p><span style=\"font-size: small;\"><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><strong><span style=\"font-family: verdana, geneva;\">1. Who is ROHI? What does ROHI do?</span></strong></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">The Ray of Hope Initiative Limited (ROHI) is a non-profit organisation founded in November 2012. ROHI is dedicated to helping deserving individuals and families living within our community who are going through hardship, who have a genuine need for help and may otherwise have no access to assistance. ROHI aims to build a society where the people in our community help one another; as a positive giving experience cultivates a greater sense of individual responsibility, leading to stronger social cohesion within our community.</span></span></span></p>\r\n<p><em><strong><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">100% of all your donations goes to our beneficiaries.</span></span></span></strong></em></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></span></p>\r\n<p><span style=\"color: #008080; font-size: small; font-weight: bold;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">2. What is ROHI\'s mission and vision?</span></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><strong><em>ROHI Vision </em></strong>= To build a trusted platform, incorporating casework and counselling as well as programmes for the people in our community to help one another, as a positive giving experience cultivates a greater sense of individual responsibility, leading to stronger social cohesion within our community.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><strong><em>ROHI Mission Statement</em></strong> = To help donors and volunteers in our community help those who have fallen through the cracks.</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></span></p>\r\n<p><span style=\"color: #008080; font-size: small; font-weight: bold;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">3. What makes ROHI different to other charitable organisations? Why donate through ROHI?</span></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI is different because there is:</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">1)<em> <strong>Donor accountability</strong></em> - All donations are collected by ROHI. we perform due diligence before donations are disbursed.</span></span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\">2)<strong><em> Structured and responsible disbursement of funds</em></strong> - We work closely with all our recipients to estimate their income and living expenses, debt, medical bills et cetera before funds are raised. &nbsp;Disbursements are then made in installments, sometimes in the form of vouchers to&nbsp;</span></span><span style=\"font-size: medium;\">ensure that the money is used appropriately.&nbsp;</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">3) <strong><em><strong><em>Personal touch for givin</em></strong>g</em></strong> - Donations are disbursed directly to the individual or family and not to a general pool. Donors receive continuous and timely updates on our beneficiaries\' progress.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium; color: #008080; font-weight: bold;\"><span style=\"font-family: verdana, geneva;\">4. What are ROHI\'s core values?</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">1)<strong><em> Accountability &amp; Transparency</em></strong> - We collect, administer and disburse donations in an honest and transparent manner.</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">2) <strong><em>Fairness and respect</em></strong> - We help all who need help, regardless of race, language, religion or social status. We must always be neutral and unbiased regardless of our own personal views.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">3) <strong><em>Communication</em></strong> - To share our decision-making process, give timely and unbiased updates on cases, be open to feedback, and ensure we maintain an efficient and effective platform for our donors</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">4) <strong><em>Maximise Social Impact</em></strong> - Through innovation, partnerships and prudent resource allocation, we ensure that every dollar donated achieves optimal results.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></span></p>\r\n<p><span style=\"color: #008080; font-weight: bold; font-size: small;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">5. How does ROHI get its funding?</span></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">100% of all donations goes out to our beneficiaries. The operating costs for running ROHI are administered separately. We are very much dependent on the support of our generous donors, to help keep us going!</span></span></span></p>\r\n<p><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></span></span></p>\r\n<p><strong><span style=\"font-size: small;\"><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">6. Who does ROHI work with?</span></span></span></span></span></strong></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We work with other non-profit organisations, companies, schools, public sector bodies and individuals.&nbsp;</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #008080; font-family: verdana, geneva; font-size: medium; font-weight: bold;\">7.&nbsp; Who does ROHI help raise funds for?</span></p>\r\n<p><span style=\"font-size: medium;\">We raise funds for families in need, the elderly, children, and those who need assistance with their medical bills. We are unable to support animals that have a need for help at the moment.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #008080; font-family: verdana, geneva; font-size: medium; font-weight: bold;\">8. Is my contribution tax deductible?&nbsp;</span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">No, ROHI is a non-profit organisation (Registration number 201229333H) and not a registered Charity. We are however, working towards becoming a Charity.</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></span></p>\r\n<p><span style=\"font-size: small;\"><strong><span style=\"color: #008080;\"><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">9. What are the various ways to give?&nbsp;</span></span></span></span></strong></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">You can contribute by:</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">1)<strong> Donating</strong></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">a.<a title=\"Donating to individual case\" href=\"../../../donate.php?sta=cases\" target=\"_blank\"> Donating to individual cases&nbsp;</a></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">b.<a href=\"../../../donate.php?sta=monthly\" target=\"_blank\"> Donating monthly</a></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">c. <a href=\"../../../donate.php?sta=one_time\" target=\"_blank\">One-time donation</a></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">d.<a href=\"../../donate.php?sta=honor\">&nbsp;</a><a title=\"Make a gift donation\" href=\"../../../donate.php?sta=honor\" target=\"_blank\">Make a gift donation</a>&nbsp;- Weddings, birthdays, anniversaries or the birth of a child are all special moments that can have special meaning. You can choose to make a donation in honor of someone\'s special occasion.&nbsp;&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">e.&nbsp;<a href=\"../../../donate.php?sta=memory_gift_one_time\" target=\"_blank\">Memorial gift&nbsp;</a>&nbsp;- Gifts donated in memory of a loved one are a wonderful way to honor and recognise their life.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">f.<a href=\"../../../donate.php?sta=workplace\" target=\"_blank\"> Workplace giving&nbsp;</a></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">g.&nbsp;<a title=\"Corporate matching gift\" href=\"../../../donate.php?sta=corporate\" target=\"_blank\">Corporate matching gift&nbsp;</a></span></span></span></p>\r\n<p><strong><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">2)<em> Fundraising</em></span></span></span></strong></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">a.<a href=\"../../../login.php?msg=pls_login&amp;after=add_case\" target=\"_blank\"> Help fundraise on behalf of someone&nbsp;</a></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">b. <a href=\"../../../login.php?msg=pls_login&amp;after=celebration\" target=\"_blank\">Pledge your happy occasion: birthday, wedding, graduation and anniversary&nbsp;</a>- Instead of a birthday present this year, or ang baos (red packets) for your wedding, why not ask your friends and family to make a donation to ROHI instead. &nbsp;More and more these days, people invite their guests to make a donation to benefit a cause instead of receiving gifts for special occasions. Turning your celebration into a chance to help others who are less-fortunate, will make it even more memorable for both you and your guests.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">c.<a href=\"../../../login.php?msg=pls_login&amp;type=funeral&amp;after=add_case\" target=\"_blank\"> Funeral collection&nbsp;</a>- Celebrate the life of your loved one by donating Funeral Collections in their memory. If you\'re arranging for a funeral, you may like to encourage friends and relatives to make a memorial contribution to ROHI. Many people have started to donate funeral collections to support causes they care about.&nbsp;&nbsp;</span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">d. <a href=\"../../../login.php?msg=pls_login&amp;type=event&amp;after=add_case\" target=\"_blank\">Organising a fundraising event </a>- You may want to do more than just donate to ROHI. You can host your own private fundraising event with friends, family and co-workers; it could be a movie night, sports match, giving up chocolate, or whatever takes your fancy. The possibilities are endless!</span></span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium; color: #008080; font-weight: bold;\"><span style=\"font-family: verdana, geneva;\">10. What does the Red Box with \'Pending\' mean and what does the Green box with \'Verified\' mean?</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">ROHI ensures that there is donor accountability. Green boxes means that ROHI case workers have contacted and verified that the case is a genuine need for help and the due diligence has been done. Red boxes means that ROHI case workers are still in the process of verifying the case and due diligence has not been carried out yet.&nbsp;</span></span></span></p>\r\n<p><span style=\"font-family: verdana, geneva;\"><br /></span></p>\r\n<p><span style=\"font-size: medium; color: #008080; font-weight: bold;\"><span style=\"font-family: verdana, geneva;\">11. What happens when donations raised for a beneficiary are exceeded?</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">If donations raised for a beneficiary are exceeded, excess funds will be channelled to help other ROHI beneficiaries whose targets are not met.</span></span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><strong><span style=\"font-family: verdana, geneva;\">12. Who can I fundraise for?</span></strong></span></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">You will be able to fundraise for anyone who is living in Singapore with a genuine need for help, however you are not allowed to fundraise for yourself. You must seek and obtain the permission of the relevant beneficiary and/or his/her family before creating a Fundraising Page and fundraising campaign on the Website on behalf of the beneficiary or on behalf of the beneficiary and/or his/her family.</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\"><br /></span></span></p>\r\n<p><span style=\"font-size: medium; color: #008080; font-weight: bold;\"><span style=\"font-family: verdana, geneva;\">13. Why am I directed to MC payment page for payment? Who is MC payment?</span></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-family: verdana, geneva;\"><strong></strong></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">MC payment was founded in Singapore in 2005, they are Asia\'s leading provider for electronic payment transactions. ROHI had chosen to support a Singapore company for it\'s online payment portal. MC payment website is at:&nbsp;<a href=\"http://mcpayment.com/\" target=\"_blank\">http://mcpayment.com/</a> </span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">For further questions, please contact us on: +65-6705 1912 0r email us at: <a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">info@rayofhope.sg</a>.</span>&nbsp;</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: medium;\"><span style=\"color: #008080;\"><strong><span style=\"font-family: verdana, geneva;\">14. Who stores your credit or debit card details?</span></strong></span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We do not store your credit card or debit card details. We utilise MC Payment as our merchant facility, therefore your payment details are stored with our merchant MC Payment. For recurring donations, we use the services of MC Payment which stores your credit card or debit card data.&nbsp;</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #407b7b; font-weight: bold; font-size: medium;\"><span style=\"font-family: verdana, geneva;\">15. How do I terminate my monthly recurring donation, and how long will the termination take to be processed?&nbsp;</span></span></p>\r\n<p><span style=\"font-size: medium;\"><span style=\"font-family: verdana, geneva;\">We will be sad to see you go, but should you decide to terminate your monthly recurring donation, please email info@rayofhope.sg<a href=\"http://mce_host/rohi.sg/cms/content/sharmin.foo@rayofhope.sg\"></a> and we will inform our payment portal MC Payment accordingly. You will receive an email confirming the termination of your monthly recurring donation within three working days.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"color: #25928b;\"><span style=\"color: #4aaab5;\"><span style=\"color: #4eb1a3;\"><span style=\"color: #4bb3a7;\"><span style=\"color: #59a69e;\"><span style=\"color: #639b84;\"><span style=\"color: #50af92;\"><span style=\"color: #5ca38e;\"><span style=\"font-family: verdana, geneva;\">16. Is my donation refundable?</span></span></span></span></span></span></span></span></span></strong></span></p>\r\n<p><span style=\"font-size: medium;\">Please note that all donations made are non-refundable.&nbsp;</span></p>\r\n<p><span style=\"font-size: medium;\"><br /></span></p>\r\n<p><span style=\"font-size: medium;\"><strong><span style=\"color: #4bafb3;\"><span style=\"color: #4aaab5;\"><span style=\"color: #51aeac;\"><span style=\"color: #4db1a3;\"><span style=\"color: #59a69e;\"><span style=\"color: #639b84;\"><span style=\"color: #639b84;\"><span style=\"color: #58a692;\"><span style=\"font-family: verdana, geneva;\">17. Does ROHI raise funds for foreign charitable appeals or foreigners not living or working in Singapore?</span></span></span></span></span></span></span></span></span></strong></span></p>\r\n<p><span style=\"font-size: small;\"><span style=\"font-size: medium;\">ROHI raises funds for those living in Singapore. Our vision is to build a trusted platform incorporating casework and counselling as well as programmes for the people in our community to help one another, as a positive giving experience cultivates a greater sense of individual responsibility, leading to stronger cohesion within our community.</span></span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2', '1', '2015-11-25 04:05:49', '2017-12-20 15:25:35'),
(8, 'Contact Us', '<p><span style=\"font-size: large;\"><span style=\"font-size: large;\"><img class=\"_1579 img\" src=\"https://www.facebook.com/rsrc.php/v3/ya/r/5gVwL52gDiR.png\" alt=\"\" />&nbsp;Call: +65<span style=\"white-space: pre;\">&nbsp;</span>6705 1912&nbsp;</span></span></p>\r\n<p><img class=\"_1579 img\" style=\"font-size: large;\" src=\"https://www.facebook.com/rsrc.php/v3/ya/r/5gVwL52gDiR.png\" alt=\"\" /><span style=\"font-size: large;\">&nbsp;Email</span><span style=\"white-space: pre;\">: </span><span style=\"font-size: large;\"><a href=\"mailto:info@rayofhope.sg\" target=\"_blank\">info@rayofhope.sg</a></span></p>\r\n<p><img class=\"_1579 img\" src=\"https://www.facebook.com/rsrc.php/v3/y2/r/6OwAR1nJwTa.png\" alt=\"\" /><span style=\"font-size: large;\">&nbsp;</span><span style=\"font-size: large;\">W</span><span style=\"font-size: large;\">ebsite:<span style=\"white-space: pre;\"> <a href=\"../../..//\" target=\"_blank\">www.rohi.sg</a></span></span></p>\r\n<div class=\"_4bl7 _3-90 _a8s\" style=\"text-align: left;\"><span style=\"font-size: large;\"><br /></span></div>\r\n<div class=\"_4bl7 _3-90 _a8s\" style=\"text-align: left;\"><span style=\"font-family: verdana,geneva;\"><span style=\"font-size: large;\">To find out more updates about the events of ROHI, you can \'like\' our Facebook page <a href=\"https://www.facebook.com/rayofhopeinitiative/\" target=\"_blank\">here.</a></span></span></div>', '5', '1', '2015-11-25 04:30:47', '2017-09-12 11:55:12'),
(11, 'Sitemap', '<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '6', '-1', '2015-11-28 02:47:11', '2017-02-07 19:08:58'),
(26, 'Who are we', '', '0', '-1', '2017-02-13 17:02:58', '2017-02-13 17:02:58'),
(27, 'A', '<p>A</p>', '0', '-1', '2017-08-23 11:26:38', '2017-08-23 11:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_tier`
--

CREATE TABLE `delivery_tier` (
  `id` int(11) NOT NULL,
  `region` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `tier` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `min_checkout_price` decimal(11,2) DEFAULT NULL,
  `max_checkout_price` decimal(11,2) DEFAULT NULL,
  `delivery_fee` decimal(11,2) DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `delivery_tier`
--

INSERT INTO `delivery_tier` (`id`, `region`, `location`, `area`, `tier`, `min_checkout_price`, `max_checkout_price`, `delivery_fee`, `position`, `status`, `created`, `modified`) VALUES
(1, 3, 4, 5, 'T1', '0.00', '100.00', '4.20', NULL, '1', '2020-08-26 11:29:54', '2020-08-28 16:07:16'),
(3, 3, 4, 5, 'T2', '100.00', '150.00', '6.00', NULL, '1', '2020-08-26 13:44:03', '2020-08-26 13:45:55'),
(4, 3, 4, 5, 'T3', '150.00', '200.00', '7.50', NULL, '1', '2020-08-26 13:45:35', '2020-08-29 14:41:52'),
(5, 3, 4, 5, 'T4', '200.00', '250.00', '9.30', NULL, '1', '2020-08-26 13:47:17', '2020-08-29 15:12:07'),
(6, 5, 5, 4, 'T6', '0.00', '11.00', '9.20', NULL, '1', '2020-09-01 10:44:44', '2020-09-01 11:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Jonathan Driver', 1, '2020-05-05 16:06:21', '2020-07-06 12:01:44'),
(2, 'Ali', 1, '2020-05-05 16:06:37', '2020-05-05 16:06:37'),
(5, 'Bobby', 1, '2020-07-09 12:35:14', '2020-07-09 12:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `email_notification`
--

CREATE TABLE `email_notification` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `notify_when_confirmed` varchar(3) DEFAULT NULL,
  `notify_when_accepted` varchar(3) DEFAULT NULL,
  `notify_when_receipt` varchar(3) DEFAULT NULL,
  `notify_when_delivered` varchar(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_notification`
--

INSERT INTO `email_notification` (`id`, `email`, `notify_when_confirmed`, `notify_when_accepted`, `notify_when_receipt`, `notify_when_delivered`, `created`, `modified`) VALUES
(1, 'jonathan.wphp@gmail.com', 'Yes', 'Yes', 'No', 'Yes', '2020-05-05 16:25:39', '2020-05-05 16:36:02'),
(2, 'jonathan.w121php@gmail.com', 'No', 'Yes', 'Yes', 'Yes', '2020-05-05 16:27:29', '2020-05-05 16:36:07'),
(3, 'jonathan@adssad.com', 'Yes', 'Yes', 'Yes', 'Yes', '2020-05-05 16:36:26', '2020-05-05 16:36:26'),
(4, 'daus.grocere@gmail.com', 'Yes', NULL, NULL, NULL, '2020-06-24 11:41:30', '2020-06-24 11:41:30'),
(6, 'vxprofessional@gmail.com', 'Yes', NULL, NULL, NULL, '2020-07-10 11:03:43', '2020-07-10 11:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `session` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `uom_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `product` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `uom` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `unit_price` decimal(11,2) DEFAULT NULL,
  `total_price` decimal(11,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `session`, `region_id`, `location_id`, `product_id`, `uom_id`, `product`, `uom`, `quantity`, `unit_price`, `total_price`, `created`, `modified`) VALUES
(9, 'c2134a18455b64c6cf867de23f1ff4f9', 3, 4, 26, '26', 'CAULIFLOWER', 'PCS/1', 1, '2.00', '2.00', '2020-07-07 09:40:58', '2020-07-07 09:40:58'),
(4, '75198cf0516237764d19b1528a068731', 3, 4, 2, '2', 'Banana', 'PKT/1', 5, '5.00', '25.00', '2020-07-06 18:00:34', '2020-07-06 18:00:35'),
(10, 'bb032ca3376bc0609e5b718b01e05235', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-07 09:45:56', '2020-07-07 09:45:56'),
(5, '75198cf0516237764d19b1528a068731', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-06 18:00:37', '2020-07-06 18:00:37'),
(6, '75198cf0516237764d19b1528a068731', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-06 18:00:37', '2020-07-06 18:00:37'),
(7, '75198cf0516237764d19b1528a068731', 3, 4, 7, '7', 'POTATO', 'KG/1', 6, '10.00', '60.00', '2020-07-06 18:00:38', '2020-07-06 18:00:39'),
(12, '8ad2559919d7e475bb1b48af2535625d', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-07 09:50:17', '2020-07-07 09:50:17'),
(13, '8ad2559919d7e475bb1b48af2535625d', 3, 4, 7, '7', 'POTATO', 'KG/1', 5, '10.00', '50.00', '2020-07-07 09:51:40', '2020-07-07 09:51:42'),
(14, 'fa920a75af45c2c8e76436460602f719', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-07 12:26:42', '2020-07-07 12:26:42'),
(15, 'fa920a75af45c2c8e76436460602f719', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-07 12:52:22', '2020-07-07 12:52:22'),
(16, '23892c721e930091584256f8cfe99242', 3, 4, 52, '52', 'MANGO', 'PCS/1', 5, '1.00', '5.00', '2020-07-07 13:07:45', '2020-07-07 14:26:20'),
(17, '23892c721e930091584256f8cfe99242', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-07 14:26:22', '2020-07-07 14:26:22'),
(18, '23892c721e930091584256f8cfe99242', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 8, '7.00', '56.00', '2020-07-07 14:26:23', '2020-07-07 14:26:25'),
(32, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 1, '8.80', '8.80', '2020-07-07 18:23:19', '2020-07-07 18:23:19'),
(27, 'c1c234eeb241ee537179d6db73c716ed', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-07 15:21:18', '2020-07-07 15:21:21'),
(28, 'c1c234eeb241ee537179d6db73c716ed', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 3, '7.00', '21.00', '2020-07-07 15:21:23', '2020-07-07 15:21:34'),
(33, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 2, '2', 'Banana', 'PKT/1', 2, '5.00', '10.00', '2020-07-07 18:23:25', '2020-07-07 18:23:26'),
(34, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-07 18:23:27', '2020-07-07 18:23:27'),
(35, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-07 18:23:29', '2020-07-07 18:23:29'),
(36, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 9, '9', 'BROCCOLI', 'PCS/1', 2, '1.80', '3.60', '2020-07-07 18:23:37', '2020-07-07 18:23:59'),
(37, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 10, '10', 'CUCUMBER', 'PCS/1', 1, '1.20', '1.20', '2020-07-07 18:23:38', '2020-07-07 18:23:38'),
(38, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 21, '21', 'KIWI', 'PCS/1', 1, '0.50', '0.50', '2020-07-07 18:23:39', '2020-07-07 18:23:39'),
(39, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 25, '25', 'WATER CONVOLVULUS', 'PCS/1', 3, '1.50', '4.50', '2020-07-07 18:23:41', '2020-07-07 18:23:44'),
(40, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 50, '50', 'DRAGON FRUIT (RED PULP)', 'PCS/1', 1, '7.20', '7.20', '2020-07-07 18:23:48', '2020-07-07 18:23:48'),
(41, '8e69e5e647cbdc32fd215642d8164e62', 3, 4, 52, '52', 'MANGO', 'PCS/1', 1, '1.00', '1.00', '2020-07-07 18:23:51', '2020-07-07 18:23:51'),
(42, '74ad0cb58d0ac966c4dc05f51361cd35', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 09:32:42', '2020-07-08 09:32:42'),
(43, '74ad0cb58d0ac966c4dc05f51361cd35', 3, 4, 7, '7', 'POTATO', 'KG/1', 6, '10.00', '60.00', '2020-07-08 09:32:43', '2020-07-08 09:32:45'),
(44, '40566d847d35ca7a2bc3499a8ac231f8', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 3, '8.80', '26.40', '2020-07-08 09:35:18', '2020-07-08 09:35:24'),
(45, '40566d847d35ca7a2bc3499a8ac231f8', 3, 4, 7, '7', 'POTATO', 'KG/1', 6, '10.00', '60.00', '2020-07-08 09:35:29', '2020-07-08 09:35:31'),
(46, '1b6c8892efec9627a39b5d0bd7d80453', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 10:21:15', '2020-07-08 10:21:15'),
(47, '1b6c8892efec9627a39b5d0bd7d80453', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 9, '7.00', '63.00', '2020-07-08 10:21:16', '2020-07-08 10:21:18'),
(67, '6960f9108374b673854ce1c674640fcc', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-08 11:27:02', '2020-07-08 11:27:02'),
(68, '6960f9108374b673854ce1c674640fcc', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-08 11:27:03', '2020-07-08 11:27:04'),
(69, '6960f9108374b673854ce1c674640fcc', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-08 11:27:06', '2020-07-08 11:27:06'),
(71, '4c1a59289e12925098c07d92ae5fada5', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-08 12:06:17', '2020-07-08 12:08:15'),
(76, '4c1a59289e12925098c07d92ae5fada5', 3, 4, 5, '5', 'CORN', 'PCS/1', 10, '2.50', '25.00', '2020-07-08 12:10:43', '2020-07-08 12:10:56'),
(77, '49a14ae70d212bd5ec19b01fafff6772', 3, 4, 2, '2', 'Banana', 'PKT/1', 7, '5.00', '35.00', '2020-07-08 12:23:11', '2020-07-08 12:23:22'),
(78, '77aa6fe1a2019a359c9e7ec4ec7238f3', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-08 12:24:29', '2020-07-08 12:24:29'),
(79, '77aa6fe1a2019a359c9e7ec4ec7238f3', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-08 12:24:29', '2020-07-08 12:24:29'),
(80, '77aa6fe1a2019a359c9e7ec4ec7238f3', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-08 12:24:30', '2020-07-08 12:24:30'),
(81, '77aa6fe1a2019a359c9e7ec4ec7238f3', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 12:24:30', '2020-07-08 12:24:30'),
(82, '77aa6fe1a2019a359c9e7ec4ec7238f3', 3, 4, 7, '7', 'POTATO', 'KG/1', 2, '10.00', '20.00', '2020-07-08 12:24:31', '2020-07-08 12:24:33'),
(83, '84b044789f73a0a3d47a37f5186fa108', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-08 12:35:00', '2020-07-08 12:35:00'),
(84, '84b044789f73a0a3d47a37f5186fa108', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-08 12:35:01', '2020-07-08 12:35:01'),
(85, '84b044789f73a0a3d47a37f5186fa108', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-08 12:35:01', '2020-07-08 12:35:04'),
(86, '80df75f62f99ae02c702e740e5e14311', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-08 13:02:33', '2020-07-08 13:02:38'),
(87, '80df75f62f99ae02c702e740e5e14311', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-08 13:02:34', '2020-07-08 13:02:34'),
(88, '80df75f62f99ae02c702e740e5e14311', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-08 13:02:35', '2020-07-08 13:02:35'),
(89, '80df75f62f99ae02c702e740e5e14311', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-08 13:02:35', '2020-07-08 13:02:35'),
(90, '80df75f62f99ae02c702e740e5e14311', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 13:02:36', '2020-07-08 13:02:36'),
(91, '80df75f62f99ae02c702e740e5e14311', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-08 13:02:38', '2020-07-08 13:02:38'),
(92, '80df75f62f99ae02c702e740e5e14311', 3, 4, 26, '26', 'CAULIFLOWER', 'PCS/1', 1, '2.00', '2.00', '2020-07-08 13:02:41', '2020-07-08 13:02:41'),
(93, '7284eb4419d0cdd5b4d296d28cad85e1', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 3, '8.80', '26.40', '2020-07-08 14:20:12', '2020-07-08 14:20:16'),
(94, '7284eb4419d0cdd5b4d296d28cad85e1', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 3, '7.00', '21.00', '2020-07-08 14:20:18', '2020-07-08 14:20:19'),
(95, '7284eb4419d0cdd5b4d296d28cad85e1', 3, 4, 7, '7', 'POTATO', 'KG/1', 5, '10.00', '50.00', '2020-07-08 14:20:20', '2020-07-08 14:20:21'),
(96, '1eab60b73bc95f4d8a1d0d538cbba40f', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 10, '7.00', '70.00', '2020-07-08 14:23:43', '2020-07-08 14:23:47'),
(97, 'a134706206d7bd311e3f4367f40bbbb7', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-08 14:37:36', '2020-07-08 14:37:36'),
(98, 'a134706206d7bd311e3f4367f40bbbb7', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 14:37:37', '2020-07-08 14:37:37'),
(99, 'a134706206d7bd311e3f4367f40bbbb7', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-08 14:37:37', '2020-07-08 14:37:37'),
(100, 'a134706206d7bd311e3f4367f40bbbb7', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-08 14:37:38', '2020-07-08 14:37:38'),
(110, '321282132cda011d213cf358c4446539', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-08 15:32:26', '2020-07-08 15:32:26'),
(109, '321282132cda011d213cf358c4446539', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 6, '7.00', '42.00', '2020-07-08 15:32:25', '2020-07-08 15:32:49'),
(111, '321282132cda011d213cf358c4446539', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-08 15:32:41', '2020-07-08 15:32:41'),
(112, '321282132cda011d213cf358c4446539', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-08 15:32:41', '2020-07-08 15:32:41'),
(113, '321282132cda011d213cf358c4446539', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 7, '0.80', '5.60', '2020-07-08 15:32:43', '2020-07-08 15:32:46'),
(114, '8f859738177e41d718bebc9216c17d1b', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 3, '8.80', '26.40', '2020-07-08 15:55:33', '2020-07-08 15:55:34'),
(115, '8f859738177e41d718bebc9216c17d1b', 3, 4, 5, '5', 'CORN', 'PCS/1', 2, '2.50', '5.00', '2020-07-08 15:55:36', '2020-07-08 15:55:37'),
(116, '452c09a57a09fc713629b15e1c5adebf', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 4, '7.00', '28.00', '2020-07-08 17:01:28', '2020-07-08 17:01:33'),
(117, '452c09a57a09fc713629b15e1c5adebf', 3, 4, 7, '7', 'POTATO', 'KG/1', 8, '10.00', '80.00', '2020-07-08 17:01:30', '2020-07-08 17:01:34'),
(118, '452c09a57a09fc713629b15e1c5adebf', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-08 17:01:32', '2020-07-08 17:01:32'),
(119, '6768ed0e1763ccf97a62a83e4af0dbbc', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-08 17:30:06', '2020-07-08 17:30:06'),
(120, 'a3d962733768c7ec584456381e80a91c', 3, 4, 7, '7', 'POTATO', 'KG/1', 7, '10.00', '70.00', '2020-07-09 09:48:13', '2020-07-09 09:48:16'),
(121, 'bb5961037e97f703eb948d24045205d6', 3, 4, 1, '1', 'Coconut', 'PCS/1', 4, '4.00', '16.00', '2020-07-09 09:51:28', '2020-07-09 09:51:43'),
(127, 'bb5961037e97f703eb948d24045205d6', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 8, '8.80', '70.40', '2020-07-09 09:51:58', '2020-07-09 09:52:02'),
(128, '536e203fc1259d230c818c220ad44cf1', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-09 10:16:54', '2020-07-09 10:16:54'),
(129, '536e203fc1259d230c818c220ad44cf1', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-09 10:16:57', '2020-07-09 10:16:58'),
(130, 'a9ec642df0df50e999197f45bbb2f7a5', 3, 4, 7, '7', 'POTATO', 'KG/1', 4, '10.00', '40.00', '2020-07-09 10:20:02', '2020-07-09 10:20:04'),
(139, '44ad17e6dbf047ab883c048cf43cde68', 3, 4, 2, '2', 'Banana', 'PKT/1', 3, '5.00', '15.00', '2020-07-09 16:58:52', '2020-07-09 16:59:03'),
(138, '44ad17e6dbf047ab883c048cf43cde68', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-09 16:58:50', '2020-07-09 16:58:50'),
(137, '44ad17e6dbf047ab883c048cf43cde68', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 1, '8.80', '8.80', '2020-07-09 16:58:36', '2020-07-09 16:58:36'),
(135, '3dd06dbbd34b6ae0cd407fef3272bb45', 3, 4, 7, '7', 'POTATO', 'KG/1', 5, '10.00', '50.00', '2020-07-09 11:00:01', '2020-07-09 11:00:04'),
(141, 'd23b9c5585548716b119160b17549a6a', 3, 4, 7, '7', 'POTATO', 'KG/1', 4, '10.00', '40.00', '2020-07-09 17:34:48', '2020-07-09 17:35:07'),
(142, 'ccc9d0dab15fb42c7e7e1d809b654c5b', 3, 4, 51, '51', 'DRAGON FRUIT (WHITE PULP)', 'PCS/1', 3, '7.20', '21.60', '2020-07-10 00:41:48', '2020-07-10 00:41:49'),
(143, 'ccc9d0dab15fb42c7e7e1d809b654c5b', 3, 4, 50, '50', 'DRAGON FRUIT (RED PULP)', 'PCS/1', 4, '7.20', '28.80', '2020-07-10 00:41:50', '2020-07-10 00:41:51'),
(144, '95fb0c9bd44e4a935fb1bf06f5cd1035', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-10 09:37:40', '2020-07-10 09:37:40'),
(145, '95fb0c9bd44e4a935fb1bf06f5cd1035', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-10 09:37:40', '2020-07-10 09:37:40'),
(146, '95fb0c9bd44e4a935fb1bf06f5cd1035', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-10 09:37:42', '2020-07-10 09:37:42'),
(147, '95fb0c9bd44e4a935fb1bf06f5cd1035', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-10 09:37:42', '2020-07-10 09:37:42'),
(148, '95fb0c9bd44e4a935fb1bf06f5cd1035', 3, 4, 5, '5', 'CORN', 'PCS/1', 2, '2.50', '5.00', '2020-07-10 09:37:47', '2020-07-10 09:37:47'),
(149, '56f894032436738ea9be12a3422f9a48', 3, 4, 52, '52', 'MANGO', 'PCS/1', 3, '1.00', '3.00', '2020-07-10 09:46:55', '2020-07-10 09:47:02'),
(150, '56f894032436738ea9be12a3422f9a48', 3, 4, 51, '51', 'DRAGON FRUIT (WHITE PULP)', 'PCS/1', 4, '7.20', '28.80', '2020-07-10 09:47:04', '2020-07-10 09:47:09'),
(151, '56f894032436738ea9be12a3422f9a48', 3, 4, 50, '50', 'DRAGON FRUIT (RED PULP)', 'PCS/1', 3, '7.20', '21.60', '2020-07-10 09:47:06', '2020-07-10 09:47:06'),
(152, '93dfa55bc6cc7c96a68aa20568cc482e', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 10, '0.80', '8.00', '2020-07-10 10:08:19', '2020-07-10 10:08:21'),
(153, '93dfa55bc6cc7c96a68aa20568cc482e', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-10 10:08:23', '2020-07-10 10:08:23'),
(154, '93dfa55bc6cc7c96a68aa20568cc482e', 3, 4, 2, '2', 'Banana', 'PKT/1', 3, '5.00', '15.00', '2020-07-10 10:08:24', '2020-07-10 10:08:26'),
(155, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 23, '23', 'PEAR', 'PCS/1', 5, '1.00', '5.00', '2020-07-10 10:57:21', '2020-07-10 10:57:23'),
(156, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 49, '49', 'PINEAPPLE', 'PCS/1', 1, '4.50', '4.50', '2020-07-10 10:57:25', '2020-07-10 10:57:25'),
(157, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 50, '50', 'DRAGON FRUIT (RED PULP)', 'PCS/1', 1, '7.20', '7.20', '2020-07-10 10:57:26', '2020-07-10 10:57:26'),
(158, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 51, '51', 'DRAGON FRUIT (WHITE PULP)', 'PCS/1', 1, '7.20', '7.20', '2020-07-10 10:57:27', '2020-07-10 10:57:27'),
(159, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-10 10:57:29', '2020-07-10 10:57:29'),
(160, 'b4c9a2b9e201e3744e6f1d27e031a972', 3, 4, 21, '21', 'KIWI', 'PCS/1', 3, '0.50', '1.50', '2020-07-10 10:57:30', '2020-07-10 10:57:31'),
(161, '93116e25c5f40836b8772b4c229b5683', 3, 4, 23, '23', 'PEAR', 'PCS/1', 2, '1.00', '2.00', '2020-07-10 11:04:09', '2020-07-10 11:04:10'),
(162, '93116e25c5f40836b8772b4c229b5683', 3, 4, 50, '50', 'DRAGON FRUIT (RED PULP)', 'PCS/1', 3, '7.20', '21.60', '2020-07-10 11:04:10', '2020-07-10 11:04:11'),
(163, '93116e25c5f40836b8772b4c229b5683', 3, 4, 49, '49', 'PINEAPPLE', 'PCS/1', 2, '4.50', '9.00', '2020-07-10 11:04:12', '2020-07-10 11:04:12'),
(164, '93116e25c5f40836b8772b4c229b5683', 3, 4, 103, '215', 'STRAWBERRY', 'PCS/1', 4, '1.20', '4.80', '2020-07-10 11:04:13', '2020-07-10 11:04:15'),
(165, '12970c3b9e327b4a2c08ce3c83e04ec1', 3, 4, 108, '216', 'BLUEBERRY', 'PKT/1', 3, '8.80', '26.40', '2020-07-10 11:11:47', '2020-07-10 11:11:50'),
(166, '12970c3b9e327b4a2c08ce3c83e04ec1', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 5, '7.00', '35.00', '2020-07-10 11:11:52', '2020-07-10 11:11:54'),
(167, 'a6631e978c58f52603f27d5b8ed947b9', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-10 11:50:17', '2020-07-10 11:50:17'),
(168, 'a6631e978c58f52603f27d5b8ed947b9', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-10 11:50:18', '2020-07-10 11:50:18'),
(169, 'a6631e978c58f52603f27d5b8ed947b9', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 2, '8.80', '17.60', '2020-07-10 11:50:21', '2020-07-10 11:50:22'),
(170, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-10 14:13:56', '2020-07-10 14:13:59'),
(171, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-10 14:13:57', '2020-07-10 14:13:57'),
(172, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 22, '22', 'JAVA APPLE', 'PCS/1', 3, '0.40', '1.20', '2020-07-10 14:14:00', '2020-07-10 14:14:01'),
(173, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 21, '21', 'KIWI', 'PCS/1', 3, '0.50', '1.50', '2020-07-10 14:14:02', '2020-07-10 14:14:03'),
(174, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 10, '10', 'CUCUMBER', 'PCS/1', 3, '1.20', '3.60', '2020-07-10 14:14:04', '2020-07-10 14:14:05'),
(175, 'b487c81b01ea5cd9d6044ba10bdb2f11', 3, 4, 3, '3', 'AVOCADO (200MG)', 'PKT/1', 3, '12.00', '36.00', '2020-07-10 14:14:06', '2020-07-10 14:14:07'),
(176, '30eeaa926643ee9ea474610b4671b632', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-10 14:20:16', '2020-07-10 14:20:16'),
(177, '30eeaa926643ee9ea474610b4671b632', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 7, '7.00', '49.00', '2020-07-10 14:20:18', '2020-07-10 14:20:27'),
(178, '5732422919ae326955b36ffba854449e', 3, 4, 7, '7', 'POTATO', 'KG/1', 5, '10.00', '50.00', '2020-07-10 14:28:16', '2020-07-10 14:28:18'),
(179, '95a2556058a87bacb9e9267c7960060b', 3, 4, 1, '1', 'Coconut', 'PCS/1', 2, '4.00', '8.00', '2020-07-10 14:36:11', '2020-07-10 14:37:35'),
(180, '95a2556058a87bacb9e9267c7960060b', 3, 4, 2, '2', 'Banana', 'PKT/1', 3, '5.00', '15.00', '2020-07-10 14:36:12', '2020-07-10 14:37:34'),
(181, '95a2556058a87bacb9e9267c7960060b', 3, 4, 3, '3', 'AVOCADO (200MG)', 'PKT/1', 1, '12.00', '12.00', '2020-07-10 14:36:12', '2020-07-10 14:36:12'),
(182, '95a2556058a87bacb9e9267c7960060b', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-10 14:36:13', '2020-07-10 14:36:13'),
(183, '95a2556058a87bacb9e9267c7960060b', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-10 14:36:14', '2020-07-10 14:36:14'),
(184, '95a2556058a87bacb9e9267c7960060b', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-10 14:36:14', '2020-07-10 14:36:14'),
(185, '95a2556058a87bacb9e9267c7960060b', 3, 4, 22, '22', 'JAVA APPLE', 'PCS/1', 1, '0.40', '0.40', '2020-07-10 14:36:15', '2020-07-10 14:36:15'),
(186, '95a2556058a87bacb9e9267c7960060b', 3, 4, 10, '10', 'CUCUMBER', 'PCS/1', 1, '1.20', '1.20', '2020-07-10 14:36:16', '2020-07-10 14:36:16'),
(187, '95a2556058a87bacb9e9267c7960060b', 3, 4, 9, '9', 'BROCCOLI', 'PCS/1', 1, '1.80', '1.80', '2020-07-10 14:36:16', '2020-07-10 14:36:16'),
(188, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-10 15:10:16', '2020-07-10 15:10:35'),
(189, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-10 15:10:17', '2020-07-10 15:10:17'),
(190, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 5, '5', 'CORN', 'PCS/1', 2, '2.50', '5.00', '2020-07-10 15:10:17', '2020-07-10 15:10:28'),
(191, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-10 15:10:18', '2020-07-10 15:10:18'),
(192, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-10 15:10:19', '2020-07-10 15:10:19'),
(193, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 26, '26', 'CAULIFLOWER', 'PCS/1', 1, '2.00', '2.00', '2020-07-10 15:10:20', '2020-07-10 15:10:20'),
(194, '8e07c38a187bf0154f7f047597d4d3a9', 3, 4, 22, '22', 'JAVA APPLE', 'PCS/1', 4, '0.40', '1.60', '2020-07-10 15:10:23', '2020-07-10 15:10:25'),
(202, '4911ab9ca3d555409e8eb8d62eb66f51', 3, 4, 7, '7', 'POTATO', 'KG/1', 4, '10.00', '40.00', '2020-07-10 16:17:30', '2020-07-10 16:17:43'),
(203, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-10 17:01:29', '2020-07-10 17:01:29'),
(199, '3e35c5611e72df22cb4e3d90a70e120b', 3, 4, 1, '1', 'Coconut', 'PCS/1', 7, '4.00', '28.00', '2020-07-10 16:03:03', '2020-07-10 16:12:14'),
(201, '3e35c5611e72df22cb4e3d90a70e120b', 3, 4, 7, '7', 'POTATO', 'KG/1', 3, '10.00', '30.00', '2020-07-10 16:12:18', '2020-07-10 16:12:22'),
(204, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-10 17:01:29', '2020-07-10 17:01:29'),
(205, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-10 17:01:31', '2020-07-10 17:01:31'),
(206, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-10 17:01:31', '2020-07-10 17:01:31'),
(207, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-10 17:01:32', '2020-07-10 17:01:32'),
(208, '9e90ffd5f35f6d7eed9cff94047056c1', 3, 4, 26, '26', 'CAULIFLOWER', 'PCS/1', 2, '2.00', '4.00', '2020-07-10 17:01:34', '2020-07-10 17:01:35'),
(209, 'e8ad22985af5cd28c02f6cf448cdba6b', 3, 4, 1, '1', 'Coconut', 'PCS/1', 2, '4.00', '8.00', '2020-07-10 18:20:01', '2020-07-10 18:20:01'),
(210, 'e8ad22985af5cd28c02f6cf448cdba6b', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 2, '7.00', '14.00', '2020-07-10 18:20:02', '2020-07-10 18:20:03'),
(211, 'e8ad22985af5cd28c02f6cf448cdba6b', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-10 18:20:03', '2020-07-10 18:20:03'),
(213, '19c5bcc6ae6a10c04c25da9b7c1e3c59', 3, 4, 1, '1', 'Coconut', 'PCS/1', 4, '4.00', '16.00', '2020-07-10 19:53:12', '2020-07-10 19:53:24'),
(214, '19c5bcc6ae6a10c04c25da9b7c1e3c59', 3, 4, 7, '7', 'POTATO', 'KG/1', 2, '10.00', '20.00', '2020-07-10 19:53:15', '2020-07-10 19:53:34'),
(215, '19c5bcc6ae6a10c04c25da9b7c1e3c59', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-10 19:53:29', '2020-07-10 19:53:33'),
(216, '19c5bcc6ae6a10c04c25da9b7c1e3c59', 3, 4, 2, '2', 'Banana', 'PKT/1', 9, '5.00', '45.00', '2020-07-10 19:53:37', '2020-07-10 19:53:43'),
(217, '19c5bcc6ae6a10c04c25da9b7c1e3c59', 3, 4, 5, '5', 'CORN', 'PCS/1', 2, '2.50', '5.00', '2020-07-10 19:53:37', '2020-07-10 19:53:40'),
(218, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 3, '3', 'AVOCADO (200MG)', 'PKT/1', 1, '12.00', '12.00', '2020-07-11 11:23:01', '2020-07-11 11:23:01'),
(219, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 26, '26', 'CAULIFLOWER', 'PCS/1', 3, '2.00', '6.00', '2020-07-11 11:23:03', '2020-07-11 11:23:15'),
(220, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 1, '8.80', '8.80', '2020-07-11 11:23:05', '2020-07-11 11:23:05'),
(221, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 10, '10', 'CUCUMBER', 'PCS/1', 2, '1.20', '2.40', '2020-07-11 11:23:07', '2020-07-11 11:23:10'),
(222, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 6, '6', 'TOMATO', 'PCS/1', 1, '0.80', '0.80', '2020-07-11 11:23:09', '2020-07-11 11:23:09'),
(223, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 22, '22', 'JAVA APPLE', 'PCS/1', 1, '0.40', '0.40', '2020-07-11 11:23:18', '2020-07-11 11:23:18'),
(224, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 7, '7', 'POTATO', 'KG/1', 1, '10.00', '10.00', '2020-07-11 11:29:08', '2020-07-11 11:29:08'),
(225, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-11 11:29:09', '2020-07-11 11:29:09'),
(226, 'd070ff3d9d11496d15f40edc93b7f840', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-11 11:29:12', '2020-07-11 11:29:12'),
(227, '426cf69d686678616e80d78fc78472ff', 3, 4, 4, '4', 'RED GRAPE (400MG)', 'PKT/1', 7, '8.80', '61.60', '2020-07-13 12:05:09', '2020-07-13 12:05:19'),
(228, '8ce7d5b753dab2fc869e937f178af11b', 3, 4, 2, '2', 'Banana', 'PKT/1', 6, '5.00', '30.00', '2020-07-13 12:47:12', '2020-07-13 12:47:19'),
(229, '8ce7d5b753dab2fc869e937f178af11b', 3, 4, 3, '3', 'AVOCADO (200MG)', 'PKT/1', 2, '12.00', '24.00', '2020-07-13 12:47:20', '2020-07-13 12:47:21'),
(239, 'bfd76cfc6b1d03bd9dae40d5cab6cb15', 3, 4, 1, '1', 'Coconut', 'PCS/1', 2, '4.00', '8.00', '2020-07-15 14:28:55', '2020-07-15 14:29:05'),
(238, '0ac6ebed72dfdf0d0349a5266deedc60', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-15 10:11:45', '2020-07-15 10:11:45'),
(240, 'bfd76cfc6b1d03bd9dae40d5cab6cb15', 3, 4, 5, '5', 'CORN', 'PCS/1', 1, '2.50', '2.50', '2020-07-15 14:28:57', '2020-07-15 14:28:57'),
(241, 'bfd76cfc6b1d03bd9dae40d5cab6cb15', 3, 4, 2, '2', 'Banana', 'PKT/1', 1, '5.00', '5.00', '2020-07-15 14:29:12', '2020-07-15 14:29:12'),
(242, 'bfd76cfc6b1d03bd9dae40d5cab6cb15', 3, 4, 3, '3', 'AVOCADO (200MG)', 'PKT/1', 3, '12.00', '36.00', '2020-07-15 14:29:14', '2020-07-15 14:29:24'),
(243, 'b98f7f4e106c5da4b9767384b8a1314b', 3, 4, 1, '1', 'Coconut', 'PCS/1', 1, '4.00', '4.00', '2020-07-20 14:20:02', '2020-07-20 14:20:02'),
(246, '86e5364ec56dca370783d048e27466d9', 3, 4, 8, '8', 'EGG PLANT', 'KG/1', 1, '7.00', '7.00', '2020-07-24 14:46:44', '2020-07-24 14:46:44'),
(247, '86e5364ec56dca370783d048e27466d9', 3, 4, 1, '1', 'Coconut', 'PCS/1', 4, '4.00', '16.00', '2020-07-24 14:46:45', '2020-07-24 14:47:21'),
(248, '86e5364ec56dca370783d048e27466d9', 3, 4, 5, '5', 'CORN', 'PCS/1', 15, '2.50', '37.50', '2020-07-24 14:47:33', '2020-07-24 14:47:41'),
(253, 'c6208528a7c540825381baebdf841f8d', 3, 4, 181, '292', 'Fish Fillet', 'KG/1', 4, '7.20', '28.80', '2020-07-29 12:10:52', '2020-07-29 12:10:58'),
(252, 'c6208528a7c540825381baebdf841f8d', 3, 4, 125, '236', 'Coldstar French Fries Shoestring 1kg', 'PKT/1', 5, '5.20', '26.00', '2020-07-29 12:09:18', '2020-07-29 12:09:35'),
(254, 'c6208528a7c540825381baebdf841f8d', 3, 4, 111, '221', 'Egg Grade C', 'PCS/1', 1, '0.50', '0.50', '2020-07-29 12:49:31', '2020-07-29 12:49:31'),
(261, '4f53e2b6703782cf15e3e3fc373ce9dd', 3, 4, 141, '252', 'Ayam Wira Cheese Chix Cocktail 500g ', 'PKT/1', 3, '8.60', '25.80', '2020-07-30 14:03:42', '2020-07-30 14:03:47'),
(262, '4f53e2b6703782cf15e3e3fc373ce9dd', 3, 4, 132, '243', 'Mushroom Oborotsuki 500g', 'PKT/1', 3, '9.00', '27.00', '2020-07-30 14:03:43', '2020-07-30 14:03:44'),
(263, 'b0fb17a13c28f07f5a5dae43a5859a0c', 3, 4, 109, '218', 'Egg Grade A', 'TRAY/30', 1, '11.80', '11.80', '2020-07-30 14:48:14', '2020-07-30 14:48:14'),
(264, 'cb8b0a05c03e8162bf43cc9100275176', 3, 4, 154, '265', 'Nutribest Chicken Breast Fillet', 'KG/1', 3, '12.50', '37.50', '2020-07-30 15:32:00', '2020-07-30 15:32:03'),
(265, 'qkevvjgredtc668ga84cfp6m4u', 3, 4, 124, '235', 'Coldstar French Fries Crinkle Cut 1kg', 'PKT/1', 1, '5.20', '5.20', '2020-08-03 15:00:12', '2020-08-03 15:00:12'),
(266, 'qkevvjgredtc668ga84cfp6m4u', 3, 4, 132, '243', 'Mushroom Oborotsuki 500g', 'PKT/1', 6, '9.00', '54.00', '2020-08-03 15:00:14', '2020-08-03 15:00:17'),
(267, 'k3nclve6n99d33l77jcgofnbf3', 3, 4, 153, '264', 'Nutribest Chicken Thigh Fillet', 'KG/1', 5, '13.30', '66.50', '2020-08-10 14:24:53', '2020-08-10 14:30:12'),
(268, 'k3nclve6n99d33l77jcgofnbf3', 3, 4, 118, '229', 'Nutribest Chicken Meatball  400g', 'PKT/1', 3, '6.50', '19.50', '2020-08-10 14:30:05', '2020-08-10 14:30:15'),
(271, 'cp2aqi53sfvtsda2ecdob7b53v', 3, 4, 141, '252', 'Ayam Wira Cheese Chix Cocktail 500g ', 'PKT/1', 3, '8.60', '25.80', '2020-08-12 15:12:23', '2020-08-12 15:12:44'),
(270, 'vntifpp09r071ia9gt1gp8s4qb', 3, 4, 132, '243', 'Mushroom Oborotsuki 500g', 'PKT/1', 6, '9.00', '54.00', '2020-08-11 17:17:23', '2020-08-11 17:17:28'),
(272, 'cp2aqi53sfvtsda2ecdob7b53v', 3, 4, 154, '265', 'Nutribest Chicken Breast Fillet', 'KG/1', 3, '12.50', '37.50', '2020-08-12 15:12:51', '2020-08-12 15:12:52'),
(273, 'ogottslkjhsf545k8juhjdhr6k', 3, 4, 198, '311', 'Chicken Feet (Fresh)', 'KG/1', 1, '4.00', '4.00', '2020-09-04 14:53:00', '2020-09-04 14:53:03'),
(274, 'nnvnlatgu02upbgeldu4i28blu', 3, 4, 198, '311', 'Chicken Feet (Fresh)', 'KG/1', 1, '4.00', '4.00', '2020-09-07 12:28:24', '2020-09-07 12:28:24'),
(275, 'nnvnlatgu02upbgeldu4i28blu', 3, 4, 154, '265', 'Nutribest Chicken Breast Fillet', 'KG/1', 3, '12.50', '37.50', '2020-09-07 12:51:55', '2020-09-07 12:51:56'),
(276, 'nnvnlatgu02upbgeldu4i28blu', 3, 4, 128, '239', 'Mushroom White Fish Ball (SMALL) 500g', 'PKT/1', 1, '6.20', '6.20', '2020-09-07 12:53:35', '2020-09-07 12:53:35'),
(277, '9a3l78litm422bul22pen28u8m', 3, 4, 198, '311', 'Chicken Feet (Fresh)', 'KG/1', 1, '4.00', '4.00', '2020-09-07 13:14:58', '2020-09-07 13:14:58'),
(278, 'btnjq7ng837q4p6ugoaqkao0a2', 3, 4, 198, '311', 'Chicken Feet (Fresh)', 'KG/1', 1, '4.00', '4.00', '2020-09-07 14:51:12', '2020-09-07 14:51:13'),
(279, 'btnjq7ng837q4p6ugoaqkao0a2', 3, 4, 154, '265', 'Nutribest Chicken Breast Fillet', 'KG/1', 1, '12.50', '12.50', '2020-09-07 15:03:15', '2020-09-07 15:03:15'),
(280, 'jv7g7a7aptlegg411tkdmiab9r', 3, 4, 198, '311', 'Chicken Feet (Fresh)', 'KG/1', 1, '4.00', '4.00', '2020-09-07 15:21:10', '2020-09-07 15:21:10'),
(281, '010011o9mrt5kdg9uoh4rs4oap', 3, 4, 122, '233', 'Nutribest/Prisma Mix Vege 400g', 'PKT/1', 1, '2.30', '2.30', '2020-09-07 15:43:01', '2020-09-07 15:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `region` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `region`, `location`, `position`, `status`, `created`, `modified`) VALUES
(1, '1', 'Kuching Town', '1', '2', '2020-05-21 04:06:00', '2020-07-06 15:26:30'),
(3, '2', 'Sibu Town', '2', '2', '2020-05-29 17:03:12', '2020-07-06 15:26:30'),
(4, '3', 'Miri Town', '3', '1', '2020-06-24 11:14:11', '2020-06-24 11:14:11'),
(5, '2', 'Sungei Merah', '1', '1', '2020-07-07 11:25:38', '2020-07-07 11:26:11'),
(7, '4', 'Serian Town', '2', '1', '2020-07-09 12:31:30', '2020-07-09 12:31:30');

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
  `username` varchar(150) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `temp_password` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `group_id`, `location`, `name`, `email`, `username`, `password`, `temp_password`, `status`, `created`, `modified`) VALUES
(66, 1, 5, 'Administrator', 'jonathan.wphp@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, '2020-07-30 14:31:35', '2020-09-04 15:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `region` varchar(11) DEFAULT NULL,
  `area` varchar(11) DEFAULT NULL,
  `area2` varchar(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `address2` varchar(1000) DEFAULT NULL,
  `mobile_number` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `region`, `area`, `area2`, `name`, `email`, `address`, `address2`, `mobile_number`, `password`, `temp_password`, `status`, `last_login`, `created`, `modified`) VALUES
(1, '3', '4', NULL, 'Jonathan', 'jonathan.wphp@gmail.com', 'dssads dsad sadsad sa', NULL, '12121212', 'a4e383d5c41e7c852c1fc0d6dd85f117', '1f66887301d7d5898d8374ac1e9c3a4d', 'Activated', '2020-09-07', '2020-07-06 12:27:31', '2020-09-07 15:21:15'),
(2, '3', '7', '4', 'Daus Grocere', 'daus.grocere@gmail.com', 'Lot 123', 'qweqweeqwe', '01119194093', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'f40c0b1beffab082dc767d8809187875', 'Activated', '2020-07-30', '2020-07-06 12:28:44', '2020-07-30 15:33:10'),
(3, '3', '5', NULL, 'Jonathan', 'wong@asdsad.com', 'adsad dsad', NULL, '123123123', '9d710c9f8bab8ce33066ab0078a9b613', NULL, 'Activated', '2020-07-06', '2020-07-06 17:00:43', '2020-07-06 17:00:43'),
(5, '2', '11', '4', 'Daus Grocere', 'dg2@gmail.com', '123', '123', '1119194093', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', NULL, 'Activated', '2020-07-09', '2020-07-07 11:31:02', '2020-07-09 10:34:40'),
(6, '2', '11', NULL, 'daus grocere', 'dg3@gmail.com', 'Lot 123 testing', NULL, '1119194093', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', NULL, 'Activated', '2020-07-07', '2020-07-07 14:41:40', '2020-07-07 14:41:40'),
(7, '3', '5', NULL, 'JP', 'd@mail.com', 'address', NULL, '12344567', 'ac84bb4528ade2f9137420332b6305fc', NULL, 'Activated', '2020-07-08', '2020-07-08 10:57:44', '2020-07-08 12:26:43'),
(8, '3', '5', NULL, 'DC', 'johnsonporter775@gmail.com', 'address1', NULL, '123456789', 'ac84bb4528ade2f9137420332b6305fc', 'cc511c3a347ff1f71025a3c849d8936f', 'Activated', '2020-07-10', '2020-07-08 12:34:46', '2020-07-10 16:17:51'),
(9, '3', '7', NULL, 'Eddie Lim', 'poketrainereddie@gmail.com', 'No 174, Lorong Stutong', NULL, '01993892843', 'ea39cad9e15e2f751973093f46509443', NULL, 'Activated', '2020-07-13', '2020-07-08 15:23:02', '2020-07-13 12:26:51'),
(10, NULL, NULL, NULL, 'Jonathan Wong Pan Hung', 'jonathan830912@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Activated', NULL, '2020-07-08 17:04:42', '2020-07-08 17:04:42'),
(11, '3', '4', '7', 'Jane Doe', 'choofyp@hotmail.com', 'Lorong Kekw 123', 'kek', '0161262969', '68eacb97d86f0c4621fa2b0e17cabd8c', '8c57f54079021f6acb9a7f7cafc16c32', 'Activated', '2020-07-15', '2020-07-10 16:08:33', '2020-07-15 11:43:16'),
(12, NULL, NULL, NULL, 'Daus Kassim', 'vxprofessional@gmail.com', NULL, NULL, NULL, NULL, NULL, 'Activated', NULL, '2020-07-11 11:22:46', '2020-07-11 11:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `member_visits`
--

CREATE TABLE `member_visits` (
  `id` int(11) NOT NULL,
  `member` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_visits`
--

INSERT INTO `member_visits` (`id`, `member`, `name`, `action`, `created`) VALUES
(1, '1', 'Jonathan Wong', 'login', '2020-05-27 05:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `navigator`
--

CREATE TABLE `navigator` (
  `id` int(11) NOT NULL,
  `section` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `navigator`
--

INSERT INTO `navigator` (`id`, `section`, `name`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Footer - Grocere - About Us', 'About Us', '1', '1', '2020-06-30 11:51:41', '2020-06-30 13:08:49'),
(2, 'Footer - Grocere - Blog', 'Blog', '2', '1', '2020-06-30 11:52:12', '2020-06-30 13:08:54'),
(3, 'Footer - Grocere - Terms of Use', 'Terms of Use', '3', '1', '2020-06-30 11:53:10', '2020-06-30 13:08:58'),
(4, 'Footer - Grocere - Privacy Policy', 'Privacy Policy', '4', '1', '2020-06-30 11:53:35', '2020-06-30 13:09:02'),
(5, 'Footer - Customer Service - Contact Us', 'Contact Us', '5', '1', '2020-06-30 11:53:55', '2020-06-30 13:09:05'),
(6, 'Footer - Customer Service - Help', 'Help', '6', '1', '2020-06-30 11:54:09', '2020-06-30 13:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `location` varchar(11) DEFAULT NULL,
  `area` varchar(11) DEFAULT NULL,
  `driver` varchar(11) DEFAULT NULL,
  `member` varchar(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `delivery_fee` decimal(11,2) DEFAULT NULL,
  `delivery_method` varchar(10) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `pickup_time` varchar(25) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `rebate_earned` decimal(11,2) DEFAULT NULL,
  `rebate_used` decimal(11,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `confirmed_date` datetime DEFAULT NULL,
  `accepted_date` datetime DEFAULT NULL,
  `accepted_span` varchar(5) DEFAULT NULL,
  `decline_date` datetime DEFAULT NULL,
  `decline_span` varchar(5) DEFAULT NULL,
  `decline_remark` varchar(255) DEFAULT NULL,
  `receipt_date` datetime DEFAULT NULL,
  `receipt_span` varchar(5) DEFAULT NULL,
  `receipt_id` varchar(25) DEFAULT NULL,
  `delivered_date` datetime DEFAULT NULL,
  `delivered_span` varchar(5) DEFAULT NULL,
  `cron` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `pid`, `session`, `location`, `area`, `driver`, `member`, `customer_name`, `address`, `delivery_fee`, `delivery_method`, `delivery_date`, `pickup_time`, `total`, `rebate_earned`, `rebate_used`, `payment_status`, `payment_date`, `confirmed_date`, `accepted_date`, `accepted_span`, `decline_date`, `decline_span`, `decline_remark`, `receipt_date`, `receipt_span`, `receipt_id`, `delivered_date`, `delivered_span`, `cron`, `status`, `created`, `modified`) VALUES
(1, NULL, 'ggggg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-07 15:11:37', '2020-07-07 15:11:37'),
(2, 'PID5F04202952959', '23892c721e930091584256f8cfe99242', '4', '4', '2', '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-07-08', NULL, '71.80', '0.62', NULL, 'Paid', '2020-07-07 15:11:59', '2020-07-07 15:11:37', '2020-07-08 11:57:21', '20.76', NULL, NULL, NULL, '2020-07-08 11:58:08', '0.01', '5F0544507EA7A', '2020-07-10 09:44:19', '45.77', NULL, 'Delivered', '2020-07-07 15:11:37', '2020-07-10 09:44:19'),
(3, 'PID5F0422A328E95', 'c1c234eeb241ee537179d6db73c716ed', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-08', NULL, '61.00', '0.51', NULL, 'Paid', '2020-07-07 15:22:41', '2020-07-07 15:22:11', NULL, NULL, '2020-07-10 09:30:38', '66.14', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-07 15:22:11', '2020-07-10 09:30:38'),
(4, 'PID5F044D7402734', '8e69e5e647cbdc32fd215642d8164e62', '4', '10', '1', '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-08', NULL, '63.29', '0.54', '0.51', 'Paid', '2020-07-07 18:25:25', '2020-07-07 18:24:52', '2020-07-10 00:10:58', '53.77', NULL, NULL, NULL, '2020-07-10 00:11:26', '0.01', '5F0741AE3A777', '2020-07-10 00:11:59', '0.01', NULL, 'Delivered', '2020-07-07 18:24:52', '2020-07-10 00:11:59'),
(5, 'PID5F05224550C11', '74ad0cb58d0ac966c4dc05f51361cd35', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '75.00', '0.65', NULL, 'Paid', '2020-07-08 09:33:07', '2020-07-08 09:32:53', NULL, NULL, '2020-07-10 18:28:35', '56.93', '', NULL, NULL, NULL, NULL, NULL, '2020-07-10 10:38:53', 'Decline', '2020-07-08 09:32:53', '2020-07-10 18:28:35'),
(6, 'PID5F0522E9D491C', '40566d847d35ca7a2bc3499a8ac231f8', '4', '4', '1', '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '96.40', '0.86', '0.00', 'Paid', '2020-07-08 09:35:50', '2020-07-08 09:35:37', '2020-07-08 11:06:34', '1.52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-08 09:35:37', '2020-07-08 11:37:17'),
(7, 'PID5F052DA3E608B', '1b6c8892efec9627a39b5d0bd7d80453', '4', '4', '1', '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '78.00', '0.68', NULL, 'Paid', '2020-07-08 10:21:42', '2020-07-08 10:21:23', '2020-07-08 10:25:35', '0.07', NULL, NULL, NULL, '2020-07-08 11:07:42', '0.70', '5F05387E3901C', '2020-07-08 11:58:47', '0.85', NULL, 'Delivered', '2020-07-08 10:21:23', '2020-07-08 11:58:47'),
(8, 'PID5F053D340B8F6', '6960f9108374b673854ce1c674640fcc', '4', '10', '', '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-08', '45.80', '0.46', NULL, 'Paid', '2020-07-08 11:28:10', '2020-07-08 11:27:48', '2020-07-08 11:30:48', '0.05', NULL, NULL, NULL, '2020-07-08 11:31:22', '0.01', '5F053E0AABBFC', '2020-07-08 11:33:34', '0.04', NULL, 'Delivered', '2020-07-08 11:27:48', '2020-07-08 12:21:21'),
(9, 'PID5F05479D4DEC8', '4c1a59289e12925098c07d92ae5fada5', '4', '5', NULL, '7', 'JP', 'address', '0.00', 'deliver', '2020-07-08', NULL, '55.00', '0.55', NULL, 'Paid', '2020-07-08 12:12:47', '2020-07-08 12:12:13', NULL, NULL, '2020-07-10 00:12:56', '36.01', 'cancel order', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-08 12:12:13', '2020-07-10 00:12:56'),
(10, 'PID5F054A3F4D284', '49a14ae70d212bd5ec19b01fafff6772', '4', '5', NULL, '7', 'JP', 'address', NULL, 'pickup', NULL, '2020-07-08', '35.00', '0.35', NULL, 'Paid', '2020-07-08 12:24:16', '2020-07-08 12:23:27', NULL, NULL, '2020-07-10 00:12:56', '35.82', 'cancel order', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-08 12:23:27', '2020-07-10 00:12:56'),
(11, 'PID5F054A8B932E5', '77aa6fe1a2019a359c9e7ec4ec7238f3', '4', '5', NULL, '7', 'JP', 'address', NULL, 'pickup', NULL, '2020-07-08', '32.30', '0.32', NULL, 'Paid', '2020-07-08 12:24:56', '2020-07-08 12:24:43', NULL, NULL, '2020-07-10 18:28:35', '54.06', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-08 12:24:43', '2020-07-10 18:28:35'),
(12, 'PID5F054D125B140', '84b044789f73a0a3d47a37f5186fa108', '4', '5', NULL, '8', 'DC', 'address', NULL, 'pickup', NULL, '2020-07-08', '37.80', '0.38', NULL, 'Paid', '2020-07-08 12:35:35', '2020-07-08 12:35:30', '2020-07-08 12:56:04', '0.34', NULL, NULL, NULL, '2020-07-08 12:58:38', '0.04', '5F05527EF14A1', '2020-07-08 12:58:45', '0.00', NULL, 'Delivered', '2020-07-08 12:35:30', '2020-07-08 12:58:45'),
(13, 'PID5F0553793EDAA', '80df75f62f99ae02c702e740e5e14311', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-08', '30.10', '0.30', '0.00', 'Paid', '2020-07-08 13:03:04', '2020-07-08 13:02:49', NULL, NULL, '2020-07-10 00:05:58', '35.05', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-08 13:02:49', '2020-07-10 00:09:16'),
(14, 'PID5F0565C45B0A7', '7284eb4419d0cdd5b4d296d28cad85e1', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-07-09', NULL, '107.40', '0.97', NULL, 'Paid', '2020-07-08 14:21:07', '2020-07-08 14:20:52', NULL, NULL, '2020-07-10 18:28:34', '52.13', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-08 14:20:52', '2020-07-10 18:28:34'),
(15, 'PID5F056681084B4', '1eab60b73bc95f4d8a1d0d538cbba40f', '4', '4', '1', '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-07-09', NULL, '80.00', '0.70', NULL, 'Paid', '2020-07-08 14:24:23', '2020-07-08 14:24:01', '2020-07-08 14:51:24', '0.46', NULL, NULL, NULL, '2020-07-08 14:51:58', '0.01', '5F056D0EE5D43', '2020-07-08 14:52:22', '0.01', NULL, 'Delivered', '2020-07-08 14:24:01', '2020-07-08 14:52:22'),
(16, 'PID5F0576C3482B3', '321282132cda011d213cf358c4446539', '4', '7', '1', '9', 'Eddie Lim', 'No 174, Lorong Stutong', '2.00', 'deliver', '2020-07-09', NULL, '67.10', '0.65', NULL, 'Paid', '2020-07-08 15:39:52', '2020-07-08 15:33:23', NULL, NULL, '2020-07-10 18:28:34', '50.92', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-08 15:33:23', '2020-07-10 18:28:34'),
(17, 'PID5F057A19D7FD8', 'a134706206d7bd311e3f4367f40bbbb7', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-08', '30.80', '0.31', NULL, 'Paid', '2020-07-08 15:48:00', '2020-07-08 15:47:37', '2020-07-10 09:43:30', '41.93', NULL, NULL, NULL, '2020-07-10 09:44:07', '0.01', '5F07C7E757BD6', '2020-07-10 09:44:18', '0.00', NULL, 'Delivered', '2020-07-08 15:47:37', '2020-07-10 09:44:18'),
(18, 'PID5F067791E6B34', 'a3d962733768c7ec584456381e80a91c', '4', '7', NULL, '9', 'Eddie Lim', 'No 174, Lorong Stutong', NULL, 'pickup', NULL, '2020-07-09', '69.35', '0.70', '0.65', 'Paid', '2020-07-09 09:49:32', '2020-07-09 09:49:05', '2020-07-10 09:43:30', '23.91', NULL, NULL, NULL, '2020-07-10 09:44:07', '0.01', '5F07C7E71CAE2', '2020-07-10 09:44:18', '0.00', NULL, 'Delivered', '2020-07-09 09:49:05', '2020-07-10 09:44:18'),
(19, 'PID5F06784FCD87B', 'bb5961037e97f703eb948d24045205d6', '4', '7', '1', '9', 'Eddie Lim', 'No 174, Lorong Stutong', '2.00', 'deliver', '2020-07-09', NULL, '87.70', '0.86', '0.70', 'Paid', '2020-07-09 09:52:39', '2020-07-09 09:52:15', '2020-07-09 10:00:39', '0.14', NULL, NULL, NULL, '2020-07-09 10:02:09', '0.03', '5F067AA1A911F', '2020-07-09 10:02:36', '0.01', NULL, 'Delivered', '2020-07-09 09:52:15', '2020-07-09 10:02:36'),
(20, 'PID5F067E26DF2EC', '536e203fc1259d230c818c220ad44cf1', '4', '5', NULL, '8', 'DC', 'address', NULL, 'pickup', NULL, '2020-07-09', '37.00', '0.37', '0.00', 'Paid', '2020-07-09 10:17:17', '2020-07-09 10:17:10', '2020-07-09 10:18:03', '0.01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-09 10:17:10', '2020-07-09 10:18:39'),
(21, 'PID5F067EDC960A3', 'a9ec642df0df50e999197f45bbb2f7a5', '4', '5', '2', '8', 'DC', 'address', NULL, 'pickup', NULL, '2020-07-09', '40.00', '0.40', NULL, 'Paid', '2020-07-09 10:20:17', '2020-07-09 10:20:12', '2020-07-09 10:20:36', '0.01', NULL, NULL, NULL, '2020-07-09 10:20:42', '0.00', '5F067EFAE4E76', '2020-07-09 10:24:19', '0.06', NULL, 'Delivered', '2020-07-09 10:20:12', '2020-07-09 15:22:02'),
(22, 'PID5F06883C6B146', '3dd06dbbd34b6ae0cd407fef3272bb45', '4', '5', NULL, '8', 'DC', 'address', NULL, 'pickup', NULL, '2020-07-10', '50.00', '0.50', NULL, 'Paid', '2020-07-09 11:00:17', '2020-07-09 11:00:12', NULL, NULL, '2020-07-09 11:00:30', '0.01', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-09 11:00:12', '2020-07-09 11:00:30'),
(23, 'PID5F06E4DD5F129', 'd23b9c5585548716b119160b17549a6a', '4', '5', NULL, '8', 'DC', 'address', NULL, 'pickup', NULL, '2020-07-09', '40.00', '0.40', NULL, 'Paid', '2020-07-09 17:35:35', '2020-07-09 17:35:25', '2020-07-10 09:43:29', '16.13', NULL, NULL, NULL, '2020-07-10 09:44:06', '0.01', '5F07C7E6DC6A9', '2020-07-10 09:44:18', '0.00', NULL, 'Delivered', '2020-07-09 17:35:25', '2020-07-10 09:44:18'),
(24, 'PID5F074997D2D47', 'ccc9d0dab15fb42c7e7e1d809b654c5b', '4', '10', '5', '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-09', NULL, '58.79', '0.50', '0.00', 'Paid', '2020-07-10 00:45:28', '2020-07-10 00:45:11', NULL, NULL, '2020-07-10 00:47:27', '0.04', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 00:45:11', '2020-07-10 00:48:23'),
(25, 'PID5F07C67634454', '95fb0c9bd44e4a935fb1bf06f5cd1035', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-10', '31.00', '0.31', NULL, 'Paid', '2020-07-10 09:38:15', '2020-07-10 09:37:58', NULL, NULL, '2020-07-10 09:39:26', '0.02', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 09:37:58', '2020-07-10 09:39:26'),
(26, 'PID5F07C8BCBB6A5', '56f894032436738ea9be12a3422f9a48', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-10', NULL, '63.40', '0.53', '0.00', 'Paid', '2020-07-10 09:47:55', '2020-07-10 09:47:40', NULL, NULL, '2020-07-10 09:49:05', '0.02', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 09:47:40', '2020-07-10 11:10:22'),
(27, 'PID5F07CDB3E63DD', '93dfa55bc6cc7c96a68aa20568cc482e', '4', '10', NULL, '2', 'Daus Grocere', 'qweqweeqwe', NULL, 'pickup', NULL, '2020-07-10', '33.00', '0.00', '0.00', 'Paid', '2020-07-10 10:09:05', '2020-07-10 10:08:51', NULL, NULL, '2020-07-10 15:09:07', '5.00', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 10:08:51', '2020-07-10 15:09:31'),
(28, 'PID5F07D93550BC0', 'b4c9a2b9e201e3744e6f1d27e031a972', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-11', '34.20', '0.34', NULL, 'Paid', '2020-07-10 10:58:14', '2020-07-10 10:57:57', NULL, NULL, '2020-07-10 11:49:22', '0.86', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 10:57:57', '2020-07-10 11:49:22'),
(29, 'PID5F07DAB56E0AC', '93116e25c5f40836b8772b4c229b5683', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-10', '37.40', '0.37', '0.00', 'Paid', '2020-07-10 11:04:37', '2020-07-10 11:04:21', NULL, NULL, '2020-07-10 11:48:26', '0.73', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 11:04:21', '2020-07-10 11:49:57'),
(30, 'PID5F07DC8642E91', '12970c3b9e327b4a2c08ce3c83e04ec1', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '71.40', '0.61', NULL, 'Paid', '2020-07-10 11:12:17', '2020-07-10 11:12:06', '2020-07-10 11:12:26', '0.01', '2020-07-10 11:17:03', '0.08', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 11:12:06', '2020-07-10 11:17:03'),
(31, 'PID5F07E5B843D3D', 'a6631e978c58f52603f27d5b8ed947b9', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-10', '28.77', '0.32', '2.83', 'Paid', '2020-07-10 11:51:32', '2020-07-10 11:51:20', NULL, NULL, '2020-07-10 11:54:02', '0.05', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 11:51:20', '2020-07-10 11:54:02'),
(32, 'PID5F08075F610A7', 'b487c81b01ea5cd9d6044ba10bdb2f11', '4', '10', '5', '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-11', NULL, '61.47', '0.54', '0.00', 'Paid', '2020-07-10 14:15:15', '2020-07-10 14:14:55', NULL, NULL, '2020-07-10 14:18:14', '0.06', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 14:14:55', '2020-07-10 14:19:17'),
(33, 'PID5F0809F052B58', '30eeaa926643ee9ea474610b4671b632', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-07-11', NULL, '59.52', '0.54', '4.48', 'Paid', '2020-07-10 14:26:14', '2020-07-10 14:25:52', NULL, NULL, '2020-07-10 18:28:34', '4.05', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 14:25:52', '2020-07-10 18:28:34'),
(34, 'PID5F080AA555F4D', '5732422919ae326955b36ffba854449e', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-07-11', NULL, '59.46', '0.49', '0.54', 'Paid', '2020-07-10 14:29:13', '2020-07-10 14:28:53', NULL, NULL, '2020-07-10 18:28:34', '3.99', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 14:28:53', '2020-07-10 18:28:34'),
(35, 'PID5F080CEBED225', '95a2556058a87bacb9e9267c7960060b', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-11', NULL, '57.13', '0.47', '0.00', 'Paid', '2020-07-10 14:38:53', '2020-07-10 14:38:35', NULL, NULL, '2020-07-10 14:40:06', '0.03', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 14:38:35', '2020-07-10 14:40:23'),
(36, 'PID5F0814B8ADC9A', '8e07c38a187bf0154f7f047597d4d3a9', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', '10.00', 'deliver', '2020-07-11', NULL, '57.89', '0.00', '0.00', 'Paid', '2020-07-10 15:12:06', '2020-07-10 15:11:52', NULL, NULL, '2020-07-10 15:12:55', '0.02', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 15:11:52', '2020-07-10 15:13:26'),
(37, 'PID5F08245793302', '3e35c5611e72df22cb4e3d90a70e120b', '4', '4', NULL, '11', 'Jane Doe', 'Lorong Kekw 123', '10.00', 'deliver', '2020-07-11', NULL, '68.00', '0.58', NULL, 'Pending', NULL, '2020-07-10 16:18:31', NULL, NULL, '2020-07-10 18:28:33', '2.17', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 16:15:48', '2020-07-10 18:28:33'),
(38, 'PID5F08242F5E7E9', '4911ab9ca3d555409e8eb8d62eb66f51', '4', '5', NULL, '8', 'DC', 'address1', NULL, 'pickup', NULL, NULL, '40.00', '0.40', NULL, 'Pending', NULL, '2020-07-10 16:17:51', NULL, NULL, '2020-07-10 18:28:33', '2.18', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Decline', '2020-07-10 16:17:51', '2020-07-10 18:28:33'),
(39, 'PID5F082ED4C029D', '9e90ffd5f35f6d7eed9cff94047056c1', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-10', '35.29', '0.00', '0.00', 'Paid', '2020-07-10 17:03:36', '2020-07-10 17:03:16', NULL, NULL, '2020-07-10 17:04:54', '0.03', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 17:03:16', '2020-07-10 17:05:47'),
(40, 'PID5F0841130C0BB', 'e8ad22985af5cd28c02f6cf448cdba6b', '4', '10', NULL, '2', 'Daus Grocere', 'ORIENT BIOGREEN SURVEY LOT 8051, LOT 7002, BLOCK 5, KUALA BARAM LAND DISTRICT, LUTONG KUALA BARAM ROAD, 98000 MIRI, SARAWAK', NULL, 'pickup', NULL, '2020-07-11', '28.49', '0.00', '0.00', 'Paid', '2020-07-10 18:21:26', '2020-07-10 18:21:07', NULL, NULL, '2020-07-10 18:25:56', '0.08', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-10 18:21:07', '2020-07-10 18:26:03'),
(41, 'PID5F0856CDDE05F', '19c5bcc6ae6a10c04c25da9b7c1e3c59', '4', '4', NULL, '11', 'Jane Doe', 'Lorong Kekw 123', '10.00', 'deliver', '2020-07-11', NULL, '103.00', '0.93', NULL, 'Paid', '2020-07-10 19:54:36', '2020-07-10 19:53:49', '2020-07-10 20:09:15', '0.26', NULL, NULL, NULL, '2020-07-10 20:10:02', '0.01', '5F085A9A11DD8', '2020-07-10 20:10:19', '0.00', NULL, 'Delivered', '2020-07-10 19:53:49', '2020-07-10 20:10:19'),
(42, 'PID5F09329AAD8BB', 'd070ff3d9d11496d15f40edc93b7f840', '4', '10', '2', '2', 'Daus Grocere', 'qweqweeqwe', '10.00', 'deliver', '2020-07-11', NULL, '60.24', '0.00', '0.00', 'Paid', '2020-07-11 11:31:52', '2020-07-11 11:31:38', NULL, NULL, '2020-07-11 11:33:18', '0.03', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Refunded', '2020-07-11 11:31:38', '2020-07-11 11:34:02'),
(43, 'PID5F0BDD9A29857', '426cf69d686678616e80d78fc78472ff', '4', '7', '2', '9', 'Eddie Lim', 'No 174, Lorong Stutong', NULL, 'pickup', NULL, '2020-07-13', '61.60', '0.62', NULL, 'Paid', '2020-07-13 12:06:10', '2020-07-13 12:05:46', '2020-07-13 12:06:20', '0.01', NULL, NULL, NULL, '2020-07-13 12:06:31', '0.00', '5F0BDDC735B00', '2020-07-13 13:56:59', '1.84', NULL, 'Delivered', '2020-07-13 12:05:46', '2020-07-13 13:56:59'),
(44, 'PID5F20FFE0B7B5E', 'c6208528a7c540825381baebdf841f8d', '4', '7', '2', '2', 'Daus Grocere', 'Lot 123', '2.00', 'deliver', '2020-07-29', NULL, '57.30', '0.55', NULL, 'Paid', '2020-07-29 12:50:00', '2020-07-29 12:49:36', '2020-07-29 12:51:40', '0.03', '2020-07-29 12:16:23', '0.08', '', '2020-07-29 12:52:17', '0.01', '5F2100819CA1E', '2020-07-29 12:53:04', '0.01', NULL, 'Delivered', '2020-07-29 12:11:32', '2020-07-29 12:53:04'),
(45, 'PID5F2263076D80F', '4f53e2b6703782cf15e3e3fc373ce9dd', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', NULL, 'pickup', NULL, NULL, '52.80', '0.53', NULL, 'Pending', NULL, '2020-07-30 14:04:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-07-30 14:04:04', '2020-07-30 14:04:55'),
(46, 'PID5F2277B6E23A2', 'cb8b0a05c03e8162bf43cc9100275176', '4', '7', NULL, '2', 'Daus Grocere', 'Lot 123', NULL, 'pickup', NULL, '2020-07-30', '37.50', '0.38', NULL, 'Pending', NULL, '2020-07-30 15:33:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-07-30 15:33:10', '2020-07-30 15:33:10'),
(47, 'PID5F32623CDDEF1', 'vntifpp09r071ia9gt1gp8s4qb', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', '2020-08-12', NULL, '64.00', '0.54', NULL, 'Pending', NULL, '2020-08-11 17:17:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-08-11 17:17:48', '2020-08-11 17:17:48'),
(48, 'PID5F51F761EF5C0', 'ogottslkjhsf545k8juhjdhr6k', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '9.20', 'deliver', NULL, NULL, '13.20', '0.04', NULL, 'Pending', NULL, '2020-09-04 16:14:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-09-04 15:57:20', '2020-09-04 16:14:25'),
(49, 'PID5F55BCD411BDB', 'nnvnlatgu02upbgeldu4i28blu', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '57.70', '0.48', NULL, 'Pending', NULL, '2020-09-07 12:53:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-09-07 12:28:54', '2020-09-07 12:53:40'),
(50, 'PID5F55C1D5B61D1', '9a3l78litm422bul22pen28u8m', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '9.20', 'deliver', NULL, NULL, '13.20', '0.04', NULL, 'Pending', NULL, '2020-09-07 13:15:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-09-07 13:15:01', '2020-09-07 13:15:01'),
(51, 'PID5F55DB381FAEA', 'btnjq7ng837q4p6ugoaqkao0a2', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '10.00', 'deliver', NULL, NULL, '26.50', '0.17', NULL, 'Pending', NULL, '2020-09-07 15:03:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-09-07 14:51:19', '2020-09-07 15:03:20'),
(52, 'PID5F55DF6B1737D', 'jv7g7a7aptlegg411tkdmiab9r', '4', '4', NULL, '1', 'Jonathan', 'dssads dsad sadsad sa', '9.20', 'deliver', NULL, NULL, '13.20', '0.04', NULL, 'Paid', '2020-09-07 15:32:48', '2020-09-07 15:21:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'New', '2020-09-07 15:21:15', '2020-09-07 15:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `navigator` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `page` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `navigator`, `page`, `position`, `status`, `created`, `modified`) VALUES
(1, '1', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p style=\"margin: 0cm 0cm 20.0pt 0cm;\"><span style=\"font-size: 13.5pt; font-family: \'Helvetica\',sans-serif; mso-bidi-font-family: \'Times New Roman\'; color: #212b35;\"><span style=\"color: #f32758;\"><strong>About us</strong></span></span></p>\r\n<p class=\"MsoNormal\">Grocere.com.my was founded in early 2020 by Nutribest Fresh Farm Sdn. Bhd. to enhance online grocery shopping experience for Sarawak region, currently have 7 local store in Kuching, 1 in Sibu and 2 in Miri.</p>\r\n<p class=\"MsoNormal\">We own local fresh farm to provide a fresh meat and fruit which available for Same-Day Delivery. All our fresh meats that we sell are Halal. Although we have our own food brand, we do sell wide range of food by different vendors.</p>\r\n<p class=\"MsoNormal\">The concept of Grocere.com.my is to provide Halal Fresh food, fast delivery, convenience payment <span style=\"color: #000000;\">methods</span> and user friendly website/mobile applications for better user experience.</p>\r\n<p class=\"MsoNormal\">Fresh food, Same-Day delivery, quality service and easy payment is all here @ Grocere.com.my</p>\r\n</body>\r\n</html>', '1', '1', '2020-05-12 12:13:19', '2020-07-01 10:03:14'),
(2, '2', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Free delivery whole Miri from 1st August - 31st October 2020 !</p>\r\n</body>\r\n</html>', '2', '1', '2020-06-17 12:32:52', '2020-07-30 16:34:32'),
(3, '3', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h1>TERMS OF USE</h1>\r\n<ol>\r\n<li>INTRODUCTION\r\n<ol>\r\n<li>Welcome to Grocere.com.my (our &ldquo;Site&rdquo; or &ldquo;mobile application&rdquo;). These Terms of Use constitute a legally binding agreement made between you, whether personally or on behalf of an entity (&ldquo;you&rdquo;) and Grocere.com.my (&ldquo;company&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo; or &ldquo;our&rdquo;) (we refer to the Site, Mobile Application and the services we provide collectively in this Terms of Use as the \"Services\")., concerning your access to and use of the Grocere.com.my website as well as mobile application or services related to Grocere.com.my.</li>\r\n<li>By using the Services, visiting our Website, using our Mobile Application or order goods from our Website or Mobile Application you agree that you have read, understood and agree to be bound by all of the Terms of Use and Privacy Policy as stated in our Privacy Policy page. If you do not agree with all of these terms of use and privacy policy, please do not use our Services or access this website.</li>\r\n</ol>\r\n</li>\r\n<li>LIMITED LICENSE\r\n<ol>\r\n<li>Unless otherwise indicated, the Site and Mobile Application is our proprietary property and all source code, databases, functionality, software, website designs, audio, video, text, photographs and graphics on the Site or Mobile Application (collectively, the &ldquo;Content&rdquo;) and the trademarks, service marks, and logos contained therein (the &ldquo;Marks&rdquo;) are owned or controlled by us or licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and unfair competition laws of the Malaysia, foreign jurisdictions, and international conventions.</li>\r\n<li>Provided that you are eligible to use our Services, you are granted a limited license to access and use our Services and link the Site from your website, share the Site, download or print copy of any portion of the Content to which you have properly gained access solely for your personal, non-commercial use. We reserve all rights not expressly granted to you in and to the Site, the Content and the Marks.</li>\r\n</ol>\r\n</li>\r\n<li>ACCOUNT\r\n<ol>\r\n<li>Before using our services, you are required to create user account for Grocere.com.my (&ldquo;Site&rdquo; or &ldquo;Mobile Application&rdquo;), you must read, understood and accept all of these Terms of Service and Privacy Policy as stated in Privacy Policy page (www.Grocere.com.my/Privacy-Policy).</li>\r\n<li>In the create account page, Grocere.com.my only provide choice of available Region and Area based on selected region. All available region means we have local outlet and all available Area (based on selected region) are deliverable area. Grocere.com.my only process and delivery order for deliverable area.</li>\r\n<li>Only one (1) Grocere.com.my account is allowed for each registered phone number or email address.</li>\r\n<li>By creating user account, you represent that you are at least eighteen (18) Years Old.</li>\r\n<li>We consider the following actions as listed below (3.4.1 &ndash; 3.4.5) are prohibited use of Grocere.com.my account and we reserve right to terminate your account, cancel and suspend all order.\r\n<ol>\r\n<li>Usage of account for illegal activities</li>\r\n<li>Usage of any type of Hack, reverse engineer, decompile the Services (&ldquo;Site&rdquo; or &ldquo;Mobile Application&rdquo;)</li>\r\n<li>Attempt to scam, misleading or any related to fraudulent activities</li>\r\n<li>Creating false, misleading, phishing link to our reviews or feedback that can harm our reputation related to Grocere.com.my or other users.</li>\r\n<li>Creating account on behalf of other person without their authorization</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>PURCHASE\r\n<ol>\r\n<li>We only accept payment by using our available payment method:\r\n<ol>\r\n<li>Credit Card\r\n<ol>\r\n<li>Visa</li>\r\n<li>American Express</li>\r\n<li>MasterCard</li>\r\n<li>UnionPay</li>\r\n</ol>\r\n</li>\r\n<li>Online Banking\r\n<ol>\r\n<li>Maybank2u</li>\r\n<li>Cimb Clicks</li>\r\n<li>Alliance Bank</li>\r\n<li>Public Bank</li>\r\n<li>Bank Islam</li>\r\n<li>RHB Now</li>\r\n<li>Standard Chartered</li>\r\n<li>HSBC</li>\r\n<li>Hong Leong Connect</li>\r\n<li>AmBank Group</li>\r\n<li>I Rakyat</li>\r\n<li>Bank Muamalat</li>\r\n<li>Kfh Online</li>\r\n<li>UOB</li>\r\n<li>OCBC</li>\r\n<li>Affin Bank</li>\r\n</ol>\r\n</li>\r\n<li>E-Wallet\r\n<ol>\r\n<li>Touch n Go</li>\r\n<li>Boost</li>\r\n<li>Mcash</li>\r\n<li>GrabPay</li>\r\n<li>Maybank QRPAY</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>You agree to provide current, complete, and accurate purchase and account information for all purchases made via Grocere.com.my (&ldquo;Site&rdquo; or &ldquo;Mobile Application&rdquo;). You further agree to promptly update account and payment information, including email address, payment method, and payment card expiration date, so that we can complete your transactions and contact as your needed. Sales tax will be added to the price of purchases as deemed required by us. We may change prices at any time. All payment shall be in Malaysian Ringgit (MYR).</li>\r\n<li>You agree to pay all charges at the prices then in effect for your purchases and any applicable shipping fees, and you authorize us to charge your chosen payment provider for any such amounts upon placing your order.</li>\r\n<li>You are required to sign a company copy form (receipt, order bill, or any related to receiving goods form) that given by us during receive your goods in order to complete the order.</li>\r\n</ol>\r\n</li>\r\n<li>PRODUCTS\r\n<ol>\r\n<li>We make every effort to display as accurately as possible the colors, features, specifications, and details of the products available on Grocere.com.my. However, we do not guarantee that the colors, features, specifications, and the details of the products will be accurate, complete, reliable, current, or free of other errors, and your electronic display may not accurately reflect the actual colors and details of the products.</li>\r\n<li>All products are subject to availability [, and we cannot guarantee the items will be in stock]. We reserve the right to amend your order with your agreement or cancel your order any time for any reason follow up with our Refund Policy as stated in (5) RETURN/REFUND POLICY.</li>\r\n</ol>\r\n</li>\r\n<li>RETURN/REFUND POLICY\r\n<ol>\r\n<li>All complete order (signed by receiver) after twenty-four (24) hours are final and no refund/return will be issued.</li>\r\n<li>This Return/Refund process only valid if:\r\n<ol>\r\n<li>There is amendment by us that you agree or disagree during processing your order.</li>\r\n<li>There is a system error or product defects with valid evidence before twenty-four (24) hours after goods are delivered.</li>\r\n</ol>\r\n</li>\r\n<li>Your used Cash Rebate during checkout are refundable to your account.</li>\r\n</ol>\r\n</li>\r\n<li>LOYALTY PROGRAM\r\n<ol>\r\n<li>Our loyalty are only for Grocere.com.my account (&ldquo;Site&rdquo; or &ldquo;Mobile Application&rdquo;).</li>\r\n<li>You can earn rebates by make payment of total order that deducted by Cash rebate (if you use) through Grocere.com.my (&ldquo;Site&rdquo; or &ldquo;Mobile Application&rdquo;). [You will not earn rebates by Cash Rebate that you used for the order]</li>\r\n<li>Example if our current rates are 1%: One hundred (100) Ringgit Malaysia (RM) that you spend equal to One (1) Ringgit Malaysia (RM). You will earn 1% rebates for every RM you spent on total order that are deducted by Cash Rebate (if you use).</li>\r\n<li>You only earn cash rebate based on cart total and you will not earn cash rebate by delivery charges. Maximum usage of cash rebates are 30% amount of the cart total.</li>\r\n<li>Cash Rebate will automatically refund to your account if the order are cancelled.</li>\r\n<li>Cash Rebate are Non Withdrawable.</li>\r\n</ol>\r\n</li>\r\n<li>SHIPPING\r\n<ol>\r\n<li>8.1. Delivery\r\n<ol>\r\n<li>Our standard delivery time is from 7:00AM &ndash; 4:00PM.</li>\r\n<li>Our delivery service only operate on Monday &ndash; Saturday.</li>\r\n<li>Same-Day delivery are only valid for complete order transaction before 2:00PM</li>\r\n<li>If you are unable to collect your Goods (you entered wrong address, no one home or not responding to our communications) when our delivery team reach your destination, your Order will labelled as &ldquo;Fail delivery&rdquo; and our delivery team will return all the Goods to our local store and delivery charges are still applicable and chargeable. For fail delivery order, you can collect your item by:\r\n<ol>\r\n<li>In-Store Pickup at our local store.</li>\r\n<li>You can request redelivery service which only charge you for delivery fee.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>In-Store Pickup\r\n<ol>\r\n<li>Our in-store pickup time is from 7:00AM &ndash; 7:00PM</li>\r\n<li>Our in-store pickup only operate on Monday &ndash; Saturday</li>\r\n<li>Same-Day In-Store Pickup only valid for complete order transaction before 6:00PM</li>\r\n<li>If you unable to collect your Goods for three (3) days after complete order transaction (except Sunday), we will label your order as &ldquo;Fail delivery&rdquo;, your transaction are non-refundable and your packed Goods are belong to Grocere.com.my.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n<li>Personal Information\r\n<ol>\r\n<li>You are required to provide us a valid personal data as required during Create Account (Full name, Email Address, Malaysian (+6) Mobile Number, Region, Area &amp; Delivery Address) as this will ease the shipping purposes and contacts purposes.</li>\r\n<li>By creating Grocere.com.my account, you authorize us to collect your personal information and payment used for our internal purposes (Order records, Receipt records, Customer Contacts, Shipping, Transaction issues and return/refund policy process).</li>\r\n</ol>\r\n</li>\r\n<li>Miscellaneous\r\n<ol>\r\n<li>Grocere.com.my may modify these Terms of Service at any time and was last updated on 4 May 2020. <br />If you have any questions, feel free to contact us directly here: Support@grocere.com.my</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</body>\r\n</html>', '3', '1', '2020-06-17 13:03:31', '2020-07-10 15:06:38'),
(4, '4', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h1>PRIVACY POLICY</h1>\r\n<h2>1. INTRODUCTION</h2>\r\n<p>Thank you for choosing Grocere.com.my (&ldquo;Company&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo;, or &ldquo;our&rdquo;). We are committed to protecting your personal information and your right to privacy. When you visit our and use our services, you trust us with your personal information. We take your privacy very seriously. In this privacy policy, we seek to explain to you in the clearest way possible what information we collect, how we use it and what rights you have in relation to it. We hope you take some time to read through it carefully, as it is very important. If there are any terms in this privacy policy that you do not agree with, please discontinue use of Grocere.com.my and our services. This privacy policy applies to all information collected through our and or any related services, sales, marketing or events (we refer to them collectively in this privacy policy as the \"Services\"). Please read this privacy policy carefully as it will help you make informed decisions about sharing your personal information with us.</p>\r\n<h2>2. WHAT INFORMATION DO WE COLLECT</h2>\r\n<p>We collect personal / company information that you provide to us such as name, address, contact information and payment information. We collect personal information that you voluntarily provide to us when registering at the expressing an interest in obtaining information about us or our products and services, when participating in activities on the (such as entering competitions, contests, giveaways, promotions or enquiry) or otherwise contacting us. We automatically collect certain information when you visit, use or navigate our website www.Grocere.com.my or use our mobile applications. This information does not reveal your specific identity (personal information or contact information) but may include device and usage information, such as your IP address, browser and device information, referring URLs, country and location. This information is primarily needed for our internal analytics, reporting purposes, maintain the security and operation of our website www.Grocere.com.my or our mobile applications.</p>\r\n<h2>3. HOW WE USE YOUR PERSONAL DATA</h2>\r\n<p>We only share information with your consent, to comply with laws, to provide you with services, to protect your rights, or to fulfill business obligations. We may process or share data based on the following legal basis: Consent: We may process your data if you have given us specific consent to use your personal information in a specific purpose. Legitimate Interests: We may process your data when it is reasonably necessary to achieve our legitimate business interests. Performance of a Contract: Where we have entered into a contract with you, we may process your personal information to fulfill the terms of our contract. Legal Obligations : We may disclose your information where we are legally required to do so in order to comply with applicable law, governmental requests, a judicial proceeding, court order, or legal process, such as in response to a court order or a subpoena (including in response to public authorities to meet national security or law enforcement requirements). Vital Interests: We may disclose your information where we believe it is necessary to investigate, prevent, or take action regarding potential violations of our policies, suspected fraud, situations involving potential threats to the safety of any person and illegal activities, or as evidence in litigation in which we are involved.</p>\r\n<h2>4. THIRD-PARTY WEBSITES</h2>\r\n<p>We are not responsible for the safety of any information that you share with third-party providers who advertise, but are not affiliated with, our websites. The may contain advertisements from third parties that are not affiliated with us and which may link to other websites, online services or mobile applications. We cannot guarantee the safety and privacy of data you provide to any third parties. Any data collected by third parties is not covered by this privacy policy. We are not responsible for the content or privacy and security practices and policies of any third parties, including other websites, services or applications that may be linked to www.Grocere.com.my or our mobile applications. You should review the policies of such third parties and contact them directly to respond to your questions.</p>\r\n<h2>5. PERSONAL INFORMATION RETENTION PERIOD</h2>\r\n<p>We keep your information for as long as necessary to fulfill the purposes outlined in this privacy policy unless otherwise required by law. We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy policy, unless a longer retention period is required or permitted by law (such as tax, accounting or other legal requirements). No purpose in this policy will require us keeping your personal information for not longer than 7 Years.</p>\r\n<h2>6. CHILDREN AND MINORS</h2>\r\n<p>We do not knowingly solicit data from or market to children under 18 years of age. By using the www.Grocere.com.my or our mobile applications, you represent that you are at least 18 or that you are the parent or guardian of such a minor and consent to such minor dependent&rsquo;s use of the www.Grocere.com.my or our mobile applications.</p>\r\n<h2>7. COOKIES</h2>\r\n<p>We may use cookies and similar tracking technologies to access or store information to enhance your user experience. Cookies are small files which are stored on a user\'s browser. They are designed to hold a modest amount of data specific to a particular client and website, and can be accessed either by the web server or the client computer. This privacy policy is subject to change without notice and was last updated on 4 May 2020. If you have any questions, feel free to contact us directly here: Support@grocere.com.my</p>\r\n</body>\r\n</html>', '4', '1', '2020-06-30 13:16:38', '2020-06-30 13:17:15'),
(5, '5', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p><img src=\"../../photo/5f074779038d5.png\" alt=\"\" width=\"250\" height=\"52\" /></p>\r\n<p><span style=\"color: #f32758;\"><strong>Contact us</strong></span></p>\r\n<p>Email : <a href=\"mailto:Daus.grocere@gmail.com\">Daus.grocere@gmail.com</a></p>\r\n<p>Office :&nbsp;Orient Briogreen, Survey Lot 8051, Lot 7002, Block 5, Kuala Baram Land District, Lutong - Kuala Baram Road, 98000 Miri, Sarawak</p>\r\n<p>Phone : +6 085-491 501 (Mon - Fri, 8AM - 5PM) (Sat, 8AM - 12PM)</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</body>\r\n</html>', '5', '1', '2020-06-30 13:25:18', '2020-07-10 11:08:55'),
(6, '6', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<h1><strong>Frequently Asked Questions (FAQs):</strong></h1>\r\n<ol>\r\n<li><strong>How do i place an order?</strong>\r\n<ol>\r\n<li>Create account and login <span style=\"color: #808080;\">**Note: <em>If your house area not available in our Area list means we do not deliver to that area</em></span></li>\r\n<li>Explore our product and click ADD TO CART</li>\r\n<li>Visit our CART page</li>\r\n<li>Select shipping method then click CHECKOUT <span style=\"color: #808080;\"><em>**Note: Our In-Store pickup minimum purchase of RM30, Our Delivery service minimum purchase of RM50</em></span></li>\r\n<li>Select shipping date and address then click PAY NOW</li>\r\n<li>Complete the online payment gateway</li>\r\n<li>Done</li>\r\n</ol>\r\n</li>\r\n<li><strong>How do i use Cash Rebate?</strong>\r\n<ol>\r\n<li>You may select the toggle use or not use the Cash Rebate on the Checkout page.</li>\r\n</ol>\r\n</li>\r\n<li><strong>My area doesn\'t available in your website and i just want to use the In-Store pickup, Is that possible?</strong>\r\n<ol>\r\n<li>Yes, you may enter random address and you MUST select In-Store pickup for the shipping method on the Cart page. If you select Delivery while the address are not valid to your exact location, we will not deliver your order, we will not refund the shipping charges during the payment and we will keep your order for 3 Days for you to self pickup. More info, please visit&nbsp;<a href=\"../../Terms-of-Use\">grocere.com.my/Terms-of-Use</a> title number 8 (8.2 In-store pickup).</li>\r\n</ol>\r\n</li>\r\n<li><strong>How fast are your delivery service?</strong>\r\n<ol>\r\n<li>We will deliver to your location in the next 1 - 2 hours after payment complete.</li>\r\n<li>We will notify your order updates through registered email address.</li>\r\n<li>More info about delivery, please visit&nbsp;<a href=\".grocere.com.my/Terms-of-Use\">grocere.com.my/Terms-of-Use</a> title number 8 (8.1 Delivery)</li>\r\n</ol>\r\n</li>\r\n<li><strong>How fast are your In-Store pickup service?</strong>\r\n<ol>\r\n<li>Allow us 15-45 mins for us to prepare your order.</li>\r\n<li>We will notify your order updates through registered email address.</li>\r\n<li>More info about In-Store pickup, please visit <a href=\".grocere.com.my/Terms-of-Use\">grocere.com.my/Terms-of-Use</a> title number 8 (8.2 In-Store pickup)</li>\r\n</ol>\r\n</li>\r\n<li><strong>Do you sell halal Fresh Produce product?</strong>\r\n<ol>\r\n<li>All our fresh produce product are Halal.</li>\r\n</ol>\r\n</li>\r\n<li><strong>Do your operation side follow COVID-19 SOP?</strong>\r\n<ol>\r\n<li>Yes, we handle COVID-19 SOP very seriously in order to serve you better, clean and safe.</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h2>Have unanswered questions?</h2>\r\n<h2>Do email us at <a href=\"mailto:Support@grocere.com.my\">Support@grocere.com.my</a>&nbsp;</h2>\r\n</body>\r\n</html>', '6', '1', '2020-06-30 13:25:48', '2020-07-10 14:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL,
  `para1` varchar(255) DEFAULT NULL,
  `para2` varchar(255) DEFAULT NULL,
  `para3` varchar(255) DEFAULT NULL,
  `para4` varchar(255) DEFAULT NULL,
  `para5` varchar(255) DEFAULT NULL,
  `para6` varchar(255) DEFAULT NULL,
  `para7` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `para1`, `para2`, `para3`, `para4`, `para5`, `para6`, `para7`, `status`, `created`, `modified`) VALUES
(1, 'paypal', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-09-04 13:50:26', '2020-09-04 14:22:55'),
(2, 'eghl', 'live_server', 'ORB', 'iZQfXTE5fCOjVLtZkPu1dAPhpJr5LhI6', NULL, NULL, NULL, 1, NULL, '2020-09-04 14:26:43'),
(3, 'PayPal', 'testing_server', 'sb-zv43ii3073669@business.example.com', NULL, NULL, NULL, NULL, 1, NULL, '2020-09-07 15:02:58');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `product` int(11) DEFAULT NULL,
  `photo` longtext DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `product`, `photo`, `position`, `status`, `created`, `modified`) VALUES
(33, 66, 'photo/5efadd5ac7e9c.jpg', 0, '1', '2020-06-30 14:36:10', '2020-06-30 14:36:13'),
(47, 62, 'photo/5efafdf2b8989.jpg', 0, '1', '2020-06-30 16:55:14', '2020-06-30 16:55:17'),
(49, 102, 'photo/5efc10efb8055.jpg', 0, '1', '2020-07-01 12:28:31', '2020-07-01 12:28:32'),
(51, 0, 'photo/5efc23a0e90c0.jpg', 0, '1', '2020-07-01 13:48:16', '2020-07-01 13:48:17'),
(58, 0, NULL, 0, '1', '2020-07-01 18:09:16', '2020-07-01 18:09:16'),
(67, 42, 'photo/5efc6aa531385.jpg', 0, '1', '2020-07-01 18:51:17', '2020-07-01 18:51:17'),
(68, 44, 'photo/5efd44f4aff5a.jpg', 0, '1', '2020-07-02 10:22:44', '2020-07-02 10:22:44'),
(70, 46, 'photo/5efd51a1bbedb.jpg', 0, '1', '2020-07-02 11:16:49', '2020-07-02 11:16:49'),
(72, 36, 'photo/5f02daef84342.jpg', 0, '1', '2020-07-03 14:41:23', '2020-07-06 16:03:59'),
(76, 1, 'photo/5f02e3403728a.jpg', 0, '1', '2020-07-06 16:39:28', '2020-07-06 16:39:28'),
(78, 2, 'photo/5f02e4a0078ad.jpg', 0, '1', '2020-07-06 16:45:20', '2020-07-06 16:45:20'),
(80, 3, 'photo/5f02e964021fb.jpg', 0, '1', '2020-07-06 17:05:40', '2020-07-06 17:05:40'),
(81, 4, 'photo/5f02ec4e1182a.jpg', 0, '1', '2020-07-06 17:18:06', '2020-07-06 17:18:06'),
(82, 10, 'photo/5f02f0f94a82d.jpg', 0, '1', '2020-07-06 17:38:01', '2020-07-06 17:38:01'),
(83, 5, 'photo/5f02f1d047728.jpg', 0, '1', '2020-07-06 17:41:36', '2020-07-06 17:41:36'),
(84, 6, 'photo/5f02f27cbea9e.jpg', 0, '1', '2020-07-06 17:44:28', '2020-07-06 17:44:28'),
(85, 7, 'photo/5f02f2d4adc86.jpg', 0, '1', '2020-07-06 17:45:56', '2020-07-06 17:45:56'),
(86, 8, 'photo/5f02f3d9df909.jpg', 0, '1', '2020-07-06 17:50:17', '2020-07-06 17:50:17'),
(87, 9, 'photo/5f02f49f64a44.jpg', 0, '1', '2020-07-06 17:53:35', '2020-07-06 17:53:35'),
(88, 21, 'photo/5f02fa78bcfa9.jpg', 0, '1', '2020-07-06 18:18:32', '2020-07-06 18:18:32'),
(89, 22, 'photo/5f02fb666ff92.jpg', 0, '1', '2020-07-06 18:22:30', '2020-07-06 18:22:30'),
(90, 29, 'photo/5f02fb8489aa2.jpg', 0, '1', '2020-07-06 18:23:00', '2020-07-06 18:23:00'),
(91, 23, 'photo/5f02fb9c31d17.jpg', 0, '1', '2020-07-06 18:23:24', '2020-07-06 18:23:24'),
(92, 24, 'photo/5f02fbca43554.jpg', 0, '1', '2020-07-06 18:24:10', '2020-07-06 18:24:10'),
(93, 25, 'photo/5f02fbe15a604.jpg', 0, '1', '2020-07-06 18:24:33', '2020-07-06 18:24:33'),
(94, 26, 'photo/5f02fcc1dbb10.jpg', 0, '1', '2020-07-06 18:28:17', '2020-07-06 18:28:17'),
(95, 27, 'photo/5f02fcd90b8ea.jpg', 0, '1', '2020-07-06 18:28:41', '2020-07-06 18:28:41'),
(96, 28, 'photo/5f02fcef0dc2f.jpg', 0, '1', '2020-07-06 18:29:03', '2020-07-06 18:29:03'),
(98, 50, 'photo/5f02ffa476a2b.jpg', 0, '1', '2020-07-06 18:40:36', '2020-07-06 18:40:36'),
(99, 51, 'photo/5f02ffc89b0fa.jpg', 0, '1', '2020-07-06 18:41:12', '2020-07-06 18:41:12'),
(100, 52, 'photo/5f02ffe96dbe9.jpg', 0, '1', '2020-07-06 18:41:45', '2020-07-06 18:41:45'),
(101, 52, 'photo/5f02ffe96f09c.jpg', 0, '1', '2020-07-06 18:41:45', '2020-07-06 18:41:45'),
(102, 108, 'photo/5f044bf42e405.jpg', 0, '1', '2020-07-07 18:18:28', '2020-07-07 18:18:28'),
(103, 103, 'photo/5f044c0d2744e.jpg', 0, '1', '2020-07-07 18:18:53', '2020-07-07 18:18:53'),
(106, 49, 'photo/5f06936bdc72b.png', 0, '1', '2020-07-09 11:47:55', '2020-07-09 11:47:55'),
(107, 0, 'photo/5f074779038d5.png', 0, '1', '2020-07-10 00:36:09', '2020-07-10 00:36:09'),
(108, 0, 'photo/5f07c7d7cf7f6.jpg', 0, '1', '2020-07-10 09:43:51', '2020-07-10 09:43:51'),
(109, 0, 'photo/5f07c84b789be.jpg', 0, '1', '2020-07-10 09:45:47', '2020-07-10 09:45:47'),
(110, 0, 'photo/5f07c9216cef7.jpg', 0, '1', '2020-07-10 09:49:21', '2020-07-10 09:49:21'),
(111, 109, 'photo/5f1c0c468b8c1.jpg', 0, '1', '2020-07-25 18:41:10', '2020-07-25 18:41:10'),
(113, 110, 'photo/5f1e63bb9ec33.jpg', 0, '1', '2020-07-27 13:18:51', '2020-07-27 13:18:51'),
(114, 111, 'photo/5f1e63c256fdc.jpg', 0, '1', '2020-07-27 13:18:58', '2020-07-27 13:18:58'),
(117, 112, 'photo/5f1e8c928cda6.jpg', 0, '1', '2020-07-27 16:13:06', '2020-07-27 16:13:06'),
(118, 113, 'photo/5f1e8d434471a.jpg', 0, '1', '2020-07-27 16:16:03', '2020-07-27 16:16:03'),
(119, 114, 'photo/5f1e8ece18eb9.jpg', 0, '1', '2020-07-27 16:22:38', '2020-07-27 16:22:38'),
(120, 115, 'photo/5f1e9624086ee.jpg', 0, '1', '2020-07-27 16:53:56', '2020-07-27 16:53:56'),
(121, 116, 'photo/5f1e9665ca70f.jpg', 0, '1', '2020-07-27 16:55:01', '2020-07-27 16:55:01'),
(122, 117, 'photo/5f1e96a1729b0.jpg', 0, '1', '2020-07-27 16:56:01', '2020-07-27 16:56:01'),
(124, 118, 'photo/5f1e970fbbe6a.jpg', 0, '1', '2020-07-27 16:57:51', '2020-07-27 16:57:51'),
(125, 118, 'photo/5f1e971cf3193.jpg', 0, '1', '2020-07-27 16:58:04', '2020-07-27 16:58:04'),
(127, 119, 'photo/5f1e98a65a72c.jpg', 0, '1', '2020-07-27 17:04:38', '2020-07-27 17:04:38'),
(128, 119, 'photo/5f1e98b57a503.jpg', 0, '1', '2020-07-27 17:04:53', '2020-07-27 17:04:53'),
(130, 122, 'photo/5f1e9bdc0b562.jpg', 0, '1', '2020-07-27 17:18:20', '2020-07-27 17:18:20'),
(131, 123, 'photo/5f1e9cbb35590.jpg', 0, '1', '2020-07-27 17:22:03', '2020-07-27 17:22:03'),
(132, 124, 'photo/5f1e9d78938bd.jpg', 0, '1', '2020-07-27 17:25:12', '2020-07-27 17:25:12'),
(133, 124, 'photo/5f1e9d82670f0.jpg', 0, '1', '2020-07-27 17:25:22', '2020-07-27 17:25:22'),
(134, 125, 'photo/5f1e9ebe52652.jpg', 0, '1', '2020-07-27 17:30:38', '2020-07-27 17:30:38'),
(135, 125, 'photo/5f1e9ec2aad2d.jpg', 0, '1', '2020-07-27 17:30:42', '2020-07-27 17:30:42'),
(136, 126, 'photo/5f1e9f431e8c8.jpg', 0, '1', '2020-07-27 17:32:51', '2020-07-27 17:32:51'),
(137, 127, 'photo/5f1e9fbc3719c.jpg', 0, '1', '2020-07-27 17:34:52', '2020-07-27 17:34:52'),
(141, 128, 'photo/5f1ea0cfb6970.jpg', 0, '1', '2020-07-27 17:39:27', '2020-07-27 17:39:27'),
(142, 128, 'photo/5f1ea1171f9b7.jpg', 0, '1', '2020-07-27 17:40:39', '2020-07-27 17:40:39'),
(143, 129, 'photo/5f1ea188e9400.jpg', 0, '1', '2020-07-27 17:42:32', '2020-07-27 17:42:32'),
(144, 129, 'photo/5f1ea18da761f.jpg', 0, '1', '2020-07-27 17:42:37', '2020-07-27 17:42:37'),
(145, 130, 'photo/5f1ea2353d41d.jpg', 0, '1', '2020-07-27 17:45:25', '2020-07-27 17:45:25'),
(146, 130, 'photo/5f1ea23a046e9.jpg', 0, '1', '2020-07-27 17:45:30', '2020-07-27 17:45:30'),
(147, 131, 'photo/5f1ea2e20d9fc.jpg', 0, '1', '2020-07-27 17:48:18', '2020-07-27 17:48:18'),
(148, 131, 'photo/5f1ea2e5eb525.jpg', 0, '1', '2020-07-27 17:48:21', '2020-07-27 17:48:21'),
(151, 132, 'photo/5f1ea4b5e2506.jpg', 0, '1', '2020-07-27 17:56:05', '2020-07-27 17:56:05'),
(153, 132, 'photo/5f1ea4c48c2ad.jpg', 0, '1', '2020-07-27 17:56:20', '2020-07-27 17:56:20'),
(154, 133, 'photo/5f1eaa5a3e58f.jpg', 0, '1', '2020-07-27 18:20:10', '2020-07-27 18:20:10'),
(155, 133, 'photo/5f1eaa5e60e30.jpg', 0, '1', '2020-07-27 18:20:14', '2020-07-27 18:20:14'),
(156, 134, 'photo/5f1eab20aa1ab.jpg', 0, '1', '2020-07-27 18:23:28', '2020-07-27 18:23:28'),
(157, 134, 'photo/5f1eab262680a.jpg', 0, '1', '2020-07-27 18:23:34', '2020-07-27 18:23:34'),
(158, 135, 'photo/5f1eabadbf581.jpg', 0, '1', '2020-07-27 18:25:49', '2020-07-27 18:25:49'),
(159, 136, 'photo/5f1eac753580f.jpg', 0, '1', '2020-07-27 18:29:09', '2020-07-27 18:29:09'),
(160, 136, 'photo/5f1eac7b149df.jpg', 0, '1', '2020-07-27 18:29:15', '2020-07-27 18:29:15'),
(161, 137, 'photo/5f1eaf286fcff.jpg', 0, '1', '2020-07-27 18:40:40', '2020-07-27 18:40:40'),
(162, 137, 'photo/5f1eaf2d305b0.jpg', 0, '1', '2020-07-27 18:40:45', '2020-07-27 18:40:45'),
(163, 138, 'photo/5f1ec0e12b8c3.jpg', 0, '1', '2020-07-27 19:56:17', '2020-07-27 19:56:17'),
(164, 138, 'photo/5f1ec0e547ae9.jpg', 0, '1', '2020-07-27 19:56:21', '2020-07-27 19:56:21'),
(165, 120, 'photo/5f1ec132c1cff.jpg', 0, '1', '2020-07-27 19:57:38', '2020-07-27 19:57:38'),
(166, 139, 'photo/5f1ec1e8e2be2.jpg', 0, '1', '2020-07-27 20:00:40', '2020-07-27 20:00:41'),
(167, 139, 'photo/5f1ec1ec701d7.jpg', 0, '1', '2020-07-27 20:00:44', '2020-07-27 20:00:44'),
(168, 140, 'photo/5f1ec27ea15cb.jpg', 0, '1', '2020-07-27 20:03:10', '2020-07-27 20:03:10'),
(169, 140, 'photo/5f1ec2829e50e.jpg', 0, '1', '2020-07-27 20:03:14', '2020-07-27 20:03:14'),
(170, 141, 'photo/5f1ec3267daa7.jpg', 0, '1', '2020-07-27 20:05:58', '2020-07-27 20:05:58'),
(171, 141, 'photo/5f1ec32bc6971.jpg', 0, '1', '2020-07-27 20:06:03', '2020-07-27 20:06:03'),
(172, 148, 'photo/5f1ec59e74a0d.jpg', 0, '1', '2020-07-27 20:16:30', '2020-07-27 20:16:30'),
(175, 158, 'photo/5f1f9b6835c4e.jpg', 0, '1', '2020-07-28 11:28:40', '2020-07-28 11:28:42'),
(176, 163, 'photo/5f1f9bbb623b6.jpg', 0, '1', '2020-07-28 11:30:03', '2020-07-28 11:30:03'),
(177, 162, 'photo/5f1f9c0304d32.jpg', 0, '1', '2020-07-28 11:31:15', '2020-07-28 11:31:15'),
(178, 166, 'photo/5f1f9cea40e5e.jpg', 0, '1', '2020-07-28 11:35:06', '2020-07-28 11:35:06'),
(179, 159, 'photo/5f1f9d4fd1dea.jpg', 0, '1', '2020-07-28 11:36:47', '2020-07-28 11:36:47'),
(180, 160, 'photo/5f1f9dbaaf417.jpg', 0, '1', '2020-07-28 11:38:34', '2020-07-28 11:38:34'),
(181, 169, 'photo/5f1f9e31a6c35.jpg', 0, '1', '2020-07-28 11:40:33', '2020-07-28 11:40:33'),
(182, 170, 'photo/5f1f9ea9acfc7.jpg', 0, '1', '2020-07-28 11:42:33', '2020-07-28 11:42:33'),
(183, 170, 'photo/5f1f9ead3c985.jpg', 0, '1', '2020-07-28 11:42:37', '2020-07-28 11:42:37'),
(184, 176, 'photo/5f1fa020826bb.jpg', 0, '1', '2020-07-28 11:48:48', '2020-07-28 11:48:48'),
(185, 176, 'photo/5f1fa0239b99d.jpg', 0, '1', '2020-07-28 11:48:51', '2020-07-28 11:48:51'),
(186, 177, 'photo/5f1fa0b183f9b.jpg', 0, '1', '2020-07-28 11:51:13', '2020-07-28 11:51:13'),
(187, 177, 'photo/5f1fa0b52ab80.jpg', 0, '1', '2020-07-28 11:51:17', '2020-07-28 11:51:17'),
(188, 179, 'photo/5f1fa19a15676.jpg', 0, '1', '2020-07-28 11:55:06', '2020-07-28 11:55:06'),
(189, 179, 'photo/5f1fa19e63fbe.jpg', 0, '1', '2020-07-28 11:55:10', '2020-07-28 11:55:10'),
(190, 179, 'photo/5f1fa1a1608a4.jpg', 0, '1', '2020-07-28 11:55:13', '2020-07-28 11:55:13'),
(191, 181, 'photo/5f1fa2586ece3.jpg', 0, '1', '2020-07-28 11:58:16', '2020-07-28 11:58:16'),
(192, 181, 'photo/5f1fa25c180ae.jpg', 0, '1', '2020-07-28 11:58:20', '2020-07-28 11:58:20'),
(193, 182, 'photo/5f1fa3055dcb2.jpg', 0, '1', '2020-07-28 12:01:09', '2020-07-28 12:01:09'),
(194, 183, 'photo/5f1fa36c41141.jpg', 0, '1', '2020-07-28 12:02:52', '2020-07-28 12:02:52'),
(195, 184, 'photo/5f1fa3f2070d6.jpg', 0, '1', '2020-07-28 12:05:06', '2020-07-28 12:05:06'),
(196, 185, 'photo/5f1fa6bc5bc44.jpg', 0, '1', '2020-07-28 12:17:00', '2020-07-28 12:17:00'),
(199, 187, 'photo/5f1fab0d65f3d.jpg', 0, '1', '2020-07-28 12:35:25', '2020-07-28 12:35:25'),
(200, 187, 'photo/5f1fab10cc6c0.jpg', 0, '1', '2020-07-28 12:35:28', '2020-07-28 12:35:28'),
(203, 190, 'photo/5f1fac34ad86e.jpg', 0, '1', '2020-07-28 12:40:20', '2020-07-28 12:40:20'),
(204, 190, 'photo/5f1fac3761ebd.jpg', 0, '1', '2020-07-28 12:40:23', '2020-07-28 12:40:23'),
(205, 192, 'photo/5f1fad0142c9c.jpg', 0, '1', '2020-07-28 12:43:45', '2020-07-28 12:43:45'),
(206, 193, 'photo/5f1fad441f91f.jpg', 0, '1', '2020-07-28 12:44:52', '2020-07-28 12:44:52'),
(207, 164, 'photo/5f1fad5f2c2a9.jpg', 0, '1', '2020-07-28 12:45:19', '2020-07-28 12:45:19'),
(209, 191, 'photo/5f1fecbbd8b6f.jpg', 0, '1', '2020-07-28 17:15:39', '2020-07-28 17:15:39'),
(210, 191, 'photo/5f1fecbf70082.jpg', 0, '1', '2020-07-28 17:15:43', '2020-07-28 17:15:43'),
(211, 144, 'photo/5f1fef941973c.jpg', 0, '1', '2020-07-28 17:27:48', '2020-07-28 17:27:48'),
(212, 144, 'photo/5f1fef9982b16.jpg', 0, '1', '2020-07-28 17:27:53', '2020-07-28 17:27:53'),
(213, 143, 'photo/5f1ff1f43bdae.jpg', 0, '1', '2020-07-28 17:37:56', '2020-07-28 17:37:56'),
(214, 142, 'photo/5f1ff44a1af39.jpg', 0, '1', '2020-07-28 17:47:54', '2020-07-28 17:47:54'),
(215, 142, 'photo/5f1ff44e16acf.jpg', 0, '1', '2020-07-28 17:47:58', '2020-07-28 17:47:58'),
(216, 165, 'photo/5f1ff4aec43fe.jpg', 0, '1', '2020-07-28 17:49:34', '2020-07-28 17:49:34'),
(217, 165, 'photo/5f1ff4b21b188.jpg', 0, '1', '2020-07-28 17:49:38', '2020-07-28 17:49:38'),
(218, 121, 'photo/5f1ff7c9abb55.jpg', 0, '1', '2020-07-28 18:02:49', '2020-07-28 18:02:49'),
(219, 121, 'photo/5f1ff7cde89e9.jpg', 0, '1', '2020-07-28 18:02:53', '2020-07-28 18:02:53'),
(220, 197, 'photo/5f1ff88f38fbc.jpg', 0, '1', '2020-07-28 18:06:07', '2020-07-28 18:06:07'),
(221, 198, 'photo/5f1ff8e979213.jpg', 0, '1', '2020-07-28 18:07:37', '2020-07-28 18:07:37'),
(222, 168, 'photo/5f1ffa8b4e291.jpg', 0, '1', '2020-07-28 18:14:35', '2020-07-28 18:14:35'),
(223, 172, 'photo/5f1ffb5882f12.jpg', 0, '1', '2020-07-28 18:18:00', '2020-07-28 18:18:00'),
(224, 153, 'photo/5f1ffd23cbd05.jpg', 0, '1', '2020-07-28 18:25:39', '2020-07-28 18:25:39'),
(225, 154, 'photo/5f1ffee5acdb7.jpg', 0, '1', '2020-07-28 18:33:09', '2020-07-28 18:33:09'),
(226, 145, 'photo/5f214d9ce8bcc.jpg', 0, '1', '2020-07-29 18:21:16', '2020-07-29 18:21:16'),
(227, 145, 'photo/5f214da0b11b5.jpg', 0, '1', '2020-07-29 18:21:20', '2020-07-29 18:21:20'),
(228, 146, 'photo/5f2151ed02ac4.jpg', 0, '1', '2020-07-29 18:39:41', '2020-07-29 18:39:41'),
(229, 146, 'photo/5f2151f0c4633.jpg', 0, '1', '2020-07-29 18:39:44', '2020-07-29 18:39:44'),
(230, 155, 'photo/5f215cbf16503.jpg', 0, '1', '2020-07-29 19:25:51', '2020-07-29 19:25:51'),
(231, 156, 'photo/5f215f821266d.jpg', 0, '1', '2020-07-29 19:37:38', '2020-07-29 19:37:38'),
(232, 157, 'photo/5f216284bb02b.jpg', 0, '1', '2020-07-29 19:50:28', '2020-07-29 19:50:28'),
(233, 199, 'photo/5f21a15d55bbe.jpg', 0, '1', '2020-07-30 00:18:37', '2020-07-30 00:18:37'),
(234, 199, 'photo/5f21a160c3dec.jpg', 0, '1', '2020-07-30 00:18:40', '2020-07-30 00:18:40'),
(235, 186, 'photo/5f21a17da0867.jpg', 0, '1', '2020-07-30 00:19:09', '2020-07-30 00:19:09'),
(236, 173, 'photo/5f21a2b682d89.jpg', 0, '1', '2020-07-30 00:24:22', '2020-07-30 00:24:22'),
(237, 173, 'photo/5f21a2ba4e98d.jpg', 0, '1', '2020-07-30 00:24:26', '2020-07-30 00:24:26'),
(238, 174, 'photo/5f21a31e4929f.jpg', 0, '1', '2020-07-30 00:26:06', '2020-07-30 00:26:06'),
(239, 188, 'photo/5f21a5b6c76dd.jpg', 0, '1', '2020-07-30 00:37:10', '2020-07-30 00:37:10'),
(240, 194, 'photo/5f21a90c15cfd.jpg', 0, '1', '2020-07-30 00:51:24', '2020-07-30 00:51:24'),
(241, 195, 'photo/5f21aaf397783.jpg', 0, '1', '2020-07-30 00:59:31', '2020-07-30 00:59:31'),
(242, 161, 'photo/5f21ad9bcb32f.jpg', 0, '1', '2020-07-30 01:10:51', '2020-07-30 01:10:51'),
(243, 147, 'photo/5f21b14ebae03.jpg', 0, '1', '2020-07-30 01:26:38', '2020-07-30 01:26:38'),
(244, 149, 'photo/5f21b463e3c8f.jpg', 0, '1', '2020-07-30 01:39:47', '2020-07-30 01:39:47'),
(245, 149, 'photo/5f21b46861a73.jpg', 0, '1', '2020-07-30 01:39:52', '2020-07-30 01:39:52'),
(246, 150, 'photo/5f21b6a6ddba4.jpg', 0, '1', '2020-07-30 01:49:26', '2020-07-30 01:49:26'),
(247, 150, 'photo/5f21b6ab02038.jpg', 0, '1', '2020-07-30 01:49:30', '2020-07-30 01:49:31'),
(248, 151, 'photo/5f21b8c99ccb0.jpg', 0, '1', '2020-07-30 01:58:33', '2020-07-30 01:58:33'),
(249, 151, 'photo/5f21b8ce9fc25.jpg', 0, '1', '2020-07-30 01:58:38', '2020-07-30 01:58:40'),
(250, 152, 'photo/5f21bb0fa2d9d.jpg', 0, '1', '2020-07-30 02:08:15', '2020-07-30 02:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `prepare`
--

CREATE TABLE `prepare` (
  `id` int(11) NOT NULL,
  `ori` varchar(222) NOT NULL,
  `escape` varchar(222) DEFAULT NULL,
  `tag` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prepare`
--

INSERT INTO `prepare` (`id`, `ori`, `escape`, `tag`) VALUES
(1, '1', NULL, NULL),
(2, 'b', NULL, NULL),
(3, 'c', NULL, NULL),
(4, 'asddsa', '', ''),
(5, 'kkk', '', ''),
(6, 'd', NULL, NULL),
(7, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `region` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `sku` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `product_name` varchar(55) COLLATE latin1_general_ci DEFAULT NULL,
  `description` longtext COLLATE latin1_general_ci DEFAULT NULL,
  `price` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `seo_title` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `seo_keyword` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `seo_description` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `best_deals` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `best_sellers` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `recommended` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `position` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `region`, `brand`, `category`, `sub_category`, `sku`, `product_name`, `description`, `price`, `seo_title`, `seo_keyword`, `seo_description`, `viewed`, `best_deals`, `best_sellers`, `recommended`, `position`, `status`, `created`, `modified`) VALUES
(109, 3, 5, 4, 21, '2', 'Egg Grade A', 'Grade A eggs are still very fresh and have shells that closely resemble Grade AA eggs. They are clean, crack-free and traditionally shaped. The egg whites will still be clear and relatively firm. The egg yolk will be pretty much centered, defect-free and still show a somewhat defined outline.', NULL, 'Shop | EGG GRADE A | Grocere.com.my', 'Egg grade a, Grocere.com.my, Telur grade a,', 'Shop Eggs at Grocere.com.my . Same-Day Delivery available.', 13, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(110, 3, 5, 4, 21, '3', 'Egg Grade B', 'Grade B eggs don’t meet the same exterior or interior quality of Grade AA and Grade A eggs, but they’re still safe to eat. Their whites are thinner and their yolks wider and flatter than the whites and yolks of higher-grade eggs.', NULL, 'Shop | EGG GRADE B | Grocere.com.my', 'Egg grade a, Grocere.com.my, Telur grade b,', 'Shop Eggs at Grocere.com.my . Same-Day Delivery available.', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(111, 3, 5, 4, 21, '4', 'Egg Grade C', 'Grade C eggs are generally the most commonly used eggs at local eateries and restaurants due their economic value. Appearance wise, Grade C eggs pale in comparison to both Grade A and B eggs. Shells are usually crack free but appear slightly strained with a rough or sandy texture.', NULL, 'Shop | EGG GRADE C | Grocere.com.my', 'Egg grade a, Grocere.com.my, Telur grade c,', 'Shop Eggs at Grocere.com.my . Same-Day Delivery available.', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(112, 3, 5, 5, 13, '212', 'Rosie Chicken Frankfurter 270g ', '', NULL, 'Shop now | Halal Chicken Frankfurter Malaysia | Grocere.com.my', 'Rosie chicken frankfurter, sausage, nutribest, boh ming, grocere', 'Explore halal grocery products at Grocere.com.my', 6, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(113, 3, 5, 5, 13, '204', 'Nutribest Chicken Frankfurter 300g', 'Halal chicken frankfurter product by Nutribest', NULL, 'Shop | Nutribest Chicken Frankfurter | Grocere.com.my', 'Nutribest, Nutribest chicken frankfurter, sausage, Halal, Grocere', 'Explore all Nutribest product at Grocere.com.my. Same-Day Delivery available!', 2, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(114, 3, 5, 5, 13, '211', 'Nutribest Honey Chicken Frankfurter 300g', '', NULL, 'Shop | Nutribest Honey Chicken Frankfurter | Grocere.com.my', 'Halal, Nutribest, Boh ming, Nutribest honey chicken frankfurter, sausage madu, Grocere', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery Available!', 4, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(115, 3, 5, 5, 13, '206', 'Nutribest Chicken Burger 900g', '', NULL, 'Shop Halal | Nutribest Chicken Burger | Grocere.com.my', 'Nutribest, Boh ming, Nutribest chicken burger, chicken burger, grocere, halal', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(116, 3, 5, 5, 14, '207', 'Nutribest Beef Burger 900g', '', NULL, 'Shop | Nutribest Beef Burger | Grocere.com.my', 'Nutribest, boh minh, Nutribest beef burger, beef burger, halal, grocere, miri, sarawak,', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', 1, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(117, 3, 5, 5, 17, '216', 'Nutribest Lamb Burger 900g', '', NULL, 'Shop | Nutribest Lamb Burger | Grocere.com.my', 'Nutribest, Boh ming, Nutribest lamb burger, lamb burger, miri, sarawak, halal, grocere', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', 1, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(118, 3, 5, 5, 13, '205', 'Nutribest Chicken Meatball  400g', '', NULL, 'Shop | Nutribest Chicken Meatball | Grocere.com.my', 'Nutribest, boh ming, halal, chicken meatball, grocere', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', 4, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-08-10 14:30:13'),
(119, 3, 5, 5, 14, '208', 'Nutribest Beef Meatball 400g ', '', NULL, 'Shop | Nutribest Beef Meatball | Grocere.com.my', 'nutribest, boh ming, halal, nutribest beef meatball, grocere', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', 8, 'Yes', NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(120, 3, 5, 5, 13, '210', 'Nutribest Minced Chicken 400g ', '', NULL, 'Shop | Nutribest Minced Chicken | Grocere.com.my', 'nutribest, boh ming, nutribest minced chicken, ayam cincang, halal, miri, sarawak', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', 4, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(121, 3, 5, 5, 14, '209', 'Nutribest Minced Beef 400g', '', NULL, 'Shop | Nutribest Minced Beef | Grocere.com.my', 'Nutribest, boh ming, halal, Nutribest minced beef, daging cincang, grocere', 'Explore Nutribest product at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(122, 3, 5, 5, 19, '2543', 'Nutribest/Prisma Mix Vege 400g', '', NULL, 'Shop | Nutribest Mix Vegetable | Grocere.com.my', 'Nutribest, boh ming, halal, mix vege, mix vegetables, sayur campur, grocere, miri, sarawak', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-08-06 15:06:41'),
(123, 3, 13, 5, 19, '248', 'Mix Vegetable 1kg', '', NULL, 'Shop | Mix Vegetable 1kg | Grocere.com.my', 'Nutribest, Mix vege, mix vegetable, miri, sarawak, grocere, halal, sayur campur', 'Explore halal grocery products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, 'No', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(124, 3, 14, 5, 18, '2497', 'Coldstar French Fries Crinkle Cut 1kg', '', NULL, 'Shop | Coldstar French Fries | Grocere.com.my', 'Nutribest, coldstar, fries, french fries, coldstar french fries, halal, miri, sarawak, grocere', 'Explore Coldstar products at Grocere.com.my . Shop now at lowest price!', 2, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(125, 3, 14, 5, 18, '2498', 'Coldstar French Fries Shoestring 1kg', '', NULL, 'Shop | French Fries | Grocere.com.my', 'French fries. coldstar, coldstar fries, coldstar french fries, grocere.com.my', 'Explore Coldstar products at Grocere.com.my . Shop now at lowest price!', 11, NULL, 'Yes', NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(126, 3, 13, 5, 16, '1224', 'Squid Tube Peeled 1kg', '', NULL, 'Shop | Squid Tube Peeled | Grocere Online', 'Nutribest, grocere, boh ming, halal, squid, sotong, miri, sarawak', 'Explore halal daily grocery product at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(127, 3, 13, 5, 16, '858', 'Squid Ring Peeled 1kg', '', NULL, 'Shop | Squid Ring Peeled | Grocere Online', 'Grocere.com.my, Grocere, halal, squid, squid ring, sotong, miri, sarawak', 'Explore halal daily grocery product at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(128, 3, 15, 5, 16, '259', 'Mushroom White Fish Ball (SMALL) 500g', '', NULL, 'Shop Online | Mushroom White Fish Ball | Grocere.com.my', 'Grocere.com.my, Grocere, halal, nutribestm, ql foods, mushroom, ql mushroom, white fish ball, fish ball, miri, sarawak', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 4, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(129, 3, 15, 5, 16, '532', 'Mushroom White Fish Ball (MEDIUM) 500g', '', NULL, 'Shop Online | White Fish Ball | Grocere.com.my', 'Grocere.com.my, Grocere, halal, nutribestm, ql foods, mushroom, ql mushroom, white fish ball, fish ball, miri, sarawak', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 3, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(130, 3, 15, 5, 16, '538', 'Mushroom Imitation Crabstick 250g', '', NULL, 'Shop | Mushroom Imitation Crabstick | Grocere.com.my', 'ql foods, mushroom, ql mushroom, nutribest, boh ming, crab stick, imitation crabstick, crabstick, halal, miri, sarawak, grocere', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 3, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(131, 3, 15, 5, 16, '163', 'Mushroom Fried Crabstick Full Cut Red 1kg', '', NULL, 'Shop Online | Mushroom Fried Crabstick Full Cut | Grocere.com.my', 'ql foods, ql mushroom, mushroom, fried crabstick full cut, fried crabstick, crab stick, halal, miri, sarawak, grocere, crab filament, filamen ketam, ketam', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(132, 3, 15, 5, 16, '586', 'Mushroom Oborotsuki 500g', 'Fish roll.', NULL, 'Shop | Mushroom Oborotsuki | Grocere Online', 'ql foods, ql mushroom, mushroom, halal, oborotsuki, mushroom oborotsuki, grocere, nutribest, miri, sarawak', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 4, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-08-03 15:00:13'),
(133, 3, 15, 5, 16, '158', 'Mushroom Seafood Tofu 500g ', '', NULL, 'Shop Online | Mushroom Seafood Tofu | Grocere.com.my', 'ql foods, ql mushroom, mushroom, seafood tofu malaysia, halal, grocere, nutribest, boh ming', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(134, 3, 15, 5, 16, '2530', 'Mushroom Cheese Fish Tofu 500g ', '', NULL, 'Shop Online | Mushroom Cheese Fish Tofu | Grocere.com.my', 'ql foods, ql foods sdn bhd, mushroom, mushroom cheese fish tofu, seafood tofu, fish tofu, halal, miri, sarawak, grocere, nutribest', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 3, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(135, 3, 15, 5, 16, '160', 'Mushroom Fish Bar 480g', '', NULL, 'Shop Online | QL Foods Mushroom Fish Bar | Grocere.com.my', 'ql foods, ql mushroom, mushroom, fish bar, halal, nutribest, boh ming, miri, sarawak', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(136, 3, 16, 5, 16, '2547', 'Suria Bebola Ikan Goreng 1kg', '', NULL, 'Shop Online | Suria Bebola Ikan Goreng | Grocere.com.my', 'Suria, ql foods, nutribest, boh ming, suria bebola ikan goreng, suria fried fish ball, bebola ikan, fish ball, miri, sarawak, halal,', 'Explore Suria products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(137, 3, 17, 5, 13, '195', 'Ayam Likes Honey Chicken Frankfurter 300g ', '', NULL, 'Shop Online | Ayam Likes Honey Chicken Frankfurter | Grocere.com.my', 'cab, likes marketing, ayam likes, ayam likes honey chicken frankfurter, grocere, halal, miri, sarawak', 'Explore Ayam Likes products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(138, 3, 17, 5, 13, '196', 'Ayam Likes Chicken Nuggets 800g ', '', NULL, 'Shop Online | Ayam Likes Chicken Nugget | Grocere.com.my', 'Ayam Likes, ayam likes chicken nugget, nutribest, boh ming, miri, sarawak, halal', 'Explore Ayam Likes products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(139, 3, 17, 5, 13, '162', 'Likes Chicken Nuggets Tempura 800g ', '', NULL, 'Shop Online | Likes Chicken Nugget Tempura | Grocere.com.my', 'Likes, cab, nutribest, boh ming, halal, nugget ayam, chicken nugget, tempura chicken nugget, miri, sarawak, grocere', 'Explore Likes products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(140, 3, 17, 5, 13, '2528', 'Ayam Wira Chicken Cocktail 500g', '', NULL, 'Shop Online | Ayam Wira Chicken Cocktail | Grocere.com.my', 'Ayam wira, ayam wira chicken cocktail, nutribest, orient biogreen, boh ming, koktel ayam, halal, miri, sarawak, grocere', 'Explore Ayam Wira products at Grocere.com.my . Same-Day Delivery available!', 7, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(141, 3, 17, 5, 13, '2527', 'Ayam Wira Cheese Chix Cocktail 500g ', '', NULL, 'Shop Online | Ayam Wira Cheese Chicken Cocktail | Grocere.com.my', 'Ayam wira, nutribest, orient biogreen, boh ming, koktel ayam, cheese chicken cocktail, halal, miri, sarawak, grocere,', 'Explore Ayam Wira products at Grocere.com.my . Same-Day Delivery available!', 5, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(142, 3, 17, 5, 13, '2529', 'Ayam Wira Crispy Honey Chicken Fingers 800g ', '', NULL, 'Shop Online | Ayam Wira Crispy Honey Chicken Fingers | Grocere.com.my', 'ayam wira, nutribest, boh ming, orient biogreen, cab, crispy honey chicken finger, chicken finger, grocere,', 'Explore Ayam Wira products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(143, 3, 13, 5, 22, '66', 'Frozen Duck - 2.4kg Per Nos', '', NULL, 'Shop Online | Frozen Duck | Grocere.com.my', 'nutribest, boh ming, frozen duck, duck, halal, miri, sarawak, malaysia', 'Explore halal grocery products at Grocere.com.my . Same-Day Delivery available!', 5, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(144, 3, 13, 5, 16, '2473', 'Sejuta Crab Stick 200g', '', NULL, 'Shop | Seljuta Crab Stick 200g | Grocere.com.my', 'Nutribest, boh ming, seljuta, seljuta crab stick, crab stick, ketam, Crab filament, filamen ketam, halal, seafood, miri, sarawak, grocere,', 'Explore Seljuta products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(145, 3, 13, 5, 16, '2668', 'Fusipim Fried Fish Cake 400g', '', NULL, 'Shop | Fusipim Fried Fish Cake | Grocere.com.my', 'Nutribest, boh ming, fusipim, fish, fish cake, fried fish cake, seafood, halal, miri, sarawak, grocere,', 'Explore Fusipim product at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(146, 3, 19, 5, 13, '1074', 'Valley Fresh Chicken Tempura 900g ', '', NULL, 'Shop | Valley Fresh Chicken Tempura | Grocere.com.my', 'Nutribest, boh ming, halal, ayam tempura, ayam, chicken, chicken tempura, fresh, miri, sarawak, grocere,', 'Explore Valley Fresh products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(147, 3, 19, 5, 13, '1028', 'Valley Fresh Chicken Nugget 900g', '', NULL, 'Shop | Valley Fresh Chicken Nugget | Grocere.com.my', 'Nutribest, nutribest fresh mart, boh ming, valley fresh, chicken, ayam, chicken nugget, nuget ayam, halal, poultry, miri, sarawak, grocere,', 'Explore Valley Fresh products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(148, 3, 18, 5, 20, '2675', 'Uc Spring Roll Pastry 7.5\" 550g', '', NULL, 'Shop Online | uPastry Spring Roll Pastry 7.5\" | Grocere.com.my', 'upastry, upastry chef, pa food, upastry spring roll pastry, spring roll 7.5\", nutribest, boh ming, orient biogreen, halal, kulit popia, miri, sarawak, grocere,', 'Explore uPastry products at Grocere.com.my . Same-Day Delivery available!', 2, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(149, 3, 19, 5, 16, '2495', 'Mushroom Fried Fish Ball (S)', '', NULL, 'Shop | Mushroom Fried Fish Ball | Grocere.com.my', 'Nutribest, ql foods, mushroom, fried fish ball, halal, miri, sarawak, grocere,', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(150, 3, 15, 5, 16, '260', 'Mushroom Fried Fish Ball (M)', '', NULL, 'Shop | Mushroom Fried Fish Ball | Grocere.com.my', 'Nutribest, boh ming, ql foods, mushroom, fried fish ball, fish ball, bebola ikan goreng, bebola ikan, ikan, fish, fresh, halal, miri, sarawak, grocere,', 'Explore Mushroom products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(151, 3, 16, 5, 16, '2541', 'Suria Kek Ikan 180g', '', NULL, 'Shop | Suria Kek Ikan | Grocere.com.my', 'Nutribest, boh ming, suria, suria kek ikan, fish cake, fish, ikan, halal, miri, sarawak, grocere,', 'Explore Suria products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(152, 3, 16, 5, 16, '2542', 'Suria Bebola Ikan Goreng 150g', '', NULL, 'Shop | Suria Bebola Ikan Goreng | Grocere.com.my', 'Nutribest, boh ming, suria, bebola ikan goreng, bebola ikan, fried fish ball, fish, fish ball, suria bebola ikan goreng, halal, miri, sarawak, grocere,', 'Explore Suria products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(153, 3, 5, 5, 13, '20020', 'Nutribest Chicken Thigh Fillet', '', NULL, 'Shop | Nutribest Chicken Thigh Fillet | Grocere Online', 'Nutribest, boh ming, halal, chicken, chicken thigh fillet, paha ayam, ayam, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 3, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(154, 3, 5, 5, 13, '54', 'Nutribest Chicken Breast Fillet', '', NULL, 'Shop Online | Nutribest Chicken Breast Fillet | Grocere.com.my', 'Nutribest, boh ming, chicken, ayam, halal, Nutribest chicken, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(155, 3, 5, 5, 13, '30003', 'Nutribest Chicken Wing', '', NULL, 'Shop Online | Nutribest Chicken Wing | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, prisma fresh farm, halal, ayam, sayap ayam, chicken wing, miri, sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(156, 3, 5, 5, 13, '30033', 'Nutribest Chicken Gizzard', '', NULL, 'Shop | Nutribest Chicken Gizzard | Grocere.com.my', 'Nutribest fresh mart, prisma fresh farm, boh ming, nutribest, halal, chicken, chicken gizzard, badal ayam, ayam, miri ,sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(157, 3, 5, 5, 13, '30035', 'Nutribest Chicken Liver', '', NULL, 'Shop Online | Nutribest Chicken Liver | Grocere.com.my', 'Nutribest, nutribest fresh mart, prisma fresh farm, orient biogreen, boh ming, halal, ayam, chicken, chicken liver, hati ayam, poultry, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(158, 3, 5, 5, 13, '30046', 'Nutribest Bishop Nose / Buntut', '', NULL, 'Shop Online | Bishop Nose / Buntut Ayam | Grocere.com.my', 'Nuitribest, boh ming, buntut ayam, bishop nose, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(159, 3, 5, 5, 13, '30020', 'Nutribest Chicken Wing Local', '', NULL, 'Shop Online | Nutribest Chicken Wing | Grocere.com.my', 'Nutribest, boh ming, halal, ayam, chicken, sayap ayam, chicken wing, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(160, 3, 5, 5, 13, '30019', 'Nutribest Chicken Quarter Leg', '', NULL, 'Shop Now | Nutribest Chicken Quarter Leg | Grocere.com.my', 'Nutribest, boh ming, halal, ayam, fresh, chicken, chicken quarter leg, Suku kaki ayam, miri, sarawak, grocery, ayam halal malaysia, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(161, 3, 5, 5, 13, '20021', 'Nutribest Chicken Drummet', '', NULL, 'Shop | Nutribest Chicken Drummet | Grocere.com.my', 'Nutribest, nutribest fresh mart, prisma fresh farm, orient biogreen, boh ming, halal, fresh chicken, chicken, ayam, chicken drummet, poultry, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(162, 3, 5, 5, 13, '2531', 'Nutribest Chicken Head', '', NULL, 'Shop Online | Nutribest Chicken Head | Grocere.com.my', 'Nutribest, boh ming, halal, chicken, chicken head, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(163, 3, 5, 5, 13, '20010', 'Nutribest Chicken Breast Bone', '', NULL, 'Shop | Nutribest Chicken Breast Bone | Grocere.com.my', 'Nutribest, boh ming, chicken, breast bone, halal, miri, sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(164, 3, 5, 5, 13, '20012', 'Nutribest Chicken Feet', '', NULL, 'Shop Online | Nutribest Chicken Feet | Grocere.com.my', 'Nutribest, boh ming, chicken, chicken feet, kaki ayam, ayam, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 3, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(165, 3, 5, 5, 13, '20013', 'Nutribest Fat & Skin', '', NULL, 'Shop | Nutribest Fat & Skin | Grocere.com.my', 'Nutribest, boh ming, halal, chicken, chicken fat and skin, kulit ayam, ayam, lemak ayam, kulit dan lemak ayam, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(166, 3, 5, 4, 12, '20005', 'Chicken Breast Round (Fresh)', '', NULL, 'Shop Online | Fresh Chicken Breast | Grocere.com.my', 'Nutribest, boh ming, ayam, chicken, halal, fresh produce, chicken breast, chicken breast round, dada ayam, grocere.com.my, grocere, miri, sarawak', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(167, 3, NULL, NULL, NULL, '31001', 'Beef Knuckle', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(168, 3, 13, 5, 14, '2698', 'Forequarter Slice', '', NULL, 'Shop Online | Beef Forequarter Slice | Grocere.com.my', 'Nutribest, boh ming, orient biogreen, prisma miri, fq slice, forequarter slice, beef forequarter slice, halal, daging lembu, daging kerbau, fresh, miri, sarawak, grocere,', 'Explore halal beef products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(169, 3, 5, 5, 14, '31007', 'Beef Neck Bone (AUS)', 'Halal beef neck bone import from Australia.', NULL, 'Shop Online | Beef Neck Bone from Australia | Grocere.com.my ', 'Nutribest, boh ming, halal, beef, daging, tulang leher kerbau, lembu, beef neck bone, beef knuckle, miri, sarawak, grocere, grocery,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(170, 3, 5, 5, 14, '31031', 'Beef Silverside', '', NULL, 'Shop Online | Beef Silverside | Grocere.com.my', 'Nutribest, boh ming, orient biogreen, prisma fresh farm, nutribest fresh mart, beef, beef silverside, halal, miri, sarawak, grocery, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, 'Yes', '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(171, 3, NULL, NULL, NULL, '31014', 'Beef Rump Steak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(172, 3, 5, 5, 14, '105', 'Beef Tenderloin', '', NULL, 'Shop Online | Beef Topside | Grocere.com.my', 'Nutribest fresh mart, prisma fresh farm, boh ming, halal meat, halal, daging, beef, tenderloin, topside, beef tenderloin, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(173, 3, 13, 5, 14, '101', 'Beef Forequarter Roll', '', NULL, 'Shop | Beef Forequarter Roll | Grocere.com.my', 'Nutribest, boh ming, orient biogreen, prisma fresh farm, nutribest fresh mart, halal, fresh market, beef, daging, beef forequarter, miri, sarawak, grocere,', 'Explore fresh beef at Grocere.com.my . Same-Day Delivery available!', 4, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(174, 3, 13, 5, 14, '99', 'Beef Chuck Tender', '', NULL, 'Shop Online | Beef Chuck Tender | Grocere.com.my', 'Nutribest, nutribest fresh mart, prisma fresh farm, boh ming, halal, daging, beef, beef chuck tender, fresh, miri, sarawak, grocere,', 'Explore fresh beef at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(175, 3, NULL, NULL, NULL, '100', 'Beef Blade', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(176, 3, 5, 5, 14, '47348', 'Beef Lung', '', NULL, 'Shop Online | Beef Lung | Grocere.com.my', 'Nutribest fresh mart, Prisma fresh mart, boh ming, nutribest, grocery, meat, beef, beef lung, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(177, 3, 5, 5, 14, '31009', 'Beef Liver (NZ)', 'Halal beef liver import from New Zealand.', NULL, 'Shop Online | Beef Liver from New Zealand | Grocere.com.my', 'Nutribest fresh mart, nutribest, prisma miri, prisma fresh farm, prisma fresh mart, boh ming, orient biogreen, halal, beef liver, daging, lembu, kambing, hati daging lembu, hati lembu, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(178, 3, 5, 5, 14, '2710', 'Beef Ribs', '', NULL, 'Shop | Beef Wagyu Tenderloin Marbling 8-9 | Grocere.com.my', 'Nutribest, nutribest fresh mart, orient biogreen, boh ming, fresh beef, fresh, daging, wagyu, wagyu beef, daging wagyu, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(179, 3, 5, 5, 17, '31005', 'Lamb Shoulder (AUS)', 'Halal lamb shoulder import from Australia.', NULL, 'Shop Now | Lamb Shoulder from Australia | Grocere.com.my', 'Nutribest fresh mart, Prisma fresh farm, nutribest, prisma, orient biogreen, boh ming, halal, lamb, lamb shoulder aus, lamb shoulder australia, bahu kambing, kambing halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(180, 3, NULL, NULL, NULL, '31006', 'Lamb Frenched Rack', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(181, 3, 5, 5, 16, '32026', 'Fish Fillet', '', NULL, 'Shop Online | Fish Fillet | Grocere.com.my', 'Nutribest, prisma, boh ming, orient biogreen, halal, ikan, filet ikan, ikan, fish fillet, grocery, seafood, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(182, 3, 5, 5, 16, '32002', 'Fish Sardine', '', NULL, 'Grocery Online Sarawak| Fish Sardine | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, orient biogreen, halal, ikan, ikan sardin, sardine, fish, grocery, seafood, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(183, 3, 5, 5, 16, '32044', 'Fish Pomfret / Ikan Bawal', '', NULL, 'Shop | Fish Pomfret / Ikan Bawal | Grocere.com.my', 'Nutribest, Boh ming, orient biogreen, prisma fresh farm, pomfret, ikan duai, duai, bawal, ikan bawal, fish pomfret, grocery, seafood, local seafood, fresh market, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(184, 3, 5, 5, 16, '32028', 'Indian Mackerel / Ikan Kembung', '', NULL, 'Shop | Indian Mackerel / Ikan Kembung | Grocere.com.my', 'Nutribest, Prisma fresh farm, boh ming, orient biogreen, fresh market, ikan fresh, ikan kembung, indian mackerel, fish, seafood, ikan, fresh fish miri, online grocery, miri, sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(185, 3, 5, 5, 16, '32037', 'Red Tilapia (500-700g)', '', NULL, 'Shop Online | Red Tilapia | Grocere.com.my', 'Nutribest, boh ming, orient biogreem prisma fresh farm, halal, fish, ikan, red tilapia, ikan tilapia, grocery, seafood, fresh market, miri ,sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(186, 3, 5, 5, 16, '32018', 'Spanish Mackerel / Ikan Tenggiri 1/2 (KG)', '', NULL, 'Shop | Spanish Mackerel / Ikan Tenggiri | Grocere.com.my', 'Nutribest fresh mart, nutribest, bohming, boh ming, prisma fresh farm, orient biogreen, halal, ikan, fresh fish, spanish mackerel, ikan tenggiri, grocery, fresh market, miri ,sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 7, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(187, 3, 5, 5, 16, '36031', 'Fish Albacore / Ikan Tongkol Putih', '', NULL, 'Shop | Fish Albacore / Ikan Tongkol Putih | Grocere.com.my', 'Nutribest, seafood, boh ming, prisma fresh farm, orient biogreen, fish, ikan, fresh, fresh market, albacore, ikan tongkol, tongkol putih, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 1, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(188, 3, 13, 5, 16, '32003', 'Frozen Fish Albacore / Ikan Tongkol', '', NULL, 'Shop | Fish Red Albacore / Ikan Tongkol Merah | Grocere.com.my', 'Nutribest, nutribest fresh mart, prisma fresh farm, boh ming, halal, seafood, fish, ikan, albacore, tongkol, ikan tongkol merah, ikan tongkol, fish albacore, fresh market, fresh fish, miri, sarawak, grocere,', 'Explore fresh fish at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(189, 3, NULL, NULL, NULL, '44557', 'Catfish / Ikan Keli', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(190, 3, 5, 4, 12, '20001', 'Chicken (Fresh)', '', NULL, 'Online Grocery | Fresh Chicken Halal | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, orient biogreen, prisma fresh farm, halal, chicken, fresh, ayam segar, ayam, fresh chicken, grocery, poultry, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 3, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(191, 3, 5, 4, 12, '20002', 'Dressed Chicken (Fresh)', '', NULL, 'Shop | Fresh Dressed Chicken | Grocere.com.my', 'Nutribest, boh ming, prisma fresh farm, orient biogreen, halal, ayam, chicken, full chicken, grocery, badan ayam, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', 2, 'Yes', NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(192, 3, 5, 4, 12, '20004', 'Chicken Quarter Leg (Fresh)', '', NULL, 'Shop | Chicken Quarter Leg Fresh | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, prisma fresh farm, halal, ayam, chicken, paha ayam, chicken leg, grocery, poultry, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(193, 3, 5, 4, 12, '20006', 'Chicken Wing (Fresh)', '', NULL, 'Shop | Fresh Chicken Wing | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, orient biogreen, prisma fresh farm, halal, ayam, sayap ayam, chicken wing, grocery, poultry, miri, sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(194, 3, 5, 4, 12, '20008', 'Chicken Gizzard (Fresh)', '', NULL, 'Shop Online | Fresh Chicken Gizzard | Grocere.com.my', 'Nutribest, nutribest fresh mart, prisma fresh farm, orient biogreen, boh ming, halal, ayam, chicken, chicken gizzard, fresh, miri, sarawak, grocere', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(195, 3, 5, 4, 12, '20009', 'Chicken Liver (Fresh)', '', NULL, 'Shop Online | Fresh Chicken Liver | Grocere.com.my', 'Nutribest, nutribest fresh mart, boh ming, fresh chicken, chicken, chicken liver, hati ayam, ayam, halal, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(196, 3, NULL, NULL, NULL, '37', 'Chilled Beef Taylor Preston Natural Farm Angus Beef Rib', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(198, 3, 5, 4, 12, '31', 'Chicken Feet (Fresh)', '', NULL, 'Shop | Fresh Chicken Feet | Grocere.com.my', 'Nutribest fresh mart, nutribest, boh ming, orient biogreen, prisma fresh farm, halal, kaki ayam, ayam segar, ayam, segar, fresh, fresh poultry, miri, sarawak, grocere,', 'Explore Nutribest products at Grocere.com.my . Same-Day Delivery available!', NULL, NULL, NULL, NULL, '', '1', '2020-07-28 18:03:43', '2020-07-30 17:05:06'),
(200, 3, NULL, NULL, NULL, '2710', 'Beef Ribs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '2020-07-30 01:15:37', '2020-07-30 01:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `google_map_link` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `region`, `google_map_link`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Kuching', 'sadasdsad', 1, '2', '2019-12-26 17:15:13', '2020-07-25 12:30:54'),
(2, 'Sibu', 'https://adsadsad', 2, '2', '2019-12-26 17:15:29', '2020-07-25 12:30:54'),
(3, 'Miri', '', 3, '1', '2020-06-24 11:11:00', '2020-06-24 11:11:00'),
(4, 'Serian', '', 4, '2', '2020-07-09 12:19:29', '2020-07-25 12:30:54'),
(5, 'Kuching', '', 2, '1', '2020-08-26 10:18:13', '2020-08-26 10:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `stock_promo`
--

CREATE TABLE `stock_promo` (
  `id` int(11) NOT NULL,
  `uom` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_low` int(11) DEFAULT NULL,
  `promo` varchar(4) COLLATE latin1_general_ci DEFAULT NULL,
  `was` decimal(11,2) DEFAULT NULL,
  `cron` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `stock_promo`
--

INSERT INTO `stock_promo` (`id`, `uom`, `location`, `stock`, `stock_low`, `promo`, `was`, `cron`, `created`, `modified`) VALUES
(1, 1, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-10 19:54:36'),
(2, 2, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(3, 3, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(4, 4, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-13 12:06:10'),
(5, 5, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-10 19:54:36'),
(6, 6, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(7, 7, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(8, 8, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(9, 9, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-10 14:40:23'),
(10, 10, 4, 0, 0, '', '0.00', NULL, '2020-07-06 16:40:04', '2020-07-11 11:34:02'),
(11, 11, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(12, 12, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(13, 13, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(14, 14, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(15, 15, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(16, 16, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(17, 17, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(18, 18, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(19, 19, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(20, 20, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(21, 21, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-10 14:19:17'),
(22, 22, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-11 11:34:02'),
(23, 23, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-10 11:49:57'),
(24, 24, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(25, 25, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(26, 26, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-11 11:34:02'),
(27, 27, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(28, 28, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(29, 29, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:21:01', '2020-07-06 18:21:01'),
(30, 30, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(31, 31, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(32, 32, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(33, 33, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(34, 34, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(35, 35, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(36, 36, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(37, 37, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(38, 38, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(39, 39, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(40, 40, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(41, 41, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(42, 42, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(43, 43, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(44, 44, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(45, 45, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(46, 46, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(47, 47, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(48, 48, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-06 18:35:44'),
(49, 49, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-10 11:49:57'),
(50, 50, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-10 11:49:57'),
(51, 51, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-10 11:49:23'),
(52, 52, 4, 0, 0, '', '0.00', NULL, '2020-07-06 18:35:44', '2020-07-10 11:10:22'),
(53, 159, 4, 2, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(54, 158, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(55, 157, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(56, 156, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(57, 155, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(58, 154, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(59, 153, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(60, 152, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(61, 151, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(62, 150, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(63, 149, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(64, 148, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(65, 147, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(66, 146, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(67, 145, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(68, 144, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(69, 143, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(70, 142, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(71, 141, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(72, 140, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(73, 139, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(74, 138, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(75, 137, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(76, 136, 4, 0, 0, '', '0.00', NULL, '2020-07-07 14:59:34', '2020-07-07 14:59:34'),
(77, 216, 4, 0, 0, '', '0.00', NULL, '2020-07-07 18:17:11', '2020-07-10 11:17:03'),
(78, 215, 4, 0, 0, '', '0.00', NULL, '2020-07-07 18:17:11', '2020-07-10 11:49:57'),
(79, 258, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(80, 257, 4, 6, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(81, 256, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(82, 255, 4, 15, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(83, 254, 4, 4, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(84, 253, 4, 6, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(85, 252, 4, 3, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(86, 251, 4, 8, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(87, 250, 4, 7, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(88, 249, 4, 6, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(89, 248, 4, 17, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(90, 247, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(91, 246, 4, 10, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(92, 245, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(93, 244, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(94, 243, 4, 7, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(95, 242, 4, 7, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(96, 241, 4, 3, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(97, 240, 4, 8, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(98, 239, 4, 2, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(99, 238, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(100, 237, 4, 6, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(101, 236, 4, 14, 5, '', '12.00', NULL, '2020-07-25 18:41:38', '2020-07-29 12:50:00'),
(102, 235, 4, 15, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(103, 295, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(104, 294, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(105, 293, 4, 8, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(106, 292, 4, 8, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-29 12:50:00'),
(107, 291, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(108, 290, 4, 14, 4, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(109, 289, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(110, 288, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(111, 287, 4, 3, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(112, 286, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(113, 285, 4, 8, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(114, 284, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(115, 283, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(116, 282, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(117, 281, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(118, 280, 4, 12, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(119, 279, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(120, 278, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(121, 277, 4, 16, 4, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(122, 276, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(123, 275, 4, 1, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(124, 274, 4, 15, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(125, 273, 4, 8, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(126, 272, 4, 5, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(127, 271, 4, 7, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(128, 270, 4, 60, 10, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(129, 269, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(130, 268, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(131, 267, 4, 3, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(132, 266, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(133, 265, 4, 10, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(134, 264, 4, 20, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(135, 263, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(136, 262, 4, 9, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(137, 261, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(138, 260, 4, 3, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(139, 259, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(140, 234, 4, 2, 1, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(141, 233, 4, 10, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(142, 232, 4, 22, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(143, 231, 4, 20, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(144, 230, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(145, 229, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(146, 228, 4, 10, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(147, 227, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(148, 226, 4, 5, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(149, 225, 4, 21, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(150, 224, 4, 48, 12, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(151, 223, 4, 21, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(152, 222, 4, 7, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(153, 221, 4, 300, 50, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-29 12:50:00'),
(154, 220, 4, 4, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(155, 219, 4, 100, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(156, 218, 4, 3, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(157, 217, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(158, 296, 4, 10, 3, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(159, 297, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(160, 298, 4, 15, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(161, 299, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(162, 300, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(163, 301, 4, 20, 5, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(164, 302, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(165, 303, 4, 6, 2, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(166, 304, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(167, 305, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(168, 306, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(169, 307, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(171, 309, 4, 0, 0, '', '0.00', NULL, '2020-07-25 18:41:38', '2020-07-25 18:41:38'),
(173, 311, 4, -1, 0, '', '0.00', NULL, '2020-07-29 12:10:44', '2020-09-07 15:32:48'),
(174, 312, 4, 0, 0, '', '0.00', NULL, '2020-07-30 12:21:36', '2020-07-30 12:21:36'),
(176, 314, 4, 0, 0, '', '0.00', NULL, '2020-07-30 12:21:36', '2020-07-30 12:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created`, `modified`) VALUES
(1, 'jonathan.wphp@gmail.com', '2020-06-05 16:58:31', '2020-06-05 16:58:31'),
(2, 'daus.grocere@gmail.com', '2020-06-30 17:22:49', '2020-06-30 17:22:49'),
(3, 'asd@gmail.com', '2020-07-01 09:53:40', '2020-07-01 09:53:40'),
(4, 'asdas@gmail.com', '2020-07-01 09:53:49', '2020-07-01 09:53:49'),
(5, '123@yahoo.com', '2020-07-02 12:21:38', '2020-07-02 12:21:38'),
(6, 'asdasd@gmail.com', '2020-07-06 15:32:51', '2020-07-06 15:32:51'),
(8, 'johnsonporter775@gmail.com', '2020-07-09 13:22:16', '2020-07-09 13:22:16'),
(9, 'choofyp@hotmail.com', '2020-07-10 20:10:57', '2020-07-10 20:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `category` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `sub_category` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `popular` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category`, `sub_category`, `popular`, `position`, `status`, `created`, `modified`) VALUES
(12, '4', 'Fresh Meat & Seafood', NULL, 0, '1', '2020-07-27 13:08:12', '2020-07-27 13:08:41'),
(13, '5', 'Chicken', NULL, 1, '1', '2020-07-27 13:09:47', '2020-07-27 13:09:47'),
(14, '5', 'Beef', NULL, 0, '1', '2020-07-27 13:09:57', '2020-07-27 13:09:57'),
(16, '5', 'Seafood', NULL, 0, '1', '2020-07-27 13:10:14', '2020-07-27 13:10:33'),
(17, '5', 'Lamb', NULL, 0, '1', '2020-07-27 13:10:46', '2020-07-27 13:10:46'),
(18, '5', 'French Fries', NULL, 0, '1', '2020-07-27 13:11:43', '2020-07-27 13:11:43'),
(19, '5', 'Vegetables', NULL, 0, '1', '2020-07-27 13:12:02', '2020-07-27 13:12:02'),
(20, '5', 'Bakery & Pastry', NULL, 0, '1', '2020-07-27 13:14:04', '2020-07-27 13:14:04'),
(21, '4', 'Egg', NULL, 0, '1', '2020-07-27 13:14:53', '2020-07-27 13:14:53'),
(22, '5', 'Duck', NULL, 0, '1', '2020-07-27 20:09:41', '2020-07-27 20:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `module` varchar(20) DEFAULT NULL,
  `keyword` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `module`, `keyword`, `created`, `modified`) VALUES
(1, 'pdfs', 'family, Heathly,', '2017-05-15 00:00:00', '2017-05-19 14:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `time_span_standard`
--

CREATE TABLE `time_span_standard` (
  `id` int(11) NOT NULL,
  `january` int(9) DEFAULT NULL,
  `february` int(9) DEFAULT NULL,
  `march` int(9) DEFAULT NULL,
  `april` int(9) DEFAULT NULL,
  `may` int(9) DEFAULT NULL,
  `jun` int(9) DEFAULT NULL,
  `july` int(9) DEFAULT NULL,
  `august` int(9) DEFAULT NULL,
  `september` int(9) DEFAULT NULL,
  `october` int(9) DEFAULT NULL,
  `november` int(9) DEFAULT NULL,
  `december` int(9) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_span_standard`
--

INSERT INTO `time_span_standard` (`id`, `january`, `february`, `march`, `april`, `may`, `jun`, `july`, `august`, `september`, `october`, `november`, `december`, `created`, `modified`) VALUES
(1, 6, 15, 17, 16, 17, 18, 19, 20, 19, 18, 17, 16, NULL, '2020-07-10 00:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `expiry`) VALUES
(255, '5f55e02bb2538', '2020-09-07 15:34:27'),
(256, '5f55e220c1294', '2020-09-07 15:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `product` int(11) DEFAULT NULL,
  `uom` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `region`, `product`, `uom`, `price`, `position`, `status`, `created`, `modified`) VALUES
(1, 3, 1, 'PCS/1', '4.00', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:36'),
(2, 3, 2, 'PKT/1', '5.00', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:36'),
(3, 3, 3, 'PKT/1', '12.00', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:36'),
(4, 3, 4, 'PKT/1', '8.80', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(5, 3, 5, 'PCS/1', '2.50', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(6, 3, 6, 'PCS/1', '0.80', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(7, 3, 7, 'KG/1', '10.00', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(8, 3, 8, 'KG/1', '7.00', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(9, 3, 9, 'PCS/1', '1.80', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(10, 3, 10, 'PCS/1', '1.20', 1, '2', '2020-07-06 14:45:21', '2020-07-30 12:35:17'),
(258, 3, 147, 'PKT/1', '9.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(257, 3, 146, 'PKT/1', '12.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(256, 3, 145, 'PKT/1', '5.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(255, 3, 144, 'PKT/1', '2.10', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(254, 3, 143, 'KG/1', '8.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(253, 3, 142, 'PKT/1', '12.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(252, 3, 141, 'PKT/1', '8.60', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(251, 3, 140, 'PKT/1', '7.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(250, 3, 139, 'PACK/1', '11.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(21, 3, 21, 'PCS/1', '0.50', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:05'),
(22, 3, 22, 'PCS/1', '0.40', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:05'),
(23, 3, 23, 'PCS/1', '1.00', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(24, 3, 24, 'PCS/1', '1.20', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(25, 3, 25, 'PCS/1', '1.50', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(26, 3, 26, 'PCS/1', '2.00', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(27, 3, 27, 'PCS/1', '0.70', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(28, 3, 28, 'PKT/1', '2.50', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(29, 3, 29, 'PCS/1', '2.50', 1, '2', '2020-07-06 18:17:34', '2020-07-30 12:35:36'),
(249, 3, 138, 'PACK/1', '8.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(248, 3, 137, 'PACK/1', '2.45', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(247, 3, 136, 'PKT/1', '10.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(246, 3, 135, 'PKT/1', '6.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(245, 3, 134, 'PKT/1', '9.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(244, 3, 133, 'PKT/1', '8.10', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(243, 3, 132, 'PKT/1', '9.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(242, 3, 131, 'PKT/1', '12.70', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(241, 3, 130, 'PKT/1', '3.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(240, 3, 129, 'PKT/1', '6.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(239, 3, 128, 'PKT/1', '6.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(238, 3, 127, 'PACK/1', '10.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(237, 3, 126, 'PACK/1', '10.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(236, 3, 125, 'PKT/1', '5.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(235, 3, 124, 'PKT/1', '5.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(49, 3, 49, 'PCS/1', '4.50', 1, '2', '2020-07-06 18:35:13', '2020-07-30 12:35:05'),
(50, 3, 50, 'PCS/1', '7.20', 1, '2', '2020-07-06 18:35:13', '2020-07-30 12:35:05'),
(51, 3, 51, 'PCS/1', '7.20', 1, '2', '2020-07-06 18:35:13', '2020-07-30 12:35:05'),
(52, 3, 52, 'PCS/1', '1.00', 1, '2', '2020-07-06 18:35:13', '2020-07-30 12:35:05'),
(53, 1, 1, 'PCS/1', '4.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(54, 1, 2, 'PKT/1', '5.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(55, 1, 3, 'PKT/1', '12.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(56, 1, 4, 'PKT/1', '8.80', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(57, 1, 5, 'PCS/1', '2.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(58, 1, 6, 'PCS/1', '0.80', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(59, 1, 7, 'KG/1', '10.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(60, 1, 8, 'KG/1', '7.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(61, 1, 9, 'PCS/1', '1.80', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(62, 1, 10, 'PCS/1', '1.20', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(63, 1, 21, 'PCS/1', '0.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(64, 1, 22, 'PCS/1', '0.40', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(65, 1, 23, 'PCS/1', '1.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(66, 1, 24, 'PCS/1', '1.20', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(67, 1, 25, 'PCS/1', '1.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(68, 1, 26, 'PCS/1', '2.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(69, 1, 27, 'PCS/1', '0.70', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(70, 1, 28, 'PKT/1', '2.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(71, 1, 29, 'PCS/1', '2.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(72, 1, 49, 'PCS/1', '4.50', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(73, 1, 50, 'PCS/1', '7.20', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(74, 1, 51, 'PCS/1', '7.20', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(75, 1, 52, 'PCS/1', '1.00', 1, '1', '2020-07-06 18:43:00', '2020-07-06 18:43:00'),
(295, 3, 184, 'KG/1', '7.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(294, 3, 183, 'KG/1', '17.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(293, 3, 182, 'KG/1', '8.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(292, 3, 181, 'KG/1', '7.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(291, 3, 180, 'KG/1', '170.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(290, 3, 179, 'KG/1', '33.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(289, 3, 178, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(288, 3, 177, 'KG/1', '6.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(287, 3, 176, 'KG/1', '9.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(286, 3, 175, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(285, 3, 174, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(284, 3, 173, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(283, 3, 172, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(282, 3, 171, 'KG/1', '18.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(281, 3, 170, 'KG/1', '18.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(280, 3, 169, 'KG/1', '12.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(279, 3, 168, 'KG/1', '1.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(278, 3, 167, 'KG/1', '22.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(277, 3, 166, 'KG/1', '7.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(276, 3, 165, 'KG/1', '2.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(275, 3, 164, 'KG/1', '3.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(274, 3, 163, 'KG/1', '3.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(273, 3, 162, 'KG/1', '3.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(272, 3, 161, 'KG/1', '12.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(271, 3, 160, 'KG/1', '8.90', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(270, 3, 159, 'KG/1', '11.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(269, 3, 158, 'KG/1', '7.90', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(268, 3, 157, 'KG/1', '5.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(267, 3, 156, 'KG/1', '7.10', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(266, 3, 155, 'KG/1', '11.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(265, 3, 154, 'KG/1', '12.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(264, 3, 153, 'KG/1', '13.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(263, 3, 152, 'PKT/1', '2.60', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(262, 3, 151, 'PKT/1', '2.60', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(261, 3, 150, 'PKT/1', '6.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(260, 3, 149, 'PKT/1', '6.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(259, 3, 148, 'PKT/1', '5.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(234, 3, 123, 'PKT/1', '4.40', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(233, 3, 122, 'PKT/1', '2.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(232, 3, 121, 'PKT/1', '7.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(231, 3, 120, 'PKT/1', '7.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(230, 3, 119, 'PKT/1', '6.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(229, 3, 118, 'PKT/1', '6.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(228, 3, 117, 'PKT/1', '8.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(227, 3, 116, 'PKT/1', '8.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(226, 3, 115, 'PKT/1', '8.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(225, 3, 114, 'PKT/1', '2.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(224, 3, 113, 'PKT/1', '2.45', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(223, 3, 112, 'PKT/1', '2.15', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(222, 3, 111, 'TRAY/30', '8.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(221, 3, 111, 'PCS/1', '0.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(220, 3, 110, 'TRAY/30', '8.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(219, 3, 110, 'PCS/1', '0.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(218, 3, 109, 'TRAY/30', '11.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(217, 3, 109, 'PCS/1', '0.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:05'),
(216, 3, 108, 'PKT/1', '8.80', 1, '2', '2020-07-07 18:16:46', '2020-07-30 12:35:05'),
(215, 3, 103, 'PCS/1', '1.20', 1, '2', '2020-07-07 15:51:35', '2020-07-30 12:35:05'),
(296, 3, 185, 'KG/1', '10.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(297, 3, 186, 'KG/1', '21.30', 1, '1', '2020-07-25 18:25:34', '2020-07-30 12:33:38'),
(298, 3, 187, 'KG/1', '8.10', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(299, 3, 188, 'KG/1', '6.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(300, 3, 189, 'KG/1', '7.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(301, 3, 190, 'KG/1', '7.50', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(302, 3, 191, 'KG/1', '8.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(303, 3, 192, 'KG/1', '9.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(304, 3, 193, 'KG/1', '11.80', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(305, 3, 194, 'KG/1', '7.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(306, 3, 195, 'KG/1', '5.20', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(307, 3, 29, 'KG/1', '3.50', 1, '2', '2020-07-25 18:25:34', '2020-07-30 12:35:05'),
(309, 3, 196, 'KG/1', '140.00', 1, '1', '2020-07-25 18:25:34', '2020-07-30 17:05:06'),
(311, 3, 198, 'KG/1', '4.00', 1, '1', '2020-07-28 18:03:43', '2020-07-30 17:05:06'),
(312, 3, 186, 'Unit/1', '21.30', 1, '1', '2020-07-30 00:17:13', '2020-07-30 17:05:06'),
(314, 3, 200, 'KG/1', '1.00', 1, '2', '2020-07-30 01:15:37', '2020-07-30 12:34:23'),
(315, 3, 201, 'KG/1', '400.00', 1, '1', '2020-07-30 17:04:31', '2020-07-30 17:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `url_page`
--

CREATE TABLE `url_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `display_section` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `open_method` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `url_type` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `display_at_home_page` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `display_at_user_page` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `display_under_category` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `url_page`
--

INSERT INTO `url_page` (`id`, `title`, `display_section`, `open_method`, `url_type`, `url`, `display_at_home_page`, `display_at_user_page`, `display_under_category`, `position`, `status`, `created`, `modified`) VALUES
(1, 'Advertise With Us', 'Header', 'Open as new window', 'Absolute URL', 'advertisement.kuchingig.com/', 'Yes', 'Yes', NULL, 2, '1', '2020-01-06 10:23:47', '2020-01-08 12:05:47'),
(2, 'Merchandise', 'Header', 'Open as new window', 'Absolute URL', 'merchandise.kuchingig.com', 'Yes', 'Yes', NULL, 1, '1', '2020-01-06 10:24:12', '2020-01-08 12:05:44'),
(4, 'Buy Pass!', 'Header', 'Open as new window', 'Absolute URL', 'buypassess.kuchingig.com', 'No', 'Yes', NULL, 3, '1', '2020-01-08 10:58:51', '2020-01-08 12:05:49'),
(5, 'Privacy Policy', 'Footer (Copyright)', 'Open in current window', 'Relative URL', 'PrivacyPolicy.html', NULL, NULL, NULL, 4, '1', '2020-01-08 12:07:46', '2020-01-08 12:07:46'),
(6, ' Terms of Use', 'Footer (Copyright)', 'Open in current window', 'Relative URL', 'Terms of Services.html', NULL, NULL, NULL, 5, '1', '2020-01-08 12:08:34', '2020-01-08 12:08:34'),
(7, 'Legal', 'Footer (Copyright)', 'Open in current window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, NULL, 7, '1', '2020-01-08 12:09:07', '2020-01-08 12:09:07'),
(8, ' License', 'Footer (Copyright)', 'Open in current window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, NULL, 8, '1', '2020-01-08 12:09:35', '2020-01-08 12:09:35'),
(9, 'Rules & Regulations', 'Footer', 'Open in current window', 'Relative URL', '#', NULL, NULL, 'Knowledge Centre', 11, '1', '2020-01-08 12:48:26', '2020-01-08 12:48:26'),
(10, 'Safety', 'Footer', 'Open in current window', 'Relative URL', '#', NULL, NULL, 'Knowledge Centre', 12, '1', '2020-01-08 12:48:55', '2020-01-08 12:48:55'),
(11, 'Banner Advertising', 'Footer', 'Open in current window', 'Relative URL', '#', NULL, NULL, 'Knowledge Centre', 13, '1', '2020-01-08 12:49:09', '2020-01-08 12:49:09'),
(12, 'Featured Gig Ads', 'Footer', 'Open in current window', 'Relative URL', '#', NULL, NULL, 'Knowledge Centre', 14, '1', '2020-01-08 12:49:33', '2020-01-08 12:49:33'),
(13, 'Advertise With Us', 'Footer', 'Open as new window', 'Absolute URL', 'advertisement.kuchingig.com/', NULL, NULL, 'Knowledge Centre', 15, '1', '2020-01-08 12:49:46', '2020-01-08 01:05:40'),
(14, 'Membership', 'Footer', 'Open as new window', 'Absolute URL', 'membership.kuchingig.com/', NULL, NULL, 'Knowledge Centre', 16, '1', '2020-01-08 12:50:06', '2020-01-08 01:06:05'),
(15, 'Trusted Gig', 'Footer', 'Open in current window', 'Relative URL', '#', NULL, NULL, 'Knowledge Centre', 17, '1', '2020-01-08 12:50:21', '2020-01-08 12:50:35'),
(16, 'Register your Gig', 'Footer', 'Open in current window', 'Relative URL', 'Z_OMIT_Registration_Page (omit).html', NULL, NULL, 'Support', 21, '1', '2020-01-08 13:00:26', '2020-01-08 13:00:26'),
(17, 'Frequently Asked Question', 'Footer', 'Open as new window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, 'Support', 22, '1', '2020-01-08 13:08:27', '2020-01-08 13:08:27'),
(18, 'Report GiG', 'Footer', 'Open as new window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, 'Support', 23, '1', '2020-01-08 13:08:57', '2020-01-08 13:08:57'),
(19, 'Report Spam/Scam', 'Footer', 'Open as new window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, 'Support', 24, '1', '2020-01-08 13:09:27', '2020-01-08 01:10:27'),
(20, 'Feedback For Improvement', 'Footer', 'Open in current window', 'Relative URL', 'feedback', NULL, NULL, 'Support', 25, '1', '2020-01-08 13:10:21', '2020-01-08 13:10:21'),
(21, 'Merchandise', 'Footer', 'Open as new window', 'Absolute URL', 'merchandise.kuchingig.com/', NULL, NULL, 'Support', 27, '1', '2020-01-08 13:10:58', '2020-01-08 13:10:58'),
(22, 'About KuchingGiGâ„¢', 'Footer', 'Open in current window', 'Relative URL', 'About Us_enhanced.html', NULL, NULL, 'About KuchingGiG', 31, '1', '2020-01-08 13:11:51', '2020-01-08 13:11:51'),
(23, 'Site Map', 'Footer', 'Open in current window', 'Relative URL', 'sitemap.html', NULL, NULL, 'About KuchingGiG', 32, '1', '2020-01-08 13:12:26', '2020-01-08 13:12:26'),
(24, 'Terms of Use', 'Footer', 'Open in current window', 'Relative URL', 'Terms of Services.html', NULL, NULL, 'About KuchingGiG', 33, '1', '2020-01-08 13:13:08', '2020-01-08 13:13:08'),
(25, 'Privacy Policy', 'Footer', 'Open in current window', 'Relative URL', 'PrivacyPolicy.html', NULL, NULL, 'About KuchingGiG', 34, '1', '2020-01-08 13:13:45', '2020-01-08 01:15:27'),
(26, 'Career', 'Footer', 'Open as new window', 'Relative URL', 'MaintenancePage_enhanced.html', NULL, NULL, 'About KuchingGiG', 35, '1', '2020-01-08 13:14:09', '2020-01-08 01:15:29'),
(27, 'Contact Us', 'Footer', 'Open in current window', 'Relative URL', 'contact_us', NULL, NULL, 'About KuchingGiG', 36, '1', '2020-01-08 13:14:45', '2020-01-08 01:15:32');

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
(70, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:06:35'),
(71, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:07:10'),
(72, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/product/uom.php', 'logout', '2020-05-23 21:38:42'),
(73, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:38:47'),
(74, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/admin_main.php', 'logout', '2020-05-23 21:38:48'),
(75, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:38:52'),
(76, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/product/add_product.php?id=MTU=', 'logout', '2020-05-23 21:39:05'),
(77, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:39:18'),
(78, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/product/list_product.php', 'logout', '2020-05-23 21:41:21'),
(79, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-23 21:41:23'),
(80, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-24 10:28:46'),
(81, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-25 14:37:14'),
(82, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-27 14:13:46'),
(83, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-28 20:04:06'),
(84, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-29 15:12:57'),
(85, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-30 09:59:52'),
(86, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-31 09:32:58'),
(87, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-02 22:19:50'),
(88, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-03 16:40:33'),
(89, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-04 13:21:25'),
(90, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-04 13:21:59'),
(91, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-04 13:22:06'),
(92, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-05 09:30:20'),
(93, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-05 14:08:57'),
(94, 'login:47', '192.168.0.1', '', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-05 15:08:45'),
(95, 'login:47', '175.141.213.144', 'Malaysia', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-05 16:39:29'),
(96, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-09 17:36:39'),
(97, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-09 19:23:45'),
(98, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-12 10:59:28'),
(99, 'login:47', '183.171.116.254', 'Malaysia', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-12 13:29:49'),
(100, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-15 18:47:15'),
(101, 'login:51', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-15 18:51:11'),
(102, 'login:47', '124.13.211.175', 'Malaysia', 'http://wphp.hopto.org/epswireframe/cms/authentication/login.php', 'login', '2020-06-15 19:22:47'),
(103, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-17 12:13:15'),
(104, 'login:47', '::1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-06-17 16:45:15'),
(105, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-23 15:47:37'),
(106, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-23 16:06:08'),
(107, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-24 11:10:30'),
(108, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-24 11:44:32'),
(109, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-24 11:45:07'),
(110, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-24 12:03:40'),
(111, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-24 17:20:55'),
(112, 'login:47', '183.171.116.88', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-25 11:30:40'),
(113, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-25 11:43:00'),
(114, 'login:47', '127.0.0.1', '', '', 'logout', '2020-06-25 14:41:35'),
(115, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-25 14:42:14'),
(116, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-25 14:42:51'),
(117, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-26 13:12:36'),
(118, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-26 14:46:48'),
(119, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-27 12:25:18'),
(120, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-27 13:02:44'),
(121, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-29 10:34:15'),
(122, 'login:47', '183.171.117.92', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-29 10:34:34'),
(123, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-29 14:42:43'),
(124, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-29 15:24:07'),
(125, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 10:03:03'),
(63, '', '127.0.0.1', '', 'http://localhost/epswireframe/cms/account/admins.php?id=NDg=', 'logout', '2020-05-22 10:22:19'),
(64, 'login:48', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-22 10:22:30'),
(65, '', '127.0.0.1', '', 'http://localhost/epswireframe/cms/report/delivered_declined.php', 'logout', '2020-05-22 11:15:25'),
(66, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-22 11:15:28'),
(67, 'login:47', '127.0.0.1', '', 'http://localhost/epswireframe/cms/authentication/login.php', 'login', '2020-05-22 16:02:40'),
(126, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 14:35:11'),
(127, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/list_product', 'logout', '2020-06-30 14:44:53'),
(128, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 14:49:54'),
(129, '', '::1', '', 'http://localhost/grocere.com.my/cms/account/member_visits', 'logout', '2020-06-30 17:00:24'),
(130, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-30 17:00:44'),
(131, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/account/admins', 'logout', '2020-06-30 17:01:01'),
(132, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-30 17:01:09'),
(133, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-06-30 17:01:55'),
(134, 'login:53', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 17:01:59'),
(135, 'login:53', '::1', '', 'http://localhost/grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-06-30 17:03:52'),
(136, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 17:03:54'),
(137, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-06-30 17:06:12'),
(138, 'login:55', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 17:06:20'),
(139, 'login:55', '::1', '', 'http://localhost/grocere.com.my/cms/content/pages', 'logout', '2020-06-30 17:15:18'),
(140, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-06-30 17:15:21'),
(141, '', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/uom', 'logout', '2020-06-30 17:35:37'),
(142, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-06-30 17:36:09'),
(143, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-01 09:58:51'),
(144, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 09:59:39'),
(145, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-07-01 10:00:41'),
(146, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-01 10:00:54'),
(147, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/account/admins', 'logout', '2020-07-01 12:07:22'),
(148, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 12:07:30'),
(149, 'login:47', '192.168.0.1', '', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 12:09:35'),
(150, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 12:09:42'),
(151, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 12:10:29'),
(152, 'login:47', '192.168.0.1', '', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 12:52:55'),
(153, '', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/account/admins', 'logout', '2020-07-01 13:23:28'),
(154, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 13:23:36'),
(155, '', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/report/delivered_declined', 'logout', '2020-07-01 13:38:41'),
(156, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 13:38:44'),
(157, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/order/orders', 'logout', '2020-07-01 13:40:03'),
(158, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 13:40:11'),
(159, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/order/orders', 'logout', '2020-07-01 13:47:24'),
(160, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 13:47:27'),
(161, '', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/content/pages', 'logout', '2020-07-01 14:42:16'),
(162, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 14:42:23'),
(163, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/order/orders', 'logout', '2020-07-01 14:46:50'),
(164, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 14:46:53'),
(165, '', '192.168.0.1', '', 'http://wphp.hopto.org/grocere.com.my/cms/product/uom?l=NG1NYnNKckw4QzRhOGhkT0M5NXNMUT09', 'logout', '2020-07-01 15:57:57'),
(166, 'login:55', '192.168.0.1', '', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 15:58:05'),
(167, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 16:05:48'),
(168, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/product/list_product', 'logout', '2020-07-01 16:10:56'),
(169, 'login:55', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-01 16:11:17'),
(170, 'login:55', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/product/list_product', 'logout', '2020-07-01 16:31:38'),
(171, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 16:31:41'),
(172, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 17:45:02'),
(173, 'login:47', '127.0.0.1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-01 18:26:49'),
(174, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 09:05:50'),
(175, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 10:20:51'),
(176, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/uom', 'logout', '2020-07-02 10:24:07'),
(177, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 10:26:17'),
(178, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 11:09:40'),
(179, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/account/admins', 'logout', '2020-07-02 11:45:12'),
(180, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 11:45:17'),
(181, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/account/admins', 'logout', '2020-07-02 11:45:30'),
(182, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 11:45:35'),
(183, 'login:48', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/order/orders', 'logout', '2020-07-02 11:47:19'),
(184, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 11:47:23'),
(185, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 13:22:23'),
(186, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 13:22:28'),
(187, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-02 16:29:18'),
(188, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-03 14:40:21'),
(189, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/list_product', 'logout', '2020-07-03 14:41:31'),
(190, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-03 14:41:46'),
(191, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/list_product', 'logout', '2020-07-03 14:42:02'),
(192, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-03 14:42:42'),
(193, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/product/list_product', 'logout', '2020-07-03 14:43:10'),
(194, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-03 14:44:19'),
(195, 'login:47', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-03 16:22:36'),
(196, 'login:47', '175.142.20.147', 'Malaysia', 'http://wphp.hopto.org/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 10:21:03'),
(197, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:39:41'),
(198, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-07-06 13:40:47'),
(199, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:41:35'),
(200, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-06 13:41:49'),
(201, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:42:00'),
(202, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/product/list_product', 'logout', '2020-07-06 13:43:11'),
(203, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:43:17'),
(204, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/product/import_product', 'logout', '2020-07-06 13:48:52'),
(205, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:49:01'),
(206, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/admin_main', 'logout', '2020-07-06 13:50:22'),
(207, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:50:29'),
(208, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-06 13:50:49'),
(209, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:51:01'),
(210, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/admin_main', 'logout', '2020-07-06 13:51:08'),
(211, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:51:16'),
(212, 'login:47', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 13:51:24'),
(213, 'login:52', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:30:17'),
(214, 'login:47', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:38:42'),
(215, 'login:47', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/admin_main', 'logout', '2020-07-06 14:38:50'),
(216, 'login:56', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:38:58'),
(217, 'login:56', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/admin_main', 'logout', '2020-07-06 14:39:08'),
(218, 'login:56', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:39:14'),
(219, 'login:56', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-06 14:39:51'),
(220, 'login:57', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:39:58'),
(221, 'login:47', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 14:58:40'),
(222, '', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-06 15:01:20'),
(223, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 15:01:26'),
(224, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-06 15:02:03'),
(225, 'login:58', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 15:02:14'),
(226, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 16:39:03'),
(227, 'login:47', '42.188.190.105', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-06 17:47:01'),
(228, 'login:47', '42.188.144.111', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 10:57:28'),
(229, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 11:24:39'),
(230, '', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/setup/area?tab=Display', 'logout', '2020-07-07 12:00:34'),
(231, 'login:48', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-07 12:00:51'),
(232, 'login:48', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/report/delivered_declined', 'logout', '2020-07-07 12:03:29'),
(233, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 12:03:35'),
(234, 'login:47', '183.171.116.205', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 14:32:55'),
(235, 'login:47', '42.188.144.111', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 14:56:56'),
(236, 'login:47', '42.188.144.111', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 15:17:20'),
(237, 'login:47', '183.171.116.205', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 15:25:03'),
(238, 'login:47', '203.106.219.98', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-07 18:05:25'),
(239, 'login:47', '42.188.177.19', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 10:25:24'),
(240, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 11:30:31'),
(241, 'login:47', '175.142.183.229', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 12:55:46'),
(242, 'login:47', '115.133.108.167', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 12:56:03'),
(243, 'login:47', '115.133.108.167', 'Malaysia', 'http://grocere.com.my/cms/order/orders?tab=New', 'logout', '2020-07-08 13:01:31'),
(244, 'login:47', '42.188.177.19', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 14:21:45'),
(245, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 14:50:58'),
(246, 'login:47', '115.133.108.167', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-08 15:31:51'),
(247, '', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/order/orders?tab=New', 'logout', '2020-07-08 15:47:13'),
(248, 'login:47', '115.133.108.167', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 09:56:11'),
(249, 'login:47', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 10:07:38'),
(250, 'login:47', '115.133.108.167', 'Malaysia', 'http://grocere.com.my/cms/order/orders?tab=New', 'logout', '2020-07-09 10:09:43'),
(251, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 11:02:43'),
(252, '', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-07-09 12:38:04'),
(253, 'login:59', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 12:38:13'),
(254, 'login:59', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-09 12:38:49'),
(255, 'login:47', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-09 12:39:09'),
(256, 'login:47', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/account/admins?tab=Suspended', 'logout', '2020-07-09 12:39:21'),
(257, 'login:59', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 12:39:29'),
(258, 'login:59', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-09 12:39:39'),
(259, 'login:47', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-09 12:40:00'),
(260, '', '175.142.183.229', 'Malaysia', 'https://grocere.com.my/cms/order/time_span_standard?id=MQ==', 'logout', '2020-07-09 13:31:09'),
(261, 'login:47', '115.133.108.167', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 14:13:37'),
(262, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-09 14:29:07'),
(263, 'login:47', '115.133.108.167', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-09 15:18:19'),
(264, 'login:47', '42.188.177.19', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 16:05:45'),
(265, 'login:47', '42.188.177.19', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-09 17:22:46'),
(266, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 00:05:24'),
(267, 'login:47', '42.188.128.18', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 09:21:05'),
(268, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 09:30:25'),
(269, '', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/account/admins', 'logout', '2020-07-10 10:55:39'),
(270, 'login:61', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 10:55:48'),
(271, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 10:58:52'),
(272, 'login:47', '42.188.128.18', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 11:10:04'),
(273, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 14:07:43'),
(274, 'login:61', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 14:16:07'),
(275, 'login:47', '42.188.128.18', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 16:26:36'),
(276, 'login:61', '109.169.23.76', 'United Kingdom', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 16:59:51'),
(277, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-10 18:22:09'),
(278, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-10 20:08:17'),
(279, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/order/orders?tab=Delivered', 'logout', '2020-07-10 20:12:00'),
(280, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-11 11:27:34'),
(281, 'login:47', '175.142.20.147', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-11 12:36:39'),
(282, 'login:47', '183.171.118.161', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-13 11:58:50'),
(283, 'login:47', '115.133.108.167', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-13 11:59:56'),
(284, 'login:47', '113.210.111.179', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-13 13:56:24'),
(285, 'login:47', '183.171.119.187', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-14 17:12:19'),
(286, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:26:46'),
(287, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/admin_main', 'logout', '2020-07-15 11:28:34'),
(288, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:29:07'),
(289, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/account/admins?tab=Activated', 'logout', '2020-07-15 11:31:29'),
(290, 'login:62', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:31:39'),
(291, 'login:62', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/order/orders', 'logout', '2020-07-15 11:32:54'),
(292, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:33:01'),
(293, 'login:63', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:40:06'),
(294, 'login:63', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/product/list_product', 'logout', '2020-07-15 11:40:18'),
(295, 'login:47', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-15 11:40:44'),
(296, 'login:64', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-15 11:41:15'),
(297, '', '124.13.151.8', 'Malaysia', 'http://grocere.com.my/cms/product/uom?l=NG1NYnNKckw4QzRhOGhkT0M5NXNMUT09', 'logout', '2020-07-15 11:59:33'),
(298, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-25 12:28:49'),
(299, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-25 18:25:16'),
(300, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-25 18:35:56'),
(301, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-27 10:33:46'),
(302, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-27 12:33:45'),
(303, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-27 15:56:02'),
(304, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-27 19:44:39'),
(305, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-27 21:23:37'),
(306, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-28 11:26:28'),
(307, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-28 16:37:25'),
(308, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 01:28:29'),
(309, 'login:47', '175.140.238.144', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 12:06:42'),
(310, 'login:47', '175.140.238.144', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 12:49:23'),
(311, 'login:47', '175.140.238.144', 'Malaysia', 'http://www.grocere.com.my/cms/account/admins', 'logout', '2020-07-29 13:00:24'),
(312, 'login:65', '175.140.238.144', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 13:00:33'),
(313, 'login:65', '175.140.238.144', 'Malaysia', 'http://www.grocere.com.my/cms/authentication/change_password', 'logout', '2020-07-29 13:09:18'),
(314, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 18:04:18'),
(315, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 23:03:25'),
(316, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-29 23:54:47'),
(317, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 02:06:13'),
(318, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 11:40:31'),
(319, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 14:31:16'),
(320, 'login:66', '37.120.208.80', 'Romania', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 14:32:06'),
(321, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-07-30 15:34:10'),
(322, 'login:66', '42.188.164.175', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 15:59:20'),
(323, 'login:47', '124.13.39.76', 'Malaysia', 'https://grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 16:33:28'),
(324, 'login:66', '127.0.0.1', '', 'https://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-07-30 17:03:20'),
(325, 'login:66', '127.0.0.1', '', 'https://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-08-03 09:23:22'),
(326, 'login:66', '127.0.0.1', '', 'https://localhost/grocere.com.my/cms/account/admins', 'logout', '2020-08-03 09:41:59'),
(327, 'login:65', '127.0.0.1', '', 'https://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-08-03 09:42:08'),
(328, 'login:66', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php', 'login', '2020-08-03 18:18:26'),
(329, 'login:66', '::1', '', 'http://localhost/grocere.com.my/cms/authentication/login.php?str=wrong', 'login', '2020-08-24 17:24:41'),
(330, 'login:66', '::1', '', 'https://localhost/grocere2/cms/authentication/login.php?str=wrong', 'login', '2020-08-26 09:51:51'),
(331, 'login:66', '127.0.0.1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-08-28 14:48:22'),
(332, 'login:66', '::1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-08-28 17:00:46'),
(333, 'login:66', '127.0.0.1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-08-29 09:12:18'),
(334, 'login:66', '127.0.0.1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-08-29 13:06:31'),
(335, 'login:66', '::1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-09-01 09:33:48'),
(336, 'login:66', '::1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-09-04 13:38:32'),
(337, 'login:66', '::1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-09-04 13:50:45'),
(338, 'login:66', '127.0.0.1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-09-07 11:58:59'),
(339, 'login:66', '127.0.0.1', '', 'https://localhost/grocere2/cms/authentication/login.php', 'login', '2020-09-07 14:50:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_tier`
--
ALTER TABLE `delivery_tier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_notification`
--
ALTER TABLE `email_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_visits`
--
ALTER TABLE `member_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigator`
--
ALTER TABLE `navigator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prepare`
--
ALTER TABLE `prepare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_promo`
--
ALTER TABLE `stock_promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_span_standard`
--
ALTER TABLE `time_span_standard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url_page`
--
ALTER TABLE `url_page`
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
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `banner_dashboard`
--
ALTER TABLE `banner_dashboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `delivery_tier`
--
ALTER TABLE `delivery_tier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_notification`
--
ALTER TABLE `email_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member_visits`
--
ALTER TABLE `member_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `navigator`
--
ALTER TABLE `navigator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_gateway`
--
ALTER TABLE `payment_gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `prepare`
--
ALTER TABLE `prepare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_promo`
--
ALTER TABLE `stock_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_span_standard`
--
ALTER TABLE `time_span_standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `url_page`
--
ALTER TABLE `url_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
