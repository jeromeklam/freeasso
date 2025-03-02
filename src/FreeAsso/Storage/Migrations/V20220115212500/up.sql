ALTER TABLE `asso_donation` ADD INDEX `idx_donation_list` (`grp_id`, `don_real_ts`);
ALTER TABLE `crm_client` ADD INDEX `idx_client_list` (`cli_firstname`, `cli_lastname`, `grp_id`);
ALTER TABLE `asso_sponsorship` ADD INDEX `idx_sponsorship_list` (`spo_from`, `grp_id`);
ALTER TABLE `asso_certificate` ADD INDEX `idx_certificate_list` (`cert_ts`, `grp_id`);
ALTER TABLE `crm_client` DROP INDEX `idx1_client_fullname`;