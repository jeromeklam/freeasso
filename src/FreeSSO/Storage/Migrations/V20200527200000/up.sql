CREATE TABLE `sso_domain` (
  `dom_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dom_key` varchar(32) NOT NULL DEFAULT '',
  `dom_name` varchar(80) NOT NULL DEFAULT '',
  `dom_concurrent_user` tinyint(2) NOT NULL DEFAULT 0,
  `dom_maintain_seconds` int(11) NOT NULL DEFAULT 3600,
  `dom_session_minutes` int(11) NOT NULL DEFAULT 0,
  `dom_sites` text DEFAULT NULL,
  PRIMARY KEY (`dom_id`)
);
CREATE TABLE `sso_group_type` (
  `grpt_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grpt_code` varchar(20) DEFAULT NULL,
  `grpt_name` varchar(80) DEFAULT NULL,
  `grpt_from` timestamp NULL DEFAULT NULL,
  `grpt_to` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`grpt_id`)
);
CREATE TABLE `sso_job_function` (
  `fct_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fct_code` varchar(20) DEFAULT NULL,
  `fct_name` varchar(80) DEFAULT NULL,
  `fct_from` timestamp NULL DEFAULT NULL,
  `fct_to` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fct_id`)
);
CREATE TABLE `sso_group` (
  `grp_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grpt_id` bigint(20) unsigned NOT NULL,
  `grp_code` varchar(20) NOT NULL DEFAULT '',
  `grp_name` varchar(80) NOT NULL DEFAULT '',
  `grp_address1` varchar(80) DEFAULT NULL,
  `grp_address2` varchar(80) DEFAULT NULL,
  `grp_address3` varchar(80) DEFAULT NULL,
  `grp_cp` varchar(20) DEFAULT NULL,
  `grp_town` varchar(80) DEFAULT NULL,
  `cnty_id` bigint(20) unsigned DEFAULT NULL,
  `lang_id` bigint(20) unsigned DEFAULT NULL,
  `grp_from` timestamp NULL DEFAULT NULL,
  `grp_to` timestamp NULL DEFAULT NULL,
  `grp_parent_id` bigint(20) unsigned DEFAULT NULL,
  `grp_money_code` varchar(3) NOT NULL DEFAULT 'EUR',
  `grp_money_input` varchar(3) NOT NULL DEFAULT 'EUR',
  `grp_logo` longblob DEFAULT NULL,
  `grp_email_header` longtext DEFAULT NULL,
  `grp_email_footer` longtext DEFAULT NULL,
  `grp_sign` longtext DEFAULT NULL,
  `grp_realm_id` bigint(20) unsigned DEFAULT NULL,
  `grp_config` longtext DEFAULT NULL,
  PRIMARY KEY (`grp_id`),
  UNIQUE KEY `idx1_group` (`grp_code`),
  KEY `fk_group_country` (`cnty_id`),
  KEY `fk_group_lang` (`lang_id`),
  KEY `fk_group_group_type` (`grpt_id`),
  KEY `fk_group_realm` (`grp_realm_id`),
  CONSTRAINT `fk_group_group_type` FOREIGN KEY (`grpt_id`) REFERENCES `sso_group_type` (`grpt_id`),
  CONSTRAINT `fk_group_realm` FOREIGN KEY (`grp_realm_id`) REFERENCES `sso_group` (`grp_id`)
);
CREATE TABLE `sso_broker` (
  `brk_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dom_id` bigint(20) unsigned NOT NULL,
  `brk_key` varchar(255) DEFAULT NULL,
  `brk_name` varchar(80) NOT NULL DEFAULT '',
  `brk_certificate` varchar(255) DEFAULT NULL,
  `brk_active` tinyint(1) NOT NULL DEFAULT 0,
  `brk_ts` timestamp NULL DEFAULT NULL,
  `brk_api_scope` varchar(255) DEFAULT '',
  `brk_users_scope` varchar(255) DEFAULT '',
  `brk_auth` varchar(255) DEFAULT NULL,
  `brk_ips` text DEFAULT NULL COMMENT 'Liste des ips séparées par ;',
  `brk_same_ip` tinyint(1) NOT NULL DEFAULT 0,
  `brk_config` longtext DEFAULT NULL COMMENT 'Configuration au format JSON',
  `grp_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Groupe propriétaire du broker',
  `brk_type` enum('EXTERN','LINK','MANUAL','TECH') NOT NULL DEFAULT 'MANUAL',
  PRIMARY KEY (`brk_id`),
  UNIQUE KEY `ix_broker_brk_key` (`brk_name`),
  UNIQUE KEY `ix_broker_brk_name` (`brk_key`),
  KEY `fk_broker_dom_id` (`dom_id`),
  KEY `sso_brokers_idx1` (`brk_key`,`brk_active`),
  KEY `fk_broker_group` (`grp_id`),
  CONSTRAINT `fk_broker_domain` FOREIGN KEY (`dom_id`) REFERENCES `sso_domain` (`dom_id`),
  CONSTRAINT `fk_broker_group` FOREIGN KEY (`grp_id`) REFERENCES `sso_group` (`grp_id`)
);
CREATE TABLE `sso_user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_active` tinyint(1) NOT NULL DEFAULT 0,
  `user_salt` varchar(80) NOT NULL DEFAULT '',
  `user_email` varchar(255) DEFAULT NULL,
  `user_first_name` varchar(80) DEFAULT NULL,
  `user_last_name` varchar(80) DEFAULT NULL,
  `user_title` enum('MISTER','MADAM','MISS','OTHER') NOT NULL DEFAULT 'OTHER',
  `user_scope` text DEFAULT NULL,
  `user_type` enum('USER','IP','UUID','ANONYMOUS','REST') NOT NULL DEFAULT 'USER',
  `user_ips` text DEFAULT NULL,
  `user_last_update` timestamp NULL DEFAULT NULL,
  `user_preferred_language` varchar(3) DEFAULT 'FR',
  `user_avatar` blob DEFAULT NULL,
  `user_cache` text DEFAULT NULL,
  `user_val_string` varchar(32) DEFAULT NULL,
  `user_val_end` timestamp NULL DEFAULT NULL,
  `user_val_login` varchar(255) DEFAULT NULL,
  `user_cnx` text DEFAULT NULL,
  `user_extern_code` varchar(255) DEFAULT NULL,
  `lang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ix_user_user_login` (`user_login`,`user_active`),
  KEY `fk_user_lang` (`lang_id`)
);
CREATE TABLE `sso_user_broker` (
  `ubrk_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `ubrk_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ubrk_partner_type` varchar(20) NOT NULL DEFAULT '',
  `ubrk_partner_id` bigint(20) NOT NULL,
  `ubrk_auth_method` varchar(20) NOT NULL DEFAULT 'AUTO',
  `ubrk_auth_datas` text DEFAULT NULL,
  `ubrk_end` timestamp NULL DEFAULT NULL,
  `ubrk_config` longtext DEFAULT NULL,
  `ubrk_cache` longtext DEFAULT NULL,
  PRIMARY KEY (`ubrk_id`),
  UNIQUE KEY `sso_links_users_idx1` (`brk_id`,`user_id`,`ubrk_partner_type`,`ubrk_partner_id`),
  KEY `fk_user_broker_user` (`user_id`),
  CONSTRAINT `fk_user_broker_broker` FOREIGN KEY (`brk_id`) REFERENCES `sso_broker` (`brk_id`),
  CONSTRAINT `fk_user_broker_user` FOREIGN KEY (`user_id`) REFERENCES `sso_user` (`user_id`)
);
CREATE TABLE `sso_group_user` (
  `gru_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grp_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `fct_id` bigint(20) unsigned DEFAULT NULL,
  `gru_scope` varchar(255) DEFAULT NULL,
  `gru_tel1` varchar(20) DEFAULT NULL,
  `gru_tel2` varchar(20) DEFAULT NULL,
  `gru_email` varchar(255) DEFAULT NULL,
  `gru_from` timestamp NULL DEFAULT NULL,
  `gru_to` timestamp NULL DEFAULT NULL,
  `gru_activ` tinyint(1) NOT NULL DEFAULT 1,
  `gru_ts` timestamp NULL DEFAULT NULL,
  `gru_extern_id` varchar(80) DEFAULT NULL,
  `gru_informations` text DEFAULT NULL,
  `gru_rgpd` longtext DEFAULT NULL,
  PRIMARY KEY (`gru_id`),
  KEY `fk_group_user_group` (`grp_id`),
  KEY `fk_group_user_user` (`user_id`),
  KEY `fk_group_user_function` (`fct_id`),
  CONSTRAINT `fk_group_user_function` FOREIGN KEY (`fct_id`) REFERENCES `sso_job_function` (`fct_id`),
  CONSTRAINT `fk_group_user_group` FOREIGN KEY (`grp_id`) REFERENCES `sso_group` (`grp_id`),
  CONSTRAINT `fk_group_user_user` FOREIGN KEY (`user_id`) REFERENCES `sso_user` (`user_id`)
);
CREATE TABLE `sso_password_token` (
  `ptok_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ptok_token` varchar(80) NOT NULL DEFAULT '',
  `ptok_used` tinyint(1) NOT NULL DEFAULT 0,
  `ptok_email` varchar(255) NOT NULL DEFAULT '',
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ptok_request_ip` varchar(50) DEFAULT NULL,
  `ptok_resolve_ip` varchar(50) DEFAULT NULL,
  `ptok_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ptok_id`),
  KEY `sso_passwords_tokens_idx1` (`ptok_token`,`ptok_used`,`ptok_end`),
  KEY `fk_password_token_user` (`user_id`),
  CONSTRAINT `fk_password_token_user` FOREIGN KEY (`user_id`) REFERENCES `sso_user` (`user_id`)
);
CREATE TABLE `sso_user_token` (
  `utok_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `brk_id` bigint(20) unsigned NOT NULL,
  `utok_token` varchar(255) NOT NULL DEFAULT '',
  `utok_from` timestamp NULL DEFAULT NULL,
  `utok_to` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`utok_id`),
  UNIQUE KEY `ix_user_token_token` (`utok_token`),
  KEY `fk_user_token_broker` (`brk_id`),
  KEY `fk_user_token_user` (`user_id`),
  CONSTRAINT `fk_user_token_broker` FOREIGN KEY (`brk_id`) REFERENCES `sso_broker` (`brk_id`),
  CONSTRAINT `fk_user_token_user` FOREIGN KEY (`user_id`) REFERENCES `sso_user` (`user_id`)
);
CREATE TABLE `sso_session` (
  `sess_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `sess_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sess_end` timestamp NULL DEFAULT NULL,
  `sess_touch` timestamp NULL DEFAULT NULL,
  `sess_content` text DEFAULT NULL,
  `sess_client_addr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sess_id`),
  KEY `fk_session_user_id` (`user_id`),
  KEY `sso_sessions_idx1` (`sess_end`),
  CONSTRAINT `fk_session_user` FOREIGN KEY (`user_id`) REFERENCES `sso_user` (`user_id`)
);
CREATE TABLE `sso_broker_session` (
  `brs_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brk_key` varchar(32) NOT NULL DEFAULT '',
  `brs_token` varchar(32) NOT NULL DEFAULT '',
  `brs_session_id` varchar(80) DEFAULT '',
  `brs_client_address` varchar(50) DEFAULT NULL,
  `brs_date_created` timestamp NULL DEFAULT NULL,
  `brs_end` timestamp NULL DEFAULT NULL,
  `sess_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`brs_id`),
  KEY `fk_brokers_sess_id` (`sess_id`),
  KEY `sso_brokers_sessions_idx1` (`brk_key`,`brs_token`),
  KEY `sso_brokers_sessions_idx2` (`brs_end`),
  CONSTRAINT `fk_broker_session` FOREIGN KEY (`sess_id`) REFERENCES `sso_session` (`sess_id`)
);
CREATE TABLE `sso_autologin_cookie` (
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `auto_cookie` varchar(128) NOT NULL DEFAULT '',
  `auto_ip` varchar(32) DEFAULT NULL,
  `auto_ts` timestamp NULL DEFAULT NULL,
  `auto_expire` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`auto_cookie`)
);
INSERT INTO `sso_job_function` (`fct_id`, `fct_code`, `fct_name`, `fct_from`, `fct_to`)
VALUES
    (1, 'ZEUS', 'Super Administrateur', NULL, NULL),
    (2, 'RESP', 'Responsable', NULL, NULL),
    (3, 'TECH', 'Technicien', NULL, NULL),
    (4, 'EMP', 'Employé', NULL, NULL),
    (5, 'DEV', 'Développeur', NULL, NULL);
