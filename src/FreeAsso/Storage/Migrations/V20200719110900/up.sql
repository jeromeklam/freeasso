UPDATE `asso_site` SET `site_number_1` = 0 WHERE `site_number_1` IS NULL;
UPDATE `asso_site` SET `site_number_6` = `site_number_1`;