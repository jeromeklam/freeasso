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
    use \FreeSSO\Model\Behaviour\Broker;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeFW\Model\Behaviour\Edition;
}
