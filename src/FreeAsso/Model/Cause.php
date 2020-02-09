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
    const FAMILY_FOREST = 'FOREST';

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
     * Origin
     * @var \FreeAsso\Model\Client
     */
    protected $origin = null;

    /**
     * Raiser
     * @var \FreeAsso\Model\Client
     */
    protected $raiser = null;

    /**
     * Parent 1
     * @var \FreeAsso\Model\Cause
     */
    protected $parent1 = null;

    /**
     * Parent 2
     * @var \FreeAsso\Model\Cause
     */
    protected $parent2 = null;

    /**
     * Default text
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_text = null;

    /**
     * Default blob
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_blob = null;

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
        $this->cau_year      = null;
        return $this;
    }

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
     * Set parent1
     * 
     * @param \FreeAsso\Model\Cause $p_cause
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setParent1($p_cause)
    {
        $this->parent1 = $p_cause;
        return $this;
    }

    /**
     * Get parent1
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent1()
    {
        return $this->parent1;
    }

    /**
     * Set parent2
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent2($p_cause)
    {
        $this->parent2 = $p_cause;
        return $this;
    }

    /**
     * Get parent2
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent2()
    {
        return $this->parent2;
    }

    /**
     * Get origin
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setOrigin($p_client)
    {
        $this->origin = $p_client;
        return $this;
    }

    /**
     * Get origin
     *
     * @return \FreeAsso\Model\Client
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set raiser
     * 
     * @param \FreeAsso\Model\Client $p_raiser
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setRaiser($p_raiser)
    {
        $this->raiser = $p_raiser;
        return $this;
    }

    /**
     * Get raiser
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getRaiser()
    {
        return $this->raiser;
    }

    /**
     * Set default text
     * 
     * @param \FreeAsso\Model\CauseMedia $p_media
     * 
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultText($p_media)
    {
        $this->default_text = $p_media;
        return $this;
    }

    /**
     * get default text
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultText()
    {
        return $this->default_text;
    }

    /**
     * Set default blob
     *
     * @param \FreeAsso\Model\CauseMedia $p_media
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultBlob($p_media)
    {
        $this->default_blob = $p_media;
        return $this;
    }
    
    /**
     * get default blob
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultBlob()
    {
        return $this->default_blob;
    }
}
