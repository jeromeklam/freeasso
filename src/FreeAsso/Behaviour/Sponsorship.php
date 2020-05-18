<?php
namespace FreeAsso\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Sponsorship
{
    /**
     * Sponsorship
     * @var \FreeAsso\Model\Sponsorship
     */
    protected $sponsorship = null;

    /**
     * Set sponsorship
     *
     * @param \FreeAsso\Model\Sponsorship $p_value
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setSponsorship($p_value)
    {
        $this->sponsorship = $p_value;
        return $this;
    }

    /**
     * Get sponsorship
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function getSponsorship()
    {
        if ($this->sponsorship === null) {
            if ($this->spo_id > 0) {
                $this->sponsorship = \FreeAsso\Model\Sponsorship::findFirst(['spo_id' => $this->spo_id]);
            }
        }
        return $this->sponsorship;
    }
}
