<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * SiteMedia
 *
 * @author jeromeklam
 */
class SiteMedia extends \FreeAsso\Model\Base\SiteMedia
{

    /**
     * Comportements
     */
    use \FreeAsso\Model\Behavior\Site;
    use \FreeFW\Model\Behavior\Lang;
    use \FreeSSO\Model\Behavior\Group;
}
