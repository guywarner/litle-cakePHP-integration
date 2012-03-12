#App sql generated on: 2012-03-12 17:29:08 : 1331573348

DROP TABLE IF EXISTS `auth`;


CREATE TABLE `token` (
	
	`number` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
	`message` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`response` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`tokenMessage` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`token` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`saleAmount` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`type` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`expDate` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`cardValidationNum` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`saleLitleTxnId` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`saleMessage` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`creditAmount` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`creditLitleTxnId` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',
	`creditMessage` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',	
	`voidMessage` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT '',PRIMARY KEY  (`id`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=MyISAM;

