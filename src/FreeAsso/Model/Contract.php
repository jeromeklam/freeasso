<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Contract
 *
 * @author jeromeklam
 */
class Contract extends \FreeAsso\Model\Base\Contract
{

    /**
     * Comportement
     */
    use \FreeAsso\Model\Behavior\Site;
    use \FreeAsso\Model\Behavior\Contact1;
    use \FreeAsso\Model\Behavior\Contact2;
    use \FreeSSO\Model\Behavior\Group;

    /**
     * Retourne le dernier numéro disponible pour une année
     *
     * @param number $p_year
     *
     * @return number
     */
    public function getLastNn($p_year)
    {
        $nn = 0;
        $list = \FreeAsso\Model\Contract::find(
            ['ct_code' => [\FreeFW\Storage\Storage::COND_BEGIN_WITH => $p_year]]
        );
        foreach ($list as $contract) {
            $parts = explode('.', $contract->getCtCode());
            if (count($parts) > 1 && intval($parts[1]) > $nn) {
                $nn = intval($parts[1]);
            }
        }
        return $nn;
    }

    /**
     * Spécifique pour préparer la création
     *
     * @return \FreeAsso\Model\Contract
     */
    public function initCreate()
    {
        $year = date('Y');
        $this->setCtCode($year . '.' . str_pad($this->getLastNn($year) + 1, 3, '0', STR_PAD_LEFT));
        return $this;
    }
}
