<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait CauseMainType
{

    /**
     * CauseMainType
     * @var \FreeAsso\Model\CauseMainType
     */
    protected $cause_main_type = null;

    /**
     * Set cause_main_type
     *
     * @param \FreeAsso\Model\CauseMainType $p_cause_main_type
     *
     * @return \FreeFW\Core\Model
     */
    public function setCauseMainType($p_cause_main_type)
    {
        $this->cause_main_type = $p_cause_main_type;
        return $this;
    }

    /**
     * Get cause_main_type
     *
     * @return \FreeAsso\Model\CauseMainType
     */
    public function getCauseMainType()
    {
        if ($this->cause_main_type === null) {
            if ($this->camt_id > 0) {
                $this->cause_main_type = \FreeAsso\Model\CauseMainType::findFirst(['camt_id' => $this->camt_id]);
            }
        }
        return $this->cause_main_type;
    }
}
