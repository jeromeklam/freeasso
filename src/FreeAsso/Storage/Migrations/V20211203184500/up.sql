ALTER TABLE `asso_payment_type` ADD COLUMN `ptyp_accounting` varchar(80) DEFAULT NULL;
ALTER TABLE `asso_payment_type` ADD COLUMN `ptyp_restriction` varchar(20) DEFAULT 'NONE';
