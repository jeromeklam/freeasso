<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * JobFunction
 *
 * @author jeromeklam
 */
class JobFunction extends \FreeSSO\Model\Base\JobFunction
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->fct_id  = 0;
        return $this;
    }
}
