-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 03:33 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shorten_my_domain`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_system`
--

CREATE TABLE `login_system` (
  `id` int(11) NOT NULL,
  `username` varchar(5) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_system`
--

INSERT INTO `login_system` (`id`, `username`, `password`) VALUES
(1, 'admin', '1a1dc91c907325c69271ddf0c944bc72');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `original` varchar(1000) NOT NULL,
  `shortened` varchar(40) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `expiry_date` datetime NOT NULL,
  `renewable` tinyint(1) NOT NULL,
  `active_period` int(11) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `original`, `shortened`, `creation_date`, `expiry_date`, `renewable`, `active_period`, `is_enabled`) VALUES
(272, 'https://www.youtube.com/', 'lKEl5sm', '2021-01-19 03:32:20', '2021-01-20 03:32:20', 0, 1440, 1),
(273, 'https://www.chess.com/', 'WcUQHLW', '2021-01-19 03:32:33', '2021-01-20 03:32:33', 0, 1440, 1),
(274, 'https://www.news247.gr/politiki/aparadekti-kathysterisi-stin-arsi-asylias-lagoy-kataggellei-i-eo-toy-kke.9115154.html', 'ljA7RoT', '2021-01-19 03:32:55', '2021-01-20 03:32:55', 0, 1440, 1),
(276, 'https://www.cloudflare.com/resource-hub/?resourcetype=Whitepaper', 'nyeO_ZE', '2021-01-19 03:34:55', '2021-01-20 03:34:55', 0, 1440, 1),
(277, 'https://europa.eu/european-union/index_en', 'A1wc9U0', '2021-01-19 03:35:26', '2021-01-20 03:35:26', 0, 1440, 1),
(278, 'https://www.news247.gr/gnomes/viky-samara/giati-den-milise-noritera-i-sofia-mpekatoroy.9111792.html?fbclid=IwAR1HAZMcCTKFBkl5e85d2Fo4ZwwYLVXnvtYZ-U3pKEXgYY_tpa_aasX95vM', 'txV8ODU', '2021-01-19 03:35:51', '2021-02-03 03:51:30', 0, 21600, 1),
(279, 'https://edition.cnn.com/health', 'yzhMKCX', '2021-01-19 03:36:32', '2021-01-26 03:36:32', 1, 10080, 1),
(280, 'https://www.news247.gr/good-news/to-apolyto-alpiko-topio-ta-chionismena-trikala-korinthias-kai-i-limni-doxa.9113502.html', 'De7VT7g', '2021-01-19 03:36:54', '2021-01-26 03:36:54', 1, 10080, 1),
(281, 'https://developer.paypal.com/home/', 'ovIi6Qw', '2021-01-19 03:37:28', '2021-01-20 03:37:28', 0, 1440, 1),
(282, 'https://time.com/4272666/refugees-stories-whatsapp/', 'WgvJ6tb', '2021-01-19 03:38:42', '2021-01-26 03:38:42', 1, 10080, 1),
(283, 'https://www.e-daily.gr/popculture/163686/i-tainia-pou-gyristike-prin-to-olethrio-symvan-pou-perimenoun-na-symvei-video', 'easubqD', '2021-01-19 03:39:09', '2021-01-20 03:39:09', 0, 1440, 1),
(284, 'https://www.msn.com/el-gr/news/world/%ce%b9%cf%83%ce%b7%ce%bc%ce%b5%cf%81%ce%b9%ce%bd%cf%8c%cf%82-%ce%bc%ce%b5%ce%b3%ce%ac%ce%bb%ce%bf-%ce%b4%cf%85%cf%83%cf%84%cf%8d%cf%87%ce%b7%ce%bc%ce%b1-%ce%bc%ce%b5-%ce%bc%ce%af%ce%bd%ce%b9%ce%bc%cf%80%ce%b1%cf%82-12-%ce%bf%ce%b9-%ce%bd%ce%b5%ce%ba%cf%81%ce%bf%ce%af-%ce%bf%ce%b9-%ce%bc%ce%b9%cf%83%ce%bf%ce%af-%cf%80%ce%b1%ce%b9%ce%b4%ce%b9%ce%ac/ar-BB1cRWlt?li=BBqxAac', 'u_GEoEq', '2021-01-19 03:39:35', '2021-01-20 03:39:35', 1, 1440, 1),
(285, 'https://www.news247.gr/oikonomia/kata-78-meiothike-o-tziros-ton-xenodocheion-to-2020-se-schesi-me-to-2019.9115138.html', 'gERRHFW', '2021-01-19 03:41:24', '2021-01-20 03:41:24', 0, 1440, 1),
(286, 'http://eelslap.com/', '5TENEkc', '2021-01-19 03:42:01', '2021-01-20 03:42:01', 0, 1440, 1),
(287, 'https://heeeeeeeey.com/', 'ZBfBjX2', '2021-01-19 03:42:32', '2021-01-20 03:42:32', 0, 1440, 1),
(288, 'http://www.staggeringbeauty.com/', '99B5qP6', '2021-01-19 03:42:48', '2021-01-20 03:42:48', 0, 1440, 1),
(289, 'https://www.pointlesssites.com/', 'm1LZyNl', '2021-01-19 03:43:32', '2021-01-26 03:43:32', 1, 10080, 1),
(290, 'https://wordpress.org/news/2021/01/the-month-in-wordpress-december-2020/', 'hoOnPL1', '2021-01-19 03:44:47', '2021-01-20 03:44:47', 0, 1440, 1),
(291, 'https://icons8.com/icons/set/business', 'dc5JeGX', '2021-01-19 03:47:53', '2021-01-01 03:47:53', 0, 1440, 0),
(292, 'https://www.w3schools.com/php/php_sessions.asp', '81WWi14', '2021-01-19 03:57:11', '2021-01-20 03:57:11', 0, 1440, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_system`
--
ALTER TABLE `login_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_system`
--
ALTER TABLE `login_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
