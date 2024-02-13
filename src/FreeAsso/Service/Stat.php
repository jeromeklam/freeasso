<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Stat extends \FreeFW\Core\Service
{
    /**
     * Generate statistics
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function generateStats($p_params = [], $p_user_id)
    {
        $this->logger->debug('Stat.generate.start');
        $config  = \FreeFW\Di\Di::getShared('config');

        $storage = \FreeFW\DI\DI::getShared('Storage::default');

        $provider = $storage->getProvider();
        $provider->query('DROP TABLE asso_stats');

        $req = <<<'EOT'
create table asso_stats as
select asso_donation.grp_id as grp_id, Year(don_real_ts) as don_year, MONTH(don_real_ts) as don_month, asso_payment_type.ptyp_name as ptyp_name, crm_client_category.clic_name as clic_name,
asso_cause_type.caut_name as caut_name, nvl(asso_donation.spo_id > 0, 0) as don_regular, nvl(sys_country.cnty_cog = sso_group.grp_cog, 0) as cnty_ass,
don_status, SUM(don_mnt) as tot_mnt
from asso_donation 
inner join crm_client on crm_client.cli_id = asso_donation.cli_id
inner join sys_country on sys_country.cnty_id = crm_client.cnty_id
inner join asso_payment_type on asso_payment_type.ptyp_id = asso_donation.ptyp_id
inner join crm_client_category on crm_client_category.clic_id = crm_client.clic_id
inner join asso_cause on asso_cause.cau_id = asso_donation.cau_id
inner join asso_cause_type on asso_cause_type.caut_id = asso_cause.caut_id
inner join sso_group on sso_group.grp_id = asso_donation.grp_id
GROUP BY grp_id, don_year, don_month, ptyp_name, clic_name, caut_name, don_regular, cnty_ass, don_status;
EOT;
        $provider->query($req);
        $this->logger->debug('Stat.generate.end');
        return $p_params;
    }
}
