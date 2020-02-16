<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseSickness
 *
 * @author jeromeklam
 */
class CauseSickness extends \FreeAsso\Model\Base\CauseSickness
{

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Sickness
     * @var \FreeAsso\Model\Sickness
     */
    protected $sickness = null;

    /**
     * Sanitary
     * @var \FreeAsso\Model\Client
     */
    protected $sanitary = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caus_id     = 0;
        $this->brk_id      = 0;
        $this->cau_id      = null;
        $this->sick_id     = null;
        $this->sanitary_id = null;
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
        if ($p_cause) {
            $this->cau_id = $p_cause->getCauId();
        } else {
            $this->cau_id = null;
        }
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

    /**
     * Set sickness
     * 
     * @param \FreeAsso\Model\Sickness $p_sickness
     * 
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSickness($p_sickness) 
    {
        $this->sickness = $p_sickness;
        return $this;
    }

    /**
     * Get sickness
     * 
     * @return \FreeAsso\Model\Sickness
     */
    public function getSickness()
    {
        return $this->sickness;
    }

    /**
     * Set sanitary
     * 
     * @param \FreeAsso\Model\Client $p_sanitary
     * 
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSanitary($p_sanitary)
    {
        $this->sanitary = $p_sanitary;
        return $this;
    }

    /**
     * Get sanitary
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getSanitary()
    {
        return $this->sanitary;
    }
}