INSERT INTO `sso_group_type` (`grpt_id`, `grpt_code`, `grpt_name`, `grpt_from`, `grpt_to`)
VALUES
    (1, 'FREEASSO', 'Free Asso Administration', NULL, NULL),
    (4, 'JVS', 'Jvs', NULL, NULL);
INSERT INTO `sso_group` (`grp_id`, `grpt_id`, `grp_code`, `grp_name`, `grp_address1`, `grp_address2`, `grp_address3`, `grp_cp`, `grp_town`, `cnty_id`, `lang_id`, `grp_from`, `grp_to`, `grp_parent_id`, `grp_money_code`, `grp_money_input`, `grp_logo`, `grp_email_header`, `grp_email_footer`, `grp_sign`, `grp_realm_id`, `grp_config`)
VALUES
    (1, 1, 'FREEASSO', 'Free Association', NULL, NULL, NULL, NULL, NULL, NULL, 368, NULL, NULL, NULL, 'EUR', 'EUR', NULL, NULL, NULL, NULL, 1, NULL),
    (4, 4, 'JVS-MAIRISTEM', 'Jvs-Mairistem', NULL, NULL, NULL, NULL, NULL, NULL, 368, NULL, NULL, NULL, 'EUR', 'EUR', NULL, NULL, NULL, NULL, 4, NULL),
    (5, 4, 'POLE OMEGA', 'Pole Omega', NULL, NULL, NULL, NULL, NULL, NULL, 368, NULL, NULL, 4, 'EUR', 'EUR', NULL, NULL, NULL, NULL, 4, NULL);

