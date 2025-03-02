<?php
namespace FreeSSO\Model\Base;

/**
 * UserToken
 *
 * @author jeromeklam
 */
abstract class UserToken extends \FreeSSO\Model\StorageModel\UserToken
{

    /**
     * utok_id
     * @var int
     */
    protected $utok_id = null;

    /**
     * user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * utok_token
     * @var string
     */
    protected $utok_token = null;

    /**
     * utok_from
     * @var mixed
     */
    protected $utok_from = null;

    /**
     * utok_to
     * @var mixed
     */
    protected $utok_to = null;

    /**
     * Set utok_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserToken
     */
    public function setUtokId($p_value)
    {
        $this->utok_id = $p_value;
        return $this;
    }

    /**
     * Get utok_id
     *
     * @return int
     */
    public function getUtokId()
    {
        return $this->utok_id;
    }

    /**
     * Set user_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserToken
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\UserToken
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
     * Set utok_token
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\UserToken
     */
    public function setUtokToken($p_value)
    {
        $this->utok_token = $p_value;
        return $this;
    }

    /**
     * Get utok_token
     *
     * @return string
     */
    public function getUtokToken()
    {
        return $this->utok_token;
    }

    /**
     * Set utok_from
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\UserToken
     */
    public function setUtokFrom($p_value)
    {
        $this->utok_from = $p_value;
        return $this;
    }

    /**
     * Get utok_from
     *
     * @return mixed
     */
    public function getUtokFrom()
    {
        return $this->utok_from;
    }

    /**
     * Set utok_to
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\UserToken
     */
    public function setUtokTo($p_value)
    {
        $this->utok_to = $p_value;
        return $this;
    }

    /**
     * Get utok_to
     *
     * @return mixed
     */
    public function getUtokTo()
    {
        return $this->utok_to;
    }
}
