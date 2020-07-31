ALTER TABLE `asso_movement` MODIFY COLUMN `move_status` enum('OK','WAIT','KO','ARCHIVE') NOT NULL DEFAULT 'OK';
ALTER TABLE `asso_cause_movement` MODIFY COLUMN `camv_status` enum('OK','WAIT','KO','ARCHIVE') NOT NULL DEFAULT 'OK';
UPDATE asso_cause set cau_family = 'ANIMAL' WHERE brk_id = 3 AND cau_family = 'NONE';