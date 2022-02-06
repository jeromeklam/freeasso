<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model ReceiptGeneration
 *
 * @author jeromeklam
 */
class ReceiptGeneration extends \FreeAsso\Model\Base\ReceiptGeneration
{

    /**
     * Status
     * @var string
     */
    const STATUS_WAITING = 'WAITING';
    const STATUS_PENDING = 'PENDING';
    const STATUS_ERROR   = 'ERROR';
    const STATUS_DONE    = 'DONE';
    const STATUS_NONE    = 'NONE';

    /**
     * Comportement
     */
    use \FreeSSO\Model\Behaviour\Broker;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeFW\Model\Behaviour\Edition;
    use \FreeFW\Model\Behaviour\Email;
}
