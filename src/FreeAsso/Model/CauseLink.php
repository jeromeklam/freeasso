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
     * Behavior
     */
    use \FreeAsso\Model\Behavior\Cause;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;
}
