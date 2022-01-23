<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait CauseType
{

    /**
     * CauseType
     * @var \FreeAsso\Model\CauseType
     */
    protected $cause_type = null;

    /**
     * Set cause_type
     *
     * @param \FreeAsso\Model\CauseType $p_cause_type
     *
     * @return \FreeFW\Core\Model
     */
    public function setCauseType($p_cause_type)
    {
        $this->cause_type = $p_cause_type;
        if ($this->cause_type) {
            $this->caut_id = $this->cause_type->getCautId();
        } else {
            $this->caut_id = null;  
        }
        return $this;
    }

    /**
     * Get cause_type
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function getCauseType()
    {
        if ($this->cause_type === null) {
            if ($this->caut_id > 0) {
                $this->cause_type = \FreeAsso\Model\CauseType::findFirst(['caut_id' => $this->caut_id]);
            }
        }
        return $this->cause_type;
    }
}
