ALTER TABLE `asso_movement` ADD `move_status` enum('OK','WAIT','KO') NOT NULL DEFAULT 'OK';