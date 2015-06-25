#
# SQL Export
# Created by Querious (980)
# Created: 25 June 2015 09:52:30 BST
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `account`;


CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(128) DEFAULT NULL,
  `elucidat_customer_code` varchar(128) DEFAULT NULL,
  `elucidat_public_key` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT '0',
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `has_elucidat_access` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `account` WRITE;
ALTER TABLE `account` DISABLE KEYS;
INSERT INTO `account` (`id`, `company_name`, `elucidat_customer_code`, `elucidat_public_key`) VALUES 
	(1,'Ian Budden inc.',NULL,NULL);
ALTER TABLE `account` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `user` WRITE;
ALTER TABLE `user` DISABLE KEYS;
INSERT INTO `user` (`id`, `account_id`, `first_name`, `last_name`, `email`, `has_elucidat_access`) VALUES 
	(1,1,'Ian','Budden','ian+5@ianbudden.com',0),
	(2,1,'Ian2','B2','ian',0),
	(3,1,'Ian','Budden','ian+6@ianbudden.com',0);
ALTER TABLE `user` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


