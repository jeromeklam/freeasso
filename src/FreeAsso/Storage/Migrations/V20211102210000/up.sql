ALTER TABLE `asso_cause_type` ADD COLUMN `caut_spo_add_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_spo_update_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_spo_end_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_don_add_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_don_update_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_don_end_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_don_generate_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_add_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_update_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_end_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `crm_client_type` ADD COLUMN `clit_add_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `crm_client_type` ADD COLUMN `clit_update_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `crm_client_type` ADD COLUMN `clit_end_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_session` ADD COLUMN `sess_month` int(2) unsigned DEFAULT NULL;
ALTER TABLE `asso_session` ADD COLUMN `sess_year` int(4) unsigned DEFAULT NULL;
UPDATE `asso_session` SET `sess_year` = `sess_exercice`;