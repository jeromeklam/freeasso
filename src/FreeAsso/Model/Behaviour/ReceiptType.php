<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait ReceiptType
{

    /**
     * ReceiptType id
     * @var number
     */
    protected $rett_id = null;

    /**
     * ReceiptType
     * @var \FreeAsso\Model\ReceiptType
     */
    protected $receipt_type = null;

    /**
     * Set receipt_type id
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behaviour\receipt_type
     */
    public function setRettId($p_id)
    {
        $this->rett_id = $p_id;
        if ($this->receipt_type) {
            if ($this->receipt_type->getRettId() != $p_id) {
                $this->receipt_type = null;
            }
        }
        return $this;
    }

    /**
     * Set receipt_type
     *
     * @param \FreeAsso\Model\ReceiptType $p_receipt_type
     *
     * @return \FreeFW\Core\Model
     */
    public function setReceiptType($p_receipt_type)
    {
        $this->receipt_type = $p_receipt_type;
        if ($this->receipt_type) {
            $this->setRettId($this->receipt_type->getRettId());
        } else {
            $this->setRettId(null);
        }
        return $this;
    }

    /**
     * Get receipt_type
     *
     * @return \FreeAsso\Model\ReceiptType
     */
    public function getReceiptType()
    {
        if ($this->receipt_type === null) {
            if ($this->rett_id > 0) {
                $this->receipt_type = \FreeAsso\Model\ReceiptType::findFirst(['rett_id' => $this->rett_id]);
            }
        }
        return $this->receipt_type;
    }
}
