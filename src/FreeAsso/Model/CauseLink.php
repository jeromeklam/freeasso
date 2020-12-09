<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseLink
 *
 * @author jeromeklam
 */
class CauseLink extends \FreeAsso\Model\Base\CauseLink implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeSSO\Model\Behaviour\Group;
}
