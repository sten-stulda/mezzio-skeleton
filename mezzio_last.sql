# Host: localhost:8081  (Version 5.7.35)
# Date: 2021-10-18 11:30:40
# Generator: MySQL-Front 6.0  (Build 3.0)


#
# Structure for table "availability"
#

DROP TABLE IF EXISTS `availability`;
CREATE TABLE `availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "availability"
#

/*!40000 ALTER TABLE `availability` DISABLE KEYS */;
INSERT INTO `availability` VALUES (1,'1','<p>Narušení dostupnosti aktiva není důležité a v případě výpadku je běžně tolerováno delší časové období pro nápravu (cca do 1 týdne).</p>',1),(2,'2','<p>Narušení dostupnosti aktiva by nemělo překročit dobu pracovního dne, dlouhodobější výpadek vede k možnému ohrožení oprávněných zájmů povinné osoby.</p>',2),(3,'3','<p>NArušení dostupnosti aktiva by nemělo překročit dobu několika hodin. Jakýkoli výpadek je bnutné řešit neprodleně, protože k přímému ohrožení opravněných zájmů povinné osoby. Aktiva jsou považována za velmi důležitá.</p>',3),(4,'4','<p>Narušení dostupnosti aktiva není přípustné, a i krátkodobá nedostupnost (v řádu několika minut) vede k vážnému ohrožení oprávněných zájmů povinné osoby. Aktiva jsou považována za kritická. </p>',4);
/*!40000 ALTER TABLE `availability` ENABLE KEYS */;

#
# Structure for table "confidentiality"
#

DROP TABLE IF EXISTS `confidentiality`;
CREATE TABLE `confidentiality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "confidentiality"
#

/*!40000 ALTER TABLE `confidentiality` DISABLE KEYS */;
INSERT INTO `confidentiality` VALUES (1,'1','<p>Aktiva jsou veřejně přístupná nebo byla určena ke zveřejnění. Narušení důvěrnosti aktiv neohrožuje oprávěné zájmy povinné osoby.</p><p>V případě sdílení takového aktiva s třetími stranami a použití klasifikace podle tzv. traffic light protokolu (dále jen \"TLP\") je využínáno označení TLP:WHITE.</p>',1),(2,'2','<p>Aktiva nejsou veřejná přístupná a tvoří know-how povinné osoby, ochrana aktiv není vyžadována žádným právním předpisem nebo smluvním ujednáním.</p><p>V případě sdílení takového aktiva s třetími stranami a použití klasifikace podle TLP je využíváno zejména označení TLP:GREEN nebo TLP:AMBER.</p>',2),(3,'3','<p>Aktiva nejsou veřejně přístupná a jejich ochrana je vyžadována pravními předpisy, jinými předpisy nebo smluvními ujednáními (například obchodní tajemství, osobní údaje).</p><p>V případě sdílení takového aktiva s třetími stranami a použití klasifikace podle TLP je využíváno zejmena označení TLP:AMBER</p>',3),(4,'4','<p>Aktiva nejsou veřejně přístupná a yvžadují nadstandardní míru ochrany nad ramec předchozí kategorie (například strategiscké obchodní tajemství, zvlaštní kategorie osobních údajů).</p><p>V případě sdílení takového aktiva s třetími stranami a použití klasifikace podle TLP je využíváno zejména označení TLP:RED nebo TLP:AMBER.</p>',4);
/*!40000 ALTER TABLE `confidentiality` ENABLE KEYS */;

#
# Structure for table "impact"
#

DROP TABLE IF EXISTS `impact`;
CREATE TABLE `impact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT '',
  `description_level_1` text NOT NULL,
  `description_level_2` text,
  `description_level_3` text,
  `description_level_4` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "impact"
#

/*!40000 ALTER TABLE `impact` DISABLE KEYS */;
INSERT INTO `impact` VALUES (1,'Bezpečnost a zdraví','','<p>Může vést k újmě (ohrožení osobní bezpečnosti, svobody nebo zranění) jedné nebo několika osob.</p>','<p>Může vést k újmě (ohrožení osobní bezpečnosti, svobody nebo zranění) větší skupiny osob nebo ohrožení na životě jednotlivců.</p>','<p>Může vést k přímému ohrožení či ztrátě života skupiny osob.</p>'),(2,'Ochrana osobních údajů','<p>Může způsobit porušení etických, nikoli však právních předpisů vedoucí k negativním osobním dopadům najednotlivce nebo skupinou osob.</p>',NULL,NULL,NULL),(3,'Zákonné a smluvní povinnosti','',NULL,NULL,NULL),(4,'Trestně-právní řízení','',NULL,NULL,NULL),(5,'Veřejný pořádek','',NULL,NULL,NULL),(6,'Mezinárodní vztahy','',NULL,NULL,NULL),(7,'Řízení a provoz organizace','',NULL,NULL,NULL),(8,'Ztráta důveryhodnosti','',NULL,NULL,NULL),(9,'Finanční ztráty','',NULL,NULL,NULL),(10,'Zajišťování nezbytných služeb','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `impact` ENABLE KEYS */;

#
# Structure for table "integrity"
#

DROP TABLE IF EXISTS `integrity`;
CREATE TABLE `integrity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "integrity"
#

