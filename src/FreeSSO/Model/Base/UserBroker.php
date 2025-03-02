<?php
namespace FreeSSO\Model\Base;

/**
 * UserBroker
 *
 * @author jeromeklam
 */
abstract class UserBroker extends \FreeSSO\Model\StorageModel\UserBroker
{

    /**
     * ubrk_id
     * @var int
     */
    protected $ubrk_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * ubrk_ts
     * @var string
     */
    protected $ubrk_ts = null;

    /**
     * ubrk_partner_type
     * @var string
     */
    protected $ubrk_partner_type = null;

    /**
     * ubrk_partner_id
     * @var int
     */
    protected $ubrk_partner_id = null;

    /**
     * ubrk_auth_method
     * @var string
     */
    protected $ubrk_auth_method = null;

    /**
     * ubrk_auth_datas
     * @var mixed
     */
    protected $ubrk_auth_datas = null;

    /**
     * ubrk_end
     * @var string
     */
    protected $ubrk_end = null;

    /**
     * ubrk_config
     * @var string
     */
    protected $ubrk_config = null;

    /**
     * ubrk_cache
     * @var string
     */
    protected $ubrk_cache = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * Set ubrk_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkId($p_value)
    {
        $this->ubrk_id = $p_value;
        return $this;
    }

    /**
     * Get ubrk_id
     *
     * @return int
     */
    public function getUbrkId()
    {
        return $this->ubrk_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserBroker
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
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserBroker
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
     * Set ubrk_ts
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkTs($p_value)
    {
        $this->ubrk_ts = $p_value;
        return $this;
    }

    /**
     * Get ubrk_ts
     *
     * @return string
     */
    public function getUbrkTs()
    {
        return $this->ubrk_ts;
    }

    /**
     * Set ubrk_partner_type
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkPartnerType($p_value)
    {
        $this->ubrk_partner_type = $p_value;
        return $this;
    }

    /**
     * Get ubrk_partner_type
     *
     * @return string
     */
    public function getUbrkPartnerType()
    {
        return $this->ubrk_partner_type;
    }

    /**
     * Set ubrk_partner_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkPartnerId($p_value)
    {
        $this->ubrk_partner_id = $p_value;
        return $this;
    }

    /**
     * Get ubrk_partner_id
     *
     * @return int
     */
    public function getUbrkPartnerId()
    {
        return $this->ubrk_partner_id;
    }

    /**
     * Set ubrk_auth_method
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkAuthMethod($p_value)
    {
        $this->ubrk_auth_method = $p_value;
        return $this;
    }

    /**
     * Get ubrk_auth_method
     *
     * @return string
     */
    public function getUbrkAuthMethod()
    {
        return $this->ubrk_auth_method;
    }

    /**
     * Set ubrk_auth_datas
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkAuthDatas($p_value)
    {
        $this->ubrk_auth_datas = $p_value;
        return $this;
    }

    /**
     * Get ubrk_auth_datas
     *
     * @return mixed
     */
    public function getUbrkAuthDatas()
    {
        return $this->ubrk_auth_datas;
    }

    /**
     * Set ubrk_end
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function setUbrkEnd($p_value)
    {
        $this->ubrk_end = $p_value;
        return $this;
    }

    /**
     * Get ubrk_end
     *
     * @return string
     */
    public function getUbrkEnd()
    {
        return $this->ubrk_end;
    }

    /**
     * Set config
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\UserBroker
     */
    public function setUbrkConfig($p_value)
    {
        $this->ubrk_config = $p_value;
        return $this;
    }

    /**
     * Get config
     *
     * @return string
     */
    public function getUrbkConfig()
    {
        return $this->ubrk_config;
    }

    /**
     * Set cache
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\UserBroker
     */
    public function setUbrkCache($p_value)
    {
        $this->ubrk_cache = $p_value;
        return $this;
    }

    /**
     * Get cache
     *
     * @return string
     */
    public function getUrbkCache()
    {
        return $this->ubrk_cache;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Base\UserBroker
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
}
