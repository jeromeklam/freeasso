<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseGrowth
 *
 * @author jeromeklam
 */
class CauseGrowth extends \FreeAsso\Model\Base\CauseGrowth
{

    /**
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeSSO\Model\Behaviour\Group;
}
