SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `email` varchar(100) NOT NULL,
  `firstName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `lastName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of administrator
-- ----------------------------
INSERT INTO `administrator` VALUES ('karasho62@gmail.com', 'Karas', 'Ho', '60255986');

-- ----------------------------
-- Table structure for dealer
-- ----------------------------
DROP TABLE IF EXISTS `dealer`;
CREATE TABLE `dealer` (
  `dealerID` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phoneNumber` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`dealerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dealer
-- ----------------------------
INSERT INTO `dealer` VALUES ('ID1', '123456', '经销商1', '12345643212', '北京市新华区');

-- ----------------------------
-- Table structure for orderpart
-- ----------------------------
DROP TABLE IF EXISTS `orderpart`;
CREATE TABLE `orderpart` (
  `orderID` int(11) NOT NULL,
  `partNumber` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  KEY `FKOrderPart106296` (`orderID`),
  KEY `FKOrderPart737123` (`partNumber`),
  CONSTRAINT `FKOrderPart106296` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  CONSTRAINT `FKOrderPart737123` FOREIGN KEY (`partNumber`) REFERENCES `part` (`partNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orderpart
-- ----------------------------
INSERT INTO `orderpart` VALUES ('1', '1', '8', '10.00');
INSERT INTO `orderpart` VALUES ('2', '1', '20', '10.00');
INSERT INTO `orderpart` VALUES ('4', '1', '2', '10.00');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `dealerID` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryAddress` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `FKOrders795865` (`dealerID`),
  CONSTRAINT `FKOrders795865` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', 'ID1', '2019-07-03', '北京市新华区', '2');
INSERT INTO `orders` VALUES ('2', 'ID1', '2019-07-03', '北京市新华区', '1');
INSERT INTO `orders` VALUES ('4', 'ID1', '2019-07-03', '北京市新华区', '1');

-- ----------------------------
-- Table structure for part
-- ----------------------------
DROP TABLE IF EXISTS `part`;
CREATE TABLE `part` (
  `partNumber` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `partName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `stockPrice` decimal(10,2) NOT NULL,
  `stockStatus` int(1) NOT NULL,
  PRIMARY KEY (`partNumber`),
  UNIQUE KEY `partName` (`partName`),
  KEY `FKPart451022` (`email`),
  CONSTRAINT `FKPart451022` FOREIGN KEY (`email`) REFERENCES `administrator` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of part
-- ----------------------------
INSERT INTO `part` VALUES ('1', 'karasho62@gmail.com', '零件1', '2', '10.00', '1');
