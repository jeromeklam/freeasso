ALTER TABLE `asso_certificate` ADD COLUMN `cert_manual` tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE `asso_receipt` ADD COLUMN `rec_manual` tinyint(1) NOT NULL DEFAULT 0;
UPDATE asso_receipt SET rec_manual = 1 WHERE rec_number like 'M%';