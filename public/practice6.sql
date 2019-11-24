/*
Navicat MySQL Data Transfer

Source Server         : wang
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : practice6

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-11-24 19:38:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_id` int(10) DEFAULT NULL,
  `receive_id` int(10) DEFAULT NULL,
  `message` text,
  `addtime` datetime DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '3', '6', '3333', '2019-11-24 15:19:43', '1', '333');
INSERT INTO `message` VALUES ('2', '3', '4', 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '2019-11-24 09:29:47', '1', null);
INSERT INTO `message` VALUES ('3', '3', '5', '666666666666666666', '2019-11-24 09:30:41', '1', null);
INSERT INTO `message` VALUES ('4', '12', '11', '666666666666666666666666666666666', '2019-11-24 09:35:28', '1', null);
INSERT INTO `message` VALUES ('5', '11', '12', '999999999999999', '2019-11-24 09:35:51', '1', null);
INSERT INTO `message` VALUES ('6', '13', '12', '6666666666666666666666666666666666666666', '2019-11-24 10:16:35', '1', null);
INSERT INTO `message` VALUES ('7', '13', '13', '8888888888888888886666666666666', '2019-11-24 10:16:52', '1', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `level` int(10) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'admin', '123456', '1', '2019-11-24 18:01:02');
INSERT INTO `user` VALUES ('4', 'admin1111', '123', '2', '2019-11-24 18:01:04');
INSERT INTO `user` VALUES ('5', 'admin2', '123456', '2', '2019-11-24 18:01:07');
INSERT INTO `user` VALUES ('6', 'admin3', '123456', '2', '2019-11-24 18:01:10');
INSERT INTO `user` VALUES ('7', 'admin4', '123456', '2', '2019-11-24 18:01:15');
INSERT INTO `user` VALUES ('8', 'admin5', '123456', '2', '2019-11-24 18:01:17');
INSERT INTO `user` VALUES ('9', 'admin6', '123456', '2', '2019-11-24 18:01:21');
INSERT INTO `user` VALUES ('10', 'admin7', '123456', '2', '2019-11-24 18:01:23');
INSERT INTO `user` VALUES ('11', 'pu1', '123456', '3', '2019-11-24 18:09:14');
INSERT INTO `user` VALUES ('12', 'pu2', '123456', '3', '2019-11-24 18:09:18');
INSERT INTO `user` VALUES ('13', 'ceshi1', '123456', '3', '2019-11-24 10:15:20');
INSERT INTO `user` VALUES ('14', 'ceshi3', '123456', '2', '2019-11-24 11:36:15');
