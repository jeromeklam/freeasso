<?php
namespace FreeFW\Console;

/**
 * SSO Server mock class
 * @author jeromeklam
 *
 */
class SsoMock implements
    \FreeFW\Interfaces\SSOInterface,
    \Psr\Log\LoggerAwareInterface
{

    /**
     * comportements
     */
    use \Psr\Log\LoggerAwareTrait;

    /**
     * Broker id
     * @var string
     */
    protected $broker_id = null;

    /**
     * User
     * @var \FreeFW\Interfaces\UserInterface
     */
    protected $user = null;

    /**
     * Group
     * @var \FreeFW\MoInterfacesdel\GroupInterface
     */
    protected $group = null;

    /**
     *
     * @param string $p_broker_id
     */
    public function __construct($p_broker_id)
    {
        $this->broker_id = $p_broker_id;
    }

    /**
     * Get broker id
     *
     * @return string
     */
    public function getBrokerId()
    {
        return $this->broker_id;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::registerNewUser()
     */
    public function registerNewUser($p_login, $p_email, $p_password, array $p_datas = [], $p_withValidation = false)
    {}

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::logout()
     */
    public function logout()
    {}

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::getUserById()
     */
    public function getUserById($p_id)
    {}

    /**
     * Set user
     *
     * @param \FreeFW\Interfaces\UserInterface $p_user
     *
     * @return \FreeFW\Console\SsoMock
     */
    public function setUser($p_user)
    {
        $this->user = $p_user;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::getUser()
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::getUserByLogin()
     */
    public function getUserByLogin($p_login)
    {}

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\SSOInterface::signinByLoginAndPassword()
     */
    public function signinByLoginAndPassword($p_login, $p_password, $p_remember = false)
    {}

    /**
     * Set group
     *
     * @param \FreeFW\Interfaces\GroupInterface $p_group
     *
     * @return \FreeFW\Console\SsoMock
     */
    public function setGroup($p_group)
    {
        $this->group = $p_group;
        return $this;
    }

    /**
     * Get group
     *
     * @return \FreeFW\Interfaces\GroupInterface
     */
    public function getBrokerGroup()
    {
        return $this->group;
    }

    /**
     * Get user group
     * 
     * @return \FreeFW\Interfaces\GroupInterface
     */
    public function getUserGroup()
    {
        return $this->group;
    }

    /**
     *
     * @return string
     */
    public function getPermissions() : string
    {
        return 'ZEUS';
    }

    /**
     * Force user
     *
     * @param [type] $p_user
     * @param [type] $p_group
     * 
     * @return void
     */
    public function forceUser($p_user, $p_group) 
    {
        $this->user = $p_user;
        $this->group = $p_group;
        return $this;
    }
}
