<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseGrowth
 *
 * @author jeromeklam
 */
class CauseGrowth extends \FreeAsso\Model\Base\CauseGrowth
{

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->grow_id = 0;
        $this->brk_id  = 0;
        $this->cau_id  = 0;
        return $this;
    }

    /**
     * Set cause
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCause($p_cause)
    {
        $this->cause = $p_cause;
        return $this;
    }

    /**
     * Get cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getCause()
    {
        return $this->cause;
    }
}
