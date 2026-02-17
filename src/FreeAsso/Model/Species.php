<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Species
 *
 * @author jeromeklam
 */
class Species extends \FreeAsso\Model\Base\Species
{
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;
}
