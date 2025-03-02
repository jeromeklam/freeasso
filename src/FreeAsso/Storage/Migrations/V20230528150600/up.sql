ALTER TABLE `asso_donation` MODIFY COLUMN `don_real_ts` DATE DEFAULT NULL;
ALTER TABLE `asso_donation` MODIFY COLUMN `don_ask_ts` DATE DEFAULT NULL;
ALTER TABLE `asso_donation` MODIFY COLUMN `don_end_ts` DATE DEFAULT NULL;
ALTER TABLE `asso_sponsorship` MODIFY COLUMN `spo_from` DATE DEFAULT NULL;
ALTER TABLE `asso_sponsorship` MODIFY COLUMN `spo_to` DATE DEFAULT NULL;