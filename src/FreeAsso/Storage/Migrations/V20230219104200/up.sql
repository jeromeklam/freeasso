CREATE TABLE `asso_year` (
  `year_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(4) unsigned NOT NULL,
  `grp_id` bigint(20) unsigned NOT NULL,
  `year_open` int(1) DEFAULT 0,
  `year_number` int(9) DEFAULT 0,
  PRIMARY KEY (`year_id`),
  UNIQUE KEY `ix_year` (`year`,`grp_id`)
);