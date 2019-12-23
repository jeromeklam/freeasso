<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Dashboard extends \FreeFW\Core\Controller
{
    
    /**
     * Statistiques
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function statistics(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $data    = [];
        $sso     = \FreeFW\DI\DI::getShared('sso');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        // Causes
        $query   = 'SELECT COUNT(*) AS total FROM asso_cause' .
                   ' WHERE asso_cause.brk_id = ' . $sso->getBrokerId() .
                   '   AND (asso_cause.cau_to IS NULL OR asso_cause.cau_to >= \'' . \FreeFW\Tools\Date::getCurrentTimestamp() . '\')' .
                   '   AND asso_cause.cau_family = \'ANIMAL\'';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['total_cause'] = $row['total'];
            }
        }
        // Sites
        $query   = 'SELECT COUNT(*) AS total FROM asso_site WHERE brk_id = ' . $sso->getBrokerId();
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['total_site'] = $row['total'];
            }
        }
        // Superficies
        $query   = 'SELECT SUM(site_area) AS total FROM asso_site WHERE brk_id = ' . $sso->getBrokerId();
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['area_site'] = $row['total'];
            }
        }
        // Clotures
        $query   = 'SELECT SUM(site_number_1) AS total FROM asso_site WHERE brk_id = ' . $sso->getBrokerId();
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['clot_site'] = $row['total'];
            }
        }
        // Membres
        $query   = 'SELECT COUNT(*) AS total ' . 
                   ' FROM crm_client LEFT JOIN crm_client_type ON crm_client_type.clit_id = crm_client.clit_id' .
                   ' INNER JOIN asso_sponsorship ON asso_sponsorship.cli_id = crm_client.cli_id' .
                   ' WHERE crm_client.brk_id = ' . $sso->getBrokerId() .
                   ' AND (asso_sponsorship.spo_to is null OR asso_sponsorship.spo_to >= \'' . \FreeFW\Tools\Date::getCurrentTimestamp() . '\')'
                   ;
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['friends'] = $row['total'];
            }
        }
        // Dons
        $query   = 'SELECT SUM(don_mnt) AS total FROM asso_donation ' .
                   ' WHERE brk_id = ' . $sso->getBrokerId() .
                   ' AND don_ts >= \'' . date("Y") . '-01-01\' AND don_ts <= \'' . date("Y") . '-12-31\'' .
                   ' AND don_status = \'OK\'';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['donations'] = $row['total'];
            }
        }
        //
        return $this->createResponse(200, serialize($data));
    }
}
