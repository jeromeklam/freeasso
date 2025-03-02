ALTER TABLE `asso_receipt` ADD COLUMN `rec_year_order` int(11) unsigned DEFAULT NULL;
UPDATE `asso_receipt` set `rec_year_order` = REGEXP_SUBSTR(rec_number,"[0-9]+");

UPDATE `asso_receipt` set `rec_title` = 'PROGRAM OF SAFEGUARD AND REHABILITATION OF GIBBONS IN INDONESIA' WHERE lang_id = 366;
UPDATE `asso_receipt` set `rec_title` = 'PROGRAMME DE SAUVEGARDE DES GIBBONS ET DE LEUR HABITAT EN INDONESIE' WHERE lang_id != 366;