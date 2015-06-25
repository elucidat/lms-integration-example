#
# SQL Export
# Created by Querious (980)
# Created: 25 June 2015 15:52:45 BST
# Encoding: Unicode (UTF-8)
#


DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `country`;
DROP TABLE IF EXISTS `account`;


CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(128) DEFAULT NULL,
  `company_email` varchar(128) DEFAULT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `telephone` varchar(128) DEFAULT NULL,
  `address1` varchar(128) DEFAULT NULL,
  `address2` varchar(128) DEFAULT NULL,
  `postcode` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `elucidat_customer_code` varchar(128) DEFAULT NULL,
  `elucidat_public_key` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `country` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `countryName` varchar(45) NOT NULL DEFAULT '',
  `prioritise` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `countryCode` (`countryCode`),
  KEY `prioritise` (`prioritise`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) DEFAULT '0',
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `has_elucidat_access` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;




SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `account` WRITE;
ALTER TABLE `account` DISABLE KEYS;
INSERT INTO `account` (`id`, `company_name`, `company_email`, `first_name`, `last_name`, `telephone`, `address1`, `address2`, `postcode`, `country`, `elucidat_customer_code`, `elucidat_public_key`) VALUES 
	(3,'Test co','ian+company@ianbudden.com','Ian','Budden','1234','Address 1','Address 2','SW1','GB','558c13bacc83f','8DA7F967-C646-FC92-6ED5-E7B9366545A4');
