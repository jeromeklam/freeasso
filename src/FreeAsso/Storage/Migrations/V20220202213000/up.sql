ALTER TABLE `asso_accounting_header` ADD COLUMN `acch_format` varchar(20) DEFAULT 'COMPTA';
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_cert_year_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_cause_type` ADD COLUMN `caut_don_month_email_id` bigint(20) unsigned DEFAULT NULL;
ALTER TABLE `asso_receipt_generation` ADD COLUMN `email_id` bigint(20) unsigned DEFAULT NULL;