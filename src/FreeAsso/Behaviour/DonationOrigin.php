<?php
namespace FreeAsso\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait DonationOrigin
{

    /**
     * Origin
     * @var \FreeAsso\Model\DonationOrigin
     */
    protected $origin = null;

    /**
     * Set origin
     *
     * @param \FreeAsso\Model\DonationOrigin $p_origin
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setOrigin($p_origin)
    {
        $this->origin = $p_origin;
        return $this;
    }

    /**
     * Get origin
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function getOrigin()
    {
        if ($this->origin === null) {
            if ($this->dono_id > 0) {
                $this->origin = \FreeAsso\Model\DonationOrigin::findFirst(['dono_id' => $this->dono_id]);
            }
        }
        return $this->origin;
    }
}
