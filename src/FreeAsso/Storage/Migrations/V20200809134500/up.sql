ALTER TABLE `asso_site` ADD COLUMN `site_extern` TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE `asso_cause` ADD COLUMN `cau_conform` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `asso_cause` ADD COLUMN `cau_conform_text` text DEFAULT NULL;