ALTER TABLE `asso_receipt_generation` ADD COLUMN `ptyp_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_receipt_generation` ADD KEY `fk_receipt_generation_payment_type` (`ptyp_id`);
ALTER TABLE `asso_receipt_generation` ADD CONSTRAINT `fk_receipt_generation_payment_type` FOREIGN KEY (`ptyp_id`) REFERENCES `asso_payment_type` (`ptyp_id`);