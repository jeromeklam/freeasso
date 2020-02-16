<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Unit
 *
 * @author jeromeklam
 */
class Unit extends \FreeAsso\Model\Base\Unit
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->unit_id = 0;
        $this->brk_id  = 0;
        return $this;
    }
}
