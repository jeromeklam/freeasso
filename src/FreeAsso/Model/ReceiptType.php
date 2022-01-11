<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptType
 *
 * @author jeromeklam
 */
class ReceiptType extends \FreeAsso\Model\Base\ReceiptType
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Get new number
     *
     * @param boolean $p_increment
     * 
     * @return string
     */
    public function getNewNumber($p_increment = true)
    {
        $fullNumber = '';
        $number = intval($this->getRettLastNumber());
        if ($p_increment) {
            $number++;
            $this->setRettLastNumber($number);
        }
        $fullNumber = \FreeFW\Tools\PBXString::parse($this->getRettRegex(), ['number' => $number]);
        return $fullNumber;
    }
}
