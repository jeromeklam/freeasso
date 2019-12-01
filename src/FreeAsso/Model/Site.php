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
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->site_id        = 0;
        $this->brk_id         = 0;
        $this->sitt_id        = 0;
        $this->site_name      = '';
        $this->parent_site_id = 0;
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
}