/*!40000 ALTER TABLE `integrity` DISABLE KEYS */;
INSERT INTO `integrity` VALUES (1,'1','<p>Aktivum nevyžaduje ochranu z hlediska integrity. Narušení integrity aktiva neohrožuje oprávěné zájmy povinné osoby.</p>',1),(2,'2','<p>Aktivum může vyžadovat ochranu z hlediska integrity. Narušení integrity aktiva může vést k poškození oprávněných zájmůn povinné osoby a může se projevit méně závažnými dopady na primární aktiva.</p>',2),(3,'3','<p>Aktivum vyžaduje ochranu z hlediska integrity. Narušení integrity aktiva vede k poškození oprávněných zájmů povinné osoby s podstatnými dopady na primární aktiva.</p>',3),(4,'4','<p>Aktivum vyžaduje ochranu z hlediska. integrity. Narušení integrity vede k velmi vážnému poškození oprávněných zájmů povinné osoby s přímými a velmi vážnými dopady na primární aktiva.</p>',4);
/*!40000 ALTER TABLE `integrity` ENABLE KEYS */;

#
# Structure for table "resulting_rate"
#

DROP TABLE IF EXISTS `resulting_rate`;
CREATE TABLE `resulting_rate` (
  `level_of_threat` int(11) NOT NULL,
  `level_of_vulnerability` int(11) NOT NULL,
  `level_of_impact` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`level_of_threat`,`level_of_vulnerability`,`level_of_impact`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

#
# Data for table "resulting_rate"
#

/*!40000 ALTER TABLE `resulting_rate` DISABLE KEYS */;
INSERT INTO `resulting_rate` VALUES (1,1,1,1),(1,1,2,2),(1,1,3,3),(1,1,4,4),(1,2,1,2),(1,2,2,3),(1,2,3,4),(1,2,4,5),(1,3,1,3),(1,3,2,4),(1,3,3,5),(1,3,4,6),(1,4,1,4),(1,4,2,5),(1,4,3,6),(1,4,4,7),(2,1,1,2),(2,1,2,3),(2,1,3,4),(2,1,4,5),(2,2,1,3),(2,2,2,4),(2,2,3,5),(2,2,4,6),(2,3,1,4),(2,3,2,5),(2,3,3,6),(2,3,4,7),(2,4,1,5),(2,4,2,6),(2,4,3,7),(2,4,4,8),(3,1,1,3),(3,1,2,4),(3,1,3,5),(3,1,4,6),(3,2,1,4),(3,2,2,5),(3,2,3,6),(3,2,4,7),(3,3,1,5),(3,3,2,6),(3,3,3,7),(3,3,4,8),(3,4,1,6),(3,4,2,7),(3,4,3,8),(3,4,4,9),(4,1,1,4),(4,1,2,5),(4,1,3,6),(4,1,4,7),(4,2,1,5),(4,2,2,6),(4,2,3,7),(4,2,4,8),(4,3,1,6),(4,3,2,7),(4,3,3,8),(4,3,4,9),(4,4,1,7),(4,4,2,8),(4,4,3,9),(4,4,4,10);
/*!40000 ALTER TABLE `resulting_rate` ENABLE KEYS */;

#
# Structure for table "risk_limits"
#

DROP TABLE IF EXISTS `risk_limits`;
CREATE TABLE `risk_limits` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `min_value` int(11) NOT NULL,
  `max_value` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "risk_limits"
#

/*!40000 ALTER TABLE `risk_limits` DISABLE KEYS */;
INSERT INTO `risk_limits` VALUES (1,1,3,99,'Riziko je považováno za přijatelné.'),(1,2,100,249,'Riziko může být sníženo méně náročnými opatřeními nebo v případě vyšší náročnosti opatření je riziko přijatelné.'),(3,3,250,399,'Riziko je dlouhodobě nepřípustné a musí být zahájeny systematické kroky k jeho odstranění.'),(4,4,300,810,'Riziko je nepřípustné a musí být neprodleně zahájeny kroky k jeho odstranění.');
/*!40000 ALTER TABLE `risk_limits` ENABLE KEYS */;

#
# Structure for table "roles"
#

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "roles"
#

INSERT INTO `roles` VALUES (1,'admin'),(2,'member'),(3,'guest');

#
# Structure for table "test"
#

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

#
# Data for table "test"
#


#
# Structure for table "threat"
#

DROP TABLE IF EXISTS `threat`;
CREATE TABLE `threat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "threat"
#

/*!40000 ALTER TABLE `threat` DISABLE KEYS */;
INSERT INTO `threat` VALUES (1,1,'<p>Hrozba neexistuje nebo je málo pravděpodobná. Předpokládaná realizace hrozby není častější než jednou za 5 let.</p>',1),(2,2,'<p>Hrozba je málo pravděpodobná až pravděpodobná. Předpokládaná realizace hrozby je v rozpětí od 1 roku do 5 let.</p>',2),(3,3,'<p>Hrozba je pravděpodobná až velmi pravděpodobná. Předpokládaná realizace hrozby je v rozpětí od 1 měsíce do 1 roku.</p>',3),(4,4,'<p>Hrozba je velmi pravděpodobná a víceméně jistá. Předpokládaná realizace hrozby je častejší než jednou za měsíc.</p>',4);
/*!40000 ALTER TABLE `threat` ENABLE KEYS */;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Female','Male','Other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg',
  `role_id` tinyint(1) NOT NULL DEFAULT '2',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `created` (`created`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'stulda','stulik@webimage.cz','laska','1978-02-02','Female','avatar.jpg',2,1,'1978-02-02 00:00:00'),(2,'Admin','admin@webimage.cz','$2y$10$9EbzomvBWV/wDtURPj6F0eOxMmzg.wC.OtRoQ397qjdPtyxFjNd2m',NULL,'Male','avatar.jpg',1,1,'2021-10-09 08:45:17');

#
# Structure for table "forgot"
#

DROP TABLE IF EXISTS `forgot`;
CREATE TABLE `forgot` (
  `user_id` int(11) unsigned NOT NULL,
  `token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `token` (`token`),
  CONSTRAINT `forgot_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "forgot"
#


#
# Structure for table "valuation"
#

DROP TABLE IF EXISTS `valuation`;
CREATE TABLE `valuation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aktiva_id` int(11) DEFAULT NULL,
  `level1` varchar(255) DEFAULT NULL,
  `confidentiality_value` int(11) DEFAULT NULL,
  `integrity_value` int(11) DEFAULT NULL,
  `availability_value` int(11) DEFAULT NULL,
  `impact_value` int(11) DEFAULT NULL,
  `vulnerability_value` int(11) DEFAULT NULL,
  `threat_value` int(11) DEFAULT NULL,
  `asset_value` int(11) DEFAULT NULL,
  `result_of_degree_of_risk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "valuation"
#

/*!40000 ALTER TABLE `valuation` DISABLE KEYS */;
INSERT INTO `valuation` VALUES (1,200,'1',1,1,1,1,1,1,3,3),(2,201,'4',4,4,4,4,4,4,81,810),(3,202,'3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,301,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `valuation` ENABLE KEYS */;

#
# Structure for table "vulnerability"
#

DROP TABLE IF EXISTS `vulnerability`;
CREATE TABLE `vulnerability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Data for table "vulnerability"
#

/*!40000 ALTER TABLE `vulnerability` DISABLE KEYS */;
INSERT INTO `vulnerability` VALUES (1,'1','<p>Zranitelnost neexistuje nebo je zneužití zranitelnosti málo pravděpodobné. Jsou zavedena bezpečnostní opatření, která jsou schopna včas detekovat možné zranitelnosti nebo případné pokusy jejich zneužití.</p>',1),(2,'2','<p>Zneužití zranitelnosti je málo pravděpodobné až pravděpodobné. Jsou zavedena bezpečnostní opatření, jejichž účinnost je pravidelně kontrolováno. Schopnost bezpečnostních opatření včas detekovat možné zranitelnosti nebo případné pokusy o překonání opatření je omezena. Nejsou známy žádné úspěšné pokusy o překonání bezpečnostních opatření.</p>',2),(3,'3','<p>Zneužití zranitelnosti je pravděpodobné až velmi pravděpodobné. Bezpečnostní opatření jsou zavadena, ale jejich účinnost nepokrývá všechny potřebné aspekty a není pravidelně kontrolována. Jsou známé dílčí úspěšné pokusy o překonání bezpečnostních opatření.</p>',3),(4,'4','<p>Zneužití zranitelnosti je velmi pravděpodobné až více méně jisté.</p>',4);
/*!40000 ALTER TABLE `vulnerability` ENABLE KEYS */;
