ALTER TABLE `asso_certificate` ADD COLUMN `cau_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_certificate` ADD CONSTRAINT `fk_certificate_cause` FOREIGN KEY (`cau_id`) REFERENCES `asso_cause` (`cau_id`);