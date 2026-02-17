<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model CertificateGeneration
 *
 * @author jeromeklam
 */
class CertificateGeneration extends \FreeAsso\Model\Base\CertificateGeneration
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
    use \FreeFW\Behavior\LlmAwareTrait;
}
