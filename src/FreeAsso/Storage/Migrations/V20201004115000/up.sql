UPDATE asso_cause set cau_sex = 'OTHER' where cau_sex is null;
ALTER TABLE `asso_cause` MODIFY COLUMN `cau_sex` enum('F','M','C','OTHER') NOT NULL DEFAULT 'OTHER';