INSERT INTO `sso_domain` (`dom_id`, `dom_key`, `dom_name`, `dom_concurrent_user`, `dom_maintain_seconds`, `dom_session_minutes`, `dom_sites`)
VALUES
    (1, 'jvsonline.fr', 'jvsonline.fr', 0, 3600, 0, NULL),
    (2, 'freeasso.fr', 'freeasso.fr', 0, 3600, 0, NULL);
INSERT INTO `sso_broker` (`brk_id`, `dom_id`, `brk_key`, `brk_name`, `brk_certificate`, `brk_active`, `brk_ts`, `brk_api_scope`, `brk_users_scope`, `brk_auth`, `brk_ips`, `brk_same_ip`, `brk_config`, `grp_id`, `brk_type`)
VALUES
    (2, 2, 'freeasso', 'FreeAsso', NULL, 1, NULL, NULL, NULL, 'JWT,HAWK', NULL, 0, NULL, 1, 'MANUAL'),
    (4, 1, 'omegawebbo', 'OMEGA-WEB-BO', NULL, 1, NULL, '', '', 'JWT,HAWK', NULL, 0, NULL, 4, 'MANUAL'),
    (9, 1, 'omegaweb', 'OMEGA-WEB', NULL, 1, NULL, '', '', 'JWT', NULL, 0, NULL, 4, 'MANUAL');
