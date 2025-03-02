<?php
namespace FreeSSO\Model\Base;

/**
 * Domain
 *
 * @author jeromeklam
 */
abstract class Domain extends \FreeSSO\Model\StorageModel\Domain
{

    /**
     * dom_id
     * @var int
     */
    protected $dom_id = null;

    /**
     * dom_key
     * @var string
     */
    protected $dom_key = null;

    /**
     * dom_name
     * @var string
     */
    protected $dom_name = null;

    /**
     * dom_concurrent_user
     * @var int
     */
    protected $dom_concurrent_user = null;

    /**
     * dom_maintain_seconds
     * @var int
     */
    protected $dom_maintain_seconds = null;

    /**
     * dom_session_minutes
     * @var int
     */
    protected $dom_session_minutes = null;

    /**
     * dom_sites
     * @var mixed
     */
    protected $dom_sites = null;

    /**
     * Set dom_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomId($p_value)
    {
        $this->dom_id = $p_value;
        return $this;
    }

    /**
     * Get dom_id
     *
     * @return int
     */
    public function getDomId()
    {
        return $this->dom_id;
    }

    /**
     * Set dom_key
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomKey($p_value)
    {
        $this->dom_key = $p_value;
        return $this;
    }

    /**
     * Get dom_key
     *
     * @return string
     */
    public function getDomKey()
    {
        return $this->dom_key;
    }

    /**
     * Set dom_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomName($p_value)
    {
        $this->dom_name = $p_value;
        return $this;
    }

    /**
     * Get dom_name
     *
     * @return string
     */
    public function getDomName()
    {
        return $this->dom_name;
    }

    /**
     * Set dom_concurrent_user
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomConcurrentUser($p_value)
    {
        $this->dom_concurrent_user = $p_value;
        return $this;
    }

    /**
     * Get dom_concurrent_user
     *
     * @return int
     */
    public function getDomConcurrentUser()
    {
        return $this->dom_concurrent_user;
    }

    /**
     * Set dom_maintain_seconds
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomMaintainSeconds($p_value)
    {
        $this->dom_maintain_seconds = $p_value;
        return $this;
    }

    /**
     * Get dom_maintain_seconds
     *
     * @return int
     */
    public function getDomMaintainSeconds()
    {
        return $this->dom_maintain_seconds;
    }

    /**
     * Set dom_session_minutes
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomSessionMinutes($p_value)
    {
        $this->dom_session_minutes = $p_value;
        return $this;
    }

    /**
     * Get dom_session_minutes
     *
     * @return int
     */
    public function getDomSessionMinutes()
    {
        return $this->dom_session_minutes;
    }

    /**
     * Set dom_sites
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Domain
     */
    public function setDomSites($p_value)
    {
        $this->dom_sites = $p_value;
        return $this;
    }

    /**
     * Get dom_sites
     *
     * @return mixed
     */
    public function getDomSites()
    {
        return $this->dom_sites;
    }
}
