ALTER TABLE `asso_session` ADD COLUMN `grp_id` bigint(20) unsigned DEFAULT NULL;
UPDATE `asso_session` SET grp_id = 15;