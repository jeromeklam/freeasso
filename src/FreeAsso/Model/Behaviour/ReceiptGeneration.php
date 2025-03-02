<?php
namespace FreeAsso\Model\Behaviour;

/**
 * receipt_generation
 *
 * @author jeromeklam
 *
 */
trait ReceiptGeneration
{

   /**
     * Id
     * @var number
     */
    protected $recg_id = null;

    /**
     * ReceiptGeneration
     * @var \FreeAsso\Model\ReceiptGeneration
     */
    protected $receipt_generation = null;

    /**
     * Set id : receipt_generation
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\ReceiptGeneration
     */
    public function setRecgId($p_id)
    {
        $this->recg_id = $p_id;
        if ($this->receipt_generation) {
            if ($this->receipt_generation->getRecgId() != $this->recg_id) {
                $this->receipt_generation = null;
            }
        }
        return $this;
    }

    /**
     * Get id : receipt_generation
     *
     * @return number
     */
    public function getRecgId()
    {
        return $this->recg_id;
    }

    /**
     * Set receipt_generation
     *
     * @param \FreeAsso\Model\ReceiptGeneration $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setReceiptGeneration($p_model)
    {
        $this->receipt_generation = $p_model;
        if ($p_model) {
            $this->recg_id = $p_model->getRecgId();
        }
        return $this;
   }

   /**
     * Get receipt_generation
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function getReceiptGeneration($p_force = false)
    {
        if ($this->receipt_generation === null || $p_force) {
            if ($this->recg_id > 0) {
                $this->receipt_generation = \FreeAsso\Model\ReceiptGeneration::findFirst(
                    [
                        'recg_id' => $this->recg_id
                    ]
                );
            } else {
                $this->receipt_generation = null;
            }
        }
        return $this->receipt_generation;
    }

        /**
     * Set receipt_generation
     *
     * @param \FreeAsso\Model\ReceiptGeneration $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setGeneration($p_model)
    {
        $this->receipt_generation = $p_model;
        if ($p_model) {
            $this->recg_id = $p_model->getRecgId();
        }
        return $this;
   }

   /**
     * Get receipt_generation
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\ReceiptGeneration
     */
    public function getGeneration($p_force = false)
    {
        if ($this->receipt_generation === null || $p_force) {
            if ($this->recg_id > 0) {
                $this->receipt_generation = \FreeAsso\Model\ReceiptGeneration::findFirst(
                    [
                        'recg_id' => $this->recg_id
                    ]
                );
            } else {
                $this->receipt_generation = null;
            }
        }
        return $this->receipt_generation;
    }
}