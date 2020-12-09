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
    use \FreeAsso\Model\Behaviour\Site;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeSSO\Model\Behaviour\Group;
}
