<?php
namespace FreeAsso\Model\Behavior;

/**
 * stat
 *
 * @author jeromeklam
 *
 */
trait Stat
{

   /**
     * Id
     * @var number
     */
    protected $ = null;

    /**
     * Stat
     * @var \FreeAsso\Model\Stat
     */
    protected $stat = null;

    /**
     * Set id : stat
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behavior\Stat
     */
    public function set($p_id)
    {
        $this-> = $p_id;
        if ($this->stat) {
            if ($this->stat->get() != $this->) {
                $this->stat = null;
            }
        }
        return $this;
    }

    /**
     * Get id : stat
     *
     * @return number
     */
    public function get()
    {
        return $this->;
    }

    /**
     * Set stat
     *
     * @param \FreeAsso\Model\Stat $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setStat($p_model)
    {
        $this->stat = $p_model;
        if ($p_model) {
            $this-> = $p_model->get();
        }
        return $this;
   }

   /**
     * Get stat
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Stat
     */
    public function getStat($p_force = false)
    {
        if ($this->stat === null || $p_force) {
            if ($this-> > 0) {
                $this->stat = \FreeAsso\Model\Stat::findFirst(
                    [
                        '' => $this->
                    ]
                );
            } else {
                $this->stat = null;
            }
        }
        return $this->stat;
    }
}