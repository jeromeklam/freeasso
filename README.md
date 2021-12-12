# freeasso
Projet Free Association pour mettre à disposition une gestion de dons, ...

## Utilisation

Point d'entrée principal : www/index.php
Gestion sans bdd et via fichier csv pour l'instant

## Deploy

```
    ./install/phing prepare-deploy
    ./install/phing create-tgz
```

create table jk1 as
select asso_sponsorship.spo_id
from asso_donation inner join asso_sponsorship
on asso_donation.spo_id = asso_sponsorship.spo_id
where asso_donation.cau_id = 12684
and asso_sponsorship.cau_id = 12686;
update asso_sponsorship set cau_id = 12684 where spo_id in (select spo_id from jk1);
update asso_donation set cau_id = 12684 where spo_id in (select spo_id from jk1);
drop table jk1;
create table jk1 as
select asso_sponsorship.spo_id
from asso_donation inner join asso_sponsorship
on asso_donation.spo_id = asso_sponsorship.spo_id
where asso_donation.cau_id = 12685
and asso_sponsorship.cau_id = 12686;
update asso_sponsorship set cau_id = 12685 where spo_id in (select spo_id from jk1);
update asso_donation set cau_id = 12685 where spo_id in (select spo_id from jk1);
drop table jk1;
select *
from asso_donation inner join asso_sponsorship
on asso_donation.spo_id = asso_sponsorship.spo_id
where asso_donation.cau_id != 12686
and asso_sponsorship.cau_id = 12686;