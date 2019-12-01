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
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->camt_id   = 0;
        $this->brk_id    = 0;
        $this->camt_name = '';
        return $this;
    }
}
