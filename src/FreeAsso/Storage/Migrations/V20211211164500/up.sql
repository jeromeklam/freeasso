ALTER TABLE `asso_sponsorship` DROP COLUMN `spo_current_month`;
ALTER TABLE `asso_sponsorship` ADD COLUMN `spo_current_month` TINYINT(1) DEFAULT 1;
CREATE TABLE `asso_jk1` (
  `don_real_ts` timestamp NULL DEFAULT NULL,
  `spo_id` bigint(20) unsigned DEFAULT NULL,
  `don_ts` timestamp NULL DEFAULT NULL
);
insert into `asso_jk1`(don_real_ts, spo_id)
select min(don_real_ts), spo_id 
from asso_donation
where asso_donation.spo_id is not null
group by spo_id;
update `asso_jk1` set don_ts = (select min(don_ts) from asso_donation where asso_donation.spo_id = asso_jk1.spo_id and asso_donation.don_real_ts = asso_jk1.don_real_ts);
update asso_sponsorship set spo_ts = (select don_ts from asso_jk1 where asso_jk1.spo_id = asso_sponsorship.spo_id);
drop table `asso_jk1`;
update asso_sponsorship set spo_current_month = 1;
update asso_sponsorship set spo_current_month = 0
where not exists (
  select 1 from asso_donation
   where month(asso_donation.don_real_ts) = month(asso_sponsorship.spo_ts)
     and year(asso_donation.don_real_ts) = year(asso_sponsorship.spo_ts)
      and asso_donation.spo_id = asso_sponsorship.spo_id
);
update asso_donation set accl_id = null, don_verif = 'NONE', don_verif_match = 0, don_verif_comment = null;