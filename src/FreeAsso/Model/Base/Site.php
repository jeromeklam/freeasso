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
     * brk_id
     * @var int
     */
    protected $brk_id = null;

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
}
