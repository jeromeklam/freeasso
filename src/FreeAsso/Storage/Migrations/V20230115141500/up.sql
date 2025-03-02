ALTER TABLE `asso_receipt_generation` ADD COLUMN `clic_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_receipt_generation` ADD KEY `fk_receipt_generation_category` (`clic_id`);
ALTER TABLE `asso_receipt_generation` ADD CONSTRAINT `fk_receipt_generation_category` FOREIGN KEY (`clic_id`) REFERENCES `crm_client_category` (`clic_id`);