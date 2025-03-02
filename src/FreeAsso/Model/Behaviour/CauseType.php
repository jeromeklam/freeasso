<?php
namespace FreeAsso\Model\Behaviour;

/**
 * cause_type
 *
 * @author jeromeklam
 *
 */
trait CauseType
{

   /**
     * Id
     * @var number
     */
    protected $caut_id = null;

    /**
     * CauseType
     * @var \FreeAsso\Model\CauseType
     */
    protected $cause_type = null;

    /**
     * Set id : cause_type
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\CauseType
     */
    public function setCautId($p_id)
    {
        $this->caut_id = $p_id;
        if ($this->cause_type) {
            if ($this->cause_type->getCautId() != $this->caut_id) {
                $this->cause_type = null;
            }
        }
        return $this;
    }

    /**
     * Get id : cause_type
     *
     * @return number
     */
    public function getCautId()
    {
        return $this->caut_id;
    }

    /**
     * Set cause_type
     *
     * @param \FreeAsso\Model\CauseType $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setCauseType($p_model)
    {
        $this->cause_type = $p_model;
        if ($p_model) {
            $this->caut_id = $p_model->getCautId();
        }
        return $this;
   }

   /**
     * Get cause_type
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function getCauseType($p_force = false)
    {
        if ($this->cause_type === null || $p_force) {
            if ($this->caut_id > 0) {
                $this->cause_type = \FreeAsso\Model\CauseType::findFirst(
                    [
                        'caut_id' => $this->caut_id
                    ]
                );
            } else {
                $this->cause_type = null;
            }
        }
        return $this->cause_type;
    }
}