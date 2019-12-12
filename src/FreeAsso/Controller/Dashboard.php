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
        $query   = 'SELECT COUNT(*) AS total FROM asso_cause WHERE brk_id = ' . $sso->getBrokerId();
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
        //
        return $this->createResponse(200, serialize($data));
    }
}
