<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Certificate
 *
 * @author jeromeklam
 */
class Certificate extends \FreeAsso\Model\Base\Certificate
{

    /**
     * Bahaviours
     */
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     *
     * @return boolean
     */
    public function calculateFields()
    {
        $mnt  = $this->getCertInputMnt();
        $when = $this->getCertTs();
        $rate = \FreeFW\Model\Rate::findBest($this->getCertInputMoney(),$this->getCertOutputMoney(), $when);
        if ($rate) {
            $newMnt = $mnt * $rate->getRateChange();
            $this->setCertOutputMnt($newMnt);
        }
        $unitBase = $this->getCertUnitBase();
        $unitMnt  = $this->getCertUnitMnt();
        if ($unitBase && $unitMnt) {
            $this->setCertData1(($mnt * $unitBase) / $unitMnt);
        }
        return true;
    }
}
