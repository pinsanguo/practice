/*
Navicat MySQL Data Transfer

Source Server         : wang
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-28 22:35:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rechTime` datetime DEFAULT NULL,
  `rechNote` varchar(255) DEFAULT NULL,
  `rechAccount` varchar(100) DEFAULT NULL,
  `rechBenJin` varchar(100) DEFAULT NULL,
  `rechBlance` varchar(100) DEFAULT NULL,
  `userId` int(10) DEFAULT NULL,
  `rechBank` varchar(100) DEFAULT NULL,
  `rechOrderNo` varchar(100) DEFAULT NULL,
  `rechBankNo` varchar(100) DEFAULT NULL,
  `rechBankName` varchar(100) DEFAULT NULL,
  `rechBankMoney` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `rechType` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account
-- ----------------------------
INSERT INTO `account` VALUES ('1', '2019-07-25 11:09:30', '充值账户，充值编号：852654', '1.00', '+1520.00', '1521.00', '1', null, null, null, null, null, null, 'add');
INSERT INTO `account` VALUES ('2', '2019-07-23 11:10:57', '支付任务本金，编号：123963', '522.00', '-521.00', '1.00', '1', null, null, null, null, null, null, 'reduce');
INSERT INTO `account` VALUES ('3', '2019-07-27 11:12:26', '邀请奖励', '22.00', '+500.00', '522.00', '1', null, null, null, null, null, null, 'add');
INSERT INTO `account` VALUES ('4', '2019-07-27 11:42:41', null, null, '10', null, '1', '招商银行', '1111', '2222222', '33333333', '444444444', '1', 'add');

-- ----------------------------
-- Table structure for shopmanage
-- ----------------------------
DROP TABLE IF EXISTS `shopmanage`;
CREATE TABLE `shopmanage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopType` varchar(100) DEFAULT NULL,
  `shopName` varchar(100) DEFAULT NULL,
  `shopLink` varchar(100) DEFAULT NULL,
  `shopWang` varchar(100) DEFAULT NULL,
  `shopPhone` varchar(100) DEFAULT NULL,
  `shopQQ` varchar(100) DEFAULT NULL,
  `userId` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopmanage
-- ----------------------------
INSERT INTO `shopmanage` VALUES ('1', '淘宝', '波舒品质', 'https://shukewen.taobao.com/index.htm?spm=2013.1.w5002-21471472963.2.7a3f315evfgEC2', '江文大少爷', '1300369550', '575775218', '1');
INSERT INTO `shopmanage` VALUES ('2', '天猫', '浪莎宏悦专卖店', 'https://langshahy.tmall.com/?spm=a1z10.1-b.1997427721.d4918089.60c76b26M8RTA5', '浪莎宏悦专卖店', '13888888888', '3242341234', '1');
INSERT INTO `shopmanage` VALUES ('3', '淘宝', '店铺名称88888', 'qweqweqwr', 'qewweqrqwer', 'wqreqw', 'qwrqwreqwrqwe', '1');
INSERT INTO `shopmanage` VALUES ('4', '天猫', '店铺名称', '231423', '1243231', '21323141', '243123412', '1');

-- ----------------------------
-- Table structure for tast
-- ----------------------------
DROP TABLE IF EXISTS `tast`;
CREATE TABLE `tast` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) DEFAULT NULL,
  `addTime` datetime DEFAULT NULL,
  `step1_saleName` varchar(100) DEFAULT NULL,
  `step1_saleLink` varchar(100) DEFAULT NULL,
  `step1_upload_img` varchar(100) DEFAULT NULL,
  `step1_option` varchar(100) DEFAULT NULL,
  `step1_amount_money` varchar(100) DEFAULT NULL,
  `step1_single_num` varchar(100) DEFAULT NULL,
  `step1_single_money` varchar(100) DEFAULT NULL,
  `step1_phone_money` varchar(100) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `step2_sort` varchar(100) DEFAULT NULL,
  `step2_people_num` varchar(100) DEFAULT NULL,
  `step3_type` varchar(100) DEFAULT NULL,
  `step4_limit` varchar(100) DEFAULT NULL,
  `step5_name1` varchar(100) DEFAULT NULL,
  `step5_pass1` varchar(100) DEFAULT NULL,
  `step5_link1` varchar(100) DEFAULT NULL,
  `step5_name2` varchar(100) DEFAULT NULL,
  `step5_pass2` varchar(100) DEFAULT NULL,
  `step5_link2` varchar(100) DEFAULT NULL,
  `step5_name3` varchar(100) DEFAULT NULL,
  `step5_pass3` varchar(100) DEFAULT NULL,
  `step5_link3` varchar(100) DEFAULT NULL,
  `step6_note` varchar(100) DEFAULT NULL,
  `step2_price_min` varchar(100) DEFAULT NULL,
  `step2_price_max` varchar(100) DEFAULT NULL,
  `step2_note` varchar(100) DEFAULT NULL,
  `step3_keywords` varchar(225) DEFAULT NULL,
  `step3_num` varchar(225) DEFAULT NULL,
  `step3_words_num` varchar(100) DEFAULT NULL,
  `step3_words_con` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tast
-- ----------------------------
INSERT INTO `tast` VALUES ('1', '1', '2019-07-27 14:53:11', '777', '666', '/public/uploads/image/20190727173759_2970.png', '11', '444', '555', '666', '777', '1', '综合', '11', '2', '', '', '', '', '', '', '', '', '', '', '', '11', '22', '3333', '', '', '2', '[\"\"]');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'wang', '123456');
INSERT INTO `user` VALUES ('2', '18838063951', '123456');
INSERT INTO `user` VALUES ('4', '18838063952', '123456');
INSERT INTO `user` VALUES ('5', '18838063953', '123456');
