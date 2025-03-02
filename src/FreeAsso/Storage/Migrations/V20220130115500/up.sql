CREATE TABLE `asso_receipt_type_cause_type` (
  `rtct_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `caut_id` bigint(20) unsigned NOT NULL,
  `rett_id` bigint(20) unsigned NOT NULL,
  `rtct_once` int(1) DEFAULT 0,
  `rtct_regular` int(1) DEFAULT 0,
  PRIMARY KEY (`rtct_id`),
  KEY `fk_rtct_cause_type` (`caut_id`),
  KEY `fk_rtct_receipt_type` (`rett_id`),
  CONSTRAINT `fk_rtct_cause_type` FOREIGN KEY (`caut_id`) REFERENCES `asso_cause_type` (`caut_id`),
  CONSTRAINT `fk_rtct_receipt_type` FOREIGN KEY (`rett_id`) REFERENCES `asso_receipt_type` (`rett_id`)
);