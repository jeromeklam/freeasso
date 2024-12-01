<?php
namespace FreeSSO\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait User
{

    /**
     * User
     * @var \FreeSSO\Model\User
     */
    protected $user = null;

    /**
     * UserId
     * @var number
     */
    protected $user_id = null;

    /**
     * Set user
     *
     * @param \FreeSSO\Model\User $p_user
     *
     * @return \FreeFW\Core\Model
     */
    public function setUser($p_user)
    {
        $this->user = $p_user;
        if ($this->user instanceof \FreeSSO\Model\User) {
            $this->setUserId($this->user->getUserId());
        } else {
            $this->setUserId(null);
        }
        return $this;
    }

    /**
     * Get user
     *
     * @return \FreeSSO\Model\User
     */
    public function getUser()
    {
        if ($this->user === null) {
            if ($this->user_id > 0) {
                $this->user = \FreeSSO\Model\User::findFirst(['user_id' => $this->user_id]);
            }
        }
        return $this->user;
    }

    /**
     * Set user id
     *
     * @param number $p_id
     *
     * @return \FreeSSO\Model\Behaviour\User
     */
    public function setUserId($p_id)
    {
        $this->user_id = $p_id;
        if ($this->user !== null) {
            if ($this->user_id != $this->user->getUserId()) {
                $this->user = null;
            }
        }
        return $this;
    }

    /**
     * Get user id
     *
     * @return number
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
