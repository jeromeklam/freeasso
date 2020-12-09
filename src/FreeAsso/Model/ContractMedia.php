<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model ContractMedia
 *
 * @author jeromeklam
 */
class ContractMedia extends \FreeAsso\Model\Base\ContractMedia
{

    /**
     * Type de media
     * @var string
     */
    const TYPE_PHOTO = 'PHOTO';
    const TYPE_HTML  = 'HTML';
    const TYPE_NEWS  = 'NEWS';
    const TYPE_OTHER = 'OTHER';

    /**
     * Comportement
     */
    use \FreeAsso\Model\Behaviour\Contract;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeSSO\Model\Behaviour\Group;
}
