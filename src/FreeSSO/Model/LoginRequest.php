<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model
 *
 * @author jeromeklam
 */
class LoginRequest extends \FreeFW\Core\Model
{

    /**
     * Login
     * @var string
     */
    protected $login = null;

    /**
     * Password
     * @var string
     */
    protected $password = null;

    /**
     * Autologin
     * @var string
     */
    protected $autologin = null;

    /**
     * Oauth2
     * @var string
     */
    protected $oauth2 = null;

    /**
     * Set Login
     *
     * @param string $p_login
     *
     * @return \FreeSSO\Model\LoginRequest
     */
    public function setLogin(string $p_login)
    {
        $this->login = $p_login;
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
     * @param string $p_password
     *
     * @return \FreeSSO\Model\LoginRequest
     */
    public function setPassword(string $p_password)
    {
        $this->password = $p_password;
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
     * Set Autologin
     *
     * @param string $p_autologin
     *
     * @return \FreeSSO\Model\LoginRequest
     */
    public function setAutologin(string $p_autologin)
    {
        $this->autologin = $p_autologin;
        return $this;
    }

    /**
     * Get namespace
     *
     * @return string
     */
    public function getAutologin()
    {
        return $this->autologin;
    }

    /**
     * Set oauth2
     *
     * @param string $p_oauth2
     *
     * @return \FreeSSO\Model\LoginRequest
     */
    public function setOauth2(string $p_oauth2)
    {
        $this->oauth2 = $p_oauth2;
        return $this;
    }

    /**
     * Get oauth2
     *
     * @return string
     */
    public function getOauth2()
    {
        return $this->oauth2;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::getProperties()
     */
    public static function getProperties()
    {
        return [
            'login' => [
                FFCST::PROPERTY_PRIVATE => 'login',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ],
            'password' => [
                FFCST::PROPERTY_PRIVATE => 'password',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ],
            'autologin' => [
                FFCST::PROPERTY_PRIVATE => 'autologin',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ],
            'oauth2' => [
                FFCST::PROPERTY_PRIVATE => 'oauth2',
                FFCST::PROPERTY_TYPE    => FFCST::TYPE_STRING,
                FFCST::PROPERTY_OPTIONS => []
            ]
        ];
    }
}
