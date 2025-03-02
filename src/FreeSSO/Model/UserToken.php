<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model UserToken
 *
 * @author jeromeklam
 */
class UserToken extends \FreeSSO\Model\Base\UserToken
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Broker;
    use \FreeSSO\Model\Behaviour\User;
}
