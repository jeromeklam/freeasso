ALTER TABLE `asso_cause` ADD COLUMN `cau_unit_money` varchar(20) DEFAULT null;
UPDATE asso_cause SET cau_unit_money = 'IDR' WHERE cau_unit_base IS NOT NULL;