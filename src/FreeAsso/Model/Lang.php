<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Lang
 *
 * @author jeromeklam
 */
class Lang extends \FreeAsso\Model\Base\Lang implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->lang_id   = 0;
        $this->lang_name = '';
        $this->lang_code = '';
        return $this;
    }
}
