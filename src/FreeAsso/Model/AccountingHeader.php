<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model AccountingHeader
 *
 * @author jeromeklam
 */
class AccountingHeader extends \FreeAsso\Model\Base\AccountingHeader
{

    /**
     * Status
     */
    const STATUS_WAITING  = 'WAITING';
    const STATUS_IMPORTED = 'IMPORTED';
    const STATUS_PENDING  = 'PENDING';
    const STATUS_DONE     = 'DONE';
}
 