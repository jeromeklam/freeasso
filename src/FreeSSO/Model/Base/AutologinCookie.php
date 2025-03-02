<?php
namespace FreeSSO\Model\Base;

/**
 * AutologinCookie
 *
 * @author jeromeklam
 */
abstract class AutologinCookie extends \FreeSSO\Model\StorageModel\AutologinCookie
{

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * auto_cookie
     * @var string
     */
    protected $auto_cookie = null;

    /**
     * auto_ip
     * @var string
     */
    protected $auto_ip = null;

    /**
     * auto_ts
     * @var string
     */
    protected $auto_ts = null;

    /**
     * auto_expire
     * @var string
     */
    protected $auto_expire = null;

    /**
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function setUserId($p_value)
    {
        $this->user_id = $p_value;
        return $this;
    }

    /**
     * Get user_id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set auto_cookie
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function setAutoCookie($p_value)
    {
        $this->auto_cookie = $p_value;
        return $this;
    }

    /**
     * Get auto_cookie
     *
     * @return string
     */
    public function getAutoCookie()
    {
        return $this->auto_cookie;
    }

    /**
     * Set auto_ip
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function setAutoIp($p_value)
    {
        $this->auto_ip = $p_value;
        return $this;
    }

    /**
     * Get auto_ip
     *
     * @return string
     */
    public function getAutoIp()
    {
        return $this->auto_ip;
    }

    /**
     * Set auto_ts
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function setAutoTs($p_value)
    {
        $this->auto_ts = $p_value;
        return $this;
    }

    /**
     * Get auto_ts
     *
     * @return string
     */
    public function getAutoTs()
    {
        return $this->auto_ts;
    }

    /**
     * Set auto_expire
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\AutologinCookie
     */
    public function setAutoExpire($p_value)
    {
        $this->auto_expire = $p_value;
        return $this;
    }

    /**
     * Get auto_expire
     *
     * @return string
     */
    public function getAutoExpire()
    {
        return $this->auto_expire;
    }
}
