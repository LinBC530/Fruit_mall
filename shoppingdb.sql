-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-01-02 16:33:42
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_shappingCarItem` (IN `input1` INT(10), IN `input2` INT(10))  BEGIN
DELETE FROM `shopping_cart` WHERE userID=input1 AND productsID=input2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_orders` (IN `input1` INT(10), IN `input2` VARCHAR(10), IN `input3` VARCHAR(10), IN `input4` VARCHAR(10), IN `input5` VARCHAR(10), IN `input6` VARCHAR(10))  BEGIN
DECLARE item INT(10);
DECLARE q INT(10);
INSERT INTO `orders`(`userID`, `name`, `phone`, `county`, `area`, `house_number`) VALUES (input1,input2,input3,input4,input5,input6);
SELECT LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_orders_item` (IN `input1` INT(10), IN `input2` INT(10), IN `input3` INT(10), IN `input4` INT(10), IN `input5` INT(10))  BEGIN
DECLARE pQ INT(10);
DECLARE pS INT(10);

INSERT INTO `orders_item`(`order_item_ID`,`userID`, `productsID`, `productsNumber`, `price`) VALUES (input1,input2,input3,input4,input5);

SELECT pQuantity,pSales_volume FROM products WHERE pID = input3 INTO pQ,pS;
SET pQ = (pQ-input4);
SET pS = (pS+input4);

UPDATE `products` SET `pQuantity`=pQ,`pSales_volume`=pS WHERE pID=input3;

DELETE FROM `shopping_cart` WHERE `userID`=input2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_shappingCar` (IN `input1` VARCHAR(10), IN `input2` VARCHAR(10), IN `input3` VARCHAR(10))  BEGIN
DECLARE num INT(10);
IF (SELECT productsID FROM shopping_cart WHERE userID=input1 AND productsID=input2) THEN
    SELECT productsNumber FROM shopping_cart WHERE userID=input1 AND productsID=input2 INTO num;
	UPDATE `shopping_cart` SET `productsNumber`=(num+input3) WHERE userID=input1 AND productsID=input2;
ELSE
	INSERT INTO `shopping_cart`(userID, productsID, productsNumber) VALUES (input1,input2,input3);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user` (IN `input1` VARCHAR(10), IN `input2` VARCHAR(10), IN `input3` VARCHAR(10), IN `input4` VARCHAR(10))  BEGIN
IF input3 = input4 THEN
	INSERT INTO user(uName, uPhoneNumber, uPassword) VALUES (input1,input2,input3);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sales_ranking` ()  BEGIN
