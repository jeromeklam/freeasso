ALTER TABLE `asso_receipt` DROP FOREIGN KEY `fk_receipt_file`;
ALTER TABLE `asso_receipt` ADD CONSTRAINT `fk_receipt_file` FOREIGN KEY (`file_id`) REFERENCES `sys_file` (`file_id`);
