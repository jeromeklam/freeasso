<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Site
{

    /**
     * Site
     * @var \FreeAsso\Model\Site
     */
    protected $site = null;

    /**
     * SiteId
     * @var number
     */
    protected $site_id = null;

    /**
     * Set site
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeFW\Core\Model
     */
    public function setSite($p_site)
    {
        $this->site = $p_site;
        if ($this->site instanceof \FreeAsso\Model\Site) {
            $this->setSiteId($this->site->getSiteId());
        } else {
            $this->setSiteId(null);
        }
        return $this;
    }

    /**
     * Get site
     *
     * @return \FreeAsso\Model\Site
     */
    public function getSite()
    {
        if ($this->site === null) {
            if ($this->site_id > 0) {
                $this->site = \FreeAsso\Model\Site::findFirst(['site_id' => $this->site_id]);
            }
        }
        return $this->site;
    }

    /**
     * Set site id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\Site
     */
    public function setSiteId($p_id)
    {
        $this->site_id = $p_id;
        if ($this->site !== null) {
            if ($this->site_id != $this->site->getSiteId()) {
                $this->site = null;
            }
        }
        return $this;
    }

    /**
     * Get site id
     *
     * @return number
     */
    public function getSiteId()
    {
        return $this->site_id;
    }
}
