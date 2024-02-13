ALTER TABLE `asso_receipt_generation` ADD COLUMN `recg_receipt` tinyint DEFAULT 1;
ALTER TABLE `asso_receipt_generation` ADD COLUMN `recg_prefix` varchar(20) DEFAULT NULL;
ALTER TABLE `asso_receipt` ADD COLUMN `rec_receipt` tinyint DEFAULT 1;
ALTER TABLE `asso_year` ADD COLUMN `year_attest` int DEFAULT 0;
