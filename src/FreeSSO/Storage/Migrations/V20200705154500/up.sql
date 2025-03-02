UPDATE `sso_user_broker` SET ubrk_partner_type = 'NONE' WHERE ubrk_partner_type IS NULL OR ubrk_partner_type = '';
UPDATE `sso_user_broker` SET ubrk_partner_id = 0 WHERE ubrk_partner_id IS NULL;
ALTER TABLE `sso_user_broker` MODIFY `ubrk_partner_type` varchar(20) NOT NULL DEFAULT 'NONE';