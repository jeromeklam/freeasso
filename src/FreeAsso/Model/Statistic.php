<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Statistic
 *
 * @author jeromeklam
 */
class Statistic extends \FreeAsso\Model\Base\Statistic
{

    /**
     * Comportement
     */
    use \FreeSSO\Model\Behavior\Broker;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;
}
