# Host: localhost  (Version 5.7.24)
# Date: 2021-10-14 15:00:15
# Generator: MySQL-Front 6.0  (Build 3.0)


#
# Structure for table "valuation"
#

DROP TABLE IF EXISTS `valuation`;
CREATE TABLE `valuation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktiva_id` int(11) DEFAULT NULL,
  `level1` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Data for table "valuation"
#

/*!40000 ALTER TABLE `valuation` DISABLE KEYS */;
INSERT INTO `valuation` VALUES (1,200,'1'),(2,201,'4'),(3,202,'3');
/*!40000 ALTER TABLE `valuation` ENABLE KEYS */;
