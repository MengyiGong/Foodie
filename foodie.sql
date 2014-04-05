-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2013 at 02:32 PM
-- Server version: 5.6.13-log
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `foodie`
--
CREATE DATABASE `foodie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `foodie`;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Busi_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'photos/no_image.gif',
  `Busi_Categories` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_City` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Rating` int(11) DEFAULT NULL,
  `Busi_Price` int(11) DEFAULT NULL,
  `Busi_OpenTime` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Description` text COLLATE utf8_unicode_ci,
  `Busi_Status` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Processing',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Busi_account` (`Busi_Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `Busi_Name`, `Busi_Username`, `Busi_Password`, `Busi_Phone`, `Busi_Email`, `Busi_Picture`, `Busi_Categories`, `Busi_City`, `Busi_Address`, `Busi_Rating`, `Busi_Price`, `Busi_OpenTime`, `Busi_Description`, `Busi_Status`) VALUES
(1, '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017723356', 'jyi1@stevens.edu', '', 'cuban', '', '', NULL, NULL, '12:00:00', NULL, 'Processing'),
(77, 'fangzhou1', 'fangzhou1', 'a0976ea644305e38022f8bb9acf1b873', '12345', 'fangzhou1@fangzhou1.com', 'photos/the_joker_cartoon.jpg', 'spanish', 'Harrison', '278 park ave', 3, 2, 'monday', NULL, 'Approved'),
(78, 'fangzhou3', 'fangzhou3', 'd3d708c2cbee7e8c9e0e85596f728812', '2017728989', 'fangzhou3@fangzhou3.com', 'photos/sample3.jpg', 'spanish', 'Hoboken', '88 Park AVE', 3, NULL, 'Tuesday', NULL, 'Approved'),
(79, 'fangzhou5', 'fangzhou5', '5c0023f8d795692e0c7d167d4a433b2e', '12345', 'fangzhou5@fangzhou5.com', 'photos/sample2.jpg', 'spanish', 'hoboken', '90 park ave', 0, 0, 'monday', NULL, 'Approved'),
(80, 'fangzhou6', 'fangzhou6', '85b86b92d5f217a69acc040faeef0261', '12345', 'fangzhou6@fangzhou6.com', 'photos/IMG_0002.JPG', 'chinese', '88', 'quincy ave', NULL, NULL, 'monday', NULL, 'Approved'),
(81, 'fangzhou7', 'fangzhou7', 'fd8839ff0f65372486e5cd60198f0a84', '123455', 'fangzhou7@fangzhou7.com', 'photos/sample9.jpg', 'japanese', 'kearny', '88 QUINCY AVE', NULL, NULL, '123', NULL, 'Approved'),
(82, 'fangzhou8', 'fangzhou8', 'c19649f38fc2231ff53ac906c1ae1092', '123456', 'fangzhou8@fangzhou8.com', 'photos/sample9.jpg', 'korean', 'kearny', '88 QUINCY AVE', NULL, NULL, 'sads', NULL, 'Approved'),
(83, 'fangzhou9', 'fangzhou9', 'a04f9479b0b37c755119a87f52fb76bb', '123123', 'fangzhou9@fangzhou9.com', 'photos/sample8.jpg', 'french', 'harrison', '435 William st', NULL, NULL, 'fangzhou9', NULL, 'Approved'),
(84, 'fangzhou10', 'fangzhou10', 'b151f70cea58021589f018dd2eba2b04', '1232144', 'fangzhou10@fangzhou10.com', 'photos/sample4.jpg', 'mexican', 'hoboken', '701 park ave', NULL, NULL, 'fangzhou10', NULL, 'Approved'),
(85, 'fangzhou11', 'fangzhou11', '2d91dadd40b79ba3caf733dee2405764', '123213', 'fangzhou11@fangzhou11.com', 'photos/sample7.jpg', 'latinamerican', '88', 'quincy ave', NULL, NULL, 'fangzhou11', NULL, 'Approved'),
(86, 'fangzhou12', 'fangzhou12', '89b730897d098000850ed9c2afda21ff', '123345', 'fangzhou12@fangzhou12.com', 'photos/sample3.jpg', 'cuban', 'hoboken', '1203 washington st', 2, NULL, 'fangzhou12', NULL, 'Approved'),
(87, 'fangzhou15', 'fangzhou15', '20d8d37485fe79e24961f61284f52bc9', '123456', 'fangzhou15@fangzhou15.com', 'photos/sample5.jpg', 'korean', 'hoboken', '66 park ave', 4, 3, 'fangzhou15', NULL, 'Approved'),
(89, 'gaogao', 'gaogao', '967856e8dd46d819c09d4999e64b9eed', '2017724773', 'gaogao@gaogao.com', 'photos/the_joker_cartoon.jpg', 'chinese', 'Harrison', '435 WILLIAM ST', NULL, NULL, 'monday', NULL, 'Processing'),
(90, 'fangzhou18', 'fangzhou18', 'b41b99eb9f30fee8b5b0fa1e4e0d7a77', '123456789', 'fangzhou18@fangzhou18.com', '/F/photos/the_joker_cartoon.jpg', 'spanish', 'Hoboken', '701 park ave', NULL, NULL, 'monday', NULL, 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_user` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'photos_customer/no_image.gif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_account` (`Customer_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `Customer_user`, `Customer_password`, `Customer_email`, `Customer_picture`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'sds@12.com', NULL),
(70, 'fangzhou1', 'a0976ea644305e38022f8bb9acf1b873', 'fangzhou1@fangzhou1.com', 'photos_customer/the_joker_cartoon.jpg'),
(71, 'fangzhou3', 'd3d708c2cbee7e8c9e0e85596f728812', 'fangzhou3@fangzhou3.com', 'photos_customer/sample3.jpg'),
(72, 'fangzhou5', '5c0023f8d795692e0c7d167d4a433b2e', 'fangzhou5@fangzhou5.com', 'photos_customer/sample2.jpg'),
(73, 'fangzhou6', '85b86b92d5f217a69acc040faeef0261', 'fangzhou6@fangzhou6.com', 'photos_customer/IMG_0002.JPG'),
(74, 'fangzhou7', 'fd8839ff0f65372486e5cd60198f0a84', 'fangzhou7@fangzhou7.com', 'photos_customer/sample9.jpg'),
(75, 'fangzhou8', 'c19649f38fc2231ff53ac906c1ae1092', 'fangzhou8@fangzhou8.com', 'photos_customer/sample9.jpg'),
(76, 'fangzhou9', 'a04f9479b0b37c755119a87f52fb76bb', 'fangzhou9@fangzhou9.com', 'photos_customer/sample8.jpg'),
(77, 'fangzhou10', 'b151f70cea58021589f018dd2eba2b04', 'fangzhou10@fangzhou10.com', 'photos_customer/sample4.jpg'),
(78, 'fangzhou11', '2d91dadd40b79ba3caf733dee2405764', 'fangzhou11@fangzhou11.com', 'photos_customer/sample7.jpg'),
(79, 'fangzhou12', '89b730897d098000850ed9c2afda21ff', 'fangzhou12@fangzhou12.com', 'photos_customer/sample3.jpg'),
(80, 'fangzhou15', '20d8d37485fe79e24961f61284f52bc9', 'fangzhou15@fangzhou15.com', 'photos_customer/sample5.jpg'),
(81, 'Approved', '6f8063417ab31f38d864c28302f3de2f', 'Approved@Approved.com', 'photos_customer/sample1.jpg'),
(82, 'Bob', '078bbb4bf0f7117fb131ec45f15b5b87', 'bob@bob.bob', 'photos_customer/phpinfo.php'),
(83, 'gaogao', '967856e8dd46d819c09d4999e64b9eed', 'gaogao@gaogao.com', 'photos_customer/the_joker_cartoon.jpg'),
(84, 'fangzhou18', 'b41b99eb9f30fee8b5b0fa1e4e0d7a77', 'fangzhou18@fangzhou18.com', '/F/photos_customer/the_joker_cartoon.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Busi_Name` varchar(50) NOT NULL,
  `Customer_user` varchar(50) NOT NULL,
  `Revi_Title` varchar(100) DEFAULT NULL,
  `Revi_Publish_Time` varchar(30) NOT NULL,
  `Revi_Rating` int(2) NOT NULL,
  `Revi_Price` int(2) NOT NULL,
  `Revi_Comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `Busi_Name`, `Customer_user`, `Revi_Title`, `Revi_Publish_Time`, `Revi_Rating`, `Revi_Price`, `Revi_Comment`) VALUES
(1, 'fangzhou1', 'fangzhou1', 'Dr', '2013/12/11', 5, 2, 'sdsadsadsa'),
(2, 'Illuzion', 'test', 'really good', '2013/12/9', 4, 4, 'tasty'),
(3, 'off the wall', 'Gourmet', 'just so so', '1/12/2013', 1, 1, 'Really cheap'),
(4, 'off the wall', 'test', 'cheap', '2013/12/9', 2, 2, 'not bad'),
(5, 'off the wall', 'test user', 'good', '12/8/2013', 2, 2, 'blah blah'),
(6, 'Rice Shop', 'test', '', '2013/12/10', 2, 1, ''),
(7, 'fangzhou1', 'fangzhou1', 'Dr', '2013/12/11', 4, 2, '123'),
(8, 'fangzhou1', 'fangzhou1', '', '2013/12/11', 3, 4, ''),
(9, 'fangzhou1', 'Bob', 'tes''ting', '2013/12/11', 1, 1, 'alert("test");test'),
(10, 'fangzhou15', 'fangzhou3', 'Dr', '2013/12/11', 3, 2, 'Very good'),
(11, 'fangzhou15', 'gaogao', 'Gaogao', '2013/12/11', 5, 5, 'Gaogao');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
