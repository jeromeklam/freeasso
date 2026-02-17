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
    use \FreeSSO\Model\Behavior\Broker;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Model\Behavior\Edition;
    use \FreeFW\Model\Behavior\Email;
    use \FreeAsso\Model\Behavior\ClientCategory;
    use \FreeAsso\Model\Behavior\PaymentType;
    use \FreeFW\Behavior\LlmAwareTrait;
}