ALTER TABLE `account` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `country` WRITE;
ALTER TABLE `country` DISABLE KEYS;
INSERT INTO `country` (`id`, `countryCode`, `countryName`, `prioritise`) VALUES 
	(1,'AD','Andorra',0),
	(2,'AE','United Arab Emirates',0),
	(3,'AF','Afghanistan',0),
	(4,'AG','Antigua and Barbuda',0),
	(5,'AI','Anguilla',0),
	(6,'AL','Albania',0),
	(7,'AM','Armenia',0),
	(8,'AO','Angola',0),
	(9,'AQ','Antarctica',0),
	(10,'AR','Argentina',0),
	(11,'AS','American Samoa',0),
	(12,'AT','Austria',0),
	(13,'AU','Australia',0),
	(14,'AW','Aruba',0),
	(15,'AX','Åland',0),
	(16,'AZ','Azerbaijan',0),
	(17,'BA','Bosnia and Herzegovina',0),
	(18,'BB','Barbados',0),
	(19,'BD','Bangladesh',0),
	(20,'BE','Belgium',0),
	(21,'BF','Burkina Faso',0),
	(22,'BG','Bulgaria',0),
	(23,'BH','Bahrain',0),
	(24,'BI','Burundi',0),
	(25,'BJ','Benin',0),
	(26,'BL','Saint Barthélemy',0),
	(27,'BM','Bermuda',0),
	(28,'BN','Brunei',0),
	(29,'BO','Bolivia',0),
	(30,'BQ','Bonaire',0),
	(31,'BR','Brazil',0),
	(32,'BS','Bahamas',0),
	(33,'BT','Bhutan',0),
	(34,'BV','Bouvet Island',0),
	(35,'BW','Botswana',0),
	(36,'BY','Belarus',0),
	(37,'BZ','Belize',0),
	(38,'CA','Canada',0),
	(39,'CC','Cocos [Keeling] Islands',0),
	(40,'CD','Democratic Republic of the Congo',0),
	(41,'CF','Central African Republic',0),
	(42,'CG','Republic of the Congo',0),
	(43,'CH','Switzerland',0),
	(44,'CI','Ivory Coast',0),
	(45,'CK','Cook Islands',0),
	(46,'CL','Chile',0),
	(47,'CM','Cameroon',0),
	(48,'CN','China',0),
	(49,'CO','Colombia',0),
	(50,'CR','Costa Rica',0),
	(51,'CU','Cuba',0),
	(52,'CV','Cape Verde',0),
	(53,'CW','Curacao',0),
	(54,'CX','Christmas Island',0),
	(55,'CY','Cyprus',0),
	(56,'CZ','Czechia',0),
	(57,'DE','Germany',0),
	(58,'DJ','Djibouti',0),
	(59,'DK','Denmark',0),
	(60,'DM','Dominica',0),
	(61,'DO','Dominican Republic',0),
	(62,'DZ','Algeria',0),
	(63,'EC','Ecuador',0),
	(64,'EE','Estonia',0),
	(65,'EG','Egypt',0),
	(66,'EH','Western Sahara',0),
	(67,'ER','Eritrea',0),
	(68,'ES','Spain',0),
	(69,'ET','Ethiopia',0),
	(70,'FI','Finland',0),
	(71,'FJ','Fiji',0),
	(72,'FK','Falkland Islands',0),
	(73,'FM','Micronesia',0),
	(74,'FO','Faroe Islands',0),
	(75,'FR','France',0),
	(76,'GA','Gabon',0),
	(77,'GB','United Kingdom',1),
	(78,'GD','Grenada',0),
	(79,'GE','Georgia',0),
	(80,'GF','French Guiana',0),
	(81,'GG','Guernsey',0),
	(82,'GH','Ghana',0),
	(83,'GI','Gibraltar',0),
	(84,'GL','Greenland',0),
	(85,'GM','Gambia',0),
	(86,'GN','Guinea',0),
	(87,'GP','Guadeloupe',0),
	(88,'GQ','Equatorial Guinea',0),
	(89,'GR','Greece',0),
	(90,'GS','South Georgia and the South Sandwich Islands',0),
	(91,'GT','Guatemala',0),
	(92,'GU','Guam',0),
	(93,'GW','Guinea-Bissau',0),
	(94,'GY','Guyana',0),
	(95,'HK','Hong Kong',0),
	(96,'HM','Heard Island and McDonald Islands',0),
	(97,'HN','Honduras',0),
	(98,'HR','Croatia',0),
	(99,'HT','Haiti',0),
	(100,'HU','Hungary',0),
	(101,'ID','Indonesia',0),
	(102,'IE','Ireland',0),
	(103,'IL','Israel',0),
	(104,'IM','Isle of Man',0),
	(105,'IN','India',0),
	(106,'IO','British Indian Ocean Territory',0),
	(107,'IQ','Iraq',0),
	(108,'IR','Iran',0),
	(109,'IS','Iceland',0),
	(110,'IT','Italy',0),
	(111,'JE','Jersey',0),
	(112,'JM','Jamaica',0),
	(113,'JO','Jordan',0),
	(114,'JP','Japan',0),
	(115,'KE','Kenya',0),
	(116,'KG','Kyrgyzstan',0),
	(117,'KH','Cambodia',0),
	(118,'KI','Kiribati',0),
	(119,'KM','Comoros',0),
	(120,'KN','Saint Kitts and Nevis',0),
	(121,'KP','North Korea',0),
	(122,'KR','South Korea',0),
	(123,'KW','Kuwait',0),
	(124,'KY','Cayman Islands',0),
	(125,'KZ','Kazakhstan',0),
	(126,'LA','Laos',0),
	(127,'LB','Lebanon',0),
	(128,'LC','Saint Lucia',0),
	(129,'LI','Liechtenstein',0),
	(130,'LK','Sri Lanka',0),
	(131,'LR','Liberia',0),
	(132,'LS','Lesotho',0),
	(133,'LT','Lithuania',0),
	(134,'LU','Luxembourg',0),
	(135,'LV','Latvia',0),
	(136,'LY','Libya',0),
	(137,'MA','Morocco',0),
	(138,'MC','Monaco',0),
	(139,'MD','Moldova',0),
	(140,'ME','Montenegro',0),
	(141,'MF','Saint Martin',0),
	(142,'MG','Madagascar',0),
	(143,'MH','Marshall Islands',0),
	(144,'MK','Macedonia',0),
	(145,'ML','Mali',0),
	(146,'MM','Myanmar [Burma]',0),
	(147,'MN','Mongolia',0),
	(148,'MO','Macao',0),
	(149,'MP','Northern Mariana Islands',0),
	(150,'MQ','Martinique',0),
	(151,'MR','Mauritania',0),
	(152,'MS','Montserrat',0),
	(153,'MT','Malta',0),
	(154,'MU','Mauritius',0),
	(155,'MV','Maldives',0),
	(156,'MW','Malawi',0),
	(157,'MX','Mexico',0),
	(158,'MY','Malaysia',0),
	(159,'MZ','Mozambique',0),
	(160,'NA','Namibia',0),
	(161,'NC','New Caledonia',0),
	(162,'NE','Niger',0),
	(163,'NF','Norfolk Island',0),
	(164,'NG','Nigeria',0),
	(165,'NI','Nicaragua',0),
	(166,'NL','Netherlands',0),
	(167,'NO','Norway',0),
	(168,'NP','Nepal',0),
	(169,'NR','Nauru',0),
	(170,'NU','Niue',0),
	(171,'NZ','New Zealand',0),
	(172,'OM','Oman',0),
	(173,'PA','Panama',0),
	(174,'PE','Peru',0),
	(175,'PF','French Polynesia',0),
	(176,'PG','Papua New Guinea',0),
	(177,'PH','Philippines',0),
	(178,'PK','Pakistan',0),
	(179,'PL','Poland',0),
	(180,'PM','Saint Pierre and Miquelon',0),
	(181,'PN','Pitcairn Islands',0),
	(182,'PR','Puerto Rico',0),
	(183,'PS','Palestine',0),
	(184,'PT','Portugal',0),
	(185,'PW','Palau',0),
	(186,'PY','Paraguay',0),
	(187,'QA','Qatar',0),
	(188,'RE','Réunion',0),
	(189,'RO','Romania',0),
	(190,'RS','Serbia',0),
	(191,'RU','Russia',0),
	(192,'RW','Rwanda',0),
	(193,'SA','Saudi Arabia',0),
	(194,'SB','Solomon Islands',0),
	(195,'SC','Seychelles',0),
	(196,'SD','Sudan',0),
	(197,'SE','Sweden',0),
	(198,'SG','Singapore',0),
	(199,'SH','Saint Helena',0),
	(200,'SI','Slovenia',0),
	(201,'SJ','Svalbard and Jan Mayen',0),
	(202,'SK','Slovakia',0),
	(203,'SL','Sierra Leone',0),
	(204,'SM','San Marino',0),
	(205,'SN','Senegal',0),
	(206,'SO','Somalia',0),
	(207,'SR','Suriname',0),
	(208,'SS','South Sudan',0),
	(209,'ST','São Tomé and Príncipe',0),
	(210,'SV','El Salvador',0),
	(211,'SX','Sint Maarten',0),
	(212,'SY','Syria',0),
	(213,'SZ','Swaziland',0),
	(214,'TC','Turks and Caicos Islands',0),
	(215,'TD','Chad',0),
	(216,'TF','French Southern Territories',0),
	(217,'TG','Togo',0),
	(218,'TH','Thailand',0),
	(219,'TJ','Tajikistan',0),
	(220,'TK','Tokelau',0),
	(221,'TL','East Timor',0),
	(222,'TM','Turkmenistan',0),
	(223,'TN','Tunisia',0),
	(224,'TO','Tonga',0),
	(225,'TR','Turkey',0),
	(226,'TT','Trinidad and Tobago',0),
	(227,'TV','Tuvalu',0),
	(228,'TW','Taiwan',0),
	(229,'TZ','Tanzania',0),
	(230,'UA','Ukraine',0),
	(231,'UG','Uganda',0),
	(232,'UM','U.S. Minor Outlying Islands',0),
	(233,'US','United States',1),
	(234,'UY','Uruguay',0),
	(235,'UZ','Uzbekistan',0),
	(236,'VA','Vatican City',0),
	(237,'VC','Saint Vincent and the Grenadines',0),
	(238,'VE','Venezuela',0),
	(239,'VG','British Virgin Islands',0),
	(240,'VI','U.S. Virgin Islands',0),
	(241,'VN','Vietnam',0),
	(242,'VU','Vanuatu',0),
	(243,'WF','Wallis and Futuna',0),
	(244,'WS','Samoa',0),
	(245,'XK','Kosovo',0),
	(246,'YE','Yemen',0),
	(247,'YT','Mayotte',0),
	(248,'ZA','South Africa',0),
	(249,'ZM','Zambia',0),
	(250,'ZW','Zimbabwe',0);
ALTER TABLE `country` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `user` WRITE;
ALTER TABLE `user` DISABLE KEYS;
ALTER TABLE `user` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


