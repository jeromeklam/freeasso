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
     * behaviour
     */
    use \FreeAsso\Model\Behavior\SiteType;
    use \FreeSSO\Model\Behavior\Group;

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

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
     * Parent_site
     * @var \FreeAsso\Model\Site
     */
    protected $parent_site = null;

    /**
     * Count cause
     * @var number
     */
    protected $site_count_cause = null;

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

    /**
     * Set parent site
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\Site
     */
    public function setParentSite($p_site)
    {
        $this->parent_site = $p_site;
        return $this;
    }

    /**
     * Get parent site
     *
     * @return \FreeAsso\Model\Site
     */
    public function getParentSite()
    {
        return $this->parent_site;
    }

    /**
     * Get site count cause
     *
     * @return number
     */
    public function getSiteCountCause()
    {
        if ($this->site_count_cause === null) {
            $this->site_count_cause = 0;
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query = \FreeAsso\Model\Cause::getQuery();
            $query
                ->setType(\FreeFW\Model\Query::QUERY_COUNT)
                ->addFromFilters([
                    'site_id' => $this->getSiteId(),
                    'cau_to' => null,
                ])
            ;
            if ($query->executeWithCache()) {
                foreach ($query->getResult() as $row) {
                    $this->site_count_cause = $row->MONTOT;
                }
            }
        }
        return $this->site_count_cause;
    }

    /**
     * Set count cause
     *
     * @param number $p_count
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCountCause($p_count)
    {
        $this->site_count_cause = $p_count;
        return $this;
    }
}
