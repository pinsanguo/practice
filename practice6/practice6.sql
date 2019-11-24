/*
Navicat MySQL Data Transfer

Source Server         : wang
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : practice6

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-11-24 19:46:05
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '1', '1', '测试', '2019-11-24 19:40:32', '1', '测试');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '123456', '1', '2019-11-24 19:40:16');
