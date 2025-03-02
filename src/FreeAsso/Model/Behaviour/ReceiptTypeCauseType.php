<?php
namespace FreeAsso\Model\Behaviour;

/**
 * receipt_type_cause_type
 *
 * @author jeromeklam
 *
 */
trait ReceiptTypeCauseType
{

   /**
     * Id
     * @var number
     */
    protected $rtct_id = null;

    /**
     * ReceiptTypeCauseType
     * @var \FreeAsso\Model\ReceiptTypeCauseType
     */
    protected $receipt_type_cause_type = null;

    /**
     * Set id : receipt_type_cause_type
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\ReceiptTypeCauseType
     */
    public function setRtctId($p_id)
    {
        $this->rtct_id = $p_id;
        if ($this->receipt_type_cause_type) {
            if ($this->receipt_type_cause_type->getRtctId() != $this->rtct_id) {
                $this->receipt_type_cause_type = null;
            }
        }
        return $this;
    }

    /**
     * Get id : receipt_type_cause_type
     *
     * @return number
     */
    public function getRtctId()
    {
        return $this->rtct_id;
    }

    /**
     * Set receipt_type_cause_type
     *
     * @param \FreeAsso\Model\ReceiptTypeCauseType $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setReceiptTypeCauseType($p_model)
    {
        $this->receipt_type_cause_type = $p_model;
        if ($p_model) {
            $this->rtct_id = $p_model->getRtctId();
        }
        return $this;
   }

   /**
     * Get receipt_type_cause_type
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\ReceiptTypeCauseType
     */
    public function getReceiptTypeCauseType($p_force = false)
    {
        if ($this->receipt_type_cause_type === null || $p_force) {
            if ($this->rtct_id > 0) {
                $this->receipt_type_cause_type = \FreeAsso\Model\ReceiptTypeCauseType::findFirst(
                    [
                        'rtct_id' => $this->rtct_id
                    ]
                );
            } else {
                $this->receipt_type_cause_type = null;
            }
        }
        return $this->receipt_type_cause_type;
    }
}