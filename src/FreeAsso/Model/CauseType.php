<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseType
 *
 * @author jeromeklam
 */
class CauseType extends \FreeAsso\Model\Base\CauseType implements
    \FreeFW\Interfaces\ApiResponseInterface
{
    
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caut_id         = 0;
        $this->brk_id          = 0;
        $this->caut_name       = '';
        $this->caut_receipt    = 0;
        $this->caut_certificat = 0;
        return $this;
    }
}