SELECT pID,pImage,pName,pPrice FROM products ORDER BY pSales_volume DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search` (IN `input` VARCHAR(20))  BEGIN
SELECT pImage,pName,pIntroduce,pPrice,pQuantity,pID FROM products WHERE pName LIKE CONCAT('%', input, '%') OR pType = input;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_order` (IN `input1` INT(10))  BEGIN
SELECT `orderID`, `userID`, `name`, `phone`, `county`, `area`, `house_number`, `state` FROM `orders` WHERE userID=input1 ORDER BY date DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_orders_item` (IN `input1` INT)  BEGIN
SELECT pName,productsNumber,price,(price*productsNumber) FROM orders_item,products WHERE products.pID=orders_item.productsID AND orders_item.order_item_ID=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_order_priceSum` (IN `input1` INT(10))  BEGIN
SELECT SUM(price*productsNumber) FROM orders_item WHERE order_item_ID=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_shappingCar` (IN `input1` INT(10))  BEGIN
DECLARE price_sum INT(10);
SELECT SUM(pPrice*productsNumber) FROM shopping_cart INNER JOIN products ON shopping_cart.productsID=products.pID WHERE userID=input1 INTO price_sum;

SELECT pName,productsNumber,pPrice,(pPrice*productsNumber),pQuantity, productsID,price_sum FROM shopping_cart INNER JOIN products ON shopping_cart.productsID=products.pID WHERE userID=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_shappingCarNum` (IN `input1` VARCHAR(20))  BEGIN
SELECT COUNT(userID) FROM `shopping_cart` WHERE userID=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_user` (IN `input1` VARCHAR(10), IN `input2` VARCHAR(10))  BEGIN
SELECT `uID`,`uName` FROM `user` WHERE `uPhoneNumber`=input1 AND `uPassword`=input2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_user_account` (IN `input1` INT)  BEGIN
SELECT uName,uPhoneNumber FROM user WHERE uID=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_user_phone` (IN `input1` INT)  BEGIN
SELECT `uID`,`uName` FROM `user` WHERE `uPhoneNumber`=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_order_Cancel` (IN `input1` VARCHAR(5))  BEGIN
UPDATE `orders` SET `state`="已取消" WHERE `orderID`=input1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_userAccount` (IN `input1` VARCHAR(10), IN `input2` VARCHAR(10), IN `input3` VARCHAR(10))  BEGIN
IF (SELECT uID FROM user WHERE uID=input1 and uPassword=input2) THEN 
	UPDATE `user` SET `uPassword`=input3 WHERE uID=input1;
ELSE
	SELECT "incompatible";
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_userName` (IN `input1` VARCHAR(10), IN `input2` INT(10))  BEGIN
UPDATE `user` SET `uName`=input1 WHERE uID=input2;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `orderID` int(20) NOT NULL,
  `userID` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `county` varchar(10) NOT NULL,
  `area` varchar(10) NOT NULL,
  `house_number` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` varchar(10) NOT NULL DEFAULT '待處理'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `orders_item`
--

CREATE TABLE `orders_item` (
  `order_item_ID` int(20) NOT NULL,
  `userID` int(10) NOT NULL,
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
  `pType` varchar(15) NOT NULL,
  `pName` varchar(20) NOT NULL,
  `pPrice` int(10) NOT NULL,
  `pQuantity` int(10) NOT NULL,
  `pImage` varchar(100) NOT NULL,
  `pIntroduce` varchar(100) NOT NULL,
  `pSales_volume` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`pID`, `pType`, `pName`, `pPrice`, `pQuantity`, `pImage`, `pIntroduce`, `pSales_volume`) VALUES
('1', 'pome_fruit', '本土蘋果 6入', 300, 30, '../images/本土蘋果.jpg', '果皮紅中帶點青黃，果肉緊實脆度剛好，用於烘培、榨果汁，或是做成沙拉都很適合', 17),
('10', 'melon', '哈密瓜禮盒 1入', 1500, 19, '../images/哈密瓜.jpg', '味道甜美、風味獨特', 11),
('11', 'drupe', '李子 1盒', 100, 30, '../images/李子.jpg', '飽滿多汁，甜中帶酸的滋味令人難以抗拒', 5),
('12', 'drupe', '荔枝', 200, 30, '../images/荔枝.jpg', '肉質細緻，脆爽而清甜，微香稍澀', 20),
('13', 'drupe', '水蜜桃 1盒 4入', 350, 20, '../images/水蜜桃.jpg', '果實碩大、甜美多汁', 10),
('2', 'pome_fruit', '進口蘋果 6入', 500, 40, '../images/進口蘋果.jpg', '果皮紅中帶點青黃，果肉緊實脆度剛好，用於烘培、榨果汁，或是做成沙拉都很適合', 4),
('3', 'berry', '香蕉 2串', 100, 20, '../images/香蕉.jpg', '幾乎含有所有的維生素和礦物質，可降低腸道的壞菌，增加腸道好菌', 14),
('4', 'tangerine', '進口橘子 6入', 240, 26, '../images/橘子.jpg', '酸中帶甜、肉質柔軟多汁，富含豐富營養成分如維生素A、C、B群，與礦物質如鈉、鉀、鎂、鋅…等，成熟的金黃果實處處飄散果香', 9),
('5', 'berry', '進口櫻桃 3盒入', 1000, 25, '../images/櫻桃.jpg', '口感甜中帶微酸、果肉滋味純美', 25),
('6', 'tangerine', '柚子 6入', 350, 20, '../images/柚子.jpg', '淡淡的柑橘香味。 味道酸甜，富含有豐富維生素、有機酸與礦物質', 7),
('7', 'berry', '葡萄 三串', 500, 31, '..//images/葡萄.jpg', '碩大多汁，香甜，多酚、類黃酮、花青素等抗氧化成分', 29),
('8', 'melon', '西瓜禮盒 1入', 600, 20, '../images/西瓜.jpg', '味道甘甜多汁，清爽解渴，且富含的鉀元素，對血壓控制和心臟健康有幫助', 10),
('9', 'melon', '木瓜 3入', 350, 20, '../images/木瓜.jpg', '香氣濃郁、汁水豐多，甜美可口', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `userID` int(20) NOT NULL,
  `productsID` varchar(20) NOT NULL,
  `productsNumber` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `uID` int(20) NOT NULL,
  `uName` varchar(10) NOT NULL,
  `uPhoneNumber` varchar(10) NOT NULL,
  `uPassword` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`uID`, `uName`, `uPhoneNumber`, `uPassword`) VALUES
(14, '王小明', '0912345678', '123');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- 資料表索引 `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`order_item_ID`,`productsID`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pID`);

--
-- 資料表索引 `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`userID`,`productsID`),
  ADD KEY `productsID` (`productsID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uID`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `uID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 已傾印資料表的限制(constraint)
--

--
-- 資料表的限制(constraint) `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`productsID`) REFERENCES `products` (`pID`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`uID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
