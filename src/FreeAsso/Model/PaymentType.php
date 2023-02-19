<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * PaymentType
 *
 * @author jeromeklam
 */
class PaymentType extends \FreeAsso\Model\Base\PaymentType
{

    /**
     * Types
     * @var string
     */
    const TYPE_CHECK  = 'CHECK';
    const TYPE_CASH   = 'CASH';
    CONST TYPE_BANK   = 'BANK';
    const TYPE_NATURE = 'NATURE';
    const TYPE_OTHER  = 'OTHER';

    /**
     * Restrictions
     * @var string
     */
    const RESTRICTION_NONE    = 'NONE';
    const RESTRICTION_ONCE    = 'ONCE';
    const RESTRICTION_REGULAR = 'REGULAR';

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;
}
