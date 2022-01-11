CREATE TABLE `asso_receipt_generation` (
  `recg_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned DEFAULT NULL,
  `recg_name` varchar(80) DEFAULT NULL,
  `recg_year` int(11) DEFAULT NULL,
  `recg_status` enum('DONE','ERROR','PENDING','WAITING','NONE') NOT NULL DEFAULT 'NONE',
  `recg_save` longtext DEFAULT NULL,
  `edi_id` bigint(20) unsigned DEFAULT NULL,
  `grp_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`recg_id`),
  KEY `fk_receipt_generation_broker` (`brk_id`),
  KEY `fk_receipt_generation_edition` (`edi_id`),
  KEY `fk_receipt_generation_group` (`grp_id`)
);