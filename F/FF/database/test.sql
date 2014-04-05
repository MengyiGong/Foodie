-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013-12-10 01:26:05
-- 服务器版本: 5.6.13-log
-- PHP 版本: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Busi_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Busi_Picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `business`
--

INSERT INTO `business` (`id`, `Busi_Name`, `Busi_Username`, `Busi_Password`, `Busi_Phone`, `Busi_Email`, `Busi_Picture`, `Busi_Categories`, `Busi_City`, `Busi_Address`, `Busi_Rating`, `Busi_Price`, `Busi_OpenTime`, `Busi_Description`, `Busi_Status`) VALUES
(53, 'off the wall', 'test', 'test', '201-123-4567', '123@foodie.com', 'img/offthewall.png', 'chinese', 'Hoboken', '512 Washington St', 1, 1, '9:00am-11:00pm', 'blah blah', 'Approve'),
(54, 'Illuzion', 'test1', 'test1', '201-456-7890', '456@foodie.com', 'img/llluzion.png', 'japanese', 'Jersry City', '337 Washington St', 5, 5, '11:00am-11:00pm', 'sushi bar', 'Approve'),
(55, 'Rice Shop', 'test2', 'test2', '(201) 798-8382', '789@foodie.com', 'img/rice shop.png', 'chinese', 'hoboken', '304 Washington St', 3, 3, '11 am - 10:45 pm', ' Asian Fusion ', 'Approve'),
(56, 'Ayame', 'test3', 'test3', '(201) 222-8148', '3242934@foodie.com', 'img/ayame.png', 'japanese', 'Hoboken', '526 Washington St', 3, 3, '11 am - 11 pm', 'Hibachi and Sushi', 'Approve'),
(57, 'Yeung II', 'test4', 'test4', '123-456-7890', 'temp@foodie.com', 'img/yeung 2.png', 'chinese', 'Hoboken', '1120 Washington St', 4, 4, '11:30 am - 11 pm', 'also serve japanese food', 'Approved');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_user` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Customer_picture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_account` (`Customer_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `Customer_user`, `Customer_password`, `Customer_email`, `Customer_picture`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'sds@12.com', NULL),
(2, 'xydoor', 'e10adc3949ba59abbe56e057f20f883e', 'xydoor@163.com', NULL),
(3, 'xinyonghu', 'e10adc3949ba59abbe56e057f20f883e', 'xinyonghu@163.com', NULL),
(4, 'dasdasda', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL),
(6, 'dasdasdadsad', '202cb962ac59075b964b07152d234b70', '', NULL),
(9, '22', '202cb962ac59075b964b07152d234b70', '', NULL),
(10, '21dsad', '202cb962ac59075b964b07152d234b70', '', NULL),
(11, 'adminadmin', '21232f297a57a5a743894a0e4a801fc3', '', NULL),
(12, 'yijunxiao', '511d8884c19bc4b22adeee75d1bba62b', '', NULL),
(13, 'adminadminadmin', '21232f297a57a5a743894a0e4a801fc3', '', NULL),
(14, 'yyyyyy', 'c5777c091df772ff2b2dffcb43d9794c', 'dsad@123.com', NULL),
(15, '21dsad23', '4297f44b13955235245b2497399d7a93', 'dsad@123.com', NULL),
(16, 'nba', '8046e7762e34fc889c46e95b5036befc', 'nba@nba.com', NULL),
(17, 'OKC', '9ae6bf16d33e7643292e93a89f12c4bc', 'OKC@OKC.com', NULL),
(18, 'cover', '41d0e299ca1abeb2094852da042165c7', 'cover@cover.com', NULL),
(19, 'Coverpage', '39c8e9fba6e14b0b6ad2d5bcd16e8bfa', 'Coverpage@Coverpage.com', NULL),
(20, 'customer', '91ec1f9324753048c0096d036a694f86', 'customer@customer.com', NULL),
(21, 'Stevens', 'd83891c31f08f2dbbd6e9adac9e90f97', 'Stevens@Stevens.com', NULL),
(22, 'StevensStevens', 'e8c6796b059337595a88e71d9dab90e6', 'StevensStevens@StevensStevens.com', NULL),
(24, 'StevensS', '4297f44b13955235245b2497399d7a93', 'StevensS@StevensS.com', NULL),
(25, 'youarehere', '62ee25ba9eba3ed2b071b06a7a4fc1e9', 'youarehere@youarehere.com', NULL),
(26, 'mba', '91e112b7220af68fcf5be09ee837f7a7', 'mba@mba.com', NULL),
(27, '12345', '827ccb0eea8a706c4c34a16891f84e7b', '12345@12345.com', NULL),
(28, 'newnew', 'e3b81d385ca4c26109dfbda28c563e2b', 'newnew@newnew.com', NULL),
(29, '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456@123456.com', NULL),
(30, '1234567', 'fcea920f7412b5da7be0cf42b8c93759', '1234567@1234567.com', NULL),
(31, '12345678', '25d55ad283aa400af464c76d713c07ad', '12345678@12345678.com', NULL),
(32, '123456789', '25f9e794323b453885f5181f1b624d0b', '123456@123456.com', NULL),
(33, 'opentime', '66107add21a7a3947a11d8cd064efef6', 'opentime@opentime.com', NULL),
(34, 'Open2', '80a09d20e2c04c309d05e051a4a9d5dd', 'Open2@Open2.com', NULL),
(35, 'Open3', 'a03ea4fd2c852424d96a77b863bfb49d', 'Open3@Open3.com', NULL),
(36, 'coverpage2', '07b80a9f32f5895475f703728d6ae102', 'coverpage2@coverpage2.com', 'photos_customer/you are here.png'),
(37, 'coverpage23', '17c8c9dcb22386436c95aa6dd3ce0653', 'coverpage23@coverpage23.com', NULL),
(38, 'coverpage123', '9b8bcd8a049e4a40b0bf0ea9fe43a822', 'coverpage123@coverpage123.com', NULL),
(39, 'coverpage1234', 'f6b970cbcd1c252916fa83aae1f61532', 'lifelovergx@gmail.com', NULL),
(40, 'StevensSt', 'fcd7ce786ce243357616e2402c867787', 'StevensSt@StevensSt.com', NULL),
(41, 'Open34', 'c36051766888f23198af6225a9f90210', 'Open34@Open34.com', NULL),
(45, 'Open345', '0a82dd092961db36a6d0afa591070433', 'Open345@Open345.com', NULL),
(46, 'Open3456', '0e5a25ef1895b2ea78c14d87084f2e9f', 'Open3456@Open3456.com', NULL),
(47, 'Open34566', '0ffaeade4a7a621cef82dce9fd9c3b3b', 'Open34566@Open34566.com', 'photos_customer/you are here.png'),
(48, 'Open345667', '8c389ce3009d680a5242277d05740c66', 'Open345667@Open345667.com', NULL),
(49, '123ttt', '16b2e8fa5fc4ec04e6ab61fc0d64df87', '123ttt@123ttt.com', NULL),
(50, '123tttt', '3cc1cd3e7984ef9642dc289aad7802b5', '123tttt@123tttt.com', 'photos_customer/you are here.png');

-- --------------------------------------------------------

--
-- 表的结构 `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `Busi_Name` varchar(50) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Revi_Title` varchar(100) DEFAULT NULL,
  `Revi_Publish_Time` varchar(30) NOT NULL,
  `Revi_Rating` int(2) NOT NULL,
  `Revi_Price` int(2) NOT NULL,
  `Revi_Comment` text,
  PRIMARY KEY (`Busi_Name`,`User_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `review`
--

INSERT INTO `review` (`Busi_Name`, `User_Name`, `Revi_Title`, `Revi_Publish_Time`, `Revi_Rating`, `Revi_Price`, `Revi_Comment`) VALUES
('Illuzion', 'test', 'really good', '2013/12/9', 4, 4, 'tasty'),
('off the wall', 'Gourmet', 'just so so', '1/12/2013', 1, 1, 'Really cheap'),
('off the wall', 'test', 'cheap', '2013/12/9', 2, 2, 'not bad'),
('off the wall', 'test user', 'good', '12/8/2013', 2, 2, 'blah blah'),
('Rice Shop', 'test', '', '2013/12/10', 2, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
