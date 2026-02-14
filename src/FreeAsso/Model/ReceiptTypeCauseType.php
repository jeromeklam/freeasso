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
    use \FreeAsso\Model\Behavior\CauseType;
    use \FreeAsso\Model\Behavior\ReceiptType;
}
