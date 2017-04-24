/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : clarocity

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-04-24 07:39:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for properties
-- ----------------------------
DROP TABLE IF EXISTS `properties`;
CREATE TABLE `properties` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of properties
-- ----------------------------
INSERT INTO `properties` VALUES ('1', '123 Main Street Edited', 'San Diego', 'CA', '92102');
INSERT INTO `properties` VALUES ('2', '456 Front Street', 'San Diego', 'CA', '92102');
INSERT INTO `properties` VALUES ('3', '4975 Del Monte Ave.', 'Ocean Beach', 'CA', '92107');
INSERT INTO `properties` VALUES ('4', '876 Another Address', 'San Diego', 'CA', '92108');
INSERT INTO `properties` VALUES ('5', '999 Fake Ave.', 'Santa Cruz', 'CA', '94567');
INSERT INTO `properties` VALUES ('7', '23423 sdfsdf ', 'asdas', 'CT', '45678');
INSERT INTO `properties` VALUES ('8', '123 more addr', 'sd', 'CA', '99999');

-- ----------------------------
-- Table structure for properties_sales
-- ----------------------------
DROP TABLE IF EXISTS `properties_sales`;
CREATE TABLE `properties_sales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `property_id` int(10) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of properties_sales
-- ----------------------------
INSERT INTO `properties_sales` VALUES ('1', '1', '2017-04-01', '500000.00');
INSERT INTO `properties_sales` VALUES ('2', '1', '2017-04-03', '700000.00');
INSERT INTO `properties_sales` VALUES ('3', '2', '2017-04-02', '600000.00');
INSERT INTO `properties_sales` VALUES ('4', '3', '2017-04-04', '500000.00');
INSERT INTO `properties_sales` VALUES ('5', '3', '2017-04-07', '650000.00');
INSERT INTO `properties_sales` VALUES ('6', '3', '2017-04-10', '750000.00');
