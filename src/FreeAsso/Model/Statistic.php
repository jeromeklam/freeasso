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
    use \FreeSSO\Model\Behaviour\Broker;
    use \FreeSSO\Model\Behaviour\Group;
}
