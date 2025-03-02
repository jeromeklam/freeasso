<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model ReceiptTypeCauseType
 *
 * @author jeromeklam
 */
class ReceiptTypeCauseType extends \FreeAsso\Model\Base\ReceiptTypeCauseType
{

    /**
     * Comportement
     */
    use \FreeAsso\Model\Behaviour\CauseType;
    use \FreeAsso\Model\Behaviour\ReceiptType;
}
