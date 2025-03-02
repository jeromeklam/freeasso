<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * GroupType
 *
 * @author jeromeklam
 */
class GroupType extends \FreeSSO\Model\Base\GroupType
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->grpt_id  = 0;
        return $this;
    }
}
