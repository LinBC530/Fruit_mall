-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-07 20:31:06
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shoppingdb`
--

DELIMITER $$
--
-- 程序
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `browse_products` (IN `input` VARCHAR(20))  BEGIN
SELECT pImage,pName,pIntroduce,pPrice,pQuantity FROM products WHERE pID = input;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sales_ranking` ()  BEGIN
SELECT pID,pImage,pName,pPrice FROM products ORDER BY pSales_volume DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search` (IN `input` VARCHAR(20))  BEGIN

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(20) NOT NULL,
  `userID` varchar(20) NOT NULL,
  `Order_Item_ID` varchar(20) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `orders_item`
--

CREATE TABLE `orders_item` (
  `orderID` varchar(20) NOT NULL,
  `productsID` varchar(20) NOT NULL,
  `productsNumber` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `pID` varchar(20) NOT NULL,
  `pType` varchar(5) NOT NULL,
  `pName` varchar(30) NOT NULL,
  `pPrice` int(10) NOT NULL,
  `pQuantity` int(20) NOT NULL,
  `pImage` varchar(100) NOT NULL,
  `pIntroduce` varchar(100) NOT NULL,
  `pSales_volume` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`pID`, `pType`, `pName`, `pPrice`, `pQuantity`, `pImage`, `pIntroduce`, `pSales_volume`) VALUES
('1', '1', '可口可樂-易開罐330ml', 35, 10, '../images/可口可樂.jpg', '經典易開罐，勁享休閒時刻\r\n擋不住的暢快口感\r\n勁享美食，就要Coke', 60),
('2', '1', '麥香紅茶 300ml', 15, 5, '../images/麥香紅茶.jpg', '熟悉的麥香，最對味\r\n獨特的大麥香味，讓人回味無窮\r\n另有【麥香奶茶】、【麥香綠茶】', 100);

-- --------------------------------------------------------

--
-- 資料表結構 `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `userID` varchar(20) NOT NULL,
  `productsID` varchar(20) NOT NULL,
  `productsNumber` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `ID` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
