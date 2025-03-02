<?php
namespace FreeSSO\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Group
{

    /**
     * Group
     * @var \FreeSSO\Model\Group
     */
    protected $group = null;

    /**
     * GroupId
     * @var number
     */
    protected $grp_id = null;

    /**
     * Set group
     *
     * @param \FreeSSO\Model\Group $p_group
     *
     * @return \FreeFW\Core\Model
     */
    public function setGroup($p_group)
    {
        $this->group = $p_group;
        if ($this->group instanceof \FreeSSO\Model\Group) {
            $this->setGrpId($this->group->getGrpId());
        } else {
            $this->setGrpId(null);
        }
        return $this;
    }

    /**
     * Get group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getGroup()
    {
        if ($this->group === null) {
            if ($this->grp_id > 0) {
                $this->group = \FreeSSO\Model\Group::findFirst(['grp_id' => $this->grp_id]);
            }
        }
        return $this->group;
    }

    /**
     * Set group id
     *
     * @param number $p_id
     *
     * @return \FreeSSO\Model\Behaviour\Group
     */
    public function setGrpId($p_id)
    {
        $this->grp_id = $p_id;
        if ($this->group !== null) {
            if ($this->grp_id != $this->group->getGrpId()) {
                $this->group = null;
            }
        }
        return $this;
    }

    /**
     * Get group id
     *
     * @return number
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }
}
