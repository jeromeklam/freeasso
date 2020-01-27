<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * SiteAlert
 *
 * @author jeromeklam
 */
class SiteAlert extends \FreeAsso\Model\Base\SiteAlert
{

    /**
     * Cause
     * @var \FreeAsso\Model\Site
     */
    protected $site = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sita_id = 0;
        $this->brk_id  = 0;
        $this->site_id = 0;
        return $this;
    }

    /**
     * Set site
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\SiteMedia
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
}
