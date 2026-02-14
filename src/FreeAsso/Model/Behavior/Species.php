<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Species
{

    /**
     * Species
     * @var \FreeAsso\Model\Species
     */
    protected $species = null;

    /**
     * Set species
     *
     * @param \FreeAsso\Model\Species $p_species
     *
     * @return \FreeFW\Core\Model
     */
    public function setSpecies($p_species)
    {
        $this->species = $p_species;
        return $this;
    }

    /**
     * Get species
     *
     * @return \FreeAsso\Model\Species
     */
    public function getSpecies()
    {
        if ($this->species === null) {
            if ($this->spe_id > 0) {
                $this->species = \FreeAsso\Model\Species::findFirst(['spe_id' => $this->spe_id]);
            }
        }
        return $this->species;
    }
}
