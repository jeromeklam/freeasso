<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * ClientCategory
 *
 * @author jeromeklam
 */
class ClientCategory extends \FreeAsso\Model\Base\ClientCategory implements
    \FreeFW\Interfaces\ApiResponseInterface
{
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->clic_id   = 0;
        $this->brk_id    = 0;
        $this->clic_name = '';
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeAsso\Model\Base\ClientCategory::setClicCode()
     */
    public function setClicCode($p_value)
    {
        $clic_code = \FreeFW\Tools\PBXString::withoutAccent($p_value);
        $clic_code = strtoupper($clic_code);
        $clic_code = str_replace(["-", ".", "_", " "], '', $clic_code);
        //
        $this->clic_code = $clic_code;
        return $this;
    }

    /**
     *
     */
    public function beforeCreate()
    {
        $this->setClicCode($this->clic_name);
        return true;
    }

    /**
     *
     */
    public function beforeSave()
    {
        $this->setClicCode($this->clic_name);
        return true;
    }
}
