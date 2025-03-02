ALTER TABLE `crm_client` ADD COLUMN `cli_accounting` varchar(80) DEFAULT NULL;
update asso_donation set don_verif = 'HISTO', don_verif_comment = 'Historique', don_verif_match = 0, accl_id = null where sess_id < 177;
update asso_donation set accl_id = null, don_verif = 'NONE', don_verif_match = 0, don_verif_comment = null, don_desc = null where sess_id >= 177;