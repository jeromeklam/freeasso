<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Cause
 *
 * @author jeromeklam
 */
class Cause extends \FreeAsso\Model\Base\Cause implements
    \FreeFW\Interfaces\ApiResponseInterface
{
    
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cau_id   = 0;
        $this->brk_id   = 0;
        $this->cau_name = '';
        $this->cau_code = '';
        return $this;
    }
}
