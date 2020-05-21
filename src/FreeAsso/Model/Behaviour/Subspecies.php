<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait Subspecies
{

    /**
     * Subspecies
     * @var \FreeAsso\Model\Subspecies
     */
    protected $subspecies = null;

    /**
     * Set subspecies
     *
     * @param \FreeAsso\Model\Subspecies $p_subspecies
     *
     * @return \FreeFW\Core\Model
     */
    public function setSubspecies($p_subspecies)
    {
        $this->subspecies = $p_subspecies;
        return $this;
    }

    /**
     * Get subspecies
     *
     * @return \FreeAsso\Model\Subspecies
     */
    public function getSubspecies()
    {
        if ($this->subspecies === null) {
            if ($this->sspe_id > 0) {
                $this->subspecies = \FreeAsso\Model\Subspecies::findFirst(['sspe_id' => $this->sspe_id]);
            }
        }
        return $this->subspecies;
    }
}
