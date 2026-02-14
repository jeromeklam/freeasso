<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model AccountingLine
 *
 * @author jeromeklam
 */
class AccountingLine extends \FreeAsso\Model\Base\AccountingLine
{

    /**
     * Comportement
     */
    use \FreeAsso\Model\Behavior\Donation;
}
