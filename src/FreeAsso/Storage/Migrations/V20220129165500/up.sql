CREATE TABLE `asso_certificate_generation` (
  `cerg_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned DEFAULT NULL,
  `cerg_name` varchar(80) DEFAULT NULL,
  `cerg_year` int(11) DEFAULT NULL,
  `cerg_status` enum('DONE','ERROR','PENDING','WAITING','NONE') NOT NULL DEFAULT 'NONE',
  `cerg_save` longtext DEFAULT NULL,
  `edi_id` bigint(20) unsigned DEFAULT NULL,
  `grp_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`cerg_id`),
  KEY `fk_certificate_generation_broker` (`brk_id`),
  KEY `fk_certificate_generation_edition` (`edi_id`),
  KEY `fk_certificate_generation_group` (`grp_id`)
);