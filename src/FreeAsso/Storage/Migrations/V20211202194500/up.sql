CREATE TABLE `asso_accounting_header` (
  `acch_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `acch_name` varchar(255) NOT NULL DEFAULT '',
  `acch_year` int(11) NOT NULL,
  `acch_month` int(11) NOT NULL,
  `acch_ts` timestamp NULL DEFAULT NULL,
  `acch_content` longtext DEFAULT NULL,
  `acch_status` enum('WAITING','IMPORTED','PENDING','DONE') NOT NULL DEFAULT 'WAITING',
  `acch_status_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`acch_id`)
);
CREATE TABLE `asso_accounting_line` (
  `accl_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `acch_id` bigint(20) unsigned NOT NULL,
  `accl_ts` timestamp NULL DEFAULT NULL,
  `accl_amount` decimal(15,6) DEFAULT NULL,
  `accl_label` varchar(255) DEFAULT NULL,
  `accl_ptyp_name` varchar(80) DEFAULT NULL,
  `accl_complement` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`accl_id`)
);
ALTER TABLE `asso_donation` ADD COLUMN `accl_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_donation` ADD COLUMN `don_verif` varchar(20) DEFAULT 'NONE';
