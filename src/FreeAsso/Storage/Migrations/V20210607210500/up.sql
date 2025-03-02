ALTER TABLE `asso_certificate` DROP CONSTRAINT `fk_certificate_file`;
ALTER TABLE `asso_certificate` ADD CONSTRAINT `fk_certificate_file` FOREIGN KEY (`file_id`) REFERENCES `sys_file` (`file_id`);