ALTER TABLE `asso_sponsorship` ADD COLUMN `spo_ts` timestamp NULL DEFAULT NULL;
ALTER TABLE `asso_sponsorship` ADD COLUMN `spo_current_month` VARCHAR(20) NOT NULL DEFAULT('NONE');
ALTER TABLE `asso_session` ADD COLUMN `sess_verif` VARCHAR(20) NOT NULL DEFAULT('NONE');
ALTER TABLE `asso_session` ADD COLUMN `sess_verif_text` LONGTEXT DEFAULT NULL;