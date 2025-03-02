<?php
namespace FreeSSO\Model\Base;

/**
 * Broker
 *
 * @author jeromeklam
 */
abstract class Broker extends \FreeSSO\Model\StorageModel\Broker
{

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * dom_id
     * @var int
     */
    protected $dom_id = null;

    /**
     * brk_key
     * @var string
     */
    protected $brk_key = null;

    /**
     * brk_name
     * @var string
     */
    protected $brk_name = null;

    /**
     * brk_certificate
     * @var string
     */
    protected $brk_certificate = null;

    /**
     * brk_active
     * @var bool
     */
    protected $brk_active = null;

    /**
     * brk_ts
     * @var mixed
     */
    protected $brk_ts = null;

    /**
     * brk_api_scope
     * @var string
     */
    protected $brk_api_scope = null;

    /**
     * brk_users_scope
     * @var string
     */
    protected $brk_users_scope = null;

    /**
     * brk_auth
     * @var string
     */
    protected $brk_auth = null;

    /**
     * brk_ips
     * @var mixed
     */
    protected $brk_ips = null;

    /**
     * brk_same_ip
     * @var bool
     */
    protected $brk_same_ip = null;

    /**
     * brk_config
     * @var mixed
     */
    protected $brk_config = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * brk_type
     * @var string
     */
    protected $brk_type = null;

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Broker
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
     * Set dom_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Broker
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
     * Set brk_key
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkKey($p_value)
    {
        $this->brk_key = $p_value;
        return $this;
    }

    /**
     * Get brk_key
     *
     * @return string
     */
    public function getBrkKey()
    {
        return $this->brk_key;
    }

    /**
     * Set brk_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkName($p_value)
    {
        $this->brk_name = $p_value;
        return $this;
    }

    /**
     * Get brk_name
     *
     * @return string
     */
    public function getBrkName()
    {
        return $this->brk_name;
    }

    /**
     * Set brk_certificate
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkCertificate($p_value)
    {
        $this->brk_certificate = $p_value;
        return $this;
    }

    /**
     * Get brk_certificate
     *
     * @return string
     */
    public function getBrkCertificate()
    {
        return $this->brk_certificate;
    }

    /**
     * Set brk_active
     *
     * @param bool $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkActive($p_value)
    {
        $this->brk_active = $p_value;
        return $this;
    }

    /**
     * Get brk_active
     *
     * @return bool
     */
    public function getBrkActive()
    {
        return $this->brk_active;
    }

    /**
     * Set brk_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkTs($p_value)
    {
        $this->brk_ts = $p_value;
        return $this;
    }

    /**
     * Get brk_ts
     *
     * @return mixed
     */
    public function getBrkTs()
    {
        return $this->brk_ts;
    }

    /**
     * Set brk_api_scope
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkApiScope($p_value)
    {
        $this->brk_api_scope = $p_value;
        return $this;
    }

    /**
     * Get brk_api_scope
     *
     * @return mixed
     */
    public function getBrkApiScope()
    {
        return $this->brk_api_scope;
    }

    /**
     * Set brk_users_scope
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkUsersScope($p_value)
    {
        $this->brk_users_scope = $p_value;
        return $this;
    }

    /**
     * Get brk_users_scope
     *
     * @return mixed
     */
    public function getBrkUsersScope()
    {
        return $this->brk_users_scope;
    }

    /**
     * Set brk_auth
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkAuth($p_value)
    {
        $this->brk_auth = $p_value;
        return $this;
    }

    /**
     * Get brk_auth
     *
     * @return string
     */
    public function getBrkAuth()
    {
        return $this->brk_auth;
    }

    /**
     * Set brk_ips
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkIps($p_value)
    {
        $this->brk_ips = $p_value;
        return $this;
    }

    /**
     * Get brk_ips
     *
     * @return mixed
     */
    public function getBrkIps()
    {
        return $this->brk_ips;
    }

    /**
     * Set brk_same_ip
     *
     * @param bool $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkSameIp($p_value)
    {
        $this->brk_same_ip = $p_value;
        return $this;
    }

    /**
     * Get brk_same_ip
     *
     * @return bool
     */
    public function getBrkSameIp()
    {
        return $this->brk_same_ip;
    }

    /**
     * Set brk_config
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkConfig($p_value)
    {
        $this->brk_config = $p_value;
        return $this;
    }

    /**
     * Get brk_config
     *
     * @return mixed
     */
    public function getBrkConfig()
    {
        return $this->brk_config;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setGrpId($p_value)
    {
        $this->grp_id = $p_value;
        return $this;
    }

    /**
     * Get grp_id
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }

    /**
     * Set brk_type
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Broker
     */
    public function setBrkType($p_value)
    {
        $this->brk_type = $p_value;
        return $this;
    }

    /**
     * Get brk_type
     *
     * @return string
     */
    public function getBrkType()
    {
        return $this->brk_type;
    }
}
