CREATE TABLE `asso_statistic` (
  `stat_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned DEFAULT NULL,
  `stat_code` varchar(32) DEFAULT NULL,
  `stat_name` varchar(255) DEFAULT NULL,
  `stat_year` int(11) DEFAULT NULL,
  `stat_month` int(11) DEFAULT NULL,
  `stat_nb` int(11) DEFAULT NULL,
  `stat_mnt` decimal(15,2) DEFAULT NULL,
  `grp_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`stat_id`),
  KEY `fk_statistic_broker` (`brk_id`),
  KEY `fk_statistic_group` (`grp_id`)
);