INSERT INTO `sso_user` (`user_id`, `user_login`, `user_password`, `user_active`, `user_salt`, `user_email`, `user_first_name`, `user_last_name`, `user_title`, `user_scope`, `user_type`, `user_ips`, `user_last_update`, `user_preferred_language`, `user_avatar`, `user_cache`, `user_val_string`, `user_val_end`, `user_val_login`, `user_cnx`, `user_extern_code`, `lang_id`)
VALUES
    (1, 'jeromeklam@free.fr', '1c29f8082679ca2ab9085e6105a4de8e', 1, 'ede5cb66d6d987d7924e11eed4009584', 'jeromeklam@free.fr', 'Jérôme', 'KLAM', 'MISTER', 'ZEUS', 'USER', NULL, NULL, 'FR', NULL, '', NULL, NULL, NULL, '', 'jeromeklam@free.fr', NULL),
    (2, 'fannykuster@free.fr', 'cb9d4c54ec233ad06d01a3eb57f209e6', 1, 'e4ffb03145f17d87066d645964ca59c0', 'fannykuster@free.fr', 'Fanny', 'KUSTER', 'MADAM', 'VmpKMFYxWnNWak5RVkRBOQ==', 'USER', '', NULL, 'FR', X'', '', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `sso_user_broker` (`ubrk_id`, `brk_id`, `user_id`, `ubrk_ts`, `ubrk_partner_type`, `ubrk_partner_id`, `ubrk_auth_method`, `ubrk_auth_datas`, `ubrk_end`, `ubrk_config`, `ubrk_cache`)
VALUES
    (1, 4, 1, '2020-05-27 16:46:01', '', 0, 'AUTO', NULL, NULL, NULL, NULL),
    (2, 2, 1, '2018-10-21 11:49:23', '', 0, 'AUTO', NULL, NULL, NULL, NULL),
    (3, 4, 2, '2020-05-27 16:45:52', '', 0, 'AUTO', NULL, NULL, NULL, NULL),
    (4, 2, 2, '2019-11-28 00:00:00', '', 0, 'AUTO', NULL, NULL, NULL, NULL);
INSERT INTO `sso_group_user` (`gru_id`, `grp_id`, `user_id`, `fct_id`, `gru_scope`, `gru_tel1`, `gru_tel2`, `gru_email`, `gru_from`, `gru_to`, `gru_activ`, `gru_ts`, `gru_extern_id`, `gru_informations`, `gru_rgpd`)
VALUES
    (1, 1, 1, 1, 'ZEUS', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
    (3, 1, 2, 1, 'ZEUS', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
    (9, 4, 1, 1, 'ZEUS', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
    (10, 4, 2, 1, 'ZEUS', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);
