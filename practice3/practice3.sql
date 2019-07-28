/*
Navicat MySQL Data Transfer

Source Server         : wang
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : practice3

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-07-28 22:28:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_name` varchar(255) DEFAULT NULL,
  `userId` int(10) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` int(10) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sale
-- ----------------------------
INSERT INTO `sale` VALUES ('1', '启灵科技', '18', '200.00', '3', '600.00', '1');
INSERT INTO `sale` VALUES ('2', '启灵科技', '24', '200.00', '2', '400.00', '2');
INSERT INTO `sale` VALUES ('3', '启灵科技', '24', '200.00', '3', '600.00', '2');
INSERT INTO `sale` VALUES ('4', '启灵科技', '25', '200.00', '2', '400.00', '2');
INSERT INTO `sale` VALUES ('5', '启灵科技', '26', '200.00', '1', '200.00', '2');
INSERT INTO `sale` VALUES ('6', '启灵科技', '27', '200.00', '2', '400.00', '2');
INSERT INTO `sale` VALUES ('7', '启灵科技', '18', '150.00', '3', '450.00', '2');
INSERT INTO `sale` VALUES ('8', '启灵科技', '29', '200.00', '2', '400.00', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `parent` int(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('18', 'admin', '123456', '0', '董事');
INSERT INTO `user` VALUES ('19', '张三', '123456', '0', null);
INSERT INTO `user` VALUES ('20', '李四', '123456', '19', null);
INSERT INTO `user` VALUES ('21', '王五', null, '19', null);
INSERT INTO `user` VALUES ('22', '侯七', null, '21', null);
INSERT INTO `user` VALUES ('23', '赵八', null, '0', null);
INSERT INTO `user` VALUES ('24', 'chengxu', null, '18', '总裁');
INSERT INTO `user` VALUES ('25', 'chengxu2', null, '24', '联合创始人');
INSERT INTO `user` VALUES ('26', 'chengxu3', null, '24', '联合创始人');
INSERT INTO `user` VALUES ('27', 'chengxu4', null, '26', '合伙人');
INSERT INTO `user` VALUES ('28', 'chengxu5', null, '18', '总裁');
INSERT INTO `user` VALUES ('29', 'wang', '123456', '0', null);

-- ----------------------------
-- Table structure for user2
-- ----------------------------
DROP TABLE IF EXISTS `user2`;
CREATE TABLE `user2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `parent` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user2
-- ----------------------------
INSERT INTO `user2` VALUES ('1', '公司', '', '0');
INSERT INTO `user2` VALUES ('2', '大秦', '', '1');
INSERT INTO `user2` VALUES ('3', '太仓', '', '1');
INSERT INTO `user2` VALUES ('4', '长春', '', '1');
INSERT INTO `user2` VALUES ('5', '刘珍珍', '', '2');
INSERT INTO `user2` VALUES ('8', 'wang', '123456', null);
INSERT INTO `user2` VALUES ('6', '孙书赢', null, '2');
INSERT INTO `user2` VALUES ('9', '李欣', null, '2');
INSERT INTO `user2` VALUES ('7', '姚兰', null, '2');
INSERT INTO `user2` VALUES ('10', '李淑珍', null, '3');
INSERT INTO `user2` VALUES ('11', '耿志英', null, '3');
INSERT INTO `user2` VALUES ('12', '郑好', null, '3');
INSERT INTO `user2` VALUES ('13', '将丽霞', null, '4');
INSERT INTO `user2` VALUES ('14', '王淑仪', null, '4');
INSERT INTO `user2` VALUES ('15', '郑水宇', null, '5');
INSERT INTO `user2` VALUES ('16', '胡华英', null, '6');
INSERT INTO `user2` VALUES ('17', '贾玲', null, '6');
