ALTER TABLE `asso_contract` ADD COLUMN `ct_subcontractor` TINYINT(1) DEFAULT 0;
ALTER TABLE `crm_client` ADD COLUMN `parent_cli_id` bigint(20) unsigned  DEFAULT NULL;
ALTER TABLE `crm_client` ADD COLUMN `cli_sanit` TINYINT(1) DEFAULT 0;