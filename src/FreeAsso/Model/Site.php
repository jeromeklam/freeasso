<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Site
 *
 * @author jeromeklam
 */
class Site extends \FreeAsso\Model\Base\Site  implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Type de site
     * @var \FreeAsso\Model\SiteType
     */
    protected $site_type = null;

    /**
     * Owner
     * @var \FreeAsso\Model\Client
     */
    protected $owner = null;

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
        $this->site_id        = 0;
        $this->brk_id         = 0;
        $this->sitt_id        = null;
        $this->site_name      = '';
        $this->parent_site_id = null;
        $this->site_left      = 0;
        $this->site_right     = 0;
        $this->site_position  = 0;
        $this->site_level     = 1;
        return $this;
    }

    /**
     * Set site type
     * 
     * @param \FreeAsso\Model\SiteType $p_site_type
     * 
     * @return \FreeAsso\Model\Site
     */
    public function setSiteType($p_site_type)
    {
        $this->site_type = $p_site_type;
        return $this;
    }

    /**
     * Get site type
     * 
     * @return \FreeAsso\Model\SiteType
     */
    public function getSiteType()
    {
        return $this->site_type;
    }

    /**
     * Set owner
     * 
     * @param \FreeAsso\Model\Client $p_owner
     * 
     * @return \FreeAsso\Model\Site
     */
    public function setOwner($p_owner) 
    {
        $this->owner = $p_owner;
        return $this;
    }

    /**
     * Get Owner
     * 
     * @return \FreeAsso\Model\Client
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set sanitary
     * 
     * @param \FreeAsso\Model\Client $p_sanitary
     * 
     * @return \FreeAsso\Model\Site
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
