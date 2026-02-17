<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMainType
 *
 * @author jeromeklam
 */
class CauseMainType extends \FreeAsso\Model\Base\CauseMainType implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * Constants for family
     * @var string
     */
    const FAMILY_OTHER         = 'OTHER';
    const FAMILY_NONE          = 'NONE';
    const FAMILY_ANIMAL        = 'ANIMAL';
    const FAMILY_NATURE        = 'NATURE';
    const FAMILY_ADMINISTRATIV = 'ADMINISTRATIV';
}
