<?php
namespace FreeSSO\Model\Base;

/**
 * PasswordToken
 *
 * @author jeromeklam
 */
abstract class PasswordToken extends \FreeSSO\Model\StorageModel\PasswordToken
{

    /**
     * ptok_id
     * @var int
     */
    protected $ptok_id = null;

    /**
     * ptok_token
     * @var string
     */
    protected $ptok_token = null;

    /**
     * ptok_used
     * @var int
     */
    protected $ptok_used = null;

    /**
     * ptok_email
     * @var string
     */
    protected $ptok_email = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * ptok_request_ip
     * @var string
     */
    protected $ptok_request_ip = null;

    /**
     * ptok_resolve_ip
     * @var string
     */
    protected $ptok_resolve_ip = null;

    /**
     * ptok_end
     * @var string
     */
    protected $ptok_end = null;

    /**
     * Set ptok_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokId($p_value)
    {
        $this->ptok_id = $p_value;
        return $this;
    }

    /**
     * Get ptok_id
     *
     * @return int
     */
    public function getPtokId()
    {
        return $this->ptok_id;
    }

    /**
     * Set ptok_token
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokToken($p_value)
    {
        $this->ptok_token = $p_value;
        return $this;
    }

    /**
     * Get ptok_token
     *
     * @return string
     */
    public function getPtokToken()
    {
        return $this->ptok_token;
    }

    /**
     * Set ptok_used
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokUsed($p_value)
    {
        $this->ptok_used = $p_value;
        return $this;
    }

    /**
     * Get ptok_used
     *
     * @return int
     */
    public function getPtokUsed()
    {
        return $this->ptok_used;
    }

    /**
     * Set ptok_email
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokEmail($p_value)
    {
        $this->ptok_email = $p_value;
        return $this;
    }

    /**
     * Get ptok_email
     *
     * @return string
     */
    public function getPtokEmail()
    {
        return $this->ptok_email;
    }

    /**
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
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
     * Set ptok_request_ip
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokRequestIp($p_value)
    {
        $this->ptok_request_ip = $p_value;
        return $this;
    }

    /**
     * Get ptok_request_ip
     *
     * @return string
     */
    public function getPtokRequestIp()
    {
        return $this->ptok_request_ip;
    }

    /**
     * Set ptok_resolve_ip
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokResolveIp($p_value)
    {
        $this->ptok_resolve_ip = $p_value;
        return $this;
    }

    /**
     * Get ptok_resolve_ip
     *
     * @return string
     */
    public function getPtokResolveIp()
    {
        return $this->ptok_resolve_ip;
    }

    /**
     * Set ptok_end
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\PasswordToken
     */
    public function setPtokEnd($p_value)
    {
        $this->ptok_end = $p_value;
        return $this;
    }

    /**
     * Get ptok_end
     *
     * @return string
     */
    public function getPtokEnd()
    {
        return $this->ptok_end;
    }
}
