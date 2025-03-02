ALTER TABLE `asso_payment_type` ADD COLUMN `ptyp_name_en` varchar(20) DEFAULT NULL;
UPDATE `asso_payment_type` set `ptyp_name_en` = `ptyp_name`;