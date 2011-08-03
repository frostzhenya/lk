/*
MySQL Data Transfer
Source Host: localhost
Source Database: lk
Target Host: localhost
Target Database: lk
Date: 04.08.2011 1:32:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `date` text NOT NULL,
  `news` text NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `news` VALUES ('05-06-2011 [21:16:44]', 'lkfusion v 1.6.01 from LovePSone 2010-2011 успешно установлен!', '61');
