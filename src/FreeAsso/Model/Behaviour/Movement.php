<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Movement
{

    /**
     * Id
     * @var number
     */
    protected $move_id = null;

    /**
     * Movement
     * @var \FreeAsso\Model\Movement
     */
    protected $movement = null;

    /**
     * Set movement id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\Movement
     */
    public function setMoveId($p_id)
    {
        $this->move_id = $p_id;
        if ($this->movement) {
            if ($this->movement->getMoveId() != $this->move_id) {
                $this->movement = null;
            }
        }
        return $this;
    }

    /**
     * Get movement id
     *
     * @return number
     */
    public function getMoveId()
    {
        return $this->move_id;
    }

    /**
     * Set movement
     *
     * @param \FreeAsso\Model\Movement $p_movement
     *
     * @return \FreeFW\Core\Model
     */
    public function setMovement($p_movement)
    {
        $this->movement = $p_movement;
        if ($p_movement) {
            $this->move_id = $p_movement->getMoveId();
        }
        return $this;
    }

    /**
     * Get movement
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Movement
     */
    public function getMovement($p_force = false)
    {
        if ($this->movement === null || $p_force) {
            if ($this->move_id > 0) {
                $this->movement = \FreeAsso\Model\Movement::findFirst(['move_id' => $this->move_id]);
            } else {
                $this->movement = null;
            }
        }
        return $this->movement;
    }
}
