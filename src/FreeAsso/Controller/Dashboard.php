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
        // Contrats
        $query   = 'SELECT COUNT(*) AS total FROM asso_contract' .
                   ' WHERE asso_contract.brk_id = ' . $sso->getBrokerId() .
                   '   AND (asso_contract.ct_to IS NULL OR asso_contract.ct_to >= \'' . \FreeFW\Tools\Date::getCurrentTimestamp() . '\')';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['total_contract'] = intval($row['total']);
            }
        }
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
                $data['total_cause'] = intval($row['total']);
            }
        }
        // Sites
        $query   = 'SELECT COUNT(*) AS total FROM asso_site ' .
            ' WHERE brk_id = ' . $sso->getBrokerId() .
            '   AND (asso_site.site_to IS NULL OR asso_site.site_to >= \'' . \FreeFW\Tools\Date::getCurrentTimestamp() . '\')';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['total_site'] = intval($row['total']);
            }
        }
        // Superficies
        $query   = 'SELECT SUM(site_area) AS total FROM asso_site ' .
                   ' WHERE brk_id = ' . $sso->getBrokerId() . ' AND site_area IS NOT NULL';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['area_site'] = floatval($row['total']);
            }
        }
        // Clotures
        $query   = 'SELECT SUM(site_number_6) AS total FROM asso_site ' .
                   ' WHERE brk_id = ' . $sso->getBrokerId() . ' AND site_number_6 IS NOT NULL';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                if ($row['total'] !== null) {
                    $data['clot_site'] = floatval($row['total']);
                } else {
                    $data['clot_site'] = 0;
                }
            }
        }
        // Membres amis
        $query   = 'SELECT COUNT(*) AS total ' .
                   ' FROM ( ' .
                   '     SELECT DISTINCT crm_client.cli_id FROM crm_client' .
                   '     LEFT JOIN crm_client_type ON crm_client_type.clit_id = crm_client.clit_id' .
                   '     INNER JOIN asso_sponsorship ON asso_sponsorship.cli_id = crm_client.cli_id' .
                   '     WHERE crm_client.brk_id = ' . $sso->getBrokerId() .
                   '     AND (asso_sponsorship.spo_to is null OR asso_sponsorship.spo_to >= \'' . \FreeFW\Tools\Date::getCurrentTimestamp() . '\')' .
                   ' ) AS tmp';
        $pdo     = $storage->getProvider();
        $stm     = $pdo->prepare($query);
        $result  = $stm->execute();
        if ($result) {
            while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                $data['total_friends'] = intval($row['total']);
            }
        }
        // Datas
        $datas = \FreeAsso\Model\Data::find();
        foreach ($datas as $oneData) {
            $key = str_replace("'", '', strtolower($oneData->getDataCode()));
            switch ($key) {
                case 'animauxproteges':
                    $data['total_cause'] = intval($oneData->getDataContent());
                    $data[$key] = intval($oneData->getDataContent());
                    break;
                case 'hectaresdeforet':
                    $content = str_replace(',', '.', $oneData->getDataContent());
                    $data[$key] = floatval($content);
                    $data['hectaresproteges'] = floatval($content);
                    break;
                case 'motifdarret':
                    $data[$key] = json_decode($oneData->getDataContent());
                    break;
                default:
                    $data[$key] = $oneData->getDataContent();
                    break;
            }
        }
        //
        return $this->createResponse(200, serialize($data));
    }
}
