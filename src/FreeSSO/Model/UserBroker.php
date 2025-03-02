<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * UserBroker
 *
 * @author jeromeklam
 */
class UserBroker extends \FreeSSO\Model\Base\UserBroker
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Broker;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeSSO\Model\Behaviour\User;

    /**
     * Methods
     * @var string
     */
    const METHOD_AUTO = 'AUTO';

    /**
     * Types
     * @var string
     */
    const TYPE_APP = 'APP';
}
