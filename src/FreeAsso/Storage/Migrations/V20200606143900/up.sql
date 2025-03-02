ALTER TABLE `asso_site_type` ADD `sitt_code` varchar(80) DEFAULT NULL;
SET FOREIGN_KEY_CHECKS = 0;
ALTER TABLE `asso_cause_movement` MODIFY `camv_site_from_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_movement` MODIFY `camv_site_to_id` bigint(20) unsigned DEFAULT NULL;
SET FOREIGN_KEY_CHECKS = 1;