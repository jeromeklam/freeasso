<?php
/**
 * ... ...
 * @author jeromeklam
 */
namespace FreeSSO\Model;

/**
 * Classe : Session
 * @author : jeromeklam
 */
class Session extends \FreeSSO\Model\Base\Session
{

    /**
     * Prevent from saving history
     * @var bool
     */
    protected $no_history = true;

    /**
     * Utilisateur
     * @var \FreeSSO\Model\User
     */
    protected $user = null;

    /**
     * Set user
     *
     * @param \FreeSSO\Model\User $p_user
     *
     * @return \FreeSSO\Model\Session
     */
    public function setUser($p_user)
    {
        $this->user = $p_user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \FreeSSO\Model\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
