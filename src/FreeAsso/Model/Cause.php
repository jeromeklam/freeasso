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
     * Constantes
     * @var string
     */
    const FAMILY_NONE   = 'NONE';
    const FAMILY_ANIMAL = 'ANIMAL';
    const FAMILY_OTHER  = 'OTHER';

    /**
     * Site
     * @var \FreeAsso\Model\Site
     */
    protected $site = null;

    /**
     * Type de cause
     * @var \FreeAsso\Model\CauseType
     */
    protected $cause_type = null;

    /**
     * Set site
     * 
     * @param \FreeAsso\Model\Site $p_site
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setSite($p_site)
    {
        $this->site = $p_site;
        return $this;
    }

    /**
     * Get site
     * 
     * @return \FreeAsso\Model\Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set Cause type
     * 
     * @param \FreeAsso\Model\CauseType $p_cause_type
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setCauseType($p_cause_type)
    {
        $this->cause_type = $p_cause_type;
        return $this;
    }

    /**
     * Get cause type
     * 
     * @return \FreeAsso\Model\CauseType
     */
    public function getCauseType()
    {
        return $this->cause_type;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cau_id        = 0;
        $this->brk_id        = 0;
        $this->caut_id       = 0;
        $this->cau_name      = '';
        $this->cau_code      = '';
        $this->cau_public    = 1;
        $this->cau_available = 1;
        $this->cau_family    = self::FAMILY_NONE;
        return $this;
    }
}
