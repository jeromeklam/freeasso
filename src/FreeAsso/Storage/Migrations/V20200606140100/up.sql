ALTER TABLE `asso_movement` MODIFY `move_to_type` enum('OTHER','ASSEMBLY','INTERNAL','MARKET','COMMERCIAL') NOT NULL DEFAULT 'OTHER';
ALTER TABLE `asso_movement` MODIFY `move_from_type` enum('OTHER','ASSEMBLY','INTERNAL','MARKET','SLAUGHTERHOUSE','COMMERCIAL', 'PRIVATE') NOT NULL DEFAULT 'OTHER';
