<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait SiteType
{

    /**
     * SiteType
     * @var \FreeAsso\Model\SiteType
     */
    protected $site_type = null;

    /**
     * Set site_type
     *
     * @param \FreeAsso\Model\SiteType $p_site_type
     *
     * @return \FreeFW\Core\Model
     */
    public function setSiteType($p_site_type)
    {
        $this->site_type = $p_site_type;
        return $this;
    }

    /**
     * Get site_type
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function getSiteType()
    {
        if ($this->site_type === null) {
            if ($this->sitt_id > 0) {
                $this->site_type = \FreeAsso\Model\SiteType::findFirst(['sitt_id' => $this->sitt_id]);
            }
        }
        return $this->site_type;
    }
}
