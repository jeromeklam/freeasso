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
     * Behavior
     */
    use \FreeAsso\Model\Behavior\CauseMedia;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Model\Behavior\Lang;
    use \FreeFW\Behavior\LlmAwareTrait;
}
