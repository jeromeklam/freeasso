ALTER TABLE `sso_user` MODIFY COLUMN `user_avatar` longblob DEFAULT NULL;
ALTER TABLE `sso_session` MODIFY COLUMN `sess_content` longtext DEFAULT NULL;