ALTER TABLE `asso_receipt_generation` ADD COLUMN `recg_gen` timestamp NULL DEFAULT NULL;
ALTER TABLE `asso_receipt_generation` ADD COLUMN `recg_email` timestamp NULL DEFAULT NULL;
ALTER TABLE `asso_receipt_generation` ADD COLUMN `recg_no_email` timestamp NULL DEFAULT NULL;