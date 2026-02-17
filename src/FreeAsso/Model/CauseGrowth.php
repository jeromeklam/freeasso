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
     * Behavior
     */
    use \FreeAsso\Model\Behavior\Cause;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;
}
