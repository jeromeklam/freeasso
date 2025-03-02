ALTER TABLE `sso_group` ADD COLUMN `grp_dig_sign` longblob DEFAULT NULL;
ALTER TABLE `sso_group` ADD COLUMN `grp_siret` varchar(80) DEFAULT NULL;
ALTER TABLE `sso_group` ADD COLUMN `grp_siret_cpl` varchar(80) DEFAULT NULL;