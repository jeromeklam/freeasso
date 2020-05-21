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
     * Set site
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeFW\Core\Model
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
        if ($this->site === null) {
            if ($this->site_id > 0) {
                $this->site = \FreeAsso\Model\Site::findFirst(['site_id' => $this->site_id]);
            }
        }
        return $this->site;
    }
}
