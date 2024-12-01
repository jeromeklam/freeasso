<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * GroupUser
 *
 * @author jeromeklam
 */
class GroupUser extends \FreeSSO\Model\Base\GroupUser
{

    /**
     * Group
     * @var \FreeSSO\Model\Group
     */
    protected $group = null;

    /**
     * User
     * @var \FreeSSO\Model\User
     */
    protected $user = null;

    /**
     * Function
     * @var \FreeSSO\Model\JobFunction
     */
    protected $job_function = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->gru_id    = 0;
        $this->grp_id    = null;
        $this->user_id   = null;
        $this->gru_activ = false;
        return $this;
    }

    /**
     * Set group
     *
     * @param \FreeSSO\Model\Group $p_group
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setGroup($p_group)
    {
        $this->group = $p_group;
        return $this;
    }

    /**
     * Get group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set user
     *
     * @param \FreeSSO\Model\User $p_user
     *
     * @return \FreeSSO\Model\GroupUser
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

    /**
     * Set job function
     *
     * @param \FreeSSO\Model\JobFunction $p_job_function
     *
     * @return \FreeSSO\Model\GroupUser
     */
    public function setJobFunction($p_job_function)
    {
        $this->job_function = $p_job_function;
        return $this;
    }

    /**
     * Get Job function
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function getJobFunction()
    {
        return $this->job_function;
    }
}
