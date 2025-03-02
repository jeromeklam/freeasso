<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMediaLang
 *
 * @author jeromeklam
 */
class CauseMediaLang extends \FreeAsso\Model\Base\CauseMediaLang
{

    /**
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\CauseMedia;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeFW\Model\Behaviour\Lang;
}
