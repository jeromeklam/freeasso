<?php
namespace FreeAsso\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait PaymentType
{

    /**
     * Payment Type
     * @var \FreeAsso\Model\PaymentType
     */
    protected $payment_type = null;

    /**
     * Set payment type
     *
     * @param \FreeAsso\Model\PaymentType $p_payment_type
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setPaymentType($p_payment_type)
    {
        $this->payment_type = $p_payment_type;
        return $this;
    }

    /**
     * Get payment type
     *
     * @return \FreeAsso\Model\PaymentType
     */
    public function getPaymentType()
    {
        if ($this->payment_type === null) {
            if ($this->ptyp_id > 0) {
                $this->payment_type = \FreeAsso\Model\PaymentType::findFirst(['ptyp_id' => $this->ptyp_id]);
            }
        }
        return $this->payment_type;
    }
}
