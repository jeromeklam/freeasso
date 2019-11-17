<?php
namespace FreeAsso\Model\Base;

/**
 * Site
 *
 * @author jeromeklam
 */
abstract class Site extends \FreeAsso\Model\StorageModel\Site
{

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sitt_id
     * @var int
     */
    protected $sitt_id = null;

    /**
     * site_name
     * @var string
     */
    protected $site_name = null;

    /**
     * site_address1
     * @var string
     */
    protected $site_address1 = null;

    /**
     * site_address2
     * @var string
     */
    protected $site_address2 = null;

    /**
     * site_address3
     * @var string
     */
    protected $site_address3 = null;

    /**
     * site_cp
     * @var string
     */
    protected $site_cp = null;

    /**
     * site_town
     * @var string
     */
    protected $site_town = null;

    /**
     * parent_site_id
     * @var int
     */
    protected $parent_site_id = null;

    /**
     * site_position
     * @var string
     */
    protected $site_position = null;

    /**
     * site_left
     * @var int
     */
    protected $site_left = null;

    /**
     * site_right
     * @var int
     */
    protected $site_right = null;

    /**
     * site_level
     * @var int
     */
    protected $site_level = null;

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteId($p_value)
    {
        $this->site_id = $p_value;
        return $this;
    }

    /**
     * Get site_id
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set sitt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSittId($p_value)
    {
        $this->sitt_id = $p_value;
        return $this;
    }

    /**
     * Get sitt_id
     *
     * @return int
     */
    public function getSittId()
    {
        return $this->sitt_id;
    }

    /**
     * Set site_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteName($p_value)
    {
        $this->site_name = $p_value;
        return $this;
    }

    /**
     * Get site_name
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * Set site_address1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress1($p_value)
    {
        $this->site_address1 = $p_value;
        return $this;
    }

    /**
     * Get site_address1
     *
     * @return string
     */
    public function getSiteAddress1()
    {
        return $this->site_address1;
    }

    /**
     * Set site_address2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress2($p_value)
    {
        $this->site_address2 = $p_value;
        return $this;
    }

    /**
     * Get site_address2
     *
     * @return string
     */
    public function getSiteAddress2()
    {
        return $this->site_address2;
    }

    /**
     * Set site_address3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress3($p_value)
    {
        $this->site_address3 = $p_value;
        return $this;
    }

    /**
     * Get site_address3
     *
     * @return string
     */
    public function getSiteAddress3()
    {
        return $this->site_address3;
    }

    /**
     * Set site_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCp($p_value)
    {
        $this->site_cp = $p_value;
        return $this;
    }

    /**
     * Get site_cp
     *
     * @return string
     */
    public function getSiteCp()
    {
        return $this->site_cp;
    }

    /**
     * Set site_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteTown($p_value)
    {
        $this->site_town = $p_value;
        return $this;
    }

    /**
     * Get site_town
     *
     * @return string
     */
    public function getSiteTown()
    {
        return $this->site_town;
    }

    /**
     * Set parent_site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setParentSiteId($p_value)
    {
        $this->parent_site_id = $p_value;
        return $this;
    }

    /**
     * Get parent_site_id
     *
     * @return int
     */
    public function getParentSiteId()
    {
        return $this->parent_site_id;
    }

    /**
     * Set site_position
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSitePosition($p_value)
    {
        $this->site_position = $p_value;
        return $this;
    }

    /**
     * Get site_position
     *
     * @return string
     */
    public function getSitePosition()
    {
        return $this->site_position;
    }

    /**
     * Set site_left
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteLeft($p_value)
    {
        $this->site_left = $p_value;
        return $this;
    }

    /**
     * Get site_left
     *
     * @return int
     */
    public function getSiteLeft()
    {
        return $this->site_left;
    }

    /**
     * Set site_right
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteRight($p_value)
    {
        $this->site_right = $p_value;
        return $this;
    }

    /**
     * Get site_right
     *
     * @return int
     */
    public function getSiteRight()
    {
        return $this->site_right;
    }

    /**
     * Set site_level
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteLevel($p_value)
    {
        $this->site_level = $p_value;
        return $this;
    }

    /**
     * Get site_level
     *
     * @return int
     */
    public function getSiteLevel()
    {
        return $this->site_level;
    }
}
