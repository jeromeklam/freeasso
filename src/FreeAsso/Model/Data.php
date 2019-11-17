<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Data
 *
 * @author jeromeklam
 */
class Data extends \FreeAsso\Model\Base\Data implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->data_id = 0;
        $this->brk_id  = 0;
        return $this;
    }
}
