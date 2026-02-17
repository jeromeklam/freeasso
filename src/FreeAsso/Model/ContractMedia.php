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
    use \FreeAsso\Model\Behavior\Contract;
    use \FreeFW\Model\Behavior\Lang;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;
}
