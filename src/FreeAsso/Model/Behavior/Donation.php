<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Donation
{

    /**
     * Donation
     * @var \FreeAsso\Model\Donation
     */
    protected $donation = null;

    /**
     * Set donation
     *
     * @param \FreeAsso\Model\Donation $p_donation
     *
     * @return \FreeFW\Core\Model
     */
    public function setDonation($p_donation)
    {
        $this->donation = $p_donation;
        return $this;
    }

    /**
     * Get donation
     *
     * @return \FreeAsso\Model\Donation
     */
    public function getDonation()
    {
        if ($this->donation === null) {
            if ($this->don_id > 0) {
                $this->donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $this->don_id]);
            }
        }
        return $this->donation;
    }
}
