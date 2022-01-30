ALTER TABLE `asso_certificate` ADD COLUMN `cerg_id` bigint(20) unsigned;
ALTER TABLE `asso_certificate` ADD CONSTRAINT `fk_certificate_certificate_generation` FOREIGN KEY (`cerg_id`) REFERENCES `asso_certificate_generation` (`cerg_id`);
ALTER TABLE `asso_receipt` ADD COLUMN `recg_id` bigint(20) unsigned;
ALTER TABLE `asso_receipt` ADD CONSTRAINT `fk_receipt_receipt_generation` FOREIGN KEY (`recg_id`) REFERENCES `asso_receipt_generation` (`recg_id`);