<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Sickness
 *
 * @author jeromeklam
 */
class Sickness extends \FreeAsso\Model\Base\Sickness
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sick_id     = 0;
        $this->brk_id      = 0;
        $this->sick_spread = false;
        return $this;
    }
}
