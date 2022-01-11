<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Session extends \FreeFW\Core\Service
{

    /**
     * Génération pour les 6 prochains mois
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function generate($p_params = [])
    {
        $this->logger->debug('Session.generate.START');
        // Vérifications
        $sso = \FreeFW\DI\DI::getShared('sso');
        $group = $sso->getUserGroup();
        if (!$group) {
            throw new \Exception('Erreur, le groupe est obligatoire !');
        }
        $dNow  = new \Datetime('now');
        $grpId = $group->getGrpId();
        $year  = intval($dNow->format('Y'));
        $month = intval($dNow->format('m'));
        $total = 0;
        // Boucle
        // Génération / Vérification des sessions pour les 6 prochains mois
        while ($total < 6) {
            $session = \FreeAsso\Model\Session::getFactory($year, $month, $grpId);
            $month++;
            if ($month > 12) {
                $month = 1;
                $year++;
            }
            $total++;
        }
        $this->logger->debug('Session.generate.END');
        return $p_params;
    }
}
