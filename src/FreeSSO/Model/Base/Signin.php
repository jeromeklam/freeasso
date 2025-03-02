<?php
namespace FreeSSO\Model\Base;

/**
 * Signin
 *
 * @author jeromeklam
 */
abstract class Signin extends \FreeSSO\Model\StorageModel\Signin
{

    /**
     * login
     * @var string
     */
    protected $login = null;

    /**
     * password
     * @var string
     */
    protected $password = null;

    /**
     * password2
     * @var string
     */
    protected $password2 = null;

    /**
     * token for password change
     * @var string
     */
    protected $token = null;

    /**
     * remember
     * @var int
     */
    protected $remember = null;

    /**
     * email
     * @var string
     */
    protected $email = null;

    /**
     * type de compte
     * @var string
     */
    protected $type = null;

    /**
     * lang
     * @var string
     */
    protected $lang = null;

    /**
     * Set login
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Signin
     */
    public function setLogin($p_value)
    {
        $this->login = $p_value;
        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Signin
     */
    public function setPassword($p_value)
    {
        $this->password = $p_value;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password2
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Signin
     */
    public function setPassword2($p_value)
    {
        $this->password2 = $p_value;
        return $this;
    }

    /**
     * Get password2
     *
     * @return string
     */
    public function getPassword2()
    {
        return $this->password2;
    }

    /**
     * Set remember
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\Signin
     */
    public function setRemember($p_value)
    {
        $this->remember = $p_value;
        return $this;
    }

    /**
     * Get remember
     *
     * @return int
     */
    public function getRemember()
    {
        return $this->remember;
    }

    /**
     * Set token
     *
     * @param string $p_token
     *
     * @return \FreeSSO\Model\Base\Signin
     */
    public function setToken($p_token)
    {
        $this->token = $p_token;
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set email
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Signin
     */
    public function setEmail($p_value)
    {
        $this->email = $p_value;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set type
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Signin
     */
    public function setType($p_value)
    {
        $this->type = $p_value;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set lang
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\Base\Signin
     */
    public function setLang($p_value)
    {
        $this->lang = $p_value;
        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }
}
